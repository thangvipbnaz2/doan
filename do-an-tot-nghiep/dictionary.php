<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Từ điển - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .dict-page { padding: 100px 0 60px; min-height: 100vh; background: linear-gradient(180deg, #f8fafb, #eff6ff); }
        .page-header { text-align: center; margin-bottom: 32px; padding: 32px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); }
        .page-header__badge { display: inline-block; padding: 5px 16px; background: var(--teal-light); color: var(--teal-dark); border-radius: 50px; font-size: .82rem; font-weight: 600; margin-bottom: 10px; }
        .page-header__title { font-size: 2rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; }

        .search-box { max-width: 600px; margin: 0 auto 32px; position: relative; }
        .search-box input { width: 100%; padding: 18px 24px; padding-right: 60px; border: 2px solid var(--gray-light); border-radius: var(--radius); font-size: 1.1rem; transition: var(--transition); }
        .search-box input:focus { outline: none; border-color: var(--teal); box-shadow: 0 0 0 4px rgba(13,148,136,0.1); }
        .search-box__icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 1.5rem; cursor: pointer; }

        .filter-tabs { display: flex; gap: 8px; justify-content: center; margin-bottom: 24px; flex-wrap: wrap; }
        .filter-tab { padding: 8px 20px; border: 2px solid var(--gray-light); background: #fff; border-radius: 50px; font-size: .85rem; font-weight: 600; cursor: pointer; transition: var(--transition); }
        .filter-tab:hover { border-color: var(--teal); }
        .filter-tab--active { background: var(--teal); border-color: var(--teal); color: #fff; }

        .dict-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; }
        .dict-card { background: #fff; border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow); transition: var(--transition); cursor: pointer; }
        .dict-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); border-left: 4px solid var(--teal); }
        .dict-card__hanzi { font-family: 'Noto Sans SC', sans-serif; font-size: 2.2rem; font-weight: 900; color: var(--dark); margin-bottom: 4px; }
        .dict-card__pinyin { font-size: 1rem; color: var(--teal); font-weight: 600; font-style: italic; margin-bottom: 4px; }
        .dict-card__meaning { font-size: .95rem; color: var(--dark-3); margin-bottom: 8px; }
        .dict-card__meta { font-size: .8rem; color: var(--gray); display: flex; gap: 12px; }

        .dict-detail { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
        .dict-detail.active { display: flex; }
        .dict-detail__content { background: #fff; border-radius: var(--radius); padding: 32px; max-width: 500px; width: 90%; max-height: 80vh; overflow-y: auto; position: relative; }
        .dict-detail__close { position: absolute; top: 16px; right: 16px; width: 36px; height: 36px; border: none; background: var(--gray-light); border-radius: 50%; font-size: 1.2rem; cursor: pointer; }
        .dict-detail__hanzi { font-family: 'Noto Sans SC', sans-serif; font-size: 4rem; font-weight: 900; color: var(--dark); text-align: center; margin-bottom: 16px; }
        .dict-detail__pinyin { font-size: 1.5rem; color: var(--teal); font-weight: 600; font-style: italic; text-align: center; margin-bottom: 8px; }
        .dict-detail__meaning { font-size: 1.1rem; color: var(--dark); text-align: center; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--gray-light); }
        .dict-detail__info { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media(max-width:480px){.dict-detail__info{grid-template-columns:1fr}}
        .dict-detail__item { background: var(--teal-light); padding: 12px; border-radius: var(--radius-sm); }
        .dict-detail__item label { display: block; font-size: .8rem; color: var(--teal-dark); font-weight: 600; margin-bottom: 4px; }
        .dict-detail__item span { font-size: 1rem; color: var(--dark); }
        .dict-detail__example { margin-top: 20px; padding: 16px; background: #f8fafb; border-radius: var(--radius-sm); }
        .dict-detail__example label { display: block; font-size: .85rem; color: var(--gray); font-weight: 600; margin-bottom: 8px; }
        .dict-detail__example p { font-size: .95rem; color: var(--dark-3); line-height: 1.6; }
        .dict-detail__actions { display: flex; gap: 12px; margin-top: 20px; }
        .dict-detail__actions button { flex: 1; }

        .toast { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(20px); padding: 14px 28px; background: var(--dark); color: #fff; border-radius: var(--radius-sm); font-size: .9rem; font-weight: 500; opacity: 0; transition: all .3s ease; z-index: 9999; }
        .toast--visible { opacity: 1; transform: translateX(-50%) translateY(0); }

        @media(max-width:768px) { .dict-grid{grid-template-columns:1fr} .search-box input{font-size:1rem} }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="dict-page">
        <div class="container">
            <div class="page-header">
                <span class="page-header__badge"> Từ điển</span>
                <h1 class="page-header__title">Tra cứu <span class="text-gradient">từ vựng</span></h1>
            </div>

            <div class="search-box">
                <input type="text" id="search-input" placeholder="Nhập từ tiếng Trung hoặc tiếng Việt..." oninput="searchDict()">
                <span class="search-box__icon"></span>
            </div>

            <div class="filter-tabs">
                <button class="filter-tab filter-tab--active" data-level="0">Tất cả</button>
                <button class="filter-tab" data-level="1">HSK 1</button>
                <button class="filter-tab" data-level="2">HSK 2</button>
                <button class="filter-tab" data-level="3">HSK 3</button>
                <button class="filter-tab" data-level="4">HSK 4-6</button>
            </div>

            <div class="dict-info" id="dict-info" style="display:none;text-align:center;font-size:.85rem;color:var(--gray);margin-bottom:12px;"></div>
            <div class="dict-grid" id="dict-grid"></div>
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

    <!-- Chi tiết từ -->
    <div class="dict-detail" id="dict-detail">
        <div class="dict-detail__content">
            <button class="dict-detail__close" onclick="closeDetail()" aria-label="Đóng">✕</button>
            <div class="dict-detail__hanzi" id="detail-hanzi">你</div>
            <div class="dict-detail__pinyin" id="detail-pinyin">nǐ</div>
            <div class="dict-detail__meaning" id="detail-meaning">Bạn / Anh / Chị</div>
            <div class="dict-detail__info">
                <div class="dict-detail__item"><label>Số nét</label><span id="detail-strokes">7</span></div>
                <div class="dict-detail__item"><label>Bộ thủ</label><span id="detail-radical">亻</span></div>
                <div class="dict-detail__item"><label>Cấp độ</label><span id="detail-level">HSK 1</span></div>
                <div class="dict-detail__item"><label>Phím gõ</label><span id="detail-pinyin2">ni3</span></div>
            </div>
            <div class="dict-detail__example">
                <label>Ví dụ:</label>
                <p id="detail-example">你好！(nǐ hǎo) - Xin chào!</p>
            </div>
            <div class="dict-detail__actions">
                <button class="btn btn--primary ripple" onclick="saveWord()"> Lưu vào sổ tay</button>
                <button class="btn btn--outline ripple" onclick="playAudio()"> Phát âm</button>
            </div>
        </div>
    </div>

    <script>
    const API_URL = 'api.php';
    let allVocab = [];
    let currentFilter = 0;
    let currentWord = null;

    const defaultVocab = [
        { id: 1, hanzi: '你', pinyin: 'nǐ', meaning: 'Bạn / Anh / Chị', level: 1, strokes: 7, radical: '亻 (nhân)', example: '你好！(nǐ hǎo) - Xin chào!' },
        { id: 2, hanzi: '好', pinyin: 'hǎo', meaning: 'Tốt / Được / Xin chào', level: 1, strokes: 6, radical: '女 (nữ)', example: '很好 (hěn hǎo) - Rất tốt!' },
        { id: 3, hanzi: '我', pinyin: 'wǒ', meaning: 'Tôi / Tớ', level: 1, strokes: 7, radical: '戈 (qua)', example: '我是学生 (wǒ shì xuéshēng) - Tôi là học sinh' },
        { id: 4, hanzi: '是', pinyin: 'shì', meaning: 'Là / Đúng', level: 1, strokes: 9, radical: '日 (nhật)', example: '他是老师 (tā shì lǎoshī) - Anh ấy là giáo viên' },
        { id: 5, hanzi: '学', pinyin: 'xué', meaning: 'Học', level: 1, strokes: 8, radical: '子 (tử)', example: '学中文 (xué zhōngwén) - Học tiếng Trung' },
        { id: 6, hanzi: '中', pinyin: 'zhōng', meaning: 'Trung / Giữa', level: 1, strokes: 4, radical: '丨 (thảo)', example: '中国 (zhōngguó) - Trung Quốc' },
        { id: 7, hanzi: '文', pinyin: 'wén', meaning: 'Văn / Chữ / Văn hóa', level: 1, strokes: 4, radical: '文 (văn)', example: '中文 (zhōngwén) - Tiếng Trung' },
        { id: 8, hanzi: '爱', pinyin: 'ài', meaning: 'Yêu / Thích', level: 2, strokes: 10, radical: '爪 (trảo)', example: '我爱你 (wǒ ài nǐ) - Tôi yêu bạn' },
        { id: 9, hanzi: '吃', pinyin: 'chī', meaning: 'Ăn', level: 2, strokes: 6, radical: '口 (khẩu)', example: '吃饭 (chī fàn) - Ăn cơm' },
        { id: 10, hanzi: '喝', pinyin: 'hē', meaning: 'Uống', level: 2, strokes: 12, radical: '口 (khẩu)', example: '喝茶 (hē chá) - Uống trà' },
        { id: 11, hanzi: '看', pinyin: 'kàn', meaning: 'Nhìn / Xem / Đọc', level: 2, strokes: 9, radical: '目 (mục)', example: '看书 (kàn shū) - Đọc sách' },
        { id: 12, hanzi: '听', pinyin: 'tīng', meaning: 'Nghe', level: 2, strokes: 7, radical: '耳 (nhĩ)', example: '听音乐 (tīng yīnyuè) - Nghe nhạc' },
        { id: 13, hanzi: '说', pinyin: 'shuō', meaning: 'Nói / Nói rằng', level: 2, strokes: 9, radical: '言 (ngôn)', example: '说话 (shuō huà) - Nói chuyện' },
        { id: 14, hanzi: '写', pinyin: 'xiě', meaning: 'Viết', level: 2, strokes: 5, radical: '冖 (bị)', example: '写字 (xiě zì) - Viết chữ' },
        { id: 15, hanzi: '读', pinyin: 'dú', meaning: 'Đọc', level: 2, strokes: 10, radical: '讠 (ngôn)', example: '读书 (dú shū) - Đọc sách' },
    ];

    const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';

    async function fetchAPI(action, data = null) {
        try {
            let url = `${API_URL}?action=${action}`;
            if (data) {
                const d = { ...data, user_id: USER_ID };
                url += '&' + new URLSearchParams(d).toString();
            }
            return await (await fetch(url)).json();
        } catch (e) { return null; }
    }

    async function loadVocab() {
        const grid = document.getElementById('dict-grid');
        grid.innerHTML = '<div class="loading-pulse">Đang tải...</div>';
        const data = await fetchAPI('get_all_vocab');
        allVocab = data && data.length > 0 ? data : defaultVocab;
        renderDict(allVocab);
    }

    let searchTimeout;

    async function searchDict() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(async () => {
            const query = document.getElementById('search-input').value.trim();
            if (query) {
                // Dùng API search server-side
                const result = await fetchAPI('search_vocab', { q: query, level: currentFilter > 0 && currentFilter < 4 ? currentFilter : 0, limit: 50 });
                if (result && result.data) {
                    renderDict(result.data);
                }
            } else {
                filterLevel(currentFilter);
            }
        }, 300);
    }

    function renderDict(vocab) {
        const grid = document.getElementById('dict-grid');
        const info = document.getElementById('dict-info');
        if (!vocab || vocab.length === 0) {
            grid.innerHTML = '<div class="empty-state-float" style="text-align:center;padding:40px;color:var(--gray);"> Không tìm thấy kết quả</div>';
            if (info) { info.style.display = 'none'; }
            return;
        }
        if (info) {
            info.style.display = 'block';
            const query = document.getElementById('search-input').value.trim();
            info.textContent = query ? ` Tìm thấy ${vocab.length} kết quả cho "${query}"` : ` ${vocab.length} từ vựng`;
        }
        grid.innerHTML = vocab.map(v => `
            <div class="dict-card" onclick="showDetail(${v.id})">
                <div class="dict-card__hanzi">${v.hanzi}</div>
                <div class="dict-card__pinyin">${v.pinyin}</div>
                <div class="dict-card__meaning">${v.meaning}</div>
                <div class="dict-card__meta">
                    <span> ${v.strokes} nét</span>
                    <span> HSK ${v.level}</span>
                </div>
            </div>
        `).join('');
    }

    async function filterLevel(level, btn) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('filter-tab--active'));
        if (btn) btn.classList.add('filter-tab--active');
        currentFilter = level;

        const query = document.getElementById('search-input').value.trim();
        if (query) {
            const result = await fetchAPI('search_vocab', { q: query, level: level > 0 && level < 4 ? level : 0, limit: 50 });
            if (result && result.data) renderDict(result.data);
        } else {
            let filtered = allVocab;
            if (level > 0 && level < 4) {
                filtered = allVocab.filter(v => v.level === level);
            } else if (level === 4) {
                filtered = allVocab.filter(v => v.level >= 4);
            }
            renderDict(filtered);
        }
    }

    function showDetail(id) {
        const vocab = allVocab.find(v => v.id === id);
        if (!vocab) vocab = defaultVocab.find(v => v.id === id);
        if (!vocab) return;

        currentWord = vocab;
        document.getElementById('detail-hanzi').textContent = vocab.hanzi;
        document.getElementById('detail-pinyin').textContent = vocab.pinyin;
        document.getElementById('detail-meaning').textContent = vocab.meaning;
        document.getElementById('detail-strokes').textContent = vocab.strokes || '-';
        document.getElementById('detail-radical').textContent = vocab.radical || '-';
        document.getElementById('detail-level').textContent = 'HSK ' + (vocab.level || 1);
        document.getElementById('detail-pinyin2').textContent = vocab.pinyin.replace(/(\d)/g, '$1');
        document.getElementById('detail-example').textContent = vocab.example || '-';

        document.getElementById('dict-detail').classList.add('active');
    }

    function closeDetail() {
        document.getElementById('dict-detail').classList.remove('active');
    }

    async function saveWord() {
        if (!currentWord || !currentWord.id) {
            showToast(' Không thể lưu từ này!', 'error');
            return;
        }
        const result = await fetchAPI('save_to_notebook', { vocab_id: currentWord.id });
        if (result && result.success) {
            showToast(' Đã lưu vào sổ tay!', 'success');
        } else {
            showToast(' Từ này đã có trong sổ tay!', 'info');
        }
    }

    function playAudio() {
        if (!currentWord) return;
        const utterance = new SpeechSynthesisUtterance(currentWord.hanzi);
        utterance.lang = 'zh-CN';
        utterance.rate = 0.8;
        window.speechSynthesis.speak(utterance);
    }

    // Bind filter buttons
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            filterLevel(parseInt(this.dataset.level), this);
        });
    });

    async function checkAuth() {
    }

    loadVocab();

    document.addEventListener('keydown', function(e) {
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            document.getElementById('search-input').focus();
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