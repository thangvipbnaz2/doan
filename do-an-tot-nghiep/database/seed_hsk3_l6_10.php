<?php
/**
 * HÀNNGỮ - HSK3 Content Seeder (Lessons 6-10)
 * HSK Standard Course 3: 300+ words, complex grammar, 2-3 dialogues/lesson
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK3 L6: 他是怎么知道的
// ═══════════════════════════════════════════════════
$L6=createLesson($conn,3,6,'Bài 6: Ta shi zen me zhi dao de - Anh ấy làm sao biết được','Cách thức, nguồn tin, sự ngạc nhiên. Phân biệt 怎么/什么.','["Cach thuc","Nguon tin","Ngan nhien"]','Cach thuc','easy','HSK3 Bài 6: Phân biệt 怎么 (thế nào, sao) và 什么 (cái gì). Phó từ phản vấn 难道 (lẽ nào/chẳng lẽ). Câu chẻ 是...的 nhấn mạnh cách thức. Từ vựng: xiāoxi (tin tức), mìmì (bí mật), gàosu (nói cho).');
$v6=0;
$v6_1=v($conn,$L6,3,'怎么','zěnme','thế nào, sao','sao','你是怎么知道的？','Nǐ shì zěnme zhīdào de?','Anh làm sao biết được?','pron','Hỏi cách thức, lý do.',++$v6);
$v6_2=v($conn,$L6,3,'难道','nándào','lẽ nào, chẳng lẽ','chẳng lẽ','难道你不知道吗？','Nándào nǐ bù zhīdào ma?','Chẳng lẽ bạn không biết sao?','adv','Phó từ phản vấn, đặt đầu câu.',++$v6);
$v6_3=v($conn,$L6,3,'消息','xiāoxi','tin tức','tin','我有一个好消息。','Wǒ yǒu yí ge hǎo xiāoxi.','Tôi có một tin tốt.','noun','Thông tin, tin tức.',++$v6);
$v6_4=v($conn,$L6,3,'告诉','gàosu','nói cho, báo cho','bảo','他告诉我一个秘密。','Tā gàosu wǒ yí ge mìmì.','Anh ấy nói cho tôi một bí mật.','verb','Động từ dịch thuật: gàosu + O + V.',++$v6);
$v6_5=v($conn,$L6,3,'别人','biéren','người khác','người khác','这是别人的东西。','Zhè shì biéren de dōngxi.','Đây là đồ của người khác.','pron','Đại từ chỉ người khác.',++$v6);
$v6_6=v($conn,$L6,3,'秘密','mìmì','bí mật','bí mật','这是我们之间的秘密。','Zhè shì wǒmen zhījiān de mìmì.','Đây là bí mật giữa chúng ta.','noun','Điều không muốn người khác biết.',++$v6);
$v6_7=v($conn,$L6,3,'相信','xiāngxìn','tin tưởng','tin','我相信你。','Wǒ xiāngxìn nǐ.','Tôi tin bạn.','verb','Động từ chỉ sự tin tưởng.',++$v6);
$v6_8=v($conn,$L6,3,'原来','yuánlái','hóa ra, thì ra','hóa ra','原来是这样。','Yuánlái shì zhèyàng.','Hóa ra là như vậy.','adv','Phát hiện ra sự thật.',++$v6);
$v6_9=v($conn,$L6,3,'奇怪','qíguài','kỳ lạ','lạ','真奇怪！','Zhēn qíguài!','Thật kỳ lạ!','adj','Lạ, khó hiểu.',++$v6);
// Grammar L6
$g6_1=g($conn,$L6,'Phân biệt 怎么 và 什么','怎么 + V (hỏi cách thức) / 什么 + N (hỏi sự vật)','Thế nào vs Cái gì','怎么 hỏi về cách thức, phương pháp, lý do. 什么 hỏi về sự vật, sự việc. 怎么 thường đi với động từ, 什么 có thể đi với danh từ hoặc động từ.','怎么去 (đi thế nào). 去什么地方 (đi đâu).',1);
ge($conn,$g6_1,'你是怎么来的？','Nǐ shì zěnme lái de?','Anh đến bằng cách nào?',1);
ge($conn,$g6_1,'你买了什么东西？','Nǐ mǎi le shénme dōngxi?','Anh đã mua cái gì?',2);
$g6_2=g($conn,$L6,'Phó từ phản vấn 难道','难道 + Câu khẳng định/phủ định + 吗/不成','Lẽ nào / Chẳng lẽ...','难道 đặt ở đầu câu để tạo câu hỏi phản vấn, biểu thị người nói đã có suy nghĩ trái ngược. Thường cuối câu kết hợp với 吗.','难道你不相信我？ = Chẳng lẽ anh không tin tôi?',2);
ge($conn,$g6_2,'难道你不知道这个消息吗？','Nándào nǐ bù zhīdào zhè ge xiāoxi ma?','Chẳng lẽ anh không biết tin này sao?',1);
ge($conn,$g6_2,'难道这是真的吗？','Nándào zhè shì zhēn de ma?','Lẽ nào đây là thật sao?',2);
$g6_3=g($conn,$L6,'Câu chẻ 是...的 (nhấn mạnh cách thức)','是 + Cách thức + V + 的','Nhấn mạnh cách thức hành động','是...的 nhấn mạnh chi tiết của hành động đã xảy ra: thời gian, địa điểm, cách thức. Thường dùng cho hành động đã hoàn thành trong quá khứ.','他是坐飞机来的 = Anh ấy đến bằng máy bay.',3);
ge($conn,$g6_3,'他是怎么知道的？','Tā shì zěnme zhīdào de?','Anh ấy làm sao biết được?',1);
ge($conn,$g6_3,'我是从朋友那儿听说的。','Wǒ shì cóng péngyou nàr tīngshuō de.','Tôi nghe nói từ bạn.',2);
// Dialogues L6
$d6_1=d($conn,$L6,'Bi mat bi lo','Bí mật bị lộ.',1);
ds($conn,$d6_1,'Anna','你知道吗？小王和小丽结婚了！','Nǐ zhīdào ma? Xiǎo Wáng hé Xiǎo Lì jiéhūn le!','Bạn biết không? Tiểu Vương và Tiểu Lệ kết hôn rồi!',1);
ds($conn,$d6_1,'Xiao Ming','真的吗？你是怎么知道的？','Zhēn de ma? Nǐ shì zěnme zhīdào de?','Thật à? Làm sao bạn biết?',2);
ds($conn,$d6_1,'Anna','是小王告诉我的。','Shì Xiǎo Wáng gàosu wǒ de.','Là Tiểu Vương nói cho tôi.',3);
ds($conn,$d6_1,'Xiao Ming','难道这是真的？我都不相信。','Nándào zhè shì zhēn de? Wǒ dōu bù xiāngxìn.','Chẳng lẽ thật à? Tôi còn không tin.',4);
ds($conn,$d6_1,'Anna','当然是真的，我怎么会骗你？','Dāngrán shì zhēn de, wǒ zěnme huì piàn nǐ?','Đương nhiên là thật, tôi sao lại lừa bạn?',5);
$d6_2=d($conn,$L6,'Tin bat ngo','Tin bất ngờ.',2);
ds($conn,$d6_2,'Xiao Ming','你听说公司要搬家的消息了吗？','Nǐ tīngshuō gōngsī yào bānjiā de xiāoxi le ma?','Bạn nghe tin công ty sắp chuyển nhà chưa?',1);
ds($conn,$d6_2,'Anna','什么？我不知道啊。你是从哪儿知道的？','Shénme? Wǒ bù zhīdào a. Nǐ shì cóng nǎr zhīdào de?','Gì cơ? Tôi không biết. Bạn biết từ đâu vậy?',2);
ds($conn,$d6_2,'Xiao Ming','经理告诉我的。原来下个月就要搬了。','Jīnglǐ gàosu wǒ de. Yuánlái xià ge yuè jiù yào bān le.','Giám đốc nói với tôi. Hóa ra tháng sau là chuyển rồi.',3);
ds($conn,$d6_2,'Anna','这个消息太突然了，别人知道吗？','Zhè ge xiāoxi tài tūrán le, biéren zhīdào ma?','Tin này bất ngờ quá, người khác biết không?',4);
ds($conn,$d6_2,'Xiao Ming','还没有告诉别人。','Hái méiyǒu gàosu biéren.','Vẫn chưa nói với người khác.',5);
// Reading L6
r($conn,$L6,'Tin bi mat','昨天小王告诉我一个秘密。他说下个月公司要搬家，搬到市中心去。我觉得很奇怪，因为经理还没有告诉大家。原来小王是经理的助手，所以他先知道了。他让我不要告诉别人。我答应保守秘密。但是心里想：这个秘密别人迟早会知道的。','Zuótiān Xiǎo Wáng gàosu wǒ yí ge mìmì. Tā shuō xià ge yuè gōngsī yào bānjiā, bān dào shì zhōngxīn qù. Wǒ juéde hěn qíguài, yīnwèi jīnglǐ hái méiyǒu gàosu dàjiā. Yuánlái Xiǎo Wáng shì jīnglǐ de zhùshǒu, suǒyǐ tā xiān zhīdào le. Tā ràng wǒ bú yào gàosu biéren. Wǒ dāyìng bǎoshǒu mìmì. Dànshì xīn li xiǎng: zhè ge mìmì biéren chízǎo huì zhīdào de.','Hôm qua Tiểu Vương nói với tôi một bí mật. Anh ấy nói tháng sau công ty sẽ chuyển nhà, chuyển đến trung tâm thành phố. Tôi thấy rất lạ, vì giám đốc vẫn chưa nói với mọi người. Hóa ra Tiểu Vương là trợ lý giám đốc nên biết trước. Anh ấy bảo tôi đừng nói với người khác. Tôi hứa giữ bí mật. Nhưng trong lòng nghĩ: bí mật này sớm muộn người khác cũng biết.','easy',110,1);
// Listening L6
$L6l=l($conn,$L6,'Bi mat','A:你听说小刘辞职的消息了吗？B:什么？他辞职了？A:对，我也是刚知道的。B:你是听谁说的？A:小刘自己告诉我的。B:原来是这样。他为什么要走？A:他说找到了更好的工作。','A:Nǐ tīngshuō Xiǎo Liú cízhí de xiāoxi le ma? B:Shénme? Tā cízhí le? A:Duì, wǒ yě shì gāng zhīdào de. B:Nǐ shì tīng shéi shuō de? A:Xiǎo Liú zìjǐ gàosu wǒ de. B:Yuánlái shì zhèyàng. Tā wèishénme yào zǒu? A:Tā shuō zhǎodào le gèng hǎo de gōngzuò.','A:Bạn nghe tin Tiểu Lưu nghỉ việc chưa? B:Gì cơ? Anh ấy nghỉ việc rồi? A:Đúng, tôi cũng vừa biết. B:Bạn nghe ai nói? A:Tiểu Lưu tự nói với tôi. B:Hóa ra là thế. Tại sao anh ấy đi? A:Anh ấy nói tìm được công việc tốt hơn.','1');
lq($conn,$L6l,'Ai nói cho A biết tin Tiểu Lưu nghỉ việc?','{"A":"Giám đốc","B":"Tiểu Lưu","C":"Đồng nghiệp"}','Tiểu Lưu','Tiểu Lưu tự nói.','multiple_choice',1);
lq($conn,$L6l,'Tại sao Tiểu Lưu nghỉ việc?','{"A":"Ốm","B":"Tìm việc tốt hơn","C":"Về quê"}','Tìm việc tốt hơn','Tìm được việc tốt hơn.','multiple_choice',2);
// Exercises L6
$E6_1=e($conn,$L6,'Chọn đáp án','"Thế nào" là:','multiple_choice','easy',1,'B',1);
eo($conn,$E6_1,'什么','A',0,1); eo($conn,$E6_1,'怎么','B',1,2); eo($conn,$E6_1,'这么','C',0,3);
$E6_2=e($conn,$L6,'Dịch','"Chẳng lẽ anh không biết sao?"','translation','easy',1,'难道你不知道吗？',2);
$E6_3=e($conn,$L6,'Điền từ','你___来的？(bằng cách nào)','fill_blank','easy',1,'怎么',3);
$E6_4=e($conn,$L6,'Sắp xếp câu','是 / 他 / 怎么 / 知道 / 的','sentence_order','easy',1,'他是怎么知道的？',4);
$E6_5=e($conn,$L6,'Chọn đúng/sai','"难道" dùng để hỏi lý do.','true_false','easy',1,'false',5);
eo($conn,$E6_5,'Đúng','A',0,1); eo($conn,$E6_5,'Sai','B',1,2);
$E6_6=e($conn,$L6,'Điền từ','别___别人。(nói cho)','fill_blank','easy',1,'告诉',6);
$E6_7=e($conn,$L6,'Chọn đáp án','"怎么" và "什么" khác nhau thế nào?','multiple_choice','easy',1,'A',7);
eo($conn,$E6_7,'怎么 hỏi cách thức, 什么 hỏi sự vật','A',1,1); eo($conn,$E6_7,'怎么 hỏi người, 什么 hỏi vật','B',0,2); eo($conn,$E6_7,'Giống nhau','C',0,3);
$E6_8=e($conn,$L6,'Điền từ','原来___这样。(hóa ra)','fill_blank','easy',1,'是',8);
// Review L6
foreach ([$v6_1,$v6_2,$v6_3,$v6_4,$v6_5,$v6_6,$v6_7,$v6_8,$v6_9] as $i=>$vid) if ($vid) rv($conn,$L6,$vid,'core',$i+1);
echo " HSK3 L6 done: $v6 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 8 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L7: 我跟她都认识五年了
// ═══════════════════════════════════════════════════
$L7=createLesson($conn,3,7,'Bài 7: Wo gen ta dou ren shi wu nian le - Tôi và cô ấy quen nhau 5 năm rồi','Thời gian quen biết, mối quan hệ, sự thay đổi.','["Thoi gian","Moi quan he","Su thay doi"]','Moi quan he','easy','HSK3 Bài 7: Cấu trúc V + 了 + Thời gian (hành động kéo dài bao lâu). Giới từ 跟/和 (với, cùng). Phó từ 一直 (mãi mãi, luôn). Từ vựng: rènshi (quen), liánxì (liên lạc), jiànmiàn (gặp mặt), biànhuà (thay đổi).');
$v7=0;
$v7_1=v($conn,$L7,3,'认识','rènshi','quen biết','quen','我认识她三年了。','Wǒ rènshi tā sān nián le.','Tôi quen cô ấy 3 năm rồi.','verb','Động từ chỉ sự quen biết.',++$v7);
$v7_2=v($conn,$L7,3,'跟','gēn','với, cùng','với','我跟你一起去。','Wǒ gēn nǐ yīqǐ qù.','Tôi đi cùng bạn.','prep','Giới từ chỉ cùng nhau.',++$v7);
$v7_3=v($conn,$L7,3,'年','nián','năm','năm','五年时间过得真快。','Wǔ nián shíjiān guò de zhēn kuài.','5 năm thời gian trôi nhanh thật.','noun','Đơn vị thời gian.',++$v7);
$v7_4=v($conn,$L7,3,'一直','yìzhí','một mực, luôn luôn','luôn','我一直很喜欢汉语。','Wǒ yìzhí hěn xǐhuan Hànyǔ.','Tôi luôn rất thích tiếng Trung.','adv','Phó từ chỉ liên tục.',++$v7);
$v7_5=v($conn,$L7,3,'见面','jiànmiàn','gặp mặt','gặp','我们很久没见面了。','Wǒmen hěn jiǔ méi jiànmiàn le.','Chúng tôi lâu không gặp nhau.','verb','Động từ phân ly.',++$v7);
$v7_6=v($conn,$L7,3,'联系','liánxì','liên lạc','liên lạc','我们经常联系。','Wǒmen jīngcháng liánxì.','Chúng tôi thường xuyên liên lạc.','verb','Giữ liên lạc với nhau.',++$v7);
$v7_7=v($conn,$L7,3,'变化','biànhuà','thay đổi','thay đổi','这几年变化很大。','Zhè jǐ nián biànhuà hěn dà.','Mấy năm nay thay đổi rất lớn.','verb/noun','Biến đổi về mặt nào đó.',++$v7);
$v7_8=v($conn,$L7,3,'感情','gǎnqíng','tình cảm','tình cảm','我们的感情很好。','Wǒmen de gǎnqíng hěn hǎo.','Tình cảm của chúng tôi rất tốt.','noun','Quan hệ tình cảm.',++$v7);
$v7_9=v($conn,$L7,3,'结婚','jiéhūn','kết hôn','cưới','他们去年结婚了。','Tāmen qùnián jiéhūn le.','Họ năm ngoái đã kết hôn.','verb','Động từ phân ly.',++$v7);
// Grammar L7
$g7_1=g($conn,$L7,'V + 了 + Thời gian','Động từ + 了 + Thời gian (+ 了)','Hành động kéo dài bao lâu','Thời gian đặt sau động từ chỉ khoảng thời gian hành động đã diễn ra. Nếu vẫn tiếp diễn đến hiện tại thì thêm 了 cuối câu.','我学汉语学了一年 (đã học 1 năm - hiện có thể không học nữa). 我学了一年了 (vẫn đang học đến bây giờ).',1);
ge($conn,$g7_1,'我跟她都认识五年了。','Wǒ gēn tā dōu rènshi wǔ nián le.','Tôi và cô ấy quen nhau 5 năm rồi.',1);
ge($conn,$g7_1,'他在北京住了三年。','Tā zài Běijīng zhù le sān nián.','Anh ấy ở Bắc Kinh 3 năm.',2);
$g7_2=g($conn,$L7,'Giới từ 跟 và 和','跟/和 + Người + (一起) + Động từ','Với ai, cùng ai','跟 và 和 có nghĩa tương tự nhau, đều mang nghĩa với, cùng. 跟 thường dùng trong khẩu ngữ hơn. Có thể kết hợp với 一起 để nhấn mạnh.','Phủ định: 不跟/不和 + Người + V.',2);
ge($conn,$g7_2,'我想跟你谈谈。','Wǒ xiǎng gēn nǐ tántan.','Tôi muốn nói chuyện với bạn.',1);
ge($conn,$g7_2,'他和我是好朋友。','Tā hé wǒ shì hǎo péngyou.','Anh ấy và tôi là bạn tốt.',2);
$g7_3=g($conn,$L7,'Phó từ 一直','一直 + V/Adj','Luôn luôn, mãi mãi','Diễn tả hành động hoặc trạng thái liên tục từ quá khứ đến hiện tại, không thay đổi. Phủ định: 一直没/不.','一直很忙 = Luôn luôn bận.',3);
ge($conn,$g7_3,'她一直很努力。','Tā yìzhí hěn nǔlì.','Cô ấy luôn rất chăm chỉ.',1);
ge($conn,$g7_3,'我一直没见到他。','Wǒ yìzhí méi jiàndào tā.','Tôi mãi chưa gặp được anh ấy.',2);
// Dialogues L7
$d7_1=d($conn,$L7,'Ban cu lau ngay','Nói về bạn cũ lâu ngày.',1);
ds($conn,$d7_1,'Anna','你认识小丽多久了？','Nǐ rènshi Xiǎo Lì duōjiǔ le?','Bạn quen Tiểu Lệ bao lâu rồi?',1);
ds($conn,$d7_1,'Xiao Ming','我跟她都认识五年了。时间过得真快！','Wǒ gēn tā dōu rènshi wǔ nián le. Shíjiān guò de zhēn kuài!','Tôi và cô ấy quen nhau 5 năm rồi. Thời gian trôi nhanh thật!',2);
ds($conn,$d7_1,'Anna','你们经常见面吗？','Nǐmen jīngcháng jiànmiàn ma?','Các bạn thường gặp nhau không?',3);
ds($conn,$d7_1,'Xiao Ming','以前经常见，最近她搬家了，见面少了。','Yǐqián jīngcháng jiàn, zuìjìn tā bānjiā le, jiànmiàn shǎo le.','Trước hay gặp, gần đây cô ấy chuyển nhà, ít gặp hơn.',4);
ds($conn,$d7_1,'Anna','那你们还联系吗？','Nà nǐmen hái liánxì ma?','Vậy các bạn còn liên lạc không?',5);
ds($conn,$d7_1,'Xiao Ming','当然，我们一直有联系。','Dāngrán, wǒmen yìzhí yǒu liánxì.','Đương nhiên, chúng tôi vẫn luôn liên lạc.',6);
$d7_2=d($conn,$L7,'Su thay doi sau 5 nam','Nói về sự thay đổi sau 5 năm.',2);
ds($conn,$d7_2,'Anna','五年没见，你的变化真大！','Wǔ nián méi jiàn, nǐ de biànhuà zhēn dà!','5 năm không gặp, thay đổi của bạn thật lớn!',1);
ds($conn,$d7_2,'Xiao Ming','是啊，我结婚了，有了孩子。','Shì a, wǒ jiéhūn le, yǒu le háizi.','Ừ, tôi kết hôn rồi, có con rồi.',2);
ds($conn,$d7_2,'Anna','恭喜你！你们的感情一定很好。','Gōngxǐ nǐ! Nǐmen de gǎnqíng yídìng hěn hǎo.','Chúc mừng bạn! Tình cảm các bạn nhất định rất tốt.',3);
ds($conn,$d7_2,'Xiao Ming','谢谢。你怎么样？结婚了吗？','Xièxie. Nǐ zěnme yàng? Jiéhūn le ma?','Cảm ơn. Bạn thế nào? Kết hôn chưa?',4);
ds($conn,$d7_2,'Anna','还没有，一直忙着工作。','Hái méiyǒu, yìzhí máng zhe gōngzuò.','Chưa, vẫn luôn bận rộn với công việc.',5);
// Reading L7
r($conn,$L7,'5 nam quen biet','我跟小王认识五年了。我们是大学同学，那时候每天一起上课、一起吃饭。毕业后我来了北京工作，他去了上海。虽然见面少了，但我们一直有联系。这五年大家变化都很大。我结婚了，他也有了女朋友。每次打电话，我们都会聊很久。感情还是跟以前一样好。希望我们能一直做朋友。','Wǒ gēn Xiǎo Wáng rènshi wǔ nián le. Wǒmen shì dàxué tóngxué, nà shíhou měitiān yīqǐ shàngkè, yīqǐ chīfàn. Bìyè hòu wǒ lái le Běijīng gōngzuò, tā qù le Shànghǎi. Suīrán jiànmiàn shǎo le, dàn wǒmen yìzhí yǒu liánxì. Zhè wǔ nián dàjiā biànhuà dōu hěn dà. Wǒ jiéhūn le, tā yě yǒu le nǚpéngyou. Měi cì dǎ diànhuà, wǒmen dōu huì liáo hěn jiǔ. Gǎnqíng háishì gēn yǐqián yíyàng hǎo. Xīwàng wǒmen néng yìzhí zuò péngyou.','Tôi và Tiểu Vương quen nhau 5 năm rồi. Chúng tôi là bạn đại học, hồi đó mỗi ngày cùng lên lớp, cùng ăn cơm. Sau khi tốt nghiệp tôi đến Bắc Kinh làm việc, anh ấy đi Thượng Hải. Tuy ít gặp nhưng chúng tôi vẫn luôn liên lạc. 5 năm nay mọi người đều thay đổi rất nhiều. Tôi kết hôn rồi, anh ấy cũng có bạn gái. Mỗi lần gọi điện, chúng tôi đều nói chuyện rất lâu. Tình cảm vẫn tốt như trước. Hy vọng chúng tôi mãi làm bạn.','easy',120,1);
// Listening L7
$L7l=l($conn,$L7,'Ban cu','A:你跟小王认识多久了？B:快十年了。A:这么久！你们怎么认识的？B:我们是大学同学。A:现在还在一个城市吗？B:不在一起了，但是一直有联系。A:感情真好。','A:Nǐ gēn Xiǎo Wáng rènshi duōjiǔ le? B:Kuài shí nián le. A:Zhème jiǔ! Nǐmen zěnme rènshi de? B:Wǒmen shì dàxué tóngxué. A:Xiànzài hái zài yí ge chéngshì ma? B:Bú zài yīqǐ le, dànshì yìzhí yǒu liánxì. A:Gǎnqíng zhēn hǎo.','A:Bạn với Tiểu Vương quen bao lâu rồi? B:Sắp 10 năm rồi. A:Lâu vậy! Các bạn quen thế nào? B:Chúng tôi là bạn đại học. A:Bây giờ còn cùng thành phố không? B:Không cùng nữa, nhưng vẫn luôn liên lạc. A:Tình cảm thật tốt.','1');
lq($conn,$L7l,'Họ quen nhau bao lâu rồi?','{"A":"5 năm","B":"Sắp 10 năm","C":"1 năm"}','Sắp 10 năm','Sắp 10 năm rồi.','multiple_choice',1);
lq($conn,$L7l,'Họ quen nhau ở đâu?','{"A":"Công ty","B":"Đại học","C":"Trung học"}','Đại học','Là bạn đại học.','multiple_choice',2);
// Exercises L7
$E7_1=e($conn,$L7,'Chọn đáp án','"Với" trong tiếng Trung là:','multiple_choice','easy',1,'A',1);
eo($conn,$E7_1,'跟 / 和','A',1,1); eo($conn,$E7_1,'对 / 给','B',0,2); eo($conn,$E7_1,'从 / 在','C',0,3);
$E7_2=e($conn,$L7,'Dịch','"Tôi quen cô ấy 5 năm rồi."','translation','easy',1,'我认识她五年了。',2);
$E7_3=e($conn,$L7,'Điền từ','我___他是好朋友。(với)','fill_blank','easy',1,'跟',3);
$E7_4=e($conn,$L7,'Sắp xếp câu','认识 / 她 / 我 / 三年 / 了','sentence_order','easy',1,'我认识她三年了。',4);
$E7_5=e($conn,$L7,'Chọn đúng/sai','"一直" chỉ hành động đã kết thúc.','true_false','easy',1,'false',5);
eo($conn,$E7_5,'Đúng','A',0,1); eo($conn,$E7_5,'Sai','B',1,2);
$E7_6=e($conn,$L7,'Điền từ','我们很久没___了。(gặp mặt)','fill_blank','easy',1,'见面',6);
$E7_7=e($conn,$L7,'Chọn đáp án','"V + 了 + Thời gian" diễn tả:','multiple_choice','easy',1,'B',7);
eo($conn,$E7_7,'Hành động tương lai','A',0,1); eo($conn,$E7_7,'Hành động kéo dài bao lâu','B',1,2); eo($conn,$E7_7,'Hành động lặp lại','C',0,3);
$E7_8=e($conn,$L7,'Điền từ','我们一直有___系。(liên lạc)','fill_blank','easy',1,'联',8);
// Review L7
foreach ([$v7_1,$v7_2,$v7_3,$v7_4,$v7_5,$v7_6,$v7_7,$v7_8,$v7_9] as $i=>$vid) if ($vid) rv($conn,$L7,$vid,'core',$i+1);
echo " HSK3 L7 done: $v7 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 8 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L8: 我的腿越来越疼了
// ═══════════════════════════════════════════════════
$L8=createLesson($conn,3,8,'Bài 8: Wo de tui yue lai yue teng le - Chân tôi càng ngày càng đau','Sức khỏe, bệnh tật, đi khám bác sĩ.','["Suc khoe","Benh tat","Bac si"]','Suc khoe','easy','HSK3 Bài 8: 越来越 review (càng ngày càng đau). Động từ tình thái 可能 (có thể). Bổ ngữ 得 + Adj/Adv (đến mức). Từ vựng: tuǐ (chân), téng (đau), yīshēng (bác sĩ), jiǎnchá (kiểm tra), yào (thuốc), xiūxi (nghỉ ngơi).');
$v8=0;
$v8_1=v($conn,$L8,3,'腿','tuǐ','chân','chân','我的腿很疼。','Wǒ de tuǐ hěn téng.','Chân tôi rất đau.','noun','Bộ phận cơ thể.',++$v8);
$v8_2=v($conn,$L8,3,'疼','téng','đau','đau','我头疼。','Wǒ tóu téng.','Tôi đau đầu.','adj/verb','Cảm giác đau đớn.',++$v8);
$v8_3=v($conn,$L8,3,'可能','kěnéng','có thể','có thể','他可能生病了。','Tā kěnéng shēngbìng le.','Anh ấy có thể bị ốm.','adv/verb','Khả năng xảy ra.',++$v8);
$v8_4=v($conn,$L8,3,'医生','yīshēng','bác sĩ','bác sĩ','医生说我需要休息。','Yīshēng shuō wǒ xūyào xiūxi.','Bác sĩ nói tôi cần nghỉ ngơi.','noun','Người chữa bệnh.',++$v8);
$v8_5=v($conn,$L8,3,'医院','yīyuàn','bệnh viện','bệnh viện','我去医院检查。','Wǒ qù yīyuàn jiǎnchá.','Tôi đi bệnh viện kiểm tra.','noun','Nơi khám chữa bệnh.',++$v8);
$v8_6=v($conn,$L8,3,'检查','jiǎnchá','kiểm tra, khám','kiểm tra','医生给我做了检查。','Yīshēng gěi wǒ zuò le jiǎnchá.','Bác sĩ đã khám cho tôi.','verb','Khám bệnh, kiểm tra.',++$v8);
$v8_7=v($conn,$L8,3,'药','yào','thuốc','thuốc','我吃药了。','Wǒ chī yào le.','Tôi đã uống thuốc.','noun','Thuốc chữa bệnh.',++$v8);
$v8_8=v($conn,$L8,3,'严重','yánzhòng','nghiêm trọng','nghiêm trọng','问题不严重。','Wèntí bù yánzhòng.','Vấn đề không nghiêm trọng.','adj','Mức độ nặng.',++$v8);
$v8_9=v($conn,$L8,3,'休息','xiūxi','nghỉ ngơi','nghỉ','你得多休息。','Nǐ děi duō xiūxi.','Bạn phải nghỉ ngơi nhiều.','verb','Nghỉ ngơi, thư giãn.',++$v8);
// Grammar L8
$g8_1=g($conn,$L8,'越来越 + Adj (ôn tập)','越来越 + Tính từ','Càng ngày càng...','越来越 là cấu trúc so sánh tăng tiến, chỉ mức độ tăng dần theo thời gian. Thường có 了 ở cuối câu. Dùng với tính từ hoặc động từ tâm lý.','越来越疼 = càng ngày càng đau.',1);
ge($conn,$g8_1,'我的腿越来越疼了。','Wǒ de tuǐ yuè lái yuè téng le.','Chân tôi càng ngày càng đau.',1);
ge($conn,$g8_1,'你的身体越来越好。','Nǐ de shēntǐ yuè lái yuè hǎo.','Cơ thể bạn càng ngày càng tốt.',2);
$g8_2=g($conn,$L8,'Động từ tình thái 可能','可能 + Động từ/Tính từ / 可能 + Câu','Có thể (phỏng đoán)','可能 diễn tả khả năng, phỏng đoán về sự việc. Có thể đứng trước động từ, tính từ hoặc đầu câu. Phủ định: 不可能.','可能要下雨了 = Có thể sắp mưa.',2);
ge($conn,$g8_2,'他可能生病了。','Tā kěnéng shēngbìng le.','Anh ấy có thể bị ốm rồi.',1);
ge($conn,$g8_2,'这可能不是真的。','Zhè kěnéng bú shì zhēn de.','Cái này có thể không phải thật.',2);
$g8_3=g($conn,$L8,'Bổ ngữ mức độ: V + 得 + Adj','Động từ + 得 + Tính từ (+ 了)','Làm gì đến mức nào','Bổ ngữ mức độ dùng 得 để kết nối động từ với tính từ miêu tả mức độ. Có thể thêm 了 để chỉ sự thay đổi trạng thái.','疼得厉害 = đau đến mức dữ dội.',3);
ge($conn,$g8_3,'他疼得走不了路。','Tā téng de zǒu bù liǎo lù.','Anh ấy đau đến mức không đi được.',1);
ge($conn,$g8_3,'她高兴得跳了起来。','Tā gāoxìng de tiào le qǐlai.','Cô ấy vui đến mức nhảy lên.',2);
// Dialogues L8
$d8_1=d($conn,$L8,'Chan bi dau','Nói về chân bị đau.',1);
ds($conn,$d8_1,'Anna','你走路怎么一拐一拐的？','Nǐ zǒulù zěnme yì guǎi yì guǎi de?','Sao bạn đi khập khiễng thế?',1);
ds($conn,$d8_1,'Xiao Ming','我的腿越来越疼了，可能昨天运动太多了。','Wǒ de tuǐ yuè lái yuè téng le, kěnéng zuótiān yùndòng tài duō le.','Chân tôi càng ngày càng đau, có thể hôm qua vận động nhiều quá.',2);
ds($conn,$d8_1,'Anna','严不严重？去看医生了吗？','Yán bù yánzhòng? Qù kàn yīshēng le ma?','Có nghiêm trọng không? Đi khám bác sĩ chưa?',3);
ds($conn,$d8_1,'Xiao Ming','还没去，我想休息一下看看。','Hái méi qù, wǒ xiǎng xiūxi yíxià kànkan.','Chưa, tôi muốn nghỉ ngơi một chút xem sao.',4);
ds($conn,$d8_1,'Anna','别等了，还是去医院检查一下吧。','Bié děng le, háishì qù yīyuàn jiǎnchá yíxià ba.','Đừng chờ nữa, vẫn nên đi bệnh viện kiểm tra đi.',5);
$d8_2=d($conn,$L8,'Kham bac si','Khám bác sĩ.',2);
ds($conn,$d8_2,'Y sĩ','你哪里不舒服？','Nǐ nǎlǐ bù shūfu?','Bạn chỗ nào không thoải mái?',1);
ds($conn,$d8_2,'Xiao Ming','我的腿很疼，可能伤到了。','Wǒ de tuǐ hěn téng, kěnéng shāng dào le.','Chân tôi rất đau, có thể bị thương.',2);
ds($conn,$d8_2,'Y sĩ','我给你检查一下。这里疼吗？','Wǒ gěi nǐ jiǎnchá yíxià. Zhèlǐ téng ma?','Tôi kiểm tra cho bạn. Chỗ này đau không?',3);
ds($conn,$d8_2,'Xiao Ming','对对，就是这儿疼得厉害。','Duì duì, jiùshì zhèr téng de lìhai.','Đúng đúng, chính chỗ này đau dữ dội.',4);
ds($conn,$d8_2,'Y sĩ','问题不大，我开点药给你。多休息，别剧烈运动。','Wèntí bú dà, wǒ kāi diǎn yào gěi nǐ. Duō xiūxi, bié jùliè yùndòng.','Vấn đề không lớn, tôi kê ít thuốc cho bạn. Nghỉ ngơi nhiều, đừng vận động mạnh.',5);
// Reading L8
r($conn,$L8,'Di kham benh','上个星期我打篮球以后，腿开始疼了。我以为是小事，没有去医院。但是这几天越来越疼，走路都疼得受不了。今天妈妈陪我去了医院。医生给我做了检查，说问题不严重，只是肌肉拉伤。医生开了药，让我多休息。现在吃了药好多了。以后运动前我一定要先做准备活动。','Shàng ge xīngqī wǒ dǎ lánqiú yǐhòu, tuǐ kāishǐ téng le. Wǒ yǐwéi shì xiǎoshì, méiyǒu qù yīyuàn. Dànshì zhè jǐ tiān yuè lái yuè téng, zǒulù dōu téng de shòu bù liǎo. Jīntiān māma péi wǒ qù le yīyuàn. Yīshēng gěi wǒ zuò le jiǎnchá, shuō wèntí bù yánzhòng, zhǐshì jīròu lāshāng. Yīshēng kāi le yào, ràng wǒ duō xiūxi. Xiànzài chī le yào hǎo duō le. Yǐhòu yùndòng qián wǒ yídìng yào xiān zuò zhǔnbèi huódòng.','Tuần trước tôi chơi bóng rổ xong, chân bắt đầu đau. Tôi tưởng là chuyện nhỏ, không đi bệnh viện. Nhưng mấy ngày nay càng ngày càng đau, đi lại cũng đau chịu không nổi. Hôm nay mẹ đưa tôi đi bệnh viện. Bác sĩ khám cho tôi, nói vấn đề không nghiêm trọng, chỉ là căng cơ. Bác sĩ kê thuốc, bảo tôi nghỉ ngơi nhiều. Bây giờ uống thuốc đỡ nhiều rồi. Sau này trước khi vận động tôi nhất định phải làm khởi động trước.','easy',120,1);
// Listening L8
$L8l=l($conn,$L8,'Kham benh','A:你怎么了？看起来不舒服。B:我头疼得厉害。A:可能感冒了。去医院看看吧。B:已经看过了，医生开了药。A:那你好好休息，别太累了。B:谢谢关心。','A:Nǐ zěnme le? Kàn qǐlai bù shūfu. B:Wǒ tóu téng de lìhai. A:Kěnéng gǎnmào le. Qù yīyuàn kànkan ba. B:Yǐjīng kàn guò le, yīshēng kāi le yào. A:Nà nǐ hǎohāo xiūxi, bié tài lèi le. B:Xièxie guānxīn.','A:Bạn làm sao thế? Trông không khỏe. B:Tôi đau đầu dữ dội. A:Có thể cảm rồi. Đi bệnh viện xem đi. B:Xem rồi, bác sĩ kê thuốc rồi. A:Vậy bạn nghỉ ngơi tốt nhé, đừng mệt quá. B:Cảm ơn quan tâm.','1');
lq($conn,$L8l,'Người B bị làm sao?','{"A":"Đau bụng","B":"Đau đầu","C":"Đau chân"}','Đau đầu','Đau đầu dữ dội.','multiple_choice',1);
lq($conn,$L8l,'Bác sĩ đã làm gì?','{"A":"Không làm gì","B":"Kê thuốc","C":"Nhập viện"}','Kê thuốc','Bác sĩ kê thuốc.','multiple_choice',2);
// Exercises L8
$E8_1=e($conn,$L8,'Chọn đáp án','"Đau" là:','multiple_choice','easy',1,'A',1);
eo($conn,$E8_1,'疼','A',1,1); eo($conn,$E8_1,'痛','B',0,2); eo($conn,$E8_1,'病','C',0,3);
$E8_2=e($conn,$L8,'Dịch','"Có thể trời sắp mưa."','translation','easy',1,'可能要下雨了。',2);
$E8_3=e($conn,$L8,'Điền từ','我的腿越___越疼。(càng)','fill_blank','easy',1,'来',3);
$E8_4=e($conn,$L8,'Sắp xếp câu','可能 / 他 / 生病 / 了 /  /  / ','sentence_order','easy',1,'他可能生病了。',4);
$E8_5=e($conn,$L8,'Chọn đúng/sai','"严重" có nghĩa là "nhẹ".','true_false','easy',1,'false',5);
eo($conn,$E8_5,'Đúng','A',0,1); eo($conn,$E8_5,'Sai','B',1,2);
$E8_6=e($conn,$L8,'Điền từ','医生___了药。(kê đơn)','fill_blank','easy',1,'开',6);
$E8_7=e($conn,$L8,'Chọn đáp án','"得" trong "疼得厉害" có nghĩa:','multiple_choice','easy',1,'B',7);
eo($conn,$E8_7,'Sở hữu','A',0,1); eo($conn,$E8_7,'Bổ ngữ mức độ','B',1,2); eo($conn,$E8_7,'Động từ','C',0,3);
$E8_8=e($conn,$L8,'Điền từ','你需要多___息。(nghỉ)','fill_blank','easy',1,'休',8);
// Review L8
foreach ([$v8_1,$v8_2,$v8_3,$v8_4,$v8_5,$v8_6,$v8_7,$v8_8,$v8_9] as $i=>$vid) if ($vid) rv($conn,$L8,$vid,'core',$i+1);
echo " HSK3 L8 done: $v8 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 8 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L9: 她是一个很幽默的人
// ═══════════════════════════════════════════════════
$L9=createLesson($conn,3,9,'Bài 9: Ta shi yi ge hen you mo de ren - Cô ấy là một người rất hài hước','Miêu tả tính cách con người, định ngữ tính từ.','["Tinh cach","Mieu ta nguoi","Dinh ngu"]','Tinh cach','easy','HSK3 Bài 9: Tính từ làm định ngữ: Adj + 的 + Danh từ. Cấu trúc 又...又... (vừa...vừa... cho tính chất). Từ vựng tính cách: yōumò (hài hước), xìnggé (tính cách), kāilǎng (cởi mở), lèguān (lạc quan), wēnróu (dịu dàng), shànliáng (lương thiện).');
$v9=0;
$v9_1=v($conn,$L9,3,'幽默','yōumò','hài hước','hài hước','他是一个很幽默的人。','Tā shì yí ge hěn yōumò de rén.','Anh ấy là một người rất hài hước.','adj','Tính từ chỉ sự hài hước.',++$v9);
$v9_2=v($conn,$L9,3,'性格','xìnggé','tính cách','tính cách','她的性格很开朗。','Tā de xìnggé hěn kāilǎng.','Tính cách cô ấy rất cởi mở.','noun','Đặc điểm tâm lý.',++$v9);
$v9_3=v($conn,$L9,3,'开朗','kāilǎng','cởi mở, sảng khoái','cởi mở','她是一个开朗的女孩。','Tā shì yí ge kāilǎng de nǚhái.','Cô ấy là một cô gái cởi mở.','adj','Tính cách vui vẻ, hòa đồng.',++$v9);
$v9_4=v($conn,$L9,3,'乐观','lèguān','lạc quan','lạc quan','他对待生活很乐观。','Tā duìdài shēnghuó hěn lèguān.','Anh ấy đối xử với cuộc sống rất lạc quan.','adj','Luôn nhìn mặt tích cực.',++$v9);
$v9_5=v($conn,$L9,3,'稳重','wěnzhòng','chín chắn, điềm tĩnh','chín chắn','他做事很稳重。','Tā zuòshì hěn wěnzhòng.','Anh ấy làm việc rất chín chắn.','adj','Tính cách ổn định.',++$v9);
$v9_6=v($conn,$L9,3,'成熟','chéngshú','trưởng thành','trưởng thành','她比同龄人成熟。','Tā bǐ tónglíng rén chéngshú.','Cô ấy trưởng thành hơn bạn cùng tuổi.','adj','Phát triển đầy đủ.',++$v9);
$v9_7=v($conn,$L9,3,'温柔','wēnróu','dịu dàng','dịu dàng','她说话很温柔。','Tā shuōhuà hěn wēnróu.','Cô ấy nói chuyện rất dịu dàng.','adj','Ân cần, nhẹ nhàng.',++$v9);
$v9_8=v($conn,$L9,3,'善良','shànliáng','lương thiện','tốt bụng','她是一个善良的人。','Tā shì yí ge shànliáng de rén.','Cô ấy là một người tốt bụng.','adj','Có lòng tốt.',++$v9);
$v9_9=v($conn,$L9,3,'聪明','cōngming','thông minh','thông minh','这个孩子很聪明。','Zhè ge háizi hěn cōngming.','Đứa trẻ này rất thông minh.','adj','Trí tuệ tốt.',++$v9);
// Grammar L9
$g9_1=g($conn,$L9,'Tính từ làm định ngữ: Adj + 的 + Danh từ','Tính từ + 的 + Danh từ','Một người/vật như thế nào','Trong tiếng Trung, tính từ đứng trước danh từ để bổ nghĩa, cần thêm 的 giữa tính từ và danh từ. Với tính từ đơn âm tiết thường không cần 的.','很幽默的人 = người rất hài hước. 好书 = sách tốt.',1);
ge($conn,$g9_1,'她是一个很幽默的人。','Tā shì yí ge hěn yōumò de rén.','Cô ấy là một người rất hài hước.',1);
ge($conn,$g9_1,'我喜欢开朗的朋友。','Wǒ xǐhuan kāilǎng de péngyou.','Tôi thích bạn bè cởi mở.',2);
$g9_2=g($conn,$L9,'Cấu trúc 又...又...','又 + Tính từ1 + 又 + Tính từ2','Vừa... vừa... (hai tính chất song song)','又...又... nối hai tính từ hoặc cụm tính từ để chỉ một người/vật có hai đặc điểm cùng lúc. Không dùng cho động từ.','她又聪明又漂亮 = Cô ấy vừa thông minh vừa xinh đẹp.',2);
ge($conn,$g9_2,'她又温柔又善良。','Tā yòu wēnróu yòu shànliáng.','Cô ấy vừa dịu dàng vừa tốt bụng.',1);
ge($conn,$g9_2,'他既幽默又稳重。','Tā jì yōumò yòu wěnzhòng.','Anh ấy vừa hài hước vừa chín chắn.',2);
// Dialogues L9
$d9_1=d($conn,$L9,'Nguoi dong nghiep','Nói về đồng nghiệp.',1);
ds($conn,$d9_1,'Anna','你觉得新来的同事怎么样？','Nǐ juéde xīn lái de tóngshì zěnme yàng?','Bạn thấy đồng nghiệp mới thế nào?',1);
ds($conn,$d9_1,'Xiao Ming','他是一个很幽默的人，大家都很喜欢他。','Tā shì yí ge hěn yōumò de rén, dàjiā dōu hěn xǐhuan tā.','Anh ấy là một người rất hài hước, mọi người đều rất thích anh ấy.',2);
ds($conn,$d9_1,'Anna','他的性格怎么样？','Tā de xìnggé zěnme yàng?','Tính cách anh ấy thế nào?',3);
ds($conn,$d9_1,'Xiao Ming','又开朗又乐观，工作也很稳重。','Yòu kāilǎng yòu lèguān, gōngzuò yě hěn wěnzhòng.','Vừa cởi mở vừa lạc quan, làm việc cũng rất chín chắn.',4);
$d9_2=d($conn,$L9,'Ban tot','Miêu tả bạn thân.',2);
ds($conn,$d9_2,'Anna','你的好朋友是什么样的人？','Nǐ de hǎo péngyou shì shénme yàng de rén?','Bạn thân của bạn là người thế nào?',1);
ds($conn,$d9_2,'Xiao Ming','她是一个非常温柔和善良的人。','Tā shì yí ge fēicháng wēnróu hé shànliáng de rén.','Cô ấy là một người rất dịu dàng và tốt bụng.',2);
ds($conn,$d9_2,'Anna','听起来你们的性格很合得来。','Tīng qǐlai nǐmen de xìnggé hěn hé de lái.','Nghe có vẻ tính cách các bạn rất hợp nhau.',3);
ds($conn,$d9_2,'Xiao Ming','是的，她虽然性格开朗，但做事很成熟。','Shì de, tā suīrán xìnggé kāilǎng, dàn zuòshì hěn chéngshú.','Đúng, cô ấy tuy tính cách cởi mở nhưng làm việc rất trưởng thành.',4);
// Reading L9
r($conn,$L9,'Nguoi ban dac biet','我有一个好朋友叫小张。他是一个很幽默的人，每次和他在一起，我都很开心。他的性格很开朗，对生活很乐观。不管遇到什么问题，他总是笑着说没关系。他做事还很稳重，同事都很信任他。大家都说他是一个又聪明又善良的人。我觉得他是最值得交的朋友。','Wǒ yǒu yí ge hǎo péngyou jiào Xiǎo Zhāng. Tā shì yí ge hěn yōumò de rén, měi cì hé tā zài yīqǐ, wǒ dōu hěn kāixīn. Tā de xìnggé hěn kāilǎng, duì shēnghuó hěn lèguān. Bùguǎn yùdào shénme wèntí, tā zǒngshì xiào zhe shuō méi guānxì. Tā zuòshì hái hěn wěnzhòng, tóngshì dōu hěn xìnrèn tā. Dàjiā dōu shuō tā shì yí ge yòu cōngming yòu shànliáng de rén. Wǒ juéde tā shì zuì zhíde jiāo de péngyou.','Tôi có một người bạn tốt tên là Tiểu Trương. Anh ấy là một người rất hài hước, mỗi lần ở cùng anh ấy tôi đều rất vui. Tính cách anh ấy rất cởi mở, đối với cuộc sống rất lạc quan. Dù gặp vấn đề gì, anh ấy cũng luôn cười nói không sao. Anh ấy làm việc còn rất chín chắn, đồng nghiệp đều tin tưởng. Mọi người nói anh ấy là người vừa thông minh vừa tốt bụng. Tôi thấy anh ấy là người bạn đáng kết nhất.','easy',115,1);
// Listening L9
$L9l=l($conn,$L9,'Mieu ta nguoi','A:你觉得小李这个人怎么样？B:她性格特别好，又温柔又善良。A:她幽默吗？B:不太幽默，但是她很乐观。A:那她做事怎么样？B:很稳重成熟，我有什么事都喜欢找她商量。','A:Nǐ juéde Xiǎo Lǐ zhè ge rén zěnme yàng? B:Tā xìnggé tèbié hǎo, yòu wēnróu yòu shànliáng. A:Tā yōumò ma? B:Bú tài yōumò, dànshì tā hěn lèguān. A:Nà tā zuòshì zěnme yàng? B:Hěn wěnzhòng chéngshú, wǒ yǒu shénme shì dōu xǐhuan zhǎo tā shāngliang.','A:Bạn thấy Tiểu Lý là người thế nào? B:Tính cách cô ấy rất tốt, vừa dịu dàng vừa tốt bụng. A:Cô ấy có hài hước không? B:Không hài hước lắm, nhưng cô ấy rất lạc quan. A:Cô ấy làm việc thế nào? B:Rất chín chắn trưởng thành, tôi có chuyện gì đều thích tìm cô ấy bàn bạc.','1');
lq($conn,$L9l,'Tiểu Lý là người thế nào?','{"A":"Khó tính","B":"Dịu dàng và tốt bụng","C":"Nóng tính"}','Dịu dàng và tốt bụng','Vừa dịu dàng vừa tốt bụng.','multiple_choice',1);
lq($conn,$L9l,'Tiểu Lý có hài hước không?','{"A":"Rất hài hước","B":"Bình thường","C":"Không hài hước lắm"}','Không hài hước lắm','Không hài hước lắm.','multiple_choice',2);
// Exercises L9
$E9_1=e($conn,$L9,'Chọn đáp án','"Một người hài hước" là:','multiple_choice','easy',1,'B',1);
eo($conn,$E9_1,'一个幽默人','A',0,1); eo($conn,$E9_1,'一个幽默的人','B',1,2); eo($conn,$E9_1,'一个很幽默','C',0,3);
$E9_2=e($conn,$L9,'Dịch','"Cô ấy là một người rất dịu dàng."','translation','easy',1,'她是一个很温柔的人。',2);
$E9_3=e($conn,$L9,'Điền từ','她是一个很幽默___人。(của)','fill_blank','easy',1,'的',3);
$E9_4=e($conn,$L9,'Sắp xếp câu','又 / 开朗 / 她 / 又 / 乐观 /  ','sentence_order','easy',1,'她又开朗又乐观。',4);
$E9_5=e($conn,$L9,'Chọn đúng/sai','"性格" có nghĩa là "tính cách".','true_false','easy',1,'true',5);
eo($conn,$E9_5,'Đúng','A',1,1); eo($conn,$E9_5,'Sai','B',0,2);
$E9_6=e($conn,$L9,'Điền từ','她是一个很___默的人。(hài hước)','fill_blank','easy',1,'幽',6);
$E9_7=e($conn,$L9,'Chọn đáp án','"又...又..." dùng để:','multiple_choice','easy',1,'A',7);
eo($conn,$E9_7,'Nối hai tính chất song song','A',1,1); eo($conn,$E9_7,'Nối hai động từ','B',0,2); eo($conn,$E9_7,'Nối hai danh từ','C',0,3);
$E9_8=e($conn,$L9,'Điền từ','她___温柔又善良。(vừa)','fill_blank','easy',1,'又',8);
// Review L9
foreach ([$v9_1,$v9_2,$v9_3,$v9_4,$v9_5,$v9_6,$v9_7,$v9_8,$v9_9] as $i=>$vid) if ($vid) rv($conn,$L9,$vid,'core',$i+1);
echo " HSK3 L9 done: $v9 vocab, 2 grammar, 2 dialogues, 1 reading, 1 listening, 8 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L10: 数学比历史难多了
// ═══════════════════════════════════════════════════
$L10=createLesson($conn,3,10,'Bài 10: Shu xue bi li shi nan duo le - Toán khó hơn lịch sử nhiều','So sánh hơn kém, môn học, thi cử.','["So sanh","Mon hoc","Thi cu"]','So sanh','easy','HSK3 Bài 10: Câu so sánh với 比: A 比 B + Adj + 多了/一点儿. So sánh phủ định: 没有...那么.... Từ vựng: shùxué (toán), lìshǐ (lịch sử), bǐ (so với), róngyì (dễ), nán (khó), chéngjì (thành tích), kǎoshì (thi), fùxí (ôn tập).');
$v10=0;
$v10_1=v($conn,$L10,3,'比','bǐ','so với','so với','我比他高。','Wǒ bǐ tā gāo.','Tôi cao hơn anh ấy.','prep','Giới từ so sánh hơn.',++$v10);
$v10_2=v($conn,$L10,3,'数学','shùxué','toán học','toán','我喜欢数学。','Wǒ xǐhuan shùxué.','Tôi thích toán.','noun','Môn học.',++$v10);
$v10_3=v($conn,$L10,3,'历史','lìshǐ','lịch sử','lịch sử','历史课很有意思。','Lìshǐ kè hěn yǒu yìsi.','Tiết lịch sử rất thú vị.','noun','Môn lịch sử.',++$v10);
$v10_4=v($conn,$L10,3,'英语','Yīngyǔ','tiếng Anh','tiếng Anh','他的英语很好。','Tā de Yīngyǔ hěn hǎo.','Tiếng Anh của anh ấy rất tốt.','noun','Ngôn ngữ Anh.',++$v10);
$v10_5=v($conn,$L10,3,'容易','róngyì','dễ dàng','dễ','这个考试很容易。','Zhè ge kǎoshì hěn róngyì.','Bài thi này rất dễ.','adj','Trái nghĩa với 难.',++$v10);
$v10_6=v($conn,$L10,3,'难','nán','khó','khó','汉语很难吗？','Hànyǔ hěn nán ma?','Tiếng Trung có khó không?','adj','Trái nghĩa với 容易.',++$v10);
$v10_7=v($conn,$L10,3,'成绩','chéngjì','thành tích, điểm số','điểm','我的成绩不错。','Wǒ de chéngjì búcuò.','Thành tích của tôi không tồi.','noun','Kết quả học tập.',++$v10);
$v10_8=v($conn,$L10,3,'考试','kǎoshì','thi, bài thi','thi','下个星期有考试。','Xià ge xīngqī yǒu kǎoshì.','Tuần sau có bài thi.','noun/verb','Kỳ thi.',++$v10);
$v10_9=v($conn,$L10,3,'复习','fùxí','ôn tập','ôn tập','我在复习汉语。','Wǒ zài fùxí Hànyǔ.','Tôi đang ôn tập tiếng Trung.','verb','Ôn lại bài cũ.',++$v10);
// Grammar L10
$g10_1=g($conn,$L10,'So sánh: A 比 B + Adj + 多了/一点儿','A 比 B + Tính từ + 多了/一点儿','A hơn B nhiều/một chút','比 là giới từ so sánh. Tính từ đứng sau B. 多了 chỉ mức độ chênh lệch lớn. 一点儿 chỉ mức độ chênh lệch nhỏ.','Phủ định dùng 没有: A 没有 B + Adj (A không bằng B).',1);
ge($conn,$g10_1,'数学比历史难多了。','Shùxué bǐ lìshǐ nán duō le.','Toán khó hơn lịch sử nhiều.',1);
ge($conn,$g10_1,'今天比昨天冷一点儿。','Jīntiān bǐ zuótiān lěng yì diǎnr.','Hôm nay lạnh hơn hôm qua một chút.',2);
$g10_2=g($conn,$L10,'So sánh cơ bản: A 比 B + Adj','A 比 B + Tính từ','A hơn B','Dạng cơ bản không có mức độ. Nếu tính từ đơn âm, không dùng 很. Có thể thêm số: 大/小 + số (tuổi).','我比他大两岁 = Tôi lớn hơn anh ấy 2 tuổi.',2);
ge($conn,$g10_2,'我比我弟弟高。','Wǒ bǐ wǒ dìdi gāo.','Tôi cao hơn em trai tôi.',1);
ge($conn,$g10_2,'学汉语比学英语难。','Xué Hànyǔ bǐ xué Yīngyǔ nán.','Học tiếng Trung khó hơn học tiếng Anh.',2);
$g10_3=g($conn,$L10,'So sánh phủ định: 没有...那么...','A 没有 B (那么) + Tính từ','A không bằng B','没有 dùng để phủ định so sánh, có nghĩa A không đạt đến mức độ của B. 那么 có thể thêm để nhấn mạnh.','我没有他那么高 = Tôi không cao bằng anh ấy.',3);
ge($conn,$g10_3,'我没有他那么努力。','Wǒ méiyǒu tā nàme nǔlì.','Tôi không chăm chỉ bằng anh ấy.',1);
ge($conn,$g10_3,'英语没有数学那么难。','Yīngyǔ méiyǒu shùxué nàme nán.','Tiếng Anh không khó bằng toán.',2);
// Dialogues L10
$d10_1=d($conn,$L10,'So sanh mon hoc','So sánh các môn học.',1);
ds($conn,$d10_1,'Anna','你觉得数学和英语，哪个难？','Nǐ juéde shùxué hé Yīngyǔ, nǎ ge nán?','Bạn thấy toán và tiếng Anh, môn nào khó hơn?',1);
ds($conn,$d10_1,'Xiao Ming','数学比英语难多了。但是历史最容易。','Shùxué bǐ Yīngyǔ nán duō le. Dànshì lìshǐ zuì róngyì.','Toán khó hơn tiếng Anh nhiều. Nhưng lịch sử là dễ nhất.',2);
ds($conn,$d10_1,'Anna','是吗？我觉得历史比数学难。','Shì ma? Wǒ juéde lìshǐ bǐ shùxué nán.','Thế à? Tôi thấy lịch sử khó hơn toán.',3);
ds($conn,$d10_1,'Xiao Ming','每个人的想法不一样。','Měi ge rén de xiǎngfǎ bù yíyàng.','Mỗi người có cách nghĩ khác nhau.',4);
$d10_2=d($conn,$L10,'On thi','Nói về ôn thi.',2);
ds($conn,$d10_2,'Anna','下个星期要考试了，你复习了吗？','Xià ge xīngqī yào kǎoshì le, nǐ fùxí le ma?','Tuần sau thi rồi, bạn ôn tập chưa?',1);
ds($conn,$d10_2,'Xiao Ming','还没呢。这次数学考试比上次难，我有点担心。','Hái méi ne. Zhè cì shùxué kǎoshì bǐ shàng cì nán, wǒ yǒudiǎn dānxīn.','Chưa. Lần thi toán này khó hơn lần trước, tôi hơi lo.',2);
ds($conn,$d10_2,'Anna','别担心，你的成绩一直比我好。','Bié dānxīn, nǐ de chéngjì yìzhí bǐ wǒ hǎo.','Đừng lo, thành tích của bạn vẫn luôn tốt hơn tôi.',3);
ds($conn,$d10_2,'Xiao Ming','但是这次不一样，我最近没有好好复习。','Dànshì zhè cì bù yíyàng, wǒ zuìjìn méiyǒu hǎohāo fùxí.','Nhưng lần này khác, gần đây tôi không ôn tập tốt.',4);
ds($conn,$d10_2,'Anna','那我们一起复习吧。','Nà wǒmen yīqǐ fùxí ba.','Vậy chúng ta cùng ôn tập nhé.',5);
// Reading L10
r($conn,$L10,'So sanh mon hoc','这个学期我们有四门课：数学、英语、历史和汉语。我觉得数学比历史难多了，但是英语比数学容易一点儿。汉语最难，可是我最喜欢。上次考试我数学得了八十五分，英语得了九十分。历史最容易，我得了九十五分。这次考试我想考得更好，所以每天都在复习。朋友说我比上学期努力多了。','Zhè ge xuéqī wǒmen yǒu sì mén kè: shùxué, Yīngyǔ, lìshǐ hé Hànyǔ. Wǒ juéde shùxué bǐ lìshǐ nán duō le, dànshì Yīngyǔ bǐ shùxué róngyì yì diǎnr. Hànyǔ zuì nán, kěshì wǒ zuì xǐhuan. Shàng cì kǎoshì wǒ shùxué dé le bāshíwǔ fēn, Yīngyǔ dé le jiǔshí fēn. Lìshǐ zuì róngyì, wǒ dé le jiǔshíwǔ fēn. Zhè cì kǎoshì wǒ xiǎng kǎo de gèng hǎo, suǒyǐ měitiān dōu zài fùxí. Péngyou shuō wǒ bǐ shàng xuéqī nǔlì duō le.','Học kỳ này chúng tôi có 4 môn: toán, tiếng Anh, lịch sử và tiếng Trung. Tôi thấy toán khó hơn lịch sử nhiều, nhưng tiếng Anh dễ hơn toán một chút. Tiếng Trung khó nhất, nhưng tôi thích nhất. Lần thi trước tôi toán được 85 điểm, tiếng Anh được 90 điểm. Lịch sử dễ nhất, tôi được 95 điểm. Lần thi này tôi muốn thi tốt hơn nên ngày nào cũng ôn tập. Bạn bè nói tôi chăm chỉ hơn học kỳ trước nhiều.','easy',130,1);
// Listening L10
$L10l=l($conn,$L10,'So sanh diem','A:你这次考试考得怎么样？B:数学考了八十分。A:不错啊，比我考得好。我数学没有你那么好。B:你英语一定比我好。A:对，英语比数学容易多了。B:看来每个人擅长的科目不一样。','A:Nǐ zhè cì kǎoshì kǎo de zěnme yàng? B:Shùxué kǎo le bāshí fēn. A:Búcuò a, bǐ wǒ kǎo de hǎo. Wǒ shùxué méiyǒu nǐ nàme hǎo. B:Nǐ Yīngyǔ yídìng bǐ wǒ hǎo. A:Duì, Yīngyǔ bǐ shùxué róngyì duō le. B:Kànlái měi ge rén shàncháng de kēmù bù yíyàng.','A:Lần thi này bạn thi thế nào? B:Toán được 80 điểm. A:Không tồi, tốt hơn tôi. Toán của tôi không tốt bằng bạn. B:Tiếng Anh của bạn nhất định tốt hơn tôi. A:Đúng, tiếng Anh dễ hơn toán nhiều. B:Xem ra mỗi người giỏi môn khác nhau.','1');
lq($conn,$L10l,'Người B thi toán được bao nhiêu?','{"A":"70","B":"80","C":"90"}','80','Được 80 điểm.','multiple_choice',1);
lq($conn,$L10l,'Người A nói thế nào về môn tiếng Anh?','{"A":"Khó hơn toán","B":"Dễ hơn toán nhiều","C":"Giống toán"}','Dễ hơn toán nhiều','Tiếng Anh dễ hơn toán nhiều.','multiple_choice',2);
// Exercises L10
$E10_1=e($conn,$L10,'Chọn đáp án','"So với" là:','multiple_choice','easy',1,'A',1);
eo($conn,$E10_1,'比','A',1,1); eo($conn,$E10_1,'把','B',0,2); eo($conn,$E10_1,'被','C',0,3);
$E10_2=e($conn,$L10,'Dịch','"Toán khó hơn lịch sử nhiều."','translation','easy',1,'数学比历史难多了。',2);
$E10_3=e($conn,$L10,'Điền từ','我___他高。(so với)','fill_blank','easy',1,'比',3);
$E10_4=e($conn,$L10,'Sắp xếp câu','比 / 数学 / 难 / 英语 / 多了','sentence_order','easy',1,'数学比英语难多了。',4);
$E10_5=e($conn,$L10,'Chọn đúng/sai','"A 没有 B 好" có nghĩa "A tốt hơn B".','true_false','easy',1,'false',5);
eo($conn,$E10_5,'Đúng','A',0,1); eo($conn,$E10_5,'Sai','B',1,2);
$E10_6=e($conn,$L10,'Điền từ','英语比数学容易一___。(một chút)','fill_blank','easy',1,'点儿',6);
$E10_7=e($conn,$L10,'Chọn đáp án','"多" trong "难多了" có tác dụng:','multiple_choice','easy',1,'B',7);
eo($conn,$E10_7,'Chỉ nhiều người','A',0,1); eo($conn,$E10_7,'Nhấn mạnh mức độ chênh lệch lớn','B',1,2); eo($conn,$E10_7,'Chỉ số nhiều','C',0,3);
$E10_8=e($conn,$L10,'Điền từ','下个星期有考___。(thi)','fill_blank','easy',1,'试',8);
// Review L10
foreach ([$v10_1,$v10_2,$v10_3,$v10_4,$v10_5,$v10_6,$v10_7,$v10_8,$v10_9] as $i=>$vid) if ($vid) rv($conn,$L10,$vid,'core',$i+1);
echo " HSK3 L10 done: $v10 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 8 exercises\n";

$conn->exec("SET FOREIGN_KEY_CHECKS=1");
echo "\n HSK3 Lessons 6-10 seeding complete!\n";
