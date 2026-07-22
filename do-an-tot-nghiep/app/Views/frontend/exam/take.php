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