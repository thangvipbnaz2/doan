<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
// Kiểm tra role
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$isAdmin = $user && $user['role'] === 'admin';
if (!$isAdmin) {
    echo '<!DOCTYPE html><html><body style="font-family:sans-serif;display:flex;align-items:center;justify-content:center;min-height:100vh;background:#eff6ff"><div style="text-align:center;padding:40px;background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.08)"><h1 style="color:#dc2626">⛔ Truy cập bị từ chối</h1><p style="color:#64748b;margin:16px 0">Bạn không có quyền admin.</p><a href="index.php" style="display:inline-block;padding:12px 24px;background:#3b82f6;color:#fff;border-radius:10px;text-decoration:none;font-weight:600">Về trang chủ</a></div></body></html>';
    exit;
}
$userId = $_SESSION['user_id'];

// Auto-migrate: add status column if not exists
try {
    $conn->exec("ALTER TABLE posts ADD COLUMN status VARCHAR(20) DEFAULT 'pending' AFTER tags");
} catch (PDOException $e) {
    // Column already exists, ignore
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-page{padding:90px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafb,#eff6ff)}
        .admin-tabs{display:flex;gap:8px;margin-bottom:24px;background:#fff;border-radius:var(--radius);padding:8px;box-shadow:var(--shadow);overflow-x:auto}
        .admin-tab{padding:10px 24px;border-radius:var(--radius-sm);font-weight:600;font-size:.9rem;cursor:pointer;border:none;background:transparent;color:var(--gray);transition:var(--transition);white-space:nowrap;font-family:inherit}
        .admin-tab:hover{background:var(--teal-light);color:var(--teal-dark)}
        .admin-tab--active{background:var(--teal);color:#fff}
        .admin-tab--active:hover{background:var(--teal-dark);color:#fff}
        .admin-panel{display:none}
        .admin-panel--active{display:block}
        .admin-stats{display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap}
        .a-stat{text-align:center;padding:14px 22px;border-radius:var(--radius-sm);border:1px solid var(--gray-light);background:#fff;flex:1;min-width:100px}
        .a-stat__num{display:block;font-size:1.8rem;font-weight:900;color:var(--teal);line-height:1}
        .a-stat__label{font-size:.75rem;color:var(--gray);margin-top:2px}
        .admin-layout{display:grid;grid-template-columns:400px 1fr;gap:28px;align-items:start}
        @media(max-width:900px){.admin-layout{grid-template-columns:1fr}}
        .form-card{background:#fff;border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);position:sticky;top:80px}
        .form-card__title{font-size:1.15rem;font-weight:700;color:var(--dark);margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--gray-light)}
        .fg{margin-bottom:16px}
        .fg label{display:block;font-size:.85rem;font-weight:600;color:var(--dark-3);margin-bottom:6px}
        .fg input,.fg textarea,.fg select{width:100%;padding:12px 16px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.95rem;font-family:inherit;color:var(--dark);transition:var(--transition);background:#fafbfc}
        .fg input:focus,.fg textarea:focus,.fg select:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px rgba(13,148,136,.1);background:#fff}
        .fg textarea{resize:vertical;min-height:60px}
        .edit-indicator{display:none;padding:10px 16px;background:#fef3c7;border:1px solid var(--gold);border-radius:8px;margin-bottom:16px;font-size:.85rem;color:var(--gold-dark);font-weight:600;align-items:center;gap:8px}
        .edit-indicator.show{display:flex}
        .edit-indicator button{border:none;background:transparent;color:var(--gold-dark);cursor:pointer;font-weight:700;margin-left:auto;font-size:1rem}
        .form-actions{display:flex;gap:10px;margin-top:20px}
        .form-actions .btn{flex:1}
        .table-card{background:#fff;border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);overflow-x:auto}
        .table-card__header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px}
        .table-card__title{font-size:1.15rem;font-weight:700;color:var(--dark)}
        .admin-table{width:100%;border-collapse:collapse;font-size:.92rem}
        .admin-table th{text-align:left;padding:12px 14px;font-size:.78rem;text-transform:uppercase;letter-spacing:1px;color:var(--gray);border-bottom:2px solid var(--gray-light);font-weight:600}
        .admin-table td{padding:14px;border-bottom:1px solid var(--gray-light);vertical-align:middle}
        .admin-table tbody tr:hover{background:var(--teal-light)}
        .td-hanzi{font-family:'Noto Sans SC',sans-serif;font-size:1.5rem;font-weight:900}
        .td-btn{width:32px;height:32px;border:none;border-radius:8px;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:.9rem;transition:var(--transition);margin-right:4px}
        .td-btn--edit{background:var(--gold-light);color:var(--gold-dark)}
        .td-btn--edit:hover{background:var(--gold)}
        .td-btn--delete{background:var(--coral-light);color:var(--coral-dark)}
        .td-btn--delete:hover{background:var(--coral)}
        .table-empty{text-align:center;padding:60px 20px;color:var(--gray)}
        .table-empty__icon{font-size:3rem;margin-bottom:10px}

        .filter-btn{padding:6px 16px;border:2px solid var(--gray-light);background:#fff;border-radius:50px;font-size:.82rem;font-weight:600;color:var(--gray);cursor:pointer;transition:var(--transition);font-family:inherit}
        .filter-btn:hover{border-color:var(--teal);color:var(--teal)}
        .filter-btn--active{background:var(--teal);border-color:var(--teal);color:#fff}
        .table-filters{display:flex;gap:8px;flex-wrap:wrap}
        @media(max-width:768px){.admin-grid{grid-template-columns:1fr}.admin-tabs{flex-wrap:wrap;gap:6px}.admin-tab{flex:1;min-width:0;font-size:.82rem;padding:8px}.admin-table-wrapper{overflow-x:auto}.filter-group{flex-wrap:wrap}.a-stats{grid-template-columns:repeat(2,1fr)}}
    </style>
    <script src="utils.js"></script>
</head>
<body>
    <div class="loading-overlay" id="loading-overlay" style="display:none"><div class="spinner spinner--lg"></div></div>
    <main class="admin-page">
        <div class="container">
            <div class="admin-tabs" id="admin-tabs">
                <button class="admin-tab ripple" data-tab="dashboard">📊 Dashboard</button>
                <button class="admin-tab admin-tab--active ripple" data-tab="vocab">📚 Từ vựng</button>
                <button class="admin-tab ripple" data-tab="lessons">📖 Bài học</button>
                <button class="admin-tab ripple" data-tab="users">👥 Người dùng</button>
                <button class="admin-tab ripple" data-tab="posts">📝 Bài viết</button>
            </div>

            <!-- ===== PANEL: DASHBOARD ===== -->
            <div class="admin-panel" id="panel-dashboard">
                <div class="admin-stats" id="stats-grid">
                    <div class="a-stat"><span class="a-stat__num" id="stat-users">0</span><span class="a-stat__label">Người dùng</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-today">0</span><span class="a-stat__label">Hôm nay</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-all">0</span><span class="a-stat__label">Từ vựng</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-lessons-all">0</span><span class="a-stat__label">Bài học</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-posts-all">0</span><span class="a-stat__label">Bài viết</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-comments-all">0</span><span class="a-stat__label">Bình luận</span></div>
                    <div class="a-stat" style="border-color:#f59e0b"><span class="a-stat__num" id="stat-pending" style="color:#f59e0b">0</span><span class="a-stat__label">Chờ duyệt</span></div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                    <div class="table-card">
                        <h3 class="table-card__title" style="margin-bottom:16px">📝 Bài viết chờ duyệt</h3>
                        <div id="pending-posts"></div>
                    </div>
                    <div class="table-card">
                        <h3 class="table-card__title" style="margin-bottom:16px">💬 Bình luận gần đây</h3>
                        <div id="recent-comments"></div>
                    </div>
                </div>
            </div>

            <!-- ===== PANEL: TỪ VỰNG ===== -->
            <div class="admin-panel admin-panel--active" id="panel-vocab">
                <div class="admin-stats">
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-total">0</span><span class="a-stat__label">Tổng từ</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-hsk1">0</span><span class="a-stat__label">HSK 1</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-hsk2">0</span><span class="a-stat__label">HSK 2</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-hsk3">0</span><span class="a-stat__label">HSK 3</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-hsk4">0</span><span class="a-stat__label">HSK 4</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-hsk5">0</span><span class="a-stat__label">HSK 5</span></div>
                    <div class="a-stat"><span class="a-stat__num" id="stat-vocab-hsk6">0</span><span class="a-stat__label">HSK 6</span></div>
                </div>

                <div class="admin-layout">
                    <div class="form-card">
                        <h3 class="form-card__title" id="vocab-form-title">➕ Thêm từ vựng</h3>
                        <div class="edit-indicator" id="vocab-edit-indicator">
                            ✏️ Đang chỉnh sửa <button id="vocab-cancel-edit">✕</button>
                        </div>
                        <form id="vocab-form">
                            <input type="hidden" id="inp-vocab-id">
                            <div class="fg">
                                <label>Chữ Hán <span style="color:#ef4444">*</span></label>
                                <input type="text" id="inp-hanzi" placeholder="你" required>
                            </div>
                            <div class="fg">
                                <label>Pinyin <span style="color:#ef4444">*</span></label>
                                <input type="text" id="inp-pinyin" placeholder="nǐ" required>
                            </div>
                            <div class="fg">
                                <label>Nghĩa <span style="color:#ef4444">*</span></label>
                                <input type="text" id="inp-meaning" placeholder="Bạn" required>
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
                                <label>Bài học (lesson_id)</label>
                                <select id="inp-lesson-id"></select>
                            </div>
                            <div class="fg">
                                <label>Số nét</label>
                                <input type="number" id="inp-strokes" min="1" max="50">
                            </div>
                            <div class="fg">
                                <label>Bộ thủ</label>
                                <input type="text" id="inp-radical" placeholder="亻">
                            </div>
                            <div class="fg">
                                <label>Ví dụ</label>
                                <textarea id="inp-example" placeholder="你好！"></textarea>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn--reset ripple" id="vocab-btn-reset" style="background:var(--gray-light);color:var(--dark-3);flex:1;padding:12px;border:none;border-radius:var(--radius-sm);font-weight:600;cursor:pointer">↺ Làm mới</button>
                                <button type="submit" class="btn btn--primary ripple" style="flex:1">💾 Lưu</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-card">
                        <div class="table-card__header">
                            <h3 class="table-card__title">Danh sách từ vựng</h3>
                            <button class="btn btn--primary ripple" id="btn-populate-chardata" style="padding:8px 16px;border:none;border-radius:var(--radius-sm);font-weight:600;cursor:pointer;font-size:14px">Cập nhật số nét / bộ thủ</button>
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
                        <div id="vocab-table-container"></div>
                    </div>
                </div>
            </div>

            <!-- ===== PANEL: BÀI HỌC ===== -->
            <div class="admin-panel" id="panel-lessons">
                <div style="display:grid;grid-template-columns:400px 1fr;gap:28px;align-items:start">
                    <div class="form-card">
                        <h3 class="form-card__title" id="lesson-form-title">➕ Thêm bài học</h3>
                        <div class="edit-indicator" id="lesson-edit-indicator">
                            ✏️ Đang chỉnh sửa <button id="lesson-cancel-edit">✕</button>
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
                                <button type="button" class="btn btn--reset ripple" id="lesson-btn-reset" style="background:var(--gray-light);color:var(--dark-3);flex:1;padding:12px;border:none;border-radius:var(--radius-sm);font-weight:600;cursor:pointer">↺ Làm mới</button>
                                <button type="submit" class="btn btn--primary ripple" style="flex:1">💾 Lưu</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-card">
                        <div class="table-card__header">
                            <h3 class="table-card__title">Danh sách bài học</h3>
                        </div>
                        <div id="lesson-table-container"></div>
                    </div>
                </div>
            </div>

            <!-- ===== PANEL: NGƯỜI DÙNG ===== -->
            <div class="admin-panel" id="panel-users">
                <div class="table-card">
                    <div class="table-card__header">
                        <h3 class="table-card__title">Danh sách người dùng</h3>
                    </div>
                    <div id="users-table-container"></div>
                </div>
            </div>

            <!-- ===== PANEL: BÀI VIẾT ===== -->
            <div class="admin-panel" id="panel-posts">
                <div class="table-card">
                    <div class="table-card__header">
                        <h3 class="table-card__title">Quản lý bài viết</h3>
                        <div class="table-filters" id="post-filters">
                            <button class="filter-btn filter-btn--active ripple" data-status="all">Tất cả</button>
                            <button class="filter-btn ripple" data-status="pending" style="border-color:#f59e0b;color:#f59e0b">⏳ Chờ duyệt</button>
                            <button class="filter-btn ripple" data-status="approved" style="border-color:#3b82f6;color:#3b82f6">✅ Đã duyệt</button>
                            <button class="filter-btn ripple" data-status="rejected" style="border-color:#ef4444;color:#ef4444">❌ Từ chối</button>
                        </div>
                    </div>
                    <div id="posts-table-container"></div>
                </div>
                <div class="table-card" style="margin-top:20px">
                    <div class="table-card__header">
                        <h3 class="table-card__title">Bình luận gần đây</h3>
                    </div>
                    <div id="comments-table-container"></div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
    // Loading spinner
    const LO = document.getElementById('loading-overlay');
    function showLoading(){if(LO)LO.style.display='flex';}
    function hideLoading(){if(LO)LO.style.display='none';}
    // Auto-hide on load
    document.addEventListener('DOMContentLoaded',hideLoading);
    window.addEventListener('load',hideLoading);
    </script>

    <footer class="footer"><div class="footer__bottom"><div class="container"><p>&copy; 2026 HànNgữ.</p></div></div></footer>

    <script>
    const API_URL = 'api.php';
    let vocabFilter = 'all';

    // Tab switching
    document.getElementById('admin-tabs').addEventListener('click', function(e) {
        const tab = e.target.closest('.admin-tab');
        if (!tab) return;
        this.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('admin-tab--active'));
        tab.classList.add('admin-tab--active');
        document.querySelectorAll('.admin-panel').forEach(p => p.classList.remove('admin-panel--active'));
        document.getElementById('panel-' + tab.dataset.tab).classList.add('admin-panel--active');
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

    // Auth
    
    

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
        let html = '<table class="admin-table"><thead><tr><th>Hán tự</th><th>Pinyin</th><th>Nghĩa</th><th>HSK</th><th>Bài</th><th></th></tr></thead><tbody>';
        filtered.forEach(v => {
            html += `<tr>
                <td class="td-hanzi">${v.hanzi}</td>
                <td style="color:var(--teal);font-style:italic;font-weight:600">${v.pinyin}</td>
                <td>${v.meaning}</td>
                <td><span style="padding:3px 10px;border-radius:50px;font-size:.75rem;font-weight:700;background:${['','#dbeafe','#fef3c7','#dbeafe','#f3e8ff','#fce7f3','#e0e7ff'][v.level]};color:${['','#2563eb','#d97706','#2563eb','#9333ea','#db2777','#4338ca'][v.level]}">HSK ${v.level}</span></td>
                <td>${v.lesson_id || '-'}</td>
                <td>
                    <button class="td-btn td-btn--edit" data-id="${v.id}">✏️</button>
                    <button class="td-btn td-btn--delete" data-id="${v.id}">🗑️</button>
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
                document.getElementById('vocab-form-title').textContent = '✏️ Sửa từ vựng';
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
            document.getElementById('vocab-form-title').textContent = '➕ Thêm từ vựng';
            loadVocab();
        } else {
            showToast('⚠️ Lỗi!', 'error');
        }
    });

    document.getElementById('vocab-btn-reset').addEventListener('click', () => {
        document.getElementById('vocab-form').reset();
        document.getElementById('inp-vocab-id').value = '';
        document.getElementById('vocab-edit-indicator').classList.remove('show');
        document.getElementById('vocab-form-title').textContent = '➕ Thêm từ vựng';
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
        let html = '<table class="admin-table"><thead><tr><th>ID</th><th>Tiêu đề</th><th>HSK</th><th>Từ</th><th></th></tr></thead><tbody>';
        lessons.forEach(l => {
            html += `<tr>
                <td>${l.id}</td>
                <td><strong>${l.title}</strong></td>
                <td><span style="padding:3px 10px;border-radius:50px;font-size:.75rem;background:${['#dbeafe','#fef3c7','#dbeafe'][l.level-1]}">HSK ${l.level}</span></td>
                <td>${l.vocab_count}</td>
                <td>
                    <button class="td-btn td-btn--edit" data-id="${l.id}">✏️</button>
                    <button class="td-btn td-btn--delete" data-id="${l.id}">🗑️</button>
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
                document.getElementById('lesson-form-title').textContent = '✏️ Sửa bài học';
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

        // Update lesson select trong form vocab
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
            document.getElementById('lesson-form-title').textContent = '➕ Thêm bài học';
            loadLessons();
        } else {
            showToast('⚠️ Lỗi!', 'error');
        }
    });

    document.getElementById('lesson-btn-reset').addEventListener('click', () => {
        document.getElementById('lesson-form').reset();
        document.getElementById('inp-lesson-id-form').value = '';
        document.getElementById('lesson-edit-indicator').classList.remove('show');
        document.getElementById('lesson-form-title').textContent = '➕ Thêm bài học';
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
        let html = '<table class="admin-table"><thead><tr><th>ID</th><th>Username</th><th>Hiển thị</th><th>Email</th><th>Role</th><th>Từ</th><th>Quiz</th><th>Ngày tạo</th></tr></thead><tbody>';
        users.forEach(u => {
            html += `<tr>
                <td>${u.id}</td>
                <td><strong>${u.username}</strong></td>
                <td>${u.display_name || '-'}</td>
                <td>${u.email || '-'}</td>
                <td>
                    <select class="role-select" data-id="${u.id}" style="padding:4px 8px;border-radius:6px;border:1px solid var(--gray-light);font-family:inherit;font-size:.85rem;">
                        <option value="user" ${u.role==='user'?'selected':''}>user</option>
                        <option value="admin" ${u.role==='admin'?'selected':''}>admin</option>
                    </select>
                </td>
                <td>${u.vocab_count}</td>
                <td>${u.quiz_count}</td>
                <td style="font-size:.85rem;color:var(--gray)">${u.created_at}</td>
            </tr>`;
        });
        html += '</tbody></table>';
        container.innerHTML = html;
    }

    loadVocab();
    loadLessons();
    loadUsers();
    loadPosts();
    loadDashboard();

    // Populate char_data button
    document.getElementById('btn-populate-chardata').addEventListener('click', async function() {
        if (!confirm('Cập nhật số nét và bộ thủ cho tất cả từ vựng?')) return;
        this.textContent = '⏳ Đang cập nhật...';
        this.disabled = true;
        const result = await fetchAPI('populate_char_data', {}, 'GET');
        if (result && result.success) {
            showToast('Đã cập nhật ' + result.updated + ' từ!', 'success');
            loadVocab();
        } else {
            showToast('Lỗi khi cập nhật!', 'error');
        }
        this.textContent = 'Cập nhật số nét / bộ thủ';
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

        // Load pending posts for dashboard
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
                    <td>
                        <button class="td-btn" style="background:#dbeafe;color:#2563eb" data-id="${p.id}" data-status="approved">✅</button>
                        <button class="td-btn" style="background:#fee2e2;color:#dc2626" data-id="${p.id}" data-status="rejected">❌</button>
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

        // Load recent comments
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
                const statusColors = { pending: 'background:#fef3c7;color:#d97706', approved: 'background:#dbeafe;color:#2563eb', rejected: 'background:#fee2e2;color:#dc2626' };
                const statusLabels = { pending: '⏳ Chờ', approved: '✅', rejected: '❌' };
                html += `<tr>
                    <td><strong>${p.title}</strong> <span style="font-size:.75rem;padding:2px 8px;border-radius:50px;${statusColors[p.status]||''}">${statusLabels[p.status]||p.status}</span></td>
                    <td>${p.author}</td>
                    <td>
                        <select class="status-select" data-id="${p.id}" style="padding:4px 8px;border-radius:6px;border:1px solid var(--gray-light);font-family:inherit;font-size:.82rem;">
                            <option value="pending" ${p.status==='pending'?'selected':''}>⏳ Chờ</option>
                            <option value="approved" ${p.status==='approved'?'selected':''}>✅ Duyệt</option>
                            <option value="rejected" ${p.status==='rejected'?'selected':''}>❌ Từ chối</option>
                        </select>
                    </td>
                    <td>${p.likes}</td>
                    <td>${p.comment_count || 0}</td>
                    <td style="font-size:.82rem;color:var(--gray)">${p.created_at}</td>
                    <td><button class="td-btn td-btn--delete" data-id="${p.id}">🗑️</button></td>
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
                    <td><button class="td-btn td-btn--delete" data-id="${c.id}">🗑️</button></td>
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

    document.addEventListener('change', function(e) {
        if (e.target.closest('#post-filters')) {
            const btn = e.target.closest('.filter-btn');
            if (!btn) return;
            postFilter = btn.dataset.status;
            document.querySelectorAll('#post-filters .filter-btn').forEach(b => b.classList.remove('filter-btn--active'));
            btn.classList.add('filter-btn--active');
            loadPosts();
        }
    });

    // Add role change to users table
    document.getElementById('users-table-container').addEventListener('change', async function(e) {
        if (e.target.classList.contains('role-select')) {
            const id = e.target.dataset.id;
            const role = e.target.value;
            await fetchAPI('update_user_role', { id: parseInt(id), role }, 'POST');
            showToast('Đã cập nhật role!', 'success');
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
</script>

<script src="init.js"></script>
</body>
</html>
