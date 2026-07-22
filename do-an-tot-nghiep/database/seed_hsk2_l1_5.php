<?php
/**
 * HÀNNGỮ - HSK2 Content Seeder (Lessons 1-5)
 * HSK Standard Course 2: 300+ words, more complex grammar, 2-3 dialogues/lesson
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK2 L1: 九月去北京旅游
// ═══════════════════════════════════════════════════
$L1=createLesson($conn,2,1,'Bài 1: Jiu yue qu Bei Jing lu you - Tháng 9 đi Bắc Kinh du lịch','Tháng, ngày, thời gian. Giới từ "cóng" (từ). Lịch trình du lịch.','["Du lich","Thoi gian","Thang ngay"]','Du lich','easy','HSK2 Bài 1: Du lịch Bắc Kinh. Từ vựng về tháng, ngày (jǐ hào). Giới từ cóng (từ). Cấu trúc: cóng...dào... (từ...đến...). Diễn tả thời gian: xīngqī (tuần), hào (ngày), yuè (tháng).');
$v1=0;
$v1_1=v($conn,$L1,1,'月','yuè','tháng','tháng','九月。','Jiǔ yuè.','Tháng 9.','noun','Chỉ tháng trong năm.',++$v1);
$v1_2=v($conn,$L1,1,'号','hào','ngày (trong tháng)','ngày','九月五号。','Jiǔ yuè wǔ hào.','Ngày 5 tháng 9.','noun','Có thể thay thế bằng 日.',++$v1);
$v1_3=v($conn,$L1,1,'从','cóng','từ (thời gian/nơi chốn)','từ','从北京来。','Cóng Běijīng lái.','Từ Bắc Kinh đến.','prep','Giới từ chỉ khởi điểm.',++$v1);
$v1_4=v($conn,$L1,1,'旅游','lǚyóu','du lịch','du lịch','去旅游。','Qù lǚyóu.','Đi du lịch.','verb','Động từ du lịch.',++$v1);
$v1_5=v($conn,$L1,1,'知道','zhīdào','biết','biết','我知道。','Wǒ zhīdào.','Tôi biết.','verb','Biết một sự việc.',++$v1);
$v1_6=v($conn,$L1,1,'时间','shíjiān','thời gian','thời gian','没有时间。','Méiyǒu shíjiān.','Không có thời gian.','noun','Lượng từ: duàn.',++$v1);
$v1_7=v($conn,$L1,1,'飞机','fēijī','máy bay','máy bay','坐飞机。','Zuò fēijī.','Đi máy bay.','noun','Phương tiện bay.',++$v1);
$v1_8=v($conn,$L1,1,'到','dào','đến, tới','đến','到北京。','Dào Běijīng.','Đến Bắc Kinh.','verb','Động từ chỉ chuyển động.',++$v1);
$v1_9=v($conn,$L1,1,'票','piào','vé','vé','买票。','Mǎi piào.','Mua vé.','noun','Vé tàu xe, vé máy bay.',++$v1);
// Grammar L1
$g1_1=g($conn,$L1,'Giới từ 从','从 + Thời gian/Địa điểm + Động từ','Từ (lúc/nơi) nào làm gì','Chỉ điểm khởi đầu trong không gian hoặc thời gian. Thường kết hợp với 到 (đến) để chỉ phạm vi.','从...到...: từ...đến.... Có thể dùng cho cả thời gian và không gian.','Giới từ chỉ khởi điểm.',1);
ge($conn,$g1_1,'我从上海来。','Wǒ cóng Shànghǎi lái.','Tôi từ Thượng Hải đến.',1);
ge($conn,$g1_1,'我从九点学习到十二点。','Wǒ cóng jiǔ diǎn xuéxí dào shí èr diǎn.','Tôi học từ 9h đến 12h.',2);
$g1_2=g($conn,$L1,'Cách hỏi ngày tháng','今天几月几号？','Hôm nay tháng mấy ngày mấy?','Dùng 几月 + 几号 để hỏi ngày tháng. Câu trả lời: 六月五号. Có thể dùng 日 thay 号 trong văn viết.','Hỏi ngày tháng trong giao tiếp hàng ngày.',2);
ge($conn,$g1_2,'今天九月五号。','Jīntiān jiǔ yuè wǔ hào.','Hôm nay ngày 5 tháng 9.',1);
ge($conn,$g1_2,'你什么时候去北京？','Nǐ shénme shíhou qù Běijīng?','Bao giờ bạn đi Bắc Kinh?',2);
// Dialogues L1
$d1_1=d($conn,$L1,'Du lich Bac Kinh','Nói về kế hoạch du lịch.',1);
ds($conn,$d1_1,'Xiao Ming','你九月去北京旅游吗？','Nǐ jiǔ yuè qù Běijīng lǚyóu ma?','Tháng 9 bạn đi Bắc Kinh du lịch à?',1);
ds($conn,$d1_1,'Anna','对，我九月五号去。','Duì, wǒ jiǔ yuè wǔ hào qù.','Đúng, tôi đi ngày 5/9.',2);
ds($conn,$d1_1,'Xiao Ming','从上海到北京坐飞机要几个小时？','Cóng Shànghǎi dào Běijīng zuò fēijī yào jǐ gè xiǎoshí?','Từ Thượng Hải đến Bắc Kinh đi máy bay mất mấy giờ?',3);
ds($conn,$d1_1,'Anna','大概两个小时。','Dàgài liǎng gè xiǎoshí.','Khoảng 2 tiếng.',4);
$d1_2=d($conn,$L1,'Mua ve','Mua vé máy bay.',2);
ds($conn,$d1_2,'Anna','我要买一张飞机票。','Wǒ yào mǎi yì zhāng fēijī piào.','Tôi muốn mua một vé máy bay.',1);
ds($conn,$d1_2,'Nguoi ban','从哪儿到哪儿？','Cóng nǎr dào nǎr?','Từ đâu đến đâu?',2);
ds($conn,$d1_2,'Anna','从北京到上海。','Cóng Běijīng dào Shànghǎi.','Từ Bắc Kinh đến Thượng Hải.',3);
ds($conn,$d1_2,'Nguoi ban','什么时间？','Shénme shíjiān?','Thời gian nào?',4);
ds($conn,$d1_2,'Anna','九月五号上午九点。','Jiǔ yuè wǔ hào shàngwǔ jiǔ diǎn.','9h sáng ngày 5/9.',5);
// Reading L1
r($conn,$L1,'Ke hoach du lich','九月五号我去北京旅游。从上海到北京坐飞机两个小时。北京很好玩儿。我买了一张飞机票，九月五号上午九点出发。我知道北京有很多漂亮的地方，我很想去看看。','Jiǔ yuè wǔ hào wǒ qù Běijīng lǚyóu. Cóng Shànghǎi dào Běijīng zuò fēijī liǎng gè xiǎoshí. Běijīng hěn hǎowánr. Wǒ mǎi le yì zhāng fēijī piào, jiǔ yuè wǔ hào shàngwǔ jiǔ diǎn chūfā. Wǒ zhīdào Běijīng yǒu hěn duō piàoliang de dìfang, wǒ hěn xiǎng qù kànkan.','Ngày 5/9 tôi đi Bắc Kinh du lịch. Từ Thượng Hải đến Bắc Kinh đi máy bay 2 tiếng. Bắc Kinh rất thú vị. Tôi mua 1 vé máy bay, 9h sáng ngày 5/9 khởi hành. Tôi biết Bắc Kinh có nhiều nơi đẹp, tôi rất muốn đi xem.','easy',75,1);
// Listening L1
$L1l=l($conn,$L1,'Du lich','A:你什么时候去旅游？B:九月五号。A:从哪儿出发？B:从上海。A:到北京要多久？B:两小时。','A:Nǐ shénme shíhou qù lǚyóu? B:Jiǔ yuè wǔ hào. A:Cóng nǎr chūfā? B:Cóng Shànghǎi. A:Dào Běijīng yào duōjiǔ? B:Liǎng xiǎoshí.','A:Bao giờ đi du lịch? B:5/9. A:Từ đâu? B:Từ Thượng Hải. A:Đến Bắc Kinh bao lâu? B:2 tiếng.','1');
lq($conn,$L1l,'Người B đi du lịch ngày nào?','{"A":"5/8","B":"5/9","C":"9/5"}','5/9','Ngày 5 tháng 9.','multiple_choice',1);
lq($conn,$L1l,'Đi từ Thượng Hải đến Bắc Kinh mất bao lâu?','{"A":"1 giờ","B":"2 giờ","C":"3 giờ"}','2 giờ','Mất 2 tiếng.','multiple_choice',2);
// Exercises L1
$E1_1=e($conn,$L1,'Chọn đáp án','"Từ...đến..." là:','multiple_choice','easy',1,'A',1);
eo($conn,$E1_1,'从...到...','A',1,1); eo($conn,$E1_1,'在...从...','B',0,2); eo($conn,$E1_1,'到...从...','C',0,3);
$E1_2=e($conn,$L1,'Dịch','"Ngày 5 tháng 9"','translation','easy',1,'九月五号',2);
$E1_3=e($conn,$L1,'Điền từ','我___北京来。(từ)','fill_blank','easy',1,'从',3);
$E1_4=e($conn,$L1,'Sắp xếp câu','北京 / 从 / 到 / 上海 / 飞机','sentence_order','easy',1,'从北京到上海坐飞机',4);
$E1_5=e($conn,$L1,'Chọn đúng/sai','"旅游" có nghĩa là "du lịch".','true_false','easy',1,'true',5);
eo($conn,$E1_5,'Đúng','A',1,1); eo($conn,$E1_5,'Sai','B',0,2);
$E1_6=e($conn,$L1,'Điền từ','我___了一张飞机票。(mua)','fill_blank','easy',1,'买',6);
// Review L1
foreach ([$v1_1,$v1_2,$v1_3,$v1_4,$v1_5,$v1_6,$v1_7,$v1_8,$v1_9] as $i=>$vid) if ($vid) rv($conn,$L1,$vid,'core',$i+1);
echo " HSK2 L1 done: $v1 vocab, 2 grammar, 2 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L2: 我每天六点起床
// ═══════════════════════════════════════════════════
$L2=createLesson($conn,2,2,'Bài 2: Wo mei tian liu dian qi chuang - Mỗi ngày tôi dậy lúc 6 giờ','Sinh hoạt hàng ngày. Thời gian cụ thể. Phó từ "jiù".','["Sinh hoat hang ngay","Thoi gian","Thoi quen"]','Sinh hoat','easy','HSK2 Bài 2: Thói quen hàng ngày. Cách nói giờ chính xác. Phó từ jiù (thì, liền). Động từ + 了 biểu thị sự thay đổi. Từ vựng: qǐchuáng (dậy), shuìjiào (ngủ), shàngbān (đi làm), huí jiā (về nhà).');
$v2=0;
$v2_1=v($conn,$L2,1,'起床','qǐchuáng','thức dậy','dậy','六点起床。','Liù diǎn qǐchuáng.','Dậy lúc 6h.','verb','qǐ (dậy) + chuáng (giường).',++$v2);
$v2_2=v($conn,$L2,1,'上班','shàngbān','đi làm','đi làm','八点上班。','Bā diǎn shàngbān.','8h đi làm.','verb','Phân ly động từ.',++$v2);
$v2_3=v($conn,$L2,1,'下班','xiàbān','tan làm','tan làm','五点下班。','Wǔ diǎn xiàbān.','5h tan làm.','verb','shàngbān / xiàbān.',++$v2);
$v2_4=v($conn,$L2,1,'睡觉','shuìjiào','ngủ','ngủ','十点睡觉。','Shí diǎn shuìjiào.','10h đi ngủ.','verb','Phân ly động từ.',++$v2);
$v2_5=v($conn,$L2,1,'回家','huí jiā','về nhà','về nhà','六点回家。','Liù diǎn huí jiā.','6h về nhà.','verb','Phân ly động từ.',++$v2);
$v2_6=v($conn,$L2,1,'就','jiù','thì, liền, ngay','liền','就起床。','Jiù qǐchuáng.','Thì dậy ngay.','adv','Phó từ chỉ thời gian ngắn.',++$v2);
$v2_7=v($conn,$L2,1,'才','cái','mới (thời gian muộn)','mới','九点才起床。','Jiǔ diǎn cái qǐchuáng.','9h mới dậy.','adv','Trái nghĩa với 就.',++$v2);
$v2_8=v($conn,$L2,1,'半','bàn','rưỡi','rưỡi','七点半。','Qī diǎn bàn.','7h rưỡi.','noun','Chỉ nửa giờ.',++$v2);
$v2_9=v($conn,$L2,1,'刻','kè','khắc, 15 phút','15 phút','两点一刻。','Liǎng diǎn yí kè.','2h15.','noun','Chỉ 1/4 giờ.',++$v2);
$v2_10=v($conn,$L2,1,'差','chà','kém (thời gian)','kém','差五分三点。','Chà wǔ fēn sān diǎn.','3h kém 5.','verb','Chỉ thời gian trước.',++$v2);
// Grammar L2
$g2_1=g($conn,$L2,'Phó từ 就 và 才','Thời gian + 就/才 + Động từ','Jiù: sớm / nhanh. Cái: muộn / chậm','就 diễn tả hành động xảy ra sớm hơn dự kiến. 才 diễn tả hành động xảy ra muộn hơn dự kiến. Đều đặt trước động từ.','六点就起床 (6h đã dậy - sớm). 九点才起床 (9h mới dậy - muộn).','Phân biệt sớm-muộn.',1);
ge($conn,$g2_1,'他六点就起床了。','Tā liù diǎn jiù qǐchuáng le.','Anh ấy 6h đã dậy rồi.',1);
ge($conn,$g2_1,'他九点才起床。','Tā jiǔ diǎn cái qǐchuáng.','Anh ấy 9h mới dậy.',2);
$g2_2=g($conn,$L2,'Cách nói giờ chính xác','Số + 点 + Số + 分 (+ 半/刻/差)','Nói giờ đầy đủ','Giờ: 点 (diǎn). Phút: 分 (fēn). Bán (半) = 30 phút. Khắc (刻) = 15 phút. Sai (差) = kém.','7:15 = 七点一刻. 7:30 = 七点半. 7:45 = 差一刻八点 / 七点三刻.','Đọc giờ trong giao tiếp.',2);
ge($conn,$g2_2,'现在八点一刻。','Xiànzài bā diǎn yí kè.','Bây giờ 8h15.',1);
ge($conn,$g2_2,'我七点五十上班。','Wǒ qī diǎn wǔshí shàngbān.','Tôi 7h50 đi làm.',2);
// Dialogues L2
$d2_1=d($conn,$L2,'Mot ngay cua toi','Nói về thói quen hàng ngày.',1);
ds($conn,$d2_1,'Anna','你每天几点起床？','Nǐ měitiān jǐ diǎn qǐchuáng?','Mỗi ngày bạn dậy mấy giờ?',1);
ds($conn,$d2_1,'Xiao Ming','我六点就起床了。','Wǒ liù diǎn jiù qǐchuáng le.','Tôi 6h đã dậy rồi.',2);
ds($conn,$d2_1,'Anna','这么早！我每天七点半才起床。','Zhème zǎo! Wǒ měitiān qī diǎn bàn cái qǐchuáng.','Sớm vậy! Tôi mỗi ngày 7h rưỡi mới dậy.',3);
ds($conn,$d2_1,'Xiao Ming','我八点上班，所以起得早。','Wǒ bā diǎn shàngbān, suǒyǐ qǐ de zǎo.','Tôi 8h đi làm nên dậy sớm.',4);
$d2_2=d($conn,$L2,'Thoi gian bieu','Hỏi về thời gian biểu.',2);
ds($conn,$d2_2,'Anna','你几点下班？','Nǐ jǐ diǎn xiàbān?','Mấy giờ bạn tan làm?',1);
ds($conn,$d2_2,'Xiao Ming','五点下班，六点回家。','Wǔ diǎn xiàbān, liù diǎn huí jiā.','5h tan, 6h về nhà.',2);
ds($conn,$d2_2,'Anna','晚上做什么？','Wǎnshang zuò shénme?','Buổi tối làm gì?',3);
ds($conn,$d2_2,'Xiao Ming','看看电视，十点就睡觉了。','Kànkan diànshì, shí diǎn jiù shuìjiào le.','Xem TV một chút, 10h đi ngủ.',4);
// Reading L2
r($conn,$L2,'Sinh hoat hang ngay','我每天六点起床。因为八点上班，所以起得很早。下午五点下班，六点回家。晚上看看电视，十点就睡觉了。周末我八点才起床，然后去公园跑步。','Wǒ měitiān liù diǎn qǐchuáng. Yīnwèi bā diǎn shàngbān, suǒyǐ qǐ de hěn zǎo. Xiàwǔ wǔ diǎn xiàbān, liù diǎn huí jiā. Wǎnshang kànkan diànshì, shí diǎn jiù shuìjiào le. Zhōumò wǒ bā diǎn cái qǐchuáng, ránhòu qù gōngyuán pǎobù.','Mỗi ngày tôi dậy 6h. Vì 8h đi làm nên dậy rất sớm. Chiều 5h tan, 6h về nhà. Tối xem TV, 10h đi ngủ. Cuối tuần tôi 8h mới dậy, rồi đi công viên chạy bộ.','easy',85,1);
// Listening L2
$L2l=l($conn,$L2,'Lich trinh','A:你今天几点起床？B:六点半。A:这么早！几点上班？B:八点一刻。A:几点下班？B:五点。','A:Nǐ jīntiān jǐ diǎn qǐchuáng? B:Liù diǎn bàn. A:Zhème zǎo! Jǐ diǎn shàngbān? B:Bā diǎn yí kè. A:Jǐ diǎn xiàbān? B:Wǔ diǎn.','A:Hôm nay dậy mấy giờ? B:6h30. A:Sớm vậy! Mấy giờ đi làm? B:8h15. A:Mấy giờ tan? B:5h.','1');
lq($conn,$L2l,'Người B dậy mấy giờ?','{"A":"6h","B":"6h30","C":"7h"}','6h30','Dậy lúc 6 rưỡi.','multiple_choice',1);
lq($conn,$L2l,'Người B đi làm lúc mấy giờ?','{"A":"8h","B":"8h15","C":"8h30"}','8h15','Đi làm lúc 8h15.','multiple_choice',2);
// Exercises L2
$E2_1=e($conn,$L2,'Chọn đáp án','"起床" có nghĩa là:','multiple_choice','easy',1,'C',1);
eo($conn,$E2_1,'Ngủ','A',0,1); eo($conn,$E2_1,'Tan làm','B',0,2); eo($conn,$E2_1,'Thức dậy','C',1,3);
$E2_2=e($conn,$L2,'Dịch','"7 rưỡi"','translation','easy',1,'七点半',2);
$E2_3=e($conn,$L2,'Điền từ','我六点___起床了。(liền)','fill_blank','easy',1,'就',3);
$E2_4=e($conn,$L2,'Sắp xếp câu','就 / 我 / 起床 / 六点 / 了','sentence_order','easy',1,'我六点就起床了。',4);
$E2_5=e($conn,$L2,'Chọn đúng/sai','"才" chỉ hành động xảy ra muộn.','true_false','easy',1,'true',5);
eo($conn,$E2_5,'Đúng','A',1,1); eo($conn,$E2_5,'Sai','B',0,2);
$E2_6=e($conn,$L2,'Điền từ','现在八点一___。','fill_blank','easy',1,'刻',6);
// Review L2
foreach ([$v2_1,$v2_2,$v2_3,$v2_4,$v2_5,$v2_6,$v2_7,$v2_8,$v2_9] as $i=>$vid) if ($vid) rv($conn,$L2,$vid,'core',$i+1);
echo " HSK2 L2 done: $v2 vocab, 2 grammar, 2 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L3: 左边那个红色的是我的
// ═══════════════════════════════════════════════════
$L3=createLesson($conn,2,3,'Bài 3: Zuo bian na ge hong se de shi wo de - Bên trái cái màu đỏ là của tôi','Vị trí, màu sắc, định ngữ "de". Đại từ chỉ thị.','["Vi tri","Mau sac","So huu"]','Vi tri','easy','HSK2 Bài 3: Miêu tả đồ vật. Phương vị từ: zuǒbiān (bên trái), yòubiān (bên phải), pángbiān (bên cạnh). Màu sắc: hóngsè (màu đỏ), lánsè (màu xanh). Định ngữ với 的. Phân biệt zhè / nà / nǎ.');
$v3=0;
$v3_1=v($conn,$L3,1,'左边','zuǒbiān','bên trái','bên trái','左边是书店。','Zuǒbiān shì shūdiàn.','Bên trái là hiệu sách.','noun','Phương vị từ.',++$v3);
$v3_2=v($conn,$L3,1,'右边','yòubiān','bên phải','bên phải','右边是医院。','Yòubiān shì yīyuàn.','Bên phải là bệnh viện.','noun','Phương vị từ.',++$v3);
$v3_3=v($conn,$L3,1,'旁边','pángbiān','bên cạnh','bên cạnh','旁边是学校。','Pángbiān shì xuéxiào.','Bên cạnh là trường học.','noun','Phương vị từ.',++$v3);
$v3_4=v($conn,$L3,1,'红色','hóngsè','màu đỏ','đỏ','红色的衣服。','Hóngsè de yīfu.','Quần áo màu đỏ.','noun','Màu sắc.',++$v3);
$v3_5=v($conn,$L3,1,'蓝色','lánsè','màu xanh lam','xanh','蓝色的书包。','Lánsè de shūbāo.','Cặp sách màu xanh.','noun','Màu xanh lam.',++$v3);
$v3_6=v($conn,$L3,1,'绿色','lǜsè','màu xanh lá','xanh lá','绿色的树。','Lǜsè de shù.','Cây màu xanh lá.','noun','Màu xanh cây cối.',++$v3);
$v3_7=v($conn,$L3,1,'给','gěi','cho, đưa cho','cho','给我一本书。','Gěi wǒ yì běn shū.','Đưa tôi một cuốn sách.','verb','Động từ trao tặng.',++$v3);
$v3_8=v($conn,$L3,1,'放','fàng','đặt, để','đặt','放在桌子上。','Fàng zài zhuōzi shang.','Đặt trên bàn.','verb','Động từ đặt đồ.',++$v3);
$v3_9=v($conn,$L3,1,'拿','ná','cầm, lấy','lấy','拿一本书。','Ná yì běn shū.','Lấy một cuốn sách.','verb','Động từ cầm nắm.',++$v3);
// Grammar L3
$g3_1=g($conn,$L3,'Phương vị từ cơ bản','Danh từ/Đại từ + 左边/右边/旁边/前面/后面','Định vị không gian','Phương vị từ đứng sau danh từ hoặc đại từ để chỉ vị trí. 的 có thể thêm hoặc bỏ.','我旁边 = bên cạnh tôi. 学校左边 = bên trái trường học.','Xác định vị trí.',1);
ge($conn,$g3_1,'学校左边是医院。','Xuéxiào zuǒbiān shì yīyuàn.','Bên trái trường học là bệnh viện.',1);
ge($conn,$g3_1,'你旁边有人吗？','Nǐ pángbiān yǒu rén ma?','Bên cạnh bạn có người không?',2);
$g3_2=g($conn,$L3,'Màu sắc + 的 + Danh từ','Tính từ màu sắc + 的 + Danh từ','Danh từ có màu sắc gì','Tính từ màu sắc cần 的 để nối với danh từ. Có thể bỏ danh từ nếu ngữ cảnh rõ: hóngsè de (cái màu đỏ).','红 + 的 + 衣服 = 红色的衣服.','Miêu tả màu sắc đồ vật.',2);
ge($conn,$g3_2,'我要买红色的那个。','Wǒ yào mǎi hóngsè de nà ge.','Tôi muốn mua cái màu đỏ kia.',1);
ge($conn,$g3_2,'蓝色的书包很好看。','Lánsè de shūbāo hěn hǎokàn.','Cặp sách xanh rất đẹp.',2);
$g3_3=g($conn,$L3,'的 trong cụm sở hữu','Đại từ/Danh từ + 的 + Danh từ','Của ai / Thuộc về ai','的 chỉ quan hệ sở hữu. Có thể bỏ danh từ sau 的 nếu ngữ cảnh rõ: 我的 (của tôi), 他的 (của anh ấy).','你的书 hays 你的 = của bạn.','Sở hữu cách.',3);
ge($conn,$g3_3,'左边那个红色的是我的。','Zuǒbiān nà ge hóngsè de shì wǒ de.','Cái màu đỏ bên trái là của tôi.',1);
ge($conn,$g3_3,'你的书在桌子上。','Nǐ de shū zài zhuōzi shang.','Sách của bạn ở trên bàn.',2);
// Dialogues L3
$d3_1=d($conn,$L3,'Tim do vat','Tìm đồ vật trong phòng.',1);
ds($conn,$d3_1,'Anna','我的书包在哪儿？','Wǒ de shūbāo zài nǎr?','Cặp sách của tôi ở đâu?',1);
ds($conn,$d3_1,'Xiao Ming','在桌子左边。左边那个蓝色的是你的吗？','Zài zhuōzi zuǒbiān. Zuǒbiān nà ge lánsè de shì nǐ de ma?','Ở bên trái bàn. Cái màu xanh bên trái là của bạn à?',2);
ds($conn,$d3_1,'Anna','对，那个蓝色的就是我的。','Duì, nà ge lánsè de jiù shì wǒ de.','Đúng, cái màu xanh đó là của tôi.',3);
$d3_2=d($conn,$L3,'Chon qua','Chọn quà tặng.',2);
ds($conn,$d3_2,'Xiao Ming','红色和蓝色，你喜欢哪个？','Hóngsè hé lánsè, nǐ xǐhuan nǎ ge?','Đỏ và xanh, bạn thích cái nào?',1);
ds($conn,$d3_2,'Anna','我喜欢红色的。','Wǒ xǐhuan hóngsè de.','Tôi thích màu đỏ.',2);
ds($conn,$d3_2,'Xiao Ming','那我给你买红色的。','Nà wǒ gěi nǐ mǎi hóngsè de.','Vậy tôi mua màu đỏ cho bạn.',3);
// Reading L3
r($conn,$L3,'Do vat trong phong','我的房间不大。桌子左边放着一盏灯，右边是书。蓝色的书包在椅子旁边。桌子上有一个红色的杯子，那是我的。窗户旁边有一盆绿色的植物，很漂亮。','Wǒ de fángjiān bú dà. Zhuōzi zuǒbiān fàng zhe yì zhǎn dēng, yòubiān shì shū. Lánsè de shūbāo zài yǐzi pángbiān. Zhuōzi shang yǒu yí ge hóngsè de bēizi, nà shì wǒ de. Chuānghu pángbiān yǒu yì pén lǜsè de zhíwù, hěn piàoliang.','Phòng tôi không lớn. Bên trái bàn đặt một cái đèn, bên phải là sách. Cặp xanh ở cạnh ghế. Trên bàn có cốc màu đỏ, đó là của tôi. Cạnh cửa sổ có một chậu cây xanh, rất đẹp.','easy',80,1);
// Listening L3
$L3l=l($conn,$L3,'Do vat','A:你的书在哪儿？B:在桌子右边。A:哪个是你的？B:红色那本。A:能给我看看吗？B:给你。','A:Nǐ de shū zài nǎr? B:Zài zhuōzi yòubiān. A:Nǎ ge shì nǐ de? B:Hóngsè nà běn. A:Néng gěi wǒ kànkan ma? B:Gěi nǐ.','A:Sách bạn đâu? B:Ở bên phải bàn. A:Cái nào của bạn? B:Cuốn màu đỏ. A:Cho tôi xem được không? B:Đây.','1');
lq($conn,$L3l,'Sách ở đâu?','{"A":"Bàn trái","B":"Bàn phải","C":"Trên bàn"}','Bàn phải','Bên phải bàn.','multiple_choice',1);
lq($conn,$L3l,'Cuốn sách màu gì?','{"A":"Xanh","B":"Đỏ","C":"Vàng"}','Đỏ','Màu đỏ.','multiple_choice',2);
// Exercises L3
$E3_1=e($conn,$L3,'Chọn đáp án','"Bên trái" là:','multiple_choice','easy',1,'A',1);
eo($conn,$E3_1,'左边','A',1,1); eo($conn,$E3_1,'右边','B',0,2); eo($conn,$E3_1,'旁边','C',0,3);
$E3_2=e($conn,$L3,'Dịch','"Cái màu xanh lam bên trái"','translation','easy',1,'左边蓝色的那个',2);
$E3_3=e($conn,$L3,'Điền từ','红色___衣服。(của)','fill_blank','easy',1,'的',3);
$E3_4=e($conn,$L3,'Sắp xếp câu','是 / 左边 / 我的 / 那个','sentence_order','easy',1,'左边那个是我的。',4);
$E3_5=e($conn,$L3,'Chọn đúng/sai','"放" có nghĩa là "lấy".','true_false','easy',1,'false',5);
eo($conn,$E3_5,'Đúng','A',0,1); eo($conn,$E3_5,'Sai','B',1,2);
$E3_6=e($conn,$L3,'Điền từ','你的书在哪儿？在桌子___边。','fill_blank','easy',1,'左/右',6);
$E3_7=e($conn,$L3,'Chọn đáp án','"给" có nghĩa là:','multiple_choice','easy',1,'B',7);
eo($conn,$E3_7,'Lấy','A',0,1); eo($conn,$E3_7,'Cho, đưa','B',1,2); eo($conn,$E3_7,'Đặt','C',0,3);
// Review L3
foreach ([$v3_1,$v3_2,$v3_3,$v3_4,$v3_5,$v3_6,$v3_7,$v3_8,$v3_9] as $i=>$vid) if ($vid) rv($conn,$L3,$vid,'core',$i+1);
echo " HSK2 L3 done: $v3 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L4: 这个工作是他帮我介绍的
// ═══════════════════════════════════════════════════
$L4=createLesson($conn,2,4,'Bài 4: Zhe ge gong zuo shi ta bang wo jie shao de','Nhờ vả, giúp đỡ. Câu chẻ 是...的.','["Gioi thieu","Tro giup","Cong viec"]','Gioi thieu','easy','HSK2 Bài 4: Nhờ vả và giới thiệu. Câu chẻ 是...的 (nhấn mạnh). Động từ bāng (giúp) + ai + V. Từ vựng: gōngzuò (công việc), jièshào (giới thiệu), bāngzhù (giúp đỡ), yīqǐ (cùng nhau).');
$v4=0;
$v4_1=v($conn,$L4,1,'工作','gōngzuò','công việc, làm việc','công việc','找到工作。','Zhǎodào gōngzuò.','Tìm được việc.','noun/verb','Vừa là danh từ vừa động từ.',++$v4);
$v4_2=v($conn,$L4,1,'介绍','jièshào','giới thiệu','giới thiệu','介绍朋友。','Jièshào péngyou.','Giới thiệu bạn bè.','verb','Động từ giới thiệu.',++$v4);
$v4_3=v($conn,$L4,1,'帮','bāng','giúp','giúp','帮我一个忙。','Bāng wǒ yí ge máng.','Giúp tôi một việc.','verb','bāng + O + V.',++$v4);
$v4_4=v($conn,$L4,1,'找到','zhǎodào','tìm thấy','tìm thấy','找到工作了。','Zhǎodào gōngzuò le.','Tìm thấy việc rồi.','verb','Kết quả bổ ngữ: 找 + 到.',++$v4);
$v4_5=v($conn,$L4,1,'起','qǐ','nổi (khả năng)','nổi','买不起。','Mǎi bù qǐ.','Mua không nổi.','verb','Bổ ngữ khả năng.',++$v4);
$v4_6=v($conn,$L4,1,'一起','yīqǐ','cùng nhau','cùng','一起学习。','Yīqǐ xuéxí.','Cùng nhau học.','adv','Phó từ chỉ cùng làm.',++$v4);
$v4_7=v($conn,$L4,1,'公司','gōngsī','công ty','công ty','在一家公司上班。','Zài yì jiā gōngsī shàngbān.','Làm ở một công ty.','noun','Lượng từ: 家.',++$v4);
$v4_8=v($conn,$L4,1,'会','huì','biết, có thể','biết','会汉语。','Huì Hànyǔ.','Biết tiếng Trung.','verb','Năng lực do học tập.',++$v4);
// Grammar L4
$g4_1=g($conn,$L4,'Câu chẻ 是...的','是 + (Người) + Động từ + 的 + (Tân ngữ)','Nhấn mạnh ai làm gì','是...的 nhấn mạnh chủ thể thực hiện hành động. Thường dùng khi đã biết hành động nhưng muốn nhấn mạnh ai làm.','Phủ định: 不是...的. Câu hỏi: 是...的吗？','Nhấn mạnh chủ thể.',1);
ge($conn,$g4_1,'这个工作是他帮我介绍的。','Zhè ge gōngzuò shì tā bāng wǒ jièshào de.','Công việc này là anh ấy giới thiệu cho tôi.',1);
ge($conn,$g4_1,'这本书是我买的。','Zhè běn shū shì wǒ mǎi de.','Cuốn sách này là tôi mua.',2);
$g4_2=g($conn,$L4,'Động từ 帮 + ai + V','帮 + Người + Động từ','Giúp ai làm gì','帮 là động từ dịch thuật, yêu cầu tân ngữ chỉ người, sau đó là động từ chỉ hành động.','帮忙 là hình thức phân ly: 帮我的忙.','Cấu trúc nhờ vả.',2);
ge($conn,$g4_2,'他帮我学汉语。','Tā bāng wǒ xué Hànyǔ.','Anh ấy giúp tôi học tiếng Trung.',1);
ge($conn,$g4_2,'你能帮我一个忙吗？','Nǐ néng bāng wǒ yí ge máng ma?','Bạn có thể giúp tôi một việc không?',2);
$g4_3=g($conn,$L4,'Bổ ngữ khả năng:  V + 得/不 + 起','Động từ + 得起/不起','Có/không có khả năng làm gì','Bổ ngữ khả năng: 得起 chỉ khả năng về tài chính hoặc sức lực. 不起 phủ định.','买得起 = mua nổi. 买不起 = mua không nổi. 对不起 = xin lỗi (không đối nổi).','Khả năng hành động.',3);
ge($conn,$g4_3,'这个太贵了，我买不起。','Zhè ge tài guì le, wǒ mǎi bù qǐ.','Cái này đắt quá, tôi mua không nổi.',1);
ge($conn,$g4_3,'这辆车他买得起。','Zhè liàng chē tā mǎi de qǐ.','Chiếc xe này anh ấy mua nổi.',2);
// Dialogues L4
$d4_1=d($conn,$L4,'Gioi thieu cong viec','Giới thiệu công việc cho bạn.',1);
ds($conn,$d4_1,'Anna','我找到新工作了！','Wǒ zhǎodào xīn gōngzuò le!','Tôi tìm được việc mới rồi!',1);
ds($conn,$d4_1,'Xiao Ming','太好了！是哪家公司？','Tài hǎo le! Shì nǎ jiā gōngsī?','Tuyệt quá! Là công ty nào?',2);
ds($conn,$d4_1,'Anna','是朋友帮我介绍的。','Shì péngyou bāng wǒ jièshào de.','Là bạn giới thiệu cho tôi.',3);
ds($conn,$d4_1,'Xiao Ming','你朋友真好。','Nǐ péngyou zhēn hǎo.','Bạn của bạn thật tốt.',4);
$d4_2=d($conn,$L4,'Giup do hoc tap','Nhờ giúp đỡ học tập.',2);
ds($conn,$d4_2,'Anna','你能帮我学汉语吗？','Nǐ néng bāng wǒ xué Hànyǔ ma?','Bạn có thể giúp tôi học tiếng Trung không?',1);
ds($conn,$d4_2,'Xiao Ming','可以。你想学什么？','Kěyǐ. Nǐ xiǎng xué shénme?','Được. Bạn muốn học gì?',2);
ds($conn,$d4_2,'Anna','我想学写汉字。','Wǒ xiǎng xué xiě Hànzì.','Tôi muốn học viết chữ Hán.',3);
ds($conn,$d4_2,'Xiao Ming','没问题，我们一起学。','Méi wèntí, wǒmen yīqǐ xué.','Không vấn đề, chúng ta cùng học.',4);
// Reading L4
r($conn,$L4,'Nho viec','上个星期朋友帮我介绍了一份新工作。是朋友帮我找到的。公司在市中心，不太远。我会说汉语，所以工作很适合我。今天开始上班，和同事一起工作很高兴。','Shàng ge xīngqī péngyou bāng wǒ jièshào le yí fèn xīn gōngzuò. Shì péngyou bāng wǒ zhǎodào de. Gōngsī zài shì zhōngxīn, bú tài yuǎn. Wǒ huì shuō Hànyǔ, suǒyǐ gōngzuò hěn shìhé wǒ. Jīntiān kāishǐ shàngbān, hé tóngshì yīqǐ gōngzuò hěn gāoxìng.','Tuần trước bạn tôi giới thiệu một công việc mới. Là bạn giúp tôi tìm được. Công ty ở trung tâm thành phố, không quá xa. Tôi biết nói tiếng Trung nên công việc rất phù hợp. Hôm nay bắt đầu làm, cùng đồng nghiệp làm việc rất vui.','easy',85,1);
// Listening L4
$L4l=l($conn,$L4,'Gioi thieu','A:这个工作是你自己找的吗？B:不是，是朋友介绍的。A:他帮了你一个忙。B:对，我请他吃饭了。A:应该的。','A:Zhè ge gōngzuò shì nǐ zìjǐ zhǎo de ma? B:Bú shì, shì péngyou jièshào de. A:Tā bāng le nǐ yí ge máng. B:Duì, wǒ qǐng tā chīfàn le. A:Yīnggāi de.','A:Công việc này tự bạn tìm à? B:Không, là bạn giới thiệu. A:Anh ấy đã giúp bạn một việc. B:Đúng, tôi đã mời anh ấy ăn cơm. A:Đáng lẽ.','1');
lq($conn,$L4l,'Công việc này do ai giới thiệu?','{"A":"Tự tìm","B":"Bạn giới thiệu","C":"Người thân"}','Bạn giới thiệu','Bạn giới thiệu.','multiple_choice',1);
lq($conn,$L4l,'Người B đã làm gì để cảm ơn?','{"A":"Tặng quà","B":"Mời ăn cơm","C":"Cảm ơn"}','Mời ăn cơm','Đã mời bạn ăn cơm.','multiple_choice',2);
// Exercises L4
$E4_1=e($conn,$L4,'Chọn đáp án','Câu chẻ "是...的" dùng để:','multiple_choice','easy',1,'B',1);
eo($conn,$E4_1,'Hỏi thời gian','A',0,1); eo($conn,$E4_1,'Nhấn mạnh chủ thể','B',1,2); eo($conn,$E4_1,'Hỏi địa điểm','C',0,3);
$E4_2=e($conn,$L4,'Dịch','"Anh ấy giúp tôi học tiếng Trung."','translation','easy',1,'他帮我学汉语。',2);
$E4_3=e($conn,$L4,'Điền từ','___我帮你介绍的吧。(là...mà)','fill_blank','easy',1,'是',3);
$E4_4=e($conn,$L4,'Sắp xếp câu','是他 / 这个 / 介绍 / 的 / 工作','sentence_order','easy',1,'这个工作是他介绍的。',4);
$E4_5=e($conn,$L4,'Chọn đúng/sai','"买不起" có nghĩa là "mua nổi".','true_false','easy',1,'false',5);
eo($conn,$E4_5,'Đúng','A',0,1); eo($conn,$E4_5,'Sai','B',1,2);
$E4_6=e($conn,$L4,'Điền từ','我们一___学习吧。(cùng nhau)','fill_blank','easy',1,'起',6);
// Review L4
foreach ([$v4_1,$v4_2,$v4_3,$v4_4,$v4_5,$v4_6,$v4_7,$v4_8] as $i=>$vid) if ($vid) rv($conn,$L4,$vid,'core',$i+1);
echo " HSK2 L4 done: $v4 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L5: 就买这个吧
// ═══════════════════════════════════════════════════
$L5=createLesson($conn,2,5,'Bài 5: Jiu mai zhe ge ba - Cứ mua cái này đi','Mua sắm nâng cao. Câu đề xuất. Lượng từ đa dạng.','["Mua sam nang cao","De xuat","Luong tu"]','Mua sam','easy','HSK2 Bài 5: Mua sắm nâng cao. Đề xuất với 吧 (đi). Lượng từ: shuāng (đôi), shuāng (双), tiáo (chiếc/váy/quần), shuāng (đôi giày). Từ vựng: shuāng (đôi), tiáo (cái váy/quần), shì (thử), shūfu (thoải mái).');
$v5=0;
$v5_1=v($conn,$L5,1,'双','shuāng','đôi (lượng từ)','đôi','一双鞋。','Yì shuāng xié.','Một đôi giày.','measure','Đôi: giày, tất, đũa.',++$v5);
$v5_2=v($conn,$L5,1,'条','tiáo','chiếc (lượng từ)','chiếc','一条裙子。','Yì tiáo qúnzi.','Một cái váy.','measure','Đồ dài: quần, váy, khăn.',++$v5);
$v5_3=v($conn,$L5,1,'件','jiàn','cái (lượng từ)','cái','一件衣服。','Yí jiàn yīfu.','Một cái áo.','measure','Đồ vật, sự việc.',++$v5);
$v5_4=v($conn,$L5,1,'试','shì','thử (đồ)','thử','试试这件。','Shìshi zhè jiàn.','Thử cái này.','verb','Thử quần áo.',++$v5);
$v5_5=v($conn,$L5,1,'舒服','shūfu','thoải mái','thoải mái','很舒服。','Hěn shūfu.','Rất thoải mái.','adj','Cảm giác dễ chịu.',++$v5);
$v5_6=v($conn,$L5,1,'合适','héshì','phù hợp','phù hợp','大小合适。','Dàxiǎo héshì.','Kích cỡ phù hợp.','adj','Vừa vặn, phù hợp.',++$v5);
$v5_7=v($conn,$L5,1,'当然','dāngrán','đương nhiên','đương nhiên','当然可以。','Dāngrán kěyǐ.','Đương nhiên có thể.','adv','Phó từ khẳng định.',++$v5);
$v5_8=v($conn,$L5,1,'便宜点','piányi diǎn','rẻ một chút','rẻ tí','便宜点吧。','Piányi diǎn ba.','Rẻ một chút đi.','phrase','Mặc cả.',++$v5);
// Grammar L5
$g5_1=g($conn,$L5,'Đề xuất với 吧','Câu đề xuất + 吧','Làm gì đó đi (gợi ý)','吧 ở cuối câu dùng để đề xuất, gợi ý hoặc đồng ý. Nhẹ nhàng hơn mệnh lệnh.','吧 có thể kết hợp với 就 để nhấn mạnh: 就买这个吧 (cứ mua cái này đi).','Gợi ý lịch sự.',1);
ge($conn,$g5_1,'就买这个吧。','Jiù mǎi zhè ge ba.','Cứ mua cái này đi.',1);
ge($conn,$g5_1,'我们一起去吧。','Wǒmen yīqǐ qù ba.','Chúng ta cùng đi đi.',2);
$g5_2=g($conn,$L5,'Lượng từ chuyên biệt','Số + Lượng từ + Danh từ','Đơn vị đếm đồ vật','双 (đôi): giày, vớ, đũa. 条 (chiếc): quần, váy, khăn, cá. 件 (cái): áo, sự việc. Chọn sai lượng từ sẽ nghe không tự nhiên.','一双鞋 / 一条裙子 / 一件衣服.','Đơn vị đếm chuyên biệt.',2);
ge($conn,$g5_2,'我买了一条裙子。','Wǒ mǎi le yì tiáo qúnzi.','Tôi mua một cái váy.',1);
ge($conn,$g5_2,'这双鞋多少钱？','Zhè shuāng xié duōshao qián?','Đôi giày này bao nhiêu tiền?',2);
$g5_3=g($conn,$L5,'Mặc cả: 便宜一点 + 吧','便宜一点 + 吧','Rẻ hơn một chút đi','Khi mua sắm có thể mặc cả bằng cách nói 便宜一点吧. Có thể thay số cụ thể: 便宜十块吧.','Đây là cách mặc cả đơn giản trong giao tiếp.','Mặc cả khi mua.',3);
ge($conn,$g5_3,'便宜一点儿吧。','Piányi yì diǎnr ba.','Rẻ hơn một chút đi.',1);
ge($conn,$g5_3,'再便宜十块钱吧。','Zài piányi shí kuài qián ba.','Rẻ thêm 10 đồng đi.',2);
// Dialogues L5
$d5_1=d($conn,$L5,'Mua giay','Đi mua giày.',1);
ds($conn,$d5_1,'Anna','这双鞋多少钱？','Zhè shuāng xié duōshao qián?','Đôi giày này bao nhiêu?',1);
ds($conn,$d5_1,'Nguoi ban','一百五十块。','Yìbǎi wǔshí kuài.','150 đồng.',2);
ds($conn,$d5_1,'Anna','可以试一下吗？','Kěyǐ shì yíxià ma?','Có thể thử một chút không?',3);
ds($conn,$d5_1,'Nguoi ban','当然可以。','Dāngrán kěyǐ.','Đương nhiên có thể.',4);
ds($conn,$d5_1,'Anna','很舒服，大小也合适。就买这双吧。','Hěn shūfu, dàxiǎo yě héshì. Jiù mǎi zhè shuāng ba.','Rất thoải mái, kích cỡ cũng vừa. Cứ mua đôi này đi.',5);
$d5_2=d($conn,$L5,'Mua vay','Mua váy và mặc cả.',2);
ds($conn,$d5_2,'Anna','这条裙子真漂亮！多少钱？','Zhè tiáo qúnzi zhēn piàoliang! Duōshao qián?','Cái váy này đẹp quá! Bao nhiêu?',1);
ds($conn,$d5_2,'Nguoi ban','两百块。','Liǎng bǎi kuài.','200 đồng.',2);
ds($conn,$d5_2,'Anna','太贵了，便宜一点吧。','Tài guì le, piányi yì diǎn ba.','Đắt quá, rẻ một chút đi.',3);
ds($conn,$d5_2,'Nguoi ban','那你说多少钱？','Nà nǐ shuō duōshao qián?','Vậy bạn nói bao nhiêu?',4);
ds($conn,$d5_2,'Anna','一百五吧。','Yìbǎi wǔ ba.','150 thôi.',5);
ds($conn,$d5_2,'Nguoi ban','好吧，就这个价钱。','Hǎo ba, jiù zhè ge jiàqian.','Được, cứ giá này.',6);
// Reading L5
r($conn,$L5,'Di mua sam','今天我去逛街。商店里的东西很多。我看中了一件衣服和一条裙子。衣服一百五十块，裙子两百块。我试了试，都很舒服。但是太贵了。我和老板说便宜一点，最后两件一共三百块。我就买了。今天真高兴！','Jīntiān wǒ qù guàngjiē. Shāngdiàn lǐ de dōngxi hěn duō. Wǒ kànzhòng le yí jiàn yīfu hé yì tiáo qúnzi. Yīfu yìbǎi wǔshí kuài, qúnzi liǎng bǎi kuài. Wǒ shì le shì, dōu hěn shūfu. Dànshì tài guì le. Wǒ hé lǎobǎn shuō piányi yì diǎn, zuìhòu liǎng jiàn yígòng sān bǎi kuài. Wǒ jiù mǎi le. Jīntiān zhēn gāoxìng!','Hôm nay tôi đi dạo phố. Trong cửa hàng có nhiều đồ. Tôi thích một cái áo và một cái váy. Áo 150, váy 200. Tôi thử rồi, đều thoải mái. Nhưng đắt quá. Tôi nói với chủ cửa hàng rẻ một chút, cuối cùng cả hai 300. Tôi liền mua. Hôm nay thật vui!','easy',90,1);
// Listening L5
$L5l=l($conn,$L5,'Mua sam','A:你看这条裙子怎么样？B:很好看。你试试吧。A:好。...好看吗？B:很适合你。就买这条吧。A:好，就听你的。','A:Nǐ kàn zhè tiáo qúnzi zěnme yàng? B:Hěn hǎokàn. Nǐ shìshi ba. A:Hǎo... hǎokàn ma? B:Hěn shìhé nǐ. Jiù mǎi zhè tiáo ba. A:Hǎo, jiù tīng nǐ de.','A:Bạn thấy cái váy này thế nào? B:Rất đẹp. Bạn thử đi. A:Được... có đẹp không? B:Rất hợp với bạn. Cứ mua cái này đi. A:Được, nghe bạn.','1');
lq($conn,$L5l,'Người B nghĩ váy thế nào?','{"A":"Xấu","B":"Đẹp","C":"Đắt"}','Đẹp','Rất đẹp.','multiple_choice',1);
lq($conn,$L5l,'Cuối cùng người A làm gì?','{"A":"Không mua","B":"Mua váy","C":"Để sau"}','Mua váy','Nghe lời khuyên mua váy.','multiple_choice',2);
// Exercises L5
$E5_1=e($conn,$L5,'Chọn đáp án','"Đôi" là lượng từ nào?','multiple_choice','easy',1,'B',1);
eo($conn,$E5_1,'条','A',0,1); eo($conn,$E5_1,'双','B',1,2); eo($conn,$E5_1,'件','C',0,3);
$E5_2=e($conn,$L5,'Dịch','"Cứ mua cái này đi."','translation','easy',1,'就买这个吧。',2);
$E5_3=e($conn,$L5,'Điền từ','试试这___鞋。(đôi)','fill_blank','easy',1,'双',3);
$E5_4=e($conn,$L5,'Sắp xếp câu','吧 / 便宜 / 一点 / 再','sentence_order','easy',1,'再便宜一点吧。',4);
$E5_5=e($conn,$L5,'Chọn đúng/sai','"合适" có nghĩa là "thoải mái".','true_false','easy',1,'false',5);
eo($conn,$E5_5,'Đúng','A',0,1); eo($conn,$E5_5,'Sai','B',1,2);
$E5_6=e($conn,$L5,'Điền từ','这条裙子很___。(phù hợp)','fill_blank','easy',1,'合适',6);
$E5_7=e($conn,$L5,'Chọn lượng từ','一___裙子 dùng:','multiple_choice','easy',1,'B',7);
eo($conn,$E5_7,'双','A',0,1); eo($conn,$E5_7,'条','B',1,2); eo($conn,$E5_7,'件','C',0,3);
// Review L5
foreach ([$v5_1,$v5_2,$v5_3,$v5_4,$v5_5,$v5_6,$v5_7,$v5_8] as $i=>$vid) if ($vid) rv($conn,$L5,$vid,'core',$i+1);
echo " HSK2 L5 done: $v5 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";
