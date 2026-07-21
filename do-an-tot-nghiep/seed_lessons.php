<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

echo "=== Seed Lessons Script ===\n";

// First, check if lessons table exists and has data
$count = $conn->query("SELECT COUNT(*) as c FROM lessons")->fetch(PDO::FETCH_ASSOC)['c'];
if ($count >= 146) {
    echo "Database already has $count lessons. Skipping seed.\n";
    exit;
}

// Clear existing data (optional - careful!)
// $conn->exec("SET FOREIGN_KEY_CHECKS = 0");
// $conn->exec("TRUNCATE TABLE lessons");
// $conn->exec("TRUNCATE TABLE vocab");
// $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

$stmt = $conn->prepare("INSERT IGNORE INTO lessons (id, level, lesson_num, title, description, vocab_count, grammar, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$lessons = [
    // ===== HSK 1 (lessons 1-15) =====
    [1, 1, 1, 'Bài 1: 你好 - Xin chào', 'Chào hỏi cơ bản, giới thiệu bản thân, hỏi tên. Học cách sử dụng 你好, 我叫, 你呢 trong giao tiếp hàng ngày.', 12, 'Cấu trúc 是, câu hỏi 吗, 很 + tính từ, đại từ nhân xưng', 'vocabulary'],
    [2, 1, 2, 'Bài 2: 谢谢你 - Cảm ơn', 'Học cách cảm ơn và xin lỗi trong tiếng Trung. Sử dụng 谢谢, 对不起, 没关系 trong các tình huống giao tiếp.', 10, 'Phó từ phủ định 不, cấu trúc 请 + động từ', 'vocabulary'],
    [3, 1, 3, 'Bài 3: 你叫什么名字 - Tên bạn là gì', 'Hỏi và trả lời về tên, quốc tịch, nghề nghiệp. Mở rộng vốn từ về quốc gia và ngôn ngữ.', 14, 'Từ hỏi 什么, 哪, kết cấu 是...的, liên từ 和', 'vocabulary'],
    [4, 1, 4, 'Bài 4: 她是我的汉语老师 - Cô ấy là giáo viên tiếng Trung của tôi', 'Giới thiệu về gia đình và nghề nghiệp. Học cách dùng 的 để chỉ sở hữu, từ chỉ người thân trong gia đình.', 12, 'Trợ từ sở hữu 的, động từ 有, số lượng từ', 'vocabulary'],
    [5, 1, 5, 'Bài 5: 今天几号 - Hôm nay ngày mấy', 'Học cách hỏi và trả lời về ngày tháng, thứ trong tuần. Sử dụng số đếm từ 1-31 và cách đọc ngày tháng.', 10, 'Từ hỏi 几, cách diễn đạt thời gian, trật tự thời gian trong câu', 'vocabulary'],
    [6, 1, 6, 'Bài 6: 我会说汉语 - Tôi biết nói tiếng Trung', 'Học cách diễn đạt khả năng làm một việc gì đó. Phân biệt 会, 能, 可以 trong tiếng Trung.', 13, 'Động từ năng nguyện 会/能/可以, phó từ 一点儿, trợ từ động thái 了', 'vocabulary'],
    [7, 1, 7, 'Bài 7: 你吃什么 - Bạn ăn gì', 'Từ vựng về đồ ăn, thức uống. Học cách gọi món và diễn đạt sở thích ăn uống.', 15, 'Động từ 想/要, cấu trúc 喜欢 + danh từ/động từ', 'vocabulary'],
    [8, 1, 8, 'Bài 8: 多少钱 - Bao nhiêu tiền', 'Học cách hỏi giá và mua bán. Số đếm từ 100-10000, đơn vị tiền tệ Trung Quốc.', 11, 'Phân biệt 多少 và 几, lượng từ, cấu trúc 太 + tính từ + 了', 'vocabulary'],
    [9, 1, 9, 'Bài 9: 我家有三口人 - Nhà tôi có 3 người', 'Miêu tả thành viên gia đình. Học cách dùng 有 để chỉ sự tồn tại và số lượng từ chỉ người.', 12, 'Động từ tồn tại 有, lượng từ 口/个/只, phủ định 没有', 'vocabulary'],
    [10, 1, 10, 'Bài 10: 天气很好 - Thời tiết đẹp', 'Từ vựng về thời tiết và mùa trong năm. Học cách miêu tả thời tiết bằng tính từ.', 10, 'Trạng từ chỉ mức độ 很/非常/太, câu vị ngữ chủ - vị, 了 chỉ biến hóa', 'vocabulary'],
    [11, 1, 11, 'Bài 11: 你住在哪儿 - Bạn ở đâu', 'Học cách hỏi và trả lời về địa chỉ, nơi ở. Giới từ chỉ vị trí trong tiếng Trung.', 11, 'Giới từ 在, từ chỉ phương hướng 里/上/下/旁边, cấu trúc 住在', 'vocabulary'],
    [12, 1, 12, 'Bài 12: 现在几点 - Bây giờ mấy giờ', 'Học cách xem giờ và diễn đạt thời gian trong ngày. Phân biệt giờ hơn và giờ kém.', 10, 'Cách đọc giờ, từ hỏi 几点, cấu trúc 从...到...', 'vocabulary'],
    [13, 1, 13, 'Bài 13: 你的电话是多少 - Số điện thoại của bạn là gì', 'Học cách hỏi số điện thoại, địa chỉ email. Số đếm từ 0-9 và cách đọc dãy số.', 10, 'Cấu trúc 是...的 (nhấn mạnh), cách hỏi thông tin liên lạc', 'vocabulary'],
    [14, 1, 14, 'Bài 14: 我们去公园走走 - Chúng tôi đi công viên dạo', 'Học cách rủ rê, đề nghị và trả lời. Động từ xu hướng và cách dùng 吧.', 11, 'Trợ từ ngữ khí 吧, động từ xu hướng, cấu trúc 我们去...吧', 'vocabulary'],
    [15, 1, 15, 'Bài 15: 祝你生日快乐 - Chúc bạn sinh nhật vui vẻ', 'Học cách chúc mừng và bày tỏ cảm xúc. Từ vựng về sinh nhật và lễ hội.', 12, 'Cấu trúc chúc phúc 祝..., trợ từ 的 trong danh từ, câu cảm thán', 'vocabulary'],

    // ===== HSK 2 (lessons 16-30) =====
    [16, 2, 1, 'Bài 16: 九月去北京旅游最好 - Tháng 9 đi Bắc Kinh du lịch là tốt nhất', 'Học cách đưa ra nhận xét và ý kiến về địa điểm du lịch. So sánh cơ bản với 最.', 13, 'Phó từ 最 (nhất), cấu trúc so sánh, cách biểu đạt thời gian du lịch', 'vocabulary'],
    [17, 2, 2, 'Bài 17: 我每天六点起床 - Tôi mỗi ngày 6 giờ dậy', 'Học cách diễn đạt thói quen hàng ngày. Động từ li hợp và trạng từ tần suất.', 12, 'Động từ li hợp 起床/吃饭/看书, trạng từ tần suất 经常/有时候/很少', 'vocabulary'],
    [18, 2, 3, 'Bài 18: 左边那个红色的是我的 - Cái màu đỏ bên trái là của tôi', 'Học cách chỉ đồ vật bằng các từ định vị và tính từ màu sắc.', 13, 'Từ định vị 左边/右边/后边, lượng từ 个/条/双, cấu trúc 的 trong danh từ', 'vocabulary'],
    [19, 2, 4, 'Bài 19: 这个工作是他帮我介绍的 - Công việc này là anh ấy giới thiệu cho tôi', 'Học cách diễn đạt nhờ vả và giới thiệu. Câu chữ 把 và cấu trúc nhấn mạnh 是...的.', 13, 'Câu chữ 把, cấu trúc 是...的 (nhấn mạnh), động từ 帮/介绍', 'vocabulary'],
    [20, 2, 5, 'Bài 20: 就买这件吧 - Cứ mua cái này đi', 'Học cách đưa ra quyết định và đề nghị khi mua sắm. Cách dùng 就 và 吧.', 12, 'Phó từ 就, trợ từ 吧, cấu trúc 有点儿 + tính từ, 太...了', 'vocabulary'],
    [21, 2, 6, 'Bài 21: 大家互相帮助 - Mọi người giúp đỡ lẫn nhau', 'Học cách diễn đạt sự tương trợ. Phó từ 互相 và các từ chỉ tập thể.', 12, 'Phó từ 互相, cấu trúc 一起 + động từ, đại từ 大家/互相', 'vocabulary'],
    [22, 2, 7, 'Bài 22: 每天坚持锻炼 - Mỗi ngày kiên trì rèn luyện', 'Học cách diễn đạt sự kiên trì và thói quen tốt. Từ vựng về sức khỏe.', 12, 'Động từ 坚持, cấu trúc 要...才行, trạng từ 常常/通常', 'vocabulary'],
    [23, 2, 8, 'Bài 23: 让我考得不好 - Khiến tôi thi không tốt', 'Học cách biểu đạt kết quả và nguyên nhân. Cấu trúc 让/叫 gây khiến.', 12, 'Cấu trúc gây khiến 让/叫, bổ ngữ kết quả, bổ ngữ trình độ 得', 'vocabulary'],
    [24, 2, 9, 'Bài 24: 你家离公司远吗 - Nhà bạn cách công ty xa không', 'Học cách hỏi và trả lời về khoảng cách. Cách dùng 离 và 从...到.', 11, 'Giới từ 离, cấu trúc 从...到..., từ chỉ khoảng cách 远/近', 'vocabulary'],
    [25, 2, 10, 'Bài 25: 别找了，手机在桌子上 - Đừng tìm nữa, điện thoại ở trên bàn', 'Học cách diễn đạt sự phủ định mệnh lệnh. Từ vựng về đồ vật trong nhà.', 11, 'Phủ định mệnh lệnh 别/不要, từ định vị phức tạp 上面/下面', 'vocabulary'],
    [26, 2, 11, 'Bài 26: 我比你大两岁 - Tôi lớn hơn bạn 2 tuổi', 'Học cách so sánh hơn, so sánh bằng trong tiếng Trung. Lượng từ chỉ mức độ chênh lệch.', 13, 'Cấu trúc so sánh 比, so sánh bằng 跟...一样, chỉ mức độ chênh lệch', 'vocabulary'],
    [27, 2, 12, 'Bài 27: 你穿太大了 - Bạn mặc lớn quá', 'Học cách diễn đạt kích cỡ và đánh giá. Bổ ngữ trạng thái và cách dùng 太/非常.', 12, 'Bổ ngữ trạng thái, phó từ 太/特别/非常, cách nói về kích cỡ', 'vocabulary'],
    [28, 2, 13, 'Bài 28: 你怎么来学校的 - Bạn đến trường bằng cách nào', 'Học cách hỏi và trả lời về phương tiện di chuyển. Cách dùng giới từ 坐/骑/开.', 12, 'Giới từ phương thức 坐/骑/开, câu hỏi với 怎么, cách diễn đạt phương tiện', 'vocabulary'],
    [29, 2, 14, 'Bài 29: 吃完饭以后我们去看电影 - Sau khi ăn cơm xong chúng tôi đi xem phim', 'Học cách diễn đạt trình tự hành động. Cách dùng 以后/以前 và 先...再...', 13, 'Từ chỉ thời tự 以后/以前, cấu trúc 先...再..., bổ ngữ xu hướng', 'vocabulary'],
    [30, 2, 15, 'Bài 30: 新年快乐 - Chúc mừng năm mới', 'Học cách chúc Tết và các phong tục ngày lễ. Văn hóa Trung Quốc qua các câu chúc.', 13, 'Cấu trúc chúc mừng, thành ngữ chúc Tết, văn hóa ngày lễ Trung Quốc', 'vocabulary'],

    // ===== HSK 3 (lessons 31-50) =====
    [31, 3, 1, 'Bài 31: 周末你有什么打算 - Cuối tuần bạn có dự định gì', 'Học cách hỏi và nói về dự định. Cấu trúc tương lai và động từ tình nguyện.', 14, 'Cấu trúc 打算/计划, trợ động từ 想要/应该, từ vựng cuối tuần', 'vocabulary'],
    [32, 3, 2, 'Bài 32: 他什么时候回来 - Anh ấy khi nào trở về', 'Học cách hỏi thời gian chính xác hơn. Biểu đạt thời gian phức tạp.', 13, 'Từ hỏi 什么时候/多会儿, bổ ngữ thời gian, cách dùng 就/才', 'vocabulary'],
    [33, 3, 3, 'Bài 33: 桌子上放着很多饮料 - Trên bàn có đặt nhiều đồ uống', 'Học cách miêu tả vị trí và tình trạng của đồ vật. Cấu trúc tồn tại.', 14, 'Câu tồn tại 着, cách dùng 放着/坐着/写着, động từ li hợp', 'vocabulary'],
    [34, 3, 4, 'Bài 34: 她总是笑着跟客人说话 - Cô ấy luôn cười nói chuyện với khách', 'Học cách biểu đạt cách thức hành động. Cấu trúc liên động.', 13, 'Cấu trúc 笑着/跑着, câu liên động, phó từ 总是/一直/从来', 'vocabulary'],
    [35, 3, 5, 'Bài 35: 我最近越来越胖了 - Dạo này tôi càng ngày càng béo', 'Học cách diễn đạt sự thay đổi. Cấu trúc 越来越 và 越...越...', 14, 'Cấu trúc 越来越 + tính từ, 越...越..., 了 chỉ sự thay đổi', 'vocabulary'],
    [36, 3, 6, 'Bài 36: 他是怎么知道的 - Anh ấy biết thế nào', 'Học cách hỏi về phương thức và nguyên nhân. Phân biệt 怎么/为什么/怎么样.', 13, 'Từ hỏi 怎么/为什么, bổ ngữ khả năng, cấu trúc 听说', 'vocabulary'],
    [37, 3, 7, 'Bài 37: 我跟她都认识五年了 - Tôi và cô ấy quen nhau 5 năm rồi', 'Học cách diễn đạt khoảng thời gian. Bổ ngữ thời lượng và 了 chỉ tiếp diễn.', 14, 'Bổ ngữ thời lượng, động từ 认识/知道/了解, 了 chỉ tiếp diễn', 'vocabulary'],
    [38, 3, 8, 'Bài 38: 我马上让他来 - Tôi lập tức bảo anh ấy đến', 'Học cách gây khiến và sai khiến. Cấu trúc 让/叫/请 ai làm gì.', 13, 'Câu gây khiến 让/叫/请, động từ 马上/立刻, cấu trúc 派/安排', 'vocabulary'],
    [39, 3, 9, 'Bài 39: 她没说话，只是笑了笑 - Cô ấy không nói gì, chỉ cười', 'Học cách diễn đạt hành động ngắn hạn. Hồi ức khi gặp lại bạn cũ.', 13, 'Cấu trúc 只是...了, động từ lặp VV, 又/再/还 khác biệt', 'vocabulary'],
    [40, 3, 10, 'Bài 40: 数学比历史难多了 - Toán khó hơn lịch sử nhiều', 'Học cách so sánh với mức độ lớn. Cấu trúc so sánh nâng cao.', 14, 'So sánh 比...多了/得多, so sánh 没有/不如, câu hỏi so sánh', 'vocabulary'],
    [41, 3, 11, 'Bài 41: 我的爱好是看电影 - Sở thích của tôi là xem phim', 'Học cách nói về sở thích và thú vui cá nhân.', 13, 'Cấu trúc 是...的 giới thiệu, động từ 喜欢/爱好, liên từ 除了...以外', 'vocabulary'],
    [42, 3, 12, 'Bài 42: 把窗户打开 - Mở cửa sổ ra', 'Học cấu trúc câu chữ 把 để diễn đạt sự tác động lên đối tượng.', 14, 'Câu chữ 把 nâng cao, bổ ngữ xu hướng kép 起来/出来/下去', 'vocabulary'],
    [43, 3, 13, 'Bài 43: 被偷了 - Bị trộm mất rồi', 'Học cấu trúc câu động từ bị động. Cách dùng 被/叫/让/给.', 13, 'Câu bị động 被/叫/让, bổ ngữ kết quả, biểu đạt sự tổn thất', 'vocabulary'],
    [44, 3, 14, 'Bài 44: 我迷路了 - Tôi lạc đường rồi', 'Học cách hỏi đường và chỉ đường. Từ vựng về địa điểm và phương hướng.', 14, 'Cách hỏi đường, từ chỉ đường 往/拐/一直走, giới từ 沿着/顺着', 'vocabulary'],
    [45, 3, 15, 'Bài 45: 我请客 - Tôi mời', 'Học cách mời và trả lời lời mời. Văn hóa mời khách của người Trung Quốc.', 13, 'Cấu trúc 请客/买单, cách diễn đạt 我来请, trợ từ 吧/嘛', 'vocabulary'],
    [46, 3, 16, 'Bài 46: 健康最重要 - Sức khỏe quan trọng nhất', 'Học cách nói về sức khỏe và bệnh tật. Cách diễn đạt sự quan tâm.', 14, 'Cấu trúc 最重要/对身体好, cách khuyên bảo 要/应该/多', 'vocabulary'],
    [47, 3, 17, 'Bài 47: 保护环境 - Bảo vệ môi trường', 'Học cách nói về môi trường và bảo vệ thiên nhiên. Từ vựng về thiên nhiên.', 13, 'Cấu trúc 保护/节约/减少, cách diễn đạt nguyên nhân - kết quả', 'vocabulary'],
    [48, 3, 18, 'Bài 48: 我们坐飞机去 - Chúng tôi đi máy bay', 'Học cách nói về du lịch và phương tiện giao thông. Từ vựng máy bay.', 14, 'Cấu trúc phương thức 坐/乘 + phương tiện, từ vựng sân bay', 'vocabulary'],
    [49, 3, 19, 'Bài 49: 我的梦想 - Ước mơ của tôi', 'Học cách nói về ước mơ và tương lai. Cách diễn đạt hy vọng.', 13, 'Cấu trúc 梦想/希望/愿望, tâm lý 觉得/认为/以为', 'vocabulary'],
    [50, 3, 20, 'Bài 50: 难忘的旅行 - Chuyến du lịch khó quên', 'Học cách kể lại một trải nghiệm. Hồi ức về chuyến đi đáng nhớ.', 14, 'Cấu trúc 难忘的, miêu tả quá khứ 曾经/已经, bổ ngữ thời gian', 'vocabulary'],

    // ===== HSK 4 (lessons 51-70) =====
    [51, 4, 1, 'Bài 51: 简单的爱情 - Tình yêu giản dị', 'Học cách nói về tình cảm và quan hệ giữa người với người.', 15, 'Cấu trúc 对...感/gây ấn tượng, biểu đạt cảm xúc, thành ngữ thông dụng', 'vocabulary'],
    [52, 4, 2, 'Bài 52: 真正的朋友 - Người bạn thực sự', 'Học cách nói về tình bạn và lòng trung thành. Giá trị của tình bạn.', 15, 'Cấu trúc 真正/其实, liên từ 不仅...而且..., phó từ 从来/始终', 'vocabulary'],
    [53, 4, 3, 'Bài 53: 读书的好处 - Lợi ích của đọc sách', 'Học cách nói về lợi ích của việc đọc sách và học tập.', 15, 'Cấu trúc 好处/好处在于, 越...越... nâng cao, 从...来看', 'vocabulary'],
    [54, 4, 4, 'Bài 54: 生活的味道 - Hương vị cuộc sống', 'Học cách cảm nhận và miêu tả cuộc sống hàng ngày.', 15, 'Cấu trúc 对于...来说, 无论...都..., cách dùng 似乎/仿佛', 'vocabulary'],
    [55, 4, 5, 'Bài 55: 工作的乐趣 - Niềm vui trong công việc', 'Học cách nói về công việc và sự nghiệp. Quan điểm về công việc.', 15, 'Cấu trúc 把...当作..., 一方面...一方面..., 由于/因此', 'vocabulary'],
    [56, 4, 6, 'Bài 56: 健康与运动 - Sức khỏe và vận động', 'Học cách nói về rèn luyện sức khỏe. Lợi ích của tập thể dục.', 15, 'Cấu trúc 为了...而..., 既...又..., 坚持 + động từ', 'vocabulary'],
    [57, 4, 7, 'Bài 57: 文化与传统 - Văn hóa và truyền thống', 'Học cách nói về văn hóa và phong tục truyền thống Trung Quốc.', 15, 'Cấu trúc 随着...的发展, 之所以...是因为..., 并且/从而', 'vocabulary'],
    [58, 4, 8, 'Bài 58: 科技与生活 - Khoa học công nghệ và cuộc sống', 'Học cách nói về tác động của công nghệ lên cuộc sống.', 15, 'Cấu trúc 随着/由于, bị động 让/被 nâng cao, 否则/不然', 'vocabulary'],
    [59, 4, 9, 'Bài 59: 环境与保护 - Môi trường và bảo vệ', 'Học cách nói về vấn đề môi trường và giải pháp.', 15, 'Cấu trúc 污染/治理/保护, 连...都/也..., 与其...不如...', 'vocabulary'],
    [60, 4, 10, 'Bài 60: 梦想与未来 - Ước mơ và tương lai', 'Học cách nói về hoài bão và kế hoạch tương lai.', 15, 'Cấu trúc 展望/规划, 只要...就..., 只有...才...', 'vocabulary'],
    [61, 4, 11, 'Bài 61: 沟通的艺术 - Nghệ thuật giao tiếp', 'Học cách nói về kỹ năng giao tiếp và ứng xử.', 15, 'Cấu trúc 沟通/交流/表达, 首先...然后...最后..., 甚至/尤其', 'vocabulary'],
    [62, 4, 12, 'Bài 62: 家庭教育 - Giáo dục gia đình', 'Học cách nói về vai trò của gia đình trong giáo dục.', 15, 'Cấu trúc 培养/教育/成长, 对...来说, 受/受到', 'vocabulary'],
    [63, 4, 13, 'Bài 63: 美食与健康 - Ẩm thực và sức khỏe', 'Học cách nói về mối quan hệ giữa ăn uống và sức khỏe.', 15, 'Cấu trúc 饮食/营养/均衡, 对...有影响, 据说/据统计', 'vocabulary'],
    [64, 4, 14, 'Bài 64: 旅行与文化 - Du lịch và văn hóa', 'Học cách nói về trải nghiệm văn hóa qua du lịch.', 15, 'Cấu trúc 体验/感受/了解, 既然...就..., 哪怕...也...', 'vocabulary'],
    [65, 4, 15, 'Bài 65: 城市生活 - Cuộc sống thành thị', 'Học cách nói về ưu nhược điểm của cuộc sống ở thành phố.', 15, 'Cấu trúc 方便/繁华/拥挤, 一方面...另一方面..., 以/以便', 'vocabulary'],
    [66, 4, 16, 'Bài 66: 农村生活 - Cuộc sống nông thôn', 'Học cách nói về đời sống ở nông thôn, so sánh với thành thị.', 15, 'Cấu trúc 安静/新鲜/优美, 比起...来..., 宁可...也...', 'vocabulary'],
    [67, 4, 17, 'Bài 67: 传统节日 - Ngày lễ truyền thống', 'Học cách nói về các ngày lễ truyền thống Trung Quốc.', 15, 'Cấu trúc 庆祝/纪念/团圆, 为了...而..., 每当...的时候', 'vocabulary'],
    [68, 4, 18, 'Bài 68: 社交网络 - Mạng xã hội', 'Học cách nói về mạng xã hội và tác động của nó.', 15, 'Cấu trúc 社交/网络/分享, 关于/对于, 从...角度', 'vocabulary'],
    [69, 4, 19, 'Bài 69: 消费观念 - Quan niệm tiêu dùng', 'Học cách nói về tiêu dùng và quản lý tài chính cá nhân.', 15, 'Cấu trúc 消费/节约/浪费, 与其...不如..., 靠/通过', 'vocabulary'],
    [70, 4, 20, 'Bài 70: 终身学习 - Học tập suốt đời', 'Học cách nói về tầm quan trọng của việc học tập suốt đời.', 15, 'Cấu trúc 学习/进步/提高, 不再/再也不, 从...中', 'vocabulary'],

    // ===== HSK 5 (lessons 71-106) =====
    [71, 5, 1, 'Bài 71: 选择与放弃 - Lựa chọn và từ bỏ', 'Học cách nói về quyết định quan trọng trong cuộc sống.', 16, 'Cấu trúc 选择/放弃/决定, 无论...都..., 即使...也...', 'vocabulary'],
    [72, 5, 2, 'Bài 72: 成功的秘诀 - Bí quyết thành công', 'Học cách nói về yếu tố dẫn đến thành công.', 16, 'Cấu trúc 成功/努力/坚持, 之所以...是因为..., 靠的是...', 'vocabulary'],
    [73, 5, 3, 'Bài 73: 环境保护 - Bảo vệ môi trường', 'Thảo luận về các vấn đề môi trường nghiêm trọng.', 16, 'Cấu trúc 污染/排放/治理, 随着...的增加, 从...来看', 'vocabulary'],
    [74, 5, 4, 'Bài 74: 全球变暖 - Sự nóng lên toàn cầu', 'Tìm hiểu về biến đổi khí hậu và hậu quả.', 16, 'Cấu trúc 导致/引起/造成, 越来越... nâng cao, 从而/进而', 'vocabulary'],
    [75, 5, 5, 'Bài 75: 教育平等 - Bình đẳng giáo dục', 'Thảo luận về cơ hội giáo dục cho mọi người.', 16, 'Cấu trúc 平等/机会/权利, 不论/无论, 具有/具备', 'vocabulary'],
    [76, 5, 6, 'Bài 76: 网络时代 - Thời đại mạng', 'Ảnh hưởng của Internet lên đời sống con người.', 16, 'Cấu trúc 网络/信息/传播, 通过...平台, 在...方面', 'vocabulary'],
    [77, 5, 7, 'Bài 77: 人工智能 - Trí tuệ nhân tạo', 'Tìm hiểu về AI và ứng dụng trong đời sống.', 16, 'Cấu trúc 人工智能/自动化, 代替/取代, 面临/应对', 'vocabulary'],
    [78, 5, 8, 'Bài 78: 文学鉴赏 - Thưởng thức văn học', 'Học cách phân tích và thưởng thức tác phẩm văn học.', 16, 'Cấu trúc 文学/作品/欣赏, 象征/比喻/代表, 深刻/印象', 'vocabulary'],
    [79, 5, 9, 'Bài 79: 艺术之美 - Vẻ đẹp nghệ thuật', 'Khám phá các loại hình nghệ thuật Trung Quốc.', 16, 'Cấu trúc 艺术/审美/表达, 充满/体现/突出', 'vocabulary'],
    [80, 5, 10, 'Bài 80: 经济发展 - Phát triển kinh tế', 'Tìm hiểu về sự phát triển kinh tế của Trung Quốc.', 16, 'Cấu trúc 经济/增长/改革, 不仅...也..., 在...基础上', 'vocabulary'],
    [81, 5, 11, 'Bài 81: 国际贸易 - Thương mại quốc tế', 'Học về thương mại và hợp tác quốc tế.', 16, 'Cấu trúc 贸易/合作/共赢, 进出口/关税, 协议/合同', 'vocabulary'],
    [82, 5, 12, 'Bài 82: 科技创新 - Đổi mới khoa học kỹ thuật', 'Thảo luận về vai trò của đổi mới sáng tạo.', 16, 'Cấu trúc 创新/研发/专利, 突破/领先, 促进/推动', 'vocabulary'],
    [83, 5, 13, 'Bài 83: 心理健康 - Sức khỏe tâm lý', 'Tìm hiểu về chăm sóc sức khỏe tinh thần.', 16, 'Cấu trúc 心理/压力/焦虑, 调整/放松/缓解', 'vocabulary'],
    [84, 5, 14, 'Bài 84: 传统文化传承 - Kế thừa văn hóa truyền thống', 'Bảo tồn và phát huy văn hóa truyền thống.', 16, 'Cấu trúc 传承/弘扬/保护, 面临挑战, 在...背景下', 'vocabulary'],
    [85, 5, 15, 'Bài 85: 媒体与社会 - Truyền thông và xã hội', 'Vai trò của truyền thông trong xã hội hiện đại.', 16, 'Cấu trúc 媒体/报道/舆论, 客观/公正/真实', 'vocabulary'],
    [86, 5, 16, 'Bài 86: 城市化进程 - Quá trình đô thị hóa', 'Tìm hiểu về đô thị hóa và tác động của nó.', 16, 'Cấu trúc 城市化/人口/迁移, 基础设施, 后果/影响', 'vocabulary'],
    [87, 5, 17, 'Bài 87: 消费文化 - Văn hóa tiêu dùng', 'Thảo luận về xu hướng tiêu dùng hiện đại.', 16, 'Cấu trúc 消费/品牌/广告, 追求/攀比, 理性/盲目', 'vocabulary'],
    [88, 5, 18, 'Bài 88: 人口老龄化 - Già hóa dân số', 'Tìm hiểu về vấn đề già hóa dân số.', 16, 'Cấu trúc 老龄化/养老/保障, 社会负担, 应对措施', 'vocabulary'],
    [89, 5, 19, 'Bài 89: 非物质文化遗产 - Di sản văn hóa phi vật thể', 'Bảo vệ di sản văn hóa phi vật thể.', 16, 'Cấu trúc 非物质文化遗产/传承, 民间艺术', 'vocabulary'],
    [90, 5, 20, 'Bài 90: 道德与法律 - Đạo đức và pháp luật', 'Mối quan hệ giữa đạo đức và pháp luật.', 16, 'Cấu trúc 道德/法律/规范, 约束/惩罚, 权利/义务', 'vocabulary'],
    [91, 5, 21, 'Bài 91: 中西文化差异 - Khác biệt văn hóa Đông - Tây', 'So sánh văn hóa Trung Quốc và phương Tây.', 16, 'Cấu trúc 差异/对比/理解, 从...角度来看', 'vocabulary'],
    [92, 5, 22, 'Bài 92: 企业管理 - Quản lý doanh nghiệp', 'Tìm hiểu về quản lý và lãnh đạo.', 16, 'Cấu trúc 管理/领导/效率, 团队/分工/协调', 'vocabulary'],
    [93, 5, 23, 'Bài 93: 人力资源 - Nguồn nhân lực', 'Quản lý và phát triển nguồn nhân lực.', 16, 'Cấu trúc 招聘/培训/考核, 潜力/能力/绩效', 'vocabulary'],
    [94, 5, 24, 'Bài 94: 市场营销 - Tiếp thị thị trường', 'Chiến lược marketing và quảng bá sản phẩm.', 16, 'Cấu trúc 市场/营销/品牌, 定位/推广/渠道', 'vocabulary'],
    [95, 5, 25, 'Bài 95: 金融投资 - Đầu tư tài chính', 'Kiến thức cơ bản về đầu tư tài chính.', 16, 'Cấu trúc 投资/风险/收益, 股票/基金/理财', 'vocabulary'],
    [96, 5, 26, 'Bài 96: 新能源发展 - Phát triển năng lượng mới', 'Năng lượng tái tạo và tương lai bền vững.', 16, 'Cấu trúc 新能源/太阳能/风能, 可持续/环保', 'vocabulary'],
    [97, 5, 27, 'Bài 97: 生物科技 - Công nghệ sinh học', 'Ứng dụng công nghệ sinh học trong y tế.', 16, 'Cấu trúc 基因/克隆/干细胞, 医学/治疗/疾病', 'vocabulary'],
    [98, 5, 28, 'Bài 98: 大数据时代 - Thời đại dữ liệu lớn', 'Big Data và ứng dụng trong cuộc sống.', 16, 'Cấu trúc 大数据/分析/预测, 隐私/安全/保护', 'vocabulary'],
    [99, 5, 29, 'Bài 99: 社交礼仪 - Nghi thức xã giao', 'Học về lễ nghi trong giao tiếp xã hội.', 16, 'Cấu trúc 礼仪/礼貌/尊重, 场合/身份/分寸', 'vocabulary'],
    [100, 5, 30, 'Bài 100: 中国历史 - Lịch sử Trung Quốc', 'Tổng quan về lịch sử Trung Quốc.', 16, 'Cấu trúc 朝代/历史/演变, 从...到..., 标志着', 'vocabulary'],
    [101, 5, 31, 'Bài 101: 丝绸之路 - Con đường tơ lụa', 'Lịch sử và ý nghĩa của con đường tơ lụa.', 16, 'Cấu trúc 丝绸之路/贸易/交流, 促进/繁荣', 'vocabulary'],
    [102, 5, 32, 'Bài 102: 中医养生 - Y học cổ truyền', 'Nguyên lý cơ bản của y học cổ truyền Trung Quốc.', 16, 'Cấu trúc 中医/阴阳/五行, 调理/养生/经络', 'vocabulary'],
    [103, 5, 33, 'Bài 103: 饮食文化 - Văn hóa ẩm thực', 'Văn hóa ẩm thực đặc sắc Trung Quốc.', 16, 'Cấu trúc 菜系/口味/烹饪, 色香味俱全, 讲究', 'vocabulary'],
    [104, 5, 34, 'Bài 104: 茶文化 - Văn hóa trà', 'Tìm hiểu về văn hóa trà Trung Hoa.', 16, 'Cấu trúc 茶文化/品茶/茶道, 功夫茶/绿茶/红茶', 'vocabulary'],
    [105, 5, 35, 'Bài 105: 中国功夫 - Võ thuật Trung Hoa', 'Võ thuật và triết lý của nó.', 16, 'Cấu trúc 功夫/武术/太极, 强身健体/内外兼修', 'vocabulary'],
    [106, 5, 36, 'Bài 106: 一带一路 - Một vành đai một con đường', 'Sáng kiến hợp tác quốc tế của Trung Quốc.', 16, 'Cấu trúc 一带一路/合作/共赢, 基础设施/互联互通', 'vocabulary'],

    // ===== HSK 6 (lessons 107-146) =====
    [107, 6, 1, 'Bài 107: 全球化与文化融合 - Toàn cầu hóa và giao thoa văn hóa', 'Thảo luận về tác động của toàn cầu hóa lên văn hóa.', 18, 'Cấu trúc 全球化/融合/多元, 在...背景下, 既...又... nâng cao', 'vocabulary'],
    [108, 6, 2, 'Bài 108: 跨文化交际 - Giao tiếp liên văn hóa', 'Kỹ năng giao tiếp giữa các nền văn hóa.', 18, 'Cấu trúc 跨文化/沟通/障碍, 适应/包容/理解', 'vocabulary'],
    [109, 6, 3, 'Bài 109: 互联网治理 - Quản trị Internet', 'Quản lý và quy định trên không gian mạng.', 18, 'Cấu trúc 互联网/监管/安全, 法律法规/信息安全', 'vocabulary'],
    [110, 6, 4, 'Bài 110: 太空探索 - Khám phá vũ trụ', 'Thành tựu và tương lai của ngành hàng không vũ trụ.', 18, 'Cấu trúc 太空/探索/宇航, 卫星/空间站/探测器', 'vocabulary'],
    [111, 6, 5, 'Bài 111: 知识产权保护 - Bảo vệ sở hữu trí tuệ', 'Tầm quan trọng của bảo vệ sở hữu trí tuệ.', 18, 'Cấu trúc 知识产权/专利/商标, 侵权/维权/打击', 'vocabulary'],
    [112, 6, 6, 'Bài 112: 社会公平 - Công bằng xã hội', 'Thảo luận về bình đẳng và công bằng trong xã hội.', 18, 'Cấu trúc 公平/正义/平等, 贫富差距/社会保障', 'vocabulary'],
    [113, 6, 7, 'Bài 113: 慈善与公益 - Từ thiện và cộng đồng', 'Hoạt động từ thiện và trách nhiệm xã hội.', 18, 'Cấu trúc 慈善/公益/志愿者, 捐赠/援助/关爱', 'vocabulary'],
    [114, 6, 8, 'Bài 114: 生态文明 - Văn minh sinh thái', 'Phát triển hài hòa giữa con người và thiên nhiên.', 18, 'Cấu trúc 生态文明/绿色/低碳, 人与自然和谐', 'vocabulary'],
    [115, 6, 9, 'Bài 115: 教育改革 - Cải cách giáo dục', 'Xu hướng cải cách giáo dục hiện đại.', 18, 'Cấu trúc 教育/改革/素质, 应试教育/素质教育', 'vocabulary'],
    [116, 6, 10, 'Bài 116: 终身教育体系 - Hệ thống giáo dục suốt đời', 'Xây dựng xã hội học tập.', 18, 'Cấu trúc 终身教育/继续教育/远程教育', 'vocabulary'],
    [117, 6, 11, 'Bài 117: 文化遗产保护 - Bảo tồn di sản văn hóa', 'Bảo vệ di tích lịch sử và văn hóa.', 18, 'Cấu trúc 文化遗产/古迹/文物, 修复/保护/传承', 'vocabulary'],
    [118, 6, 12, 'Bài 118: 城市规划 - Quy hoạch đô thị', 'Phát triển đô thị bền vững và thông minh.', 18, 'Cấu trúc 城市/规划/布局, 智能/绿色/宜居', 'vocabulary'],
    [119, 6, 13, 'Bài 119: 公共卫生 - Y tế công cộng', 'Hệ thống y tế và phòng chống dịch bệnh.', 18, 'Cấu trúc 公共卫生/疾控/防疫, 医疗/保障/应急', 'vocabulary'],
    [120, 6, 14, 'Bài 120: 基因伦理 - Đạo đức gen', 'Vấn đề đạo đức trong nghiên cứu gen.', 18, 'Cấu trúc 基因/伦理/道德, 编辑/干预/争议', 'vocabulary'],
    [121, 6, 15, 'Bài 121: 量子计算 - Tính toán lượng tử', 'Công nghệ lượng tử và ứng dụng tương lai.', 18, 'Cấu trúc 量子/计算/比特, 叠加/纠缠/突破', 'vocabulary'],
    [122, 6, 16, 'Bài 122: 航天工程 - Kỹ thuật hàng không', 'Thành tựu hàng không vũ trụ Trung Quốc.', 18, 'Cấu trúc 载人航天/探月/空间站', 'vocabulary'],
    [123, 6, 17, 'Bài 123: 海洋资源 - Tài nguyên biển', 'Khai thác và bảo vệ tài nguyên biển.', 18, 'Cấu trúc 海洋/资源/开发, 生态系统/可持续发展', 'vocabulary'],
    [124, 6, 18, 'Bài 124: 能源战略 - Chiến lược năng lượng', 'An ninh năng lượng và chuyển đổi xanh.', 18, 'Cấu trúc 能源/战略/转型, 清洁能源/碳中和', 'vocabulary'],
    [125, 6, 19, 'Bài 125: 精准扶贫 - Xóa đói giảm nghèo', 'Chiến lược xóa đói giảm nghèo tại Trung Quốc.', 18, 'Cấu trúc 扶贫/脱贫/攻坚, 可持续/造血式扶贫', 'vocabulary'],
    [126, 6, 20, 'Bài 126: 乡村振兴 - Phát triển nông thôn', 'Phát triển nông nghiệp và nông thôn mới.', 18, 'Cấu trúc 乡村振兴/农业现代化/生态宜居', 'vocabulary'],
    [127, 6, 21, 'Bài 127: 数字经济 - Kinh tế số', 'Chuyển đổi số và nền kinh tế số.', 18, 'Cấu trúc 数字经济/数字化转型/平台经济', 'vocabulary'],
    [128, 6, 22, 'Bài 128: 共享经济 - Kinh tế chia sẻ', 'Mô hình kinh tế chia sẻ và tác động.', 18, 'Cấu trúc 共享/资源/模式, 闲置/利用/效率', 'vocabulary'],
    [129, 6, 23, 'Bài 129: 老龄化社会 - Xã hội già hóa', 'Thách thức và cơ hội của xã hội già hóa.', 18, 'Cấu trúc 老龄化/养老/银发经济, 延迟退休/以房养老', 'vocabulary'],
    [130, 6, 24, 'Bài 130: 诚信社会 - Xã hội tín nhiệm', 'Xây dựng hệ thống tín nhiệm xã hội.', 18, 'Cấu trúc 诚信/信用/体系, 奖惩/监督/透明', 'vocabulary'],
    [131, 6, 25, 'Bài 131: 法治建设 - Xây dựng pháp quyền', 'Hoàn thiện hệ thống pháp luật.', 18, 'Cấu trúc 法治/立法/司法, 公正/公开/公平', 'vocabulary'],
    [132, 6, 26, 'Bài 132: 民主政治 - Chính trị dân chủ', 'Hệ thống chính trị và dân chủ xã hội chủ nghĩa.', 18, 'Cấu trúc 民主/协商/监督, 人民代表大会制度', 'vocabulary'],
    [133, 6, 27, 'Bài 133: 国防现代化 - Hiện đại hóa quốc phòng', 'Xây dựng quốc phòng toàn dân.', 18, 'Cấu trúc 国防/军队/现代化, 强军/科技兴军', 'vocabulary'],
    [134, 6, 28, 'Bài 134: 中国外交 - Ngoại giao Trung Quốc', 'Đường lối ngoại giao hòa bình.', 18, 'Cấu trúc 外交/合作/共赢, 人类命运共同体', 'vocabulary'],
    [135, 6, 29, 'Bài 135: 文化自信 - Tự tin văn hóa', 'Phát huy giá trị văn hóa dân tộc.', 18, 'Cấu trúc 文化自信/传统/创新, 软实力/影响力', 'vocabulary'],
    [136, 6, 30, 'Bài 136: 中华文明 - Văn minh Trung Hoa', 'Chiều dài lịch sử văn minh Trung Hoa.', 18, 'Cấu trúc 文明/起源/传承, 五千年/博大精深', 'vocabulary'],
    [137, 6, 31, 'Bài 137: 汉字演变 - Tiến hóa chữ Hán', 'Lịch sử phát triển của chữ Hán.', 18, 'Cấu trúc 汉字/甲骨文/金文/小篆/隶书/楷书', 'vocabulary'],
    [138, 6, 32, 'Bài 138: 诗词鉴赏 - Thưởng thức thơ từ', 'Phân tích thơ Đường và từ Tống.', 18, 'Cấu trúc 诗歌/意境/韵律, 唐诗/宋词/元曲', 'vocabulary'],
    [139, 6, 33, 'Bài 139: 中国哲学 - Triết học Trung Quốc', 'Tư tưởng triết học phương Đông.', 18, 'Cấu trúc 儒家/道家/法家, 孔子/老子/孟子', 'vocabulary'],
    [140, 6, 34, 'Bài 140: 中医经典 - Kinh điển y học cổ truyền', 'Tìm hiểu Hoàng Đế Nội Kinh, Thương Hàn Luận.', 18, 'Cấu trúc 黄帝内经/伤寒论/本草纲目, 辨证论治', 'vocabulary'],
    [141, 6, 35, 'Bài 141: 中国建筑 - Kiến trúc Trung Hoa', 'Đặc trưng kiến trúc cổ truyền Trung Quốc.', 18, 'Cấu trúc 建筑/园林/寺庙, 木结构/斗拱/飞檐', 'vocabulary'],
    [142, 6, 36, 'Bài 142: 中国戏曲 - Hý khúc Trung Hoa', 'Kinh kịch và các loại hình sân khấu truyền thống.', 18, 'Cấu trúc 京剧/昆曲/越剧, 脸谱/唱腔/表演', 'vocabulary'],
    [143, 6, 37, 'Bài 143: 中国书画 - Thư họa Trung Hoa', 'Nghệ thuật thư pháp và hội họa.', 18, 'Cấu trúc 书法/国画/水墨, 笔法/意境/留白', 'vocabulary'],
    [144, 6, 38, 'Bài 144: 中国陶瓷 - Gốm sứ Trung Hoa', 'Lịch sử và tinh hoa gốm sứ Trung Quốc.', 18, 'Cấu trúc 陶瓷/瓷器/青花瓷, 景德镇/汝窑/官窑', 'vocabulary'],
    [145, 6, 39, 'Bài 145: 中国节日 - Lễ hội Trung Hoa', 'Các lễ hội truyền thống quan trọng.', 18, 'Cấu trúc 春节/元宵/端午/中秋/重阳, 习俗/寓意', 'vocabulary'],
    [146, 6, 40, 'Bài 146: 中国梦 - Giấc mơ Trung Hoa', 'Tầm nhìn và khát vọng phát triển dân tộc.', 18, 'Cấu trúc 中国梦/复兴/奋斗, 两个一百年/共同富裕', 'vocabulary'],
];

// Start transaction
$conn->beginTransaction();
try {
    $inserted = 0;
    foreach ($lessons as $lesson) {
        $stmt->execute($lesson);
        if ($stmt->rowCount() > 0) $inserted++;
    }
    $conn->commit();
    echo "Inserted $inserted / " . count($lessons) . " lessons successfully!\n";
    
    // Show counts by level
    $levels = $conn->query("SELECT level, COUNT(*) as c FROM lessons GROUP BY level ORDER BY level")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($levels as $l) {
        echo "  HSK {$l['level']}: {$l['c']} lessons\n";
    }
} catch (Exception $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nDone! Total: " . count($lessons) . " lessons.\n";
