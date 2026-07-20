<?php
/**
 * Dữ liệu mặc định cho 6 khóa học HSK trả phí.
 *
 * File này được gọi bởi cả trang migration và CLI migration. Mỗi lần chạy đều
 * an toàn: cập nhật thông tin của 6 khóa HSK chuẩn, chỉ bổ sung bài học còn
 * thiếu và đồng bộ chương học theo đúng cấp HSK.
 */

function commerceDefaultCourseCatalog(): array
{
    return [
        [
            'slug' => 'hsk-1-nen-tang',
            'title' => 'HSK 1 · Nền tảng tiếng Trung từ số 0',
            'price' => 1490000,
            'short_description' => '8 bài học nền tảng về Pinyin, chào hỏi, số đếm, gia đình, thời gian và giao tiếp đời sống.',
            'description' => "Khóa HSK 1 dành cho người mới bắt đầu hoặc chưa vững phát âm. Lộ trình đi từ Pinyin, thanh điệu và các mẫu câu thiết yếu đến tình huống hằng ngày.\n\nBạn sẽ học cách giới thiệu bản thân, hỏi thông tin, dùng số đếm, nói về gia đình, thời gian, đồ ăn, thời tiết và chỉ đường. Mỗi bài gồm từ vựng, pinyin, nghĩa tiếng Việt, ví dụ, luyện viết chữ Hán và bài luyện tập trên hệ thống.\n\nHoàn thành khóa học, bạn có thể tự giới thiệu, thực hiện các hội thoại ngắn và xây nền phát âm để tiếp tục HSK 2.",
            'hsk_level' => 1,
        ],
        [
            'slug' => 'hsk-2-giao-tiep',
            'title' => 'HSK 2 · Giao tiếp cơ bản',
            'price' => 1790000,
            'short_description' => '7 bài học giao tiếp thực tế: mua sắm, du lịch, sức khỏe, sở thích, công việc, Internet và trường học.',
            'description' => "Khóa HSK 2 giúp bạn mở rộng phản xạ giao tiếp sau nền tảng HSK 1. Nội dung bám sát các tình huống thường gặp khi mua sắm, đi lại, khám bệnh, nói về sở thích và công việc.\n\nBạn được luyện cách hỏi giá, nói về phương tiện, diễn tả trạng thái với 了, nói sở thích với 喜欢/爱, sử dụng 在 và 用 trong câu. Các bài học liên kết trực tiếp với bộ từ vựng, flashcard, viết chữ Hán và phần luyện tập của website.\n\nSau khóa học, bạn có thể xử lý hội thoại ngắn trong bối cảnh đời sống, mô tả nhu cầu của mình và sẵn sàng chuyển sang HSK 3.",
            'hsk_level' => 2,
        ],
        [
            'slug' => 'hsk-3-so-cap',
            'title' => 'HSK 3 · Sơ cấp nâng cao',
            'price' => 2190000,
            'short_description' => '5 chuyên đề mở rộng từ vựng và ngữ pháp về ngân hàng, văn hóa, môi trường, thương mại và công nghệ.',
            'description' => "HSK 3 là bước chuyển từ giao tiếp câu ngắn sang diễn đạt có chủ đề. Khóa học tập trung vào từ vựng dùng được trong giao dịch, văn hóa, thiên nhiên, kinh doanh và công nghệ.\n\nBạn sẽ thực hành các cấu trúc như 去 + địa điểm + động từ, 保护/爱护 + danh từ, 发展/投资 + danh từ và cách dùng từ nối để trình bày ý rõ ràng hơn. Lộ trình có bài học theo chủ đề, luyện từ vựng, viết chữ Hán và ôn tập trực tiếp trên web.\n\nKết thúc khóa, bạn có nền tảng để đọc hiểu đoạn văn ngắn, trao đổi về các chủ đề quen thuộc và bước vào trình độ trung cấp HSK 4.",
            'hsk_level' => 3,
        ],
        [
            'slug' => 'hsk-4-trung-cap',
            'title' => 'HSK 4 · Trung cấp toàn diện',
            'price' => 2790000,
            'short_description' => '10 bài học trung cấp về đời sống, sự nghiệp, du lịch, văn hóa, cảm xúc, khoa học và môi trường.',
            'description' => "Khóa HSK 4 dành cho người đã có nền tảng sơ cấp và muốn giao tiếp tự nhiên hơn trong học tập, công việc và cuộc sống. Giáo trình gồm 10 bài theo chủ đề, kết hợp từ vựng, đọc hiểu, cách diễn đạt và cấu trúc ngữ pháp trung cấp.\n\nCác điểm trọng tâm gồm 已经/正在/将要, 从…到…, 除了…以外, 对…感兴趣, 感到/觉得, 如果…就… và cách liên kết ý trong câu dài hơn. Bạn học qua tình huống thực tế về thói quen, công việc, tiêu dùng, giáo dục, xã hội và công nghệ.\n\nHoàn thành khóa, bạn có thể tự tin xử lý các đoạn hội thoại dài hơn, đọc nội dung quen thuộc và xây nền ôn HSK 4.",
            'hsk_level' => 4,
        ],
        [
            'slug' => 'hsk-5-nang-cao',
            'title' => 'HSK 5 · Nâng cao đọc – viết',
            'price' => 3490000,
            'short_description' => '10 chuyên đề nâng cao về kinh tế, văn học, luật pháp, ngoại giao, y học, truyền thông và khoa học xã hội.',
            'description' => "Khóa HSK 5 phát triển năng lực đọc hiểu và diễn đạt ở các chủ đề học thuật, nghề nghiệp và xã hội. Lộ trình gồm 10 chuyên đề có độ khó tăng dần, phù hợp với người học muốn mở rộng vốn từ và làm quen văn phong trang trọng.\n\nBạn sẽ luyện các cấu trúc như 不仅…而且…, 根据/按照…, 无论…都…, 即使…也…, 对于…, 通过…, 由于… và 以… để triển khai lập luận. Từng bài kết nối từ vựng, ví dụ câu, luyện chữ Hán và bài thực hành sẵn có trên hệ thống.\n\nSau khóa, bạn có thể hiểu nội dung dài hơn, trình bày ý kiến rõ ràng hơn và có lộ trình chắc chắn để tiếp tục HSK 6.",
            'hsk_level' => 5,
        ],
        [
            'slug' => 'hsk-6-chuyen-sau',
            'title' => 'HSK 6 · Chuyên sâu & luyện kỹ năng',
            // Mở miễn phí để kiểm tra nội dung khóa HSK 6.
            'price' => 0,
            'short_description' => '10 chuyên đề chuyên sâu về tư tưởng, khoa học, lịch sử, quản lý, công nghệ, y học và toàn cầu hóa.',
            'description' => "Khóa HSK 6 dành cho người học trình độ cao muốn nâng năng lực đọc hiểu, tổng hợp thông tin và diễn đạt ý phức tạp. Giáo trình gồm 10 chuyên đề mở rộng từ triết học, khoa học, lịch sử đến quản lý, công nghệ và toàn cầu hóa.\n\nBạn làm quen với các cấu trúc mang tính lập luận như 从…角度来看, 之所以…是因为…, 由此可见, 尽管如此, 与其…不如…, 基于…, 以至于… và 从…出发. Mỗi chuyên đề đi kèm nội dung từ vựng, ví dụ và bài học tương tác để ôn tập có hệ thống.\n\nHoàn thành lộ trình, bạn có thể tiếp cận văn bản khó hơn, nêu quan điểm có lập luận và chủ động ôn luyện kỹ năng ở trình độ HSK cao.",
            'hsk_level' => 6,
        ],
    ];
}

/**
 * Bài học dự phòng cho các bản CSDL cũ chưa có đủ giáo trình HSK 1–6.
 * Không ghi đè bài học hiện hữu để quản trị viên vẫn có thể chỉnh sửa nội dung.
 */
function commerceDefaultLessonCatalog(): array
{
    return [
        1 => [
            [1, 'Chào hỏi & Giới thiệu', 'Học cách chào hỏi, giới thiệu bản thân', 8, 'Cấu trúc: Subject + 是 + Object', 'vocab'],
            [2, 'Số đếm & Đếm số', 'Số từ 0–100, cách đếm cơ bản', 10, 'Số + danh từ', 'vocab'],
            [3, 'Gia đình & Quan hệ', 'Tên gọi trong gia đình và quan hệ', 8, 'Cái/Ai/Con gì', 'vocab'],
            [4, 'Thời gian & Ngày tháng', 'Ngày, tháng, năm và giờ giấc', 10, 'Mấy giờ/Ngày nào', 'vocab'],
            [5, 'Màu sắc & Hình dạng', 'Tên màu sắc, hình dạng và mô tả cơ bản', 8, 'Tính từ + danh từ', 'vocab'],
            [6, 'Đồ ăn & Thức uống', 'Tên món ăn, đồ uống hằng ngày', 10, 'Động từ + tân ngữ: 吃/喝 + danh từ', 'vocab'],
            [7, 'Thời tiết & Mùa', 'Thời tiết và các mùa trong năm', 8, '今天 + tính từ; miêu tả thời tiết', 'vocab'],
            [8, 'Phương hướng & Vị trí', 'Chỉ đường, vị trí và phương hướng', 8, 'Danh từ chỉ hướng + 边/面', 'vocab'],
        ],
        2 => [
            [9, 'Mua sắm & Giá cả', 'Mua bán, hỏi giá và thanh toán', 10, '多少钱？; chủ ngữ + giá tiền', 'vocab'],
            [10, 'Du lịch & Phương tiện', 'Tàu xe, máy bay và khách sạn', 10, '坐/骑/开 + phương tiện', 'vocab'],
            [11, 'Sức khỏe & Bệnh viện', 'Khám bệnh, thuốc men và sức khỏe', 8, '了 chỉ sự thay đổi trạng thái', 'vocab'],
            [12, 'Sở thích & Thể thao', 'Thể thao và sở thích cá nhân', 10, '喜欢/爱 + động từ', 'vocab'],
            [13, 'Công việc & Nghề nghiệp', 'Nghề nghiệp và công việc hằng ngày', 8, '在 + nơi chốn + động từ', 'vocab'],
            [14, 'Điện thoại & Internet', 'Gọi điện, thiết bị và Internet', 8, '用 + công cụ + động từ', 'vocab'],
            [15, 'Giáo dục & Trường học', 'Học tập, trường lớp và bài tập', 8, '在 + địa điểm + động từ', 'vocab'],
        ],
        3 => [
            [16, 'Ngân hàng & Bưu điện', 'Giao dịch ngân hàng và gửi thư', 8, '去 + địa điểm + động từ', 'vocab'],
            [17, 'Văn hóa & Phong tục', 'Tết, lễ hội và phong tục tập quán', 8, '过 + Tết/Lễ hội', 'vocab'],
            [18, 'Môi trường & Thiên nhiên', 'Bảo vệ môi trường, động thực vật', 8, '保护/爱护 + danh từ', 'vocab'],
            [19, 'Kinh tế & Thương mại', 'Kinh doanh, hợp đồng và thị trường', 8, '发展/投资 + danh từ', 'vocab'],
            [20, 'Công nghệ & Khoa học', 'Máy tính, khoa học và kỹ thuật', 8, '人工智能/技术 + danh từ', 'vocab'],
        ],
        4 => [
            [1, 'Cuộc sống hằng ngày', 'Thói quen và sinh hoạt thường ngày', 10, '每天/经常 + động từ', 'vocab'],
            [2, 'Công việc & Sự nghiệp', 'Môi trường làm việc và thăng tiến', 10, '已经/正在/将要 + động từ', 'vocab'],
            [3, 'Sức khỏe & Thể thao', 'Tập luyện, sức khỏe và bệnh tật', 10, '多/少 + động từ', 'vocab'],
            [4, 'Du lịch & Giao thông', 'Đi lại, khách sạn và phương tiện', 10, '从 + nơi chốn + 到 + nơi chốn', 'vocab'],
            [5, 'Mua sắm & Tiêu dùng', 'Mua bán, dịch vụ và thanh toán', 10, '太 + tính từ + 了', 'vocab'],
            [6, 'Giáo dục & Học tập', 'Trường lớp và phương pháp học', 10, '除了…以外, 还/也…', 'vocab'],
            [7, 'Văn hóa & Xã hội', 'Phong tục, lễ hội và xã hội', 10, '对 + danh từ + 感兴趣', 'vocab'],
            [8, 'Cảm xúc & Tâm trạng', 'Vui buồn, lo lắng và hy vọng', 10, '感到/觉得 + tính từ', 'vocab'],
            [9, 'Khoa học & Công nghệ', 'Internet, máy tính và phát minh', 10, '越来 + 越 + tính từ', 'vocab'],
            [10, 'Môi trường & Thiên nhiên', 'Bảo vệ môi trường và thời tiết', 10, '如果…就…', 'vocab'],
        ],
        5 => [
            [1, 'Kinh tế & Tài chính', 'Thị trường, đầu tư và ngân hàng', 10, '随着 + danh từ', 'vocab'],
            [2, 'Nghệ thuật & Văn học', 'Hội họa, âm nhạc và văn chương', 10, '不仅…而且…', 'vocab'],
            [3, 'Luật pháp & Chính trị', 'Pháp luật, chính quyền và quyền lợi', 10, '根据/按照 + danh từ', 'vocab'],
            [4, 'Ngoại giao & Quan hệ quốc tế', 'Đối ngoại, hòa bình và hợp tác', 10, '无论…都…', 'vocab'],
            [5, 'Y học & Dược phẩm', 'Bệnh viện, thuốc men và điều trị', 10, '即使…也…', 'vocab'],
            [6, 'Báo chí & Truyền thông', 'Tin tức, báo đài và mạng xã hội', 10, '对于 + danh từ', 'vocab'],
            [7, 'Kiến trúc & Xây dựng', 'Nhà cửa, công trình và thiết kế', 10, '通过 + danh từ/động từ', 'vocab'],
            [8, 'Ẩm thực & Nấu nướng', 'Món ăn, nguyên liệu và chế biến', 10, '之一', 'vocab'],
            [9, 'Thể thao chuyên nghiệp', 'Giải đấu, vận động viên và kỷ lục', 10, '由于 + danh từ', 'vocab'],
            [10, 'Khoa học xã hội', 'Xã hội học, tâm lý và giáo dục', 10, '以 + động từ', 'vocab'],
        ],
        6 => [
            [1, 'Triết học & Tư tưởng', 'Tư duy, học thuyết và quan điểm', 10, '从…角度/方面来看', 'vocab'],
            [2, 'Khoa học tự nhiên', 'Vật lý, hóa học và sinh học', 10, '之所以…是因为…', 'vocab'],
            [3, 'Lịch sử & Khảo cổ', 'Sử ký, di tích và văn minh', 10, '由此可见…', 'vocab'],
            [4, 'Kinh doanh & Quản lý', 'Chiến lược, lãnh đạo và tổ chức', 10, '尽管如此…', 'vocab'],
            [5, 'Quân sự & Quốc phòng', 'An ninh, chiến tranh và hòa bình', 10, '不但…反而…', 'vocab'],
            [6, 'Tôn giáo & Tín ngưỡng', 'Đức tin, lễ nghi và tâm linh', 10, '与其…不如…', 'vocab'],
            [7, 'Mỹ thuật & Thiết kế', 'Hội họa, điêu khắc và thời trang', 10, '凡是…都…', 'vocab'],
            [8, 'Công nghệ thông tin', 'AI, dữ liệu và lập trình', 10, '基于 + danh từ', 'vocab'],
            [9, 'Y học hiện đại', 'Di truyền, giải phẫu và công nghệ y', 10, '以至于…', 'vocab'],
            [10, 'Toàn cầu hóa', 'Hội nhập, đa văn hóa và phát triển', 10, '从…出发…', 'vocab'],
        ],
    ];
}

/**
 * Tạo/cập nhật 6 khóa HSK và đồng bộ bài học của từng khóa.
 *
 * @return array{courses:int,lessons_added:int,lesson_counts:array<int,int>}
 */
function commerceSeedPaidCourses(PDO $conn): array
{
    $courses = commerceDefaultCourseCatalog();
    $lessonCatalog = commerceDefaultLessonCatalog();
    $lessonsAdded = 0;

    $findLesson = $conn->prepare(
        'SELECT id FROM lessons WHERE level = ? AND lesson_num = ? ORDER BY id ASC LIMIT 1'
    );
    $insertLesson = $conn->prepare(
        'INSERT INTO lessons (level, lesson_num, title, description, vocab_count, grammar, type)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );

    foreach ($lessonCatalog as $level => $lessons) {
        foreach ($lessons as $lesson) {
            [$lessonNum, $title, $description, $vocabCount, $grammar, $type] = $lesson;
            $findLesson->execute([$level, $lessonNum]);
            if (!$findLesson->fetchColumn()) {
                $insertLesson->execute([$level, $lessonNum, $title, $description, $vocabCount, $grammar, $type]);
                $lessonsAdded++;
            }
        }
    }

    $upsertCourse = $conn->prepare(
        'INSERT INTO courses (slug, title, price, short_description, description, hsk_level, is_published)
         VALUES (?, ?, ?, ?, ?, ?, 1)
         ON DUPLICATE KEY UPDATE
            title = VALUES(title),
            price = VALUES(price),
            short_description = VALUES(short_description),
            description = VALUES(description),
            hsk_level = VALUES(hsk_level),
            is_published = 1'
    );

    foreach ($courses as $course) {
        $upsertCourse->execute([
            $course['slug'],
            $course['title'],
            $course['price'],
            $course['short_description'],
            $course['description'],
            $course['hsk_level'],
        ]);
    }

    $removeWrongLevelLinks = $conn->prepare(
        'DELETE cl
         FROM course_lessons cl
         INNER JOIN courses c ON c.id = cl.course_id
         INNER JOIN lessons l ON l.id = cl.lesson_id
         WHERE c.slug = ? AND l.level <> ?'
    );
    $findCourse = $conn->prepare('SELECT id FROM courses WHERE slug = ? LIMIT 1');
    $findLevelLessons = $conn->prepare(
        'SELECT id FROM lessons WHERE level = ? ORDER BY lesson_num ASC, id ASC'
    );
    $upsertLink = $conn->prepare(
        'INSERT INTO course_lessons (course_id, lesson_id, sort_order)
         VALUES (?, ?, ?)
         ON DUPLICATE KEY UPDATE sort_order = VALUES(sort_order)'
    );

    $lessonCounts = [];
    foreach ($courses as $course) {
        $level = (int) $course['hsk_level'];
        $removeWrongLevelLinks->execute([$course['slug'], $level]);
        $findCourse->execute([$course['slug']]);
        $courseId = (int) $findCourse->fetchColumn();
        if ($courseId <= 0) {
            throw new RuntimeException('Không thể xác định khóa học: ' . $course['slug']);
        }

        $findLevelLessons->execute([$level]);
        $lessonIds = $findLevelLessons->fetchAll(PDO::FETCH_COLUMN);
        foreach ($lessonIds as $sortOrder => $lessonId) {
            $upsertLink->execute([$courseId, (int) $lessonId, $sortOrder + 1]);
        }
        $lessonCounts[$level] = count($lessonIds);
    }

    return [
        'courses' => count($courses),
        'lessons_added' => $lessonsAdded,
        'lesson_counts' => $lessonCounts,
    ];
}
