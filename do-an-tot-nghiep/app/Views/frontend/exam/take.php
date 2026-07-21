<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escape($exam['title']) ?> | HànNgữ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .exam-container{max-width:900px;margin:auto;padding:104px 24px 64px}
        .exam-header{background:linear-gradient(135deg,#0f766e,#134e4a);color:#fff;padding:24px 32px;border-radius:20px;margin-bottom:24px}
        .exam-header-top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px}
        .exam-header h1{font-size:1.3rem;font-weight:800;font-family:var(--font-display);margin:0}
        .exam-header .level-badge{background:rgba(255,255,255,0.15);padding:4px 12px;border-radius:6px;font-size:.8rem;font-weight:600}
        .exam-timer{text-align:center;padding:8px 0;margin-top:12px;border-top:1px solid rgba(255,255,255,0.1)}
        .exam-timer .time-display{font-size:2rem;font-weight:700;font-variant-numeric:tabular-nums;font-family:var(--font-display)}
        .exam-timer .time-label{font-size:.85rem;opacity:0.8;margin-left:8px}
        .exam-body{display:grid;grid-template-columns:220px 1fr;gap:24px}
        .exam-sidebar{position:sticky;top:104px;align-self:start}
        .exam-section-tabs{display:flex;flex-direction:column;gap:6px;margin-bottom:16px}
        .exam-section-tab{padding:10px 16px;border-radius:10px;border:1px solid var(--gray-light);cursor:pointer;transition:.15s;font-size:.88rem;font-weight:500;text-align:left;background:#fff;display:flex;align-items:center;gap:8px}
        .exam-section-tab:hover{border-color:var(--teal);background:var(--teal-light)}
        .exam-section-tab.active{background:var(--teal);color:#fff;border-color:var(--teal)}
        .exam-section-tab .count{font-size:.75rem;opacity:0.7;margin-left:auto}
        .question-palette{display:flex;flex-wrap:wrap;gap:4px;margin-top:12px;padding:12px;background:#fff;border-radius:12px;border:1px solid var(--gray-light)}
        .q-palette-item{width:30px;height:30px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.72rem;border:1px solid var(--gray-light);cursor:pointer;background:#fff;transition:.15s;font-weight:600}
        .q-palette-item:hover{border-color:var(--teal)}
        .q-palette-item.active{background:var(--teal);color:#fff;border-color:var(--teal)}
        .q-palette-item.answered{background:#dbeafe;border-color:#3b82f6;color:#1d4ed8}
        .exam-main{min-height:400px}
        .question-card{background:#fff;border:1px solid var(--gray-light);border-radius:16px;padding:28px;margin-bottom:16px;display:none}
        .question-card.active{display:block;animation:fadeIn .3s ease}
        @keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .section-header-card{background:linear-gradient(135deg,var(--teal-light),#fff);border:1px solid var(--gray-light);border-radius:16px;padding:20px 24px;margin-bottom:20px}
        .section-header-card h3{font-size:1.1rem;font-weight:700;color:var(--teal-dark);margin-bottom:4px}
        .section-header-card p{font-size:.88rem;color:var(--gray)}
        .question-number{display:inline-flex;width:32px;height:32px;border-radius:50%;background:var(--teal);color:#fff;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;margin-right:10px;flex-shrink:0}
        .question-text{font-size:1.05rem;font-weight:500;color:var(--dark);display:flex;align-items:flex-start;margin-bottom:16px;line-height:1.6}
        .exam-options{display:flex;flex-direction:column;gap:10px;margin:16px 0}
        .exam-option{display:flex;align-items:center;gap:12px;padding:12px 16px;border:2px solid var(--gray-light);border-radius:10px;cursor:pointer;transition:.15s;font-size:.95rem}
        .exam-option:hover{border-color:var(--teal);background:#f0fdfa}
        .exam-option input[type="radio"]{accent-color:var(--teal);width:18px;height:18px;flex-shrink:0;margin:0}
        .exam-option.selected{border-color:var(--teal);background:#ecfdf5}
        .exam-option.correct{border-color:#10b981;background:#ecfdf5}
        .exam-option.wrong{border-color:#ef4444;background:#fef2f2}
        .fill-input{width:100%;padding:14px 18px;border:2px solid var(--gray-light);border-radius:12px;font-size:1.05rem;font-family:var(--font-hanzi);outline:none;transition:var(--transition)}
        .fill-input:focus{border-color:var(--teal);box-shadow:0 0 0 3px rgba(13,148,136,.1)}
        .exam-nav{display:flex;justify-content:space-between;margin-top:16px;gap:12px}
        .btn--outline-danger{border:2px solid #ef4444;color:#ef4444;background:transparent}
        .btn--outline-danger:hover{background:#ef4444;color:#fff}
        .submit-area{text-align:center;margin-top:24px;padding:20px;background:#fff;border-radius:16px;border:1px solid var(--gray-light)}
        .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.6);display:none;align-items:center;justify-content:center;z-index:10000;padding:20px}
        .modal-overlay.active{display:flex}
        .modal-box{background:#fff;border-radius:20px;padding:32px;max-width:440px;width:100%;text-align:center}
        .modal-box h3{font-size:1.2rem;font-weight:700;margin-bottom:8px;color:var(--dark)}
        .modal-box p{font-size:.92rem;color:var(--gray);margin-bottom:20px;line-height:1.6}
        .modal-box .actions{display:flex;gap:12px;justify-content:center}
        [data-theme="dark"] .question-card{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .exam-section-tab{background:#1a2332;border-color:var(--gray-light);color:var(--dark-2)}
        [data-theme="dark"] .exam-section-tab.active{background:var(--teal);color:#fff}
        [data-theme="dark"] .question-palette{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .q-palette-item{background:#1a2332;border-color:var(--gray-light);color:var(--dark-2)}
        [data-theme="dark"] .q-palette-item.answered{background:#1e3a5f;border-color:#3b82f6;color:#93c5fd}
        [data-theme="dark"] .exam-option{background:#0b0f1a;border-color:var(--gray-light)}
        [data-theme="dark"] .exam-option:hover{border-color:var(--teal);background:var(--teal-light)}
        [data-theme="dark"] .exam-option.selected{background:var(--teal-light);border-color:var(--teal)}
        [data-theme="dark"] .fill-input{background:#0b0f1a;border-color:var(--gray-light);color:var(--dark)}
        [data-theme="dark"] .submit-area{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .modal-box{background:#1a2332}
        [data-theme="dark"] .section-header-card{background:linear-gradient(135deg,rgba(13,148,136,0.15),#1a2332)}
        @media(max-width:768px){.exam-body{grid-template-columns:1fr}.exam-sidebar{position:static;order:-1}.exam-sidebar > div{display:flex;gap:12px;flex-wrap:wrap}.exam-section-tabs{flex-direction:row;overflow-x:auto}.question-palette{display:none}}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="exam-container">
        <div class="exam-header">
            <div class="exam-header-top">
                <div>
                    <h1><?= escape($exam['title']) ?></h1>
                    <span class="level-badge">HSK <?= (int)$exam['level'] ?></span>
                </div>
                <span class="level-badge"><?= (int)$exam['total_questions'] ?> câu hỏi</span>
            </div>
            <div class="exam-timer">
                <span class="time-label">Thời gian còn lại:</span>
                <span class="time-display" id="timerDisplay"><?= sprintf('%02d:%02d', (int)$exam['duration_minutes'], 0) ?></span>
            </div>
        </div>

        <div class="exam-body">
            <aside class="exam-sidebar">
                <div class="exam-section-tabs" id="sectionTabs">
                    <button class="exam-section-tab active" data-section="listening">
                        🎧 Nghe <span class="count"><?= count($grouped['listening']) ?></span>
                    </button>
                    <button class="exam-section-tab" data-section="reading">
                        📖 Đọc <span class="count"><?= count($grouped['reading']) ?></span>
                    </button>
                    <button class="exam-section-tab" data-section="grammar">
                        🔤 Ngữ pháp <span class="count"><?= count($grouped['grammar']) ?></span>
                    </button>
                    <button class="exam-section-tab" data-section="writing">
                        ✍️ Viết <span class="count"><?= count($grouped['writing']) ?></span>
                    </button>
                </div>
                <div class="question-palette" id="questionPalette"></div>
            </aside>

            <main class="exam-main">
                <form id="examForm" method="post" action="exam_mvc.php?action=submit" onsubmit="return confirmSubmit(event)">
                    <input type="hidden" name="exam_id" value="<?= (int)$exam['id'] ?>">
                    <input type="hidden" name="started_at" value="<?= date('Y-m-d H:i:s') ?>">

                    <?php $globalQn = 1; $firstSection = true; ?>
                    <?php foreach (['listening', 'reading', 'grammar', 'writing'] as $section): ?>
                        <?php $questions = $grouped[$section]; if (empty($questions)) continue; ?>
                        <div class="section-group" data-section="<?= $section ?>" style="display: <?= $firstSection ? 'block' : 'none' ?>">
                            <div class="section-header-card">
                                <h3>
                                    <?php if ($section === 'listening'): ?>🎧 Phần Nghe - 听力
                                    <?php elseif ($section === 'reading'): ?>📖 Phần Đọc - 阅读
                                    <?php elseif ($section === 'grammar'): ?>🔤 Phần Ngữ pháp - 语法
                                    <?php else: ?>✍️ Phần Viết - 写作
                                    <?php endif; ?>
                                </h3>
                                <p><?= count($questions) ?> câu hỏi</p>
                            </div>
                            <?php foreach ($questions as $q): ?>
                                <div class="question-card" data-qid="<?= (int)$q['id'] ?>" data-section="<?= $section ?>" data-number="<?= $globalQn ?>">
                                    <div class="question-text">
                                        <span class="question-number"><?= $globalQn ?></span>
                                        <span><?= escape($q['question']) ?></span>
                                    </div>
                                    <?php if (!empty($q['options_arr'])): ?>
                                        <div class="exam-options">
                                            <?php foreach ($q['options_arr'] as $oi => $opt): ?>
                                                <label class="exam-option">
                                                    <input type="radio" name="answers[<?= (int)$q['id'] ?>]" value="<?= escape($opt) ?>" onchange="markAnswered(<?= (int)$q['id'] ?>)">
                                                    <span><?= escape($opt) ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <input type="text" name="answers[<?= (int)$q['id'] ?>]" class="fill-input"
                                               placeholder="Nhập câu trả lời của bạn..." oninput="markAnswered(<?= (int)$q['id'] ?>)">
                                    <?php endif; ?>
                                </div>
                                <?php $globalQn++; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php $firstSection = false; ?>
                    <?php endforeach; ?>

                    <div class="submit-area">
                        <p style="margin-bottom:12px;font-size:.9rem;color:var(--gray)">
                            Đã trả lời: <strong id="answeredCount">0</strong>/<?= count($grouped['listening']) + count($grouped['reading']) + count($grouped['grammar']) + count($grouped['writing']) ?>
                        </p>
                        <button type="submit" class="btn btn--gold">📝 Nộp bài</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

<div class="modal-overlay" id="confirmModal">
    <div class="modal-box">
        <h3>Xác nhận nộp bài?</h3>
        <p id="confirmMsg">Bạn có chắc muốn nộp bài? Kiểm tra lại các câu chưa trả lời trước khi nộp.</p>
        <div class="actions">
            <button class="btn btn--outline" onclick="closeConfirm()">Kiểm tra lại</button>
            <button class="btn btn--primary" onclick="submitExam()">Nộp bài</button>
        </div>
    </div>
</div>

<script>
(function() {
    const totalMinutes = <?= (int)$exam['duration_minutes'] ?>;
    let totalSeconds = totalMinutes * 60;
    let timerInterval = null;
    let answered = {};

    function updateTimer() {
        const m = Math.floor(totalSeconds / 60);
        const s = totalSeconds % 60;
        document.getElementById('timerDisplay').textContent =
            String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            submitExam();
        }
        totalSeconds--;
    }

    timerInterval = setInterval(updateTimer, 1000);
    updateTimer();

    const sectionTabs = document.querySelectorAll('.exam-section-tab');
    const sectionGroups = document.querySelectorAll('.section-group');
    const questionCards = document.querySelectorAll('.question-card');
    const palette = document.getElementById('questionPalette');

    sectionTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const section = this.dataset.section;
            sectionTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            sectionGroups.forEach(g => {
                g.style.display = g.dataset.section === section ? 'block' : 'none';
            });
            const firstInSection = document.querySelector('.question-card[data-section="' + section + '"]');
            if (firstInSection) showQuestion(firstInSection.dataset.qid);
            updatePalette();
        });
    });

    questionCards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'LABEL') {
                showQuestion(this.dataset.qid);
            }
        });
    });

    function showQuestion(qid) {
        questionCards.forEach(c => c.classList.remove('active'));
        const target = document.querySelector('.question-card[data-qid="' + qid + '"]');
        if (target) {
            target.classList.add('active');
            const section = target.dataset.section;
            sectionTabs.forEach(t => {
                t.classList.toggle('active', t.dataset.section === section);
            });
            sectionGroups.forEach(g => {
                g.style.display = g.dataset.section === section ? 'block' : 'none';
            });
        }
        updatePalette();
    }

    function buildPalette() {
        palette.innerHTML = '';
        questionCards.forEach(card => {
            const qid = card.dataset.qid;
            const num = card.dataset.number;
            const btn = document.createElement('button');
            btn.className = 'q-palette-item';
            btn.textContent = num;
            btn.dataset.qid = qid;
            btn.addEventListener('click', function() {
                const section = document.querySelector('.question-card[data-qid="' + qid + '"]').dataset.section;
                sectionTabs.forEach(t => {
                    t.classList.toggle('active', t.dataset.section === section);
                });
                sectionGroups.forEach(g => {
                    g.style.display = g.dataset.section === section ? 'block' : 'none';
                });
                showQuestion(qid);
            });
            palette.appendChild(btn);
        });
        updatePalette();
    }

    function updatePalette() {
        const activeCard = document.querySelector('.question-card.active');
        const activeQid = activeCard ? activeCard.dataset.qid : null;
        const items = palette.querySelectorAll('.q-palette-item');
        items.forEach(item => {
            item.classList.toggle('active', item.dataset.qid === activeQid);
            item.classList.toggle('answered', answered[item.dataset.qid]);
        });
    }

    window.markAnswered = function(qid) {
        const card = document.querySelector('.question-card[data-qid="' + qid + '"]');
        if (!card) return;
        const section = card.dataset.section;
        const radio = card.querySelector('input[type="radio"]:checked');
        const input = card.querySelector('.fill-input');
        if (radio || (input && input.value.trim() !== '')) {
            answered[qid] = true;
            card.classList.add('answered');
        } else {
            delete answered[qid];
            card.classList.remove('answered');
        }
        const count = Object.keys(answered).length;
        document.getElementById('answeredCount').textContent = count;
        updatePalette();
    };

    window.confirmSubmit = function(e) {
        e.preventDefault();
        const total = questionCards.length;
        const done = Object.keys(answered).length;
        const modal = document.getElementById('confirmModal');
        document.getElementById('confirmMsg').textContent =
            'Bạn đã trả lời ' + done + '/' + total + ' câu. ' +
            (done < total ? 'Còn ' + (total - done) + ' câu chưa trả lời.' : '');
        modal.classList.add('active');
        return false;
    };

    window.closeConfirm = function() {
        document.getElementById('confirmModal').classList.remove('active');
    };

    window.submitExam = function() {
        document.getElementById('confirmModal').classList.remove('active');
        document.getElementById('examForm').submit();
    };

    questionCards.forEach(card => {
        const qid = card.dataset.qid;
        const radios = card.querySelectorAll('input[type="radio"]');
        radios.forEach(r => r.addEventListener('change', () => markAnswered(qid)));
        const fill = card.querySelector('.fill-input');
        if (fill) fill.addEventListener('input', () => markAnswered(qid));
    });

    buildPalette();
    const firstQ = document.querySelector('.question-card');
    if (firstQ) showQuestion(firstQ.dataset.qid);
})();
</script>
</body>
</html>
