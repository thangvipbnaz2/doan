<?php
/**
 * HÀNNGỮ - HSK2 Content Seeder (Lessons 6-10)
 * HSK Standard Course 2: 300+ words, more complex grammar, 2-3 dialogues/lesson
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK2 L6: 你怎么不吃了
// ═══════════════════════════════════════════════════
$L6=createLesson($conn,2,6,'Bài 6: Ni zen me bu chi le - Sao bạn không ăn nữa?','Ăn uống, sức khỏe. Phó từ 再 (lại). Cấu trúc 太 + adj + 了.','["An uong","Suc khoe","Lai tiep tuc"]','An uong','easy','HSK2 Bài 6: Ăn uống và sức khỏe. Phó từ 再 (lại, nữa) + động từ. Cấu trúc 太 + tính từ + 了 (quá rồi). 有点儿 + tính từ (hơi). Từ vựng về ăn uống: 吃, 喝, 饱, 饿, 好吃, 味道.');
$v6=0;
$v6_1=v($conn,$L6,2,'再','zài','lại, nữa, tiếp tục','lại','再吃一点儿。','Zài chī yìdiǎnr.','Ăn thêm một chút.','adv','Phó từ chỉ sự lặp lại.',++$v6);
$v6_2=v($conn,$L6,2,'吃','chī','ăn','ăn','吃饭。','Chīfàn.','Ăn cơm.','verb','Động từ ăn.',++$v6);
$v6_3=v($conn,$L6,2,'喝','hē','uống','uống','喝水。','Hē shuǐ.','Uống nước.','verb','Động từ uống.',++$v6);
$v6_4=v($conn,$L6,2,'饱','bǎo','no','no','吃饱了。','Chībǎo le.','Ăn no rồi.','adj','Trạng thái no.',++$v6);
$v6_5=v($conn,$L6,2,'饿','è','đói','đói','我饿了。','Wǒ è le.','Tôi đói rồi.','adj','Trạng thái đói.',++$v6);
$v6_6=v($conn,$L6,2,'好吃','hǎochī','ngon','ngon','这个菜很好吃。','Zhè ge cài hěn hǎochī.','Món này rất ngon.','adj','Mô tả đồ ăn ngon.',++$v6);
$v6_7=v($conn,$L6,2,'味道','wèidào','mùi vị','mùi vị','味道很好。','Wèidào hěn hǎo.','Mùi vị rất ngon.','noun','Mùi vị đồ ăn.',++$v6);
$v6_8=v($conn,$L6,2,'菜','cài','món ăn, rau','món ăn','点菜。','Diǎn cài.','Gọi món.','noun','Món ăn, thức ăn.',++$v6);
$v6_9=v($conn,$L6,2,'饭','fàn','cơm','cơm','吃饭。','Chīfàn.','Ăn cơm.','noun','Cơm, bữa ăn.',++$v6);
// Grammar L6
$g6_1=g($conn,$L6,'Phó từ 再 (lại)','再 + Động từ','Lại, tiếp tục làm gì','再 diễn tả hành động lặp lại hoặc tiếp diễn. Đặt trước động từ. Có thể dùng với 吧 để đề xuất.','再吃 = ăn thêm. 再来 = đến lại. 再说 = nói thêm.','Lặp lại hành động.',1);
ge($conn,$g6_1,'再吃一点儿吧。','Zài chī yìdiǎnr ba.','Ăn thêm một chút đi.',1);
ge($conn,$g6_1,'明天再来。','Míngtiān zài lái.','Ngày mai đến lại.',2);
$g6_2=g($conn,$L6,'Cấu trúc 太...了','太 + Tính từ + 了','Quá...rồi','太...了 diễn tả mức độ vượt quá tiêu chuẩn. Mang sắc thái cảm thán. Có thể dùng khen hoặc chê.','太好了 = tuyệt quá. 太多了 = nhiều quá. 太贵了 = đắt quá.','Nhấn mạnh mức độ.',2);
ge($conn,$g6_2,'太好了！','Tài hǎo le!','Tuyệt quá!',1);
ge($conn,$g6_2,'这个菜太辣了。','Zhè ge cài tài là le.','Món này cay quá.',2);
$g6_3=g($conn,$L6,'有点儿 + Tính từ','有点儿 + Adj','Hơi...một chút','有点儿 đứng trước tính từ để diễn tả mức độ nhẹ, thường dùng với nghĩa không tích cực.','有点儿辣 = hơi cay. 有点儿贵 = hơi đắt. 有点儿累 = hơi mệt.','Mức độ nhẹ.',3);
ge($conn,$g6_3,'我有点儿饿。','Wǒ yǒudiǎnr è.','Tôi hơi đói.',1);
ge($conn,$g6_3,'这个菜有点儿咸。','Zhè ge cài yǒudiǎnr xián.','Món này hơi mặn.',2);
// Dialogues L6
$d6_1=d($conn,$L6,'Sao khong an nua?','Tại sao không ăn nữa.',1);
ds($conn,$d6_1,'Xiao Ming','你怎么不吃了？','Nǐ zěnme bù chī le?','Sao bạn không ăn nữa?',1);
ds($conn,$d6_1,'Anna','我吃饱了。','Wǒ chībǎo le.','Tôi no rồi.',2);
ds($conn,$d6_1,'Xiao Ming','再吃一点儿吧，这个菜很好吃。','Zài chī yìdiǎnr ba, zhè ge cài hěn hǎochī.','Ăn thêm một chút đi, món này ngon lắm.',3);
ds($conn,$d6_1,'Anna','好吧，我再吃一点儿。','Hǎo ba, wǒ zài chī yìdiǎnr.','Thôi được, tôi ăn thêm một chút.',4);
ds($conn,$d6_1,'Xiao Ming','味道怎么样？','Wèidào zěnme yàng?','Mùi vị thế nào?',5);
ds($conn,$d6_1,'Anna','很好吃，但是有点儿辣。','Hěn hǎochī, dànshì yǒudiǎnr là.','Rất ngon, nhưng hơi cay.',6);
$d6_2=d($conn,$L6,'Di an com','Rủ nhau đi ăn.',2);
ds($conn,$d6_2,'Anna','你饿了吗？我们去吃饭吧。','Nǐ è le ma? Wǒmen qù chīfàn ba.','Bạn đói chưa? Chúng ta đi ăn cơm đi.',1);
ds($conn,$d6_2,'Xiao Ming','好，去哪儿吃？','Hǎo, qù nǎr chī?','Được, đi đâu ăn?',2);
ds($conn,$d6_2,'Anna','去那家餐厅吧，味道很好。','Qù nà jiā cāntīng ba, wèidào hěn hǎo.','Đến nhà hàng đó đi, mùi vị rất ngon.',3);
ds($conn,$d6_2,'Xiao Ming','我觉得有点儿贵。','Wǒ juéde yǒudiǎnr guì.','Tôi thấy hơi đắt.',4);
ds($conn,$d6_2,'Anna','没关系，今天我请你。','Méi guānxi, jīntiān wǒ qǐng nǐ.','Không sao, hôm nay tôi mời bạn.',5);
// Reading L6
r($conn,$L6,'An com cung ban','今天中午我和朋友一起去吃饭。朋友问我吃什么，我说想吃中国菜。我们点了一个鱼和一碗米饭。鱼的味道很好，但是有点儿辣。朋友说太辣了，只吃了一点点。我吃得很多，因为我很饿。最后我吃饱了，朋友还没饱。他说再点一个菜吧。我们又点了一个汤。今天吃得很开心。','Jīntiān zhōngwǔ wǒ hé péngyou yīqǐ qù chīfàn. Péngyou wèn wǒ chī shénme, wǒ shuō xiǎng chī Zhōngguó cài. Wǒmen diǎn le yí ge yú hé yì wǎn mǐfàn. Yú de wèidào hěn hǎo, dànshì yǒudiǎnr là. Péngyou shuō tài là le, zhǐ chī le yì diǎndiǎn. Wǒ chī de hěn duō, yīnwèi wǒ hěn è. Zuìhòu wǒ chībǎo le, péngyou hái méi bǎo. Tā shuō zài diǎn yí ge cài ba. Wǒmen yòu diǎn le yí ge tāng. Jīntiān chī de hěn kāixīn.','Hôm nay trưa tôi và bạn cùng đi ăn. Bạn hỏi tôi ăn gì, tôi nói muốn ăn đồ Trung Quốc. Chúng tôi gọi một con cá và một bát cơm. Cá rất ngon nhưng hơi cay. Bạn nói cay quá, chỉ ăn một chút. Tôi ăn nhiều vì tôi rất đói. Cuối cùng tôi no rồi, bạn vẫn chưa no. Bạn ấy nói gọi thêm một món nữa. Chúng tôi lại gọi một tô canh. Hôm nay ăn rất vui.','easy',88,1);
// Listening L6
$L6l=l($conn,$L6,'An com','A:你吃饱了吗？B:吃饱了。你呢？A:我再吃一点儿，这个菜真好吃。B:好吃就多吃点儿。A:再喝一碗汤吧。B:好，谢谢。','A:Nǐ chībǎo le ma? B:Chībǎo le. Nǐ ne? A:Wǒ zài chī yìdiǎnr, zhè ge cài zhēn hǎochī. B:Hǎochī jiù duō chī diǎnr. A:Zài hē yì wǎn tāng ba. B:Hǎo, xièxie.','A:Bạn no chưa? B:No rồi. Còn bạn? A:Tôi ăn thêm một chút, món này ngon thật. B:Ngon thì ăn thêm đi. A:Uống thêm một bát canh nhé. B:Được, cảm ơn.','1');
lq($conn,$L6l,'Ai đã no rồi?','{"A":"Người A","B":"Người B","C":"Cả hai"}','Người B','Người B no rồi.','multiple_choice',1);
lq($conn,$L6l,'Món ăn thế nào?','{"A":"Không ngon","B":"Hơi ngọt","C":"Rất ngon"}','Rất ngon','Món ăn rất ngon.','multiple_choice',2);
// Exercises L6
$E6_1=e($conn,$L6,'Chọn đáp án','"再" có nghĩa là:','multiple_choice','easy',1,'A',1);
eo($conn,$E6_1,'Lại, nữa','A',1,1); eo($conn,$E6_1,'Đã','B',0,2); eo($conn,$E6_1,'Sẽ','C',0,3);
$E6_2=e($conn,$L6,'Dịch','"Tôi no rồi."','translation','easy',1,'我吃饱了。',2);
$E6_3=e($conn,$L6,'Điền từ','这个菜很___。(ngon)','fill_blank','easy',1,'好吃',3);
$E6_4=e($conn,$L6,'Sắp xếp câu','再 / 吃 / 一点儿 / 吧','sentence_order','easy',1,'再吃一点儿吧。',4);
$E6_5=e($conn,$L6,'Chọn đúng/sai','"饿" có nghĩa là "no".','true_false','easy',1,'false',5);
eo($conn,$E6_5,'Đúng','A',0,1); eo($conn,$E6_5,'Sai','B',1,2);
$E6_6=e($conn,$L6,'Điền từ','我___了，不能再吃了。(no)','fill_blank','easy',1,'饱',6);
$E6_7=e($conn,$L6,'Chọn đáp án','"太辣了" có nghĩa là:','multiple_choice','easy',1,'C',7);
eo($conn,$E6_7,'Hơi cay','A',0,1); eo($conn,$E6_7,'Không cay','B',0,2); eo($conn,$E6_7,'Cay quá','C',1,3);
// Review L6
foreach ([$v6_1,$v6_2,$v6_3,$v6_4,$v6_5,$v6_6,$v6_7,$v6_8,$v6_9] as $i=>$vid) if ($vid) rv($conn,$L6,$vid,'core',$i+1);
echo " HSK2 L6 done: $v6 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L7: 你家离学校远不远
// ═══════════════════════════════════════════════════
$L7=createLesson($conn,2,7,'Bài 7: Ni jia li xue xiao yuan bu yuan - Nhà bạn cách trường xa không?','Khoảng cách. Giới từ 离...远/近. Phương tiện đi lại.','["Khoang cach","Phuong tien","Gioi tu li"]','Khoang cach','easy','HSK2 Bài 7: Khoảng cách và phương tiện. Giới từ 离 (cách) + danh từ + 远/近. Hỏi khoảng cách: 远不远 / 要多长时间. 还是 (vẫn, hoặc). Từ vựng: 走路, 坐车, 地铁, 分钟, 公里.');
$v7=0;
$v7_1=v($conn,$L7,2,'离','lí','cách (khoảng cách)','cách','我家离学校很远。','Wǒ jiā lí xuéxiào hěn yuǎn.','Nhà tôi cách trường rất xa.','prep','Giới từ chỉ khoảng cách.',++$v7);
$v7_2=v($conn,$L7,2,'远','yuǎn','xa','xa','学校很远。','Xuéxiào hěn yuǎn.','Trường rất xa.','adj','Khoảng cách xa.',++$v7);
$v7_3=v($conn,$L7,2,'近','jìn','gần','gần','地铁站很近。','Dìtiě zhàn hěn jìn.','Ga tàu điện rất gần.','adj','Khoảng cách gần.',++$v7);
$v7_4=v($conn,$L7,2,'走路','zǒulù','đi bộ','đi bộ','走路去学校。','Zǒulù qù xuéxiào.','Đi bộ đến trường.','verb','Đi bằng chân.',++$v7);
$v7_5=v($conn,$L7,2,'坐车','zuòchē','đi xe','đi xe','坐车去。','Zuòchē qù.','Đi xe đến.','verb','Đi bằng phương tiện.',++$v7);
$v7_6=v($conn,$L7,2,'地铁','dìtiě','tàu điện ngầm','tàu điện','坐地铁。','Zuò dìtiě.','Đi tàu điện ngầm.','noun','Phương tiện ngầm.',++$v7);
$v7_7=v($conn,$L7,2,'分钟','fēnzhōng','phút','phút','三十分钟。','Sānshí fēnzhōng.','30 phút.','noun','Đơn vị thời gian.',++$v7);
$v7_8=v($conn,$L7,2,'公里','gōnglǐ','cây số, km','km','十公里。','Shí gōnglǐ.','10 km.','measure','Đơn vị đo khoảng cách.',++$v7);
$v7_9=v($conn,$L7,2,'还是','háishì','vẫn, hay là','vẫn','你走路还是坐车？','Nǐ zǒulù háishì zuòchē?','Bạn đi bộ hay đi xe?','adv/conj','Lựa chọn hoặc nhấn mạnh.',++$v7);
// Grammar L7
$g7_1=g($conn,$L7,'Giới từ 离','离 + Danh từ + 远/近','Cách...xa/gần','离 chỉ khoảng cách giữa hai địa điểm. Sau 离 là danh từ chỉ địa điểm. Tính từ 远/近 đứng sau để chỉ mức độ xa/gần.','离 + N1 + 很远/很近. Câu hỏi: 离...远不远？','Khoảng cách không gian.',1);
ge($conn,$g7_1,'我家离学校很远。','Wǒ jiā lí xuéxiào hěn yuǎn.','Nhà tôi cách trường rất xa.',1);
ge($conn,$g7_1,'地铁站离这儿近不近？','Dìtiě zhàn lí zhèr jìn bù jìn?','Ga tàu điện cách đây gần không?',2);
$g7_2=g($conn,$L7,'Hỏi về thời gian di chuyển','从 + Nơi + 到 + Nơi + 要 + Thời gian','Từ...đến...mất bao lâu','Cấu trúc hỏi và trả lời về thời gian di chuyển. 要 (cần) + thời gian. Có thể thay bằng 多长时间 (bao lâu).','从家到公司要30分钟. Câu hỏi: 要多长时间？','Thời gian di chuyển.',2);
ge($conn,$g7_2,'从家到公司要半个小时。','Cóng jiā dào gōngsī yào bàn ge xiǎoshí.','Từ nhà đến công ty mất nửa tiếng.',1);
ge($conn,$g7_2,'走路要多久？','Zǒulù yào duōjiǔ?','Đi bộ mất bao lâu?',2);
$g7_3=g($conn,$L7,'Liên từ 还是','A + 还是 + B ?','A hay B?','还是 dùng trong câu hỏi lựa chọn, đưa ra hai hoặc nhiều lựa chọn. Không dùng 吗 trong câu có 还是.','你喝茶还是咖啡？= Bạn uống trà hay cà phê?','Câu hỏi lựa chọn.',3);
ge($conn,$g7_3,'你走路还是坐车？','Nǐ zǒulù háishì zuòchē?','Bạn đi bộ hay đi xe?',1);
ge($conn,$g7_3,'今天去还是明天去？','Jīntiān qù háishì míngtiān qù?','Hôm nay đi hay mai đi?',2);
// Dialogues L7
$d7_1=d($conn,$L7,'Nha cach truong bao xa','Hỏi về khoảng cách.',1);
ds($conn,$d7_1,'Anna','你家离学校远不远？','Nǐ jiā lí xuéxiào yuǎn bù yuǎn?','Nhà bạn cách trường xa không?',1);
ds($conn,$d7_1,'Xiao Ming','有点儿远，坐地铁要三十分钟。','Yǒudiǎnr yuǎn, zuò dìtiě yào sānshí fēnzhōng.','Hơi xa, đi tàu điện mất 30 phút.',2);
ds($conn,$d7_1,'Anna','走路要多久？','Zǒulù yào duōjiǔ?','Đi bộ mất bao lâu?',3);
ds($conn,$d7_1,'Xiao Ming','走路要一个小时，太远了。','Zǒulù yào yí ge xiǎoshí, tài yuǎn le.','Đi bộ mất 1 tiếng, xa quá.',4);
ds($conn,$d7_1,'Anna','那你还是坐地铁吧。','Nà nǐ háishì zuò dìtiě ba.','Vậy bạn vẫn nên đi tàu điện.',5);
$d7_2=d($conn,$L7,'Cach di lam','Hỏi về phương tiện đi làm.',2);
ds($conn,$d7_2,'Xiao Ming','你每天怎么上班？','Nǐ měitiān zěnme shàngbān?','Mỗi ngày bạn đi làm thế nào?',1);
ds($conn,$d7_2,'Anna','我坐地铁，从家到公司要二十分钟。','Wǒ zuò dìtiě, cóng jiā dào gōngsī yào èrshí fēnzhōng.','Tôi đi tàu điện, từ nhà đến công ty mất 20 phút.',2);
ds($conn,$d7_2,'Xiao Ming','真近啊！我家离公司十公里，开车要四十分钟。','Zhēn jìn a! Wǒ jiā lí gōngsī shí gōnglǐ, kāichē yào sìshí fēnzhōng.','Gần thật! Nhà tôi cách công ty 10 km, lái xe mất 40 phút.',3);
ds($conn,$d7_2,'Anna','那你早上几点起床？','Nà nǐ zǎoshang jǐ diǎn qǐchuáng?','Vậy sáng bạn mấy giờ dậy?',4);
ds($conn,$d7_2,'Xiao Ming','七点就得起床。','Qī diǎn jiù děi qǐchuáng.','7 giờ đã phải dậy.',5);
// Reading L7
r($conn,$L7,'Khoang cach nha va truong','我家离学校很远，坐车要四十分钟。但是学校附近有地铁站，从家走到地铁站只要五分钟。坐地铁到学校附近的车站，再走路五分钟就到了。一共需要三十分钟左右。周末我去朋友家玩，他家离我家很近，走路十分钟就到了。我们常常一起走路去公园。','Wǒ jiā lí xuéxiào hěn yuǎn, zuòchē yào sìshí fēnzhōng. Dànshì xuéxiào fùjìn yǒu dìtiě zhàn, cóng jiā zǒu dào dìtiě zhàn zhǐ yào wǔ fēnzhōng. Zuò dìtiě dào xuéxiào fùjìn de chēzhàn, zài zǒulù wǔ fēnzhōng jiù dào le. Yígòng xūyào sānshí fēnzhōng zuǒyòu. Zhōumò wǒ qù péngyou jiā wán, tā jiā lí wǒ jiā hěn jìn, zǒulù shí fēnzhōng jiù dào le. Wǒmen chángcháng yīqǐ zǒulù qù gōngyuán.','Nhà tôi cách trường rất xa, đi xe mất 40 phút. Nhưng gần trường có ga tàu điện, từ nhà đi bộ đến ga chỉ mất 5 phút. Đi tàu đến ga gần trường, rồi đi bộ 5 phút là đến. Tổng cộng mất khoảng 30 phút. Cuối tuần tôi đến nhà bạn chơi, nhà bạn ấy cách nhà tôi rất gần, đi bộ 10 phút là đến. Chúng tôi thường cùng nhau đi bộ đến công viên.','easy',95,1);
// Listening L7
$L7l=l($conn,$L7,'Di lai','A:你家离公司远吗？B:不远，走路十五分钟就到了。A:真近！我坐地铁还要四十分钟呢。B:那你家离地铁站远不远？A:有点儿远，要走十分钟。B:那也不远。','A:Nǐ jiā lí gōngsī yuǎn ma? B:Bù yuǎn, zǒulù shíwǔ fēnzhōng jiù dào le. A:Zhēn jìn! Wǒ zuò dìtiě hái yào sìshí fēnzhōng ne. B:Nà nǐ jiā lí dìtiě zhàn yuǎn bù yuǎn? A:Yǒudiǎnr yuǎn, yào zǒu shí fēnzhōng. B:Nà yě bù yuǎn.','A:Nhà bạn cách công ty xa không? B:Không xa, đi bộ 15 phút là đến. A:Gần thật! Tôi đi tàu điện còn mất 40 phút. B:Vậy nhà bạn cách ga tàu xa không? A:Hơi xa, phải đi bộ 10 phút. B:Vậy cũng không xa.','1');
lq($conn,$L7l,'Người B đi làm mất bao lâu?','{"A":"15 phút","B":"30 phút","C":"40 phút"}','15 phút','Đi bộ 15 phút.','multiple_choice',1);
lq($conn,$L7l,'Nhà người A cách ga tàu thế nào?','{"A":"Rất gần","B":"Hơi xa","C":"Rất xa"}','Hơi xa','Phải đi bộ 10 phút.','multiple_choice',2);
// Exercises L7
$E7_1=e($conn,$L7,'Chọn đáp án','"离" có nghĩa là:','multiple_choice','easy',1,'B',1);
eo($conn,$E7_1,'Đến','A',0,1); eo($conn,$E7_1,'Cách','B',1,2); eo($conn,$E7_1,'Từ','C',0,3);
$E7_2=e($conn,$L7,'Dịch','"Nhà tôi cách trường rất xa."','translation','easy',1,'我家离学校很远。',2);
$E7_3=e($conn,$L7,'Điền từ','从家到公司要三十___。(phút)','fill_blank','easy',1,'分钟',3);
$E7_4=e($conn,$L7,'Sắp xếp câu','离 / 学校 / 你家 / 远不远','sentence_order','easy',1,'你家离学校远不远？',4);
$E7_5=e($conn,$L7,'Chọn đúng/sai','"还是" dùng trong câu hỏi lựa chọn.','true_false','easy',1,'true',5);
eo($conn,$E7_5,'Đúng','A',1,1); eo($conn,$E7_5,'Sai','B',0,2);
$E7_6=e($conn,$L7,'Điền từ','你走路___坐车？(hay)','fill_blank','easy',1,'还是',6);
$E7_7=e($conn,$L7,'Chọn đáp án','Hỏi "bao lâu" dùng từ nào?','multiple_choice','easy',1,'B',7);
eo($conn,$E7_7,'多远','A',0,1); eo($conn,$E7_7,'多久','B',1,2); eo($conn,$E7_7,'多长','C',0,3);
// Review L7
foreach ([$v7_1,$v7_2,$v7_3,$v7_4,$v7_5,$v7_6,$v7_7,$v7_8,$v7_9] as $i=>$vid) if ($vid) rv($conn,$L7,$vid,'core',$i+1);
echo " HSK2 L7 done: $v7 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L8: 让我想想再告诉你
// ═══════════════════════════════════════════════════
$L8=createLesson($conn,2,8,'Bài 8: Rang wo xiang xiang zai gao su ni - Để tôi nghĩ đã rồi nói cho bạn','Suy nghĩ và quyết định. 让 + sb + V. 再 (sau đó).','["Suy nghi","Quyet dinh","Cho phep"]','Tu duy','easy','HSK2 Bài 8: Suy nghĩ và quyết định. 让 + sb + V (để ai làm gì). 再 + V (sau đó, rồi). V + 一下 (một chút). Từ vựng: 告诉, 记, 忘, 记得, 以后, 等, 决定.');
$v8=0;
$v8_1=v($conn,$L8,2,'让','ràng','để, cho phép','để','让我想想。','Ràng wǒ xiǎngxiang.','Để tôi nghĩ một chút.','verb','Động từ sai khiến.',++$v8);
$v8_2=v($conn,$L8,2,'告诉','gàosu','nói cho, bảo','nói cho','告诉我。','Gàosu wǒ.','Nói cho tôi.','verb','Thông báo cho ai.',++$v8);
$v8_3=v($conn,$L8,2,'想','xiǎng','nghĩ, muốn','nghĩ','想一想。','Xiǎng yi xiǎng.','Suy nghĩ một chút.','verb','Suy nghĩ hoặc mong muốn.',++$v8);
$v8_4=v($conn,$L8,2,'记','jì','nhớ','nhớ','记住。','Jìzhù.','Nhớ kỹ.','verb','Ghi nhớ.',++$v8);
$v8_5=v($conn,$L8,2,'忘','wàng','quên','quên','别忘了。','Bié wàng le.','Đừng quên.','verb','Quên mất.',++$v8);
$v8_6=v($conn,$L8,2,'记得','jìde','nhớ được','nhớ được','我记得你。','Wǒ jìde nǐ.','Tôi nhớ bạn.','verb','Nhớ được việc gì.',++$v8);
$v8_7=v($conn,$L8,2,'以后','yǐhòu','sau này, sau đó','sau này','以后再说。','Yǐhòu zài shuō.','Sau này nói tiếp.','noun','Thời gian tương lai.',++$v8);
$v8_8=v($conn,$L8,2,'等','děng','đợi, chờ','đợi','等一下。','Děng yíxià.','Đợi một lát.','verb','Chờ đợi.',++$v8);
$v8_9=v($conn,$L8,2,'决定','juédìng','quyết định','quyết định','我决定了。','Wǒ juédìng le.','Tôi quyết định rồi.','verb','Đưa ra quyết định.',++$v8);
// Grammar L8
$g8_1=g($conn,$L8,'Động từ 让 (để, cho phép)','让 + Người + Động từ','Để ai làm gì','让 là động từ sai khiến, yêu cầu tân ngữ chỉ người và động từ phía sau. Mang nghĩa cho phép hoặc yêu cầu ai làm gì.','让我看看 = để tôi xem. 让他进来 = để anh ấy vào.','Cho phép / yêu cầu.',1);
ge($conn,$g8_1,'让我想想再告诉你。','Ràng wǒ xiǎngxiang zài gàosu nǐ.','Để tôi nghĩ đã rồi nói cho bạn.',1);
ge($conn,$g8_1,'让他进来吧。','Ràng tā jìnlái ba.','Để anh ấy vào đi.',2);
$g8_2=g($conn,$L8,'Động từ lặp V-V','Động từ + Động từ (VV)','Làm gì một chút','Lặp động từ diễn tả hành động ngắn, nhẹ nhàng. Thường dùng với 想 (想想), 看 (看看), 听 (听听), 试 (试试).','想想 = nghĩ một chút. 看看 = xem một chút.','Hành động ngắn.',2);
ge($conn,$g8_2,'让我想想。','Ràng wǒ xiǎngxiang.','Để tôi nghĩ một chút.',1);
ge($conn,$g8_2,'你看看这个，怎么样？','Nǐ kànkan zhè ge, zěnme yàng?','Bạn xem cái này thế nào?',2);
$g8_3=g($conn,$L8,'V + 一下 (một lát)','Động từ + 一下','Làm gì một lát','一下 sau động từ làm cho hành động trở nên ngắn gọn, nhẹ nhàng hơn. Giống động từ lặp nhưng mang sắc thái lịch sự hơn.','等一下 = đợi một lát. 看一下 = xem một chút.','Nhẹ nhàng, lịch sự.',3);
ge($conn,$g8_3,'你等一下，我马上来。','Nǐ děng yíxià, wǒ mǎshàng lái.','Bạn đợi một lát, tôi đến ngay.',1);
ge($conn,$g8_3,'让我看一下你的书。','Ràng wǒ kàn yíxià nǐ de shū.','Để tôi xem sách của bạn một chút.',2);
// Dialogues L8
$d8_1=d($conn,$L8,'Nho va quen','Hỏi về ký ức.',1);
ds($conn,$d8_1,'Anna','你记得她的名字吗？','Nǐ jìde tā de míngzi ma?','Bạn nhớ tên cô ấy không?',1);
ds($conn,$d8_1,'Xiao Ming','让我想想...对了，叫王丽。','Ràng wǒ xiǎngxiang... duì le, jiào Wáng Lì.','Để tôi nghĩ một chút... đúng rồi, tên là Vương Lệ.',2);
ds($conn,$d8_1,'Anna','你还没忘啊！','Nǐ hái méi wàng a!','Bạn vẫn chưa quên à!',3);
ds($conn,$d8_1,'Xiao Ming','当然记得，我不会忘的。','Dāngrán jìde, wǒ bú huì wàng de.','Đương nhiên là nhớ, tôi sẽ không quên.',4);
$d8_2=d($conn,$L8,'Suy nghi truoc khi noi','Cần thời gian suy nghĩ.',2);
ds($conn,$d8_2,'Xiao Ming','周末我们去哪儿玩？','Zhōumò wǒmen qù nǎr wán?','Cuối tuần chúng ta đi đâu chơi?',1);
ds($conn,$d8_2,'Anna','让我想想再告诉你。','Ràng wǒ xiǎngxiang zài gàosu nǐ.','Để tôi nghĩ đã rồi nói cho bạn.',2);
ds($conn,$d8_2,'Xiao Ming','好，你想好了告诉我。','Hǎo, nǐ xiǎnghǎo le gàosu wǒ.','Được, bạn nghĩ xong thì nói tôi.',3);
ds($conn,$d8_2,'Anna','我们去看电影吧，我决定了。','Wǒmen qù kàn diànyǐng ba, wǒ juédìng le.','Chúng ta đi xem phim đi, tôi quyết định rồi.',4);
// Reading L8
r($conn,$L8,'Suy nghi truoc khi quyet dinh','今天朋友问我周末要不要一起去旅游。我说让我想想再告诉他。因为我不确定有没有时间。我记了一下这个周末的安排：星期六上午有事，下午可以。星期天全天都可以。后来我决定星期六下午去。我告诉朋友这个决定，他说好。朋友说以后做什么都要先想想再决定，这样不会后悔。我觉得他说得对。','Jīntiān péngyou wèn wǒ zhōumò yào bú yào yīqǐ qù lǚyóu. Wǒ shuō ràng wǒ xiǎngxiang zài gàosu tā. Yīnwèi wǒ bú quèdìng yǒu méiyǒu shíjiān. Wǒ jì le yíxià zhè ge zhōumò de ānpái: xīngqīliù shàngwǔ yǒu shì, xiàwǔ kěyǐ. Xīngqītiān quántiān dōu kěyǐ. Hòulái wǒ juédìng xīngqīliù xiàwǔ qù. Wǒ gàosu péngyou zhè ge juédìng, tā shuō hǎo. Péngyou shuō yǐhòu zuò shénme dōu yào xiān xiǎngxiang zài juédìng, zhèyàng bú huì hòuhuǐ. Wǒ juéde tā shuō de duì.','Hôm nay bạn hỏi tôi cuối tuần có muốn đi du lịch cùng không. Tôi nói để tôi nghĩ đã rồi nói cho bạn. Vì tôi không chắc có thời gian không. Tôi ghi nhớ lịch cuối tuần này: sáng thứ 7 có việc, chiều thì được. Cả ngày chủ nhật đều được. Sau đó tôi quyết định đi chiều thứ 7. Tôi nói với bạn quyết định này, bạn ấy nói tốt. Bạn nói sau này làm gì cũng phải suy nghĩ trước rồi quyết định, như vậy sẽ không hối hận. Tôi thấy bạn nói đúng.','easy',105,1);
// Listening L8
$L8l=l($conn,$L8,'Suy nghi','A:你记得他的电话吗？B:让我想想...忘了。A:怎么忘了？B:我没记下来。A:以后要记得记在本子上。B:你说得对，我以后一定记住。','A:Nǐ jìde tā de diànhuà ma? B:Ràng wǒ xiǎngxiang... wàng le. A:Zěnme wàng le? B:Wǒ méi jì xiàlái. A:Yǐhòu yào jìde jì zài běnzi shang. B:Nǐ shuō de duì, wǒ yǐhòu yí dìng jìzhù.','A:Bạn nhớ số điện thoại của anh ấy không? B:Để tôi nghĩ một chút... quên mất rồi. A:Sao lại quên? B:Tôi không ghi lại. A:Sau này nhớ ghi vào sổ. B:Bạn nói đúng, sau này tôi nhất định nhớ.','1');
lq($conn,$L8l,'Người B có nhớ số điện thoại không?','{"A":"Nhớ","B":"Quên","C":"Không chắc"}','Quên','Người B quên rồi.','multiple_choice',1);
lq($conn,$L8l,'Người A khuyên B làm gì?','{"A":"Gọi điện","B":"Ghi vào sổ","C":"Hỏi lại"}','Ghi vào sổ','Nhớ ghi vào sổ.','multiple_choice',2);
// Exercises L8
$E8_1=e($conn,$L8,'Chọn đáp án','"让" trong "让我想想" có nghĩa là:','multiple_choice','easy',1,'B',1);
eo($conn,$E8_1,'Muốn','A',0,1); eo($conn,$E8_1,'Để, cho phép','B',1,2); eo($conn,$E8_1,'Phải','C',0,3);
$E8_2=e($conn,$L8,'Dịch','"Để tôi nghĩ một chút."','translation','easy',1,'让我想想。',2);
$E8_3=e($conn,$L8,'Điền từ','我___得你的名字。(nhớ)','fill_blank','easy',1,'记',3);
$E8_4=e($conn,$L8,'Sắp xếp câu','让我 / 再 / 想想 / 告诉你','sentence_order','easy',1,'让我想想再告诉你。',4);
$E8_5=e($conn,$L8,'Chọn đúng/sai','"以后" có nghĩa là "trước đây".','true_false','easy',1,'false',5);
eo($conn,$E8_5,'Đúng','A',0,1); eo($conn,$E8_5,'Sai','B',1,2);
$E8_6=e($conn,$L8,'Điền từ','你___一下，我马上来。(đợi)','fill_blank','easy',1,'等',6);
$E8_7=e($conn,$L8,'Chọn đáp án','"V + 一下" diễn tả:','multiple_choice','easy',1,'A',7);
eo($conn,$E8_7,'Hành động ngắn, nhẹ nhàng','A',1,1); eo($conn,$E8_7,'Hành động dài','B',0,2); eo($conn,$E8_7,'Hành động đã xong','C',0,3);
// Review L8
foreach ([$v8_1,$v8_2,$v8_3,$v8_4,$v8_5,$v8_6,$v8_7,$v8_8,$v8_9] as $i=>$vid) if ($vid) rv($conn,$L8,$vid,'core',$i+1);
echo " HSK2 L8 done: $v8 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L9: 因为他有问题要问我
// ═══════════════════════════════════════════════════
$L9=createLesson($conn,2,9,'Bài 9: Yin wei ta you wen ti yao wen wo - Vì anh ấy có vấn đề muốn hỏi tôi','Nguyên nhân - kết quả. 因为...所以... 要...了 (sắp).','["Nguyen nhan","Ket qua","Sap xay ra"]','Hoc tap','easy','HSK2 Bài 9: Nguyên nhân và kết quả. 因为...所以... (bởi vì...cho nên...). 要...了 (sắp...rồi). 有 + N + 要 + V (có...cần...). Từ vựng: 问题, 问, 回答, 考试, 准备, 复习.');
$v9=0;
$v9_1=v($conn,$L9,2,'因为','yīnwèi','bởi vì','bởi vì','因为我有事。','Yīnwèi wǒ yǒu shì.','Vì tôi có việc.','conj','Liên từ chỉ nguyên nhân.',++$v9);
$v9_2=v($conn,$L9,2,'所以','suǒyǐ','cho nên, vì vậy','cho nên','所以我来晚了。','Suǒyǐ wǒ lái wǎn le.','Cho nên tôi đến muộn.','conj','Liên từ chỉ kết quả.',++$v9);
$v9_3=v($conn,$L9,2,'问题','wèntí','vấn đề, câu hỏi','vấn đề','有一个问题。','Yǒu yí ge wèntí.','Có một vấn đề.','noun','Câu hỏi hoặc vấn đề.',++$v9);
$v9_4=v($conn,$L9,2,'问','wèn','hỏi','hỏi','问他。','Wèn tā.','Hỏi anh ấy.','verb','Đặt câu hỏi.',++$v9);
$v9_5=v($conn,$L9,2,'回答','huídá','trả lời','trả lời','回答问题。','Huídá wèntí.','Trả lời câu hỏi.','verb','Phản hồi câu hỏi.',++$v9);
$v9_6=v($conn,$L9,2,'考试','kǎoshì','bài thi, thi','thi','要考试了。','Yào kǎoshì le.','Sắp thi rồi.','noun/verb','Kỳ thi.',++$v9);
$v9_7=v($conn,$L9,2,'准备','zhǔnbèi','chuẩn bị','chuẩn bị','准备考试。','Zhǔnbèi kǎoshì.','Chuẩn bị thi.','verb','Sự chuẩn bị.',++$v9);
$v9_8=v($conn,$L9,2,'复习','fùxí','ôn tập','ôn tập','复习课文。','Fùxí kèwén.','Ôn tập bài khóa.','verb','Ôn lại bài cũ.',++$v9);
$v9_9=v($conn,$L9,2,'学习','xuéxí','học tập','học tập','学习汉语。','Xuéxí Hànyǔ.','Học tiếng Trung.','verb','Quá trình học.',++$v9);
// Grammar L9
$g9_1=g($conn,$L9,'Cặp liên từ 因为...所以...','因为 + Nguyên nhân, 所以 + Kết quả','Bởi vì...cho nên...','因为 đứng ở mệnh đề chỉ nguyên nhân, 所以 đứng ở mệnh đề chỉ kết quả. Có thể lược bỏ một trong hai nếu ngữ cảnh rõ.','因为下雨，所以没去. Có thể chỉ dùng 因为 hoặc 所以.','Nguyên nhân - kết quả.',1);
ge($conn,$g9_1,'因为他有问题，所以来问我。','Yīnwèi tā yǒu wèntí, suǒyǐ lái wèn wǒ.','Vì anh ấy có vấn đề nên đến hỏi tôi.',1);
ge($conn,$g9_1,'因为要考试了，所以我在复习。','Yīnwèi yào kǎoshì le, suǒyǐ wǒ zài fùxí.','Vì sắp thi rồi nên tôi đang ôn tập.',2);
$g9_2=g($conn,$L9,'Cấu trúc 要...了','要 + Động từ + 了','Sắp...rồi','要...了 diễn tả hành động sắp xảy ra. 要 + V + 了 = sắp làm gì rồi. Có thể thay 要 bằng 快.','要考试了 = sắp thi rồi. 要下雨了 = sắp mưa rồi.','Sắp xảy ra.',2);
ge($conn,$g9_2,'要考试了，你准备好了吗？','Yào kǎoshì le, nǐ zhǔnbèi hǎo le ma?','Sắp thi rồi, bạn chuẩn bị xong chưa?',1);
ge($conn,$g9_2,'要吃饭了，快去洗手。','Yào chīfàn le, kuài qù xǐshǒu.','Sắp ăn cơm rồi, nhanh đi rửa tay.',2);
$g9_3=g($conn,$L9,'Cấu trúc 有 + N + 要 + V','有 + Danh từ + 要 + Động từ','Có...cần...','Cấu trúc này diễn tả có việc gì đó cần làm. 有 + danh từ (事/问题) + 要 + động từ.','有事要说 = có việc cần nói. 有问题要问 = có câu hỏi cần hỏi.','Có việc cần làm.',3);
ge($conn,$g9_3,'我有问题要问你。','Wǒ yǒu wèntí yào wèn nǐ.','Tôi có câu hỏi muốn hỏi bạn.',1);
ge($conn,$g9_3,'他有一件事要告诉你。','Tā yǒu yí jiàn shì yào gàosu nǐ.','Anh ấy có một việc muốn nói với bạn.',2);
// Dialogues L9
$d9_1=d($conn,$L9,'Co cau hoi muon hoi','Hỏi bài vì sắp thi.',1);
ds($conn,$d9_1,'Anna','马上要考试了，你复习了吗？','Mǎshàng yào kǎoshì le, nǐ fùxí le ma?','Sắp thi rồi, bạn ôn tập chưa?',1);
ds($conn,$d9_1,'Xiao Ming','还没有。因为我有问题要问你。','Hái méiyǒu. Yīnwèi wǒ yǒu wèntí yào wèn nǐ.','Chưa. Vì tôi có câu hỏi muốn hỏi bạn.',2);
ds($conn,$d9_1,'Anna','什么问题？你说吧。','Shénme wèntí? Nǐ shuō ba.','Câu hỏi gì? Bạn nói đi.',3);
ds($conn,$d9_1,'Xiao Ming','这个语法我不太懂，你能帮我吗？','Zhè ge yǔfǎ wǒ bú tài dǒng, nǐ néng bāng wǒ ma?','Ngữ pháp này tôi không hiểu lắm, bạn có thể giúp tôi không?',4);
$d9_2=d($conn,$L9,'Vi sao nghi hoc','Hỏi lý do nghỉ học.',2);
ds($conn,$d9_2,'Xiao Ming','你昨天怎么没来上课？','Nǐ zuótiān zěnme méi lái shàngkè?','Sao hôm qua bạn không đến lớp?',1);
ds($conn,$d9_2,'Anna','因为身体不舒服，所以没来。','Yīnwèi shēntǐ bù shūfu, suǒyǐ méi lái.','Vì cơ thể không khỏe nên không đến.',2);
ds($conn,$d9_2,'Xiao Ming','现在好了吗？准备考试没问题吧？','Xiànzài hǎo le ma? Zhǔnbèi kǎoshì méi wèntí ba?','Bây giờ đỡ chưa? Chuẩn bị thi không vấn đề chứ?',3);
ds($conn,$d9_2,'Anna','好多了，但是要好好复习才行。','Hǎo duō le, dànshì yào hǎohāo fùxí cái xíng.','Đỡ nhiều rồi, nhưng phải ôn tập tốt mới được.',4);
// Reading L9
r($conn,$L9,'On tap cho ky thi','下个星期要考试了，所以我这几天都在复习。因为有很多问题不懂，所以我常常问同学。同学很好，每次都帮我回答。昨天我准备了一个问题列表，打算今天问老师。因为今天老师有时间。老师很认真地回答了我的问题，还帮我复习了重要的语法点。我希望考试能考好。','Xià ge xīngqī yào kǎoshì le, suǒyǐ wǒ zhè jǐ tiān dōu zài fùxí. Yīnwèi yǒu hěn duō wèntí bù dǒng, suǒyǐ wǒ chángcháng wèn tóngxué. Tóngxué hěn hǎo, měi cì dōu bāng wǒ huídá. Zuótiān wǒ zhǔnbèi le yí ge wèntí lièbiǎo, dǎsuàn jīntiān wèn lǎoshī. Yīnwèi jīntiān lǎoshī yǒu shíjiān. Lǎoshī hěn rènzhēn de huídá le wǒ de wèntí, hái bāng wǒ fùxí le zhòngyào de yǔfǎ diǎn. Wǒ xīwàng kǎoshì néng kǎo hǎo.','Tuần sau sắp thi rồi, nên mấy ngày nay tôi đều ôn tập. Vì có nhiều vấn đề không hiểu nên tôi thường hỏi bạn cùng lớp. Bạn rất tốt, lần nào cũng giúp tôi trả lời. Hôm qua tôi chuẩn bị một danh sách câu hỏi, định hôm nay hỏi thầy giáo. Vì hôm nay thầy có thời gian. Thầy đã trả lời câu hỏi của tôi rất nghiêm túc, còn giúp tôi ôn tập những điểm ngữ pháp quan trọng. Tôi hy vọng thi tốt.','easy',110,1);
// Listening L9
$L9l=l($conn,$L9,'Hoc tap','A:你昨天怎么没来上课？B:因为生病了。A:现在好点儿了吗？B:好多了。A:要考试了，你得多复习。B:我知道，但是我有问题不会。A:我来帮你吧。B:太好了，谢谢你！','A:Nǐ zuótiān zěnme méi lái shàngkè? B:Yīnwèi shēngbìng le. A:Xiànzài hǎo diǎnr le ma? B:Hǎo duō le. A:Yào kǎoshì le, nǐ děi duō fùxí. B:Wǒ zhīdào, dànshì wǒ yǒu wèntí bú huì. A:Wǒ lái bāng nǐ ba. B:Tài hǎo le, xièxie nǐ!','A:Sao hôm qua bạn không đến lớp? B:Vì bị ốm. A:Bây giờ đỡ hơn chưa? B:Đỡ nhiều rồi. A:Sắp thi rồi, bạn phải ôn tập nhiều. B:Tôi biết, nhưng tôi có vấn đề không biết. A:Để tôi giúp bạn. B:Tuyệt quá, cảm ơn bạn!','1');
lq($conn,$L9l,'Tại sao người B không đi học?','{"A":"Bận","B":"Bị ốm","C":"Quên"}','Bị ốm','Vì bị ốm.','multiple_choice',1);
lq($conn,$L9l,'Người A sẽ làm gì?','{"A":"Đi học","B":"Giúp B ôn tập","C":"Hỏi thầy"}','Giúp B ôn tập','A sẽ giúp B học.','multiple_choice',2);
// Exercises L9
$E9_1=e($conn,$L9,'Chọn đáp án','"因为...所以..." dùng để:','multiple_choice','easy',1,'C',1);
eo($conn,$E9_1,'Hỏi thời gian','A',0,1); eo($conn,$E9_1,'Hỏi địa điểm','B',0,2); eo($conn,$E9_1,'Nêu nguyên nhân - kết quả','C',1,3);
$E9_2=e($conn,$L9,'Dịch','"Vì sắp thi rồi nên tôi đang ôn tập."','translation','easy',1,'因为要考试了，所以我在复习。',2);
$E9_3=e($conn,$L9,'Điền từ','我___问题要问你。(có)','fill_blank','easy',1,'有',3);
$E9_4=e($conn,$L9,'Sắp xếp câu','因为 / 所以 / 有问题 / 他 / 来问我','sentence_order','easy',1,'因为他有问题，所以来问我。',4);
$E9_5=e($conn,$L9,'Chọn đúng/sai','"要考试了" có nghĩa là "đã thi xong".','true_false','easy',1,'false',5);
eo($conn,$E9_5,'Đúng','A',0,1); eo($conn,$E9_5,'Sai','B',1,2);
$E9_6=e($conn,$L9,'Điền từ','要考试了，我得好好___。(chuẩn bị)','fill_blank','easy',1,'准备',6);
$E9_7=e($conn,$L9,'Chọn đáp án','"回答" có nghĩa là:','multiple_choice','easy',1,'A',7);
eo($conn,$E9_7,'Trả lời','A',1,1); eo($conn,$E9_7,'Hỏi','B',0,2); eo($conn,$E9_7,'Học','C',0,3);
// Review L9
foreach ([$v9_1,$v9_2,$v9_3,$v9_4,$v9_5,$v9_6,$v9_7,$v9_8,$v9_9] as $i=>$vid) if ($vid) rv($conn,$L9,$vid,'core',$i+1);
echo " HSK2 L9 done: $v9 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L10: 你找什么
// ═══════════════════════════════════════════════════
$L10=createLesson($conn,2,10,'Bài 10: Ni zhao shen me - Bạn tìm gì?','Tìm kiếm đồ vật. 在...呢 (đang). Phương vị từ 里/外.','["Tim kiem","Vi tri","Hanh dong dang dien ra"]','Tim kiem','easy','HSK2 Bài 10: Tìm kiếm và vị trí. 在 + V + 呢 (đang làm gì). 在 + N + 里/外 (ở trong/ngoài). 找 + object (tìm gì). Từ vựng: 钥匙, 手机, 钱包, 开, 关, 里.');
$v10=0;
$v10_1=v($conn,$L10,2,'找','zhǎo','tìm','tìm','找什么？','Zhǎo shénme?','Tìm gì?','verb','Hành động tìm kiếm.',++$v10);
$v10_2=v($conn,$L10,2,'钥匙','yàoshi','chìa khóa','chìa khóa','找钥匙。','Zhǎo yàoshi.','Tìm chìa khóa.','noun','Chìa khóa cửa, xe.',++$v10);
$v10_3=v($conn,$L10,2,'手机','shǒujī','điện thoại di động','điện thoại','我的手机。','Wǒ de shǒujī.','Điện thoại của tôi.','noun','Điện thoại cầm tay.',++$v10);
$v10_4=v($conn,$L10,2,'钱包','qiánbāo','ví tiền','ví','钱包丢了。','Qiánbāo diū le.','Ví mất rồi.','noun','Ví đựng tiền.',++$v10);
$v10_5=v($conn,$L10,2,'地方','dìfang','nơi, chỗ','chỗ','什么地方？','Shénme dìfang?','Chỗ nào?','noun','Vị trí, không gian.',++$v10);
$v10_6=v($conn,$L10,2,'门','mén','cửa','cửa','开门。','Kāi mén.','Mở cửa.','noun','Cửa ra vào.',++$v10);
$v10_7=v($conn,$L10,2,'开','kāi','mở','mở','开门。','Kāi mén.','Mở cửa.','verb','Mở, bật.',++$v10);
$v10_8=v($conn,$L10,2,'关','guān','đóng, tắt','đóng','关门。','Guān mén.','Đóng cửa.','verb','Đóng, tắt.',++$v10);
$v10_9=v($conn,$L10,2,'里','lǐ','trong (bên trong)','trong','在房间里。','Zài fángjiān lǐ.','Ở trong phòng.','noun','Phương vị từ.',++$v10);
// Grammar L10
$g10_1=g($conn,$L10,'Diễn tả hành động đang xảy ra: 在...呢','在 + Động từ + 呢','Đang làm gì','在 đặt trước động từ, kết hợp với 呢 ở cuối câu để diễn tả hành động đang diễn ra. Có thể bỏ 呢 trong văn nói.','我在看书呢 = tôi đang đọc sách.','Hành động tiếp diễn.',1);
ge($conn,$g10_1,'你在找什么呢？','Nǐ zài zhǎo shénme ne?','Bạn đang tìm gì thế?',1);
ge($conn,$g10_1,'我在找我的手机呢。','Wǒ zài zhǎo wǒ de shǒujī ne.','Tôi đang tìm điện thoại của tôi.',2);
$g10_2=g($conn,$L10,'Phương vị từ 里/外','Danh từ + 里 / 外','Ở trong / ngoài','里 (trong) và 外 (ngoài) là phương vị từ đơn giản, đứng sau danh từ chỉ địa điểm hoặc vật chứa.','包里 = trong túi. 房间里 = trong phòng. 门外 = ngoài cửa.','Trong / ngoài.',2);
ge($conn,$g10_2,'钥匙在包里。','Yàoshi zài bāo lǐ.','Chìa khóa ở trong túi.',1);
ge($conn,$g10_2,'他在门外等我。','Tā zài mén wài děng wǒ.','Anh ấy đợi tôi ngoài cửa.',2);
$g10_3=g($conn,$L10,'Động từ 找 + Tân ngữ','找 + Người/Vật','Tìm ai / cái gì','找 là động từ chỉ hành động tìm kiếm. Sau 找 là tân ngữ chỉ người hoặc vật. Có thể dùng 在...呢 để nhấn mạnh đang tìm.','找人 = tìm người. 找东西 = tìm đồ.','Tìm kiếm.',3);
ge($conn,$g10_3,'你找什么？','Nǐ zhǎo shénme?','Bạn tìm gì?',1);
ge($conn,$g10_3,'我找我的钱包。','Wǒ zhǎo wǒ de qiánbāo.','Tôi tìm ví của tôi.',2);
// Dialogues L10
$d10_1=d($conn,$L10,'Tim chia khoa','Tìm chìa khóa bị mất.',1);
ds($conn,$d10_1,'Anna','你在找什么呢？','Nǐ zài zhǎo shénme ne?','Bạn đang tìm gì thế?',1);
ds($conn,$d10_1,'Xiao Ming','我找钥匙。我的钥匙在哪儿？','Wǒ zhǎo yàoshi. Wǒ de yàoshi zài nǎr?','Tôi tìm chìa khóa. Chìa khóa của tôi ở đâu?',2);
ds($conn,$d10_1,'Anna','在桌子上吗？','Zài zhuōzi shang ma?','Ở trên bàn à?',3);
ds($conn,$d10_1,'Xiao Ming','没有。','Méiyǒu.','Không có.',4);
ds($conn,$d10_1,'Anna','在书包里找找？','Zài shūbāo lǐ zhǎozhao?','Tìm trong cặp sách xem?',5);
ds($conn,$d10_1,'Xiao Ming','找到了！在书包里。谢谢！','Zhǎodào le! Zài shūbāo lǐ. Xièxie!','Tìm thấy rồi! Ở trong cặp sách. Cảm ơn!',6);
$d10_2=d($conn,$L10,'Tim dien thoai','Tìm điện thoại trong phòng.',2);
ds($conn,$d10_2,'Xiao Ming','你看见我的手机了吗？','Nǐ kànjiàn wǒ de shǒujī le ma?','Bạn thấy điện thoại của tôi không?',1);
ds($conn,$d10_2,'Anna','没看见。你找找房间里。','Méi kànjiàn. Nǐ zhǎozhao fángjiān lǐ.','Không thấy. Bạn tìm trong phòng đi.',2);
ds($conn,$d10_2,'Xiao Ming','我找了，没有。','Wǒ zhǎo le, méiyǒu.','Tôi tìm rồi, không có.',3);
ds($conn,$d10_2,'Anna','在沙发上吗？','Zài shāfā shang ma?','Ở trên ghế sofa à?',4);
ds($conn,$d10_2,'Xiao Ming','哦，在这儿！谢谢你。','Ó, zài zhèr! Xièxie nǐ.','Ồ, ở đây! Cảm ơn bạn.',5);
// Reading L10
r($conn,$L10,'Tim do trong nha','今天早上我起床后找不到手机了。我在房间里找了很久，桌子上没有，床上也没有。我打开门去客厅找，在沙发上看了一下，也没有。我很着急。后来我想起来了，昨天晚上我放在书包里了。我打开书包一看，手机真的在里面！我关上门，拿着手机去上班。今天差点儿迟到。','Jīntiān zǎoshang wǒ qǐchuáng hòu zhǎo bú dào shǒujī le. Wǒ zài fángjiān lǐ zhǎo le hěn jiǔ, zhuōzi shang méiyǒu, chuáng shang yě méiyǒu. Wǒ dǎkāi mén qù kètīng zhǎo, zài shāfā shang kàn le yíxià, yě méiyǒu. Wǒ hěn zháojí. Hòulái wǒ xiǎng qǐlái le, zuótiān wǎnshang wǒ fàng zài shūbāo lǐ le. Wǒ dǎkāi shūbāo yí kàn, shǒujī zhēn de zài lǐmiàn! Wǒ guān shàng mén, ná zhe shǒujī qù shàngbān. Jīntiān chàdiǎn chídào.','Sáng nay sau khi dậy tôi không tìm thấy điện thoại. Tôi tìm trong phòng rất lâu, trên bàn không có, trên giường cũng không. Tôi mở cửa ra phòng khách tìm, nhìn trên ghế sofa một chút, cũng không có. Tôi rất lo. Sau đó tôi nhớ ra, tối qua tôi để trong cặp sách. Tôi mở cặp sách ra xem, điện thoại thật sự ở trong đó! Tôi đóng cửa, cầm điện thoại đi làm. Hôm nay suýt muộn.','easy',108,1);
// Listening L10
$L10l=l($conn,$L10,'Tim vi','A:你找什么呢？B:我找钱包。A:在哪儿丢的？B:不知道。可能在教室。A:我们去教室找找。B:好。...找到了，在桌子下面！A:下次要放好。','A:Nǐ zhǎo shénme ne? B:Wǒ zhǎo qiánbāo. A:Zài nǎr diū de? B:Bù zhīdào. Kěnéng zài jiàoshì. A:Wǒmen qù jiàoshì zhǎozhao. B:Hǎo... zhǎodào le, zài zhuōzi xiàmiàn! A:Xià cì yào fàng hǎo.','A:Bạn tìm gì thế? B:Tôi tìm ví. A:Mất ở đâu? B:Không biết. Có thể ở phòng học. A:Chúng ta vào phòng học tìm. B:Được... tìm thấy rồi, ở dưới bàn! A:Lần sau phải để cẩn thận.','1');
lq($conn,$L10l,'Người B đang tìm gì?','{"A":"Chìa khóa","B":"Ví tiền","C":"Điện thoại"}','Ví tiền','Tìm ví tiền.','multiple_choice',1);
lq($conn,$L10l,'Tìm thấy ở đâu?','{"A":"Trên bàn","B":"Dưới bàn","C":"Trong cặp"}','Dưới bàn','Ở dưới bàn.','multiple_choice',2);
// Exercises L10
$E10_1=e($conn,$L10,'Chọn đáp án','"在...呢" diễn tả:','multiple_choice','easy',1,'C',1);
eo($conn,$E10_1,'Đã làm','A',0,1); eo($conn,$E10_1,'Sẽ làm','B',0,2); eo($conn,$E10_1,'Đang làm','C',1,3);
$E10_2=e($conn,$L10,'Dịch','"Bạn đang tìm gì thế?"','translation','easy',1,'你在找什么呢？',2);
$E10_3=e($conn,$L10,'Điền từ','钥匙在书包___。(trong)','fill_blank','easy',1,'里',3);
$E10_4=e($conn,$L10,'Sắp xếp câu','在 / 什么 / 你 / 找 / 呢','sentence_order','easy',1,'你在找什么呢？',4);
$E10_5=e($conn,$L10,'Chọn đúng/sai','"关" có nghĩa là "mở".','true_false','easy',1,'false',5);
eo($conn,$E10_5,'Đúng','A',0,1); eo($conn,$E10_5,'Sai','B',1,2);
$E10_6=e($conn,$L10,'Điền từ','请___门，外面冷。(đóng)','fill_blank','easy',1,'关',6);
$E10_7=e($conn,$L10,'Chọn đáp án','"地方" có nghĩa là:','multiple_choice','easy',1,'B',7);
eo($conn,$E10_7,'Thời gian','A',0,1); eo($conn,$E10_7,'Nơi chốn','B',1,2); eo($conn,$E10_7,'Đồ vật','C',0,3);
// Review L10
foreach ([$v10_1,$v10_2,$v10_3,$v10_4,$v10_5,$v10_6,$v10_7,$v10_8,$v10_9] as $i=>$vid) if ($vid) rv($conn,$L10,$vid,'core',$i+1);
echo " HSK2 L10 done: $v10 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";
