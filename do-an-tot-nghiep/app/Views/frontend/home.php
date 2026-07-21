<div class="home-page">
    <section class="hero" style="background: linear-gradient(135deg, #e94560, #c23152); color: #fff; padding: 80px 20px; text-align: center;">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <h1 style="font-size: 48px; margin-bottom: 16px;">HànNgữ</h1>
            <p style="font-size: 18px; opacity: 0.9; margin-bottom: 32px;">Học tiếng Trung Online hiệu quả với lộ trình từ HSK 1 đến HSK 6</p>
            <div style="display: flex; gap: 16px; justify-content: center;">
                <a href="/do-an-tot-nghiep/lessons" class="btn" style="display: inline-block; padding: 16px 36px; background: #fff; color: #e94560; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 16px;">
                    <i class="fas fa-play"></i> Bắt đầu học
                </a>
                <a href="/do-an-tot-nghiep/login.php" class="btn" style="display: inline-block; padding: 16px 36px; background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 16px; border: 1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-user"></i> Đăng nhập
                </a>
            </div>
        </div>
    </section>

    <section class="features" style="padding: 60px 20px; background: #f8f9fa;">
        <div class="container" style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; font-size: 28px; margin-bottom: 40px;">Lộ trình học tập</h2>
            <div class="levels-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
                <?php foreach ($levels as $key => $level): ?>
                <a href="/do-an-tot-nghiep/lessons?level=<?= App\Helpers\View::escape($key) ?>" class="level-card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-decoration: none; color: inherit; transition: transform 0.2s;"
                   onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform=''">
                    <div style="font-size: 36px; margin-bottom: 12px;"><?= $level['icon'] ?></div>
                    <h3 style="font-size: 20px; margin-bottom: 8px;"><?= App\Helpers\View::escape($level['name']) ?></h3>
                    <p style="color: #666;"><?= number_format($level['count']) ?>+ từ vựng</p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="cta" style="padding: 60px 20px; background: #fff; text-align: center;">
        <div class="container" style="max-width: 600px; margin: 0 auto;">
            <h2 style="font-size: 28px; margin-bottom: 16px;">Bắt đầu ngay hôm nay</h2>
            <p style="color: #666; margin-bottom: 24px;">Học tiếng Trung mọi lúc, mọi nơi với HànNgữ</p>
            <a href="/do-an-tot-nghiep/lessons" class="btn" style="display: inline-block; padding: 16px 48px; background: #e94560; color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 16px;">
                Học ngay <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>
</div>
