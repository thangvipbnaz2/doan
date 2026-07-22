<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$role = $user['role'] ?? '';
// Migrate old role names
if ($role === 'admin') {
    $conn->prepare("UPDATE users SET role = 'super_admin' WHERE id = ?")->execute([$_SESSION['user_id']]);
    $role = 'super_admin';
}
$allowedRoles = ['super_admin', 'content_creator', 'moderator'];
if (!$user || !in_array($role, $allowedRoles)) {
    echo '<!DOCTYPE html><html><body style="font-family:sans-serif;display:flex;align-items:center;justify-content:center;min-height:100vh;background:#eff6ff"><div style="text-align:center;padding:40px;background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.08)"><h1 style="color:#dc2626">⛔ Truy cập bị từ chối</h1><p style="color:#64748b;margin:16px 0">Bạn không có quyền truy cập trang quản trị.</p><a href="index.php" style="display:inline-block;padding:12px 24px;background:#3b82f6;color:#fff;border-radius:10px;text-decoration:none;font-weight:600">Về trang chủ</a></div></body></html>';
    exit;
}
// Check if banned
$stmt = $conn->prepare("SELECT banned FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$bannedCheck = $stmt->fetch();
if (!empty($bannedCheck['banned'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
$userId = $_SESSION['user_id'];

try {
    $conn->exec("ALTER TABLE posts ADD COLUMN status VARCHAR(20) DEFAULT 'pending' AFTER tags");
} catch (PDOException $e) {}
try {
    $conn->exec("ALTER TABLE users ADD COLUMN banned TINYINT(1) DEFAULT 0 AFTER role");
} catch (PDOException $e) {}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --sidebar-w: 260px;
            --admin-radius: 14px;
        }

        .admin-body {
            display: flex;
            min-height: 100vh;
            background: #f0f4f8;
            font-family: var(--font-sans);
        }

        [data-theme="dark"] .admin-body {
            background: #0b1120;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: rgba(15, 23, 42, 0.97);
            backdrop-filter: blur(24px);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform .4s cubic-bezier(.34,1.56,.64,1);
            border-right: 1px solid rgba(255,255,255,0.06);
            overflow: hidden;
        }

        [data-theme="dark"] .admin-sidebar {
            background: rgba(2, 6, 23, 0.98);
        }

        .admin-sidebar__brand {
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .admin-sidebar__logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 900;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .admin-sidebar__brand-text {
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: -0.02em;
        }

        .admin-sidebar__brand-text span {
            color: #5eead4;
        }

        .admin-sidebar__nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .admin-sidebar__label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: rgba(255,255,255,0.3);
            padding: 16px 12px 6px;
            font-weight: 600;
        }

        .admin-tab {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 10px;
            border: none;
            background: transparent;
            color: rgba(255,255,255,0.55);
            font-size: .88rem;
            font-weight: 500;
            cursor: pointer;
            transition: all .25s cubic-bezier(.34,1.56,.64,1);
            font-family: inherit;
            width: 100%;
            text-align: left;
            position: relative;
        }

        .admin-tab i {
            font-size: 1.15rem;
            width: 22px;
            text-align: center;
            flex-shrink: 0;
        }

        .admin-tab:hover {
            color: #fff;
            background: rgba(255,255,255,0.06);
        }

        .admin-tab--active {
            color: #fff !important;
            background: linear-gradient(135deg, rgba(13,148,136,0.2), rgba(13,148,136,0.08)) !important;
            font-weight: 600;
        }

        .admin-tab--active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: #0d9488;
            border-radius: 0 4px 4px 0;
        }

        .admin-tab .tab-badge {
            margin-left: auto;
            background: rgba(239,68,68,0.2);
            color: #fca5a5;
            font-size: .7rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 50px;
            min-width: 20px;
            text-align: center;
        }

        .admin-sidebar__footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .admin-sidebar__user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            background: rgba(255,255,255,0.04);
            margin-bottom: 8px;
        }

        .admin-sidebar__avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: .85rem;
            flex-shrink: 0;
        }

        .admin-sidebar__name {
            color: #fff;
            font-size: .85rem;
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .admin-sidebar__role {
            color: rgba(255,255,255,0.35);
            font-size: .7rem;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            background: rgba(239,68,68,0.1);
            color: #fca5a5;
            font-size: .85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .25s;
            font-family: inherit;
            width: 100%;
        }

        .logout-btn:hover {
            background: rgba(239,68,68,0.2);
            color: #fff;
        }

        /* ===== SIDEBAR TOGGLE (MOBILE) ===== */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 14px;
            left: 14px;
            z-index: 1100;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            background: rgba(15,23,42,0.9);
            color: #fff;
            font-size: 1.3rem;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(12px);
            transition: all .3s;
        }

        .sidebar-toggle:hover {
            background: rgba(15,23,42,1);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            backdrop-filter: blur(4px);
        }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            flex: 1;
            margin-left: var(--sidebar-w);
            padding: 28px 32px 60px;
            min-height: 100vh;
            transition: margin-left .4s cubic-bezier(.34,1.56,.64,1);
        }

        /* ===== TOP BAR ===== */
        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding: 16px 24px;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(20px);
            border-radius: var(--admin-radius);
            border: 1px solid rgba(255,255,255,0.8);
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }

        [data-theme="dark"] .admin-topbar {
            background: rgba(30,41,59,0.7);
            border-color: rgba(255,255,255,0.04);
        }

        .admin-topbar__left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .admin-topbar__breadcrumb {
            font-size: .82rem;
            color: var(--gray);
        }

        .admin-topbar__breadcrumb span {
            color: var(--dark);
            font-weight: 600;
        }

        [data-theme="dark"] .admin-topbar__breadcrumb span {
            color: #f1f5f9;
        }

        .admin-topbar__title {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -0.02em;
        }

        [data-theme="dark"] .admin-topbar__title {
            color: #f1f5f9;
        }

        .admin-topbar__actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-topbar__time {
            font-size: .82rem;
            color: var(--gray);
            font-weight: 500;
        }

        /* ===== PANELS ===== */
        .admin-panel {
            display: none;
            animation: panelIn .45s cubic-bezier(.34,1.56,.64,1);
        }

        .admin-panel--active {
            display: block;
        }

        @keyframes panelIn {
            from { opacity: 0; transform: translateY(16px) scale(.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ===== STAT CARDS ===== */
        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 14px;
            margin-bottom: 28px;
        }

        .a-stat {
            position: relative;
            padding: 20px 20px 18px;
            border-radius: var(--admin-radius);
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.85);
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
            transition: all .35s cubic-bezier(.34,1.56,.64,1);
            overflow: hidden;
        }

        .a-stat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            opacity: 0;
            transition: opacity .3s;
        }

        .a-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.06);
        }

        .a-stat:hover::before {
            opacity: 1;
        }

        [data-theme="dark"] .a-stat {
            background: rgba(30,41,59,0.6);
            border-color: rgba(255,255,255,0.04);
        }

        .a-stat--teal::before { background: linear-gradient(90deg, #0d9488, #14b8a6); }
        .a-stat--coral::before { background: linear-gradient(90deg, #f97316, #fb923c); }
        .a-stat--purple::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .a-stat--blue::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .a-stat--pink::before { background: linear-gradient(90deg, #ec4899, #f472b6); }
        .a-stat--amber::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .a-stat--emerald::before { background: linear-gradient(90deg, #10b981, #34d399); }

        .a-stat__icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 12px;
        }

        .a-stat__icon--teal { background: rgba(13,148,136,0.1); color: #0d9488; }
        .a-stat__icon--coral { background: rgba(249,115,22,0.1); color: #f97316; }
        .a-stat__icon--purple { background: rgba(139,92,246,0.1); color: #8b5cf6; }
        .a-stat__icon--blue { background: rgba(59,130,246,0.1); color: #3b82f6; }
        .a-stat__icon--pink { background: rgba(236,72,153,0.1); color: #ec4899; }
        .a-stat__icon--amber { background: rgba(245,158,11,0.1); color: #f59e0b; }
        .a-stat__icon--emerald { background: rgba(16,185,129,0.1); color: #10b981; }

        .a-stat__num {
            display: block;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--dark);
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        [data-theme="dark"] .a-stat__num {
            color: #f1f5f9;
        }

        .a-stat__label {
            font-size: .75rem;
            color: var(--gray);
            margin-top: 2px;
            font-weight: 500;
        }

        /* ===== DASHBOARD GRID ===== */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .dashboard-charts {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            padding: 20px;
            position: relative;
            height: 300px;
        }
        .chart-card canvas {
            width: 100% !important;
            height: 100% !important;
        }

        @media (max-width: 900px) {
            .dashboard-grid,
            .dashboard-charts {
                grid-template-columns: 1fr;
            }
        }

        /* ===== CARDS ===== */
        .table-card {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(16px);
            border-radius: var(--admin-radius);
            padding: 24px;
            border: 1px solid rgba(255,255,255,0.85);
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
            transition: box-shadow .3s;
        }

        [data-theme="dark"] .table-card {
            background: rgba(30,41,59,0.6);
            border-color: rgba(255,255,255,0.04);
        }

        .table-card__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-card__title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        [data-theme="dark"] .table-card__title {
            color: #f1f5f9;
        }

        /* ===== FORM CARD ===== */
        .form-card {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(16px);
            border-radius: var(--admin-radius);
            padding: 24px;
            border: 1px solid rgba(255,255,255,0.85);
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
            position: sticky;
            top: 28px;
        }

        [data-theme="dark"] .form-card {
            background: rgba(30,41,59,0.6);
            border-color: rgba(255,255,255,0.04);
        }

        .form-card__title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        [data-theme="dark"] .form-card__title {
            color: #f1f5f9;
            border-color: rgba(255,255,255,0.06);
        }

        .admin-layout {
            display: flex;
            align-items: flex-start;
            gap: 24px;
        }

        .admin-layout > .form-card {
            flex: 0 0 380px;
            position: sticky;
            top: 28px;
            align-self: flex-start;
            max-height: calc(100vh - 56px);
            overflow-y: auto;
        }

        .admin-layout > .table-card {
            flex: 1;
            min-width: 0;
        }

        @media (max-width: 1000px) {
            .admin-layout {
                flex-direction: column;
            }
            .admin-layout > .form-card {
                flex: none;
                position: static;
                max-height: none;
                overflow-y: visible;
            }
        }

        /* ===== FORM FIELDS ===== */
        .fg {
            margin-bottom: 16px;
        }

        .fg label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: var(--dark-3);
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }

        [data-theme="dark"] .fg label {
            color: #94a3b8;
        }

        .fg input,
        .fg textarea,
        .fg select {
            width: 100%;
            padding: 11px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: .92rem;
            font-family: inherit;
            color: var(--dark);
            transition: all .25s;
            background: #fff;
        }

        [data-theme="dark"] .fg input,
        [data-theme="dark"] .fg textarea,
        [data-theme="dark"] .fg select {
            background: rgba(30,41,59,0.8);
            border-color: #334155;
            color: #f1f5f9;
        }

        .fg input:focus,
        .fg textarea:focus,
        .fg select:focus {
            outline: none;
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13,148,136,0.1);
        }

        .fg textarea {
            resize: vertical;
            min-height: 70px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .form-actions .btn {
            flex: 1;
        }

        .edit-indicator {
            display: none;
            padding: 10px 16px;
            background: rgba(245,158,11,0.1);
            border: 1px solid rgba(245,158,11,0.2);
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: .85rem;
            color: #92400e;
            font-weight: 600;
            align-items: center;
            gap: 8px;
        }

        [data-theme="dark"] .edit-indicator {
            color: #fcd34d;
            background: rgba(245,158,11,0.08);
        }

        .edit-indicator.show {
            display: flex;
        }

        .edit-indicator button {
            border: none;
            background: transparent;
            color: #92400e;
            cursor: pointer;
            font-weight: 700;
            margin-left: auto;
            font-size: 1rem;
        }

        /* ===== TABLES ===== */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .88rem;
        }

        .admin-table thead th {
            text-align: left;
            padding: 12px 14px;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--gray);
            border-bottom: 1.5px solid #e2e8f0;
            font-weight: 600;
        }

        [data-theme="dark"] .admin-table thead th {
            border-color: rgba(255,255,255,0.06);
        }

        .admin-table tbody tr {
            transition: background .2s;
        }

        .admin-table tbody tr:hover {
            background: rgba(13,148,136,0.04);
        }

        [data-theme="dark"] .admin-table tbody tr:hover {
            background: rgba(13,148,136,0.08);
        }

        .admin-table td {
            padding: 13px 14px;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            vertical-align: middle;
        }

        [data-theme="dark"] .admin-table td {
            border-color: rgba(255,255,255,0.04);
            color: #e2e8f0;
        }

        .td-hanzi {
            font-family: 'Noto Sans SC', sans-serif;
            font-size: 1.4rem;
            font-weight: 900;
        }

        .td-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            transition: all .2s;
            margin-right: 3px;
        }

        .td-btn--edit {
            background: rgba(245,158,11,0.1);
            color: #d97706;
        }

        .td-btn--edit:hover {
            background: rgba(245,158,11,0.2);
        }

        .td-btn--delete {
            background: rgba(239,68,68,0.08);
            color: #dc2626;
        }

        .td-btn--delete:hover {
            background: rgba(239,68,68,0.18);
        }

        .table-empty {
            text-align: center;
            padding: 50px 20px;
            color: var(--gray);
        }

        .table-empty__icon {
            font-size: 2.5rem;
            margin-bottom: 8px;
        }

        .table-empty h3 {
            font-size: 1rem;
            color: var(--dark);
            margin-bottom: 4px;
        }

        [data-theme="dark"] .table-empty h3 {
            color: #f1f5f9;
        }

        /* ===== FILTER BUTTONS ===== */
        .table-filters {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 6px 14px;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            border-radius: 50px;
            font-size: .78rem;
            font-weight: 600;
            color: var(--gray);
            cursor: pointer;
            transition: all .25s;
            font-family: inherit;
            white-space: nowrap;
        }

        [data-theme="dark"] .filter-btn {
            background: rgba(30,41,59,0.6);
            border-color: #334155;
            color: #94a3b8;
        }

        .filter-btn:hover {
            border-color: #0d9488;
            color: #0d9488;
        }

        .filter-btn--active {
            background: #0d9488 !important;
            border-color: #0d9488 !important;
            color: #fff !important;
        }

        /* ===== LOADING OVERLAY ===== */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        [data-theme="dark"] .loading-overlay {
            background: rgba(2,6,23,0.6);
        }

        .spinner {
            width: 36px;
            height: 36px;
            border: 3px solid #e2e8f0;
            border-top-color: #0d9488;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        .spinner--lg {
            width: 48px;
            height: 48px;
            border-width: 4px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar--open {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: flex;
            }

            .sidebar-overlay--show {
                display: block;
            }

            .admin-main {
                margin-left: 0;
                padding: 70px 16px 40px;
            }

            .admin-topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
                padding: 14px 18px;
            }

            .admin-topbar__title {
                font-size: 1.15rem;
            }

            .admin-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .a-stat {
                padding: 16px;
            }

            .a-stat__num {
                font-size: 1.4rem;
            }

            .table-card {
                padding: 16px;
            }

            .admin-table-wrapper {
                overflow-x: auto;
            }

            .admin-table {
                font-size: .82rem;
            }

            .admin-table td,
            .admin-table th {
                padding: 10px 10px;
            }

            .td-hanzi {
                font-size: 1.1rem;
            }
            
            .form-card {
                padding: 18px;
            }
        }

        @media (max-width: 480px) {
            .admin-stats {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* ===== Status badges ===== */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: .72rem;
            font-weight: 700;
        }

        .status-badge--pending {
            background: rgba(245,158,11,0.1);
            color: #d97706;
        }

        .status-badge--approved {
            background: rgba(16,185,129,0.1);
            color: #059669;
        }

        .status-badge--rejected {
            background: rgba(239,68,68,0.08);
            color: #dc2626;
        }

        .hsk-badge {
            display: inline-flex;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: .72rem;
            font-weight: 700;
        }

        .role-select, .status-select {
            padding: 5px 10px;
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            font-family: inherit;
            font-size: .82rem;
            background: #fff;
            cursor: pointer;
            transition: border-color .2s;
        }

        [data-theme="dark"] .role-select,
        [data-theme="dark"] .status-select {
            background: rgba(30,41,59,0.8);
            border-color: #334155;
            color: #e2e8f0;
        }

        [data-theme="dark"] .chart-card {
            background: rgba(30,41,59,0.6);
            border-color: rgba(255,255,255,0.04);
        }

        .rp-btn {
            padding: 5px 14px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: .8rem;
            cursor: pointer;
            transition: var(--transition);
        }
        .rp-btn:hover { opacity: .8; }
        .rp-btn--fix { background: rgba(16,185,129,0.12); color: #059669; }
        .rp-btn--del { background: rgba(239,68,68,0.08); color: #dc2626; }
        .rp-badge { display:inline-block; padding:2px 10px; border-radius:50px; font-size:.75rem; font-weight:600; }
        .rp-badge--pending { background:rgba(245,158,11,0.12); color:#d97706; }
        .rp-badge--fixed { background:rgba(16,185,129,0.12); color:#059669; }
        .rp-badge--dismissed { background:rgba(100,116,139,0.1); color:#64748b; }
        .td-btn--detail { background:rgba(59,130,246,0.08); color:#3b82f6; }
        .td-btn--detail:hover { background:rgba(59,130,246,0.2); }
        .td-btn--ban { background:rgba(239,68,68,0.08); color:#dc2626; }
        .td-btn--ban:hover { background:rgba(239,68,68,0.18); }
        .td-btn--ban.unban { background:rgba(16,185,129,0.08); color:#059669; }
        .td-btn--ban.unban:hover { background:rgba(16,185,129,0.18); }

        .admin-user-avatar { width:36px; height:36px; border-radius:10px; object-fit:cover; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .admin-user-avatar--init { background:linear-gradient(135deg,#0d9488,#14b8a6); color:#fff; font-weight:700; font-size:.8rem; line-height:36px; text-align:center; }
        .ud-stat { background:var(--gray-light); border-radius:12px; padding:14px; text-align:center; }
        .ud-stat__num { font-size:1.4rem; font-weight:800; color:var(--dark); }
        .ud-stat__label { font-size:.78rem; color:var(--gray); margin-top:4px; }
        .ud-hsk-item { display:flex; align-items:center; gap:8px; padding:6px 0; font-size:.85rem; border-bottom:1px solid var(--gray-light); }
        .ud-hsk-bar { flex:1; height:6px; background:var(--gray-light); border-radius:50px; overflow:hidden; }
        .ud-hsk-fill { height:100%; border-radius:50px; transition:width .4s ease; }
        .ud-quiz-item { padding:8px 12px; border-radius:10px; background:var(--gray-light); margin-bottom:6px; font-size:.82rem; display:flex; justify-content:space-between; align-items:center; }
        .ud-quiz-score { font-weight:700; }
        [data-theme="dark"] .ud-stat { background:rgba(30,41,59,0.5); }
        [data-theme="dark"] .ud-stat__num { color:#f1f5f9; }
        [data-theme="dark"] .ud-quiz-item { background:rgba(30,41,59,0.5); }
        [data-theme="dark"] .ud-hsk-item { border-color:rgba(255,255,255,0.04); }

        .role-select:focus,
        .status-select:focus {
            border-color: #0d9488;
            outline: none;
        }

        /* ===== Scrollbar ===== */
        .admin-sidebar__nav::-webkit-scrollbar {
            width: 3px;
        }

        .admin-sidebar__nav::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
        }

        .admin-main::-webkit-scrollbar {
            width: 4px;
        }

        .admin-main::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }
    </style>
    <script src="utils.js"></script>
</head>
<body class="admin-body">
    <!-- Mobile toggle -->
    <button class="sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-sidebar__brand">
            <div class="admin-sidebar__logo">H</div>
            <div class="admin-sidebar__brand-text">Hàn<span>Ngữ</span></div>
        </div>
        <nav class="admin-sidebar__nav" id="admin-tabs">
            <div class="admin-sidebar__label">Quản trị</div>
            <button class="admin-tab ripple" data-tab="dashboard"><i class="bi bi-grid-1x2-fill"></i> Dashboard</button>
            <button class="admin-tab admin-tab--active ripple" data-tab="vocab"><i class="bi bi-book-fill"></i> Từ vựng</button>
            <button class="admin-tab ripple" data-tab="lessons"><i class="bi bi-collection-fill"></i> Bài học</button>
            <button class="admin-tab ripple" data-tab="users"><i class="bi bi-people-fill"></i> Người dùng</button>
            <button class="admin-tab ripple" data-tab="posts"><i class="bi bi-chat-square-text-fill"></i> Bài viết</button>
            <button class="admin-tab ripple" data-tab="reports"><i class="bi bi-flag-fill"></i> Phản hồi</button>
        </nav>
        <div class="admin-sidebar__footer">
            <div class="admin-sidebar__user">
                <div class="admin-sidebar__avatar"><?php echo strtoupper(($_SESSION['display_name'] ?? $_SESSION['username'] ?? 'A')[0]); ?></div>
                <div>
                    <div class="admin-sidebar__name"><?php echo htmlspecialchars($_SESSION['display_name'] ?? $_SESSION['username'] ?? 'Admin'); ?></div>
                    <div class="admin-sidebar__role"><?php
                        $roleLabels = ['super_admin'=>'Super Admin', 'content_creator'=>'Content Creator', 'moderator'=>'Moderator'];
                        echo $roleLabels[$role] ?? $role;
                    ?></div>
                </div>
            </div>
            <button class="logout-btn" onclick="logout()"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </div>
    </aside>

    <!-- Loading -->
    <div class="loading-overlay" id="loading-overlay"><div class="spinner spinner--lg"></div></div>

    <!-- ===== MAIN ===== -->
    <main class="admin-main" id="adminMain">
        <div class="admin-topbar">
            <div class="admin-topbar__left">
                <div>
                    <div class="admin-topbar__breadcrumb">Quản trị / <span id="breadcrumbCurrent">Từ vựng</span></div>
                    <h1 class="admin-topbar__title" id="pageTitle">Quản lý từ vựng</h1>
                </div>
            </div>
            <div class="admin-topbar__actions">
                <span class="admin-topbar__time" id="clockDisplay"></span>
            </div>
        </div>

        <!-- ===== PANEL: DASHBOARD ===== -->
        <div class="admin-panel" id="panel-dashboard">
            <div class="admin-stats" id="stats-grid">
                <div class="a-stat a-stat--blue"><div class="a-stat__icon a-stat__icon--blue"><i class="bi bi-people-fill"></i></div><span class="a-stat__num" id="stat-users">0</span><span class="a-stat__label">Người dùng</span></div>
                <div class="a-stat a-stat--emerald"><div class="a-stat__icon a-stat__icon--emerald"><i class="bi bi-calendar-check-fill"></i></div><span class="a-stat__num" id="stat-today">0</span><span class="a-stat__label">Hôm nay</span></div>
                <div class="a-stat a-stat--teal"><div class="a-stat__icon a-stat__icon--teal"><i class="bi bi-book-fill"></i></div><span class="a-stat__num" id="stat-vocab-all">0</span><span class="a-stat__label">Từ vựng</span></div>
                <div class="a-stat a-stat--purple"><div class="a-stat__icon a-stat__icon--purple"><i class="bi bi-collection-fill"></i></div><span class="a-stat__num" id="stat-lessons-all">0</span><span class="a-stat__label">Bài học</span></div>
                <div class="a-stat a-stat--pink"><div class="a-stat__icon a-stat__icon--pink"><i class="bi bi-chat-square-text-fill"></i></div><span class="a-stat__num" id="stat-posts-all">0</span><span class="a-stat__label">Bài viết</span></div>
                <div class="a-stat a-stat--coral"><div class="a-stat__icon a-stat__icon--coral"><i class="bi bi-chat-dots-fill"></i></div><span class="a-stat__num" id="stat-comments-all">0</span><span class="a-stat__label">Bình luận</span></div>
                <div class="a-stat a-stat--amber"><div class="a-stat__icon a-stat__icon--amber"><i class="bi bi-hourglass-split"></i></div><span class="a-stat__num" id="stat-pending" style="color:#f59e0b">0</span><span class="a-stat__label">Chờ duyệt</span></div>
            </div>
            <div class="dashboard-charts">
                <div class="table-card chart-card">
                    <h3 class="table-card__title"><i class="bi bi-graph-up" style="color:#3b82f6"></i> Đăng ký 30 ngày</h3>
                    <canvas id="lineChart" height="220"></canvas>
                </div>
                <div class="table-card chart-card chart-card--sm">
                    <h3 class="table-card__title"><i class="bi bi-pie-chart-fill" style="color:#8b5cf6"></i> Trình độ HSK</h3>
                    <canvas id="pieChart" height="220"></canvas>
                </div>
            </div>
            <div class="dashboard-grid">
                <div class="table-card">
                    <h3 class="table-card__title"><i class="bi bi-hourglass-split" style="color:#f59e0b"></i> Bài viết chờ duyệt</h3>
                    <div id="pending-posts"></div>
                </div>
                <div class="table-card">
                    <h3 class="table-card__title"><i class="bi bi-chat-dots-fill" style="color:#3b82f6"></i> Bình luận gần đây</h3>
                    <div id="recent-comments"></div>
                </div>
            </div>
        </div>

        <!-- ===== PANEL: TỪ VỰNG ===== -->
        <div class="admin-panel admin-panel--active" id="panel-vocab">
            <div class="admin-stats">
                <div class="a-stat a-stat--teal"><div class="a-stat__icon a-stat__icon--teal"><i class="bi bi-book-fill"></i></div><span class="a-stat__num" id="stat-vocab-total">0</span><span class="a-stat__label">Tổng từ</span></div>
                <div class="a-stat a-stat--blue"><div class="a-stat__icon a-stat__icon--blue"><i class="bi bi-1-circle-fill"></i></div><span class="a-stat__num" id="stat-vocab-hsk1">0</span><span class="a-stat__label">HSK 1</span></div>
                <div class="a-stat a-stat--amber"><div class="a-stat__icon a-stat__icon--amber"><i class="bi bi-2-circle-fill"></i></div><span class="a-stat__num" id="stat-vocab-hsk2">0</span><span class="a-stat__label">HSK 2</span></div>
                <div class="a-stat a-stat--blue"><div class="a-stat__icon a-stat__icon--blue"><i class="bi bi-3-circle-fill"></i></div><span class="a-stat__num" id="stat-vocab-hsk3">0</span><span class="a-stat__label">HSK 3</span></div>
                <div class="a-stat a-stat--purple"><div class="a-stat__icon a-stat__icon--purple"><i class="bi bi-4-circle-fill"></i></div><span class="a-stat__num" id="stat-vocab-hsk4">0</span><span class="a-stat__label">HSK 4</span></div>
                <div class="a-stat a-stat--pink"><div class="a-stat__icon a-stat__icon--pink"><i class="bi bi-5-circle-fill"></i></div><span class="a-stat__num" id="stat-vocab-hsk5">0</span><span class="a-stat__label">HSK 5</span></div>
                <div class="a-stat a-stat--coral"><div class="a-stat__icon a-stat__icon--coral"><i class="bi bi-6-circle-fill"></i></div><span class="a-stat__num" id="stat-vocab-hsk6">0</span><span class="a-stat__label">HSK 6</span></div>
            </div>

            <div class="admin-layout">
                <div class="form-card">
                    <h3 class="form-card__title" id="vocab-form-title"><i class="bi bi-plus-circle-fill" style="color:#0d9488"></i> Thêm từ vựng</h3>
                    <div class="edit-indicator" id="vocab-edit-indicator">
                        <i class="bi bi-pencil-fill"></i> Đang chỉnh sửa <button id="vocab-cancel-edit">✕</button>
                    </div>
                    <form id="vocab-form">
                        <input type="hidden" id="inp-vocab-id">
                        <div class="fg">
                            <label>Chữ Hán <span style="color:#ef4444">*</span></label>
                            <input type="text" id="inp-hanzi" placeholder="VD: 你好" required>
                        </div>
                        <div class="fg">
                            <label>Pinyin <span style="color:#ef4444">*</span></label>
                            <input type="text" id="inp-pinyin" placeholder="nǐ hǎo" required>
                        </div>
                        <div class="fg">
                            <label>Nghĩa <span style="color:#ef4444">*</span></label>
                            <input type="text" id="inp-meaning" placeholder="Xin chào" required>
                        </div>
                        <div class="fg">
                            <label>HSK <span style="color:#ef4444">*</span></label>
                            <select id="inp-level" required>
                                <option value="">-- Chọn --</option>
                                <option value="1">HSK 1</option>
                                <option value="2">HSK 2</option>
                                <option value="3">HSK 3</option>
                                <option value="4">HSK 4</option>
                                <option value="5">HSK 5</option>
                                <option value="6">HSK 6</option>
                            </select>
                        </div>
                        <div class="fg">
                            <label>Bài học</label>
                            <select id="inp-lesson-id"></select>
                        </div>
                        <div class="fg">
                            <label>Số nét</label>
                            <input type="number" id="inp-strokes" min="1" max="50" placeholder="VD: 8">
                        </div>
                        <div class="fg">
                            <label>Bộ thủ</label>
                            <input type="text" id="inp-radical" placeholder="VD: 亻">
                        </div>
                        <div class="fg">
                            <label>Ví dụ</label>
                            <textarea id="inp-example" placeholder="你好吗？"></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn--outline ripple" id="vocab-btn-reset" style="flex:1"><i class="bi bi-arrow-counterclockwise"></i> Làm mới</button>
                            <button type="submit" class="btn btn--primary ripple" style="flex:1"><i class="bi bi-check-lg"></i> Lưu</button>
                        </div>
                    </form>
                </div>

                <div class="table-card">
                    <div class="table-card__header">
                        <h3 class="table-card__title"><i class="bi bi-list-columns-reverse" style="color:var(--teal)"></i> Danh sách từ vựng</h3>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
                            <button class="btn btn--sm btn--outline ripple" onclick="exportVocab()"><i class="bi bi-download"></i> Export CSV</button>
                            <button class="btn btn--sm btn--outline ripple" onclick="document.getElementById('importVocabInput').click()"><i class="bi bi-upload"></i> Import CSV</button>
                            <input type="file" id="importVocabInput" accept=".csv" style="display:none" onchange="importVocab(this)">
                            <button class="btn btn--sm btn--outline ripple" id="btn-populate-chardata"><i class="bi bi-arrow-repeat"></i> Cập nhật nét/bộ thủ</button>
                            <div class="table-filters" id="vocab-filters">
                                <button class="filter-btn filter-btn--active ripple" data-level="all">Tất cả</button>
                                <button class="filter-btn ripple" data-level="1">HSK 1</button>
                                <button class="filter-btn ripple" data-level="2">HSK 2</button>
                                <button class="filter-btn ripple" data-level="3">HSK 3</button>
                                <button class="filter-btn ripple" data-level="4">HSK 4</button>
                                <button class="filter-btn ripple" data-level="5">HSK 5</button>
                                <button class="filter-btn ripple" data-level="6">HSK 6</button>
                            </div>
                        </div>
                    </div>
                    <div class="admin-table-wrapper" id="vocab-table-container"></div>
                </div>
            </div>
        </div>

        <!-- ===== PANEL: BÀI HỌC ===== -->
        <div class="admin-panel" id="panel-lessons">
            <div class="admin-layout">
                <div class="form-card">
                    <h3 class="form-card__title" id="lesson-form-title"><i class="bi bi-plus-circle-fill" style="color:#8b5cf6"></i> Thêm bài học</h3>
                    <div class="edit-indicator" id="lesson-edit-indicator">
                        <i class="bi bi-pencil-fill"></i> Đang chỉnh sửa <button id="lesson-cancel-edit">✕</button>
                    </div>
                    <form id="lesson-form">
                        <input type="hidden" id="inp-lesson-id-form">
                        <div class="fg">
                            <label>Tiêu đề <span style="color:#ef4444">*</span></label>
                            <input type="text" id="inp-lesson-title" placeholder="Bài 1: Giới thiệu" required>
                        </div>
                        <div class="fg">
                            <label>HSK <span style="color:#ef4444">*</span></label>
                            <select id="inp-lesson-level" required>
                                <option value="">-- Chọn --</option>
                                <option value="1">HSK 1</option>
                                <option value="2">HSK 2</option>
                                <option value="3">HSK 3</option>
                                <option value="4">HSK 4</option>
                                <option value="5">HSK 5</option>
                                <option value="6">HSK 6</option>
                            </select>
                        </div>
                        <div class="fg">
                            <label>Số từ vựng</label>
                            <input type="number" id="inp-lesson-count" value="5" min="1" max="50">
                        </div>
                        <div class="fg">
                            <label>Mô tả</label>
                            <textarea id="inp-lesson-desc" placeholder="Giới thiệu về bản thân..."></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn--outline ripple" id="lesson-btn-reset" style="flex:1"><i class="bi bi-arrow-counterclockwise"></i> Làm mới</button>
                            <button type="submit" class="btn btn--primary ripple" style="flex:1"><i class="bi bi-check-lg"></i> Lưu</button>
                        </div>
                    </form>
                </div>

                <div class="table-card">
                    <div class="table-card__header">
                        <h3 class="table-card__title"><i class="bi bi-collection-fill" style="color:#8b5cf6"></i> Danh sách bài học</h3>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
                            <button class="btn btn--sm btn--outline ripple" onclick="exportLessons()"><i class="bi bi-download"></i> Export CSV</button>
                            <button class="btn btn--sm btn--outline ripple" onclick="document.getElementById('importLessonsInput').click()"><i class="bi bi-upload"></i> Import CSV</button>
                            <input type="file" id="importLessonsInput" accept=".csv" style="display:none" onchange="importLessons(this)">
                        </div>
                    </div>
                    <div id="lesson-table-container"></div>
                </div>
            </div>
        </div>

        <!-- ===== PANEL: NGƯỜI DÙNG ===== -->
        <div class="admin-panel" id="panel-users">
            <div class="table-card">
                <div class="table-card__header">
                    <h3 class="table-card__title"><i class="bi bi-people-fill" style="color:#3b82f6"></i> Danh sách người dùng</h3>
                </div>
                <div class="admin-table-wrapper" id="users-table-container"></div>
            </div>
            <div id="userDetailPanel" style="display:none;margin-top:16px">
                <div class="table-card">
                    <div class="table-card__header">
                        <h3 class="table-card__title"><i class="bi bi-person-fill" style="color:#3b82f6"></i> <span id="udName"></span></h3>
                        <button class="btn btn--sm btn--outline ripple" onclick="closeUserDetail()"><i class="bi bi-x-lg"></i> Đóng</button>
                    </div>
                    <div class="admin-stats" id="udStats" style="grid-template-columns:repeat(auto-fit,minmax(140px,1fr))"></div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:16px">
                        <div>
                            <h4 style="font-size:.9rem;font-weight:700;color:var(--dark-3);margin-bottom:10px"><i class="bi bi-bar-chart-fill" style="color:#8b5cf6"></i> HSK đã thi</h4>
                            <div id="udHsk"></div>
                        </div>
                        <div>
                            <h4 style="font-size:.9rem;font-weight:700;color:var(--dark-3);margin-bottom:10px"><i class="bi bi-clock-history" style="color:#f59e0b"></i> Bài kiểm tra gần đây</h4>
                            <div id="udQuizzes"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PANEL: BÀI VIẾT ===== -->
        <div class="admin-panel" id="panel-posts">
            <div class="table-card">
                <div class="table-card__header">
                    <h3 class="table-card__title"><i class="bi bi-chat-square-text-fill" style="color:#8b5cf6"></i> Quản lý bài viết</h3>
                    <div class="table-filters" id="post-filters">
                        <button class="filter-btn filter-btn--active ripple" data-status="all">Tất cả</button>
                        <button class="filter-btn ripple" data-status="pending" style="border-color:#f59e0b;color:#f59e0b">Chờ duyệt</button>
                        <button class="filter-btn ripple" data-status="approved" style="border-color:#3b82f6;color:#3b82f6">Đã duyệt</button>
                        <button class="filter-btn ripple" data-status="rejected" style="border-color:#ef4444;color:#ef4444">Từ chối</button>
                    </div>
                </div>
                <div class="admin-table-wrapper" id="posts-table-container"></div>
            </div>
            <div class="table-card" style="margin-top:20px">
                <div class="table-card__header">
                    <h3 class="table-card__title"><i class="bi bi-chat-dots-fill" style="color:#f97316"></i> Bình luận gần đây</h3>
                </div>
                <div class="admin-table-wrapper" id="comments-table-container"></div>
            </div>
        </div>

        <!-- ===== PANEL: PHẢN HỒI / BÁO LỖI ===== -->
        <div class="admin-panel" id="panel-reports">
            <div class="table-card">
                <div class="table-card__header">
                    <h3 class="table-card__title"><i class="bi bi-flag-fill" style="color:#f59e0b"></i> Báo lỗi từ vựng</h3>
                    <span style="font-size:.8rem;color:var(--gray);background:var(--gray-light);padding:4px 12px;border-radius:50px" id="reportCount">0 báo cáo</span>
                </div>
                <div class="admin-table-wrapper" id="reports-table-container"></div>
            </div>
        </div>
    </main>

    <script>
    const LO = document.getElementById('loading-overlay');
    function showLoading(){if(LO)LO.style.display='flex';}
    function hideLoading(){if(LO)LO.style.display='none';}
    document.addEventListener('DOMContentLoaded',hideLoading);
    window.addEventListener('load',hideLoading);

    // Clock
    function updateClock() {
        const now = new Date();
        const h = String(now.getHours()).padStart(2,'0');
        const m = String(now.getMinutes()).padStart(2,'0');
        const el = document.getElementById('clockDisplay');
        if (el) el.textContent = h + ':' + m;
    }
    updateClock();
    setInterval(updateClock, 30000);

    // Sidebar mobile toggle
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        sidebar.classList.toggle('admin-sidebar--open');
        overlay.classList.toggle('sidebar-overlay--show');
        const icon = this.querySelector('i');
        icon.className = sidebar.classList.contains('admin-sidebar--open') ? 'bi bi-x-lg' : 'bi bi-list';
    });
    overlay.addEventListener('click', function() {
        sidebar.classList.remove('admin-sidebar--open');
        this.classList.remove('sidebar-overlay--show');
        document.getElementById('sidebarToggle').querySelector('i').className = 'bi bi-list';
    });

    const pageTitles = {
        dashboard: 'Tổng quan',
        vocab: 'Quản lý từ vựng',
        lessons: 'Quản lý bài học',
        users: 'Quản lý người dùng',
        posts: 'Quản lý bài viết',
        reports: 'Phản hồi / Báo lỗi'
    };

    const breadcrumbLabels = {
        dashboard: 'Dashboard',
        vocab: 'Từ vựng',
        lessons: 'Bài học',
        users: 'Người dùng',
        posts: 'Bài viết',
        reports: 'Phản hồi'
    };

    const API_URL = 'api.php';
    const CURRENT_ROLE = '<?php echo $role; ?>';
    const ROLE_PERMS = {
        super_admin: ['dashboard', 'vocab', 'lessons', 'users', 'posts', 'reports'],
        content_creator: ['dashboard', 'vocab', 'lessons', 'posts', 'reports'],
        moderator: ['dashboard', 'posts', 'reports']
    };
    let vocabFilter = 'all';

    // Filter tabs by role
    (function initTabs() {
        const allowed = ROLE_PERMS[CURRENT_ROLE] || ['dashboard'];
        document.querySelectorAll('.admin-tab').forEach(tab => {
            if (!allowed.includes(tab.dataset.tab)) {
                tab.remove();
            }
        });
        // Activate first allowed tab
        const firstTab = document.querySelector('.admin-tab');
        if (firstTab) {
            document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('admin-tab--active'));
            firstTab.classList.add('admin-tab--active');
            document.querySelectorAll('.admin-panel').forEach(p => p.classList.remove('admin-panel--active'));
            const panel = document.getElementById('panel-' + firstTab.dataset.tab);
            if (panel) panel.classList.add('admin-panel--active');
            document.getElementById('pageTitle').textContent = pageTitles[firstTab.dataset.tab] || 'Quản trị';
            document.getElementById('breadcrumbCurrent').textContent = breadcrumbLabels[firstTab.dataset.tab] || 'Quản trị';
        }
    })();

    // Tab switching
    document.getElementById('admin-tabs').addEventListener('click', function(e) {
        const tab = e.target.closest('.admin-tab');
        if (!tab) return;
        this.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('admin-tab--active'));
        tab.classList.add('admin-tab--active');
        document.querySelectorAll('.admin-panel').forEach(p => p.classList.remove('admin-panel--active'));
        document.getElementById('panel-' + tab.dataset.tab).classList.add('admin-panel--active');
        document.getElementById('pageTitle').textContent = pageTitles[tab.dataset.tab] || 'Quản trị';
        document.getElementById('breadcrumbCurrent').textContent = breadcrumbLabels[tab.dataset.tab] || 'Quản trị';

        // Load data on tab switch (canvases must be visible for Chart.js)
        if (tab.dataset.tab === 'dashboard') loadDashboard();
        if (tab.dataset.tab === 'reports') loadReports();

        // Close sidebar on mobile
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('admin-sidebar--open');
            overlay.classList.remove('sidebar-overlay--show');
            document.getElementById('sidebarToggle').querySelector('i').className = 'bi bi-list';
        }
    });

    async function fetchAPI(action, data = null, method = 'GET') {
        try {
            let url = `${API_URL}?action=${action}`;
            let options = { method, headers: { 'Content-Type': 'application/json' } };
            if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
            else if (data) options.body = JSON.stringify(data);
            return await (await fetch(url, options)).json();
        } catch (e) { console.error(e); return null; }
    }

    // ============ VOCAB CRUD ============
    async function loadVocab() {
        const vocab = await fetchAPI('get_all_vocab');
        if (!vocab) return;
        const container = document.getElementById('vocab-table-container');
        document.getElementById('stat-vocab-total').textContent = vocab.length;
        document.getElementById('stat-vocab-hsk1').textContent = vocab.filter(v => v.level === 1).length;
        document.getElementById('stat-vocab-hsk2').textContent = vocab.filter(v => v.level === 2).length;
        document.getElementById('stat-vocab-hsk3').textContent = vocab.filter(v => v.level === 3).length;
        document.getElementById('stat-vocab-hsk4').textContent = vocab.filter(v => v.level === 4).length;
        document.getElementById('stat-vocab-hsk5').textContent = vocab.filter(v => v.level === 5).length;
        document.getElementById('stat-vocab-hsk6').textContent = vocab.filter(v => v.level === 6).length;

        const filtered = vocabFilter === 'all' ? vocab : vocab.filter(v => v.level === parseInt(vocabFilter));
        if (!filtered.length) {
            container.innerHTML = '<div class="table-empty"><div class="table-empty__icon">🔍</div><h3>Không có từ</h3></div>';
            return;
        }
        const hskColors = ['','#dbeafe','#fef3c7','#dbeafe','#f3e8ff','#fce7f3','#e0e7ff'];
        const hskTextColors = ['','#2563eb','#d97706','#2563eb','#9333ea','#db2777','#4338ca'];
        let html = '<table class="admin-table"><thead><tr><th>Hán tự</th><th>Pinyin</th><th>Nghĩa</th><th>HSK</th><th>Bài</th><th></th></tr></thead><tbody>';
        filtered.forEach(v => {
            html += `<tr>
                <td class="td-hanzi">${v.hanzi}</td>
                <td style="color:#0d9488;font-style:italic;font-weight:600">${v.pinyin}</td>
                <td>${v.meaning}</td>
                <td><span class="hsk-badge" style="background:${hskColors[v.level]||''};color:${hskTextColors[v.level]||''}">HSK ${v.level}</span></td>
                <td>${v.lesson_id || '-'}</td>
                <td>
                    <button class="td-btn td-btn--edit" data-id="${v.id}"><i class="bi bi-pencil-fill"></i></button>
                    <button class="td-btn td-btn--delete" data-id="${v.id}"><i class="bi bi-trash3-fill"></i></button>
                </td>
            </tr>`;
        });
        html += '</tbody></table>';
        container.innerHTML = html;

        container.querySelectorAll('.td-btn--edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const v = vocab.find(x => x.id === parseInt(btn.dataset.id));
                if (!v) return;
                document.getElementById('inp-vocab-id').value = v.id;
                document.getElementById('inp-hanzi').value = v.hanzi;
                document.getElementById('inp-pinyin').value = v.pinyin;
                document.getElementById('inp-meaning').value = v.meaning;
                document.getElementById('inp-level').value = v.level;
                document.getElementById('inp-strokes').value = v.strokes || '';
                document.getElementById('inp-radical').value = v.radical || '';
                document.getElementById('inp-example').value = v.example || '';
                if (document.getElementById('inp-lesson-id').querySelector(`option[value="${v.lesson_id}"]`)) {
                    document.getElementById('inp-lesson-id').value = v.lesson_id;
                }
                document.getElementById('vocab-edit-indicator').classList.add('show');
                document.getElementById('vocab-form-title').innerHTML = '<i class="bi bi-pencil-fill" style="color:#f59e0b"></i> Sửa từ vựng';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        container.querySelectorAll('.td-btn--delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(btn.dataset.id);
                showConfirm('Bạn có chắc muốn xóa từ vựng này?', 'Xóa từ vựng').then(function(r) {
                    if (r) {
                        fetchAPI('delete_vocab', { id }, 'GET').then(function() {
                            loadVocab();
                            showToast('Đã xóa!', 'success');
                        });
                    }
                });
            });
        });
    }

    document.getElementById('vocab-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const data = {
            id: document.getElementById('inp-vocab-id').value || null,
            hanzi: document.getElementById('inp-hanzi').value.trim(),
            pinyin: document.getElementById('inp-pinyin').value.trim(),
            meaning: document.getElementById('inp-meaning').value.trim(),
            level: parseInt(document.getElementById('inp-level').value),
            strokes: parseInt(document.getElementById('inp-strokes').value) || 0,
            radical: document.getElementById('inp-radical').value.trim(),
            example: document.getElementById('inp-example').value.trim(),
            lesson_id: parseInt(document.getElementById('inp-lesson-id').value) || null
        };
        const result = await fetchAPI('add_vocab', data, 'POST');
        if (result?.success) {
            showToast('✅ Đã lưu!', 'success');
            this.reset();
            document.getElementById('inp-vocab-id').value = '';
            document.getElementById('vocab-edit-indicator').classList.remove('show');
            document.getElementById('vocab-form-title').innerHTML = '<i class="bi bi-plus-circle-fill" style="color:#0d9488"></i> Thêm từ vựng';
            loadVocab();
        } else {
            showToast('⚠️ Lỗi!', 'error');
        }
    });

    document.getElementById('vocab-btn-reset').addEventListener('click', () => {
        document.getElementById('vocab-form').reset();
        document.getElementById('inp-vocab-id').value = '';
        document.getElementById('vocab-edit-indicator').classList.remove('show');
        document.getElementById('vocab-form-title').innerHTML = '<i class="bi bi-plus-circle-fill" style="color:#0d9488"></i> Thêm từ vựng';
    });
    document.getElementById('vocab-cancel-edit').addEventListener('click', () => document.getElementById('vocab-btn-reset').click());

    document.getElementById('vocab-filters').addEventListener('click', function(e) {
        const btn = e.target.closest('.filter-btn');
        if (!btn) return;
        vocabFilter = btn.dataset.level;
        this.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('filter-btn--active'));
        btn.classList.add('filter-btn--active');
        loadVocab();
    });

    // ============ LESSONS CRUD ============
    async function loadLessons() {
        const lessons = await fetchAPI('get_all_lessons');
        const container = document.getElementById('lesson-table-container');
        if (!lessons || !lessons.length) {
            container.innerHTML = '<div class="table-empty"><div class="table-empty__icon">📖</div><h3>Chưa có bài học</h3></div>';
            return;
        }
        const levelColors = ['#dbeafe','#fef3c7','#dbeafe','#f3e8ff','#fce7f3','#e0e7ff'];
        let html = '<table class="admin-table"><thead><tr><th>ID</th><th>Tiêu đề</th><th>HSK</th><th>Từ</th><th></th></tr></thead><tbody>';
        lessons.forEach(l => {
            html += `<tr>
                <td style="font-weight:600;color:var(--gray)">#${l.id}</td>
                <td><strong>${l.title}</strong></td>
                <td><span class="hsk-badge" style="background:${levelColors[l.level-1]};color:${['#2563eb','#d97706','#2563eb','#9333ea','#db2777','#4338ca'][l.level-1]}">HSK ${l.level}</span></td>
                <td>${l.vocab_count}</td>
                <td>
                    <button class="td-btn td-btn--edit" data-id="${l.id}"><i class="bi bi-pencil-fill"></i></button>
                    <button class="td-btn td-btn--delete" data-id="${l.id}"><i class="bi bi-trash3-fill"></i></button>
                </td>
            </tr>`;
        });
        html += '</tbody></table>';
        container.innerHTML = html;

        container.querySelectorAll('.td-btn--edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const l = lessons.find(x => x.id === parseInt(btn.dataset.id));
                if (!l) return;
                document.getElementById('inp-lesson-id-form').value = l.id;
                document.getElementById('inp-lesson-title').value = l.title;
                document.getElementById('inp-lesson-level').value = l.level;
                document.getElementById('inp-lesson-count').value = l.vocab_count;
                document.getElementById('inp-lesson-desc').value = l.description || '';
                document.getElementById('lesson-edit-indicator').classList.add('show');
                document.getElementById('lesson-form-title').innerHTML = '<i class="bi bi-pencil-fill" style="color:#f59e0b"></i> Sửa bài học';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        container.querySelectorAll('.td-btn--delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(btn.dataset.id);
                showConfirm('Bạn có chắc muốn xóa bài học này?', 'Xóa bài học').then(function(r) {
                    if (r) {
                        fetchAPI('delete_lesson', { id }, 'GET').then(function() {
                            loadLessons();
                            showToast('Đã xóa!', 'success');
                        });
                    }
                });
            });
        });

        const sel = document.getElementById('inp-lesson-id');
        sel.innerHTML = '<option value="">-- Không --</option>' + lessons.map(l => `<option value="${l.id}">HSK${l.level} - ${l.title}</option>`).join('');
    }

    document.getElementById('lesson-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const data = {
            id: document.getElementById('inp-lesson-id-form').value || null,
            title: document.getElementById('inp-lesson-title').value.trim(),
            level: parseInt(document.getElementById('inp-lesson-level').value),
            vocab_count: parseInt(document.getElementById('inp-lesson-count').value) || 0,
            description: document.getElementById('inp-lesson-desc').value.trim()
        };
        const result = await fetchAPI('add_lesson', data, 'POST');
        if (result?.success) {
            showToast('✅ Đã lưu!', 'success');
            this.reset();
            document.getElementById('inp-lesson-id-form').value = '';
            document.getElementById('lesson-edit-indicator').classList.remove('show');
            document.getElementById('lesson-form-title').innerHTML = '<i class="bi bi-plus-circle-fill" style="color:#8b5cf6"></i> Thêm bài học';
            loadLessons();
        } else {
            showToast('⚠️ Lỗi!', 'error');
        }
    });

    document.getElementById('lesson-btn-reset').addEventListener('click', () => {
        document.getElementById('lesson-form').reset();
        document.getElementById('inp-lesson-id-form').value = '';
        document.getElementById('lesson-edit-indicator').classList.remove('show');
        document.getElementById('lesson-form-title').innerHTML = '<i class="bi bi-plus-circle-fill" style="color:#8b5cf6"></i> Thêm bài học';
    });
    document.getElementById('lesson-cancel-edit').addEventListener('click', () => document.getElementById('lesson-btn-reset').click());

    // ============ USERS ============
    async function loadUsers() {
        const users = await fetchAPI('get_users');
        const container = document.getElementById('users-table-container');
        if (!users || !users.length) {
            container.innerHTML = '<div class="table-empty"><div class="table-empty__icon">👥</div><h3>Chưa có người dùng</h3></div>';
            return;
        }
        let html = '<table class="admin-table"><thead><tr><th>ID</th><th>Avatar</th><th>Username</th><th>Hiển thị</th><th>Email</th><th>Role</th><th>Từ</th><th>Quiz</th><th>Trạng thái</th><th>Ngày tạo</th><th></th></tr></thead><tbody>';
        users.forEach(u => {
            const isBanned = parseInt(u.banned || 0);
            const avatarHtml = u.avatar
                ? `<img src="${u.avatar}" class="admin-user-avatar" alt="">`
                : `<span class="admin-user-avatar admin-user-avatar--init">${(u.display_name || u.username)[0].toUpperCase()}</span>`;
            html += `<tr>
                <td style="font-weight:600;color:var(--gray)">#${u.id}</td>
                <td>${avatarHtml}</td>
                <td><strong>${u.username}</strong></td>
                <td>${u.display_name || '-'}</td>
                <td style="font-size:.85rem;color:var(--gray)">${u.email || '-'}</td>
                <td>
                    <select class="role-select" data-id="${u.id}" ${u.role==='super_admin'?'disabled':''}>
                        <option value="super_admin" ${u.role==='super_admin'?'selected':''}>Super Admin</option>
                        <option value="content_creator" ${u.role==='content_creator'?'selected':''}>Content Creator</option>
                        <option value="moderator" ${u.role==='moderator'?'selected':''}>Moderator</option>
                        <option value="user" ${u.role==='user'?'selected':''}>User</option>
                    </select>
                </td>
                <td>${u.vocab_count}</td>
                <td>${u.quiz_count}</td>
                <td><span class="status-badge ${isBanned ? 'status-badge--rejected' : 'status-badge--approved'}">${isBanned ? '🔒 Đã khoá' : '🔓 Hoạt động'}</span></td>
                <td style="font-size:.82rem;color:var(--gray)">${u.created_at}</td>
                <td style="white-space:nowrap">
                    <button class="td-btn td-btn--detail" data-id="${u.id}" onclick="showUserDetail(${u.id})"><i class="bi bi-eye-fill"></i></button>
                    ${u.role !== 'super_admin' ? `<button class="td-btn td-btn--ban" data-id="${u.id}" data-banned="${isBanned}"><i class="bi ${isBanned ? 'bi-unlock-fill' : 'bi-lock-fill'}"></i></button>` : ''}
                </td>
            </tr>`;
        });
        html += '</tbody></table>';
        container.innerHTML = html;
    }

    loadVocab();
    loadLessons();
    loadUsers();
    loadPosts();
    let lineChartInstance = null;
    let pieChartInstance = null;

    function renderCharts(data) {
        if (!data || !Array.isArray(data.registrations)) {
            console.warn('Chart data missing registrations:', data);
            data = data || {};
            data.registrations = [];
            for (let i = 29; i >= 0; i--) {
                const d = new Date();
                d.setDate(d.getDate() - i);
                data.registrations.push({ date: d.toISOString().slice(0,10), count: 0 });
            }
        }
        if (!data.hskDistribution || typeof data.hskDistribution !== 'object') {
            console.warn('Chart data missing hskDistribution:', data);
            data.hskDistribution = {1:0,2:0,3:0,4:0,5:0,6:0};
        }

        const lineCtx = document.getElementById('lineChart').getContext('2d');
        if (lineChartInstance) lineChartInstance.destroy();

        const labels = data.registrations.map(r => {
            const d = new Date(r.date + 'T00:00:00');
            return d.getDate() + '/' + (d.getMonth()+1);
        });
        const counts = data.registrations.map(r => r.count);

        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        const textColor = isDark ? '#94a3b8' : '#64748b';
        const gridColor = isDark ? 'rgba(255,255,255,0.04)' : 'rgba(0,0,0,0.06)';

        lineChartInstance = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Người dùng mới',
                    data: counts,
                    borderColor: '#3b82f6',
                    backgroundColor: isDark ? 'rgba(59,130,246,0.12)' : 'rgba(59,130,246,0.08)',
                    fill: true,
                    tension: 0.35,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { labels: { color: textColor, font: { size: 12 } } } },
                scales: {
                    x: { ticks: { color: textColor, font: { size: 10 }, maxTicksLimit: 10 }, grid: { color: gridColor } },
                    y: { ticks: { color: textColor, font: { size: 10 }, stepSize: 1 }, grid: { color: gridColor }, beginAtZero: true }
                }
            }
        });

        const pieCtx = document.getElementById('pieChart').getContext('2d');
        if (pieChartInstance) pieChartInstance.destroy();

        const pieLabels = ['HSK 1', 'HSK 2', 'HSK 3', 'HSK 4', 'HSK 5', 'HSK 6'];
        const pieData = data.hskDistribution;
        const colors = ['#3b82f6','#0d9488','#f59e0b','#8b5cf6','#ec4899','#ef4444'];

        pieChartInstance = new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: [pieData[1], pieData[2], pieData[3], pieData[4], pieData[5], pieData[6]],
                    backgroundColor: colors,
                    borderColor: isDark ? '#1e293b' : '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: textColor, font: { size: 11 }, padding: 8 }
                    }
                }
            }
        });
    }

    function showUserDetail(userId) {
        const panel = document.getElementById('userDetailPanel');
        panel.style.display = 'block';
        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        document.getElementById('udName').textContent = 'Đang tải...';
        fetchAPI('get_user_detail', { user_id: userId }).then(data => {
            if (!data || !data.success) { document.getElementById('udName').textContent = 'Lỗi tải dữ liệu'; return; }
            const u = data.user;
            document.getElementById('udName').textContent = (u.display_name || u.username) + ' (#' + u.id + ')';

            // Stats row
            document.getElementById('udStats').innerHTML = `
                <div class="ud-stat"><div class="ud-stat__num">HSK ${data.currentLevel}</div><div class="ud-stat__label">Trình độ hiện tại</div></div>
                <div class="ud-stat"><div class="ud-stat__num">${data.streak}</div><div class="ud-stat__label">Streak (ngày)</div></div>
                <div class="ud-stat"><div class="ud-stat__num">${data.vocabLearned}</div><div class="ud-stat__label">Từ đã học</div></div>
                <div class="ud-stat"><div class="ud-stat__num">${data.srsMastered}/${data.srsTotal}</div><div class="ud-stat__label">Flashcard thuộc/tổng</div></div>
                <div class="ud-stat"><div class="ud-stat__num" style="color:#f59e0b">${data.srsDue}</div><div class="ud-stat__label">Đang ôn tập</div></div>
            `;

            // HSK distribution bars
            const hskContainer = document.getElementById('udHsk');
            const dist = data.hskDistribution || [];
            const maxCnt = Math.max(...dist.map(d => d.cnt), 1);
            const colors = ['#3b82f6','#0d9488','#f59e0b','#8b5cf6','#ec4899','#ef4444'];
            hskContainer.innerHTML = dist.length ? dist.map(d => `
                <div class="ud-hsk-item">
                    <span style="font-weight:600;min-width:44px">HSK ${d.level}</span>
                    <div class="ud-hsk-bar"><div class="ud-hsk-fill" style="width:${(d.cnt/maxCnt*100)}%;background:${colors[d.level-1]||'#3b82f6'}"></div></div>
                    <span style="font-weight:600;min-width:24px;text-align:right">${d.cnt}</span>
                </div>
            `).join('') : '<div style="font-size:.85rem;color:var(--gray);padding:8px">Chưa có dữ liệu</div>';

            // Recent quizzes
            const quizContainer = document.getElementById('udQuizzes');
            const qz = data.recentQuizzes || [];
            quizContainer.innerHTML = qz.length ? qz.map(q => `
                <div class="ud-quiz-item">
                    <span>HSK ${q.level} — ${q.quiz_type || 'Quiz'}</span>
                    <span class="ud-quiz-score">${q.score}/${q.total_questions}</span>
                </div>
            `).join('') : '<div style="font-size:.85rem;color:var(--gray);padding:8px">Chưa có bài kiểm tra</div>';
        });
    }

    function closeUserDetail() {
        document.getElementById('userDetailPanel').style.display = 'none';
    }

    async function loadReports() {
        const reports = await fetchAPI('get_error_reports');
        const container = document.getElementById('reports-table-container');
        document.getElementById('reportCount').textContent = (reports ? reports.length : 0) + ' báo cáo';
        if (!reports || !reports.length) {
            container.innerHTML = '<div class="table-empty"><div class="table-empty__icon">🏁</div><h3>Chưa có báo lỗi nào</h3></div>';
            return;
        }
        let h = `<table class="admin-table"><thead><tr><th>Hán tự</th><th>Trường</th><th>Cũ → Mới</th><th>Người gửi</th><th>Trạng thái</th><th>Ngày</th><th></th></tr></thead><tbody>`;
        reports.forEach(r => {
            const statusLabel = { pending: 'Chờ xử lý', fixed: 'Đã sửa', dismissed: 'Đã bỏ qua' };
            h += `<tr>
                <td><strong style="font-family:'Noto Sans SC',sans-serif;font-size:1.1rem">${r.hanzi}</strong></td>
                <td>${r.field === 'pinyin' ? 'Pinyin' : 'Nghĩa'}</td>
                <td style="max-width:160px;font-size:.85rem">
                    <span style="color:var(--gray);text-decoration:line-through">${r.old_value || '—'}</span>
                    <i class="bi bi-arrow-right" style="color:var(--gray);margin:0 4px"></i>
                    <span style="color:#059669;font-weight:600">${r.new_value}</span>
                </td>
                <td style="font-size:.85rem">${r.reporter || 'Khách'}</td>
                <td><span class="rp-badge rp-badge--${r.status}">${statusLabel[r.status] || r.status}</span></td>
                <td style="font-size:.82rem;color:var(--gray)">${r.created_at}</td>
                <td style="white-space:nowrap">`;
            if (r.status === 'pending') {
                h += `<button class="rp-btn rp-btn--fix" data-id="${r.id}" data-vocab="${r.vocab_id}" data-field="${r.field}" data-value="${r.new_value.replace(/"/g,'&quot;')}"><i class="bi bi-check-lg"></i> Sửa</button> `;
            }
            if (CURRENT_ROLE === 'super_admin') {
                h += `<button class="rp-btn rp-btn--del" data-id="${r.id}"><i class="bi bi-trash3"></i> Xoá</button>`;
            }
            h += `</td></tr>`;
        });
        h += '</tbody></table>';
        container.innerHTML = h;

        container.querySelectorAll('.rp-btn--fix').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm('Cập nhật từ vựng và đánh dấu đã xử lý?')) return;
                const ok = await fetchAPI('fix_error_report', {
                    id: parseInt(this.dataset.id),
                    vocab_id: parseInt(this.dataset.vocab),
                    field: this.dataset.field,
                    new_value: this.dataset.value
                }, 'POST');
                showToast(ok && ok.success ? 'Đã cập nhật từ vựng!' : ok?.message || 'Lỗi!', ok?.success ? 'success' : 'error');
                loadReports();
                loadVocab();
            });
        });
        container.querySelectorAll('.rp-btn--del').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm('Xoá báo cáo này?')) return;
                await fetchAPI('delete_error_report', { id: parseInt(this.dataset.id) }, 'POST');
                showToast('Đã xoá!', 'success');
                loadReports();
            });
        });
    }

    // Load Dashboard only when tab is clicked (canvases need to be visible for Chart.js)
    // loadDashboard() is called in the tab click handler below

    document.getElementById('btn-populate-chardata').addEventListener('click', async function() {
        if (!confirm('Cập nhật số nét và bộ thủ cho tất cả từ vựng?')) return;
        this.innerHTML = '<i class="bi bi-arrow-repeat"></i> Đang cập nhật...';
        this.disabled = true;
        const result = await fetchAPI('populate_char_data', {}, 'GET');
        if (result && result.success) {
            showToast('Đã cập nhật ' + result.updated + ' từ!', 'success');
            loadVocab();
        } else {
            showToast('Lỗi khi cập nhật!', 'error');
        }
        this.innerHTML = '<i class="bi bi-arrow-repeat"></i> Cập nhật nét/bộ thủ';
        this.disabled = false;
    });

    let postFilter = 'all';

    async function loadDashboard() {
        const stats = await fetchAPI('get_admin_stats');
        if (!stats) return;
        document.getElementById('stat-users').textContent = stats.users;
        document.getElementById('stat-today').textContent = stats.todayUsers;
        document.getElementById('stat-vocab-all').textContent = stats.vocab;
        document.getElementById('stat-lessons-all').textContent = stats.lessons;
        document.getElementById('stat-posts-all').textContent = stats.posts;
        document.getElementById('stat-comments-all').textContent = stats.comments;
        document.getElementById('stat-pending').textContent = stats.pending;

        const chartData = await fetchAPI('get_admin_chart_data');
        try { if (chartData) renderCharts(chartData); else console.warn('chartData is null/undefined'); } catch(e) { console.error('Chart render error:', e, 'Data:', chartData); }

        const posts = await fetchAPI('get_all_posts');
        if (!posts) return;
        const pending = posts.filter(p => p.status === 'pending');
        const pc = document.getElementById('pending-posts');
        if (!pending.length) {
            pc.innerHTML = '<div class="table-empty"><div class="table-empty__icon">✅</div><h3>Không có bài chờ</h3></div>';
        } else {
            let h = '<table class="admin-table"><thead><tr><th>Tiêu đề</th><th>Tác giả</th><th></th></tr></thead><tbody>';
            pending.forEach(p => {
                h += `<tr><td><strong>${p.title}</strong></td><td>${p.author}</td>
                    <td style="white-space:nowrap">
                        <button class="td-btn" style="background:rgba(16,185,129,0.1);color:#059669" data-id="${p.id}" data-status="approved"><i class="bi bi-check-lg"></i></button>
                        <button class="td-btn" style="background:rgba(239,68,68,0.08);color:#dc2626" data-id="${p.id}" data-status="rejected"><i class="bi bi-x-lg"></i></button>
                    </td></tr>`;
            });
            h += '</tbody></table>';
            pc.innerHTML = h;
            pc.querySelectorAll('.td-btn').forEach(btn => {
                btn.addEventListener('click', async function() {
                    await fetchAPI('update_post_status', { id: parseInt(this.dataset.id), status: this.dataset.status }, 'POST');
                    showToast('Đã cập nhật!', 'success');
                    loadDashboard();
                    loadPosts();
                });
            });
        }

        const comments = await fetchAPI('get_all_comments');
        const cc = document.getElementById('recent-comments');
        if (!comments || !comments.length) {
            cc.innerHTML = '<div class="table-empty"><div class="table-empty__icon">💬</div><h3>Chưa có bình luận</h3></div>';
        } else {
            const recent = comments.slice(0, 5);
            let h = '<table class="admin-table"><thead><tr><th>Nội dung</th><th>Bài</th><th>Ngày</th></tr></thead><tbody>';
            recent.forEach(c => {
                h += `<tr><td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${c.content}</td>
                    <td style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${c.post_title||'-'}</td>
                    <td style="font-size:.82rem;color:var(--gray)">${c.created_at}</td></tr>`;
            });
            h += '</tbody></table>';
            cc.innerHTML = h;
        }
    }

    async function loadPosts() {
        const [posts, comments] = await Promise.all([
            fetchAPI('get_all_posts'),
            fetchAPI('get_all_comments')
        ]);
        const pc = document.getElementById('posts-table-container');
        if (!posts || !posts.length) {
            pc.innerHTML = '<div class="table-empty"><div class="table-empty__icon">📝</div><h3>Chưa có bài viết</h3></div>';
        } else {
            const filtered = postFilter === 'all' ? posts : posts.filter(p => p.status === postFilter);
            if (!filtered.length) {
                pc.innerHTML = '<div class="table-empty"><div class="table-empty__icon">🔍</div><h3>Không có bài viết</h3></div>';
                return;
            }
            let html = '<table class="admin-table"><thead><tr><th>Tiêu đề</th><th>Tác giả</th><th>Trạng thái</th><th>Thích</th><th>BL</th><th>Ngày</th><th></th></tr></thead><tbody>';
            filtered.forEach(p => {
                const statusLabels = { pending: '⏳ Chờ', approved: '✅ Đã duyệt', rejected: '❌ Từ chối' };
                html += `<tr>
                    <td><strong>${p.title}</strong></td>
                    <td>${p.author}</td>
                    <td><span class="status-badge status-badge--${p.status}">${statusLabels[p.status]||p.status}</span></td>
                    <td>${p.likes}</td>
                    <td>${p.comment_count || 0}</td>
                    <td style="font-size:.82rem;color:var(--gray)">${p.created_at}</td>
                    <td style="white-space:nowrap">
                        ${p.status === 'pending'
                            ? `<select class="status-select" data-id="${p.id}" style="padding:4px 8px;border-radius:6px;border:1px solid var(--gray-light);font-family:inherit;font-size:.82rem;">
                                <option value="pending" selected>⏳ Chờ</option>
                                <option value="approved">✅ Duyệt</option>
                                <option value="rejected">❌ Từ chối</option>
                               </select>`
                            : `<span style="font-size:.82rem;color:var(--gray)">${p.status === 'approved' ? '✅ Đã duyệt' : '❌ Đã từ chối'}</span>`
                        }
                        <button class="td-btn td-btn--delete" data-id="${p.id}"><i class="bi bi-trash3-fill"></i></button>
                    </td>
                </tr>`;
            });
            html += '</tbody></table>';
            pc.innerHTML = html;

            pc.querySelectorAll('.status-select').forEach(sel => {
                sel.addEventListener('change', async function() {
                    await fetchAPI('update_post_status', { id: parseInt(this.dataset.id), status: this.value }, 'POST');
                    showToast('Đã cập nhật!', 'success');
                    loadPosts();
                    loadDashboard();
                });
            });

            pc.querySelectorAll('.td-btn--delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    showConfirm('Bạn có chắc muốn xóa bài viết này?', 'Xóa bài viết').then(function(r) {
                        if (r) {
                            fetchAPI('delete_post', { id: btn.dataset.id }, 'GET').then(function() {
                                loadPosts();
                                loadDashboard();
                                showToast('Đã xóa!', 'success');
                            });
                        }
                    });
                });
            });
        }

        const cc = document.getElementById('comments-table-container');
        if (!comments || !comments.length) {
            cc.innerHTML = '<div class="table-empty"><div class="table-empty__icon">💬</div><h3>Chưa có bình luận</h3></div>';
        } else {
            let html = '<table class="admin-table"><thead><tr><th>Bài viết</th><th>Tác giả</th><th>Nội dung</th><th>Ngày</th><th></th></tr></thead><tbody>';
            comments.forEach(c => {
                html += `<tr>
                    <td style="max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${c.post_title || '-'}</td>
                    <td>${c.author}</td>
                    <td style="max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${c.content}</td>
                    <td style="font-size:.82rem;color:var(--gray)">${c.created_at}</td>
                    <td><button class="td-btn td-btn--delete" data-id="${c.id}"><i class="bi bi-trash3-fill"></i></button></td>
                </tr>`;
            });
            html += '</tbody></table>';
            cc.innerHTML = html;
            cc.querySelectorAll('.td-btn--delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    showConfirm('Bạn có chắc muốn xóa bình luận này?', 'Xóa bình luận').then(function(r) {
                        if (r) {
                            fetchAPI('delete_comment', { id: btn.dataset.id }, 'GET').then(function() {
                                loadPosts();
                                loadDashboard();
                                showToast('Đã xóa!', 'success');
                            });
                        }
                    });
                });
            });
        }
    }

    document.addEventListener('click', function(e) {
        if (e.target.closest('#post-filters')) {
            const btn = e.target.closest('.filter-btn');
            if (!btn) return;
            postFilter = btn.dataset.status;
            document.querySelectorAll('#post-filters .filter-btn').forEach(b => b.classList.remove('filter-btn--active'));
            btn.classList.add('filter-btn--active');
            loadPosts();
        }
    });

    document.getElementById('users-table-container').addEventListener('change', async function(e) {
        if (e.target.classList.contains('role-select')) {
            const id = e.target.dataset.id;
            const role = e.target.value;
            await fetchAPI('update_user_role', { id: parseInt(id), role }, 'POST');
            showToast('Đã cập nhật role!', 'success');
        }
    });

    document.getElementById('users-table-container').addEventListener('click', async function(e) {
        const btn = e.target.closest('.td-btn--ban');
        if (!btn) return;
        const id = parseInt(btn.dataset.id);
        const currentlyBanned = parseInt(btn.dataset.banned);
        const action = currentlyBanned ? 'mở khoá' : 'khoá';
        const confirmed = await showConfirm(`Bạn có chắc muốn ${action} tài khoản này?`, `${action === 'khoá' ? '🔒' : '🔓'} ${action === 'khoá' ? 'Khoá' : 'Mở khoá'} tài khoản`);
        if (!confirmed) return;
        const result = await fetchAPI('toggle_user_ban', { id }, 'POST');
        if (result?.success) {
            showToast(`Đã ${action} tài khoản!`, 'success');
            loadUsers();
        } else {
            showToast(result?.message || 'Lỗi!', 'error');
        }
    });

    document.querySelector('.dropdown__trigger')?.addEventListener('click', function(e) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle('dropdown__menu--open');
    });
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
        }
    });

    async function logout() {
        const result = await fetch('auth.php?action=logout', { method: 'POST' });
        if (result.ok) {
            window.location.href = 'login.php';
        } else {
            alert('Lỗi khi đăng xuất. Vui lòng thử lại.');
        }
    }

    // ===== EXPORT / IMPORT =====
    function exportVocab() {
        window.open(API_URL+'?action=export_vocab','_blank');
    }
    function exportLessons() {
        window.open(API_URL+'?action=export_lessons','_blank');
    }
    async function importVocab(input) {
        const file = input.files[0];
        if (!file) return;
        const form = new FormData();
        form.append('file', file);
        fetch(API_URL+'?action=import_vocab', { method:'POST', body:form })
            .then(r=>r.json()).then(res=>{
                if (res.success) {
                    showToast('Đã import '+res.count+' từ!','success');
                    loadVocab(); loadDashboard();
                } else {
                    showToast(res.message || 'Lỗi import','error');
                }
            }).catch(()=>showToast('Lỗi kết nối','error'));
        input.value = '';
    }
    async function importLessons(input) {
        const file = input.files[0];
        if (!file) return;
        const form = new FormData();
        form.append('file', file);
        fetch(API_URL+'?action=import_lessons', { method:'POST', body:form })
            .then(r=>r.json()).then(res=>{
                if (res.success) {
                    showToast('Đã import '+res.count+' bài học!','success');
                    loadLessons(); loadDashboard();
                } else {
                    showToast(res.message || 'Lỗi import','error');
                }
            }).catch(()=>showToast('Lỗi kết nối','error'));
        input.value = '';
    }
    </script>
</body>
</html>
