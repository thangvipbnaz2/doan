<?php
/**
 * HÀNNGỮ - HSK2 Content Seeder (Lessons 11-15)
 * HSK Standard Course 2: 300+ words, more complex grammar, 2-3 dialogues/lesson
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK2 L11: 你说得对
// ═══════════════════════════════════════════════════
$L11=createLesson($conn,2,11,'Bài 11: Ni shuo de dui - Bạn nói đúng','Đồng ý, bổ ngữ trạng thái 得. Động từ khuyết thiếu 应该.','["Dong y","Bo ngu trang thai","Dong tu khuyen thieu"]','Dong y','easy','HSK2 Bài 11: Đồng ý và phản đối. Bổ ngữ trạng thái: V + 得 + adj (nói đúng, chạy nhanh). 对 (đúng / đối với). Động từ khuyết thiếu 应该 (nên). Từ vựng: 同意, 意见, 觉得, 认为, 必须, 办法.');
$v11=0;
$v11_1=v($conn,$L11,2,'对','duì','đúng, đối với','đúng','你说得对。','Nǐ shuō de duì.','Bạn nói đúng.','adj/prep','Đúng hoặc đối với.',++$v11);
$v11_2=v($conn,$L11,2,'得','de','trợ từ bổ ngữ','được','跑得快。','Pǎo de kuài.','Chạy nhanh.','particle','Kết nối động từ và bổ ngữ.',++$v11);
$v11_3=v($conn,$L11,2,'同意','tóngyì','đồng ý','đồng ý','我同意。','Wǒ tóngyì.','Tôi đồng ý.','verb','Tán thành ý kiến.',++$v11);
$v11_4=v($conn,$L11,2,'意见','yìjiàn','ý kiến','ý kiến','你的意见。','Nǐ de yìjiàn.','Ý kiến của bạn.','noun','Quan điểm, ý kiến.',++$v11);
$v11_5=v($conn,$L11,2,'觉得','juéde','cảm thấy, nghĩ rằng','thấy','我觉得好。','Wǒ juéde hǎo.','Tôi thấy tốt.','verb','Cảm nhận hoặc ý kiến.',++$v11);
$v11_6=v($conn,$L11,2,'认为','rènwéi','cho rằng','cho rằng','我认为可以。','Wǒ rènwéi kěyǐ.','Tôi cho rằng được.','verb','Ý kiến chủ quan.',++$v11);
$v11_7=v($conn,$L11,2,'应该','yīnggāi','nên, phải','nên','应该去。','Yīnggāi qù.','Nên đi.','verb','Động từ khuyết thiếu.',++$v11);
$v11_8=v($conn,$L11,2,'必须','bìxū','phải, bắt buộc','phải','必须学习。','Bìxū xuéxí.','Phải học.','adv','Bắt buộc phải làm.',++$v11);
$v11_9=v($conn,$L11,2,'办法','bànfǎ','cách, biện pháp','cách','好办法。','Hǎo bànfǎ.','Cách hay.','noun','Phương pháp giải quyết.',++$v11);
// Grammar L11
$g11_1=g($conn,$L11,'Bổ ngữ trạng thái: V + 得 + Adj','Động từ + 得 + Tính từ','Làm gì đó như thế nào','Bổ ngữ trạng thái dùng 得 để nối động từ với tính từ chỉ mức độ. Miêu tả kết quả hoặc trạng thái của hành động.','说得对 = nói đúng. 跑得快 = chạy nhanh. 写得好看 = viết đẹp.','Trạng thái hành động.',1);
ge($conn,$g11_1,'你说得对。','Nǐ shuō de duì.','Bạn nói đúng.',1);
ge($conn,$g11_1,'他跑得很快。','Tā pǎo de hěn kuài.','Anh ấy chạy rất nhanh.',2);
$g11_2=g($conn,$L11,'Từ 对 (đúng / đối với)','对 + Danh từ / Câu + 对','Đúng, đối với','对 có hai cách dùng: (1) Tính từ: đúng. (2) Giới từ: đối với, với.','对 + N = đối với ai đó. 你说得对 = bạn nói đúng.','Đúng và đối với.',2);
ge($conn,$g11_2,'你说得对，我同意。','Nǐ shuō de duì, wǒ tóngyì.','Bạn nói đúng, tôi đồng ý.',1);
ge($conn,$g11_2,'他对人很好。','Tā duì rén hěn hǎo.','Anh ấy đối với mọi người rất tốt.',2);
$g11_3=g($conn,$L11,'Động từ khuyết thiếu 应该','应该 + Động từ','Nên làm gì','应该 diễn tả sự cần thiết hoặc bổn phận phải làm. Nhẹ hơn 必须.','应该 học = nên học. 应该 đi = nên đi.','Nên, phải.',3);
ge($conn,$g11_3,'你应该多休息。','Nǐ yīnggāi duō xiūxi.','Bạn nên nghỉ ngơi nhiều hơn.',1);
ge($conn,$g11_3,'我们应该一起努力。','Wǒmen yīnggāi yīqǐ nǔlì.','Chúng ta nên cùng nhau cố gắng.',2);
// Dialogues L11
$d11_1=d($conn,$L11,'Dong y va phan doi','Đồng ý với ý kiến.',1);
ds($conn,$d11_1,'Anna','我觉得这个办法很好。','Wǒ juéde zhè ge bànfǎ hěn hǎo.','Tôi thấy cách này rất tốt.',1);
ds($conn,$d11_1,'Xiao Ming','对，你说得对。我也同意。','Duì, nǐ shuō de duì. Wǒ yě tóngyì.','Đúng, bạn nói đúng. Tôi cũng đồng ý.',2);
ds($conn,$d11_1,'Anna','但是他认为不行。','Dànshì tā rènwéi bù xíng.','Nhưng anh ấy cho rằng không được.',3);
ds($conn,$d11_1,'Xiao Ming','我们必须听听他的意见。','Wǒmen bìxū tīngting tā de yìjiàn.','Chúng ta phải nghe ý kiến của anh ấy.',4);
$d11_2=d($conn,$L11,'Khuyen nhau hoc tap','Khuyên bạn học tập.',2);
ds($conn,$d11_2,'Xiao Ming','你最近学习怎么样？','Nǐ zuìjìn xuéxí zěnme yàng?','Dạo này học tập thế nào?',1);
ds($conn,$d11_2,'Anna','还不错，但是我觉得汉语很难。','Hái búcuò, dànshì wǒ juéde Hànyǔ hěn nán.','Cũng được, nhưng tôi thấy tiếng Trung khó.',2);
ds($conn,$d11_2,'Xiao Ming','你说得对，汉语不容易。但是你必须多练习。','Nǐ shuō de duì, Hànyǔ bù róngyì. Dànshì nǐ bìxū duō liànxí.','Bạn nói đúng, tiếng Trung không dễ. Nhưng bạn phải luyện tập nhiều.',3);
ds($conn,$d11_2,'Anna','你说得对，我应该多努力。','Nǐ shuō de duì, wǒ yīnggāi duō nǔlì.','Bạn nói đúng, tôi nên cố gắng nhiều hơn.',4);
// Reading L11
r($conn,$L11,'Dong y hay phan doi','今天开会的时候，大家讨论了一个问题。我觉得这个办法很好，小明也同意我的意见。但是小李认为不行，他说太麻烦了。我们听了他的意见以后，觉得也有道理。最后大家一起想了一个新办法，这个办法大家都同意。我觉得讨论很重要，必须听听每个人的意见，这样才能找到最好的办法。','Jīntiān kāihuì de shíhou, dàjiā tǎolùn le yí ge wèntí. Wǒ juéde zhè ge bànfǎ hěn hǎo, Xiǎo Míng yě tóngyì wǒ de yìjiàn. Dànshì Xiǎo Lǐ rènwéi bù xíng, tā shuō tài máfan le. Wǒmen tīng le tā de yìjiàn yǐhòu, juéde yě yǒu dàolǐ. Zuìhòu dàjiā yīqǐ xiǎng le yí ge xīn bànfǎ, zhè ge bànfǎ dàjiā dōu tóngyì. Wǒ juéde tǎolùn hěn zhòngyào, bìxū tīngting měi ge rén de yìjiàn, zhèyàng cáinéng zhǎodào zuì hǎo de bànfǎ.','Hôm nay trong cuộc họp, mọi người thảo luận một vấn đề. Tôi thấy cách này rất tốt, Tiểu Minh cũng đồng ý với ý kiến của tôi. Nhưng Tiểu Lý cho rằng không được, anh ấy nói quá phiền phức. Sau khi nghe ý kiến của anh ấy, chúng tôi thấy cũng có lý. Cuối cùng mọi người cùng nhau nghĩ ra cách mới, cách này ai cũng đồng ý. Tôi thấy thảo luận rất quan trọng, phải nghe ý kiến mỗi người, như vậy mới tìm được cách tốt nhất.','easy',112,1);
// Listening L11
$L11l=l($conn,$L11,'Dong y','A:你觉得这个办法怎么样？B:我觉得很好。A:我也认为不错。但是小王不同意。B:为什么？A:他说太贵了。B:那我们应该听听他的意见。','A:Nǐ juéde zhè ge bànfǎ zěnme yàng? B:Wǒ juéde hěn hǎo. A:Wǒ yě rènwéi búcuò. Dànshì Xiǎo Wáng bù tóngyì. B:Wèishénme? A:Tā shuō tài guì le. B:Nà wǒmen yīnggāi tīngting tā de yìjiàn.','A:Bạn thấy cách này thế nào? B:Tôi thấy rất tốt. A:Tôi cũng cho rằng không tồi. Nhưng Tiểu Vương không đồng ý. B:Tại sao? A:Anh ấy nói quá đắt. B:Vậy chúng ta nên nghe ý kiến của anh ấy.','1');
lq($conn,$L11l,'Người B thấy cách này thế nào?','{"A":"Không tốt","B":"Rất tốt","C":"Bình thường"}','Rất tốt','Người B thấy rất tốt.','multiple_choice',1);
lq($conn,$L11l,'Tại sao Tiểu Vương không đồng ý?','{"A":"Khó quá","B":"Xa quá","C":"Đắt quá"}','Đắt quá','Anh ấy nói quá đắt.','multiple_choice',2);
// Exercises L11
$E11_1=e($conn,$L11,'Chọn đáp án','"V + 得 + Adj" là:','multiple_choice','easy',1,'A',1);
eo($conn,$E11_1,'Bổ ngữ trạng thái','A',1,1); eo($conn,$E11_1,'Bổ ngữ kết quả','B',0,2); eo($conn,$E11_1,'Bổ ngữ phương hướng','C',0,3);
$E11_2=e($conn,$L11,'Dịch','"Bạn nói đúng."','translation','easy',1,'你说得对。',2);
$E11_3=e($conn,$L11,'Điền từ','你说___对。(trợ từ bổ ngữ)','fill_blank','easy',1,'得',3);
$E11_4=e($conn,$L11,'Sắp xếp câu','说得 / 你 / 对','sentence_order','easy',1,'你说得对。',4);
$E11_5=e($conn,$L11,'Chọn đúng/sai','"必须" có nghĩa là "nên".','true_false','easy',1,'false',5);
eo($conn,$E11_5,'Đúng','A',0,1); eo($conn,$E11_5,'Sai','B',1,2);
$E11_6=e($conn,$L11,'Điền từ','你___多运动。(nên)','fill_blank','easy',1,'应该',6);
$E11_7=e($conn,$L11,'Chọn đáp án','"同意" có nghĩa là:','multiple_choice','easy',1,'C',7);
eo($conn,$E11_7,'Phản đối','A',0,1); eo($conn,$E11_7,'Nghĩ','B',0,2); eo($conn,$E11_7,'Đồng ý','C',1,3);
// Review L11
foreach ([$v11_1,$v11_2,$v11_3,$v11_4,$v11_5,$v11_6,$v11_7,$v11_8,$v11_9] as $i=>$vid) if ($vid) rv($conn,$L11,$vid,'core',$i+1);
echo " HSK2 L11 done: $v11 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L12: 你得多喝水
// ═══════════════════════════════════════════════════
$L12=createLesson($conn,2,12,'Bài 12: Ni dei duo he shui - Bạn phải uống nhiều nước','Sức khỏe. Động từ 得 (phải). 多/少 + V.','["Suc khoe","Phai","Nhieu it"]','Suc khoe','easy','HSK2 Bài 12: Sức khỏe và lời khuyên. Động từ 得 (děi) + V: phải làm gì. 多/少 + V: làm nhiều/ít hơn. Cấu trúc 好好 + V (làm thật tốt). Từ vựng: 运动, 身体, 健康, 休息, 医院, 喝水.');
$v12=0;
$v12_1=v($conn,$L12,2,'得','děi','phải','phải','你得休息。','Nǐ děi xiūxi.','Bạn phải nghỉ ngơi.','verb','Động từ chỉ sự cần thiết.',++$v12);
$v12_2=v($conn,$L12,2,'多','duō','nhiều','nhiều','多喝水。','Duō hēshuǐ.','Uống nhiều nước.','adj/adv','Số lượng nhiều.',++$v12);
$v12_3=v($conn,$L12,2,'少','shǎo','ít','ít','少吃肉。','Shǎo chī ròu.','Ăn ít thịt.','adj/adv','Số lượng ít.',++$v12);
$v12_4=v($conn,$L12,2,'喝水','hēshuǐ','uống nước','uống nước','多喝水。','Duō hēshuǐ.','Uống nhiều nước.','verb','Uống nước.',++$v12);
$v12_5=v($conn,$L12,2,'运动','yùndòng','vận động, tập thể dục','tập thể dục','做运动。','Zuò yùndòng.','Tập thể dục.','verb/noun','Hoạt động thể chất.',++$v12);
$v12_6=v($conn,$L12,2,'身体','shēntǐ','cơ thể, sức khỏe','cơ thể','身体好。','Shēntǐ hǎo.','Sức khỏe tốt.','noun','Cơ thể con người.',++$v12);
$v12_7=v($conn,$L12,2,'健康','jiànkāng','khỏe mạnh','khỏe','身体健康。','Shēntǐ jiànkāng.','Sức khỏe tốt.','adj','Trạng thái sức khỏe.',++$v12);
$v12_8=v($conn,$L12,2,'休息','xiūxi','nghỉ ngơi','nghỉ','休息一下。','Xiūxi yíxià.','Nghỉ một chút.','verb','Ngừng làm việc.',++$v12);
$v12_9=v($conn,$L12,2,'医院','yīyuàn','bệnh viện','bệnh viện','去医院。','Qù yīyuàn.','Đi bệnh viện.','noun','Nơi chữa bệnh.',++$v12);
// Grammar L12
$g12_1=g($conn,$L12,'Động từ 得 (děi) - phải','得 + Động từ','Phải làm gì','得 (děi) là động từ khuyết thiếu, diễn tả sự cần thiết hoặc bắt buộc. Khác với được trong tiếng Việt. Phủ định: 不用 (không cần).','得去 = phải đi. 得做 = phải làm.','Cần thiết, bắt buộc.',1);
ge($conn,$g12_1,'你得多喝水。','Nǐ děi duō hēshuǐ.','Bạn phải uống nhiều nước.',1);
ge($conn,$g12_1,'我得去上班了。','Wǒ děi qù shàngbān le.','Tôi phải đi làm rồi.',2);
$g12_2=g($conn,$L12,'多/少 + Động từ','多/少 + Động từ','Làm nhiều/ít hơn','多 và少 đứng trước động từ để chỉ tăng hoặc giảm mức độ hành động. Thường dùng trong lời khuyên.','多 học = học nhiều hơn. 少 ăn = ăn ít hơn.','Tăng/giảm mức độ.',2);
ge($conn,$g12_2,'多运动对身体好。','Duō yùndòng duì shēntǐ hǎo.','Tập thể dục nhiều tốt cho sức khỏe.',1);
ge($conn,$g12_2,'你少抽烟吧。','Nǐ shǎo chōuyān ba.','Bạn hút thuốc ít thôi.',2);
$g12_3=g($conn,$L12,'Cấu trúc 好好 + V','好好 + Động từ','Làm gì thật tốt','好好 là phó từ chỉ làm việc gì một cách nghiêm túc, kỹ lưỡng. Lặp từ 好 (tốt) để nhấn mạnh.','好好学习 = học tập tốt. 好好休息 = nghỉ ngơi tốt.','Làm thật tốt.',3);
ge($conn,$g12_3,'你要好好休息。','Nǐ yào hǎohāo xiūxi.','Bạn phải nghỉ ngơi tốt.',1);
ge($conn,$g12_3,'我会好好学习的。','Wǒ huì hǎohāo xuéxí de.','Tôi sẽ học tập tốt.',2);
// Dialogues L12
$d12_1=d($conn,$L12,'Khuyen suc khoe','Khuyên bạn về sức khỏe.',1);
ds($conn,$d12_1,'Anna','我最近身体不太舒服。','Wǒ zuìjìn shēntǐ bú tài shūfu.','Dạo này tôi không được khỏe.',1);
ds($conn,$d12_1,'Xiao Ming','你得好好休息，多喝水。','Nǐ děi hǎohāo xiūxi, duō hēshuǐ.','Bạn phải nghỉ ngơi tốt, uống nhiều nước.',2);
ds($conn,$d12_1,'Anna','我知道，但是工作太多了。','Wǒ zhīdào, dànshì gōngzuò tài duō le.','Tôi biết, nhưng công việc nhiều quá.',3);
ds($conn,$d12_1,'Xiao Ming','健康最重要，你应该多运动。','Jiànkāng zuì zhòngyào, nǐ yīnggāi duō yùndòng.','Sức khỏe quan trọng nhất, bạn nên tập thể dục nhiều hơn.',4);
$d12_2=d($conn,$L12,'Di benh vien','Bị ốm phải đi khám.',2);
ds($conn,$d12_2,'Xiao Ming','你怎么了？看起来不太高兴。','Nǐ zěnme le? Kàn qǐlái bú tài gāoxìng.','Bạn sao thế? Trông không vui.',1);
ds($conn,$d12_2,'Anna','我感冒了。','Wǒ gǎnmào le.','Tôi bị cảm rồi.',2);
ds($conn,$d12_2,'Xiao Ming','你得去医院看看。多喝水，多休息。','Nǐ děi qù yīyuàn kànkan. Duō hēshuǐ, duō xiūxi.','Bạn phải đi bệnh viện khám. Uống nhiều nước, nghỉ nhiều.',3);
ds($conn,$d12_2,'Anna','好，我下午就去。','Hǎo, wǒ xiàwǔ jiù qù.','Được, chiều tôi đi ngay.',4);
// Reading L12
r($conn,$L12,'Loi khuyen suc khoe','最近我身体不太好，常常觉得累。朋友说我得多运动，多喝水，还要少熬夜。我觉得他说得对。所以我现在每天早上去公园跑步，晚上十点就睡觉。吃饭也注意健康，多吃水果和蔬菜，少吃肉和油。这样过了一个月，身体好多了。以后我要好好保持健康。','Zuìjìn wǒ shēntǐ bú tài hǎo, chángcháng juéde lèi. Péngyou shuō wǒ děi duō yùndòng, duō hēshuǐ, hái yào shǎo áoyè. Wǒ juéde tā shuō de duì. Suǒyǐ wǒ xiànzài měitiān zǎoshang qù gōngyuán pǎobù, wǎnshang shí diǎn jiù shuìjiào. Chīfàn yě zhùyì jiànkāng, duō chī shuǐguǒ hé shūcài, shǎo chī ròu hé yóu. Zhèyàng guò le yí ge yuè, shēntǐ hǎo duō le. Yǐhòu wǒ yào hǎohāo bǎochí jiànkāng.','Dạo này sức khỏe tôi không tốt, thường thấy mệt. Bạn nói tôi phải tập thể dục nhiều hơn, uống nhiều nước và bớt thức khuya. Tôi thấy bạn nói đúng. Nên bây giờ mỗi sáng tôi đi công viên chạy bộ, tối 10 giờ đi ngủ. Ăn uống cũng chú ý sức khỏe, ăn nhiều trái cây và rau, ăn ít thịt và dầu mỡ. Như vậy được một tháng, sức khỏe tốt hơn nhiều. Sau này tôi phải giữ gìn sức khỏe tốt.','easy',120,1);
// Listening L12
$L12l=l($conn,$L12,'Suc khoe','A:你最近身体怎么样？B:不太好，常常感冒。A:你得注意身体。B:我知道，但是工作太忙。A:多运动，少加班。B:你说得对，我得改变一下。','A:Nǐ zuìjìn shēntǐ zěnme yàng? B:Bú tài hǎo, chángcháng gǎnmào. A:Nǐ děi zhùyì shēntǐ. B:Wǒ zhīdào, dànshì gōngzuò tài máng. A:Duō yùndòng, shǎo jiābān. B:Nǐ shuō de duì, wǒ děi gǎibiàn yíxià.','A:Dạo này sức khỏe thế nào? B:Không tốt lắm, thường bị cảm. A:Bạn phải chú ý sức khỏe. B:Tôi biết, nhưng công việc quá bận. A:Tập thể dục nhiều, bớt tăng ca. B:Bạn nói đúng, tôi phải thay đổi một chút.','1');
lq($conn,$L12l,'Người B thường bị gì?','{"A":"Đau đầu","B":"Cảm","C":"Đau bụng"}','Cảm','Thường bị cảm.','multiple_choice',1);
lq($conn,$L12l,'Người A khuyên B làm gì?','{"A":"Ngủ nhiều","B":"Tập thể dục, bớt tăng ca","C":"Ăn nhiều"}','Tập thể dục, bớt tăng ca','Tập thể dục và bớt tăng ca.','multiple_choice',2);
// Exercises L12
$E12_1=e($conn,$L12,'Chọn đáp án','"得" (děi) trong "你得多喝水" có nghĩa là:','multiple_choice','easy',1,'B',1);
eo($conn,$E12_1,'Được','A',0,1); eo($conn,$E12_1,'Phải','B',1,2); eo($conn,$E12_1,'Nên','C',0,3);
$E12_2=e($conn,$L12,'Dịch','"Bạn phải uống nhiều nước."','translation','easy',1,'你得多喝水。',2);
$E12_3=e($conn,$L12,'Điền từ','你得多运___。(động, vận động)','fill_blank','easy',1,'动',3);
$E12_4=e($conn,$L12,'Sắp xếp câu','得多 / 你 / 喝水','sentence_order','easy',1,'你得多喝水。',4);
$E12_5=e($conn,$L12,'Chọn đúng/sai','"少" có nghĩa là "nhiều".','true_false','easy',1,'false',5);
eo($conn,$E12_5,'Đúng','A',0,1); eo($conn,$E12_5,'Sai','B',1,2);
$E12_6=e($conn,$L12,'Điền từ','你得多___息。(nghỉ)','fill_blank','easy',1,'休',6);
$E12_7=e($conn,$L12,'Chọn đáp án','"好好" trong "好好学习" diễn tả:','multiple_choice','easy',1,'A',7);
eo($conn,$E12_7,'Làm thật tốt','A',1,1); eo($conn,$E12_7,'Làm nhanh','B',0,2); eo($conn,$E12_7,'Làm xong','C',0,3);
// Review L12
foreach ([$v12_1,$v12_2,$v12_3,$v12_4,$v12_5,$v12_6,$v12_7,$v12_8,$v12_9] as $i=>$vid) if ($vid) rv($conn,$L12,$vid,'core',$i+1);
echo " HSK2 L12 done: $v12 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L13: 我被人打了
// ═══════════════════════════════════════════════════
$L13=createLesson($conn,2,13,'Bài 13: Wo bei ren da le - Tôi bị người đánh','Câu bị động 被. Thay đổi trạng thái với 了.','["Bi dong","Thay doi trang thai","Su viec"]','Bi dong','easy','HSK2 Bài 13: Câu bị động 被. 被 + (người) + V: bị ai làm gì. Phủ định: 没 + 被 + V. 了 chỉ sự thay đổi trạng thái. Từ vựng: 打, 骂, 偷, 伤, 生气, 哭, 笑, 故事.');
$v13=0;
$v13_1=v($conn,$L13,2,'被','bèi','bị','bị','被打了。','Bèi dǎ le.','Bị đánh.','prep','Dẫn nhập tác nhân trong câu bị động.',++$v13);
$v13_2=v($conn,$L13,2,'打','dǎ','đánh','đánh','打人。','Dǎ rén.','Đánh người.','verb','Hành động đánh.',++$v13);
$v13_3=v($conn,$L13,2,'骂','mà','chửi, mắng','chửi','被骂了。','Bèi mà le.','Bị chửi.','verb','Chửi mắng.',++$v13);
$v13_4=v($conn,$L13,2,'偷','tōu','trộm, ăn cắp','trộm','被偷了。','Bèi tōu le.','Bị trộm.','verb','Hành động trộm cắp.',++$v13);
$v13_5=v($conn,$L13,2,'伤','shāng','bị thương, tổn thương','thương','受伤了。','Shòushāng le.','Bị thương.','verb/adj','Tổn thương.',++$v13);
$v13_6=v($conn,$L13,2,'生气','shēngqì','tức giận','tức giận','别生气。','Bié shēngqì.','Đừng giận.','verb/adj','Cảm xúc giận dữ.',++$v13);
$v13_7=v($conn,$L13,2,'哭','kū','khóc','khóc','别哭了。','Bié kū le.','Đừng khóc nữa.','verb','Hành động khóc.',++$v13);
$v13_8=v($conn,$L13,2,'笑','xiào','cười','cười','笑什么？','Xiào shénme?','Cười gì?','verb','Hành động cười.',++$v13);
$v13_9=v($conn,$L13,2,'故事','gùshi','câu chuyện','chuyện','讲故事。','Jiǎng gùshi.','Kể chuyện.','noun','Câu chuyện kể.',++$v13);
// Grammar L13
$g13_1=g($conn,$L13,'Câu bị động 被','Chủ ngữ + 被 + (Người) + Động từ','Bị ai làm gì','被 là dấu hiệu của câu bị động. Có thể có hoặc không có tác nhân (người thực hiện). Nếu không có tác nhân, đặt 被 trực tiếp trước động từ.','被打了 = bị đánh. 被人打了 = bị người đánh.','Bị động.',1);
ge($conn,$g13_1,'我被人打了。','Wǒ bèi rén dǎ le.','Tôi bị người đánh.',1);
ge($conn,$g13_1,'钱包被偷了。','Qiánbāo bèi tōu le.','Ví bị trộm mất rồi.',2);
$g13_2=g($conn,$L13,'Phủ định câu 被','没(有) + 被 + (Người) + Động từ','Không bị...','Phủ định của câu bị động dùng 没(有) đặt trước 被. Không dùng 不 để phủ định.','没被偷 = không bị trộm. 没被他骂 = không bị anh ấy chửi.','Phủ định bị động.',2);
ge($conn,$g13_2,'我没被他骂。','Wǒ méi bèi tā mà.','Tôi không bị anh ấy chửi.',1);
ge($conn,$g13_2,'手机没被偷走。','Shǒujī méi bèi tōu zǒu.','Điện thoại không bị trộm mất.',2);
$g13_3=g($conn,$L13,'了 chỉ sự thay đổi trạng thái','Chủ ngữ + Adj/V + 了','Đã thay đổi sang trạng thái mới','了 ở cuối câu biểu thị trạng thái mới xuất hiện. Trước đó không như vậy. Thường dùng với cảm xúc.','生气了 = (trước không giận, bây giờ) giận rồi. 哭了 = khóc rồi.','Thay đổi trạng thái.',3);
ge($conn,$g13_3,'他生气了。','Tā shēngqì le.','Anh ấy giận rồi.',1);
ge($conn,$g13_3,'别哭了，没事了。','Bié kū le, méi shì le.','Đừng khóc nữa, không sao rồi.',2);
// Dialogues L13
$d13_1=d($conn,$L13,'Bi danh','Kể về việc bị đánh.',1);
ds($conn,$d13_1,'Anna','你脸上怎么了？','Nǐ liǎn shang zěnme le?','Mặt bạn sao thế?',1);
ds($conn,$d13_1,'Xiao Ming','昨天打球的时候被人打到了。','Zuótiān dǎ qiú de shíhou bèi rén dǎ dào le.','Hôm qua lúc chơi bóng bị người đánh trúng.',2);
ds($conn,$d13_1,'Anna','伤得重吗？','Shāng de zhòng ma?','Bị thương nặng không?',3);
ds($conn,$d13_1,'Xiao Ming','不重，但是很疼。','Bú zhòng, dànshì hěn téng.','Không nặng, nhưng rất đau.',4);
ds($conn,$d13_1,'Anna','以后要小心。','Yǐhòu yào xiǎoxīn.','Sau này phải cẩn thận.',5);
$d13_2=d($conn,$L13,'Ke chuyen bi mat','Kể về việc bị mất đồ.',2);
ds($conn,$d13_2,'Xiao Ming','你的手机呢？','Nǐ de shǒujī ne?','Điện thoại của bạn đâu?',1);
ds($conn,$d13_2,'Anna','被偷了。我很生气！','Bèi tōu le. Wǒ hěn shēngqì!','Bị trộm mất rồi. Tôi rất tức!',2);
ds($conn,$d13_2,'Xiao Ming','在哪儿被偷的？','Zài nǎr bèi tōu de?','Bị trộm ở đâu?',3);
ds($conn,$d13_2,'Anna','在车上。那是我的新手机。','Zài chē shang. Nà shì wǒ de xīn shǒujī.','Trên xe. Đó là điện thoại mới của tôi.',4);
ds($conn,$d13_2,'Xiao Ming','别生气了，以后再买一个吧。','Bié shēngqì le, yǐhòu zài mǎi yí ge ba.','Đừng giận nữa, sau này mua cái khác đi.',5);
// Reading L13
r($conn,$L13,'Cau chuyen bi mat','昨天发生了一件让人生气的事。我坐公交车的时候，下车后发现钱包被偷了。钱包里有我的身份证和一百块钱。我很难过，也很生气。朋友听说了这个故事，他说以后要小心，钱包别放在后面的口袋里。今天我又坐那路车，但是没有被人偷。我跟朋友说了，他笑着说这是个教训。以后我真的要小心了。','Zuótiān fāshēng le yí jiàn ràng rén shēngqì de shì. Wǒ zuò gōngjiāochē de shíhou, xià chē hòu fāxiàn qiánbāo bèi tōu le. Qiánbāo lǐ yǒu wǒ de shēnfènzhèng hé yìbǎi kuài qián. Wǒ hěn nánguò, yě hěn shēngqì. Péngyou tīng shuō le zhè ge gùshi, tā shuō yǐhòu yào xiǎoxīn, qiánbāo bié fàng zài hòumiàn de kǒudài lǐ. Jīntiān wǒ yòu zuò nà lù chē, dànshì méiyǒu bèi rén tōu. Wǒ gēn péngyou shuō le, tā xiào zhe shuō zhè shì ge jiàoxun. Yǐhòu wǒ zhēn de yào xiǎoxīn le.','Hôm qua xảy ra một chuyện đáng tức. Tôi đi xe buýt, xuống xe thì phát hiện ví bị trộm mất. Trong ví có chứng minh thư và 100 đồng. Tôi rất buồn và cũng rất tức. Bạn nghe kể chuyện này, nói sau này phải cẩn thận, đừng để ví ở túi sau. Hôm nay tôi lại đi xe đó, nhưng không bị trộm. Tôi nói với bạn, bạn ấy cười nói đó là bài học. Sau này tôi thực sự phải cẩn thận rồi.','easy',128,1);
// Listening L13
$L13l=l($conn,$L13,'Bi mat do','A:你怎么哭了？B:我的自行车被偷了。A:在哪儿被偷的？B:在学校门口。A:报警了吗？B:报了，但是还没找到。A:别哭了，以后买把好锁。','A:Nǐ zěnme kū le? B:Wǒ de zìxíngchē bèi tōu le. A:Zài nǎr bèi tōu de? B:Zài xuéxiào ménkǒu. A:Bàojǐng le ma? B:Bào le, dànshì hái méi zhǎodào. A:Bié kū le, yǐhòu mǎi bǎ hǎo suǒ.','A:Sao bạn khóc thế? B:Xe đạp của tôi bị trộm mất rồi. A:Bị trộm ở đâu? B:Ở cổng trường. A:Báo cảnh sát chưa? B:Báo rồi, nhưng chưa tìm thấy. A:Đừng khóc nữa, sau này mua ổ khóa tốt.','1');
lq($conn,$L13l,'Người B đã bị mất gì?','{"A":"Ví","B":"Xe đạp","C":"Điện thoại"}','Xe đạp','Xe đạp bị trộm.','multiple_choice',1);
lq($conn,$L13l,'Người A khuyên B làm gì?','{"A":"Báo cảnh sát","B":"Tìm lại","C":"Mua ổ khóa tốt"}','Mua ổ khóa tốt','Mua khóa tốt cho xe.','multiple_choice',2);
// Exercises L13
$E13_1=e($conn,$L13,'Chọn đáp án','Câu bị động 被 diễn tả:','multiple_choice','easy',1,'B',1);
eo($conn,$E13_1,'Chủ động','A',0,1); eo($conn,$E13_1,'Bị động','B',1,2); eo($conn,$E13_1,'Nhấn mạnh','C',0,3);
$E13_2=e($conn,$L13,'Dịch','"Tôi bị người đánh."','translation','easy',1,'我被人打了。',2);
$E13_3=e($conn,$L13,'Điền từ','钱包___偷了。(bị)','fill_blank','easy',1,'被',3);
$E13_4=e($conn,$L13,'Sắp xếp câu','被 / 我 / 打了 / 人','sentence_order','easy',1,'我被人打了。',4);
$E13_5=e($conn,$L13,'Chọn đúng/sai','"生气" có nghĩa là "vui vẻ".','true_false','easy',1,'false',5);
eo($conn,$E13_5,'Đúng','A',0,1); eo($conn,$E13_5,'Sai','B',1,2);
$E13_6=e($conn,$L13,'Điền từ','他没___我骂。(bị)','fill_blank','easy',1,'被',6);
$E13_7=e($conn,$L13,'Chọn đáp án','Phủ định câu 被 dùng:','multiple_choice','easy',1,'A',7);
eo($conn,$E13_7,'没 + 被','A',1,1); eo($conn,$E13_7,'不 + 被','B',0,2); eo($conn,$E13_7,'别 + 被','C',0,3);
// Review L13
foreach ([$v13_1,$v13_2,$v13_3,$v13_4,$v13_5,$v13_6,$v13_7,$v13_8,$v13_9] as $i=>$vid) if ($vid) rv($conn,$L13,$vid,'core',$i+1);
echo " HSK2 L13 done: $v13 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L14: 你看过那个电影吗
// ═══════════════════════════════════════════════════
$L14=createLesson($conn,2,14,'Bài 14: Ni kan guo na ge dian ying ma - Bạn đã xem bộ phim đó chưa?','Kinh nghiệm với 过. Đã...rồi: 已经...了.','["Kinh nghiem","Da tung","Phim anh tai lieu"]','Kinh nghiem','easy','HSK2 Bài 14: Kinh nghiệm đã trải qua. Hậu tố 过: V + 过 (đã từng làm). Phủ định: 没 + V + 过 (chưa từng). 已经...了 (đã...rồi). Từ vựng: 电影, 听说, 故事, 有意思, 已经, 以前, 最近, 演员.');
$v14=0;
$v14_1=v($conn,$L14,2,'过','guo','đã từng (hậu tố)','từng','去过。','Qùguo.','Đã từng đi.','suffix','Chỉ kinh nghiệm từng trải qua.',++$v14);
$v14_2=v($conn,$L14,2,'电影','diànyǐng','phim','phim','看电影。','Kàn diànyǐng.','Xem phim.','noun','Phim điện ảnh.',++$v14);
$v14_3=v($conn,$L14,2,'听说','tīngshuō','nghe nói','nghe nói','听说了。','Tīngshuō le.','Nghe nói rồi.','verb','Nghe người khác nói lại.',++$v14);
$v14_4=v($conn,$L14,2,'故事','gùshi','câu chuyện','chuyện','故事很好。','Gùshi hěn hǎo.','Câu chuyện rất hay.','noun','Câu chuyện, nội dung.',++$v14);
$v14_5=v($conn,$L14,2,'有意思','yǒuyìsi','thú vị, có ý nghĩa','thú vị','很有意思。','Hěn yǒuyìsi.','Rất thú vị.','adj','Hấp dẫn, thú vị.',++$v14);
$v14_6=v($conn,$L14,2,'已经','yǐjīng','đã (rồi)','đã','已经看了。','Yǐjīng kàn le.','Đã xem rồi.','adv','Phó từ chỉ hành động đã xong.',++$v14);
$v14_7=v($conn,$L14,2,'以前','yǐqián','trước đây','trước đây','以前去过。','Yǐqián qùguo.','Trước đây từng đi.','noun','Thời gian trong quá khứ.',++$v14);
$v14_8=v($conn,$L14,2,'最近','zuìjìn','gần đây','gần đây','最近很好。','Zuìjìn hěn hǎo.','Gần đây rất tốt.','time noun','Khoảng thời gian gần.',++$v14);
$v14_9=v($conn,$L14,2,'演员','yǎnyuán','diễn viên','diễn viên','好演员。','Hǎo yǎnyuán.','Diễn viên tốt.','noun','Người đóng phim, kịch.',++$v14);
// Grammar L14
$g14_1=g($conn,$L14,'Hậu tố 过 - đã từng','Động từ + 过','Đã từng làm gì','过 sau động từ biểu thị kinh nghiệm đã trải qua trong quá khứ. Nhấn mạnh từng làm, không nhấn mạnh thời gian cụ thể.','去过 = đã từng đi. 吃过 = đã từng ăn. 看过 = đã từng xem.','Kinh nghiệm quá khứ.',1);
ge($conn,$g14_1,'你看过那个电影吗？','Nǐ kànguò nà ge diànyǐng ma?','Bạn đã xem bộ phim đó chưa?',1);
ge($conn,$g14_1,'我去过北京。','Wǒ qùguo Běijīng.','Tôi đã từng đến Bắc Kinh.',2);
$g14_2=g($conn,$L14,'Phủ định của 过: 没 + V + 过','没(有) + Động từ + 过','Chưa từng làm gì','Phủ định của 过 dùng 没(有) đặt trước động từ + 过. Không dùng 不. Trả lời phủ định cho câu hỏi V + 过 + 吗.','没去过 = chưa từng đi. 没吃过 = chưa từng ăn.','Chưa từng.',2);
ge($conn,$g14_2,'我没看过这个电影。','Wǒ méi kànguò zhè ge diànyǐng.','Tôi chưa xem bộ phim này bao giờ.',1);
ge($conn,$g14_2,'我没去过上海。','Wǒ méi qùguo Shànghǎi.','Tôi chưa từng đến Thượng Hải.',2);
$g14_3=g($conn,$L14,'Cấu trúc 已经...了','已经 + Động từ + 了','Đã...rồi','已经 + V + 了 biểu thị hành động đã hoàn thành tính đến thời điểm hiện tại. 已经 có thể lược bỏ, chỉ cần 了 ở cuối.','已经吃了 = đã ăn rồi. 已经来了 = đã đến rồi.','Đã hoàn thành.',3);
ge($conn,$g14_3,'我已经看过那个电影了。','Wǒ yǐjīng kànguò nà ge diànyǐng le.','Tôi đã xem bộ phim đó rồi.',1);
ge($conn,$g14_3,'他已经来了。','Tā yǐjīng lái le.','Anh ấy đã đến rồi.',2);
// Dialogues L14
$d14_1=d($conn,$L14,'Xem phim','Nói về phim ảnh.',1);
ds($conn,$d14_1,'Anna','你看过这个电影吗？','Nǐ kànguò zhè ge diànyǐng ma?','Bạn đã xem bộ phim này chưa?',1);
ds($conn,$d14_1,'Xiao Ming','看过。我觉得很有意思。','Kànguò. Wǒ juéde hěn yǒuyìsi.','Xem rồi. Tôi thấy rất thú vị.',2);
ds($conn,$d14_1,'Anna','故事是关于什么的？','Gùshi shì guānyú shénme de?','Câu chuyện về gì?',3);
ds($conn,$d14_1,'Xiao Ming','关于一个演员的故事。你也应该看看。','Guānyú yí ge yǎnyuán de gùshi. Nǐ yě yīnggāi kànkan.','Về câu chuyện của một diễn viên. Bạn cũng nên xem.',4);
$d14_2=d($conn,$L14,'Tung den Trung Quoc chua','Hỏi về kinh nghiệm du lịch.',2);
ds($conn,$d14_2,'Xiao Ming','你以前去过中国吗？','Nǐ yǐqián qùguo Zhōngguó ma?','Trước đây bạn từng đến Trung Quốc chưa?',1);
ds($conn,$d14_2,'Anna','还没有，但是我很想去。','Hái méiyǒu, dànshì wǒ hěn xiǎng qù.','Chưa, nhưng tôi rất muốn đi.',2);
ds($conn,$d14_2,'Xiao Ming','听说北京和上海都很有意思。','Tīngshuō Běijīng hé Shànghǎi dōu hěn yǒuyìsi.','Nghe nói Bắc Kinh và Thượng Hải đều rất thú vị.',3);
ds($conn,$d14_2,'Anna','我最近在学中文，以后想去看看。','Wǒ zuìjìn zài xué Zhōngwén, yǐhòu xiǎng qù kànkan.','Gần đây tôi học tiếng Trung, sau này muốn đi xem.',4);
// Reading L14
r($conn,$L14,'Bo phim hay','最近我看了一个很有意思的电影。故事是关于一个年轻演员的，他以前没有名，但是很努力。我听说这个电影很好看，所以去看了一下。看完以后我觉得真的很不错，演员演得也很好。我以前没看过这样的电影。朋友问我有没有看过，我说已经看过了，还推荐他也去看看。他说他还没看过，这个周末要去看。','Zuìjìn wǒ kàn le yí ge hěn yǒuyìsi de diànyǐng. Gùshi shì guānyú yí ge niánqīng yǎnyuán de, tā yǐqián méiyǒu míng, dànshì hěn nǔlì. Wǒ tīngshuō zhè ge diànyǐng hěn hǎokàn, suǒyǐ qù kàn le yíxià. Kàn wán yǐhòu wǒ juéde zhēn de hěn búcuò, yǎnyuán yǎn de yě hěn hǎo. Wǒ yǐqián méi kànguò zhèyàng de diànyǐng. Péngyou wèn wǒ yǒu méiyǒu kànguò, wǒ shuō yǐjīng kànguò le, hái tuījiàn tā yě qù kànkan. Tā shuō tā hái méi kànguò, zhè ge zhōumò yào qù kàn.','Gần đây tôi xem một bộ phim rất thú vị. Câu chuyện về một diễn viên trẻ, trước đây anh ấy không nổi tiếng nhưng rất nỗ lực. Tôi nghe nói phim này hay nên đi xem. Xem xong tôi thấy thực sự rất tốt, diễn viên đóng cũng hay. Trước đây tôi chưa xem phim nào như vậy. Bạn hỏi tôi đã xem chưa, tôi nói đã xem rồi và còn giới thiệu bạn cũng đi xem. Bạn nói chưa xem, cuối tuần này sẽ đi xem.','easy',125,1);
// Listening L14
$L14l=l($conn,$L14,'Kinh nghiem','A:你去过中国吗？B:去过一次。A:什么时候去的？B:去年。A:你觉得怎么样？B:很有意思。我还想看长城。A:我没去过，听说长城很好看。','A:Nǐ qùguo Zhōngguó ma? B:Qùguo yí cì. A:Shénme shíhou qù de? B:Qùnián. A:Nǐ juéde zěnme yàng? B:Hěn yǒuyìsi. Wǒ hái xiǎng kàn Chángchéng. A:Wǒ méi qùguo, tīngshuō Chángchéng hěn hǎokàn.','A:Bạn đã từng đến Trung Quốc chưa? B:Từng đến một lần. A:Đi lúc nào? B:Năm ngoái. A:Bạn thấy thế nào? B:Rất thú vị. Tôi còn muốn xem Vạn Lý Trường Thành. A:Tôi chưa từng đi, nghe nói Trường Thành rất đẹp.','1');
lq($conn,$L14l,'Người B đã từng đi Trung Quốc chưa?','{"A":"Chưa","B":"Từng đi một lần","C":"Nhiều lần"}','Từng đi một lần','Đã đi một lần.','multiple_choice',1);
lq($conn,$L14l,'Người A đã đi Trung Quốc chưa?','{"A":"Đã đi","B":"Chưa đi","C":"Đang đi"}','Chưa đi','A chưa từng đi.','multiple_choice',2);
// Exercises L14
$E14_1=e($conn,$L14,'Chọn đáp án','"V + 过" diễn tả:','multiple_choice','easy',1,'A',1);
eo($conn,$E14_1,'Đã từng làm','A',1,1); eo($conn,$E14_1,'Đang làm','B',0,2); eo($conn,$E14_1,'Sẽ làm','C',0,3);
$E14_2=e($conn,$L14,'Dịch','"Bạn đã xem bộ phim đó chưa?"','translation','easy',1,'你看过那个电影吗？',2);
$E14_3=e($conn,$L14,'Điền từ','我去___北京。(từng)','fill_blank','easy',1,'过',3);
$E14_4=e($conn,$L14,'Sắp xếp câu','电影 / 你 / 那个 / 看过 / 吗','sentence_order','easy',1,'你看过那个电影吗？',4);
$E14_5=e($conn,$L14,'Chọn đúng/sai','"已经" có nghĩa là "chưa".','true_false','easy',1,'false',5);
eo($conn,$E14_5,'Đúng','A',0,1); eo($conn,$E14_5,'Sai','B',1,2);
$E14_6=e($conn,$L14,'Điền từ','我没___过这样的电影。(xem)','fill_blank','easy',1,'看',6);
$E14_7=e($conn,$L14,'Chọn đáp án','Phủ định của "去过" là:','multiple_choice','easy',1,'B',7);
eo($conn,$E14_7,'不去过','A',0,1); eo($conn,$E14_7,'没去过','B',1,2); eo($conn,$E14_7,'没去','C',0,3);
// Review L14
foreach ([$v14_1,$v14_2,$v14_3,$v14_4,$v14_5,$v14_6,$v14_7,$v14_8,$v14_9] as $i=>$vid) if ($vid) rv($conn,$L14,$vid,'core',$i+1);
echo " HSK2 L14 done: $v14 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK2 L15: 新年快乐
// ═══════════════════════════════════════════════════
$L15=createLesson($conn,2,15,'Bài 15: Xin nian kuai le - Chúc mừng năm mới','Chúc mừng, ngày lễ Tết. Câu chúc.','["Chuc mung","Ngay le tet","Cau chuc"]','Ngay le','easy','HSK2 Bài 15: Ngày lễ và lời chúc. Cấu trúc chúc mừng: 新年快乐, 生日快乐. 祝 + sb + (lời chúc). 希望 + clause (hy vọng). Từ vựng: 节日, 春节, 礼物, 祝福, 团圆, 饺子.');
$v15=0;
$v15_1=v($conn,$L15,2,'新年','xīnnián','năm mới','năm mới','新年快乐！','Xīnnián kuàilè!','Chúc mừng năm mới!','noun','Năm mới.',++$v15);
$v15_2=v($conn,$L15,2,'快乐','kuàilè','vui vẻ, hạnh phúc','vui vẻ','生日快乐。','Shēngrì kuàilè.','Chúc mừng sinh nhật.','adj','Niềm vui, hạnh phúc.',++$v15);
$v15_3=v($conn,$L15,2,'节日','jiérì','ngày lễ','lễ','节日快乐。','Jiérì kuàilè.','Chúc mừng ngày lễ.','noun','Dịp lễ hội.',++$v15);
$v15_4=v($conn,$L15,2,'春节','Chūnjié','Tết Nguyên đán','Tết','春节快乐。','Chūnjié kuàilè.','Chúc mừng năm mới.','noun','Tết cổ truyền Trung Quốc.',++$v15);
$v15_5=v($conn,$L15,2,'礼物','lǐwù','quà tặng, món quà','quà','送礼物。','Sòng lǐwù.','Tặng quà.','noun','Quà tặng.',++$v15);
$v15_6=v($conn,$L15,2,'祝福','zhùfú','lời chúc, chúc phúc','chúc','送祝福。','Sòng zhùfú.','Gửi lời chúc.','noun/verb','Lời chúc tốt đẹp.',++$v15);
$v15_7=v($conn,$L15,2,'希望','xīwàng','hy vọng','hy vọng','希望你快乐。','Xīwàng nǐ kuàilè.','Hy vọng bạn vui vẻ.','verb/noun','Mong muốn điều tốt.',++$v15);
$v15_8=v($conn,$L15,2,'团圆','tuányuán','đoàn viên, sum họp','đoàn viên','全家团圆。','Quán jiā tuányuán.','Cả nhà sum họp.','verb','Gia đình quây quần.',++$v15);
$v15_9=v($conn,$L15,2,'饺子','jiǎozi','sủi cảo','sủi cảo','吃饺子。','Chī jiǎozi.','Ăn sủi cảo.','noun','Món ăn truyền thống.',++$v15);
// Grammar L15
$g15_1=g($conn,$L15,'Câu chúc: 快乐','Sự kiện + 快乐','Chúc mừng...','Cấu trúc chúc mừng đơn giản nhất: Danh từ chỉ sự kiện + 快乐. Không cần động từ.','新年快乐 = chúc mừng năm mới. 生日快乐 = chúc mừng sinh nhật.','Lời chúc.',1);
ge($conn,$g15_1,'新年快乐！','Xīnnián kuàilè!','Chúc mừng năm mới!',1);
ge($conn,$g15_1,'春节快乐！','Chūnjié kuàilè!','Chúc mừng năm mới!',2);
$g15_2=g($conn,$L15,'Cấu trúc 祝 + sb + wish','祝 + Người + Lời chúc','Chúc ai...','祝 là động từ chúc, sau đó là người nhận, tiếp theo là lời chúc. Lịch sự và trang trọng hơn 快乐 đơn thuần.','祝你新年快乐 = chúc bạn năm mới vui vẻ. 祝你们幸福 = chúc các bạn hạnh phúc.','Chúc ai.',2);
ge($conn,$g15_2,'祝你新年快乐，身体健康！','Zhù nǐ xīnnián kuàilè, shēntǐ jiànkāng!','Chúc bạn năm mới vui vẻ, sức khỏe tốt!',1);
ge($conn,$g15_2,'祝你们全家团圆幸福。','Zhù nǐmen quán jiā tuányuán xìngfú.','Chúc gia đình bạn sum họp hạnh phúc.',2);
$g15_3=g($conn,$L15,'Động từ 希望 (hy vọng)','希望 + Mệnh đề','Hy vọng...','希望 diễn tả mong ước, hy vọng về tương lai. Có thể đứng trước cả mệnh đề hoặc danh từ.','希望你快乐 = hy vọng bạn vui vẻ.','Mong ước.',3);
ge($conn,$g15_3,'我希望你身体健康。','Wǒ xīwàng nǐ shēntǐ jiànkāng.','Tôi hy vọng bạn khỏe mạnh.',1);
ge($conn,$g15_3,'希望大家新年快乐。','Xīwàng dàjiā xīnnián kuàilè.','Hy vọng mọi người năm mới vui vẻ.',2);
// Dialogues L15
$d15_1=d($conn,$L15,'Chuc tet','Chúc Tết nhau.',1);
ds($conn,$d15_1,'Anna','新年快乐！','Xīnnián kuàilè!','Chúc mừng năm mới!',1);
ds($conn,$d15_1,'Xiao Ming','新年快乐！祝你身体健康，万事如意！','Xīnnián kuàilè! Zhù nǐ shēntǐ jiànkāng, wànshì rúyì!','Chúc mừng năm mới! Chúc bạn sức khỏe tốt, mọi việc như ý!',2);
ds($conn,$d15_1,'Anna','谢谢！你春节怎么过？','Xièxie! Nǐ Chūnjié zěnme guò?','Cảm ơn! Bạn đón Tết thế nào?',3);
ds($conn,$d15_1,'Xiao Ming','回家和家人团圆，吃饺子。','Huí jiā hé jiārén tuányuán, chī jiǎozi.','Về nhà sum họp với gia đình, ăn sủi cảo.',4);
$d15_2=d($conn,$L15,'Tang qua','Tặng quà năm mới.',2);
ds($conn,$d15_2,'Xiao Ming','这是给你的新年礼物。','Zhè shì gěi nǐ de xīnnián lǐwù.','Đây là quà năm mới cho bạn.',1);
ds($conn,$d15_2,'Anna','谢谢你！可以打开吗？','Xièxie nǐ! Kěyǐ dǎkāi ma?','Cảm ơn bạn! Có thể mở ra không?',2);
ds($conn,$d15_2,'Xiao Ming','当然可以。希望你喜欢。','Dāngrán kěyǐ. Xīwàng nǐ xǐhuan.','Đương nhiên có thể. Hy vọng bạn thích.',3);
ds($conn,$d15_2,'Anna','好漂亮！你太好了。祝你新年快乐！','Hǎo piàoliang! Nǐ tài hǎo le. Zhù nǐ xīnnián kuàilè!','Đẹp quá! Bạn tốt quá. Chúc bạn năm mới vui vẻ!',4);
// Reading L15
r($conn,$L15,'Tet Nguyen dan','春节是中国最重要的节日。每年春节，大家都回家和家人团圆。我们一起吃年夜饭，吃饺子，看春节晚会。大家互相送祝福，希望新的一年身体健康，工作顺利。今年春节我收到了很多礼物，也给别人送了祝福。我的朋友安娜第一次在中国过春节，她觉得很有意思。她说很喜欢春节的饺子和热闹的气氛。我祝她新年快乐，希望她在中国过得开心。','Chūnjié shì Zhōngguó zuì zhòngyào de jiérì. Měinián Chūnjié, dàjiā dōu huí jiā hé jiārén tuányuán. Wǒmen yīqǐ chī niányèfàn, chī jiǎozi, kàn Chūnjié wǎnhuì. Dàjiā hùxiāng sòng zhùfú, xīwàng xīn de yì nián shēntǐ jiànkāng, gōngzuò shùnlì. Jīnnián Chūnjié wǒ shōudào le hěn duō lǐwù, yě gěi biérén sòng le zhùfú. Wǒ de péngyou Anna dì yī cì zài Zhōngguó guò Chūnjié, tā juéde hěn yǒuyìsi. Tā shuō hěn xǐhuan Chūnjié de jiǎozi hé rènao de qìfēn. Wǒ zhù tā xīnnián kuàilè, xīwàng tā zài Zhōngguó guò de kāixīn.','Tết Nguyên đán là ngày lễ quan trọng nhất ở Trung Quốc. Mỗi năm Tết đến, mọi người đều về nhà sum họp với gia đình. Chúng tôi cùng ăn tất niên, ăn sủi cảo, xem Gala Tết. Mọi người gửi lời chúc cho nhau, hy vọng năm mới sức khỏe tốt, công việc thuận lợi. Năm nay tôi nhận được nhiều quà, cũng gửi lời chúc cho người khác. Bạn Anna của tôi lần đầu đón Tết ở Trung Quốc, bạn ấy thấy rất thú vị. Bạn nói rất thích sủi cảo và không khí náo nhiệt của Tết. Tôi chúc bạn ấy năm mới vui vẻ, hy vọng bạn ấy sống vui vẻ ở Trung Quốc.','easy',138,1);
// Listening L15
$L15l=l($conn,$L15,'Nam moi','A:新年快乐！B:新年快乐！这是给你的礼物。A:谢谢你！太客气了。B:希望你喜欢。A:春节你回家吗？B:回，和家人团圆。A:真幸福！祝你一路平安。B:谢谢！也祝你和家人春节快乐！','A:Xīnnián kuàilè! B:Xīnnián kuàilè! Zhè shì gěi nǐ de lǐwù. A:Xièxie nǐ! Tài kèqì le. B:Xīwàng nǐ xǐhuan. A:Chūnjié nǐ huí jiā ma? B:Huí, hé jiārén tuányuán. A:Zhēn xìngfú! Zhù nǐ yílù píng ān. B:Xièxie! Yě zhù nǐ hé jiārén Chūnjié kuàilè!','A:Chúc mừng năm mới! B:Chúc mừng năm mới! Đây là quà cho bạn. A:Cảm ơn! Khách sáo quá. B:Hy vọng bạn thích. A:Tết bạn về nhà không? B:Có, sum họp với gia đình. A:Thật hạnh phúc! Chúc bạn thượng lộ bình an. B:Cảm ơn! Cũng chúc bạn và gia đình Tết vui vẻ!','1');
lq($conn,$L15l,'Người B tặng gì cho A?','{"A":"Tiền","B":"Quà","C":"Hoa"}','Quà','Tặng quà năm mới.','multiple_choice',1);
lq($conn,$L15l,'Người B về nhà làm gì?','{"A":"Ăn cơm","B":"Sum họp gia đình","C":"Du lịch"}','Sum họp gia đình','Về nhà sum họp với gia đình.','multiple_choice',2);
// Exercises L15
$E15_1=e($conn,$L15,'Chọn đáp án','"新年快乐" có nghĩa là:','multiple_choice','easy',1,'C',1);
eo($conn,$E15_1,'Tạm biệt','A',0,1); eo($conn,$E15_1,'Xin chào','B',0,2); eo($conn,$E15_1,'Chúc mừng năm mới','C',1,3);
$E15_2=e($conn,$L15,'Dịch','"Chúc bạn năm mới vui vẻ!"','translation','easy',1,'祝你新年快乐！',2);
$E15_3=e($conn,$L15,'Điền từ','新年___！(vui vẻ)','fill_blank','easy',1,'快乐',3);
$E15_4=e($conn,$L15,'Sắp xếp câu','新年 / 快乐 / 你 / 祝','sentence_order','easy',1,'祝你新年快乐！',4);
$E15_5=e($conn,$L15,'Chọn đúng/sai','"饺子" là món ăn ngày Tết.','true_false','easy',1,'true',5);
eo($conn,$E15_5,'Đúng','A',1,1); eo($conn,$E15_5,'Sai','B',0,2);
$E15_6=e($conn,$L15,'Điền từ','春节是重要的节___。(lễ)','fill_blank','easy',1,'日',6);
$E15_7=e($conn,$L15,'Chọn đáp án','"团圆" có nghĩa là:','multiple_choice','easy',1,'A',7);
eo($conn,$E15_7,'Sum họp','A',1,1); eo($conn,$E15_7,'Chia tay','B',0,2); eo($conn,$E15_7,'Đi chơi','C',0,3);
// Review L15
foreach ([$v15_1,$v15_2,$v15_3,$v15_4,$v15_5,$v15_6,$v15_7,$v15_8,$v15_9] as $i=>$vid) if ($vid) rv($conn,$L15,$vid,'core',$i+1);
echo " HSK2 L15 done: $v15 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";
