<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Học tiếng Trung trực tuyến miễn phí - Lộ trình HSK 1 đến HSK 6 dành cho người Việt. Phương pháp học hiệu quả, dễ hiểu.">
    <title>HànNgữ - Học Tiếng Trung Cho Người Việt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
<!-- ===== HERO SECTION ===== -->
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
                    <a href="#roadmap" class="btn btn--primary" id="hero-cta">Bắt đầu học ngay</a>
                    <a href="courses.php" class="btn btn--outline">Mua khóa học</a>
                    <a href="#" class="btn btn--outline" id="hero-demo" onclick="showIntroModal(event)">Xem giới thiệu</a>
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

    <!-- ===== FEATURES SECTION ===== -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-header__tag">Tại sao chọn HànNgữ?</span>
                <h2 class="section-header__title">Học tiếng Trung <span class="text-gradient">chủ động, không nhàm chán</span></h2>
            </div>
            <div class="features__grid">
                <div class="feature-card" id="feature-visual">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Học qua flashcard thông minh</h3>
                    <p class="feature-card__desc">Lật thẻ, đoán nghĩa, hệ thống tự động lặp lại từ bạn hay quên — nhớ từ vựng lâu hơn nhờ spaced repetition.</p>
                </div>
                <div class="feature-card" id="feature-path">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Lộ trình từ mất gốc đến HSK 6</h3>
                    <p class="feature-card__desc">150 từ vựng HSK 1 đến 5000+ từ HSK 6, mỗi cấp độ có bài giảng, bài tập, đề thi thử riêng theo đúng chuẩn.</p>
                </div>
                <div class="feature-card" id="feature-practice">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Luyện đủ bốn kỹ năng</h3>
                    <p class="feature-card__desc">Nghe — Nói — Đọc — Viết với bài tập tương tác, ghi âm phát âm so sánh với người bản xứ, và đề thi thử HSK có chấm điểm.</p>
                </div>
                <div class="feature-card" id="feature-community">
                    <div class="feature-card__icon"></div>
                    <h3 class="feature-card__title">Thi đấu PvP & bảng xếp hạng</h3>
                    <p class="feature-card__desc">Đấu trực tiếp với bạn bè qua câu hỏi từ vựng, ngữ pháp. Leo bảng xếp hạng tuần, nhận huy hiệu thành tích.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== PAID COURSES SECTION ===== -->
    <section class="features" id="paid-courses">
        <div class="container">
            <div class="section-header">
                <span class="section-header__tag">Khóa học có hướng dẫn</span>
                <h2 class="section-header__title">Mua khóa học, <span class="text-gradient">học ngay sau thanh toán</span></h2>
                <p class="section-header__desc">Quét QR MB Bank, hệ thống ghi nhận đơn hàng, cấp quyền học và xuất hóa đơn điện tử.</p>
                <a href="courses.php" class="btn btn--primary">Xem và mua khóa học</a>
            </div>
        </div>
    </section>

    <!-- ===== ROADMAP / HSK SECTION ===== -->
    <section class="roadmap" id="roadmap">
        <div class="container">
            <div class="section-header">
                <span class="section-header__tag">Lộ trình học tập</span>
                <h2 class="section-header__title">Từ chưa biết chữ đến <span class="text-gradient">HSK 6</span></h2>
                <p class="section-header__desc">Mỗi cấp độ gồm bài giảng, flashcard, bài tập và đề thi thử — đủ để bạn tự học không cần giáo viên.</p>
            </div>

            <div class="roadmap__grid">
                <!-- HSK 1 -->
                <div class="hsk-card hsk-card--1" id="hsk1-card">
                    <div class="hsk-card__header">
                        <div class="hsk-card__level">
                            <span class="hsk-card__badge">HSK</span>
                            <span class="hsk-card__number">1</span>
                        </div>
                        <h3 class="hsk-card__title">Nền tảng vững chắc</h3>
                        <p class="hsk-card__subtitle">Dành cho người mới bắt đầu</p>
                    </div>
                    <div class="hsk-card__body">
                        <ul class="hsk-card__features">
                            <li>
                                <span class="check">✓</span>
                                <span>150 từ vựng cơ bản</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Hệ thống Pinyin đầy đủ</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>40 mẫu câu giao tiếp</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Nét chữ cơ bản (bộ thủ)</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Chào hỏi & giới thiệu bản thân</span>
                            </li>
                        </ul>
                        <div class="hsk-card__meta">
                            <div class="meta-item">
                                <span class="meta-item__icon"></span>
                                <span>60 bài học</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-item__icon"></span>
                                <span>~2 tháng</span>
                            </div>
                        </div>
                    </div>
                    <div class="hsk-card__footer">
                        <a href="lessons.php?level=1" class="btn btn--primary btn--block" id="hsk1-start">Bắt đầu HSK 1</a>
                    </div>
                </div>

                <!-- HSK 2 -->
                <div class="hsk-card hsk-card--2" id="hsk2-card">
                    <div class="hsk-card__header">
                        <div class="hsk-card__level">
                            <span class="hsk-card__badge">HSK</span>
                            <span class="hsk-card__number">2</span>
                        </div>
                        <h3 class="hsk-card__title">Giao tiếp cơ bản</h3>
                        <p class="hsk-card__subtitle">Dành cho người đã có nền tảng</p>
                    </div>
                    <div class="hsk-card__body">
                        <ul class="hsk-card__features">
                            <li>
                                <span class="check">✓</span>
                                <span>300 từ vựng mở rộng</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Ngữ pháp câu phức</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>80 mẫu câu nâng cao</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Đọc hiểu đoạn văn ngắn</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Hội thoại chủ đề thường ngày</span>
                            </li>
                        </ul>
                        <div class="hsk-card__meta">
                            <div class="meta-item">
                                <span class="meta-item__icon"></span>
                                <span>65 bài học</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-item__icon"></span>
                                <span>~2 tháng</span>
                            </div>
                        </div>
                    </div>
                    <div class="hsk-card__footer">
                        <a href="lessons.php?level=2" class="btn btn--gold btn--block" id="hsk2-start">Bắt đầu HSK 2</a>
                    </div>
                </div>

                <!-- HSK 3 -->
                <div class="hsk-card hsk-card--3" id="hsk3-card">
                    <div class="hsk-card__header">
                        <div class="hsk-card__level">
                            <span class="hsk-card__badge">HSK</span>
                            <span class="hsk-card__number">3</span>
                        </div>
                        <h3 class="hsk-card__title">Thành thạo giao tiếp</h3>
                        <p class="hsk-card__subtitle">Dành cho người muốn nâng cao</p>
                    </div>
                    <div class="hsk-card__body">
                        <ul class="hsk-card__features">
                            <li>
                                <span class="check">✓</span>
                                <span>600 từ vựng chuyên sâu</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Ngữ pháp nâng cao</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Viết luận ngắn bằng tiếng Trung</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Nghe hiểu hội thoại tự nhiên</span>
                            </li>
                            <li>
                                <span class="check">✓</span>
                                <span>Đề thi mô phỏng HSK 3</span>
                            </li>
                        </ul>
                        <div class="hsk-card__meta">
                            <div class="meta-item">
                                <span class="meta-item__icon"></span>
                                <span>55 bài học</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-item__icon"></span>
                                <span>~2 tháng</span>
                            </div>
                        </div>
                    </div>
                    <div class="hsk-card__footer">
                        <a href="lessons.php?level=3" class="btn btn--primary btn--block" id="hsk3-start">Bắt đầu HSK 3</a>
                    </div>
                </div>

                <!-- HSK 4 -->
                <div class="hsk-card hsk-card--4" id="hsk4-card">
                    <div class="hsk-card__header">
                        <div class="hsk-card__level">
                            <span class="hsk-card__badge">HSK</span>
                            <span class="hsk-card__number">4</span>
                        </div>
                        <h3 class="hsk-card__title">Giao tiếp linh hoạt</h3>
                        <p class="hsk-card__subtitle">Dành cho người muốn giao tiếp tự nhiên</p>
                    </div>
                    <div class="hsk-card__body">
                        <ul class="hsk-card__features">
                            <li><span class="check">✓</span><span>1,200 từ vựng nâng cao</span></li>
                            <li><span class="check">✓</span><span>Ngữ pháp phức tạp</span></li>
                            <li><span class="check">✓</span><span>Đọc hiểu bài báo ngắn</span></li>
                            <li><span class="check">✓</span><span>Viết đoạn văn dài hơn</span></li>
                            <li><span class="check">✓</span><span>Đề thi mô phỏng HSK 4</span></li>
                        </ul>
                        <div class="hsk-card__meta">
                            <div class="meta-item"><span class="meta-item__icon"></span><span>10 bài học</span></div>
                            <div class="meta-item"><span class="meta-item__icon"></span><span>~3 tháng</span></div>
                        </div>
                    </div>
                    <div class="hsk-card__footer">
                        <a href="lessons.php?level=4" class="btn btn--primary btn--block" id="hsk4-start">Bắt đầu HSK 4</a>
                    </div>
                </div>

                <!-- HSK 5 -->
                <div class="hsk-card hsk-card--5" id="hsk5-card">
                    <div class="hsk-card__header">
                        <div class="hsk-card__level">
                            <span class="hsk-card__badge">HSK</span>
                            <span class="hsk-card__number">5</span>
                        </div>
                        <h3 class="hsk-card__title">Đọc báo & xem tin tức</h3>
                        <p class="hsk-card__subtitle">Dành cho người muốn đạt trình độ cao</p>
                    </div>
                    <div class="hsk-card__body">
                        <ul class="hsk-card__features">
                            <li><span class="check">✓</span><span>2,500 từ vựng toàn diện</span></li>
                            <li><span class="check">✓</span><span>Ngữ pháp thành ngữ</span></li>
                            <li><span class="check">✓</span><span>Đọc hiểu văn bản dài</span></li>
                            <li><span class="check">✓</span><span>Viết luận học thuật</span></li>
                            <li><span class="check">✓</span><span>Đề thi mô phỏng HSK 5</span></li>
                        </ul>
                        <div class="hsk-card__meta">
                            <div class="meta-item"><span class="meta-item__icon"></span><span>10 bài học</span></div>
                            <div class="meta-item"><span class="meta-item__icon"></span><span>~3 tháng</span></div>
                        </div>
                    </div>
                    <div class="hsk-card__footer">
                        <a href="lessons.php?level=5" class="btn btn--primary btn--block" id="hsk5-start">Bắt đầu HSK 5</a>
                    </div>
                </div>

                <!-- HSK 6 -->
                <div class="hsk-card hsk-card--6" id="hsk6-card">
                    <div class="hsk-card__header">
                        <div class="hsk-card__level">
                            <span class="hsk-card__badge">HSK</span>
                            <span class="hsk-card__number">6</span>
                        </div>
                        <h3 class="hsk-card__title">Thông thạo tiếng Trung</h3>
                        <p class="hsk-card__subtitle">Dành cho người muốn đạt trình độ bản ngữ</p>
                    </div>
                    <div class="hsk-card__body">
                        <ul class="hsk-card__features">
                            <li><span class="check">✓</span><span>5,000+ từ vựng nâng cao</span></li>
                            <li><span class="check">✓</span><span>Thành ngữ & tục ngữ</span></li>
                            <li><span class="check">✓</span><span>Đọc hiểu văn học</span></li>
                            <li><span class="check">✓</span><span>Viết luận chuyên sâu</span></li>
                            <li><span class="check">✓</span><span>Đề thi mô phỏng HSK 6</span></li>
                        </ul>
                        <div class="hsk-card__meta">
                            <div class="meta-item"><span class="meta-item__icon"></span><span>10 bài học</span></div>
                            <div class="meta-item"><span class="meta-item__icon"></span><span>~4 tháng</span></div>
                        </div>
                    </div>
                    <div class="hsk-card__footer">
                        <a href="lessons.php?level=6" class="btn btn--primary btn--block" id="hsk6-start">Bắt đầu HSK 6</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="cta" id="cta">
        <div class="container cta__inner">
            <div class="cta__content">
                <h2 class="cta__title">Bắt đầu ngay — <span class="text-gradient">hoàn toàn miễn phí</span></h2>
                <p class="cta__desc">Tham gia cộng đồng hơn 10,000 người đang chinh phục tiếng Trung mỗi ngày.</p>
                <a href="#roadmap" class="btn btn--gold btn--lg" id="cta-button">Học miễn phí ngay</a>
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

    <!-- ===== GIỚI THIỆU MODAL ===== -->
    <div class="modal-overlay" id="intro-modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeIntroModal()" aria-label="Đóng">&times;</button>
            <div class="modal-body">
                <h2 class="modal-title">Giới thiệu về HànNgữ</h2>
                <div class="modal-text">
                    <h3>Chào mừng bạn đến với HànNgữ!</h3>
                    <p>Chúng tôi là nền tảng học tiếng Trung trực tuyến hàng đầu dành cho người Việt Nam.</p>

                    <h4>Tính năng nổi bật:</h4>
                    <ul>
                        <li><strong>Lộ trình bài bản:</strong> Từ HSK 1 đến HSK 6 với nội dung được biên soạn kỹ lưỡng</li>
                        <li><strong>Luyện viết chữ Hán:</strong> Hướng dẫn viết từng nét với công nghệ nhận dạng thông minh</li>
                        <li><strong>Luyện nói:</strong> Nhận dạng giọng nói AI giúp bạn phát âm chuẩn xác</li>
                        <li><strong>Luyện tập đa dạng:</strong> Ghép từ, trắc nghiệm, nối từ - nghĩa, nghe và chọn</li>
                        <li><strong>Sổ tay cá nhân:</strong> Lưu trữ từ vựng yêu thích để ôn tập bất cứ lúc nào</li>
                        <li><strong>Cộng đồng:</strong> Chia sẻ và học hỏi cùng những người cùng chí hướng</li>
                    </ul>

                    <h4>Phương pháp học hiệu quả:</h4>
                    <ul>
                        <li>Học từ vựng qua flashcard và hình ảnh trực quan</li>
                        <li>Luyện viết từng bước với hướng dẫn nét chuẩn xác</li>
                        <li>Luyện phát âm với giọng chuẩn tiếng Trung</li>
                        <li>Ôn tập thông qua các bài quiz tương tác</li>
                    </ul>

                    <h4>Bắt đầu ngay hôm nay!</h4>
                    <p>Không cần kiến thức nền - chỉ cần đam mê và sự kiên trì. Với HànNgữ, bạn sẽ tự tin giao tiếp tiếng Trung chỉ sau 3-6 tháng.</p>
                </div>
                <button class="btn btn--primary" onclick="closeIntroModal()">Đã hiểu</button>
            </div>
        </div>
    </div>

    <script>
    function showIntroModal(e) {
        e.preventDefault();
        document.getElementById('intro-modal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeIntroModal() {
        document.getElementById('intro-modal').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.getElementById('intro-modal').addEventListener('click', function(e) {
        if (e.target === this) closeIntroModal();
    });
    </script>

    <!-- ===== FOOTER ===== -->
    <footer class="footer" id="footer">
        <div class="container footer__inner">
            <div class="footer__brand">
                <a href="index.php" class="sidebar__logo">
                    <span class="logo__icon">汉</span>
                    <span class="logo__text">HànNgữ</span>
                </a>
                <p class="footer__tagline">Nền tảng học tiếng Trung trực tuyến hàng đầu dành cho người Việt.</p>
            </div>
            <div class="footer__links">
                <div class="footer__col">
                    <h4>Khám phá</h4>
                    <ul>
                        <li><a href="#roadmap">Lộ trình HSK</a></li>
                        <li><a href="notebook.php">Sổ tay từ vựng</a></li>
                        <li><a href="#">Bài tập luyện</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Cộng đồng</h4>
                    <ul>
                        <li><a href="community.php">Diễn đàn</a></li>
                        <li><a href="#">Nhóm học tập</a></li>
                        <li><a href="#">Sự kiện</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Hỗ trợ</h4>
                    <ul>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Chính sách</a></li>
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
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .hsk-card, .section-header').forEach(el => {
            observer.observe(el);
        });

        

        
    </script>

    <script>
    // Tải thống kê thật từ API
    fetch('api.php?action=get_stats').then(r=>r.json()).then(d=>{
        if(d && d.total) {
            document.getElementById('stat-vocab').textContent = d.total;
            document.getElementById('stat-lessons').textContent = parseInt(d.hsk1||0)+parseInt(d.hsk2||0)+parseInt(d.hsk3||0)+parseInt(d.hsk4||0)+parseInt(d.hsk5||0)+parseInt(d.hsk6||0);
        }
    }).catch(()=>{ showToast('Không thể tải thống kê!', 'error'); });

    document.querySelectorAll('a[href="practice.php"], a[href="flashcard.php"]').forEach(function(el) {
        el.addEventListener('click', function(e) {
            var uid = localStorage.getItem('hanngu_user_id');
            if (!uid || uid === 'default_user') {
                e.preventDefault();
                showToast('Vui lòng đăng nhập!', 'warning', 3000);
            }
        });
    });
    </script>

    
<script src="init.js"></script>

<!-- Chatbot -->
<button class="chatbot-btn" id="chatbot-btn" onclick="toggleChat()">AI</button>
<div class="chatbot-modal" id="chatbot-modal">
<div class="chatbot-head">
<div><h3>Trợ lý AI</h3><span>Gemini 3.1 Flash Lite</span></div>
<button onclick="toggleChat()" style="background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer" aria-label="Đóng">✕</button>
</div>
<div class="chatbot-body" id="chatbot-body">
<div class="chatbot-empty" id="chatbot-empty">
<div class="chatbot-empty__icon"></div>
<p>Hỏi tôi bất cứ điều gì về tiếng Trung!</p>
</div>
</div>
<div class="chatbot-foot">
<input type="text" id="chatbot-input" placeholder="Nhập câu hỏi..." onkeydown="if(event.key==='Enter') sendChat()">
<button onclick="sendChat()">Gửi</button>
</div>
</div>
<script>
let chatHistory = [];
let chatOpen = false;
function toggleChat() {
    chatOpen = !chatOpen;
    document.getElementById('chatbot-modal').classList.toggle('open');
    document.getElementById('chatbot-btn').classList.toggle('active');
    if (chatOpen) document.getElementById('chatbot-input').focus();
}
function addChatMsg(text, role, raw) {
    const empty = document.getElementById('chatbot-empty');
    if (empty) empty.style.display = 'none';
    const body = document.getElementById('chatbot-body');
    const div = document.createElement('div');
    div.className = 'chatbot-msg ' + role;
    const fmt = raw || escapeHtmlChat(text);
    div.innerHTML = '<div class="chatbot-msg__bubble">' + fmt + '</div>';
    body.appendChild(div);
    body.scrollTop = body.scrollHeight;
    chatHistory.push({role: role, text: text});
}
function escapeHtmlChat(t) {
    const d = document.createElement('div');
    d.textContent = t;
    return d.innerHTML.replace(/([\u4e00-\u9fff\uff00-\uffef]+)/g, '<span class="cn">$1</span>');
}
async function sendChat() {
    const input = document.getElementById('chatbot-input');
    const text = input.value.trim();
    if (!text) return;
    input.value = '';
    addChatMsg(text, 'user');
    document.getElementById('chatbot-btn').textContent = '...';
    try {
        const res = await fetch('api.php?action=chatbot', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({prompt: text, history: chatHistory.slice(-10)})
        });
        const data = await res.json();
        addChatMsg(data.reply || '(không có phản hồi)', 'ai');
    } catch(e) {
        addChatMsg('Lỗi kết nối', 'ai');
    }
    document.getElementById('chatbot-btn').textContent = 'AI';
}
</script>

</body>
</html>
