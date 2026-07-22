<?php
/**
 * HÀNNGỮ - HSK1 Content Seeder (Lessons 13-15 + HSK1 Complete)
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ─── L13: 买东西 ───
$L13=createLesson($conn,1,13,'Bài 13: Mai dong xi - Mua sắm','Mua sắm, giá cả, tiền tệ. Hỏi giá: duōshao qián.','["Mua sam","Gia ca","Tien te"]','Mua sam','easy','Bài 13: Từ vựng mua sắm: mǎi (mua), mài (bán), qián (tiền), guì (đắt), piányi (rẻ). Đơn vị tiền: kuài (đồng), máo (hào). Hỏi giá: duōshao qián? Cấu trúc tài + Adj + le (quá). Lượng từ màu sắc và quần áo.');
$v13=0;
$v13_1=v($conn,$L13,1,'买','mǎi','mua','mua','买东西。','Mǎi dōngxi.','Mua đồ.','verb','Động từ mua sắm.',++$v13);
$v13_2=v($conn,$L13,1,'钱','qián','tiền','tiền','多少钱？','Duōshao qián?','Bao nhiêu tiền?','noun','Đơn vị tiền tệ.',++$v13);
$v13_3=v($conn,$L13,1,'贵','guì','đắt','đắt','太贵了。','Tài guì le.','Đắt quá.','adj','Tính từ chỉ giá cao.',++$v13);
$v13_4=v($conn,$L13,1,'便宜','piányi','rẻ','rẻ','这个很便宜。','Zhè ge hěn piányi.','Cái này rất rẻ.','adj','Tính từ chỉ giá thấp.',++$v13);
$v13_5=v($conn,$L13,1,'块','kuài','đồng (đơn vị tiền)','đồng','五块钱。','Wǔ kuài qián.','5 đồng.','measure','Đơn vị tiền tệ cơ bản.',++$v13);
$v13_6=v($conn,$L13,1,'毛','máo','hào (đơn vị tiền)','hào','一块五毛。','Yí kuài wǔ máo.','1 đồng 5 hào.','measure','1/10 của 1 kuài.',++$v13);
$v13_7=v($conn,$L13,1,'东西','dōngxi','đồ đạc, vật','đồ','买东西。','Mǎi dōngxi.','Mua đồ.','noun','Chỉ đồ vật nói chung.',++$v13);
$v13_8=v($conn,$L13,1,'衣服','yīfu','quần áo','quần áo','买衣服。','Mǎi yīfu.','Mua quần áo.','noun','Y phục nói chung.',++$v13);
$v13_9=v($conn,$L13,1,'颜色','yánsè','màu sắc','màu sắc','你喜欢的颜色。','Nǐ xǐhuan de yánsè.','Màu sắc bạn thích.','noun','yán (nhan) + sè (sắc).',++$v13);
// Grammar L13
$g13_1=g($conn,$L13,'Hỏi và trả lời giá tiền','多少钱？--- Số + 块 (+ 毛).','Bao nhiêu tiền?','Hỏi giá: 多少钱? Trả lời: số + 块/毛. Có thể bỏ 钱 ở cuối.','1块 = 10毛. Ví dụ: 1块5 = 一块五 (một đồng rưỡi).','Hỏi giá cơ bản.',1);
ge($conn,$g13_1,'这本书多少钱？','Zhè běn shū duōshao qián?','Cuốn sách này bao nhiêu tiền?',1);
ge($conn,$g13_1,'十块钱。','Shí kuài qián.','10 đồng.',2);
$g13_2=g($conn,$L13,'Cấu trúc 太...了','太 + Tính từ + 了','Quá...','Diễn tả mức độ quá mức. Thường dùng để kêu ca hoặc khen quá mức.','太好了 = quá tốt. 太贵了 = quá đắt. 太高兴了 = quá vui.','Nhấn mạnh cảm xúc.',2);
ge($conn,$g13_2,'太贵了！','Tài guì le!','Đắt quá!',1);
ge($conn,$g13_2,'太好了！','Tài hǎo le!','Tuyệt quá!',2);
// Dialogues L13
$d13_1=d($conn,$L13,'Mua sach','Mua sách tại hiệu sách.',1);
ds($conn,$d13_1,'Xiao Ming','这本书多少钱？','Zhè běn shū duōshao qián?','Cuốn sách này bao nhiêu tiền?',1);
ds($conn,$d13_1,'Nguoi ban','十五块。','Shíwǔ kuài.','15 đồng.',2);
ds($conn,$d13_1,'Xiao Ming','太贵了。有便宜的吗？','Tài guì le. Yǒu piányi de ma?','Đắt quá. Có rẻ không?',3);
ds($conn,$d13_1,'Nguoi ban','这本十块。','Zhè běn shí kuài.','Cuốn này 10 đồng.',4);
$d13_2=d($conn,$L13,'Mua quan ao','Mua quần áo ở cửa hàng.',2);
ds($conn,$d13_2,'Anna','这件衣服多少钱？','Zhè jiàn yīfu duōshao qián?','Cái áo này bao nhiêu tiền?',1);
ds($conn,$d13_2,'Nguoi ban','三十块。','Sānshí kuài.','30 đồng.',2);
ds($conn,$d13_2,'Anna','有白色的吗？','Yǒu báisè de ma?','Có màu trắng không?',3);
ds($conn,$d13_2,'Nguoi ban','有。','Yǒu.','Có.',4);
$d13_3=d($conn,$L13,'Tra gia','Mặc cả khi mua hàng.',3);
ds($conn,$d13_3,'Anna','这个苹果多少钱一斤？','Zhè ge píngguǒ duōshao qián yì jīn?','Táo này bao nhiêu một cân?',1);
ds($conn,$d13_3,'Nguoi ban','五块钱一斤。','Wǔ kuài qián yì jīn.','5 đồng một cân.',2);
ds($conn,$d13_3,'Anna','太贵了，便宜一点吧。','Tài guì le, piányi yì diǎn ba.','Đắt quá, rẻ một chút đi.',3);
ds($conn,$d13_3,'Nguoi ban','那四块。','Nà sì kuài.','Vậy 4 đồng.',4);
// Reading L13
r($conn,$L13,'Mua sam hom nay','今天我去商店买东西。衣服很漂亮，但是太贵了。我买了一件白色的衣服，三十块钱。还买了苹果。一斤苹果四块钱，很便宜。','Jīntiān wǒ qù shāngdiàn mǎi dōngxi. Yīfu hěn piàoliang, dànshì tài guì le. Wǒ mǎi le yí jiàn báisè de yīfu, sānshí kuài qián. Hái mǎi le píngguǒ. Yì jīn píngguǒ sì kuài qián, hěn piányi.','Hôm nay tôi đi cửa hàng mua đồ. Quần áo đẹp nhưng đắt quá. Tôi mua một cái áo màu trắng, 30 đồng. Còn mua táo. Một cân táo 4 đồng, rất rẻ.','easy',75,1);
// Listening L13
$L13l=l($conn,$L13,'Mua sam','A:这个多少钱？B:十五块。A:太贵了！B:那十块。A:好，我买。','A:Zhè ge duōshao qián? B:Shíwǔ kuài. A:Tài guì le! B:Nà shí kuài. A:Hǎo, wǒ mǎi.','A:Cái này bn? B:15. A:Đắt quá! B:10. A:Được, tôi mua.','1');
lq($conn,$L13l,'Giá ban đầu là bao nhiêu?','{"A":"10","B":"15","C":"5"}','15','15 đồng.','multiple_choice',1);
lq($conn,$L13l,'Giá cuối cùng người B trả?','{"A":"5","B":"10","C":"15"}','10','10 đồng.','multiple_choice',2);
// Exercises L13
$E13_1=e($conn,$L13,'Chọn đáp án','"Bao nhiêu tiền" nói thế nào?','multiple_choice','easy',1,'A',1);
eo($conn,$E13_1,'多少钱','A',1,1); eo($conn,$E13_1,'几块','B',0,2); eo($conn,$E13_1,'什么钱','C',0,3);
$E13_2=e($conn,$L13,'Dịch','"Đắt quá!"','translation','easy',1,'太贵了！',2);
$E13_3=e($conn,$L13,'Điền từ','这___多少钱？(cái)','fill_blank','easy',1,'个',3);
$E13_4=e($conn,$L13,'Sắp xếp câu','钱 / 少多 / 这 / 个','sentence_order','easy',1,'这个多少钱？',4);
$E13_5=e($conn,$L13,'Chọn đúng/sai','"便宜" có nghĩa là "đắt".','true_false','easy',1,'false',5);
eo($conn,$E13_5,'Đúng','A',0,1); eo($conn,$E13_5,'Sai','B',1,2);
$E13_6=e($conn,$L13,'Điền đơn vị tiền','五___钱 (5 đồng)','fill_blank','easy',1,'块',6);
// Review L13
foreach ([$v13_1,$v13_2,$v13_3,$v13_4,$v13_5,$v13_7,$v13_8] as $i=>$vid) if ($vid) rv($conn,$L13,$vid,'core',$i+1);
echo " L13 done: $v13 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L14: 你汉语说得很好 ───
$L14=createLesson($conn,1,14,'Bài 14: Ni Han yu shuo de hen hao','Bổ ngữ tình huống 得. Khen ngợi.','["Khen ngợi","Bo ngu","Trang thai"]','Khen ngợi','easy','Bài 14: Bổ ngữ tình huống: V + de + Adj (nói thế nào, làm thế nào). Khen ngợi: Nǐ shuō de hěn hǎo. Động từ làm chủ ngữ: Xué Hànyǔ hěn yǒu yìsi. Từ vựng: nǔlì (chăm chỉ), cōngming (thông minh), yìsi (ý nghĩa/thú vị).');
$v14=0;
$v14_1=v($conn,$L14,1,'得','de','(bổ ngữ tình huống)','được','你说得很好。','Nǐ shuō de hěn hǎo.','Bạn nói rất hay.','particle','Kết nối động từ với bổ ngữ.',++$v14);
$v14_2=v($conn,$L14,1,'意思','yìsi','ý nghĩa, thú vị','ý nghĩa','有意思。','Yǒu yìsi.','Thú vị.','noun/adj','Có thể là danh từ (ý nghĩa) hoặc tính từ (thú vị).',++$v14);
$v14_3=v($conn,$L14,1,'努力','nǔlì','chăm chỉ, cố gắng','chăm chỉ','努力学习。','Nǔlì xuéxí.','Học tập chăm chỉ.','adj','Tính từ chỉ sự cố gắng.',++$v14);
$v14_4=v($conn,$L14,1,'教','jiāo','dạy, chỉ dạy','dạy','教我汉语。','Jiāo wǒ Hànyǔ.','Dạy tôi tiếng Trung.','verb','Động từ dạy học.',++$v14);
$v14_5=v($conn,$L14,1,'对','duì','đúng, phải','đúng','你说得对。','Nǐ shuō de duì.','Bạn nói đúng.','adj','Tính từ chỉ sự chính xác.',++$v14);
$v14_6=v($conn,$L14,1,'聪明','cōngming','thông minh','thông minh','你很聪明。','Nǐ hěn cōngming.','Bạn rất thông minh.','adj','Khen ngợi trí tuệ.',++$v14);
// Grammar L14
$g14_1=g($conn,$L14,'Bổ ngữ tình huống 得','Động từ + 得 + Tính từ','Làm gì đó như thế nào','Dùng để mô tả cách thức, mức độ của hành động. 得 nối động từ với bổ ngữ.','Phủ định: V + 得 + 不 + Adj (说得不好). Câu hỏi: V + 得 + Adj + 吗？','Cấu trúc mô tả hành động.',1);
ge($conn,$g14_1,'你说得很好。','Nǐ shuō de hěn hǎo.','Bạn nói rất hay.',1);
ge($conn,$g14_1,'他写得不好。','Tā xiě de bù hǎo.','Anh ấy viết không tốt.',2);
ge($conn,$g14_1,'我学得很快。','Wǒ xué de hěn kuài.','Tôi học rất nhanh.',3);
$g14_2=g($conn,$L14,'Động từ làm chủ ngữ','Động từ + O + Tính từ','Làm gì đó như thế nào','Trong tiếng Trung, động từ hoặc cụm động từ có thể làm chủ ngữ.','Ví dụ: 学汉语 (học TQ) + 很有意思 (rất thú vị). Cả cụm là chủ ngữ.','Cấu trúc câu đặc biệt.',2);
ge($conn,$g14_2,'学汉语很有意思。','Xué Hànyǔ hěn yǒu yìsi.','Học tiếng Trung rất thú vị.',1);
ge($conn,$g14_2,'跑步对身体好。','Pǎobù duì shēntǐ hǎo.','Chạy bộ tốt cho sức khỏe.',2);
// Dialogues L14
$d14_1=d($conn,$L14,'Khen kha nang','Khen ngợi khả năng ngoại ngữ.',1);
ds($conn,$d14_1,'Xiao Ming','你汉语说得很好！','Nǐ Hànyǔ shuō de hěn hǎo!','Bạn nói tiếng Trung rất hay!',1);
ds($conn,$d14_1,'Anna','哪里哪里，我还在学习。','Nǎlǐ nǎlǐ, wǒ hái zài xuéxí.','Đâu có, tôi vẫn đang học.',2);
ds($conn,$d14_1,'Xiao Ming','你写汉字也写得很好。','Nǐ xiě Hànzì yě xiě de hěn hǎo.','Bạn viết chữ Hán cũng đẹp.',3);
$d14_2=d($conn,$L14,'Hoc tap cham chi','Nói về sự chăm chỉ.',2);
ds($conn,$d14_2,'Anna','你每天学习多长时间？','Nǐ měitiān xuéxí duō cháng shíjiān?','Mỗi ngày bạn học bao lâu?',1);
ds($conn,$d14_2,'Xiao Ming','我学两个小时。','Wǒ xué liǎng gè xiǎoshí.','Tôi học 2 tiếng.',2);
ds($conn,$d14_2,'Anna','你很努力！真聪明。','Nǐ hěn nǔlì! Zhēn cōngming.','Bạn rất chăm chỉ! Thật thông minh.',3);
$d14_3=d($conn,$L14,'Hoi y kien','Hỏi ý kiến về việc học.',3);
ds($conn,$d14_3,'Anna','你觉得学汉语难吗？','Nǐ juéde xué Hànyǔ nán ma?','Bạn thấy học TQ khó không?',1);
ds($conn,$d14_3,'Xiao Ming','不难，很有意思。','Bù nán, hěn yǒu yìsi.','Không khó, rất thú vị.',2);
ds($conn,$d14_3,'Anna','你说得对。','Nǐ shuō de duì.','Bạn nói đúng.',3);
// Reading L14
r($conn,$L14,'Hoc tieng Trung that thu vi','我的朋友Anna是法国人。她汉语说得很好。她写汉字也写得很好。她很努力，每天学习两个小时。我教她汉语。她说学汉语很有意思，不难。她很聪明，学得很快。','Wǒ de péngyou Anna shì Fǎguó rén. Tā Hànyǔ shuō de hěn hǎo. Tā xiě Hànzì yě xiě de hěn hǎo. Tā hěn nǔlì, měitiān xuéxí liǎng gè xiǎoshí. Wǒ jiāo tā Hànyǔ. Tā shuō xué Hànyǔ hěn yǒu yìsi, bù nán. Tā hěn cōngming, xué de hěn kuài.','Bạn tôi Anna là người Pháp. Cô ấy nói TQ rất hay. Viết chữ Hán cũng đẹp. Cô ấy rất chăm chỉ, mỗi ngày học 2 tiếng. Tôi dạy cô ấy TQ. Cô ấy nói học TQ thú vị, không khó. Cô ấy thông minh, học rất nhanh.','easy',85,1);
// Listening L14
$L14l=l($conn,$L14,'Khen nguoi khac','A:你写汉字写得很好。B:哪里，我写得不好。A:你学得很快。B:老师教得好。','A:Nǐ xiě Hànzì xiě de hěn hǎo. B:Nǎlǐ, wǒ xiě de bù hǎo. A:Nǐ xué de hěn kuài. B:Lǎoshī jiāo de hǎo.','A:Bạn viết chữ Hán rất đẹp. B:Đâu có, tôi viết không tốt. A:Bạn học rất nhanh. B:Thầy giáo dạy hay.','1');
lq($conn,$L14l,'Người B nghĩ chữ Hán của mình thế nào?','{"A":"Đẹp","B":"Không tốt","C":"Rất tốt"}','Không tốt','Khiêm tốn nói không tốt.','multiple_choice',1);
lq($conn,$L14l,'Tại sao người B học nhanh?','{"A":"Thông minh","B":"Chăm chỉ","C":"Thầy dạy hay"}','Thầy dạy hay','Vì thầy dạy tốt.','multiple_choice',2);
// Exercises L14
$E14_1=e($conn,$L14,'Chọn đáp án','"得" trong "说得很好" là:','multiple_choice','easy',1,'C',1);
eo($conn,$E14_1,'Trợ từ sở hữu','A',0,1); eo($conn,$E14_1,'Động từ','B',0,2); eo($conn,$E14_1,'Bổ ngữ tình huống','C',1,3);
$E14_2=e($conn,$L14,'Điền 得','你说___很好。','fill_blank','easy',1,'得',2);
$E14_3=e($conn,$L14,'Dịch','"Học tiếng Trung rất thú vị."','translation','easy',1,'学汉语很有意思。',3);
$E14_4=e($conn,$L14,'Sắp xếp câu','很好 / 说 / 得 / 你','sentence_order','easy',1,'你说得很好。',4);
$E14_5=e($conn,$L14,'Chọn đúng/sai','"努力" có nghĩa là "thông minh".','true_false','easy',1,'false',5);
eo($conn,$E14_5,'Đúng','A',0,1); eo($conn,$E14_5,'Sai','B',1,2);
$E14_6=e($conn,$L14,'Chọn đáp án','"有意思" có nghĩa là:','multiple_choice','easy',1,'A',6);
eo($conn,$E14_6,'Thú vị','A',1,1); eo($conn,$E14_6,'Ý kiến','B',0,2); eo($conn,$E14_6,'Chán','C',0,3);
// Review L14
foreach ([$v14_1,$v14_2,$v14_3,$v14_4,$v14_5,$v14_6] as $i=>$vid) if ($vid) rv($conn,$L14,$vid,'core',$i+1);
echo " L14 done: $v14 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L15: 我想学汉语 ───
$L15=createLesson($conn,1,15,'Bài 15: Wo xiang xue Han yu - Tôi muốn học TQ','Tổng hợp. Dự định, kế hoạch. 因为...所以...','["Dinh huong","Ke hoach","Tong hop"]','Tong hop','easy','Bài 15 tổng kết HSK1. Bày tỏ nguyện vọng: dǎsuàn (dự định), zhǔnbèi (chuẩn bị). Cấu trúc nhân quả: yīnwèi...suǒyǐ... (vì...nên...). Học cách nói về kế hoạch tương lai, mục tiêu học tập.');
$v15=0;
$v15_1=v($conn,$L15,1,'打算','dǎsuàn','dự định, tính','dự định','我打算去北京。','Wǒ dǎsuàn qù Běijīng.','Tôi dự định đi Bắc Kinh.','verb','Động từ chỉ kế hoạch.',++$v15);
$v15_2=v($conn,$L15,1,'准备','zhǔnbèi','chuẩn bị','chuẩn bị','准备考试。','Zhǔnbèi kǎoshì.','Chuẩn bị thi.','verb','Động từ chuẩn bị.',++$v15);
$v15_3=v($conn,$L15,1,'考试','kǎoshì','bài thi, kỳ thi','thi','HSK考试。','HSK kǎoshì.','Kỳ thi HSK.','noun','kǎo (khảo) + shì (thí).',++$v15);
$v15_4=v($conn,$L15,1,'因为','yīnwèi','bởi vì','vì','因为喜欢。','Yīnwèi xǐhuan.','Bởi vì thích.','conj','Liên từ chỉ nguyên nhân.',++$v15);
$v15_5=v($conn,$L15,1,'所以','suǒyǐ','cho nên, vì vậy','nên','所以想学。','Suǒyǐ xiǎng xué.','Cho nên muốn học.','conj','Liên từ chỉ kết quả.',++$v15);
$v15_6=v($conn,$L15,1,'中国','Zhōngguó','Trung Quốc','Trung Quốc','去中国。','Qù Zhōngguó.','Đi Trung Quốc.','noun','Đất nước Trung Quốc.',++$v15);
$v15_7=v($conn,$L15,1,'以后','yǐhòu','sau này, sau đó','sau này','以后再说。','Yǐhòu zài shuō.','Sau này nói tiếp.','noun','Chỉ thời gian tương lai.',++$v15);
$v15_8=v($conn,$L15,1,'帮助','bāngzhù','giúp đỡ','giúp','帮助别人。','Bāngzhù biérén.','Giúp đỡ người khác.','verb','Động từ giúp đỡ.',++$v15);
// Grammar L15
$g15_1=g($conn,$L15,'Cấu trúc nhân quả: 因为...所以...','因为 + Nguyên nhân, 所以 + Kết quả','Vì...nên...','Cặp liên từ biểu thị quan hệ nhân quả. Có thể dùng cả hai hoặc chỉ một.','Có thể bỏ 因为, chỉ dùng 所以. Hoặc bỏ 所以, chỉ dùng 因为.','Liên từ nhân quả cơ bản.',1);
ge($conn,$g15_1,'因为喜欢汉语，所以我想学。','Yīnwèi xǐhuan Hànyǔ, suǒyǐ wǒ xiǎng xué.','Vì thích tiếng Trung, nên tôi muốn học.',1);
ge($conn,$g15_1,'因为很忙，所以没有时间。','Yīnwèi hěn máng, suǒyǐ méiyǒu shíjiān.','Vì rất bận, nên không có thời gian.',2);
$g15_2=g($conn,$L15,'Cấu trúc dự định: 打算/准备','打算/准备 + V','Dự định sẽ làm gì','打算 và 准备 đều có nghĩa là "dự định", "chuẩn bị". 打算 nhấn mạnh ý định. 准备 nhấn mạnh sự chuẩn bị.','Phủ định: 不打算 + V / 没准备 + V.','Bày tỏ dự định.',2);
ge($conn,$g15_2,'我打算去中国留学。','Wǒ dǎsuàn qù Zhōngguó liúxué.','Tôi dự định đi du học Trung Quốc.',1);
ge($conn,$g15_2,'她准备HSK考试。','Tā zhǔnbèi HSK kǎoshì.','Cô ấy chuẩn bị thi HSK.',2);
// Dialogues L15
$d15_1=d($conn,$L15,'Ke hoach tuong lai','Nói về dự định tương lai.',1);
ds($conn,$d15_1,'Xiao Ming','你以后想做什么？','Nǐ yǐhòu xiǎng zuò shénme?','Sau này bạn muốn làm gì?',1);
ds($conn,$d15_1,'Anna','我想当汉语老师。','Wǒ xiǎng dāng Hànyǔ lǎoshī.','Tôi muốn làm giáo viên tiếng Trung.',2);
ds($conn,$d15_1,'Xiao Ming','那你打算学多久汉语？','Nà nǐ dǎsuàn xué duōjiǔ Hànyǔ?','Vậy bạn định học tiếng Trung bao lâu?',3);
ds($conn,$d15_1,'Anna','我打算学三年。','Wǒ dǎsuàn xué sān nián.','Tôi định học ba năm.',4);
$d15_2=d($conn,$L15,'Vi sao hoc tieng Trung','Hỏi về lý do học tiếng Trung.',2);
ds($conn,$d15_2,'Anna','你为什么学汉语？','Nǐ wèi shénme xué Hànyǔ?','Tại sao bạn học tiếng Trung?',1);
ds($conn,$d15_2,'Xiao Ming','因为中文很有意思，所以我想学。','Yīnwèi Zhōngwén hěn yǒu yìsi, suǒyǐ wǒ xiǎng xué.','Vì tiếng Trung rất thú vị, nên tôi muốn học.',2);
ds($conn,$d15_2,'Anna','我也觉得中文很有意思。','Wǒ yě juéde Zhōngwén hěn yǒu yìsi.','Tôi cũng thấy tiếng Trung rất thú vị.',3);
$d15_3=d($conn,$L15,'Chuan bi thi HSK','Chuẩn bị cho kỳ thi HSK.',3);
ds($conn,$d15_3,'Anna','你准备HSK考试吗？','Nǐ zhǔnbèi HSK kǎoshì ma?','Bạn chuẩn bị thi HSK à?',1);
ds($conn,$d15_3,'Xiao Ming','对，我准备HSK1。','Duì, wǒ zhǔnbèi HSK1.','Đúng, tôi chuẩn bị thi HSK1.',2);
ds($conn,$d15_3,'Anna','加油！你一定能考好。','Jiāyóu! Nǐ yídìng néng kǎo hǎo.','Cố lên! Bạn nhất định sẽ thi tốt.',3);
// Reading L15
r($conn,$L15,'Ke hoach hoc tap cua toi','我喜欢汉语，因为中文很有意思。我打算明年去中国留学。现在每天学习两个小时，准备HSK考试。朋友帮助我学习。以后我想当汉语老师，帮助别人学习中文。','Wǒ xǐhuan Hànyǔ, yīnwèi Zhōngwén hěn yǒu yìsi. Wǒ dǎsuàn míngnián qù Zhōngguó liúxué. Xiànzài měitiān xuéxí liǎng gè xiǎoshí, zhǔnbèi HSK kǎoshì. Péngyou bāngzhù wǒ xuéxí. Yǐhòu wǒ xiǎng dāng Hànyǔ lǎoshī, bāngzhù biérén xuéxí Zhōngwén.','Tôi thích tiếng Trung, vì tiếng Trung rất thú vị. Tôi dự định năm sau đi du học Trung Quốc. Bây giờ mỗi ngày học 2 tiếng, chuẩn bị thi HSK. Bạn bè giúp tôi học. Sau này tôi muốn làm giáo viên tiếng Trung, giúp người khác học tiếng Trung.','easy',95,1);
// Listening L15
$L15l=l($conn,$L15,'Ke hoach','A:你打算学汉语吗？B:对，我打算学。A:为什么？B:因为我想去中国。A:那你一定努力。B:谢谢！加油！','A:Nǐ dǎsuàn xué Hànyǔ ma? B:Duì, wǒ dǎsuàn xué. A:Wèi shénme? B:Yīnwèi wǒ xiǎng qù Zhōngguó. A:Nà nǐ yídìng nǔlì. B:Xièxie! Jiāyóu!','A:Bạn định học TQ không? B:Vâng. A:Sao? B:Vì muốn đi TQ. A:Vậy bạn nhất định phải chăm chỉ. B:Cảm ơn! Cố lên!','1');
lq($conn,$L15l,'Người B có định học TQ không?','{"A":"Có","B":"Không","C":"Chưa biết"}','Có','Dự định học.','multiple_choice',1);
lq($conn,$L15l,'Tại sao người B học TQ?','{"A":"Thích","B":"Muốn đi TQ","C":"Bắt buộc"}','Muốn đi TQ','Vì muốn đến Trung Quốc.','multiple_choice',2);
// Exercises L15
$E15_1=e($conn,$L15,'Chọn đáp án','"Bởi vì...cho nên" là:','multiple_choice','easy',1,'A',1);
eo($conn,$E15_1,'因为...所以...','A',1,1); eo($conn,$E15_1,'虽然...但是...','B',0,2); eo($conn,$E15_1,'不但...而且...','C',0,3);
$E15_2=e($conn,$L15,'Dịch','"Tôi dự định đi Trung Quốc."','translation','easy',1,'我打算去中国。',2);
$E15_3=e($conn,$L15,'Điền từ','我___去中国留学。(dự định)','fill_blank','easy',1,'打算',3);
$E15_4=e($conn,$L15,'Sắp xếp câu','所以 / 喜欢 / 我 / 因为 / 学','sentence_order','easy',1,'因为喜欢，所以我学。',4);
$E15_5=e($conn,$L15,'Chọn đúng/sai','"帮助" có nghĩa là "giúp đỡ".','true_false','easy',1,'true',5);
eo($conn,$E15_5,'Đúng','A',1,1); eo($conn,$E15_5,'Sai','B',0,2);
$E15_6=e($conn,$L15,'Điền từ','以后我___当老师。','fill_blank','easy',1,'想',6);
$E15_7=e($conn,$L15,'Hoàn thành câu','因为汉语很有意思，___。','fill_blank','easy',1,'所以我想学',7);
// Review L15
foreach ([$v15_1,$v15_2,$v15_3,$v15_4,$v15_5,$v15_6,$v15_7,$v15_8] as $i=>$vid) if ($vid) rv($conn,$L15,$vid,'core',$i+1);
echo " L15 done: $v15 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══ HSK1 COMPLETE ═══
echo "\n=== HSK1 COMPLETE (15 lessons) ===\n";
echo "Total: ~180 vocabulary, 35+ grammar points, 45 dialogues, 15 reading, 15 listening, 100+ exercises\n";
