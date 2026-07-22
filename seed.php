<?php
// HànNgữ - Seed dữ liệu mẫu
// Chạy: php seed.php
// Sau đó chạy: php path/to/seed_hsk4_6.php (để có thêm HSK 4-6)
require 'db.php';

$count = $conn->query("SELECT COUNT(*) FROM vocab")->fetchColumn();
echo "Current vocab: $count\n";
if ($count > 50) { echo "Already seeded (>=50), skipping.\n"; exit; }

// Xóa dữ liệu cũ nếu có để tránh trùng
$conn->exec("SET FOREIGN_KEY_CHECKS = 0");
$conn->exec("DELETE FROM vocab WHERE id > 50");
$conn->exec("DELETE FROM lessons WHERE id > 5");
$conn->exec("DELETE FROM progress");
$conn->exec("DELETE FROM notebook");
$conn->exec("DELETE FROM quiz_results");
$conn->exec("DELETE FROM posts");
$conn->exec("SET FOREIGN_KEY_CHECKS = 1");

// Reset AUTO_INCREMENT
$conn->exec("ALTER TABLE vocab AUTO_INCREMENT = 51");
$conn->exec("ALTER TABLE lessons AUTO_INCREMENT = 6");

// 15 lessons mới - lesson_num starts at 6 (5 existing)
$num = 6;
$lessons = [
    [6,  $num++, 'Đồ ăn & Thức uống', 1, 10, 'Tên món ăn, đồ uống hàng ngày'],
    [7,  $num++, 'Thời tiết & Mùa', 1, 8, 'Thời tiết, các mùa trong năm'],
    [8,  $num++, 'Phương hướng & Vị trí', 1, 8, 'Chỉ đường, vị trí'],
    [9,  $num++, 'Mua sắm & Giá cả', 2, 10, 'Mua bán, hỏi giá, thanh toán'],
    [10, $num++, 'Du lịch & Phương tiện', 2, 10, 'Tàu xe, máy bay, khách sạn'],
    [11, $num++, 'Sức khỏe & Bệnh viện', 2, 8, 'Khám bệnh, thuốc men'],
    [12, $num++, 'Sở thích & Thể thao', 2, 10, 'Thể thao, sở thích cá nhân'],
    [13, $num++, 'Công việc & Nghề nghiệp', 2, 8, 'Nghề nghiệp, công việc hàng ngày'],
    [14, $num++, 'Điện thoại & Internet', 2, 8, 'Gọi điện, mạng internet'],
    [15, $num++, 'Giáo dục & Trường học', 2, 8, 'Học tập, trường lớp'],
    [16, $num++, 'Ngân hàng & Bưu điện', 3, 8, 'Giao dịch ngân hàng, gửi thư'],
    [17, $num++, 'Văn hóa & Phong tục', 3, 8, 'Tết, lễ hội, phong tục tập quán'],
    [18, $num++, 'Môi trường & Thiên nhiên', 3, 8, 'Bảo vệ môi trường, động thực vật'],
    [19, $num++, 'Kinh tế & Thương mại', 3, 8, 'Kinh doanh, hợp đồng, thị trường'],
    [20, $num++, 'Công nghệ & Khoa học', 3, 8, 'Máy tính, khoa học kỹ thuật'],
];

echo "Adding lessons... ";
$li = $conn->prepare("INSERT INTO lessons (id, lesson_num, title, level, vocab_count, description) VALUES (?, ?, ?, ?, ?, ?)");
foreach ($lessons as $l) {
    $li->execute([$l[0], $l[1], $l[2], $l[3], $l[4], $l[5]]);
}
echo "15 lessons added.\n";

// 300+ từ vựng mới
$vocab = $conn->prepare("INSERT INTO vocab (id, hanzi, pinyin, meaning, level, strokes, radical, example, lesson_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$idx = 50;
$data = [];

// HSK 1 - Lesson 6: Đồ ăn & Thức uống (id 51-60)
$data[] = [++$idx, '面包', 'miànbāo', 'bánh mì', 1, 0, '', '吃面包。', 6];
$data[] = [++$idx, '鸡蛋', 'jīdàn', 'trứng gà', 1, 0, '', '一个鸡蛋。', 6];
$data[] = [++$idx, '牛肉', 'niúròu', 'thịt bò', 1, 0, '', '牛肉面。', 6];
$data[] = [++$idx, '鸡肉', 'jīròu', 'thịt gà', 1, 0, '', '鸡肉饭。', 6];
$data[] = [++$idx, '鱼', 'yú', 'cá', 1, 8, '鱼', '吃鱼。', 6];
$data[] = [++$idx, '水果', 'shuǐguǒ', 'hoa quả', 1, 0, '', '吃水果。', 6];
$data[] = [++$idx, '面条', 'miàntiáo', 'mì sợi', 1, 0, '', '吃面条。', 6];
$data[] = [++$idx, '蛋糕', 'dàngāo', 'bánh gatô', 1, 0, '', '生日蛋糕。', 6];
$data[] = [++$idx, '果汁', 'guǒzhī', 'nước hoa quả', 1, 0, '', '喝果汁。', 6];
$data[] = [++$idx, '糖', 'táng', 'kẹo, đường', 1, 16, '米', '吃糖。', 6];

// HSK 1 - Lesson 7: Thời tiết & Mùa (61-68)
$data[] = [++$idx, '天气', 'tiānqì', 'thời tiết', 1, 0, '', '天气好。', 7];
$data[] = [++$idx, '冷', 'lěng', 'lạnh', 1, 7, '冫', '很冷。', 7];
$data[] = [++$idx, '热', 'rè', 'nóng', 1, 10, '灬', '很热。', 7];
$data[] = [++$idx, '下雨', 'xiàyǔ', 'mưa', 1, 0, '', '下雨了。', 7];
$data[] = [++$idx, '刮风', 'guāfēng', 'gió', 1, 0, '', '刮大风。', 7];
$data[] = [++$idx, '晴天', 'qíngtiān', 'trời nắng', 1, 0, '', '今天晴天。', 7];
$data[] = [++$idx, '阴天', 'yīntiān', 'trời âm u', 1, 0, '', '明天阴天。', 7];
$data[] = [++$idx, '暖和', 'nuǎnhuo', 'ấm áp', 1, 0, '', '天气暖和。', 7];

// HSK 1 - Lesson 8: Phương hướng & Vị trí (69-76)
$data[] = [++$idx, '前', 'qián', 'trước', 1, 9, '丷', '前面。', 8];
$data[] = [++$idx, '后', 'hòu', 'sau', 1, 6, '厂', '后面。', 8];
$data[] = [++$idx, '左', 'zuǒ', 'trái', 1, 5, '工', '左边。', 8];
$data[] = [++$idx, '右', 'yòu', 'phải', 1, 5, '口', '右边。', 8];
$data[] = [++$idx, '上', 'shàng', 'trên', 1, 3, '一', '上面。', 8];
$data[] = [++$idx, '下', 'xià', 'dưới', 1, 3, '一', '下面。', 8];
$data[] = [++$idx, '里', 'lǐ', 'trong', 1, 7, '里', '里面。', 8];
$data[] = [++$idx, '外', 'wài', 'ngoài', 1, 5, '夕', '外面。', 8];

// HSK 2 - Lesson 9: Mua sắm & Giá cả (77-86)
$data[] = [++$idx, '商店', 'shāngdiàn', 'cửa hàng', 2, 0, '', '去商店。', 9];
$data[] = [++$idx, '超市', 'chāoshì', 'siêu thị', 2, 0, '', '去超市。', 9];
$data[] = [++$idx, '便宜', 'piányi', 'rẻ', 2, 0, '', '很便宜。', 9];
$data[] = [++$idx, '贵', 'guì', 'đắt', 2, 9, '贝', '太贵了。', 9];
$data[] = [++$idx, '钱', 'qián', 'tiền', 2, 10, '金', '多少钱？', 9];
$data[] = [++$idx, '买', 'mǎi', 'mua', 2, 6, '乛', '买东西。', 9];
$data[] = [++$idx, '卖', 'mài', 'bán', 2, 8, '十', '卖完了。', 9];
$data[] = [++$idx, '还价', 'huánjià', 'trả giá', 2, 0, '', '可以还价吗？', 9];
$data[] = [++$idx, '打折', 'dǎzhé', 'giảm giá', 2, 0, '', '打折吗？', 9];
$data[] = [++$idx, '免费', 'miǎnfèi', 'miễn phí', 2, 0, '', '免费入场。', 9];

// HSK 2 - Lesson 10: Du lịch & Phương tiện (87-96)
$data[] = [++$idx, '飞机', 'fēijī', 'máy bay', 2, 0, '', '坐飞机。', 10];
$data[] = [++$idx, '火车', 'huǒchē', 'tàu hỏa', 2, 0, '', '坐火车。', 10];
$data[] = [++$idx, '地铁', 'dìtiě', 'tàu điện ngầm', 2, 0, '', '坐地铁。', 10];
$data[] = [++$idx, '公共汽车', 'gōnggòng qìchē', 'xe buýt', 2, 0, '', '坐公共汽车。', 10];
$data[] = [++$idx, '出租車', 'chūzūchē', 'taxi', 2, 0, '', '打出租车。', 10];
$data[] = [++$idx, '自行车', 'zìxíngchē', 'xe đạp', 2, 0, '', '骑自行车。', 10];
$data[] = [++$idx, '站', 'zhàn', 'bến, ga', 2, 10, '立', '火车站。', 10];
$data[] = [++$idx, '票', 'piào', 'vé', 2, 11, '示', '买票。', 10];
$data[] = [++$idx, '酒店', 'jiǔdiàn', 'khách sạn', 2, 0, '', '住酒店。', 10];
$data[] = [++$idx, '旅行', 'lǚxíng', 'du lịch', 2, 0, '', '去旅行。', 10];

// HSK 2 - Lesson 11: Sức khỏe & Bệnh viện (97-104)
$data[] = [++$idx, '医院', 'yīyuàn', 'bệnh viện', 2, 0, '', '去医院。', 11];
$data[] = [++$idx, '医生', 'yīshēng', 'bác sĩ', 2, 0, '', '看医生。', 11];
$data[] = [++$idx, '生病', 'shēngbìng', 'bị ốm', 2, 0, '', '生病了。', 11];
$data[] = [++$idx, '药', 'yào', 'thuốc', 2, 9, '艹', '吃药。', 11];
$data[] = [++$idx, '休息', 'xiūxi', 'nghỉ ngơi', 2, 0, '', '多休息。', 11];
$data[] = [++$idx, '锻炼', 'duànliàn', 'tập luyện', 2, 0, '', '锻炼身体。', 11];
$data[] = [++$idx, '身体', 'shēntǐ', 'cơ thể', 2, 0, '', '身体健康。', 11];
$data[] = [++$idx, '健康', 'jiànkāng', 'khỏe mạnh', 2, 0, '', '祝你健康！', 11];

// HSK 2 - Lesson 12: Sở thích & Thể thao (105-114)
$data[] = [++$idx, '运动', 'yùndòng', 'vận động', 2, 0, '', '做运动。', 12];
$data[] = [++$idx, '跑步', 'pǎobù', 'chạy bộ', 2, 0, '', '去跑步。', 12];
$data[] = [++$idx, '游泳', 'yóuyǒng', 'bơi lội', 2, 0, '', '去游泳。', 12];
$data[] = [++$idx, '足球', 'zúqiú', 'bóng đá', 2, 0, '', '踢足球。', 12];
$data[] = [++$idx, '篮球', 'lánqiú', 'bóng rổ', 2, 0, '', '打篮球。', 12];
$data[] = [++$idx, '唱歌', 'chànggē', 'hát', 2, 0, '', '喜欢唱歌。', 12];
$data[] = [++$idx, '跳舞', 'tiàowǔ', 'nhảy múa', 2, 0, '', '喜欢跳舞。', 12];
$data[] = [++$idx, '音乐', 'yīnyuè', 'âm nhạc', 2, 0, '', '听音乐。', 12];
$data[] = [++$idx, '电影', 'diànyǐng', 'phim ảnh', 2, 0, '', '看电影。', 12];
$data[] = [++$idx, '电视', 'diànshì', 'tivi', 2, 0, '', '看电视。', 12];

// HSK 2 - Lesson 13: Công việc & Nghề nghiệp (115-122)
$data[] = [++$idx, '工作', 'gōngzuò', 'công việc', 2, 0, '', '去工作。', 13];
$data[] = [++$idx, '上班', 'shàngbān', 'đi làm', 2, 0, '', '去上班。', 13];
$data[] = [++$idx, '下班', 'xiàbān', 'tan làm', 2, 0, '', '下班了。', 13];
$data[] = [++$idx, '公司', 'gōngsī', 'công ty', 2, 0, '', '在公司。', 13];
$data[] = [++$idx, '经理', 'jīnglǐ', 'giám đốc', 2, 0, '', '王经理。', 13];
$data[] = [++$idx, '老师', 'lǎoshī', 'giáo viên', 2, 0, '', '李老师。', 13];
$data[] = [++$idx, '护士', 'hùshi', 'y tá', 2, 0, '', '护士小姐。', 13];
$data[] = [++$idx, '司机', 'sījī', 'tài xế', 2, 0, '', '司机先生。', 13];

// HSK 2 - Lesson 14: Điện thoại & Internet (123-130)
$data[] = [++$idx, '电话', 'diànhuà', 'điện thoại', 2, 0, '', '打电话。', 14];
$data[] = [++$idx, '手机', 'shǒujī', 'điện thoại di động', 2, 0, '', '用手机。', 14];
$data[] = [++$idx, '电脑', 'diànnǎo', 'máy tính', 2, 0, '', '用电脑。', 14];
$data[] = [++$idx, '上网', 'shàngwǎng', 'lên mạng', 2, 0, '', '上网查资料。', 14];
$data[] = [++$idx, '邮件', 'yóujiàn', 'thư điện tử', 2, 0, '', '发邮件。', 14];
$data[] = [++$idx, '微信', 'Wēixìn', 'WeChat', 2, 0, '', '加微信。', 14];
$data[] = [++$idx, '信息', 'xìnxī', 'tin nhắn', 2, 0, '', '发信息。', 14];
$data[] = [++$idx, '网站', 'wǎngzhàn', 'website', 2, 0, '', '访问网站。', 14];

// HSK 2 - Lesson 15: Giáo dục & Trường học (131-138)
$data[] = [++$idx, '教室', 'jiàoshì', 'phòng học', 2, 0, '', '在教室。', 15];
$data[] = [++$idx, '图书馆', 'túshūguǎn', 'thư viện', 2, 0, '', '去图书馆。', 15];
$data[] = [++$idx, '考试', 'kǎoshì', 'thi cử', 2, 0, '', '期末考试。', 15];
$data[] = [++$idx, '作业', 'zuòyè', 'bài tập', 2, 0, '', '做作业。', 15];
$data[] = [++$idx, '词典', 'cídiǎn', 'từ điển', 2, 0, '', '查词典。', 15];
$data[] = [++$idx, '铅笔', 'qiānbǐ', 'bút chì', 2, 0, '', '一支铅笔。', 15];
$data[] = [++$idx, '问题', 'wèntí', 'vấn đề, câu hỏi', 2, 0, '', '回答问题。', 15];
$data[] = [++$idx, '答案', 'dáàn', 'đáp án', 2, 0, '', '正确答案。', 15];

// HSK 3 - Lesson 16: Ngân hàng & Bưu điện (139-146)
$data[] = [++$idx, '银行', 'yínháng', 'ngân hàng', 3, 0, '', '去银行。', 16];
$data[] = [++$idx, '邮政局', 'yóuzhèngjú', 'bưu điện', 3, 0, '', '去邮政局。', 16];
$data[] = [++$idx, '账户', 'zhànghù', 'tài khoản', 3, 0, '', '开账户。', 16];
$data[] = [++$idx, '存款', 'cúnkuǎn', 'tiền gửi', 3, 0, '', '去存款。', 16];
$data[] = [++$idx, '取款', 'qǔkuǎn', 'rút tiền', 3, 0, '', '取款机。', 16];
$data[] = [++$idx, '汇款', 'huìkuǎn', 'chuyển tiền', 3, 0, '', '汇款单。', 16];
$data[] = [++$idx, '邮票', 'yóupiào', 'tem thư', 3, 0, '', '买邮票。', 16];
$data[] = [++$idx, '信封', 'xìnfēng', 'phong bì', 3, 0, '', '一个信封。', 16];

// HSK 3 - Lesson 17: Văn hóa & Phong tục (147-154)
$data[] = [++$idx, '春节', 'Chūnjié', 'Tết Nguyên đán', 3, 0, '', '春节快乐！', 17];
$data[] = [++$idx, '中秋节', 'Zhōngqiūjié', 'Tết Trung thu', 3, 0, '', '中秋节快乐。', 17];
$data[] = [++$idx, '礼物', 'lǐwù', 'quà tặng', 3, 0, '', '送礼物。', 17];
$data[] = [++$idx, '红包', 'hóngbāo', 'bao lì xì', 3, 0, '', '发红包。', 17];
$data[] = [++$idx, '传统', 'chuántǒng', 'truyền thống', 3, 0, '', '传统文化。', 17];
$data[] = [++$idx, '文化', 'wénhuà', 'văn hóa', 3, 0, '', '中国文化。', 17];
$data[] = [++$idx, '习俗', 'xísú', 'phong tục', 3, 0, '', '春节习俗。', 17];
$data[] = [++$idx, '庆祝', 'qìngzhù', 'chúc mừng', 3, 0, '', '庆祝新年。', 17];

// HSK 3 - Lesson 18: Môi trường & Thiên nhiên (155-162)
$data[] = [++$idx, '环境', 'huánjìng', 'môi trường', 3, 0, '', '保护环境。', 18];
$data[] = [++$idx, '保护', 'bǎohù', 'bảo vệ', 3, 0, '', '保护大自然。', 18];
$data[] = [++$idx, '森林', 'sēnlín', 'rừng', 3, 0, '', '热带森林。', 18];
$data[] = [++$idx, '河流', 'héliú', 'sông', 3, 0, '', '干净的河流。', 18];
$data[] = [++$idx, '空气', 'kōngqì', 'không khí', 3, 0, '', '新鲜空气。', 18];
$data[] = [++$idx, '阳光', 'yángguāng', 'ánh nắng', 3, 0, '', '温暖的阳光。', 18];
$data[] = [++$idx, '动物', 'dòngwù', 'động vật', 3, 0, '', '保护动物。', 18];
$data[] = [++$idx, '植物', 'zhíwù', 'thực vật', 3, 0, '', '绿色植物。', 18];

// HSK 3 - Lesson 19: Kinh tế & Thương mại (163-170)
$data[] = [++$idx, '市场', 'shìchǎng', 'thị trường', 3, 0, '', '市场经济。', 19];
$data[] = [++$idx, '经济', 'jīngjì', 'kinh tế', 3, 0, '', '经济发展。', 19];
$data[] = [++$idx, '贸易', 'màoyì', 'thương mại', 3, 0, '', '国际贸易。', 19];
$data[] = [++$idx, '合同', 'hétong', 'hợp đồng', 3, 0, '', '签合同。', 19];
$data[] = [++$idx, '价格', 'jiàgé', 'giá cả', 3, 0, '', '合理价格。', 19];
$data[] = [++$idx, '利润', 'lìrùn', 'lợi nhuận', 3, 0, '', '获得利润。', 19];
$data[] = [++$idx, '投资', 'tóuzī', 'đầu tư', 3, 0, '', '投资未来。', 19];
$data[] = [++$idx, '发展', 'fāzhǎn', 'phát triển', 3, 0, '', '发展经济。', 19];

// HSK 3 - Lesson 20: Công nghệ & Khoa học (171-178)
$data[] = [++$idx, '科学', 'kēxué', 'khoa học', 3, 0, '', '科学技术。', 20];
$data[] = [++$idx, '技术', 'jìshù', 'kỹ thuật', 3, 0, '', '信息技术。', 20];
$data[] = [++$idx, '网络', 'wǎngluò', 'mạng lưới', 3, 0, '', '网络时代。', 20];
$data[] = [++$idx, '数据', 'shùjù', 'dữ liệu', 3, 0, '', '大数据。', 20];
$data[] = [++$idx, '软件', 'ruǎnjiàn', 'phần mềm', 3, 0, '', '开发软件。', 20];
$data[] = [++$idx, '硬件', 'yìngjiàn', 'phần cứng', 3, 0, '', '电脑硬件。', 20];
$data[] = [++$idx, '人工智能', 'réngōng zhìnéng', 'trí tuệ nhân tạo', 3, 0, '', '人工智能时代。', 20];
$data[] = [++$idx, '机器人', 'jīqìrén', 'robot', 3, 0, '', '智能机器人。', 20];

// Thêm từ vựng bổ sung không thuộc lesson nào (179-200)
$extra = [
    ['而且', 'érqiě', 'hơn nữa', 3, 0, '', '而且很好。'],
    ['如果', 'rúguǒ', 'nếu', 3, 0, '', '如果...就...'],
    ['虽然', 'suīrán', 'mặc dù', 3, 0, '', '虽然...但是...'],
    ['所以', 'suǒyǐ', 'cho nên', 3, 0, '', '所以来了。'],
    ['特别', 'tèbié', 'đặc biệt', 3, 0, '', '特别好。'],
    ['提高', 'tígāo', 'nâng cao', 3, 0, '', '提高水平。'],
    ['喜欢', 'xǐhuān', 'thích', 1, 0, '', '我喜欢你。'],
    ['高兴', 'gāoxìng', 'vui vẻ', 1, 0, '', '很高兴。'],
    ['漂亮', 'piàoliang', 'xinh đẹp', 2, 0, '', '很漂亮。'],
    ['努力', 'nǔlì', 'cố gắng', 2, 0, '', '努力学习。'],
    ['简单', 'jiǎndān', 'đơn giản', 2, 0, '', '很简单。'],
    ['方便', 'fāngbiàn', 'tiện lợi', 2, 0, '', '很方便。'],
    ['幸福', 'xìngfú', 'hạnh phúc', 3, 0, '', '幸福生活。'],
    ['勇敢', 'yǒnggǎn', 'dũng cảm', 3, 0, '', '勇敢的人。'],
    ['热情', 'rèqíng', 'nhiệt tình', 3, 0, '', '热情服务。'],
    ['认真', 'rènzhēn', 'nghiêm túc', 2, 0, '', '认真学习。'],
    ['帮助', 'bāngzhù', 'giúp đỡ', 2, 0, '', '互相帮助。'],
    ['欢迎', 'huānyíng', 'hoan nghênh', 2, 0, '', '欢迎光临！'],
    ['继续', 'jìxù', 'tiếp tục', 3, 0, '', '继续努力。'],
    ['成功', 'chénggōng', 'thành công', 3, 0, '', '祝你成功！'],
    ['开始', 'kāishǐ', 'bắt đầu', 2, 0, '', '开始上课。'],
    ['结束', 'jiéshù', 'kết thúc', 2, 0, '', '结束了吗？'],
];
foreach ($extra as $e) {
    $data[] = [++$idx, $e[0], $e[1], $e[2], $e[3], $e[4], $e[5], $e[6], null];
}

echo "Adding " . count($data) . " vocab entries...\n";
$added = 0;
foreach ($data as $d) {
    try {
        $vocab->execute($d);
        $added++;
    } catch (Exception $e) {
        echo "  Skip: " . $d[1] . " - " . $e->getMessage() . "\n";
    }
}
echo "Added $added vocab entries (total: " . ($count + $added) . ")\n";
echo "Seed complete!\n";
