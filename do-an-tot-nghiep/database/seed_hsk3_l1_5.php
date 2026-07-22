<?php
/**
 * HÀNNGỮ - HSK3 Content Seeder (Lessons 1-5)
 * HSK Standard Course 3: 300+ words, complex grammar, 2-3 dialogues/lesson
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK3 L1: 周末你有什么打算
// ═══════════════════════════════════════════════════
$L1=createLesson($conn,3,1,'Bài 1: Zhou mo ni you shen me da suan - Cuối tuần bạn có dự định gì','Dự định cuối tuần, hoạt động ngoài trời, mời rủ bạn bè.','["Cuoi tuan","Du dinh","Hoat dong ngoai troi"]','Cuoi tuan','easy','HSK3 Bài 1: Hỏi và nói về dự định cuối tuần. Động từ 打算 (dự định), 觉得 (cảm thấy/nghĩ rằng). Cấu trúc mời rủ: 一起 + V (cùng nhau). Từ vựng hoạt động: páshān (leo núi), yóuyǒng (bơi), fēngjǐng (phong cảnh).');
$v1=0;
$v1_1=v($conn,$L1,3,'打算','dǎsuàn','dự định, tính','dự định','周末你有什么打算？','Zhōumò nǐ yǒu shénme dǎsuàn?','Cuối tuần bạn có dự định gì?','verb/noun','Vừa là động từ vừa danh từ.',++$v1);
$v1_2=v($conn,$L1,3,'觉得','juéde','cảm thấy, nghĩ rằng','nghĩ','我觉得这个计划不错。','Wǒ juéde zhè ge jìhuà búcuò.','Tôi thấy kế hoạch này không tồi.','verb','Động từ diễn tả ý kiến.',++$v1);
$v1_3=v($conn,$L1,3,'周末','zhōumò','cuối tuần','cuối tuần','周末我们去爬山吧。','Zhōumò wǒmen qù páshān ba.','Cuối tuần chúng ta đi leo núi nhé.','noun','Thứ Bảy và Chủ nhật.',++$v1);
$v1_4=v($conn,$L1,3,'爬山','páshān','leo núi','leo núi','我喜欢爬山。','Wǒ xǐhuan páshān.','Tôi thích leo núi.','verb','Hoạt động thể thao ngoài trời.',++$v1);
$v1_5=v($conn,$L1,3,'活动','huódòng','hoạt động','hoạt động','周末有什么活动？','Zhōumò yǒu shénme huódòng?','Cuối tuần có hoạt động gì?','noun','Sự kiện hoặc sinh hoạt.',++$v1);
$v1_6=v($conn,$L1,3,'风景','fēngjǐng','phong cảnh','cảnh','这里的风景很美。','Zhèlǐ de fēngjǐng hěn měi.','Phong cảnh ở đây rất đẹp.','noun','Cảnh đẹp thiên nhiên.',++$v1);
$v1_7=v($conn,$L1,3,'照相','zhàoxiàng','chụp ảnh','chụp ảnh','我们一起照相吧。','Wǒmen yīqǐ zhàoxiàng ba.','Chúng ta cùng chụp ảnh nhé.','verb','Động từ chụp hình.',++$v1);
$v1_8=v($conn,$L1,3,'游泳','yóuyǒng','bơi lội','bơi','夏天我喜欢游泳。','Xiàtiān wǒ xǐhuan yóuyǒng.','Mùa hè tôi thích bơi.','verb','Môn thể thao dưới nước.',++$v1);
$v1_9=v($conn,$L1,3,'一起','yīqǐ','cùng nhau','cùng','我们一起学汉语。','Wǒmen yīqǐ xué Hànyǔ.','Chúng ta cùng học tiếng Trung.','adv','Phó từ chỉ cùng làm việc gì.',++$v1);
// Grammar L1
$g1_1=g($conn,$L1,'Cấu trúc 打算 + Động từ','打算 + V / 不打算 + V','Dự định làm gì / Không dự định làm gì','打算 là động từ chỉ dự định, theo sau là động từ hoặc cụm động từ. Câu hỏi: 打算做什么？ Phủ định: 不打算.','Thường dùng để hỏi về kế hoạch tương lai gần.',1);
ge($conn,$g1_1,'我打算周末去爬山。','Wǒ dǎsuàn zhōumò qù páshān.','Tôi dự định cuối tuần đi leo núi.',1);
ge($conn,$g1_1,'他不打算在家休息。','Tā bù dǎsuàn zài jiā xiūxi.','Anh ấy không định ở nhà nghỉ ngơi.',2);
$g1_2=g($conn,$L1,'Động từ 觉得 + Mệnh đề','觉得 + Chủ ngữ + V + O','Cảm thấy / Nghĩ rằng...','觉得 diễn tả ý kiến hoặc cảm nhận cá nhân. Có thể đứng trước một mệnh đề hoàn chỉnh. Thường dùng để đưa ra nhận xét nhẹ nhàng.','觉得 khác 感觉: 感觉 là cảm giác vật lý.',2);
ge($conn,$g1_2,'你觉得这个计划怎么样？','Nǐ juéde zhè ge jìhuà zěnme yàng?','Bạn thấy kế hoạch này thế nào?',1);
ge($conn,$g1_2,'我觉得明天会下雨。','Wǒ juéde míngtiān huì xiàyǔ.','Tôi nghĩ ngày mai sẽ mưa.',2);
$g1_3=g($conn,$L1,'Cấu trúc 一起 + Động từ','一起 + Động từ','Cùng nhau làm gì','一起 là phó từ chỉ hành động cùng nhau, đứng trước động từ. Có thể kết hợp với 跟/和 để chỉ cùng với ai.','Rủ rê bạn bè bằng câu đề xuất: 我们一起...吧！',3);
ge($conn,$g1_3,'我们一起去看电影吧。','Wǒmen yīqǐ qù kàn diànyǐng ba.','Chúng ta cùng đi xem phim nhé.',1);
ge($conn,$g1_3,'我想和他一起去旅游。','Wǒ xiǎng hé tā yīqǐ qù lǚyóu.','Tôi muốn đi du lịch cùng anh ấy.',2);
// Dialogues L1
$d1_1=d($conn,$L1,'Du dinh cuoi tuan','Hỏi về dự định cuối tuần.',1);
ds($conn,$d1_1,'Xiao Ming','这个周末你有什么打算？','Zhè ge zhōumò nǐ yǒu shénme dǎsuàn?','Cuối tuần này bạn có dự định gì?',1);
ds($conn,$d1_1,'Anna','我打算去爬山，听说那边的风景很美。','Wǒ dǎsuàn qù páshān, tīngshuō nà biān de fēngjǐng hěn měi.','Tôi định đi leo núi, nghe nói phong cảnh bên đó rất đẹp.',2);
ds($conn,$d1_1,'Xiao Ming','这个主意不错！我能和你一起去吗？','Zhè ge zhǔyi búcuò! Wǒ néng hé nǐ yīqǐ qù ma?','Ý kiến hay quá! Tôi có thể đi cùng bạn không?',3);
ds($conn,$d1_1,'Anna','当然可以，我们一起吧。','Dāngrán kěyǐ, wǒmen yīqǐ ba.','Đương nhiên được, chúng ta cùng đi nhé.',4);
$d1_2=d($conn,$L1,'Rủ đi chơi cuối tuần','Rủ bạn đi bơi.',2);
ds($conn,$d1_2,'Anna','明天天气很好，我们去游泳吧。','Míngtiān tiānqì hěn hǎo, wǒmen qù yóuyǒng ba.','Ngày mai thời tiết đẹp, chúng ta đi bơi nhé.',1);
ds($conn,$d1_2,'Xiao Ming','我不太会游泳，觉得有点害怕。','Wǒ bú tài huì yóuyǒng, juéde yǒudiǎn hàipà.','Tôi không biết bơi lắm, thấy hơi sợ.',2);
ds($conn,$d1_2,'Anna','没关系，我教你。','Méi guānxì, wǒ jiào nǐ.','Không sao, tôi dạy bạn.',3);
ds($conn,$d1_2,'Xiao Ming','那好吧，我们一起照相也行。','Nà hǎo ba, wǒmen yīqǐ zhàoxiàng yě xíng.','Vậy được, chúng ta cùng chụp ảnh cũng được.',4);
// Reading L1
r($conn,$L1,'Cuối tuần vui vẻ','这个周末天气很好，我和朋友打算去爬山。早上八点出发，开车一个小时就到了。山上的风景非常漂亮，我们拍了很多照片。中午在山上吃午饭，下午一起游泳。大家都觉得今天过得很开心。','Zhè ge zhōumò tiānqì hěn hǎo, wǒ hé péngyou dǎsuàn qù páshān. Zǎoshang bā diǎn chūfā, kāichē yí ge xiǎoshí jiù dào le. Shān shang de fēngjǐng fēicháng piàoliang, wǒmen pāi le hěn duō zhàopiàn. Zhōngwǔ zài shān shang chī wǔfàn, xiàwǔ yīqǐ yóuyǒng. Dàjiā dōu juéde jīntiān guò de hěn kāixīn.','Cuối tuần này thời tiết đẹp, tôi và bạn dự định đi leo núi. Sáng 8h xuất phát, lái xe một tiếng là đến. Phong cảnh trên núi rất đẹp, chúng tôi chụp nhiều ảnh. Trưa ăn cơm trên núi, chiều cùng nhau bơi. Mọi người đều thấy hôm nay rất vui.','easy',80,1);
// Listening L1
$L1l=l($conn,$L1,'Du dinh','A:这个周末你打算做什么？B:我打算和朋友去爬山。A:你觉得爬山有意思吗？B:当然有意思，还可以照相。A:那我能一起去吗？B:当然可以，我们一起吧。','A:Zhè ge zhōumò nǐ dǎsuàn zuò shénme? B:Wǒ dǎsuàn hé péngyou qù páshān. A:Nǐ juéde páshān yǒu yìsi ma? B:Dāngrán yǒu yìsi, hái kěyǐ zhàoxiàng. A:Nà wǒ néng yīqǐ qù ma? B:Dāngrán kěyǐ, wǒmen yīqǐ ba.','A:Cuối tuần này bạn định làm gì? B:Tôi định đi leo núi với bạn. A:Bạn thấy leo núi có thú vị không? B:Đương nhiên thú vị, còn có thể chụp ảnh. A:Vậy tôi có thể đi cùng không? B:Đương nhiên được, chúng ta cùng đi.','1');
lq($conn,$L1l,'Người B dự định làm gì cuối tuần?','{"A":"Ở nhà","B":"Đi leo núi","C":"Đi bơi"}','Đi leo núi','B dự định đi leo núi với bạn.','multiple_choice',1);
lq($conn,$L1l,'Người A có thể đi cùng không?','{"A":"Không","B":"Để sau","C":"Có"}','Có','B nói đương nhiên có thể.','multiple_choice',2);
// Exercises L1
$E1_1=e($conn,$L1,'Chọn đáp án','"打算" có nghĩa là:','multiple_choice','easy',1,'B',1);
eo($conn,$E1_1,'Đã xong','A',0,1); eo($conn,$E1_1,'Dự định','B',1,2); eo($conn,$E1_1,'Cảm thấy','C',0,3);
$E1_2=e($conn,$L1,'Dịch','"Tôi dự định cuối tuần đi leo núi."','translation','easy',1,'我打算周末去爬山。',2);
$E1_3=e($conn,$L1,'Điền từ','你___这个计划怎么样？(cảm thấy)','fill_blank','easy',1,'觉得',3);
$E1_4=e($conn,$L1,'Sắp xếp câu','一起 / 我们 / 爬山 / 去 / 吧','sentence_order','easy',1,'我们一起去爬山吧。',4);
$E1_5=e($conn,$L1,'Chọn đúng/sai','"风景" có nghĩa là "phong cảnh".','true_false','easy',1,'true',5);
eo($conn,$E1_5,'Đúng','A',1,1); eo($conn,$E1_5,'Sai','B',0,2);
$E1_6=e($conn,$L1,'Điền từ','周末你有什么打___？(dự định)','fill_blank','easy',1,'算',6);
$E1_7=e($conn,$L1,'Chọn đáp án','"一起" đứng ở vị trí nào trong câu?','multiple_choice','easy',1,'A',7);
eo($conn,$E1_7,'Trước động từ','A',1,1); eo($conn,$E1_7,'Sau động từ','B',0,2); eo($conn,$E1_7,'Cuối câu','C',0,3);
// Review L1
foreach ([$v1_1,$v1_2,$v1_3,$v1_4,$v1_5,$v1_6,$v1_7,$v1_8,$v1_9] as $i=>$vid) if ($vid) rv($conn,$L1,$vid,'core',$i+1);
echo " HSK3 L1 done: $v1 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L2: 他什么时候回来
// ═══════════════════════════════════════════════════
$L2=createLesson($conn,3,2,'Bài 2: Ta shen me shi hou hui lai - Khi nào anh ấy quay lại','Thời gian, sự trở về, trạng thái đang diễn ra, vừa mới xảy ra.','["Thoi gian","Tro ve","Dang dien ra"]','Thoi gian','easy','HSK3 Bài 2: Hỏi và nói về thời gian quay lại. Phó từ 刚 (vừa mới), cấu trúc 正在...呢 (đang...). Phân biệt 就 (sớm) và 才 (muộn). Từ vựng: huílái (về), chūqù (ra ngoài), zháojí (sốt ruột), děng (chờ).');
$v2=0;
$v2_1=v($conn,$L2,3,'回来','huílái','quay lại, trở về','về','他什么时候回来？','Tā shénme shíhou huílái?','Khi nào anh ấy quay về?','verb','Động từ xu hướng phức hợp.',++$v2);
$v2_2=v($conn,$L2,3,'出去','chūqù','đi ra ngoài','ra ngoài','他刚出去。','Tā gāng chūqù.','Anh ấy vừa ra ngoài.','verb','Động từ xu hướng phức hợp.',++$v2);
$v2_3=v($conn,$L2,3,'刚','gāng','vừa mới','vừa mới','我刚到公司。','Wǒ gāng dào gōngsī.','Tôi vừa đến công ty.','adv','Phó từ chỉ hành động vừa xảy ra.',++$v2);
$v2_4=v($conn,$L2,3,'正在','zhèngzài','đang (làm gì)','đang','他正在吃饭。','Tā zhèngzài chīfàn.','Anh ấy đang ăn cơm.','adv','Phó từ chỉ hành động đang diễn ra.',++$v2);
$v2_5=v($conn,$L2,3,'着急','zháojí','sốt ruột, lo lắng','lo','别着急，他马上回来。','Bié zháojí, tā mǎshàng huílái.','Đừng lo, anh ấy về ngay.','adj','Trạng thái tâm lý.',++$v2);
$v2_6=v($conn,$L2,3,'等','děng','đợi, chờ','chờ','我等你回来。','Wǒ děng nǐ huílái.','Tôi chờ bạn quay về.','verb','Động từ chờ đợi.',++$v2);
$v2_7=v($conn,$L2,3,'开','kāi','mở','mở','请开门。','Qǐng kāi mén.','Làm ơn mở cửa.','verb','Động từ mở.',++$v2);
$v2_8=v($conn,$L2,3,'马上','mǎshàng','ngay lập tức','ngay','我马上就来。','Wǒ mǎshàng jiù lái.','Tôi đến ngay.','adv','Phó từ chỉ hành động sắp xảy ra.',++$v2);
$v2_9=v($conn,$L2,3,'门','mén','cửa','cửa','门开了。','Mén kāi le.','Cửa đã mở.','noun','Lượng từ: shàn (扇).',++$v2);
// Grammar L2
$g2_1=g($conn,$L2,'Phó từ 刚','刚 + Động từ','Vừa mới làm gì','刚 chỉ hành động vừa mới xảy ra. Không dùng với thời gian cụ thể. Phân biệt: 刚才 (lúc nãy) là danh từ chỉ thời gian.','刚 hoàn toàn khác 刚才.',1);
ge($conn,$g2_1,'他刚走。','Tā gāng zǒu.','Anh ấy vừa đi.',1);
ge($conn,$g2_1,'我刚吃完午饭。','Wǒ gāng chī wán wǔfàn.','Tôi vừa ăn xong bữa trưa.',2);
$g2_2=g($conn,$L2,'Cấu trúc 正在...呢','正在 + Động từ (+ Tân ngữ) + 呢','Đang làm gì','Diễn tả hành động đang diễn ra tại thời điểm nói. Có thể bỏ 正在 và chỉ dùng 呢 ở cuối câu. Phủ định: 没在 + V.','Có thể nói: 我吃饭呢 (đang ăn).',2);
ge($conn,$g2_2,'他正在看电视呢。','Tā zhèngzài kàn diànshì ne.','Anh ấy đang xem TV.',1);
ge($conn,$g2_2,'我正在等朋友呢。','Wǒ zhèngzài děng péngyou ne.','Tôi đang đợi bạn.',2);
$g2_3=g($conn,$L2,'Phân biệt 就 và 才','Thời gian + 就/才 + Động từ + (了)','就 (sớm) vs 才 (muộn)','就 chỉ hành động xảy ra sớm hơn dự kiến; 才 chỉ hành động xảy ra muộn hơn dự kiến. Cả hai đều đứng sau thời gian và trước động từ.','六点就起床 (6h dậy - sớm). 九点才起床 (9h dậy - muộn).',3);
ge($conn,$g2_3,'他八点就来了。','Tā bā diǎn jiù lái le.','Anh ấy 8h đã đến rồi.',1);
ge($conn,$g2_3,'他十点才回来。','Tā shí diǎn cái huílái.','Anh ấy 10h mới về.',2);
// Dialogues L2
$d2_1=d($conn,$L2,'Cho anh ay ve','Đợi người bạn về.',1);
ds($conn,$d2_1,'Anna','小明在吗？我找他有事。','Xiǎo Míng zài ma? Wǒ zhǎo tā yǒu shì.','Tiểu Minh có ở nhà không? Tôi tìm anh ấy có việc.',1);
ds($conn,$d2_1,'Xiao Ming me','他刚出去，不在家。','Tā gāng chūqù, bú zài jiā.','Anh ấy vừa ra ngoài, không ở nhà.',2);
ds($conn,$d2_1,'Anna','他什么时候回来？','Tā shénme shíhou huílái?','Khi nào anh ấy về?',3);
ds($conn,$d2_1,'Xiao Ming me','他正在超市买东西呢，马上回来。','Tā zhèngzài chāoshì mǎi dōngxi ne, mǎshàng huílái.','Anh ấy đang mua đồ ở siêu thị, sắp về.',4);
$d2_2=d($conn,$L2,'Sap den muon','Nói về việc sắp muộn.',2);
ds($conn,$d2_2,'Anna','都八点了，他怎么还没来？','Dōu bā diǎn le, tā zěnme hái méi lái?','Đã 8h rồi, sao anh ấy chưa đến?',1);
ds($conn,$d2_2,'Xiao Ming','别着急，他马上就到。','Bié zháojí, tā mǎshàng jiù dào.','Đừng lo, anh ấy sắp đến.',2);
ds($conn,$d2_2,'Anna','他说几点出发的？','Tā shuō jǐ diǎn chūfā de?','Anh ấy nói mấy giờ xuất phát?',3);
ds($conn,$d2_2,'Xiao Ming','他说七点半就出发了。','Tā shuō qī diǎn bàn jiù chūfā le.','Anh ấy nói 7h rưỡi đã xuất phát rồi.',4);
// Reading L2
r($conn,$L2,'Cho ban ve','今天下午我在家等小明。他上午就出去了，说中午回来。可是到下午两点他还没回来。我有点着急，就给他打电话。他说正在路上呢，马上就到。过了一会儿，门开了，他回来了。原来他刚去了超市买东西。','Jīntiān xiàwǔ wǒ zài jiā děng Xiǎo Míng. Tā shàngwǔ jiù chūqù le, shuō zhōngwǔ huílái. Kěshì dào xiàwǔ liǎng diǎn tā hái méi huílái. Wǒ yǒudiǎn zháojí, jiù gěi tā dǎ diànhuà. Tā shuō zhèngzài lù shang ne, mǎshàng jiù dào. Guò le yíhuìr, mén kāi le, tā huílái le. Yuánlái tā gāng qù le chāoshì mǎi dōngxi.','Chiều nay tôi ở nhà đợi Tiểu Minh. Anh ấy sáng đã ra ngoài, nói trưa về. Nhưng đến 2h chiều vẫn chưa về. Tôi hơi lo, gọi điện cho anh ấy. Anh ấy nói đang trên đường, sắp đến. Một lát sau, cửa mở, anh ấy về rồi. Hóa ra anh ấy vừa đi siêu thị mua đồ.','easy',90,1);
// Listening L2
$L2l=l($conn,$L2,'Cho nguoi','A:小明回来了吗？B:还没呢。A:他什么时候出去的？B:他刚出去十分钟。A:他说几点回来？B:他说马上回来，正在路上呢。','A:Xiǎo Míng huílái le ma? B:Hái méi ne. A:Tā shénme shíhou chūqù de? B:Tā gāng chūqù shí fēnzhōng. A:Tā shuō jǐ diǎn huílái? B:Tā shuō mǎshàng huílái, zhèngzài lù shang ne.','A:Tiểu Minh về chưa? B:Chưa. A:Anh ấy ra ngoài lúc nào? B:Vừa ra ngoài 10 phút. A:Anh ấy nói mấy giờ về? B:Nói sắp về, đang trên đường.','1');
lq($conn,$L2l,'Tiểu Minh đã về chưa?','{"A":"Rồi","B":"Chưa","C":"Sắp về"}','Chưa','Chưa về.','multiple_choice',1);
lq($conn,$L2l,'Tiểu Minh ra ngoài được bao lâu?','{"A":"5 phút","B":"10 phút","C":"20 phút"}','10 phút','Vừa ra ngoài 10 phút.','multiple_choice',2);
// Exercises L2
$E2_1=e($conn,$L2,'Chọn đáp án','"刚" có nghĩa là:','multiple_choice','easy',1,'A',1);
eo($conn,$E2_1,'Vừa mới','A',1,1); eo($conn,$E2_1,'Đã xong','B',0,2); eo($conn,$E2_1,'Sắp','C',0,3);
$E2_2=e($conn,$L2,'Dịch','"Anh ấy đang xem TV."','translation','easy',1,'他正在看电视。',2);
$E2_3=e($conn,$L2,'Điền từ','他___出去十分钟。(vừa mới)','fill_blank','easy',1,'刚',3);
$E2_4=e($conn,$L2,'Sắp xếp câu','正在 / 他 / 呢 / 吃饭','sentence_order','easy',1,'他正在吃饭呢。',4);
$E2_5=e($conn,$L2,'Chọn đúng/sai','"才" chỉ hành động xảy ra sớm.','true_false','easy',1,'false',5);
eo($conn,$E2_5,'Đúng','A',0,1); eo($conn,$E2_5,'Sai','B',1,2);
$E2_6=e($conn,$L2,'Điền từ','他八点___起床了。(sớm - liền)','fill_blank','easy',1,'就',6);
$E2_7=e($conn,$L2,'Chọn đáp án','Câu nào dùng "正在...呢" đúng?','multiple_choice','easy',1,'C',7);
eo($conn,$E2_7,'我吃饭正在。','A',0,1); eo($conn,$E2_7,'我正在吃饭了。','B',0,2); eo($conn,$E2_7,'我正在吃饭呢。','C',1,3);
$E2_8=e($conn,$L2,'Điền từ','别___，他马上回来。(lo)','fill_blank','easy',1,'着急',8);
// Review L2
foreach ([$v2_1,$v2_2,$v2_3,$v2_4,$v2_5,$v2_6,$v2_7,$v2_8,$v2_9] as $i=>$vid) if ($vid) rv($conn,$L2,$vid,'core',$i+1);
echo " HSK3 L2 done: $v2 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 8 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L3: 桌子上放着很多饮料
// ═══════════════════════════════════════════════════
$L3=createLesson($conn,3,3,'Bài 3: Zhuo zi shang fang zhe hen duo yin liao - Trên bàn đặt nhiều đồ uống','Câu tồn tại (存现句), vị trí đồ vật, miêu tả cảnh vật.','["Cau ton tai","Vi tri","Mieu ta"]','Vi tri','easy','HSK3 Bài 3: Câu tồn tại (存现句): Địa điểm + V着 + Người/vật. Cấu trúc miêu tả sự vật tồn tại ở đâu đó. Từ vựng: fàng (đặt), zhuōzi (bàn), píng (chai), bēi (cốc), yǐnliào (đồ uống), zuò (ngồi).');
$v3=0;
$v3_1=v($conn,$L3,3,'放','fàng','đặt, để','đặt','桌子上放着书。','Zhuōzi shang fàng zhe shū.','Trên bàn đặt sách.','verb','Động từ đặt đồ vật.',++$v3);
$v3_2=v($conn,$L3,3,'着','zhe','(đang ở trạng thái)','đang','他站着。','Tā zhàn zhe.','Anh ấy đang đứng.','particle','Trợ từ động thái.',++$v3);
$v3_3=v($conn,$L3,3,'饮料','yǐnliào','đồ uống','đồ uống','我要喝饮料。','Wǒ yào hē yǐnliào.','Tôi muốn uống đồ uống.','noun','Nước ngọt, nước giải khát.',++$v3);
$v3_4=v($conn,$L3,3,'瓶','píng','chai, bình','chai','一瓶水。','Yì píng shuǐ.','Một chai nước.','measure','Lượng từ cho chai, lọ.',++$v3);
$v3_5=v($conn,$L3,3,'杯','bēi','cốc, ly','cốc','一杯咖啡。','Yì bēi kāfēi.','Một cốc cà phê.','measure','Lượng từ cho đồ đựng.',++$v3);
$v3_6=v($conn,$L3,3,'果汁','guǒzhī','nước hoa quả','nước ép','我喜欢喝果汁。','Wǒ xǐhuan hē guǒzhī.','Tôi thích uống nước ép hoa quả.','noun','Đồ uống từ trái cây.',++$v3);
$v3_7=v($conn,$L3,3,'可乐','kělè','coca-cola','cola','一瓶可乐。','Yì píng kělè.','Một chai cola.','noun','Nhãn hiệu nước ngọt.',++$v3);
$v3_8=v($conn,$L3,3,'坐','zuò','ngồi','ngồi','沙发上坐着一个人。','Shāfā shang zuò zhe yí ge rén.','Trên ghế sofa có một người đang ngồi.','verb','Động từ ngồi.',++$v3);
$v3_9=v($conn,$L3,3,'旁边','pángbiān','bên cạnh','bên cạnh','椅子旁边放着书包。','Yǐzi pángbiān fàng zhe shūbāo.','Cạnh ghế đặt cặp sách.','noun','Phương vị từ.',++$v3);
// Grammar L3
$g3_1=g($conn,$L3,'Câu tồn tại: Địa điểm + V着','Địa điểm + V着 + Người/Vật','Ở đâu đó có ai/cái gì đang ở trạng thái nào','Câu tồn tại (存现句) dùng để miêu tả sự tồn tại của người hoặc vật ở một địa điểm. Động từ + 着 chỉ trạng thái đang duy trì. Không nhấn mạnh hành động mà nhấn mạnh sự tồn tại.','桌子上放着书 = Trên bàn đặt (sẵn) sách.',1);
ge($conn,$g3_1,'桌子上放着很多饮料。','Zhuōzi shang fàng zhe hěn duō yǐnliào.','Trên bàn đặt rất nhiều đồ uống.',1);
ge($conn,$g3_1,'门口坐着两个人在聊天。','Ménkǒu zuò zhe liǎng ge rén zài liáotiān.','Ở cửa có hai người đang ngồi nói chuyện.',2);
$g3_2=g($conn,$L3,'Địa điểm + 有 + Người/Vật','Địa điểm + 有 + Người/Vật','Ở đâu đó có ai/cái gì','Câu có 有 đơn giản hơn, chỉ sự tồn tại chung chung. Không nhấn mạnh trạng thái. Khác với V着, 有 chỉ sự có mặt đơn thuần.','桌子上有书 = Trên bàn có sách (bất kỳ trạng thái).',2);
ge($conn,$g3_2,'桌子上有三本书。','Zhuōzi shang yǒu sān běn shū.','Trên bàn có ba cuốn sách.',1);
ge($conn,$g3_2,'教室里有很多学生。','Jiàoshì li yǒu hěn duō xuéshēng.','Trong lớp học có rất nhiều học sinh.',2);
$g3_3=g($conn,$L3,'Lượng từ cho đồ đựng: 瓶, 杯','Số + 瓶/杯 + Danh từ','Chai/cốc đựng gì','瓶 dùng cho chai, lọ (一瓶水). 杯 dùng cho cốc, ly (一杯茶). Có thể đứng trước danh từ chỉ chất lỏng.','一瓶可乐 / 一杯咖啡 / 两瓶果汁.',3);
ge($conn,$g3_3,'请给我一杯茶。','Qǐng gěi wǒ yì bēi chá.','Làm ơn cho tôi một cốc trà.',1);
ge($conn,$g3_3,'冰箱里有两瓶可乐。','Bīngxiāng li yǒu liǎng píng kělè.','Trong tủ lạnh có hai chai cola.',2);
// Dialogues L3
$d3_1=d($conn,$L3,'Trong phong khach','Miêu tả phòng khách.',1);
ds($conn,$d3_1,'Anna','你们家客厅真大！','Nǐmen jiā kètīng zhēn dà!','Phòng khách nhà bạn thật rộng!',1);
ds($conn,$d3_1,'Xiao Ming','谢谢。桌子上放着很多饮料，你喝什么？','Xièxie. Zhuōzi shang fàng zhe hěn duō yǐnliào, nǐ hē shénme?','Cảm ơn. Trên bàn có nhiều đồ uống, bạn uống gì?',2);
ds($conn,$d3_1,'Anna','给我一杯果汁吧。','Gěi wǒ yì bēi guǒzhī ba.','Cho tôi một cốc nước ép nhé.',3);
ds($conn,$d3_1,'Xiao Ming','好，沙发上坐着呢，我去拿。','Hǎo, shāfā shang zuò zhe ne, wǒ qù ná.','Được, bạn ngồi trên ghế sofa nhé, tôi đi lấy.',4);
$d3_2=d($conn,$L3,'Phong hoc','Miêu tả lớp học.',2);
ds($conn,$d3_2,'Anna','教室里面都有什么？','Jiàoshì lǐmiàn dōu yǒu shénme?','Trong lớp học có những gì?',1);
ds($conn,$d3_2,'Xiao Ming','讲台上放着一本书，桌子旁边摆着很多椅子。','Jiǎngtái shang fàng zhe yì běn shū, zhuōzi pángbiān bǎi zhe hěn duō yǐzi.','Trên bục giảng đặt một cuốn sách, cạnh bàn bày nhiều ghế.',2);
ds($conn,$d3_2,'Anna','窗户旁边放着什么？','Chuānghu pángbiān fàng zhe shénme?','Cạnh cửa sổ đặt gì?',3);
ds($conn,$d3_2,'Xiao Ming','放着几盆花，很漂亮。','Fàng zhe jǐ pén huā, hěn piàoliang.','Đặt mấy chậu hoa, rất đẹp.',4);
// Reading L3
r($conn,$L3,'Phong khach nha toi','我家的客厅不大，但是很整齐。沙发旁边放着一盏灯，茶几上放着两杯茶和一瓶果汁。电视柜上摆着几张照片。窗户旁边坐着一只猫，正在睡觉呢。桌子上放着很多书，都是我喜欢的。','Wǒ jiā de kètīng bú dà, dànshì hěn zhěngqí. Shāfā pángbiān fàng zhe yì zhǎn dēng, chájī shang fàng zhe liǎng bēi chá hé yì píng guǒzhī. Diànshì guì shang bǎi zhe jǐ zhāng zhàopiàn. Chuānghu pángbiān zuò zhe yì zhī māo, zhèngzài shuìjiào ne. Zhuōzi shang fàng zhe hěn duō shū, dōu shì wǒ xǐhuan de.','Phòng khách nhà tôi không rộng nhưng rất ngăn nắp. Cạnh sofa đặt một cái đèn, trên bàn trà để hai cốc trà và một chai nước ép. Trên tủ TV bày vài tấm ảnh. Cạnh cửa sổ có một con mèo đang ngồi ngủ. Trên bàn để nhiều sách, đều là sách tôi thích.','easy',95,1);
// Listening L3
$L3l=l($conn,$L3,'Trong phong','A:你们的客厅真漂亮！桌子上放着什么？B:放着一些饮料和水果。A:沙发上坐着谁？B:是我妹妹，她正在看书呢。A:窗户旁边放着什么？B:一盆花。','A:Nǐmen de kètīng zhēn piàoliang! Zhuōzi shang fàng zhe shénme? B:Fàng zhe yìxiē yǐnliào hé shuǐguǒ. A:Shāfā shang zuò zhe shéi? B:Shì wǒ mèimei, tā zhèngzài kàn shū ne. A:Chuānghu pángbiān fàng zhe shénme? B:Yì pén huā.','A:Phòng khách nhà bạn đẹp quá! Trên bàn đặt gì vậy? B:Đặt một ít đồ uống và hoa quả. A:Trên sofa ai đang ngồi vậy? B:Là em gái tôi, cô ấy đang đọc sách. A:Cạnh cửa sổ đặt gì? B:Một chậu hoa.','1');
lq($conn,$L3l,'Trên sofa có ai?','{"A":"Mẹ","B":"Em gái","C":"Bố"}','Em gái','Em gái đang ngồi trên sofa.','multiple_choice',1);
lq($conn,$L3l,'Cạnh cửa sổ đặt gì?','{"A":"Sách","B":"Đồ uống","C":"Hoa"}','Hoa','Một chậu hoa.','multiple_choice',2);
// Exercises L3
$E3_1=e($conn,$L3,'Chọn đáp án','Câu tồn tại có cấu trúc:','multiple_choice','easy',1,'A',1);
eo($conn,$E3_1,'Địa điểm + V着 + Người/vật','A',1,1); eo($conn,$E3_1,'Người + V着 + Địa điểm','B',0,2); eo($conn,$E3_1,'V着 + Địa điểm + Người','C',0,3);
$E3_2=e($conn,$L3,'Dịch','"Trên bàn đặt một chai nước."','translation','easy',1,'桌子上放着一瓶水。',2);
$E3_3=e($conn,$L3,'Điền từ','桌子上放___很多饮料。(đang)','fill_blank','easy',1,'着',3);
$E3_4=e($conn,$L3,'Sắp xếp câu','放着 / 桌子上 / 饮料 / 很多','sentence_order','easy',1,'桌子上放着很多饮料。',4);
$E3_5=e($conn,$L3,'Chọn đúng/sai','"着" trong "放着" chỉ hành động đã hoàn thành.','true_false','easy',1,'false',5);
eo($conn,$E3_5,'Đúng','A',0,1); eo($conn,$E3_5,'Sai','B',1,2);
$E3_6=e($conn,$L3,'Điền từ','请给我一___水。(cốc)','fill_blank','easy',1,'杯',6);
$E3_7=e($conn,$L3,'Chọn đáp án','Lượng từ nào dùng cho "可乐"?','multiple_choice','easy',1,'A',7);
eo($conn,$E3_7,'瓶','A',1,1); eo($conn,$E3_7,'条','B',0,2); eo($conn,$E3_7,'双','C',0,3);
// Review L3
foreach ([$v3_1,$v3_2,$v3_3,$v3_4,$v3_5,$v3_6,$v3_7,$v3_8,$v3_9] as $i=>$vid) if ($vid) rv($conn,$L3,$vid,'core',$i+1);
echo " HSK3 L3 done: $v3 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L4: 她总是笑着跟客人说话
// ═══════════════════════════════════════════════════
$L4=createLesson($conn,3,4,'Bài 4: Ta zong shi xiao zhe gen ke ren shuo hua - Cô ấy luôn cười nói chuyện với khách','Cách thức hành động, song song, thói quen. V着V着, 一边...一边..., 总是.','["Cach thuc","Song song","Thoi quen"]','Cach thuc','easy','HSK3 Bài 4: Cấu trúc 一边...一边... (vừa...vừa...), 总是 (luôn luôn), V着V着 (đang...thì...). Diễn tả hai hành động song song hoặc thói quen. Từ vựng: xiào (cười), kèrén (khách), shuōhuà (nói chuyện), shēngyīn (giọng nói), lǐmào (lịch sự).');
$v4=0;
$v4_1=v($conn,$L4,3,'总是','zǒngshì','luôn luôn','luôn','她总是很早就起床。','Tā zǒngshì hěn zǎo jiù qǐchuáng.','Cô ấy luôn dậy rất sớm.','adv','Phó từ chỉ tần suất cao.',++$v4);
$v4_2=v($conn,$L4,3,'笑','xiào','cười','cười','她笑着跟我说话。','Tā xiào zhe gēn wǒ shuōhuà.','Cô ấy cười nói chuyện với tôi.','verb','Động từ chỉ nụ cười.',++$v4);
$v4_3=v($conn,$L4,3,'客人','kèrén','khách, khách mời','khách','家里来了很多客人。','Jiā li lái le hěn duō kèrén.','Nhà có nhiều khách đến.','noun','Người được mời đến.',++$v4);
$v4_4=v($conn,$L4,3,'说话','shuōhuà','nói chuyện','nói chuyện','我们正在说话呢。','Wǒmen zhèngzài shuōhuà ne.','Chúng tôi đang nói chuyện.','verb','Động từ phân ly.',++$v4);
$v4_5=v($conn,$L4,3,'一边...一边...','yìbiān yìbiān','vừa...vừa...','vừa...vừa...','他一边吃饭一边看电视。','Tā yìbiān chīfàn yìbiān kàn diànshì.','Anh ấy vừa ăn cơm vừa xem TV.','conj','Liên từ song song hành động.',++$v4);
$v4_6=v($conn,$L4,3,'声音','shēngyīn','âm thanh, giọng nói','giọng','她的声音很好听。','Tā de shēngyīn hěn hǎotīng.','Giọng cô ấy rất hay.','noun','Âm thanh, giọng nói.',++$v4);
$v4_7=v($conn,$L4,3,'礼貌','lǐmào','lịch sự','lịch sự','他很有礼貌。','Tā hěn yǒu lǐmào.','Anh ấy rất lịch sự.','adj','Phẩm chất giao tiếp.',++$v4);
$v4_8=v($conn,$L4,3,'安静','ānjìng','yên tĩnh','yên tĩnh','请安静。','Qǐng ānjìng.','Xin hãy yên lặng.','adj','Trạng thái không ồn.',++$v4);
$v4_9=v($conn,$L4,3,'最后','zuìhòu','cuối cùng','cuối cùng','最后他来了。','Zuìhòu tā lái le.','Cuối cùng anh ấy đã đến.','noun','Chỉ kết thúc.',++$v4);
// Grammar L4
$g4_1=g($conn,$L4,'Cấu trúc 一边...一边...','一边 + V1 + 一边 + V2','Vừa làm A vừa làm B','Diễn tả hai hành động xảy ra đồng thời. Chủ ngữ đặt trước 一边 đầu tiên hoặc ở đầu câu.','他可以一边走路一边听音乐.',1);
ge($conn,$g4_1,'她一边吃饭一边看手机。','Tā yìbiān chīfàn yìbiān kàn shǒujī.','Cô ấy vừa ăn cơm vừa xem điện thoại.',1);
ge($conn,$g4_1,'我们一边喝茶一边聊天。','Wǒmen yìbiān hē chá yìbiān liáotiān.','Chúng tôi vừa uống trà vừa trò chuyện.',2);
$g4_2=g($conn,$L4,'Phó từ 总是','总是 + Động từ','Luôn luôn làm gì','总是 chỉ hành động lặp lại thường xuyên, mang tính thói quen. Có thể diễn tả sự không hài lòng nhẹ. Phủ định: 不总是.','他总是不按时来 = Anh ấy hay đến không đúng giờ.',2);
ge($conn,$g4_2,'她总是笑着跟客人说话。','Tā zǒngshì xiào zhe gēn kèrén shuōhuà.','Cô ấy luôn cười nói chuyện với khách.',1);
ge($conn,$g4_2,'他上课总是很认真。','Tā shàngkè zǒngshì hěn rènzhēn.','Anh ấy đi học luôn rất nghiêm túc.',2);
$g4_3=g($conn,$L4,'Cấu trúc V着V着 + Kết quả','V着 + V着 + (就) + Kết quả','Đang làm A thì (bỗng nhiên) xảy ra B','V着V着 diễn tả một hành động đang diễn ra liên tục thì đột nhiên có kết quả bất ngờ xảy ra.','走着走着就迷路了 = Đang đi thì lạc đường.',3);
ge($conn,$g4_3,'他走着走着就摔倒了。','Tā zǒu zhe zǒu zhe jiù shuāidǎo le.','Anh ấy đang đi thì ngã.',1);
ge($conn,$g4_3,'我看着看着就睡着了。','Wǒ kàn zhe kàn zhe jiù shuìzháo le.','Tôi đang xem thì ngủ thiếp đi.',2);
// Dialogues L4
$d4_1=d($conn,$L4,'Khach den nha','Tiếp khách đến nhà.',1);
ds($conn,$d4_1,'Anna','你妈妈在家吗？','Nǐ māma zài jiā ma?','Mẹ bạn có ở nhà không?',1);
ds($conn,$d4_1,'Xiao Ming','在呢，她正在厨房做饭。','Zài ne, tā zhèngzài chúfáng zuòfàn.','Có, mẹ đang nấu cơm trong bếp.',2);
ds($conn,$d4_1,'Anna','阿姨总是这么客气。','Āyí zǒngshì zhème kèqi.','Dì luôn khách khí thế.',3);
ds($conn,$d4_1,'Xiao Ming','是啊，她一边做饭一边唱歌，心情很好。','Shì a, tā yìbiān zuòfàn yìbiān chànggē, xīnqíng hěn hǎo.','Ừ, mẹ vừa nấu cơm vừa hát, tâm trạng rất tốt.',4);
$d4_2=d($conn,$L4,'Tro chuyen cung ban','Vừa uống trà vừa nói chuyện.',2);
ds($conn,$d4_2,'Anna','我们一边喝茶一边聊吧。','Wǒmen yìbiān hē chá yìbiān liáo ba.','Chúng ta vừa uống trà vừa nói chuyện nhé.',1);
ds($conn,$d4_2,'Xiao Ming','好。你最近工作怎么样？','Hǎo. Nǐ zuìjìn gōngzuò zěnme yàng?','Được. Dạo này công việc thế nào?',2);
ds($conn,$d4_2,'Anna','还不错。就是每天都很忙。','Hái búcuò. Jiùshì měitiān dōu hěn máng.','Cũng tốt. Chỉ là ngày nào cũng bận.',3);
ds($conn,$d4_2,'Xiao Ming','别太累了，要注意身体。','Bié tài lèi le, yào zhùyì shēntǐ.','Đừng mệt quá, phải chú ý sức khỏe.',4);
ds($conn,$d4_2,'Anna','谢谢你，你真关心我。','Xièxie nǐ, nǐ zhēn guānxīn wǒ.','Cảm ơn bạn, bạn thật quan tâm tôi.',5);
// Reading L4
r($conn,$L4,'Nguoi ban tot','我最好的朋友叫小丽。她总是笑着跟人说话，声音很好听。每次我去她家，她都会准备茶和点心。我们一边喝茶一边聊天，非常开心。她性格很开朗，大家都喜欢和她做朋友。有一次我们走着走着就下雨了，她笑着拉着我跑到咖啡馆。最后我们坐在窗边，一边喝咖啡一边看雨。','Wǒ zuì hǎo de péngyou jiào Xiǎo Lì. Tā zǒngshì xiào zhe gēn rén shuōhuà, shēngyīn hěn hǎotīng. Měi cì wǒ qù tā jiā, tā dōu huì zhǔnbèi chá hé diǎnxīn. Wǒmen yìbiān hē chá yìbiān liáotiān, fēicháng kāixīn. Tā xìnggé hěn kāilǎng, dàjiā dōu xǐhuan hé tā zuò péngyou. Yǒu yí cì wǒmen zǒu zhe zǒu zhe jiù xiàyǔ le, tā xiào zhe lā zhe wǒ pǎo dào kāfēi guǎn. Zuìhòu wǒmen zuò zài chuāng biān, yìbiān hē kāfēi yìbiān kàn yǔ.','Người bạn tốt nhất của tôi tên là Tiểu Lệ. Cô ấy luôn cười nói chuyện với mọi người, giọng rất dễ nghe. Mỗi lần tôi đến nhà cô ấy, cô ấy đều chuẩn bị trà và bánh. Chúng tôi vừa uống trà vừa trò chuyện, rất vui. Tính cô ấy rất hòa đồng, ai cũng thích kết bạn với cô ấy. Một lần chúng tôi đang đi thì mưa bất chợt, cô ấy cười kéo tôi chạy vào quán cà phê. Cuối cùng chúng tôi ngồi bên cửa sổ, vừa uống cà phê vừa ngắm mưa.','easy',110,1);
// Listening L4
$L4l=l($conn,$L4,'Tinh ban','A:小王是个什么样的人？B:她总是笑眯眯的，对客人很有礼貌。A:她喜欢一边工作一边做什么？B:她喜欢一边工作一边听音乐。A:你觉得她怎么样？B:她是一个很可爱的人。','A:Xiǎo Wáng shì ge shénme yàng de rén? B:Tā zǒngshì xiào mīmī de, duì kèrén hěn yǒu lǐmào. A:Tā xǐhuan yìbiān gōngzuò yìbiān zuò shénme? B:Tā xǐhuan yìbiān gōngzuò yìbiān tīng yīnyuè. A:Nǐ juéde tā zěnme yàng? B:Tā shì yí ge hěn kěài de rén.','A:Tiểu Vương là người thế nào? B:Cô ấy luôn cười tươi, rất lịch sự với khách. A:Cô ấy thích vừa làm việc vừa làm gì? B:Cô ấy thích vừa làm việc vừa nghe nhạc. A:Bạn thấy cô ấy thế nào? B:Cô ấy là một người rất đáng yêu.','1');
lq($conn,$L4l,'Tiểu Vương là người thế nào?','{"A":"Hay cáu","B":"Luôn cười","C":"Im lặng"}','Luôn cười','Cô ấy luôn cười tươi.','multiple_choice',1);
lq($conn,$L4l,'Cô ấy thích vừa làm việc vừa làm gì?','{"A":"Nghe nhạc","B":"Nói chuyện","C":"Ăn"}','Nghe nhạc','Vừa làm việc vừa nghe nhạc.','multiple_choice',2);
// Exercises L4
$E4_1=e($conn,$L4,'Chọn đáp án','"Vừa...vừa..." trong tiếng Trung là:','multiple_choice','easy',1,'A',1);
eo($conn,$E4_1,'一边...一边...','A',1,1); eo($conn,$E4_1,'有的...有的...','B',0,2); eo($conn,$E4_1,'越来越...','C',0,3);
$E4_2=e($conn,$L4,'Dịch','"Cô ấy vừa ăn cơm vừa xem TV."','translation','easy',1,'她一边吃饭一边看电视。',2);
$E4_3=e($conn,$L4,'Điền từ','她___笑着跟客人说话。(luôn)','fill_blank','easy',1,'总是',3);
$E4_4=e($conn,$L4,'Sắp xếp câu','一边 / 她 / 听音乐 / 一边 / 跑步','sentence_order','easy',1,'她一边跑步一边听音乐。',4);
$E4_5=e($conn,$L4,'Chọn đúng/sai','"总是" chỉ hành động thỉnh thoảng xảy ra.','true_false','easy',1,'false',5);
eo($conn,$E4_5,'Đúng','A',0,1); eo($conn,$E4_5,'Sai','B',1,2);
$E4_6=e($conn,$L4,'Điền từ','她___着跟我说话。(cười)','fill_blank','easy',1,'笑',6);
$E4_7=e($conn,$L4,'Chọn đáp án','"说着说着..." diễn tả:','multiple_choice','easy',1,'C',7);
eo($conn,$E4_7,'Hành động đã xong','A',0,1); eo($conn,$E4_7,'Hành động sắp xảy ra','B',0,2); eo($conn,$E4_7,'Đang nói thì xảy ra chuyện','C',1,3);
// Review L4
foreach ([$v4_1,$v4_2,$v4_3,$v4_4,$v4_5,$v4_6,$v4_7,$v4_8,$v4_9] as $i=>$vid) if ($vid) rv($conn,$L4,$vid,'core',$i+1);
echo " HSK3 L4 done: $v4 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L5: 我最近越来越胖了
// ═══════════════════════════════════════════════════
$L5=createLesson($conn,3,5,'Bài 5: Wo zui jin yue lai yue pang le - Gần đây tôi càng ngày càng béo','So sánh tăng tiến, sức khỏe, vận động, giảm cân.','["So sanh tang tien","Suc khoe","Van dong"]','Suc khoe','easy','HSK3 Bài 5: Cấu trúc 越来越 + Adj (càng ngày càng...). Bổ ngữ 得 + V/A (thế nào). Từ vựng: pàng (béo), shòu (gầy), yùndòng (vận động), jiǎnféi (giảm cân), tǐzhòng (cân nặng), jiànkāng (sức khỏe).');
$v5=0;
$v5_1=v($conn,$L5,3,'最近','zuìjìn','gần đây','gần đây','你最近怎么样？','Nǐ zuìjìn zěnme yàng?','Gần đây bạn thế nào?','noun','Thời gian gần đây.',++$v5);
$v5_2=v($conn,$L5,3,'越来越','yuè lái yuè','càng ngày càng','càng ngày càng','天气越来越热了。','Tiānqì yuè lái yuè rè le.','Thời tiết càng ngày càng nóng.','adv','Cấu trúc so sánh tăng tiến.',++$v5);
$v5_3=v($conn,$L5,3,'胖','pàng','béo, mập','béo','我胖了三公斤。','Wǒ pàng le sān gōngjīn.','Tôi béo lên 3kg.','adj','Trái nghĩa với 瘦.',++$v5);
$v5_4=v($conn,$L5,3,'瘦','shòu','gầy, ốm','gầy','他比以前瘦了。','Tā bǐ yǐqián shòu le.','Anh ấy gầy hơn trước.','adj','Trái nghĩa với 胖.',++$v5);
$v5_5=v($conn,$L5,3,'运动','yùndòng','vận động, thể thao','vận động','每天运动对身体好。','Měitiān yùndòng duì shēntǐ hǎo.','Mỗi ngày vận động tốt cho sức khỏe.','verb/noun','Hoạt động thể chất.',++$v5);
$v5_6=v($conn,$L5,3,'减肥','jiǎnféi','giảm cân','giảm cân','我正在减肥。','Wǒ zhèngzài jiǎnféi.','Tôi đang giảm cân.','verb','Động từ phân ly.',++$v5);
$v5_7=v($conn,$L5,3,'健康','jiànkāng','khỏe mạnh, sức khỏe','sức khỏe','健康最重要。','Jiànkāng zuì zhòngyào.','Sức khỏe quan trọng nhất.','adj/noun','Tình trạng cơ thể.',++$v5);
$v5_8=v($conn,$L5,3,'担心','dānxīn','lo lắng','lo','别担心，会好的。','Bié dānxīn, huì hǎo de.','Đừng lo, sẽ ổn thôi.','verb','Động từ tâm lý.',++$v5);
$v5_9=v($conn,$L5,3,'体重','tǐzhòng','cân nặng, trọng lượng cơ thể','cân nặng','我的体重增加了。','Wǒ de tǐzhòng zēngjiā le.','Cân nặng của tôi tăng lên.','noun','Chỉ số cơ thể.',++$v5);
// Grammar L5
$g5_1=g($conn,$L5,'Cấu trúc 越来越 + Adj/Động từ tâm lý','越来越 + Tính từ/Động từ tâm lý','Càng ngày càng...','越来越 diễn tả mức độ thay đổi theo thời gian, tăng dần. Không cần từ so sánh khác. Thường có 了 ở cuối câu.','越来越 + 胖 (béo dần). 越来越 + 喜欢 (càng ngày càng thích).',1);
ge($conn,$g5_1,'我最近越来越胖了。','Wǒ zuìjìn yuè lái yuè pàng le.','Gần đây tôi càng ngày càng béo.',1);
ge($conn,$g5_1,'汉语越来越难了。','Hànyǔ yuè lái yuè nán le.','Tiếng Trung càng ngày càng khó.',2);
$g5_2=g($conn,$L5,'Bổ ngữ: V + 得 + Tính từ','Động từ + 得 + Tính từ','Làm gì đó thế nào','Bổ ngữ 得 diễn tả mức độ hoặc kết quả của hành động. Tính từ sau 得 miêu tả hành động đó được thực hiện như thế nào.','跑得快 (chạy nhanh). 吃得太多了 (ăn nhiều quá).',2);
ge($conn,$g5_2,'他跑得很快。','Tā pǎo de hěn kuài.','Anh ấy chạy rất nhanh.',1);
ge($conn,$g5_2,'你汉语说得越来越好。','Nǐ Hànyǔ shuō de yuè lái yuè hǎo.','Tiếng Trung bạn nói càng ngày càng tốt.',2);
$g5_3=g($conn,$L5,'Phân biệt tính từ 胖 và 瘦','Chủ ngữ + 胖/瘦 + 了 (+ Số + Lượng từ)','Béo / gầy (miêu tả thay đổi)','胖 và 瘦 là hai tính từ trái nghĩa. Thêm 了 để chỉ sự thay đổi. Có thể thêm số + lượng từ chỉ mức độ.','胖 (mập) không dùng để khen ở Trung Quốc.',3);
ge($conn,$g5_3,'她比以前瘦了很多。','Tā bǐ yǐqián shòu le hěn duō.','Cô ấy gầy hơn trước rất nhiều.',1);
ge($conn,$g5_3,'我胖了五斤了。','Wǒ pàng le wǔ jīn le.','Tôi béo lên 5 cân rồi.',2);
// Dialogues L5
$d5_1=d($conn,$L5,'Lo beo','Nói về việc tăng cân.',1);
ds($conn,$d5_1,'Anna','我最近越来越胖了，真担心。','Wǒ zuìjìn yuè lái yuè pàng le, zhēn dānxīn.','Gần đây tôi càng ngày càng béo, thật lo.',1);
ds($conn,$d5_1,'Xiao Ming','你看起来不胖啊。你经常运动吗？','Nǐ kàn qǐlai bú pàng a. Nǐ jīngcháng yùndòng ma?','Bạn trông không béo mà. Bạn có thường xuyên vận động không?',2);
ds($conn,$d5_1,'Anna','最近工作太忙，没时间运动。','Zuìjìn gōngzuò tài máng, méi shíjiān yùndòng.','Gần đây công việc bận quá, không có thời gian vận động.',3);
ds($conn,$d5_1,'Xiao Ming','那我们一起运动吧，每天早上跑跑步。','Nà wǒmen yīqǐ yùndòng ba, měitiān zǎoshang pǎopao bù.','Vậy chúng ta cùng vận động nhé, mỗi sáng chạy bộ.',4);
$d5_2=d($conn,$L5,'Giam can','Nói về kế hoạch giảm cân.',2);
ds($conn,$d5_2,'Xiao Ming','我打算减肥，最近胖了三公斤。','Wǒ dǎsuàn jiǎnféi, zuìjìn pàng le sān gōngjīn.','Tôi định giảm cân, gần đây béo lên 3kg.',1);
ds($conn,$d5_2,'Anna','你要少吃多运动。少喝可乐，多吃水果。','Nǐ yào shǎo chī duō yùndòng. Shǎo hē kělè, duō chī shuǐguǒ.','Bạn phải ăn ít vận động nhiều. Uống ít cola, ăn nhiều hoa quả.',2);
ds($conn,$d5_2,'Xiao Ming','你说得对，健康最重要。','Nǐ shuō de duì, jiànkāng zuì zhòngyào.','Bạn nói đúng, sức khỏe quan trọng nhất.',3);
ds($conn,$d5_2,'Anna','对啊，越来越健康才是好的。','Duì a, yuè lái yuè jiànkāng cái shì hǎo de.','Đúng, càng ngày càng khỏe mới là tốt.',4);
// Reading L5
r($conn,$L5,'Giam can va suc khoe','最近我发现自己越来越胖了，体重增加了五斤。我有点担心健康问题，所以决定开始运动。每天早上我跑半个小时，晚上少吃米饭。朋友说我应该多吃水果和蔬菜。刚开始觉得很累，但是跑了一个星期以后，我觉得身体越来越舒服了。我希望能越来越健康。','Zuìjìn wǒ fāxiàn zìjǐ yuè lái yuè pàng le, tǐzhòng zēngjiā le wǔ jīn. Wǒ yǒudiǎn dānxīn jiànkāng wèntí, suǒyǐ juédìng kāishǐ yùndòng. Měitiān zǎoshang wǒ pǎo bàn ge xiǎoshí, wǎnshang shǎo chī mǐfàn. Péngyou shuō wǒ yīnggāi duō chī shuǐguǒ hé shūcài. Gāng kāishǐ juéde hěn lèi, dànshì pǎo le yí ge xīngqī yǐhòu, wǒ juéde shēntǐ yuè lái yuè shūfu le. Wǒ xīwàng néng yuè lái yuè jiànkāng.','Gần đây tôi phát hiện mình càng ngày càng béo, cân nặng tăng 5 cân. Tôi hơi lo về vấn đề sức khỏe nên quyết định bắt đầu vận động. Mỗi sáng chạy nửa tiếng, tối ăn ít cơm. Bạn bè nói tôi nên ăn nhiều hoa quả và rau. Ban đầu thấy rất mệt, nhưng chạy được một tuần sau, tôi thấy cơ thể càng ngày càng thoải mái. Tôi hy vọng càng ngày càng khỏe mạnh.','easy',105,1);
// Listening L5
$L5l=l($conn,$L5,'Giam can','A:你最近好像瘦了很多。B:是吗？我一直在减肥。A:你怎么减的？B:少吃多运动。我每天晚上跑步，跑得越来越快了。A:效果怎么样？B:减了三公斤，越来越有自信了。','A:Nǐ zuìjìn hǎoxiàng shòu le hěn duō. B:Shì ma? Wǒ yìzhí zài jiǎnféi. A:Nǐ zěnme jiǎn de? B:Shǎo chī duō yùndòng. Wǒ měitiān wǎnshang pǎobù, pǎo de yuè lái yuè kuài le. A:Xiàoguǒ zěnme yàng? B:Jiǎn le sān gōngjīn, yuè lái yuè yǒu zìxìn le.','A:Gần đây bạn hình như gầy đi nhiều. B:Thế à? Tôi vẫn đang giảm cân. A:Bạn giảm thế nào? B:Ăn ít vận động nhiều. Tôi mỗi tối chạy bộ, chạy càng ngày càng nhanh. A:Hiệu quả thế nào? B:Giảm được 3kg, càng ngày càng tự tin.','1');
lq($conn,$L5l,'Người B đã giảm được bao nhiêu kg?','{"A":"1kg","B":"3kg","C":"5kg"}','3kg','Giảm được 3kg.','multiple_choice',1);
lq($conn,$L5l,'Người B giảm cân bằng cách nào?','{"A":"Uống thuốc","B":"Nhịn ăn","C":"Ăn ít và vận động nhiều"}','Ăn ít và vận động nhiều','Ăn ít vận động nhiều.','multiple_choice',2);
// Exercises L5
$E5_1=e($conn,$L5,'Chọn đáp án','"越来越" có nghĩa là:','multiple_choice','easy',1,'B',1);
eo($conn,$E5_1,'Không thay đổi','A',0,1); eo($conn,$E5_1,'Càng ngày càng','B',1,2); eo($conn,$E5_1,'Giảm dần','C',0,3);
$E5_2=e($conn,$L5,'Dịch','"Cô ấy càng ngày càng gầy."','translation','easy',1,'她越来越瘦了。',2);
$E5_3=e($conn,$L5,'Điền từ','天气___越来越热了。(càng ngày càng)','fill_blank','easy',1,'变得越来越',3);
$E5_4=e($conn,$L5,'Sắp xếp câu','越来越 / 汉语 / 难 / 了','sentence_order','easy',1,'汉语越来越难了。',4);
$E5_5=e($conn,$L5,'Chọn đúng/sai','"胖" có nghĩa là "gầy".','true_false','easy',1,'false',5);
eo($conn,$E5_5,'Đúng','A',0,1); eo($conn,$E5_5,'Sai','B',1,2);
$E5_6=e($conn,$L5,'Điền từ','你汉语说得越来越___。(tốt)','fill_blank','easy',1,'好',6);
$E5_7=e($conn,$L5,'Chọn đáp án','"我得非常好" có đúng ngữ pháp không?','multiple_choice','easy',1,'C',7);
eo($conn,$E5_7,'Đúng','A',0,1); eo($conn,$E5_7,'Sai, phải là "我非常好"','B',0,2); eo($conn,$E5_7,'Sai, phải là "我做得非常好"','C',1,3);
$E5_8=e($conn,$L5,'Điền từ','健康最___要。(quan trọng)','fill_blank','easy',1,'重',8);
// Review L5
foreach ([$v5_1,$v5_2,$v5_3,$v5_4,$v5_5,$v5_6,$v5_7,$v5_8,$v5_9] as $i=>$vid) if ($vid) rv($conn,$L5,$vid,'core',$i+1);
echo " HSK3 L5 done: $v5 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 8 exercises\n";

$conn->exec("SET FOREIGN_KEY_CHECKS=1");
echo "\n HSK3 Lessons 1-5 seeding complete!\n";
