<?php
require_once __DIR__ . '/db.php';

$conn->exec("CREATE TABLE IF NOT EXISTS exam_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level TINYINT NOT NULL,
    title VARCHAR(200) NOT NULL,
    duration_minutes INT DEFAULT 40,
    total_questions INT DEFAULT 40,
    passing_score INT DEFAULT 60,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$conn->exec("CREATE TABLE IF NOT EXISTS exam_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT NOT NULL,
    section ENUM('listening','reading','grammar','writing') NOT NULL,
    question_number INT NOT NULL,
    question TEXT NOT NULL,
    options JSON DEFAULT NULL,
    answer VARCHAR(500) NOT NULL,
    explanation TEXT,
    audio_url VARCHAR(255) DEFAULT NULL,
    points INT DEFAULT 1,
    sort_order INT DEFAULT 0,
    FOREIGN KEY (exam_id) REFERENCES exam_templates(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$conn->exec("CREATE TABLE IF NOT EXISTS exam_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    exam_id INT NOT NULL,
    score INT DEFAULT 0,
    total_points INT DEFAULT 0,
    answers JSON DEFAULT NULL,
    started_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (exam_id) REFERENCES exam_templates(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$count = $conn->query("SELECT COUNT(*) FROM exam_templates")->fetchColumn();
if ($count > 0) { echo "Exams already seeded ($count templates).\n"; exit; }

$exams = [
    ['level' => 1, 'title' => 'Đề thi thử HSK 1 - Số 1', 'duration' => 40, 'questions' => 40, 'pass' => 60],
    ['level' => 2, 'title' => 'Đề thi thử HSK 2 - Số 1', 'duration' => 55, 'questions' => 50, 'pass' => 60],
    ['level' => 3, 'title' => 'Đề thi thử HSK 3 - Số 1', 'duration' => 90, 'questions' => 80, 'pass' => 60],
    ['level' => 4, 'title' => 'Đề thi thử HSK 4 - Số 1', 'duration' => 105, 'questions' => 100, 'pass' => 60],
    ['level' => 5, 'title' => 'Đề thi thử HSK 5 - Số 1', 'duration' => 125, 'questions' => 100, 'pass' => 60],
    ['level' => 6, 'title' => 'Đề thi thử HSK 6 - Số 1', 'duration' => 140, 'questions' => 101, 'pass' => 60],
];

$stmt = $conn->prepare("INSERT INTO exam_templates (level, title, duration_minutes, total_questions, passing_score) VALUES (?, ?, ?, ?, ?)");
foreach ($exams as $e) {
    $stmt->execute([$e['level'], $e['title'], $e['duration'], $e['questions'], $e['pass']]);
    $examId = $conn->lastInsertId();
    seedQuestions($conn, $examId, $e['level'], $e['questions']);
}

function seedQuestions($conn, $examId, $level, $totalQ) {
    $listening = round($totalQ * 0.3);
    $reading = round($totalQ * 0.3);
    $grammar = round($totalQ * 0.25);
    $writing = $totalQ - $listening - $reading - $grammar;

    $sections = [
        'listening' => $listening,
        'reading' => $reading,
        'grammar' => $grammar,
        'writing' => $writing
    ];

    $qStmt = $conn->prepare("INSERT INTO exam_questions (exam_id, section, question_number, question, options, answer, explanation, points) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $qn = 1;
    foreach ($sections as $section => $count) {
        for ($i = 0; $i < $count; $i++) {
            $questionData = generateQuestion($section, $level, $qn);
            $options = isset($questionData['options']) ? json_encode($questionData['options']) : null;
            $qStmt->execute([
                $examId, $section, $qn,
                $questionData['question'],
                $options,
                $questionData['answer'],
                $questionData['explanation'],
                1
            ]);
            $qn++;
        }
    }
}

function generateQuestion($section, $level, $num) {
    $questions = getQuestionBank()[$level] ?? getQuestionBank()[1];
    $q = $questions[array_rand($questions)];
    $q['question'] = str_replace('{n}', $num, $q['question']);
    return [
        'question' => $q['question'],
        'options' => $q['options'] ?? null,
        'answer' => $q['answer'],
        'explanation' => $q['explanation'] ?? 'Xem đáp án để hiểu thêm.'
    ];
}

function getQuestionBank() {
    return [
        1 => [
            ['question' => 'Nǐ hǎo (你好) có nghĩa là gì?', 'options' => ['Xin chào', 'Cảm ơn', 'Tạm biệt', 'Xin lỗi'], 'answer' => 'Xin chào', 'explanation' => '"你好" là cách chào hỏi phổ biến nhất trong tiếng Trung.'],
            ['question' => 'Câu nào đúng khi muốn hỏi tên?', 'options' => ['你叫什么名字？', '你去哪儿？', '你吃了吗？', '你多大？'], 'answer' => '你叫什么名字？', 'explanation' => '"你叫什么名字" có nghĩa là "Bạn tên là gì?".'],
            ['question' => 'Số 10 trong tiếng Trung là:?', 'options' => ['十 (shí)', '一 (yī)', '五 (wǔ)', '百 (bǎi)'], 'answer' => '十 (shí)', 'explanation' => 'Số 10 đọc là "shí", viết là 十.'],
            ['question' => '"谢谢" có nghĩa là gì?', 'options' => ['Cảm ơn', 'Xin lỗi', 'Không có gì', 'Tạm biệt'], 'answer' => 'Cảm ơn', 'explanation' => '"谢谢" (xièxie) là cách nói cảm ơn thông dụng.'],
            ['question' => 'Chọn đáp án đúng: 我___学生。', 'options' => ['是', '在', '有', '会'], 'answer' => '是', 'explanation' => '"是" (shì) là động từ "là" trong tiếng Trung.'],
            ['question' => '"对不起" có nghĩa là:?', 'options' => ['Xin lỗi', 'Cảm ơn', 'Không sao', 'Được rồi'], 'answer' => 'Xin lỗi', 'explanation' => '"对不起" (duìbuqǐ) là cách nói xin lỗi thông thường.'],
            ['question' => 'Cấu trúc câu hỏi "吗" được đặt ở đâu?', 'options' => ['Cuối câu', 'Đầu câu', 'Giữa câu', 'Trước động từ'], 'answer' => 'Cuối câu', 'explanation' => 'Trợ từ "吗" đặt cuối câu để tạo câu hỏi.'],
            ['question' => '"我很好" có nghĩa là gì?', 'options' => ['Tôi rất khỏe', 'Tôi không khỏe', 'Tôi hơi mệt', 'Tôi đói'], 'answer' => 'Tôi rất khỏe', 'explanation' => '"我很好" (wǒ hěn hǎo) = Tôi rất khỏe/tốt.'],
            ['question' => 'Từ "朋友" (péngyou) có nghĩa là:?', 'options' => ['Bạn bè', 'Đồng nghiệp', 'Gia đình', 'Giáo viên'], 'answer' => 'Bạn bè', 'explanation' => '"朋友" (péngyou) = bạn bè.'],
            ['question' => 'Ngày nay trong tiếng Trung nói là:?', 'options' => ['今天 (jīntiān)', '昨天 (zuótiān)', '明天 (míngtiān)', '后天 (hòutiān)'], 'answer' => '今天 (jīntiān)', 'explanation' => '"今天" là "hôm nay", "昨天" là "hôm qua".'],
            ['question' => '"是" (shì) trong câu "他是老师" có nghĩa gì?', 'options' => ['Là', 'Có', 'Ở', 'Muốn'], 'answer' => 'Là', 'explanation' => '"是" là động từ "là".'],
            ['question' => 'Từ "学生" có nghĩa là:?', 'options' => ['Học sinh', 'Giáo viên', 'Bác sĩ', 'Công nhân'], 'answer' => 'Học sinh', 'explanation' => '"学生" (xuésheng) = học sinh.'],
            ['question' => 'Chọn câu đúng: Tôi là người Việt Nam.', 'options' => ['我是越南人。', '我是中国人。', '我是日本人。', '我是韩国人。'], 'answer' => '我是越南人。', 'explanation' => '"越南" (Yuènán) = Việt Nam.'],
        ],
        2 => [
            ['question' => '"比" (bǐ) trong câu so sánh có nghĩa là gì?', 'options' => ['Hơn', 'Bằng', 'Kém', 'Nhất'], 'answer' => 'Hơn', 'explanation' => '"比" là từ so sánh hơn.'],
            ['question' => 'Chọn đúng: 我___你大两岁。', 'options' => ['比', '跟', '有', '给'], 'answer' => '比', 'explanation' => '"我比你大两岁" = Tôi lớn hơn bạn 2 tuổi.'],
            ['question' => '"已经" (yǐjīng) có nghĩa là gì?', 'options' => ['Đã... rồi', 'Đang', 'Sẽ', 'Còn'], 'answer' => 'Đã... rồi', 'explanation' => '"已经" chỉ hành động đã hoàn thành.'],
            ['question' => 'Cấu trúc "正在...呢" diễn tả gì?', 'options' => ['Hành động đang diễn ra', 'Hành động đã xong', 'Hành động sắp xảy ra', 'Sở thích'], 'answer' => 'Hành động đang diễn ra', 'explanation' => '"正在...呢" = đang làm gì.'],
            ['question' => 'Từ "但是" (dànshì) có nghĩa là:?', 'options' => ['Nhưng', 'Vì', 'Nếu', 'Hoặc'], 'answer' => 'Nhưng', 'explanation' => '"但是" là từ nối chỉ sự tương phản.'],
            ['question' => '"怎么样" (zěnmeyàng) dùng để:?', 'options' => ['Hỏi ý kiến', 'Hỏi tên', 'Hỏi tuổi', 'Hỏi địa chỉ'], 'answer' => 'Hỏi ý kiến', 'explanation' => '"怎么样" = thế nào, dùng hỏi ý kiến.'],
            ['question' => 'Chọn đúng: 我___去图书馆。', 'options' => ['想', '会', '能', '可以'], 'answer' => '想', 'explanation' => '"想" (xiǎng) = muốn, thể hiện ý định.'],
            ['question' => '"因为...所以..." có nghĩa là:?', 'options' => ['Vì... nên...', 'Tuy... nhưng...', 'Nếu... thì...', 'Không chỉ... mà còn...'], 'answer' => 'Vì... nên...', 'explanation' => 'Cấu trúc nhân quả.'],
            ['question' => 'Từ "方便" (fāngbiàn) có nghĩa:?', 'options' => ['Tiện lợi', 'Đẹp', 'Nhanh', 'Rẻ'], 'answer' => 'Tiện lợi', 'explanation' => '"方便" = tiện lợi, thuận tiện.'],
            ['question' => 'Số 99 trong tiếng Trung là:?', 'options' => ['九十九', '九十九十', '九百九', '九九个'], 'answer' => '九十九', 'explanation' => '99 = 九十九 (jiǔshíjiǔ).'],
        ],
        3 => [
            ['question' => '"把" (bǎ) trong câu "把窗户打开" có tác dụng gì?', 'options' => ['Nhấn mạnh tân ngữ', 'Chỉ thời gian', 'Chỉ địa điểm', 'Chỉ phương thức'], 'answer' => 'Nhấn mạnh tân ngữ', 'explanation' => 'Câu chữ "把" dùng để nhấn mạnh đối tượng chịu tác động.'],
            ['question' => '"被" (bèi) trong câu bị động có nghĩa:?', 'options' => ['Bị / được', 'Cho', 'Từ', 'Ở'], 'answer' => 'Bị / được', 'explanation' => '"被" đánh dấu câu bị động.'],
            ['question' => '"除了...以外..." có nghĩa:?', 'options' => ['Ngoài... ra...', 'Bao gồm...', 'Trừ khi...', 'Cùng với...'], 'answer' => 'Ngoài... ra...', 'explanation' => '"除了...以外" = ngoài... ra (còn/đều).'],
            ['question' => '"才" (cái) biểu thị điều gì?', 'options' => ['Chỉ sau đó mới', 'Ngay lập tức', 'Luôn luôn', 'Đã từng'], 'answer' => 'Chỉ sau đó mới', 'explanation' => '"才" nhấn mạnh hành động xảy ra muộn.'],
            ['question' => '"就" (jiù) biểu thị:?', 'options' => ['Ngay / liền', 'Muộn', 'Không', 'Có thể'], 'answer' => 'Ngay / liền', 'explanation' => '"就" chỉ sự sớm hoặc tiếp nối nhanh.'],
            ['question' => 'Chọn đúng: 这本书___有意思。', 'options' => ['真', '很', '太', '多'], 'answer' => '真', 'explanation' => '"真" (zhēn) = thật sự, rất (nhấn mạnh cảm thán).'],
            ['question' => '"一边...一边..." có nghĩa:?', 'options' => ['Vừa... vừa...', 'Hoặc... hoặc...', 'Càng... càng...', 'Từ... đến...'], 'answer' => 'Vừa... vừa...', 'explanation' => 'Diễn tả hai hành động song song.'],
            ['question' => '"才" trong "一个小时才到" chỉ:?', 'options' => ['Tốn đến 1 tiếng mới đến', 'Chỉ 1 tiếng là đến', 'Hơn 1 tiếng', 'Chưa đến 1 tiếng'], 'answer' => 'Tốn đến 1 tiếng mới đến', 'explanation' => '"才" nhấn mạnh thời gian lâu hơn dự kiến.'],
            ['question' => '"越来越" (yuèláiyuè) có nghĩa:?', 'options' => ['Càng ngày càng', 'Càng... càng...', 'Từ từ', 'Đột nhiên'], 'answer' => 'Càng ngày càng', 'explanation' => '"越来越" + tính từ = càng ngày càng...'],
            ['question' => 'Cấu trúc "既...又..." có nghĩa:?', 'options' => ['Vừa... vừa...', 'Nếu... thì...', 'Tuy... nhưng...', 'Vì... nên...'], 'answer' => 'Vừa... vừa...', 'explanation' => '"既...又..." = vừa... vừa... (cùng lúc 2 thuộc tính).'],
        ],
        4 => [
            ['question' => '"不仅...而且..." (bùjǐn... érqiě...) có nghĩa là gì?', 'options' => ['Không chỉ... mà còn...', 'Vì... nên...', 'Tuy... nhưng...', 'Nếu... thì...'], 'answer' => 'Không chỉ... mà còn...', 'explanation' => 'Đây là cấu trúc liên từ chỉ sự tăng tiến.'],
            ['question' => '"不管...都..." có nghĩa:?', 'options' => ['Dù... cũng...', 'Vì... nên...', 'Ngoài... ra...', 'Cùng... với...'], 'answer' => 'Dù... cũng...', 'explanation' => '"不管...都..." = bất kể... cũng...'],
            ['question' => '"只要...就..." có nghĩa:?', 'options' => ['Chỉ cần... là...', 'Nếu... thì...', 'Tuy... nhưng...', 'Vừa... vừa...'], 'answer' => 'Chỉ cần... là...', 'explanation' => '"只要...就..." = chỉ cần (điều kiện đủ) là...'],
            ['question' => '"却" (què) trong câu có nghĩa:?', 'options' => ['Lại / nhưng lại', 'Cũng', 'Đều', 'Vẫn'], 'answer' => 'Lại / nhưng lại', 'explanation' => '"却" biểu thị sự chuyển biến/tương phản nhẹ.'],
            ['question' => '"果然" (guǒrán) có nghĩa:?', 'options' => ['Quả nhiên', 'Ngẫu nhiên', 'Tất nhiên', 'Đương nhiên'], 'answer' => 'Quả nhiên', 'explanation' => '"果然" = quả nhiên, đúng như dự đoán.'],
            ['question' => '"偶然" (ǒurán) có nghĩa:?', 'options' => ['Tình cờ', 'Thường xuyên', 'Cố ý', 'Bất ngờ'], 'answer' => 'Tình cờ', 'explanation' => '"偶然" = ngẫu nhiên, tình cờ.'],
            ['question' => '"实际上" (shíjìshang) có nghĩa:?', 'options' => ['Trên thực tế', 'Lý thuyết', 'Có thể', 'Chắc chắn'], 'answer' => 'Trên thực tế', 'explanation' => '"实际上" = trên thực tế, thực ra.'],
            ['question' => '"值得" (zhídé) có nghĩa:?', 'options' => ['Đáng giá', 'Đáng tin', 'Đáng yêu', 'Đáng ghét'], 'answer' => 'Đáng giá', 'explanation' => '"值得" = đáng, xứng đáng.'],
            ['question' => '"对于" (duìyú) có nghĩa:?', 'options' => ['Đối với', 'Từ', 'Ở', 'Bởi'], 'answer' => 'Đối với', 'explanation' => '"对于" = đối với, về (vấn đề gì).'],
            ['question' => '"尤其" (yóuqí) có nghĩa:?', 'options' => ['Đặc biệt là', 'Bình thường', 'Giống nhau', 'Tương tự'], 'answer' => 'Đặc biệt là', 'explanation' => '"尤其" = đặc biệt là, nhất là.'],
        ],
        5 => [
            ['question' => '"无论...都..." có nghĩa là gì?', 'options' => ['Dù... cũng...', 'Vừa... vừa...', 'Càng... càng...', 'Hoặc... hoặc...'], 'answer' => 'Dù... cũng...', 'explanation' => 'Cấu trúc này diễn đạt ý "bất kể thế nào cũng..."'],
            ['question' => '"毕竟" (bìjìng) có nghĩa:?', 'options' => ['Dù sao cũng', 'Cuối cùng', 'Sau cùng', 'Từ đầu'], 'answer' => 'Dù sao cũng', 'explanation' => '"毕竟" = dù sao đi nữa, suy cho cùng.'],
            ['question' => '"纷纷" (fēnfēn) có nghĩa:?', 'options' => ['Lần lượt / ùn ùn', 'Vội vàng', 'Chậm rãi', 'Im lặng'], 'answer' => 'Lần lượt / ùn ùn', 'explanation' => '"纷纷" = lần lượt, liên tiếp, ùn ùn kéo đến.'],
            ['question' => '"仿佛" (fǎngfú) có nghĩa:?', 'options' => ['Như thể / dường như', 'Rõ ràng', 'Chắc chắn', 'Tương tự'], 'answer' => 'Như thể / dường như', 'explanation' => '"仿佛" = dường như, tựa như.'],
            ['question' => '"逐渐" (zhújiàn) có nghĩa:?', 'options' => ['Dần dần', 'Đột nhiên', 'Nhanh chóng', 'Thường xuyên'], 'answer' => 'Dần dần', 'explanation' => '"逐渐" = dần dần, từ từ.'],
            ['question' => '"毕竟" khác "终于" ở điểm:?', 'options' => ['毕竟 nhấn mạnh lý do, 终于 nhấn mạnh kết quả', 'Giống nhau', 'Đều chỉ thời gian', 'Đều chỉ nguyên nhân'], 'answer' => '毕竟 nhấn mạnh lý do, 终于 nhấn mạnh kết quả', 'explanation' => '"毕竟" suy cho cùng; "终于" cuối cùng cũng.'],
            ['question' => '"核心" (héxīn) có nghĩa:?', 'options' => ['Cốt lõi', 'Bên ngoài', 'Trung tâm', 'Biên giới'], 'answer' => 'Cốt lõi', 'explanation' => '"核心" = cốt lõi, hạt nhân.'],
            ['question' => '"趋势" (qūshì) có nghĩa:?', 'options' => ['Xu hướng', 'Phương hướng', 'Kết quả', 'Nguyên nhân'], 'answer' => 'Xu hướng', 'explanation' => '"趋势" = xu thế, xu hướng.'],
            ['question' => '"预算" (yùsuàn) có nghĩa:?', 'options' => ['Ngân sách / dự toán', 'Kế hoạch', 'Mục tiêu', 'Chi phí'], 'answer' => 'Ngân sách / dự toán', 'explanation' => '"预算" = dự toán ngân sách.'],
            ['question' => '"执行" (zhíxíng) có nghĩa:?', 'options' => ['Thực thi / chấp hành', 'Lên kế hoạch', 'Kiểm tra', 'Đánh giá'], 'answer' => 'Thực thi / chấp hành', 'explanation' => '"执行" = thực hiện, thi hành.'],
        ],
        6 => [
            ['question' => '"全球化" (quánqiúhuà) có nghĩa là gì?', 'options' => ['Toàn cầu hóa', 'Hiện đại hóa', 'Công nghiệp hóa', 'Đô thị hóa'], 'answer' => 'Toàn cầu hóa', 'explanation' => '"全球化" là thuật ngữ chỉ quá trình toàn cầu hóa.'],
            ['question' => '"潜移默化" (qiányí-mòhuà) có nghĩa:?', 'options' => ['Thấm nhuần / ngấm ngầm', 'Rõ ràng', 'Tức thời', 'Mạnh mẽ'], 'answer' => 'Thấm nhuần / ngấm ngầm', 'explanation' => 'Thành ngữ chỉ sự ảnh hưởng âm thầm, lâu dài.'],
            ['question' => '"不可思议" (bùkě-sīyì) có nghĩa:?', 'options' => ['Không thể tưởng tượng', 'Rất bình thường', 'Có thể hiểu được', 'Dễ dàng'], 'answer' => 'Không thể tưởng tượng', 'explanation' => 'Thành ngữ = không thể nghĩ bàn, khó tin.'],
            ['question' => '"名副其实" (míngfù-qíshí) có nghĩa:?', 'options' => ['Danh bất hư truyền', 'Không đúng tên', 'Nổi tiếng', 'Vô danh'], 'answer' => 'Danh bất hư truyền', 'explanation' => 'Thành ngữ = danh xứng với thực.'],
            ['question' => '"层出不穷" (céngchū-bùqióng) có nghĩa:?', 'options' => ['Xuất hiện liên tục', 'Biến mất dần', 'Ngày càng ít', 'Đột ngột dừng'], 'answer' => 'Xuất hiện liên tục', 'explanation' => 'Thành ngữ = xuất hiện không ngừng, tầng tầng lớp lớp.'],
            ['question' => '"归根结底" (guīgēn-jiédǐ) có nghĩa:?', 'options' => ['Rốt cuộc / suy cho cùng', 'Bắt đầu', 'Kết thúc', 'Nguyên nhân'], 'answer' => 'Rốt cuộc / suy cho cùng', 'explanation' => 'Thành ngữ = quy kết đến tận cùng.'],
            ['question' => '"敬业精神" (jìngyè jīngshén) là:?', 'options' => ['Tinh thần trách nhiệm', 'Tinh thần đồng đội', 'Tinh thần sáng tạo', 'Tinh thần thể thao'], 'answer' => 'Tinh thần trách nhiệm', 'explanation' => '"敬业" = kính nghiệp, yêu nghề.'],
            ['question' => '"奢侈" (shēchǐ) có nghĩa:?', 'options' => ['Xa xỉ', 'Tiết kiệm', 'Giản dị', 'Cần cù'], 'answer' => 'Xa xỉ', 'explanation' => '"奢侈" = xa xỉ, lãng phí.'],
            ['question' => '"冲突" (chōngtū) có nghĩa:?', 'options' => ['Xung đột', 'Hòa hợp', 'Hợp tác', 'Thỏa hiệp'], 'answer' => 'Xung đột', 'explanation' => '"冲突" = xung đột, mâu thuẫn.'],
            ['question' => '"繁荣" (fánróng) có nghĩa:?', 'options' => ['Phồn vinh', 'Suy thoái', 'Ổn định', 'Phát triển'], 'answer' => 'Phồn vinh', 'explanation' => '"繁荣" = phồn vinh, thịnh vượng.'],
        ],
    ];
}

echo "Seeded exam templates and questions successfully!\n";
