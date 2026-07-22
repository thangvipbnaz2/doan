<?php
/**
 * HÀNNGỮ - HSK1 Content Seeder
 * Official HSK Standard Course (15 lessons, ~150 words)
 * Run: php database/seed_hsk1.php
 */
require_once __DIR__ . '/seed_helpers.php';
require_once __DIR__ . '/../db.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");
$start=microtime(true);

getOrCreateLevel($conn,1,'HSK 1','So cap','150 tu co ban, 15 bai.',150,15);
clearLevel($conn,1);
echo "\n=== SEEDING HSK1 (15 lessons) ===\n\n";

// ─── L1: 你好 ───
$L1=createLesson($conn,1,1,'Bài 1: Ni Hao - Xin chào','Chào hỏi co ban, gioi thieu ban than.','["Chào hỏi","Gioi thieu","Ho tham"]','Chào hỏi','easy','Bài 1 giới thiệu các câu chào hỏi cơ bản trong tiếng Trung: nǐ hǎo (xin chào), zàijiàn (tạm biệt), xièxie (cảm ơn). Học cách tự giới thiệu tên, hỏi thăm sức khỏe. Ngữ pháp: câu trần thuật với 是, câu hỏi với 吗, phó từ phủ định 不.');
$v1=0;
$v1_1=v($conn,$L1,1,'你好','nǐ hǎo','xin chào','xin chào','你好！','Nǐ hǎo!','Xin chào!','greeting','Từ ghép: nǐ (bạn) + hǎo (tốt). Câu chào phổ biến nhất trong tiếng Trung.',++$v1);
$v1_2=v($conn,$L1,1,'我','wǒ','tôi, tớ','tôi','我是学生。','Wǒ shì xuéshēng.','Tôi là học sinh.','pronoun','Đại từ nhân xưng ngôi thứ nhất số ít.',++$v1);
$v1_3=v($conn,$L1,1,'你','nǐ','bạn, anh, chị','bạn','你好吗？','Nǐ hǎo ma?','Bạn có khỏe không?','pronoun','Đại từ nhân xưng ngôi thứ hai.',++$v1);
$v1_4=v($conn,$L1,1,'好','hǎo','tốt, khỏe, được','tốt','我很好。','Wǒ hěn hǎo.','Tôi rất khỏe.','adj','Tính từ đa nghĩa: tốt, khỏe, ổn.',++$v1);
$v1_5=v($conn,$L1,1,'是','shì','là','là','我是老师。','Wǒ shì lǎoshī.','Tôi là giáo viên.','verb','Động từ "là". Lưu ý: không dùng với 很.',++$v1);
$v1_6=v($conn,$L1,1,'不','bù','không (phủ định)','không','我不是学生。','Wǒ bú shì xuéshēng.','Tôi không phải học sinh.','adv','Phó từ phủ định. Biến âm thành bú trước từ thanh 4.',++$v1);
$v1_7=v($conn,$L1,1,'很','hěn','rất','rất','他很好。','Tā hěn hǎo.','Anh ấy rất tốt.','adv','Phó từ chỉ mức độ. Không mang nghĩa mạnh.',++$v1);
$v1_8=v($conn,$L1,1,'吗','ma','(trợ từ nghi vấn)','không','你好吗？','Nǐ hǎo ma?','Bạn có khỏe không?','particle','Đặt cuối câu để tạo câu hỏi Có/Không.',++$v1);
$v1_9=v($conn,$L1,1,'谢谢','xièxie','cảm ơn','cảm ơn','谢谢老师！','Xièxie lǎoshī!','Cảm ơn thầy giáo!','verb','Từ lặp âm, thường dùng trong giao tiếp hàng ngày.',++$v1);
$v1_10=v($conn,$L1,1,'再见','zàijiàn','tạm biệt','tạm biệt','明天见！','Míngtiān jiàn!','Hẹn ngày mai gặp!','verb','zài (lại) + jiàn (gặp) = gặp lại.',++$v1);
$v1_11=v($conn,$L1,1,'请','qǐng','mời, làm ơn','mời','请进！','Qǐng jìn!','Mời vào!','verb','Dùng trong lời mời hoặc yêu cầu lịch sự.',++$v1);
$v1_12=v($conn,$L1,1,'对不起','duìbuqǐ','xin lỗi','xin lỗi','对不起，我来晚了。','Duìbuqǐ, wǒ lái wǎn le.','Xin lỗi, tôi đến muộn.','expression','Cụm từ xin lỗi thông dụng.',++$v1);
// Grammar L1
$g1_1=g($conn,$L1,'Câu trần thuật với 是','A + 是 + B','A là B','Dùng để giới thiệu, định nghĩa. Chủ ngữ + 是 + Danh từ.','是 là động từ "là". Không dùng 很 trước 是. Khi phủ định dùng 不 + 是.','是 là động từ đặc biệt.',1);
ge($conn,$g1_1,'我是学生。','Wǒ shì xuéshēng.','Tôi là học sinh.',1);
ge($conn,$g1_1,'他是老师。','Tā shì lǎoshī.','Anh ấy là giáo viên.',2);
ge($conn,$g1_1,'我不是学生。','Wǒ bú shì xuéshēng.','Tôi không phải học sinh.',3);
$g1_2=g($conn,$L1,'Câu hỏi với 吗','Câu trần thuật + 吗？','...phải không? / ...có ... không?','Thêm 吗 cuối câu trần thuật để tạo câu hỏi.','Không thay đổi trật tự từ. Chỉ cần thêm 吗 ở cuối câu. Trả lời: 是/shì de hoặc 不/bù + V.','Dạng câu hỏi đơn giản nhất.',2);
ge($conn,$g1_2,'你是学生吗？','Nǐ shì xuéshēng ma?','Bạn là học sinh phải không?',1);
ge($conn,$g1_2,'你好吗？','Nǐ hǎo ma?','Bạn khỏe không?',2);
$g1_3=g($conn,$L1,'Phó từ 不 (phủ định)','不 + Động từ / Tính từ','Không...','Phủ định động từ hoặc tính từ.','Trước từ thanh 4 (ˋ), 不 đọc thành bú. Các thanh khác đọc là bù.','Phủ định cơ bản nhất.',3);
ge($conn,$g1_3,'我不是老师。','Wǒ bú shì lǎoshī.','Tôi không phải giáo viên.',1);
ge($conn,$g1_3,'他不好。','Tā bù hǎo.','Anh ấy không tốt.',2);
// Dialogues L1
$d1_1=d($conn,$L1,'Chào hỏi lan dau','Xiao Ming và Anna gặp nhau lần đầu tại trường.',1);
ds($conn,$d1_1,'Xiao Ming','你好！','Nǐ hǎo!','Chào bạn!',1);
ds($conn,$d1_1,'Anna','你好！','Nǐ hǎo!','Chào bạn!',2);
ds($conn,$d1_1,'Xiao Ming','你叫什么名字？','Nǐ jiào shénme míngzì?','Bạn tên là gì?',3);
ds($conn,$d1_1,'Anna','我叫Anna。','Wǒ jiào Anna.','Tôi tên là Anna.',4);
ds($conn,$d1_1,'Xiao Ming','我是学生。你呢？','Wǒ shì xuéshēng. Nǐ ne?','Tôi là học sinh. Còn bạn?',5);
ds($conn,$d1_1,'Anna','我也是学生。','Wǒ yě shì xuéshēng.','Tôi cũng là học sinh.',6);
$d1_2=d($conn,$L1,'Ho tham suc khoe','Hai người bạn gặp lại nhau sau kỳ nghỉ.',2);
ds($conn,$d1_2,'Xiao Ming','你好吗？','Nǐ hǎo ma?','Bạn khỏe không?',1);
ds($conn,$d1_2,'Anna','我很好，谢谢！你呢？','Wǒ hěn hǎo, xièxie! Nǐ ne?','Tôi rất khỏe, cảm ơn! Còn bạn?',2);
ds($conn,$d1_2,'Xiao Ming','我也很好。再见！','Wǒ yě hěn hǎo. Zàijiàn!','Tôi cũng rất khỏe. Tạm biệt!',3);
ds($conn,$d1_2,'Anna','再见！','Zàijiàn!','Tạm biệt!',4);
$d1_3=d($conn,$L1,'Xin loi va cam on','Tình huống trong lớp học.',3);
ds($conn,$d1_3,'Anna','对不起，老师。','Duìbuqǐ, lǎoshī.','Xin lỗi thầy.',1);
ds($conn,$d1_3,'老师','没关系。请进！','Méi guānxi. Qǐng jìn!','Không sao. Mời vào!',2);
ds($conn,$d1_3,'Anna','谢谢老师！','Xièxie lǎoshī!','Cảm ơn thầy!',3);
// Reading L1
r($conn,$L1,'Nguoi ban moi cua toi','你好！我叫小明。我是学生。她叫Anna，她是我的朋友。她是中国人。我们都很高兴认识。','Nǐ hǎo! Wǒ jiào Xiǎo Míng. Wǒ shì xuéshēng. Tā jiào Anna, tā shì wǒ de péngyou. Tā shì Zhōngguó rén. Wǒmen dōu hěn gāoxìng rènshi.','Xin chào! Tôi tên là Tiểu Minh. Tôi là học sinh. Cô ấy tên là Anna, cô ấy là bạn của tôi. Cô ấy là người Trung Quốc. Chúng tôi đều rất vui được quen biết.','easy',42,1);
// Listening L1
$L1l=l($conn,$L1,'Chao hoi co ban','A:你好！B:你好！A:你叫什么名字？B:我叫小明。A:你是学生吗？B:是的，我是学生。','A:Nǐ hǎo! B:Nǐ hǎo! A:Nǐ jiào shénme míngzì? B:Wǒ jiào Xiǎo Míng. A:Nǐ shì xuéshēng ma? B:Shì de, wǒ shì xuéshēng.','A:Chào bạn! B:Chào bạn! A:Bạn tên gì? B:Tôi tên Tiểu Minh. A:Bạn là học sinh phải không? B:Vâng, tôi là học sinh.',1);
lq($conn,$L1l,'Đoạn hội thoại có mấy người?','{"A":"1 người","B":"2 người","C":"3 người"}','2 người','Có 2 người nói chuyện.','multiple_choice',1);
lq($conn,$L1l,'Người B tên là gì?','{"A":"Anna","B":"Xiao Ming","C":"Wang Ming"}','Xiao Ming','Người B tên là Xiao Ming.','multiple_choice',2);
lq($conn,$L1l,'Người B có phải học sinh không?','{"A":"Phải","B":"Không phải","C":"Không biết"}','Phải','Người B nói "Tôi là học sinh".','multiple_choice',3);
// Exercises L1
$E1_1=e($conn,$L1,'Chọn đáp án đúng','"Xin chào" trong tiếng Trung là gì?','multiple_choice','easy',1,'A',1);
eo($conn,$E1_1,'你好','A',1,1); eo($conn,$E1_1,'谢谢','B',0,2); eo($conn,$E1_1,'再见','C',0,3);
$E1_2=e($conn,$L1,'Dịch sang tiếng Trung','Dịch câu sau: "Tôi là học sinh."','translation','easy',1,'我是学生。',2);
$E1_3=e($conn,$L1,'Sắp xếp thành câu hoàn chỉnh','学生 / 是 / 我','sentence_order','easy',1,'我是学生。',3);
$E1_4=e($conn,$L1,'Điền từ vào chỗ trống','你___吗？(Bạn khỏe không?)','fill_blank','easy',1,'好',4);
$E1_5=e($conn,$L1,'Chọn đúng hoặc sai','"谢谢" có nghĩa là "xin lỗi".','true_false','easy',1,'false',5);
eo($conn,$E1_5,'Đúng','A',0,1); eo($conn,$E1_5,'Sai','B',1,2);
$E1_6=e($conn,$L1,'Chọn từ khác loại','Từ nào khác loại với các từ còn lại?','multiple_choice','easy',1,'C',6);
eo($conn,$E1_6,'我','A',0,1); eo($conn,$E1_6,'你','B',0,2); eo($conn,$E1_6,'好','C',1,3);
$E1_7=e($conn,$L1,'Nối câu hỏi với câu trả lời','Nối câu hỏi ở cột A với câu trả lời ở cột B.','matching','medium',1,'1-B,2-C,3-A',7);
$E1_8=e($conn,$L1,'Viết lại câu phủ định','Chuyển câu sau sang dạng phủ định: "我是老师。"','translation','easy',1,'我不是老师。',8);
// Review vocab L1
foreach ([$v1_1,$v1_2,$v1_3,$v1_4,$v1_5,$v1_8,$v1_9,$v1_10,$v1_12] as $i=>$vid) if ($vid) rv($conn,$L1,$vid,'core',$i+1);
echo " L1 done: $v1 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 8 exercises\n";

// ─── L2: 谢谢你 ───
$L2=createLesson($conn,1,2,'Bài 2: Xie xie ni - Cảm ơn bạn','Cam on, xin loi va dap lai. So huu voi 的, dong tu 有.','["Cam on","Xin loi","So huu"]','Xa giao','easy','Bài 2: Học cách cảm ơn (xièxie), đáp lại lời cảm ơn (bú kèqì), xin lỗi (duìbuqǐ) và đáp lại (méi guānxi). Giới thiệu trợ từ sở hữu 的, động từ 有 (có), phó từ 也 (cũng).');
$v2=0;
$v2_1=v($conn,$L2,1,'不客气','bú kèqì','không có gì, không phải khách sáo','không có gì','谢谢！-- 不客气！','Xièxie! -- Bú kèqì!','Cảm ơn! -- Không có gì!','expression','Đáp lại lời cảm ơn thông dụng.',++$v2);
$v2_2=v($conn,$L2,1,'没关系','méi guānxi','không sao, không có gì','không sao','对不起！-- 没关系。','Duìbuqǐ! -- Méi guānxi.','Xin lỗi! -- Không sao.','expression','Đáp lại lời xin lỗi.',++$v2);
$v2_3=v($conn,$L2,1,'的','de','của (trợ từ sở hữu)','của','我的书。','Wǒ de shū.','Sách của tôi.','particle','Trợ từ sở hữu: Đại từ/Người + 的 + Danh từ.',++$v2);
$v2_4=v($conn,$L2,1,'也','yě','cũng','cũng','我也是学生。','Wǒ yě shì xuéshēng.','Tôi cũng là học sinh.','adv','Phó từ "cũng", đứng trước động từ.',++$v2);
$v2_5=v($conn,$L2,1,'人','rén','người','người','一个人。','Yí gè rén.','Một người.','noun','Danh từ chỉ người.',++$v2);
$v2_6=v($conn,$L2,1,'中国','Zhōngguó','Trung Quốc','Trung Quốc','我是中国人。','Wǒ shì Zhōngguó rén.','Tôi là người Trung Quốc.','noun','Zhong (trung) + guo (nước) = Trung Quốc.',++$v2);
$v2_7=v($conn,$L2,1,'朋友','péngyou','bạn, bạn bè','bạn bè','他是我的朋友。','Tā shì wǒ de péngyou.','Anh ấy là bạn của tôi.','noun','Chỉ người bạn.',++$v2);
$v2_8=v($conn,$L2,1,'有','yǒu','có','có','我有一本书。','Wǒ yǒu yì běn shū.','Tôi có một quyển sách.','verb','Động từ chỉ sự sở hữu. Phủ định: 没有.',++$v2);
$v2_9=v($conn,$L2,1,'没有','méiyǒu','không có','không có','我没有钱。','Wǒ méiyǒu qián.','Tôi không có tiền.','verb','Phủ định của 有. Cũng dùng để phủ định sự tồn tại.',++$v2);
$v2_10=v($conn,$L2,1,'什么','shénme','cái gì, gì','gì','这是什么？','Zhè shì shénme?','Đây là cái gì?','pronoun','Đại từ nghi vấn "cái gì".',++$v2);
$v2_11=v($conn,$L2,1,'老师','lǎoshī','giáo viên','giáo viên','王老师好！','Wáng lǎoshī hǎo!','Chào thầy Vương!','noun','Từ xưng hô cho giáo viên.',++$v2);
$v2_12=v($conn,$L2,1,'学生','xuéshēng','học sinh','học sinh','他是好学生。','Tā shì hǎo xuéshēng.','Anh ấy là học sinh giỏi.','noun','xué (học) + shēng (sinh) = học sinh.',++$v2);
// Grammar L2
$g2_1=g($conn,$L2,'Trợ từ so huu 的','Danh tu/Dai tu + 的 + Danh tu','của...','Biểu thị quan hệ sở hữu.','Khi quan hệ thân thuộc (người thân) có thể bỏ 的. Ví dụ: 我爸爸 (bố tôi).','的 là trợ từ quan trọng nhất.',1);
ge($conn,$g2_1,'我的书。','Wǒ de shū.','Sách của tôi.',1);
ge($conn,$g2_1,'他的朋友。','Tā de péngyou.','Bạn của anh ấy.',2);
ge($conn,$g2_1,'老师的书。','Lǎoshī de shū.','Sách của giáo viên.',3);
$g2_2=g($conn,$L2,'Dong tu 有','Chu ngu + 有 + Tan ngu','Có...','Diễn tả sự sở hữu.','Phủ định dùng 没有. Câu hỏi: 有 + Tan ngu + 吗？','Cấu trúc sở hữu cơ bản.',2);
ge($conn,$g2_2,'我有一本书。','Wǒ yǒu yì běn shū.','Tôi có một quyển sách.',1);
ge($conn,$g2_2,'他有朋友吗？','Tā yǒu péngyou ma?','Anh ấy có bạn không?',2);
ge($conn,$g2_2,'我没有钱。','Wǒ méiyǒu qián.','Tôi không có tiền.',3);
$g2_3=g($conn,$L2,'Pho tu 也','Chu ngu + 也 + Dong tu','Cũng...','Diễn tả "cũng vậy".','也 đứng trước động từ, không đứng cuối câu.','Vị trí: trước động từ.',3);
ge($conn,$g2_3,'我也是学生。','Wǒ yě shì xuéshēng.','Tôi cũng là học sinh.',1);
ge($conn,$g2_3,'他也是老师。','Tā yě shì lǎoshī.','Anh ấy cũng là giáo viên.',2);
// Dialogues L2
$d2_1=d($conn,$L2,'Cam on thay giao','Học sinh cảm ơn thầy giáo sau giờ học.',1);
ds($conn,$d2_1,'Học sinh','谢谢老师！','Xièxie lǎoshī!','Cảm ơn thầy!',1);
ds($conn,$d2_1,'Thầy giáo','不客气。','Bú kèqì.','Không có gì.',2);
ds($conn,$d2_1,'Học sinh','老师，这是什么？','Lǎoshī, zhè shì shénme?','Thầy ơi, đây là cái gì?',3);
ds($conn,$d2_1,'Thầy giáo','这是我的书。','Zhè shì wǒ de shū.','Đây là sách của tôi.',4);
$d2_2=d($conn,$L2,'Xin loi va tha thu','Xiao Ming vô tình va phải Anna.',2);
ds($conn,$d2_2,'Xiao Ming','对不起！','Duìbuqǐ!','Xin lỗi!',1);
ds($conn,$d2_2,'Anna','没关系。你是学生吗？','Méi guānxi. Nǐ shì xuéshēng ma?','Không sao. Bạn là học sinh à?',2);
ds($conn,$d2_2,'Xiao Ming','是的，我是学生。你也是学生吗？','Shì de, wǒ shì xuéshēng. Nǐ yě shì xuéshēng ma?','Vâng, tôi là học sinh. Bạn cũng là học sinh à?',3);
ds($conn,$d2_2,'Anna','对，我也是学生。','Duì, wǒ yě shì xuéshēng.','Đúng, tôi cũng là học sinh.',4);
$d2_3=d($conn,$L2,'Hoi ve ban be','Hỏi nhau về bạn bè.',3);
ds($conn,$d2_3,'Xiao Ming','你有朋友吗？','Nǐ yǒu péngyou ma?','Bạn có bạn không?',1);
ds($conn,$d2_3,'Anna','有，我有一个朋友。他是中国人。','Yǒu, wǒ yǒu yí gè péngyou. Tā shì Zhōngguó rén.','Có, tôi có một người bạn. Anh ấy là người Trung Quốc.',2);
ds($conn,$d2_3,'Xiao Ming','他叫什么名字？','Tā jiào shénme míngzì?','Anh ấy tên là gì?',3);
ds($conn,$d2_3,'Anna','他叫王明。','Tā jiào Wáng Míng.','Anh ấy tên là Vương Minh.',4);
// Reading L2
r($conn,$L2,'Nguoi ban Trung Quoc cua toi','我有一个朋友。他是中国人。他叫王明。他是老师。他有一本书。我没有他的书。我们是好朋友。','Wǒ yǒu yí gè péngyou. Tā shì Zhōngguó rén. Tā jiào Wáng Míng. Tā shì lǎoshī. Tā yǒu yì běn shū. Wǒ méiyǒu tā de shū. Wǒmen shì hǎo péngyou.','Tôi có một người bạn. Anh ấy là người Trung Quốc. Tên là Vương Minh. Anh ấy là giáo viên. Anh ấy có một quyển sách. Tôi không có sách của anh ấy. Chúng tôi là bạn tốt.','easy',50,1);
// Listening L2
$L2l=l($conn,$L2,'Cam on va xin loi','A:谢谢你的书！B:不客气！A:你有书吗？B:有，我有一本。A:他的书呢？B:我没有他的书。','A:Xièxie nǐ de shū! B:Bú kèqì! A:Nǐ yǒu shū ma? B:Yǒu, wǒ yǒu yì běn. A:Tā de shū ne? B:Wǒ méiyǒu tā de shū.','A:Cảm ơn sách của bạn! B:Không có gì! A:Bạn có sách không? B:Có, tôi có một quyển. A:Sách của anh ấy thì sao? B:Tôi không có sách của anh ấy.',1);
lq($conn,$L2l,'Người A cảm ơn vì điều gì?','{"A":"Cuốn sách","B":"Món quà","C":"Lời chúc"}','Cuốn sách','Cảm ơn vì cuốn sách.','multiple_choice',1);
lq($conn,$L2l,'Người B trả lời thế nào?','{"A":"Xièxie","B":"Bú kèqì","C":"Duìbuqǐ"}','Bú kèqì','Trả lời "không có gì".','multiple_choice',2);
lq($conn,$L2l,'Người A có sách của người kia không?','{"A":"Có","B":"Không có","C":"Không biết"}','Không có','Tôi không có sách của anh ấy.','multiple_choice',3);
// Exercises L2
$E2_1=e($conn,$L2,'Chọn đáp án đúng','"Không có gì" trong tiếng Trung là:','multiple_choice','easy',1,'A',1);
eo($conn,$E2_1,'不客气','A',1,1); eo($conn,$E2_1,'没关系','B',0,2); eo($conn,$E2_1,'对不起','C',0,3);
$E2_2=e($conn,$L2,'Điền trợ từ sở hữu','这是谁___书？(Đây là sách của ai?)','fill_blank','easy',1,'的',2);
$E2_3=e($conn,$L2,'Dịch câu','"Anh ấy có bạn không?"','translation','easy',1,'他有朋友吗？',3);
$E2_4=e($conn,$L2,'Sắp xếp câu','也 / 学生 / 我 / 是','sentence_order','easy',1,'我也是学生。',4);
$E2_5=e($conn,$L2,'Chọn đúng/sai','"也有" là "cũng có".','true_false','easy',1,'true',5);
eo($conn,$E2_5,'Đúng','A',1,1); eo($conn,$E2_5,'Sai','B',0,2);
$E2_6=e($conn,$L2,'Chuyển sang phủ định','Chuyển câu sau sang phủ định: "我有书。"','translation','easy',1,'我没有书。',6);
$E2_7=e($conn,$L2,'Chọn từ đúng','Tôi ___ là học sinh. (cũng)','fill_blank','easy',1,'也',7);
// Review L2
foreach ([$v2_1,$v2_2,$v2_3,$v2_4,$v2_7,$v2_8,$v2_9,$v2_10] as $i=>$vid) if ($vid) rv($conn,$L2,$vid,'core',$i+1);
echo " L2 done: $v2 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ─── L3: 你叫什么名字 ───
$L3=createLesson($conn,1,3,'Bài 3: Ni jiao shen me ming zi - Bạn tên là gì','Hoi ten, quoc tich, nghe nghiep. Tu hoi: shei/nǎr/shenme.','["Hoi ten","Quoc tich","Nghe nghiep"]','Gioi thieu','easy','Bài 3 dạy cách hỏi và trả lời về tên (jiào), quốc tịch (nǎ guó rén), nghề nghiệp. Các đại từ nghi vấn: shéi (ai), nǎr (đâu), shénme (gì). Phân biệt tā (anh ấy) và tā (cô ấy).');
$v3=0;
$v3_1=v($conn,$L3,1,'叫','jiào','tên là, gọi là','gọi là','你叫什么名字？','Nǐ jiào shénme míngzì?','Bạn tên là gì?','verb','Dùng để hỏi và nói tên.',++$v3);
$v3_2=v($conn,$L3,1,'名字','míngzì','tên (họ và tên)','tên','我的名字是李明。','Wǒ de míngzì shì Lǐ Míng.','Tên của tôi là Lý Minh.','noun','Họ + tên đầy đủ.',++$v3);
$v3_3=v($conn,$L3,1,'他','tā','anh ấy','anh ấy','他是中国人。','Tā shì Zhōngguó rén.','Anh ấy là người Trung Quốc.','pronoun','Đại từ nhân xưng ngôi thứ ba giống đực.',++$v3);
$v3_4=v($conn,$L3,1,'她','tā','cô ấy, chị ấy','cô ấy','她是老师。','Tā shì lǎoshī.','Cô ấy là giáo viên.','pronoun','Đại từ nhân xưng ngôi thứ ba giống cái. Cùng phát âm với 他.',++$v3);
$v3_5=v($conn,$L3,1,'谁','shéi','ai','ai','他是谁？','Tā shì shéi?','Anh ấy là ai?','pronoun','Đại từ nghi vấn chỉ người.',++$v3);
$v3_6=v($conn,$L3,1,'哪儿','nǎr','đâu, chỗ nào','đâu','你去哪儿？','Nǐ qù nǎr?','Bạn đi đâu?','pronoun','Đại từ nghi vấn chỉ địa điểm.',++$v3);
$v3_7=v($conn,$L3,1,'哪','nǎ','nào','nào','你是哪国人？','Nǐ shì nǎ guó rén?','Bạn là người nước nào?','pronoun','Đại từ nghi vấn dùng để hỏi lựa chọn.',++$v3);
$v3_8=v($conn,$L3,1,'汉语','Hànyǔ','tiếng Trung','tiếng Trung','我会说汉语。','Wǒ huì shuō Hànyǔ.','Tôi biết nói tiếng Trung.','noun','Hàn (người Hán) + yǔ (ngôn ngữ).',++$v3);
$v3_9=v($conn,$L3,1,'说','shuō','nói','nói','他说中文。','Tā shuō Zhōngwén.','Anh ấy nói tiếng Trung.','verb','Động từ chỉ hành động nói.',++$v3);
$v3_10=v($conn,$L3,1,'法国','Fǎguó','Pháp','Pháp','她是法国人。','Tā shì Fǎguó rén.','Cô ấy là người Pháp.','noun','Tên nước Pháp.',++$v3);
$v3_11=v($conn,$L3,1,'美国','Měiguó','Mỹ','Mỹ','他去美国。','Tā qù Měiguó.','Anh ấy đi Mỹ.','noun','Tên nước Mỹ.',++$v3);
$v3_12=v($conn,$L3,1,'医生','yīshēng','bác sĩ','bác sĩ','她是医生。','Tā shì yīshēng.','Cô ấy là bác sĩ.','noun','Nghề nghiệp bác sĩ.',++$v3);
// Grammar L3
$g3_1=g($conn,$L3,'Câu hỏi với từ để hỏi','Từ để hỏi + Động từ/Tính từ','Hỏi người, vật, địa điểm...','Từ để hỏi đứng ở vị trí thông tin cần hỏi. Các từ hỏi: shéi (ai), shénme (gì), nǎr (đâu), nǎ (nào).','Không thay đổi trật tự câu như tiếng Việt. Từ hỏi đặt đúng vị trí của thông tin cần hỏi.','Đây là dạng câu hỏi quan trọng.',1);
ge($conn,$g3_1,'他是谁？','Tā shì shéi?','Anh ấy là ai?',1);
ge($conn,$g3_1,'这是什么？','Zhè shì shénme?','Đây là cái gì?',2);
ge($conn,$g3_1,'你去哪儿？','Nǐ qù nǎr?','Bạn đi đâu?',3);
$g3_2=g($conn,$L3,'Đại từ nhân xưng','我 / 你 / 他 / 她','Tôi, bạn, anh ấy, cô ấy','Phân biệt các đại từ: 我 (ngôi 1), 你 (ngôi 2), 他 (ngôi 3 nam), 她 (ngôi 3 nữ).','他 và 她 cùng phát âm tā nhưng chữ viết khác nhau. 它 (tā) dùng cho đồ vật.','Đại từ cơ bản.',2);
ge($conn,$g3_2,'他是老师，她是学生。','Tā shì lǎoshī, tā shì xuéshēng.','Anh ấy là giáo viên, cô ấy là học sinh.',1);
$g3_3=g($conn,$L3,'Câu hỏi Quốc tịch','你是 + 哪 + 国 + 人？','Bạn là người nước nào?','Dùng 哪 để hỏi quốc tịch.','国 (guó) là nước. 人 (rén) là người.','Cấu trúc hỏi quốc tịch.',3);
ge($conn,$g3_3,'你是哪国人？','Nǐ shì nǎ guó rén?','Bạn là người nước nào?',1);
ge($conn,$g3_3,'他是法国人。','Tā shì Fǎguó rén.','Anh ấy là người Pháp.',2);
// Dialogues L3
$d3_1=d($conn,$L3,'Hoi ten va quoc tich','Gặp nhau tại lớp học.',1);
ds($conn,$d3_1,'Xiao Ming','你们好！我叫小明。你叫什么名字？','Nǐmen hǎo! Wǒ jiào Xiǎo Míng. Nǐ jiào shénme míngzì?','Chào các bạn! Tôi tên Tiểu Minh. Bạn tên gì?',1);
ds($conn,$d3_1,'Anna','我叫Anna。','Wǒ jiào Anna.','Tôi tên Anna.',2);
ds($conn,$d3_1,'Xiao Ming','你是哪国人？','Nǐ shì nǎ guó rén?','Bạn là người nước nào?',3);
ds($conn,$d3_1,'Anna','我是法国人。','Wǒ shì Fǎguó rén.','Tôi là người Pháp.',4);
ds($conn,$d3_1,'Xiao Ming','他是谁？','Tā shì shéi?','Anh ấy là ai?',5);
ds($conn,$d3_1,'Anna','他是我的同学，叫王明。','Tā shì wǒ de tóngxué, jiào Wáng Míng.','Anh ấy là bạn học của tôi, tên Vương Minh.',6);
$d3_2=d($conn,$L3,'Hoi ve nghe nghiep','Hỏi về công việc của nhau.',2);
ds($conn,$d3_2,'Anna','你爸爸是做什么的？','Nǐ bàba shì zuò shénme de?','Bố bạn làm nghề gì?',1);
ds($conn,$d3_2,'Xiao Ming','他是医生。','Tā shì yīshēng.','Ông ấy là bác sĩ.',2);
ds($conn,$d3_2,'Anna','我妈妈是老师。','Wǒ māma shì lǎoshī.','Mẹ tôi là giáo viên.',3);
ds($conn,$d3_2,'Xiao Ming','她教什么？','Tā jiāo shénme?','Cô ấy dạy gì?',4);
ds($conn,$d3_2,'Anna','她教汉语。','Tā jiāo Hànyǔ.','Cô ấy dạy tiếng Trung.',5);
$d3_3=d($conn,$L3,'Gioi thieu ban be','Giới thiệu bạn cho người khác.',3);
ds($conn,$d3_3,'Xiao Ming','Anna，他是谁？','Anna, tā shì shéi?','Anna, anh ấy là ai?',1);
ds($conn,$d3_3,'Anna','他是我的朋友。他是美国人。','Tā shì wǒ de péngyou. Tā shì Měiguó rén.','Anh ấy là bạn tôi. Anh ấy là người Mỹ.',2);
ds($conn,$d3_3,'Xiao Ming','你好！我叫小明。','Nǐ hǎo! Wǒ jiào Xiǎo Míng.','Chào bạn! Tôi tên Tiểu Minh.',3);
// Reading L3
r($conn,$L3,'Cac ban hoc cua toi','她是Anna。她是法国人。她是医生。他是小明。他是中国人。他是学生。他是王明。他是老师。我们是好朋友。','Tā shì Anna. Tā shì Fǎguó rén. Tā shì yīshēng. Tā shì Xiǎo Míng. Tā shì Zhōngguó rén. Tā shì xuéshēng. Tā shì Wáng Míng. Tā shì lǎoshī. Wǒmen shì hǎo péngyou.','Cô ấy là Anna. Cô ấy là người Pháp. Cô ấy là bác sĩ. Anh ấy là Tiểu Minh. Anh ấy là người Trung Quốc. Anh ấy là học sinh. Anh ấy là Vương Minh. Anh ấy là giáo viên. Chúng tôi là bạn tốt.','easy',52,1);
// Listening L3
$L3l=l($conn,$L3,'Hoi ten nghe nghiep','A:他叫什么名字？B:他叫王老师。A:他是哪国人？B:他是中国人。A:他是医生吗？B:不是，他是老师。','A:Tā jiào shénme míngzì? B:Tā jiào Wáng lǎoshī. A:Tā shì nǎ guó rén? B:Tā shì Zhōngguó rén. A:Tā shì yīshēng ma? B:Bú shì, tā shì lǎoshī.','A:Anh ấy tên gì? B:Thầy Vương. A:Người nước nào? B:Trung Quốc. A:Bác sĩ à? B:Không, giáo viên.',1);
lq($conn,$L3l,'Người được nói đến tên gì?','{"A":"Wang Ming","B":"Wang laoshi","C":"Ming Wang"}','Wang laoshi','Tên là thầy Vương.','multiple_choice',1);
lq($conn,$L3l,'Thầy Vương làm nghề gì?','{"A":"Bác sĩ","B":"Giáo viên","C":"Học sinh"}','Giáo viên','Thầy là giáo viên.','multiple_choice',2);
// Exercises L3
$E3_1=e($conn,$L3,'Chọn từ đúng','"Ai" trong tiếng Trung là:','multiple_choice','easy',1,'A',1);
eo($conn,$E3_1,'谁','A',1,1); eo($conn,$E3_1,'什么','B',0,2); eo($conn,$E3_1,'哪儿','C',0,3);
$E3_2=e($conn,$L3,'Dịch câu','"Anh ấy là người nước nào?"','translation','easy',1,'他是哪国人？',2);
$E3_3=e($conn,$L3,'Sắp xếp câu','人 / 国 / 你 / 哪 / 是','sentence_order','easy',1,'你是哪国人？',3);
$E3_4=e($conn,$L3,'Điền từ hỏi','他是___？(Anh ấy là ai?)','fill_blank','easy',1,'谁',4);
$E3_5=e($conn,$L3,'Chọn đúng/sai','"他" và "她" phát âm giống nhau.','true_false','easy',1,'true',5);
eo($conn,$E3_5,'Đúng','A',1,1); eo($conn,$E3_5,'Sai','B',0,2);
$E3_6=e($conn,$L3,'Chọn đáp án đúng','"Cô ấy là bác sĩ" nói thế nào?','multiple_choice','easy',1,'A',6);
eo($conn,$E3_6,'她是医生。','A',1,1); eo($conn,$E3_6,'他是医生。','B',0,2); eo($conn,$E3_6,'她是老师。','C',0,3);
// Review L3
foreach ([$v3_1,$v3_2,$v3_3,$v3_4,$v3_5,$v3_7,$v3_10,$v3_12] as $i=>$vid) if ($vid) rv($conn,$L3,$vid,'core',$i+1);
echo " L3 done: $v3 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L4: 她是我的汉语老师 ───
$L4=createLesson($conn,1,4,'Bài 4: Ta shi wo de Han yu lao shi','Gia đình, nghề nghiệp. So huu, so luong tu.','["Gia đình","Nghe nghiep","So luong"]','Gia đình','easy','Bài 4: Từ vựng về gia đình: bàba (bố), māma (mẹ), gēge (anh trai), jiějie (chị gái). Cách giới thiệu gia đình. Lượng từ 个 (cái). Hỏi số lượng với 几. Động từ 有 chỉ sự tồn tại trong gia đình.');
$v4=0;
$v4_1=v($conn,$L4,1,'家','jiā','nhà, gia đình','nhà','我家有三口人。','Wǒ jiā yǒu sān kǒu rén.','Nhà tôi có ba người.','noun','Chỉ gia đình hoặc ngôi nhà.',++$v4);
$v4_2=v($conn,$L4,1,'爸爸','bàba','bố, ba','bố','我爸爸是医生。','Wǒ bàba shì yīshēng.','Bố tôi là bác sĩ.','noun','Từ xưng hô cho bố.',++$v4);
$v4_3=v($conn,$L4,1,'妈妈','māma','mẹ','mẹ','妈妈是老师。','Māma shì lǎoshī.','Mẹ là giáo viên.','noun','Từ xưng hô cho mẹ.',++$v4);
$v4_4=v($conn,$L4,1,'哥哥','gēge','anh trai','anh trai','我有一个哥哥。','Wǒ yǒu yí gè gēge.','Tôi có một người anh trai.','noun','Anh trai ruột.',++$v4);
$v4_5=v($conn,$L4,1,'姐姐','jiějie','chị gái','chị gái','姐姐很漂亮。','Jiějie hěn piàoliang.','Chị gái rất xinh.','noun','Chị gái ruột.',++$v4);
$v4_6=v($conn,$L4,1,'弟弟','dìdi','em trai','em trai','弟弟五岁。','Dìdi wǔ suì.','Em trai 5 tuổi.','noun','Em trai ruột.',++$v4);
$v4_7=v($conn,$L4,1,'妹妹','mèimei','em gái','em gái','妹妹很可爱。','Mèimei hěn kěài.','Em gái rất đáng yêu.','noun','Em gái ruột.',++$v4);
$v4_8=v($conn,$L4,1,'儿子','érzi','con trai','con trai','他有一个儿子。','Tā yǒu yí gè érzi.','Anh ấy có một con trai.','noun','Con trai (quan hệ cha mẹ-con cái).',++$v4);
$v4_9=v($conn,$L4,1,'女儿','nǚér','con gái','con gái','我有一个女儿。','Wǒ yǒu yí gè nǚér.','Tôi có một con gái.','noun','Con gái.',++$v4);
$v4_10=v($conn,$L4,1,'岁','suì','tuổi','tuổi','你几岁？','Nǐ jǐ suì?','Bạn mấy tuổi?','measure','Đơn vị đo tuổi.',++$v4);
$v4_11=v($conn,$L4,1,'几','jǐ','mấy (hỏi số ít)','mấy','你家有几口人？','Nǐ jiā yǒu jǐ kǒu rén?','Nhà bạn có mấy người?','pronoun','Hỏi số lượng nhỏ hơn 10.',++$v4);
$v4_12=v($conn,$L4,1,'个','gè','cái (lượng từ phổ biến)','cái','一个苹果。','Yí gè píngguǒ.','Một quả táo.','measure','Lượng từ phổ biến nhất trong tiếng Trung.',++$v4);
// Grammar L4
$g4_1=g($conn,$L4,'Luong tu 个 và các lượng từ','Số + Lượng từ + Danh từ','Đếm sự vật, người.','Tiếng Trung cần lượng từ giữa số và danh từ. 个 là phổ biến nhất. Dùng 几 để hỏi số lượng nhỏ.','Mỗi danh từ có lượng từ riêng. 个 được dùng cho người và vật nói chung.','Lượng từ là đặc điểm quan trọng.',1);
ge($conn,$g4_1,'一个朋友。','Yí gè péngyou.','Một người bạn.',1);
ge($conn,$g4_1,'三本书。','Sān běn shū.','Ba quyển sách.',2);
ge($conn,$g4_1,'五个人。','Wǔ gè rén.','Năm người.',3);
$g4_2=g($conn,$L4,'Cách hoi tuoi va so luong','几 + Lượng từ + Danh từ？','Mấy...?','几 hỏi số lượng nhỏ (<10). 多大 hỏi tuổi (người lớn), 几岁 hỏi tuổi (trẻ em).','多少 (duōshao) hỏi số lượng nói chung, đặc biệt khi số lượng lớn.','Phân biệt 几 và 多少.',2);
ge($conn,$g4_2,'你几岁？','Nǐ jǐ suì?','Bạn mấy tuổi? (hỏi trẻ em)',1);
ge($conn,$g4_2,'你家有几口人？','Nǐ jiā yǒu jǐ kǒu rén?','Nhà bạn có mấy người?',2);
// Dialogues L4
$d4_1=d($conn,$L4,'Gioi thieu gia đình','Giới thiệu về gia đình mình.',1);
ds($conn,$d4_1,'Anna','你家有几口人？','Nǐ jiā yǒu jǐ kǒu rén?','Nhà bạn có mấy người?',1);
ds($conn,$d4_1,'Xiao Ming','我家有三口人：爸爸、妈妈和我。','Wǒ jiā yǒu sān kǒu rén: bàba, māma hé wǒ.','Nhà tôi có ba người: bố, mẹ và tôi.',2);
ds($conn,$d4_1,'Anna','你爸爸是做什么的？','Nǐ bàba shì zuò shénme de?','Bố bạn làm nghề gì?',3);
ds($conn,$d4_1,'Xiao Ming','他是医生。','Tā shì yīshēng.','Ông ấy là bác sĩ.',4);
$d4_2=d($conn,$L4,'Hoi ve anh chi em','Hỏi nhau về anh chị em.',2);
ds($conn,$d4_2,'Xiao Ming','你有哥哥吗？','Nǐ yǒu gēge ma?','Bạn có anh trai không?',1);
ds($conn,$d4_2,'Anna','有，我有一个哥哥。','Yǒu, wǒ yǒu yí gè gēge.','Có, tôi có một anh trai.',2);
ds($conn,$d4_2,'Xiao Ming','他几岁？','Tā jǐ suì?','Anh ấy mấy tuổi?',3);
ds($conn,$d4_2,'Anna','他二十五岁。','Tā èrshíwǔ suì.','Anh ấy 25 tuổi.',4);
$d4_3=d($conn,$L4,'Gia đình Anna','Anna giới thiệu gia đình.',3);
ds($conn,$d4_3,'Anna','我家有四口人。','Wǒ jiā yǒu sì kǒu rén.','Nhà tôi có bốn người.',1);
ds($conn,$d4_3,'Xiao Ming','你有妹妹吗？','Nǐ yǒu mèimei ma?','Bạn có em gái không?',2);
ds($conn,$d4_3,'Anna','有，我有一个妹妹，她十岁。','Yǒu, wǒ yǒu yí gè mèimei, tā shí suì.','Có, tôi có một em gái, em ấy 10 tuổi.',3);
// Reading L4
r($conn,$L4,'Gia đình toi','我家有四口人：爸爸、妈妈、妹妹和我。爸爸是医生，妈妈是老师。妹妹五岁，很可爱。我是学生，二十岁。我爱我的家。','Wǒ jiā yǒu sì kǒu rén: bàba, māma, mèimei hé wǒ. Bàba shì yīshēng, māma shì lǎoshī. Mèimei wǔ suì, hěn kěài. Wǒ shì xuéshēng, èrshí suì. Wǒ ài wǒ de jiā.','Nhà tôi có bốn người: bố, mẹ, em gái và tôi. Bố là bác sĩ, mẹ là giáo viên. Em gái 5 tuổi, rất đáng yêu. Tôi là học sinh, 20 tuổi. Tôi yêu gia đình của tôi.','easy',55,1);
// Listening L4
$L4l=l($conn,$L4,'Gia đình và nghe nghiep','A:你家有几口人？B:有四口人。A:你有姐姐吗？B:有，我姐姐是医生。A:她几岁？B:她三十岁。','A:Nǐ jiā yǒu jǐ kǒu rén? B:Yǒu sì kǒu rén. A:Nǐ yǒu jiějie ma? B:Yǒu, wǒ jiějie shì yīshēng. A:Tā jǐ suì? B:Tā sānshí suì.','A:Nhà bạn mấy người? B:Bốn người. A:Bạn có chị gái không? B:Có, chị tôi là bác sĩ. A:Chị ấy mấy tuổi? B:Chị ấy 30 tuổi.',1);
lq($conn,$L4l,'Nhà người B có mấy người?','{"A":"3","B":"4","C":"5"}','4','Bốn người.','multiple_choice',1);
lq($conn,$L4l,'Chị gái làm nghề gì?','{"A":"Giáo viên","B":"Bác sĩ","C":"Kỹ sư"}','Bác sĩ','Chị là bác sĩ.','multiple_choice',2);
lq($conn,$L4l,'Chị gái bao nhiêu tuổi?','{"A":"30","B":"25","C":"20"}','30','30 tuổi.','multiple_choice',3);
// Exercises L4
$E4_1=e($conn,$L4,'Chọn đáp án đúng','"Mẹ" trong tiếng Trung là:','multiple_choice','easy',1,'B',1);
eo($conn,$E4_1,'爸爸','A',0,1); eo($conn,$E4_1,'妈妈','B',1,2); eo($conn,$E4_1,'姐姐','C',0,3);
$E4_2=e($conn,$L4,'Dịch câu','"Em gái tôi 5 tuổi."','translation','easy',1,'我妹妹五岁。',2);
$E4_3=e($conn,$L4,'Điền từ','我家___四口人。','fill_blank','easy',1,'有',3);
$E4_4=e($conn,$L4,'Sắp xếp câu','人 / 口 / 家 / 几 / 有 / 你','sentence_order','easy',1,'你家有几口人？',4);
$E4_5=e($conn,$L4,'Chọn đúng/sai','"我有哥哥" có nghĩa là tôi có em trai.','true_false','easy',1,'false',5);
eo($conn,$E4_5,'Đúng','A',0,1); eo($conn,$E4_5,'Sai','B',1,2);
$E4_6=e($conn,$L4,'Chọn lượng từ đúng','一___人 (một người)','multiple_choice','easy',1,'B',6);
eo($conn,$E4_6,'本','A',0,1); eo($conn,$E4_6,'个','B',1,2); eo($conn,$E4_6,'杯','C',0,3);
// Review L4
foreach ([$v4_1,$v4_2,$v4_3,$v4_4,$v4_5,$v4_7,$v4_10,$v4_11,$v4_12] as $i=>$vid) if ($vid) rv($conn,$L4,$vid,'core',$i+1);
echo " L4 done: $v4 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

echo "\n HSK1 Lessons 1-4 done. Continuing L5-L8...\n\n";
// (continued in seed_hsk1_cont.php to keep file size manageable)
