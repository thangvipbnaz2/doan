<?php
session_start();
require 'db.php';

$userId = $_SESSION['user_id'] ?? 0;
$isLoggedIn = $userId > 0;

if ($isLoggedIn) {
    $lp = $conn->prepare("SELECT COUNT(*) as total, SUM(is_completed) as done FROM lesson_progress WHERE user_id = ?");
    $lp->execute([$userId]); $lpData = $lp->fetch();

    $vp = $conn->prepare("SELECT COUNT(*) as total, SUM(write_completed) as done FROM progress WHERE user_id = CONCAT('user_', ?)");
    $vp->execute([$userId]); $vpData = $vp->fetch();

    $st = $conn->prepare("SELECT COUNT(*) as streak_days, MAX(streak_date) as last_activity_date FROM daily_streak WHERE user_id = CONCAT('user_', ?)");
    $st->execute([$userId]); $streak = $st->fetch();

    $up = $conn->prepare("SELECT COALESCE(SUM(score), 0) as total_xp, 1 as level FROM quiz_results WHERE user_id = CONCAT('user_', ?)");
    $up->execute([$userId]); $prog = $up->fetch();

    $ac = $conn->prepare("SELECT COUNT(*) FROM achievements WHERE user_id = ?");
    $ac->execute([$userId]); $achCount = $ac->fetchColumn();

    $recent = $conn->prepare("SELECT lp.*, l.title as lesson_title FROM lesson_progress lp JOIN lessons l ON lp.lesson_id = l.id WHERE lp.user_id = ? ORDER BY lp.updated_at DESC LIMIT 5");
    $recent->execute([$userId]); $recentActivity = $recent->fetchAll();

    $totLessons = $conn->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
    $totVocab = $conn->query("SELECT COUNT(*) FROM vocab")->fetchColumn();

    $nextLesson = $conn->prepare("SELECT id, title, level, lesson_num FROM lessons WHERE id NOT IN (SELECT lesson_id FROM lesson_progress WHERE user_id = ? AND is_completed = 1) ORDER BY level, lesson_num LIMIT 1");
    $nextLesson->execute([$userId]); $next = $nextLesson->fetch();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Học tiếng Trung trực tuyến miễn phí - Lộ trình HSK 1 đến HSK 6 dành cho người Việt.">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#0d9488">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="keywords" content="học tiếng trung, học tiếng trung online, hsk, hán ngữ, luyện thi hsk, tự học tiếng trung, tiếng trung giao tiếp">
    <meta name="author" content="HànNgữ">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://hanngu.vn">
    <meta property="og:title" content="HànNgữ - Học Tiếng Trung Cho Người Việt">
    <meta property="og:description" content="Học tiếng Trung trực tuyến miễn phí - Lộ trình HSK 1 đến HSK 6 dành cho người Việt.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://hanngu.vn">
    <meta property="og:image" content="https://hanngu.vn/favicon.svg">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:site_name" content="HànNgữ">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="HànNgữ - Học Tiếng Trung Cho Người Việt">
    <meta name="twitter:description" content="Học tiếng Trung trực tuyến miễn phí - Lộ trình HSK 1 đến HSK 6 dành cho người Việt.">
    <meta name="twitter:image" content="https://hanngu.vn/favicon.svg">
    <title><?= $isLoggedIn ? 'Trang chủ - HànNgữ' : 'HànNgữ - Học Tiếng Trung Cho Người Việt' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
<style>
.dash-wrap{max-width:1100px;margin:auto;padding:105px 24px 64px}
.greeting{font-size:1.5rem;font-weight:700;margin-bottom:4px}
.greeting-sub{color:var(--gray,#64748b);margin-bottom:24px}
.dash-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(155px,1fr));gap:14px;margin-bottom:28px}
.dash-card{border-radius:16px;padding:20px;color:#fff}
.dash-card__num{font-size:1.8rem;font-weight:800;line-height:1.2}
.dash-card__label{font-size:.78rem;opacity:.85;margin-top:3px}
.dash-two{display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:24px}
.dash-panel{background:var(--white,#fff);border-radius:16px;padding:22px;box-shadow:0 4px 20px rgba(0,0,0,.06);border:1px solid #eef2f7}
.dash-panel h3{font-size:.95rem;font-weight:700;margin-bottom:14px;color:var(--dark,#0f172a)}
.dash-panel__action{display:block;padding:14px;border-radius:10px;background:#f0fdfa;color:#0f766e;text-decoration:none;font-weight:600;text-align:center;margin-top:12px;transition:.2s;border:1px solid #ccfbf1}
.dash-panel__action:hover{background:#ccfbf1}
.activity-item{display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid #f1f5f9}
.activity-item:last-child{border:0}
.activity-item__icon{width:36px;height:36px;border-radius:50%;background:#f0fdfa;display:grid;place-items:center;color:#0d9488;flex:none;font-size:1.1rem}
.activity-item__title{font-weight:500;font-size:.88rem;color:var(--dark,#0f172a)}
.activity-item__meta{font-size:.78rem;color:var(--gray,#64748b)}
.quick-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.quick-btn{display:flex;align-items:center;gap:10px;padding:14px;border-radius:12px;border:1px solid #e2e8f0;background:#fff;cursor:pointer;text-decoration:none;color:var(--dark,#0f172a);font-weight:500;font-size:.85rem;transition:.2s}
.quick-btn:hover{border-color:#0d9488;background:#f0fdfa}
.quick-btn__icon{width:36px;height:36px;border-radius:10px;display:grid;place-items:center;font-size:1.1rem}
@media(max-width:720px){.dash-two{grid-template-columns:1fr}.quick-grid{grid-template-columns:1fr}}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>

<?php if ($isLoggedIn): ?>
<main class="dash-wrap">
  <div class="greeting">Xin chào, <?= htmlspecialchars($_SESSION['display_name']??$_SESSION['username']??'') ?>! 👋</div>
  <div class="greeting-sub">Hãy tiếp tục hành trình học tiếng Trung của bạn.</div>

  <div class="dash-grid">
    <div class="dash-card" style="background:linear-gradient(135deg,#0d9488,#0f766e)">
      <div class="dash-card__num"><?= (int)($lpData['done']??0) ?><small style="font-size:.85rem;opacity:.7">/<?= $totLessons ?></small></div>
      <div class="dash-card__label">Bài học đã hoàn thành</div>
    </div>
    <div class="dash-card" style="background:linear-gradient(135deg,#f97316,#ea580c)">
      <div class="dash-card__num"><?= (int)($vpData['done']??0) ?><small style="font-size:.85rem;opacity:.7">/<?= $totVocab ?></small></div>
      <div class="dash-card__label">Từ vựng đã học</div>
    </div>
    <div class="dash-card" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed)">
      <div class="dash-card__num"><?= (int)($prog['total_xp']??0) ?></div>
      <div class="dash-card__label">Tổng XP</div>
    </div>
    <div class="dash-card" style="background:linear-gradient(135deg,#10b981,#047857)">
      <div class="dash-card__num"><?= (int)($streak['streak_days']??0) ?></div>
      <div class="dash-card__label">Streak (ngày)</div>
    </div>
    <div class="dash-card" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">
      <div class="dash-card__num"><?= (int)$achCount ?></div>
      <div class="dash-card__label">Huy hiệu</div>
    </div>
  </div>

  <div class="dash-two">
    <div class="dash-panel">
      <h3>Hoạt động gần đây</h3>
      <?php if (!empty($recentActivity)): ?>
        <?php foreach ($recentActivity as $a): ?>
        <div class="activity-item">
          <div class="activity-item__icon"><?= $a['is_completed'] ? '✓' : '○' ?></div>
          <div>
            <div class="activity-item__title"><?= htmlspecialchars($a['lesson_title']) ?></div>
            <div class="activity-item__meta"><?= $a['is_completed'] ? 'Đã hoàn thành' : 'Đang học' ?> · <?= date('d/m/Y', strtotime($a['updated_at'])) ?></div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
      <p style="color:var(--gray,#64748b);text-align:center;padding:20px">Chưa có hoạt động. Hãy bắt đầu học ngay!</p>
      <?php endif; ?>
      <a href="study_stats.php" class="dash-panel__action">Xem thống kê chi tiết</a>
    </div>

    <div class="dash-panel">
      <h3>Bắt đầu nhanh</h3>
      <div class="quick-grid">
        <?php if ($next): ?>
        <a href="lesson_view.php?id=<?= $next['id'] ?>" class="quick-btn">
          <div class="quick-btn__icon" style="background:#ccfbf1">📖</div>
          <span>Bài tiếp<br><small style="color:var(--gray,#64748b);font-weight:400">HSK <?= $next['level'] ?> · <?= htmlspecialchars($next['title']) ?></small></span>
        </a>
        <?php endif; ?>
        <a href="daily_challenge.php" class="quick-btn">
          <div class="quick-btn__icon" style="background:#ffedd5">🎯</div>
          <span>Thử thách<br><small style="color:var(--gray,#64748b);font-weight:400">5 từ mỗi ngày</small></span>
        </a>
        <a href="flashcard_srs.php" class="quick-btn">
          <div class="quick-btn__icon" style="background:#f3e8ff">🃏</div>
          <span>SRS Flashcard<br><small style="color:var(--gray,#64748b);font-weight:400">Ôn tập thông minh</small></span>
        </a>
        <a href="exam_mvc.php" class="quick-btn">
          <div class="quick-btn__icon" style="background:#dbeafe">📝</div>
          <span>Thi thử HSK<br><small style="color:var(--gray,#64748b);font-weight:400">Đề thi mô phỏng</small></span>
        </a>
        <a href="hanzi_writing.php" class="quick-btn">
          <div class="quick-btn__icon" style="background:#fce7f3">✍️</div>
          <span>Luyện viết<br><small style="color:var(--gray,#64748b);font-weight:400">Chữ Hán trên canvas</small></span>
        </a>
        <a href="lessons.php" class="quick-btn">
          <div class="quick-btn__icon" style="background:#dcfce7">📚</div>
          <span>Danh sách bài<br><small style="color:var(--gray,#64748b);font-weight:400">HSK 1-6</small></span>
        </a>
      </div>
    </div>
  </div>

  <div style="margin-top:8px;display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
    <a href="lessons.php" class="btn btn--primary" style="padding:10px 24px">Học bài mới</a>
    <a href="profile.php" class="btn btn--outline" style="padding:10px 24px">Hồ sơ</a>
  </div>
</main>

<?php else: ?>
<!-- ===== MARKETING PAGE FOR GUESTS ===== -->
    <header class="hero" id="hero">
        <div class="hero__bg-shapes">
            <div class="shape shape--1"></div>
            <div class="shape shape--2"></div>
            <div class="shape shape--3"></div>
        </div>
        <div class="container hero__content">
            <div class="hero__text">
                <span class="hero__badge">Miễn phí — bắt đầu ngay hôm nay</span>
                <h1 class="hero__title">
                    Học tiếng Trung mỗi ngày,<br>
                    <span class="text-gradient">không áp lực</span>
                </h1>
                <p class="hero__desc">
                    Lộ trình HSK 1 đến HSK 6 thiết kế riêng cho người Việt.
                    Học qua flashcard, luyện phát âm, thi thử — tất cả miễn phí.
                </p>
                <div class="hero__actions">
                    <a href="register.php" class="btn btn--primary" id="hero-cta">Bắt đầu học ngay</a>
                    <a href="courses.php" class="btn btn--outline">Khóa học miễn phí</a>
                </div>
                    <div class="hero__stats">
                    <div class="stat">
                        <span class="stat__number" id="stat-vocab">0</span>
                        <span class="stat__label">Từ vựng</span>
                    </div>
                    <div class="stat">
                        <span class="stat__number" id="stat-lessons">0</span>
                        <span class="stat__label">Bài học</span>
                    </div>
                </div>
                </div>
            </div>
            <div class="hero__visual">
                <div class="hero__card-stack">
                    <div class="hero__card hero__card--back">
                        <span class="hanzi">学</span>
                        <span class="pinyin">xué</span>
                        <span class="meaning">Học</span>
                    </div>
                    <div class="hero__card hero__card--mid">
                        <span class="hanzi">中</span>
                        <span class="pinyin">zhōng</span>
                        <span class="meaning">Trung</span>
                    </div>
                    <div class="hero__card hero__card--front">
                        <span class="hanzi">你好</span>
                        <span class="pinyin">nǐ hǎo</span>
                        <span class="meaning">Xin chào</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-header__tag">Tại sao chọn HànNgữ?</span>
                <h2 class="section-header__title">Học tiếng Trung <span class="text-gradient">chủ động, không nhàm chán</span></h2>
            </div>
            <div class="features__grid">
                <div class="feature-card">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Học qua flashcard thông minh</h3>
                    <p class="feature-card__desc">Lật thẻ, đoán nghĩa, hệ thống tự động lặp lại từ bạn hay quên — nhớ từ vựng lâu hơn nhờ spaced repetition.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Lộ trình từ mất gốc đến HSK 6</h3>
                    <p class="feature-card__desc">150 từ vựng HSK 1 đến 5000+ từ HSK 6, mỗi cấp độ có bài giảng, bài tập, đề thi thử riêng theo đúng chuẩn.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Luyện đủ bốn kỹ năng</h3>
                    <p class="feature-card__desc">Nghe — Nói — Đọc — Viết với bài tập tương tác, ghi âm phát âm so sánh với người bản xứ, và đề thi thử HSK có chấm điểm.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Thi đấu PvP & bảng xếp hạng</h3>
                    <p class="feature-card__desc">Đấu trực tiếp với bạn bè qua câu hỏi từ vựng, ngữ pháp. Leo bảng xếp hạng tuần, nhận huy hiệu thành tích.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="paid-courses">
        <div class="container">
            <div class="section-header">
                <span class="section-header__tag">Khóa học có hướng dẫn</span>
                <h2 class="section-header__title">Khóa học miễn phí, <span class="text-gradient">đăng ký học ngay</span></h2>
                <p class="section-header__desc">Tất cả khóa học đều miễn phí. Đăng ký tài khoản và bắt đầu học ngay lập tức, không cần thanh toán.</p>
                <a href="courses.php" class="btn btn--primary">Xem các khóa học</a>
            </div>
        </div>
    </section>

    <section class="roadmap" id="roadmap">
        <div class="container">
            <div class="section-header">
                <span class="section-header__tag">Lộ trình học tập</span>
                <h2 class="section-header__title">Từ chưa biết chữ đến <span class="text-gradient">HSK 6</span></h2>
                <p class="section-header__desc">Mỗi cấp độ gồm bài giảng, flashcard, bài tập và đề thi thử — đủ để bạn tự học không cần giáo viên.</p>
            </div>
            <div class="roadmap__grid">
                <?php
                $hskLevels = [
                    1 => ['title'=>'Nền tảng vững chắc','sub'=>'Người mới bắt đầu','color'=>'btn--primary','features'=>['150 từ vựng cơ bản','Hệ thống Pinyin đầy đủ','40 mẫu câu giao tiếp','Nét chữ cơ bản','Chào hỏi & giới thiệu'],'lessons'=>60],
                    2 => ['title'=>'Giao tiếp cơ bản','sub'=>'Đã có nền tảng','color'=>'btn--gold','features'=>['300 từ vựng mở rộng','Ngữ pháp câu phức','80 mẫu câu nâng cao','Đọc hiểu đoạn văn ngắn','Hội thoại thường ngày'],'lessons'=>65],
                    3 => ['title'=>'Thành thạo giao tiếp','sub'=>'Muốn nâng cao','color'=>'btn--primary','features'=>['600 từ vựng chuyên sâu','Ngữ pháp nâng cao','Viết luận ngắn','Nghe hội thoại tự nhiên','Đề thi mô phỏng HSK 3'],'lessons'=>55],
                    4 => ['title'=>'Giao tiếp linh hoạt','sub'=>'Giao tiếp tự nhiên','color'=>'btn--primary','features'=>['1,200 từ vựng nâng cao','Ngữ pháp phức tạp','Đọc bài báo ngắn','Viết đoạn văn dài','Đề thi mô phỏng HSK 4'],'lessons'=>10],
                    5 => ['title'=>'Đọc báo & tin tức','sub'=>'Trình độ cao','color'=>'btn--primary','features'=>['2,500 từ vựng toàn diện','Ngữ pháp thành ngữ','Đọc văn bản dài','Viết luận học thuật','Đề thi mô phỏng HSK 5'],'lessons'=>10],
                    6 => ['title'=>'Thông thạo tiếng Trung','sub'=>'Trình độ bản ngữ','color'=>'btn--primary','features'=>['5,000+ từ vựng','Thành ngữ & tục ngữ','Đọc hiểu văn học','Viết luận chuyên sâu','Đề thi mô phỏng HSK 6'],'lessons'=>10],
                ];
                foreach ($hskLevels as $l => $info): ?>
                <div class="hsk-card hsk-card--<?= $l ?>">
                    <div class="hsk-card__header">
                        <div class="hsk-card__level">
                            <span class="hsk-card__badge">HSK</span>
                            <span class="hsk-card__number"><?= $l ?></span>
                        </div>
                        <h3 class="hsk-card__title"><?= $info['title'] ?></h3>
                        <p class="hsk-card__subtitle"><?= $info['sub'] ?></p>
                    </div>
                    <div class="hsk-card__body">
                        <ul class="hsk-card__features">
                            <?php foreach ($info['features'] as $f): ?>
                            <li><span class="check">✓</span><span><?= $f ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="hsk-card__footer">
                        <a href="lessons.php?level=<?= $l ?>" class="btn <?= $info['color'] ?> btn--block">Bắt đầu HSK <?= $l ?></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="cta" id="cta">
        <div class="container cta__inner">
            <div class="cta__content">
                <h2 class="cta__title">Bắt đầu ngay — <span class="text-gradient">hoàn toàn miễn phí</span></h2>
                <p class="cta__desc">Tham gia cộng đồng hơn 10,000 người đang chinh phục tiếng Trung mỗi ngày.</p>
                <a href="register.php" class="btn btn--gold btn--lg" id="cta-button">Học miễn phí ngay</a>
            </div>
            <div class="cta__characters">
                <span class="float-char float-char--1">你</span>
                <span class="float-char float-char--2">好</span>
                <span class="float-char float-char--3">学</span>
                <span class="float-char float-char--4">中</span>
                <span class="float-char float-char--5">文</span>
            </div>
        </div>
    </section>

    <footer class="footer" id="footer">
        <div class="container footer__inner">
            <div class="footer__brand">
                <span class="logo__icon">汉</span>
                <span class="logo__text">HànNgữ</span>
                <p class="footer__tagline">Nền tảng học tiếng Trung trực tuyến hàng đầu dành cho người Việt.</p>
            </div>
            <div class="footer__links">
                <div class="footer__col">
                    <h4>Khám phá</h4>
                    <ul>
                        <li><a href="#roadmap">Lộ trình HSK</a></li>
                        <li><a href="notebook.php">Sổ tay từ vựng</a></li>
                        <li><a href="practice.php">Bài tập luyện</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Cộng đồng</h4>
                    <ul>
                        <li><a href="community.php">Diễn đàn</a></li>
                        <li><a href="pvp.php">PvP</a></li>
                        <li><a href="leaderboard.php">BXH</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Hỗ trợ</h4>
                    <ul>
                        <li><a href="login.php">Đăng nhập</a></li>
                        <li><a href="register.php">Đăng ký</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <p>&copy; 2026 HànNgữ. Cùng nhau học tiếng Trung mỗi ngày.</p>
            </div>
        </div>
    </footer>

    <script>
    fetch('api.php?action=get_stats').then(r=>r.json()).then(d=>{
        if(d && d.total) {
            document.getElementById('stat-vocab').textContent = d.total;
            document.getElementById('stat-lessons').textContent = [1,2,3,4,5,6].reduce((s,i)=>s+parseInt(d['hsk'+i]||0),0);
        }
    }).catch(()=>{});
    </script>
<?php endif; ?>

<script>
const observerOptions = {threshold:0.1,rootMargin:'0px 0px -50px 0px'};
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('animate-in'); });
}, observerOptions);
document.querySelectorAll('.feature-card, .hsk-card, .section-header').forEach(el => observer.observe(el));

fetch('auth.php?action=check').then(r=>r.json()).then(d=>{
    if(!d.logged_in){
        document.querySelectorAll('a[href="practice.php"], a[href="flashcard.php"]').forEach(function(el) {
            el.addEventListener('click', function(e) {
                var uid = localStorage.getItem('hanngu_user_id');
                if (!uid || uid === 'default_user') { e.preventDefault(); showToast('Vui lòng đăng nhập!', 'warning', 3000); }
            });
        });
    }
}).catch(()=>{});
</script>
<script src="init.js"></script>
</body>
</html>