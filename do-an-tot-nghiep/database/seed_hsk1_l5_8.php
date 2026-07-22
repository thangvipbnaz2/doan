<?php
/**
 * HÀNNGỮ - HSK1 Content Seeder (Lessons 5-8)
 * Continuation of seed_hsk1.php
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ─── L5: 她女儿今年二十岁 ───
$L5=createLesson($conn,1,5,'Bài 5: Ta nu er jin nian er shi sui','So đếm 1-100, tuổi tác, phân biệt 二 và 两.','["So đếm","Tuoi tac","So luong"]','So đếm','easy','Bài 5 dạy số đếm từ 1 đến 100, cách đọc số, phân biệt èr (hai) và liǎng (hai + lượng từ). Cách hỏi tuổi với duō dà (bao nhiêu tuổi), hỏi số lượng với duōshao (bao nhiêu).');
$v5=0;
$v5_1=v($conn,$L5,1,'一','yī','một','một','一个。','Yī gè.','Một cái.','number','Số 1.',++$v5);
$v5_2=v($conn,$L5,1,'二','èr','hai','hai','二月。','Èr yuè.','Tháng hai.','number','Số 2. Dùng trong số đếm, ngày tháng.',++$v5);
$v5_3=v($conn,$L5,1,'三','sān','ba','ba','三本书。','Sān běn shū.','Ba quyển sách.','number','Số 3.',++$v5);
$v5_4=v($conn,$L5,1,'四','sì','bốn','bốn','四个人。','Sì gè rén.','Bốn người.','number','Số 4.',++$v5);
$v5_5=v($conn,$L5,1,'五','wǔ','năm','năm','五月。','Wǔ yuè.','Tháng năm.','number','Số 5.',++$v5);
$v5_6=v($conn,$L5,1,'六','liù','sáu','sáu','六点。','Liù diǎn.','Sáu giờ.','number','Số 6.',++$v5);
$v5_7=v($conn,$L5,1,'七','qī','bảy','bảy','七天。','Qī tiān.','Bảy ngày.','number','Số 7.',++$v5);
$v5_8=v($conn,$L5,1,'八','bā','tám','tám','八点。','Bā diǎn.','Tám giờ.','number','Số 8.',++$v5);
$v5_9=v($conn,$L5,1,'九','jiǔ','chín','chín','九个人。','Jiǔ gè rén.','Chín người.','number','Số 9.',++$v5);
$v5_10=v($conn,$L5,1,'十','shí','mười','mười','十月。','Shí yuè.','Tháng mười.','number','Số 10.',++$v5);
$v5_11=v($conn,$L5,1,'零','líng','số không, 0','không','一百零一。','Yì bǎi líng yī.','101.','number','Số 0. Dùng khi có số 0 ở giữa.',++$v5);
$v5_12=v($conn,$L5,1,'百','bǎi','trăm','trăm','一百。','Yì bǎi.','100.','number','Đơn vị hàng trăm.',++$v5);
$v5_13=v($conn,$L5,1,'两','liǎng','hai (dùng với lượng từ)','hai','两个人。','Liǎng gè rén.','Hai người.','number','Dùng thay 二 trước lượng từ.',++$v5);
$v5_14=v($conn,$L5,1,'多少','duōshao','bao nhiêu','bao nhiêu','多少钱？','Duōshao qián?','Bao nhiêu tiền?','pronoun','Hỏi số lượng, không phân biệt ít/nhiều.',++$v5);
$v5_15=v($conn,$L5,1,'多大','duō dà','bao nhiêu tuổi (người lớn)','bao nhiêu tuổi','你多大？','Nǐ duō dà?','Bạn bao nhiêu tuổi?','phrase','Hỏi tuổi người lớn. Trẻ em dùng 几岁.',++$v5);
// Grammar L5
$g5_1=g($conn,$L5,'So đếm 1-100','11=shíyī, 20=èrshí, 21=èrshíyī,...,99=jiǔshíjiǔ','Cách đọc số từ 1-100.','Số 11-19: shí + số. Số 20,30...: số + shí. Số 21-99: số + shí + số.','Đặc biệt: 101 = yì bǎi líng yī. 110 = yì bǎi yī (shí). Cần phân biệt 二 và 两.','Nắm vững số đếm là cơ bản.',1);
ge($conn,$g5_1,'二十五。','Èrshíwǔ.','25.',1);
ge($conn,$g5_1,'九十九。','Jiǔshíjiǔ.','99.',2);
ge($conn,$g5_1,'一百零一。','Yì bǎi líng yī.','101.',3);
$g5_2=g($conn,$L5,'Phân biệt 二 và 两','二: số đếm, thứ tự. 两: + lượng từ.','Hai: 二 (số đếm) vs 两 (+lượng từ).','二 dùng trong số đếm (1,2,3), số thứ tự (tháng 2), số điện thoại. 两 dùng trước lượng từ (两个人).','Không nói "二个人" mà nói "两个人". 十二个 (12 cái) không nói "十两个".','Quy tắc quan trọng.',2);
ge($conn,$g5_2,'两个人。','Liǎng gè rén.','Hai người.',1);
ge($conn,$g5_2,'十二个。','Shí èr gè.','Mười hai cái.',2);
ge($conn,$g5_2,'二月。','Èr yuè.','Tháng hai.',3);
$g5_3=g($conn,$L5,'Hoi tuoi: 几岁 vs 多大','Trẻ em: 几岁. Người lớn: 多大.','Hỏi tuổi phù hợp.','几岁: hỏi trẻ em dưới 10 tuổi. 多大: hỏi thanh niên và người lớn. 您多大年纪: hỏi người già (kính ngữ).','Chọn từ phù hợp với đối tượng.','Văn hóa giao tiếp.',3);
ge($conn,$g5_3,'你几岁？','Nǐ jǐ suì?','Bạn mấy tuổi? (hỏi trẻ em)',1);
ge($conn,$g5_3,'你多大？','Nǐ duō dà?','Bạn bao nhiêu tuổi?',2);
// Dialogues L5
$d5_1=d($conn,$L5,'Hoi tuoi','Hỏi và trả lời về tuổi.',1);
ds($conn,$d5_1,'Anna','你多大？','Nǐ duō dà?','Bạn bao nhiêu tuổi?',1);
ds($conn,$d5_1,'Xiao Ming','我二十岁。你呢？','Wǒ èrshí suì. Nǐ ne?','Tôi 20 tuổi. Còn bạn?',2);
ds($conn,$d5_1,'Anna','我十八岁。','Wǒ shíbā suì.','Tôi 18 tuổi.',3);
ds($conn,$d5_1,'Xiao Ming','你妹妹几岁？','Nǐ mèimei jǐ suì?','Em gái bạn mấy tuổi?',4);
ds($conn,$d5_1,'Anna','她十岁。','Tā shí suì.','Em ấy 10 tuổi.',5);
$d5_2=d($conn,$L5,'Hoi so luong','Hỏi về số lượng.',2);
ds($conn,$d5_2,'Anna','你们班有多少学生？','Nǐmen bān yǒu duōshao xuéshēng?','Lớp các bạn có bao nhiêu học sinh?',1);
ds($conn,$d5_2,'Xiao Ming','有十五个。','Yǒu shíwǔ gè.','Có 15 học sinh.',2);
ds($conn,$d5_2,'Anna','有几个老师？','Yǒu jǐ gè lǎoshī?','Có mấy giáo viên?',3);
ds($conn,$d5_2,'Xiao Ming','有两个老师。','Yǒu liǎng gè lǎoshī.','Có hai giáo viên.',4);
$d5_3=d($conn,$L5,'Đếm đồ vật','Đếm đồ vật trong lớp.',3);
ds($conn,$d5_3,'老师','桌子上有几本书？','Zhuōzi shang yǒu jǐ běn shū?','Trên bàn có mấy quyển sách?',1);
ds($conn,$d5_3,'学生','有三本书。','Yǒu sān běn shū.','Có ba quyển sách.',2);
ds($conn,$d5_3,'老师','多少支笔？','Duōshao zhī bǐ?','Bao nhiêu cây bút?',3);
ds($conn,$d5_3,'学生','五支笔。','Wǔ zhī bǐ.','Năm cây bút.',4);
// Reading L5
r($conn,$L5,'Tuoi va so dem','我今年二十岁。妹妹十岁。爸爸四十五岁。妈妈四十三岁。爷爷七十八岁。我家有五口人。','Wǒ jīnnián èrshí suì. Mèimei shí suì. Bàba sìshíwǔ suì. Māma sìshísān suì. Yéye qīshíbā suì. Wǒ jiā yǒu wǔ kǒu rén.','Tôi năm nay 20 tuổi. Em gái 10 tuổi. Bố 45 tuổi. Mẹ 43 tuổi. Ông 78 tuổi. Nhà tôi có năm người.','easy',52,1);
// Listening L5
$L5l=l($conn,$L5,'So đếm tuoi','A:你今年多大？B:我二十五岁。A:你妈妈呢？B:她五十岁。A:你有哥哥吗？B:有，他三十岁。','A:Nǐ jīnnián duō dà? B:Wǒ èrshíwǔ suì. A:Nǐ māma ne? B:Tā wǔshí suì. A:Nǐ yǒu gēge ma? B:Yǒu, tā sānshí suì.','A:Năm nay bạn bao nhiêu tuổi? B:Tôi 25. A:Mẹ bạn? B:Bà 50. A:Bạn có anh trai không? B:Có, anh ấy 30.',1);
lq($conn,$L5l,'Người B bao nhiêu tuổi?','{"A":"20","B":"25","C":"30"}','25','25 tuổi.','multiple_choice',1);
lq($conn,$L5l,'Mẹ người B bao nhiêu tuổi?','{"A":"40","B":"45","C":"50"}','50','50 tuổi.','multiple_choice',2);
lq($conn,$L5l,'Anh trai bao nhiêu tuổi?','{"A":"25","B":"30","C":"35"}','30','30 tuổi.','multiple_choice',3);
// Exercises L5
$E5_1=e($conn,$L5,'Viết số','Viết số "二十五" bằng chữ số:','fill_blank','easy',1,'25',1);
$E5_2=e($conn,$L5,'Chọn đáp án','"Chín" trong tiếng Trung là:','multiple_choice','easy',1,'B',2);
eo($conn,$E5_2,'八','A',0,1); eo($conn,$E5_2,'九','B',1,2); eo($conn,$E5_2,'十','C',0,3);
$E5_3=e($conn,$L5,'Phân biệt 二 và 两','Điền "二" hoặc "两": ___个人','fill_blank','easy',1,'两',3);
$E5_4=e($conn,$L5,'Dịch số','101 đọc là gì?','multiple_choice','easy',1,'A',4);
eo($conn,$E5_4,'一百零一','A',1,1); eo($conn,$E5_4,'一百一','B',0,2); eo($conn,$E5_4,'百零一','C',0,3);
$E5_5=e($conn,$L5,'Sắp xếp câu','岁 / 二十 / 我','sentence_order','easy',1,'我二十岁。',5);
$E5_6=e($conn,$L5,'Chọn đúng/sai','"多少" dùng để hỏi số lượng nhỏ.','true_false','easy',1,'false',6);
eo($conn,$E5_6,'Đúng','A',0,1); eo($conn,$E5_6,'Sai','B',1,2);
// Review L5
foreach ([$v5_1,$v5_10,$v5_12,$v5_13,$v5_14,$v5_15] as $i=>$vid) if ($vid) rv($conn,$L5,$vid,'core',$i+1);
echo " L5 done: $v5 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L6: 我会说汉语 ───
$L6=createLesson($conn,1,6,'Bài 6: Wo hui shuo Han yu','Động từ năng nguyện: hui/neng/keyi. Kỹ năng ngôn ngữ.','["Kha nang","Ngon ngu","Ky nang"]','Kha nang','easy','Bài 6: Các động từ năng nguyện: hui (biết làm, có kỹ năng), néng (có thể do điều kiện), kěyǐ (được phép). Phân biệt 3 từ. Động từ: shuō (nói), xiě (viết), dú (đọc), tīng (nghe).');
$v6=0;
$v6_1=v($conn,$L6,1,'会','huì','biết (có kỹ năng), sẽ','biết','我会说汉语。','Wǒ huì shuō Hànyǔ.','Tôi biết nói tiếng Trung.','verb','Chỉ kỹ năng học được. Phủ định: 不会.',++$v6);
$v6_2=v($conn,$L6,1,'能','néng','có thể (do điều kiện)','có thể','我能去。','Wǒ néng qù.','Tôi có thể đi.','verb','Khả năng do điều kiện khách quan cho phép.',++$v6);
$v6_3=v($conn,$L6,1,'可以','kěyǐ','có thể, được phép','có thể','可以进来吗？','Kěyǐ jìnlái ma?','Có thể vào không?','verb','Xin phép hoặc cho phép.',++$v6);
$v6_4=v($conn,$L6,1,'要','yào','muốn, cần','muốn','我要喝水。','Wǒ yào hē shuǐ.','Tôi muốn uống nước.','verb','Chỉ ý muốn hoặc nhu cầu. Phủ định: 不想.',++$v6);
$v6_5=v($conn,$L6,1,'想','xiǎng','muốn, nghĩ','muốn','我想去北京。','Wǒ xiǎng qù Běijīng.','Tôi muốn đi Bắc Kinh.','verb','Mong muốn, dự định. Nhẹ hơn 要.',++$v6);
$v6_6=v($conn,$L6,1,'写','xiě','viết','viết','写汉字。','Xiě Hànzì.','Viết chữ Hán.','verb','Hành động viết.',++$v6);
$v6_7=v($conn,$L6,1,'读','dú','đọc','đọc','读书。','Dú shū.','Đọc sách.','verb','Hành động đọc.',++$v6);
$v6_8=v($conn,$L6,1,'听','tīng','nghe','nghe','听音乐。','Tīng yīnyuè.','Nghe nhạc.','verb','Hành động nghe.',++$v6);
$v6_9=v($conn,$L6,1,'学习','xuéxí','học tập','học','学习汉语。','Xuéxí Hànyǔ.','Học tiếng Trung.','verb','xué (học) + xí (tập).',++$v6);
$v6_10=v($conn,$L6,1,'一点','yì diǎn','một chút','một chút','我会说一点汉语。','Wǒ huì shuō yì diǎn Hànyǔ.','Tôi biết nói một chút tiếng Trung.','phrase','Chỉ số lượng ít.',++$v6);
$v6_11=v($conn,$L6,1,'英文','Yīngwén','tiếng Anh','tiếng Anh','他会说英文。','Tā huì shuō Yīngwén.','Anh ấy biết nói tiếng Anh.','noun','Yīng (Anh) + wén (văn).',++$v6);
// Grammar L6
$g6_1=g($conn,$L6,'Động từ năng nguyện 会/能/可以','S + 会/能/可以 + V','Biết/Có thể/Được phép làm gì','会: có kỹ năng do học tập (我会说汉语). 能: có khả năng do điều kiện (我能去). 可以: được phép (可以进来).','Phủ định: 不会 (không biết), 不能 (không thể), 不可以 (không được phép). Câu hỏi: dùng 吗.','Phân biệt 3 từ này rất quan trọng.',1);
ge($conn,$g6_1,'我会说汉语。','Wǒ huì shuō Hànyǔ.','Tôi biết nói tiếng Trung.',1);
ge($conn,$g6_1,'我不能去。','Wǒ bù néng qù.','Tôi không thể đi.',2);
ge($conn,$g6_1,'我可以进来吗？','Kěyǐ jìnlái ma?','Tôi có thể vào không?',3);
$g6_2=g($conn,$L6,'Phân biệt 想 và 要','想: mong muốn. 要: nhu cầu/quyết tâm.','Muốn (mong) vs Muốn (cần).','想: ý muốn nhẹ nhàng, có thể không thực hiện. 要: ý muốn mạnh, sẽ thực hiện. Phủ định của 要 là 不想, không phải 不要 (cấm đoán).','不要 (bú yào) có nghĩa là "đừng".',2);
ge($conn,$g6_2,'我想喝茶。','Wǒ xiǎng hē chá.','Tôi muốn uống trà. (mong muốn)',1);
ge($conn,$g6_2,'我要喝水。','Wǒ yào hē shuǐ.','Tôi cần uống nước. (khát)',2);
ge($conn,$g6_2,'我不想吃。','Wǒ bù xiǎng chī.','Tôi không muốn ăn.',3);
$g6_3=g($conn,$L6,'Một chút: 一点儿','一点儿 + Tính từ / Động từ + 一点儿','Một chút...','Đặt sau động từ hoặc trước tính từ để chỉ mức độ thấp.','Có thể nói tắt là 点儿 (diǎnr).','Dùng trong giao tiếp hàng ngày.',3);
ge($conn,$g6_3,'我会说一点汉语。','Wǒ huì shuō yì diǎn Hànyǔ.','Tôi biết một chút tiếng Trung.',1);
ge($conn,$g6_3,'大一点儿。','Dà yì diǎnr.','Lớn hơn một chút.',2);
// Dialogues L6
$d6_1=d($conn,$L6,'Hoi ve kha nang ngon ngu','Hỏi nhau về khả năng ngoại ngữ.',1);
ds($conn,$d6_1,'Xiao Ming','你会说汉语吗？','Nǐ huì shuō Hànyǔ ma?','Bạn biết nói tiếng Trung không?',1);
ds($conn,$d6_1,'Anna','会一点儿。','Huì yì diǎnr.','Biết một chút.',2);
ds($conn,$d6_1,'Xiao Ming','你会写汉字吗？','Nǐ huì xiě Hànzì ma?','Bạn biết viết chữ Hán không?',3);
ds($conn,$d6_1,'Anna','不会，我会写英文。','Bú huì, wǒ huì xiě Yīngwén.','Không biết, tôi biết viết tiếng Anh.',4);
ds($conn,$d6_1,'Xiao Ming','我可以教你。','Wǒ kěyǐ jiāo nǐ.','Tôi có thể dạy bạn.',5);
$d6_2=d($conn,$L6,'Hoi ve mong muon','Hỏi về mong muốn và dự định.',2);
ds($conn,$d6_2,'Anna','你想学什么？','Nǐ xiǎng xué shénme?','Bạn muốn học gì?',1);
ds($conn,$d6_2,'Xiao Ming','我想学英文。','Wǒ xiǎng xué Yīngwén.','Tôi muốn học tiếng Anh.',2);
ds($conn,$d6_2,'Anna','为什么？','Wèi shénme?','Tại sao?',3);
ds($conn,$d6_2,'Xiao Ming','因为英文很有用。','Yīnwèi Yīngwén hěn yǒuyòng.','Vì tiếng Anh rất hữu ích.',4);
$d6_3=d($conn,$L6,'Đăng ký khóa học','Học sinh hỏi về khóa học.',3);
ds($conn,$d6_3,'Học sinh','老师，我可以学习汉语吗？','Lǎoshī, wǒ kěyǐ xuéxí Hànyǔ ma?','Thưa thầy, em có thể học tiếng Trung không?',1);
ds($conn,$d6_3,'Thầy giáo','可以。你会说中文吗？','Kěyǐ. Nǐ huì shuō Zhōngwén ma?','Được. Em biết nói tiếng Trung không?',2);
ds($conn,$d6_3,'Học sinh','我不会，但是我想学。','Wǒ bú huì, dànshì wǒ xiǎng xué.','Em không biết, nhưng em muốn học.',3);
// Reading L6
r($conn,$L6,'Hoc tieng Trung','我会说一点儿汉语。我的朋友是中国人，他会英文。他教我汉语，我教他英文。学习汉语很有意思。我每天学习一个小时。','Wǒ huì shuō yì diǎnr Hànyǔ. Wǒ de péngyou shì Zhōngguó rén, tā huì Yīngwén. Tā jiāo wǒ Hànyǔ, wǒ jiāo tā Yīngwén. Xuéxí Hànyǔ hěn yǒu yìsi. Wǒ měitiān xuéxí yí gè xiǎoshí.','Tôi biết nói một chút tiếng Trung. Bạn tôi là người Trung Quốc, anh ấy biết tiếng Anh. Anh ấy dạy tôi tiếng Trung, tôi dạy anh ấy tiếng Anh. Học tiếng Trung rất thú vị. Tôi học mỗi ngày một giờ.','easy',58,1);
// Listening L6
$L6l=l($conn,$L6,'Kha nang ngon ngu','A:你会什么语言？B:我会说汉语和英文。A:你会写汉字吗？B:不会，但是我想学。A:我也想学汉语。','A:Nǐ huì shénme yǔyán? B:Wǒ huì shuō Hànyǔ hé Yīngwén. A:Nǐ huì xiě Hànzì ma? B:Bú huì, dànshì wǒ xiǎng xué. A:Wǒ yě xiǎng xué Hànyǔ.','A:Bạn biết ngôn ngữ gì? B:Tôi biết nói tiếng Trung và tiếng Anh. A:Bạn biết viết chữ Hán không? B:Không, nhưng tôi muốn học. A:Tôi cũng muốn học tiếng Trung.',1);
lq($conn,$L6l,'Người B biết những ngôn ngữ nào?','{"A":"Chỉ tiếng Trung","B":"Tiếng Trung và tiếng Anh","C":"Chỉ tiếng Anh"}','Tiếng Trung và tiếng Anh','Biết cả hai.','multiple_choice',1);
lq($conn,$L6l,'Người A muốn làm gì?','{"A":"Học viết chữ Hán","B":"Học tiếng Anh","C":"Học tiếng Trung"}','Học tiếng Trung','Cũng muốn học tiếng Trung.','multiple_choice',2);
lq($conn,$L6l,'Người B có viết được chữ Hán không?','{"A":"Được","B":"Không","C":"Một chút"}','Không','Không viết được.','multiple_choice',3);
// Exercises L6
$E6_1=e($conn,$L6,'Chọn đáp án','"会" có nghĩa là gì?','multiple_choice','easy',1,'B',1);
eo($conn,$E6_1,'Sẽ','A',0,1); eo($conn,$E6_1,'Biết (có kỹ năng)','B',1,2); eo($conn,$E6_1,'Phải','C',0,3);
$E6_2=e($conn,$L6,'Dịch câu','"Tôi muốn uống nước."','translation','easy',1,'我要喝水。',2);
$E6_3=e($conn,$L6,'Điền động từ năng nguyện','我___说汉语。(Tôi biết nói tiếng Trung)','fill_blank','easy',1,'会',3);
$E6_4=e($conn,$L6,'Phân biệt 能 và 可以','"Tôi có thể vào không?" dùng từ nào?','multiple_choice','easy',1,'B',4);
eo($conn,$E6_4,'能','A',0,1); eo($conn,$E6_4,'可以','B',1,2); eo($conn,$E6_4,'会','C',0,3);
$E6_5=e($conn,$L6,'Sắp xếp câu','汉语 / 说 / 会 / 我','sentence_order','easy',1,'我会说汉语。',5);
$E6_6=e($conn,$L6,'Chọn đúng/sai','"要" và "想" hoàn toàn giống nhau.','true_false','easy',1,'false',6);
eo($conn,$E6_6,'Đúng','A',0,1); eo($conn,$E6_6,'Sai','B',1,2);
$E6_7=e($conn,$L6,'Điền từ','我会说一___汉语。(một chút)','fill_blank','easy',1,'点',7);
// Review L6
foreach ([$v6_1,$v6_2,$v6_3,$v6_4,$v6_5,$v6_6,$v6_7,$v6_8,$v6_10] as $i=>$vid) if ($vid) rv($conn,$L6,$vid,'core',$i+1);
echo " L6 done: $v6 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ─── L7: 今天几号 ───
$L7=createLesson($conn,1,7,'Bài 7: Jin tian ji hao - Hôm nay ngày mấy','Ngày tháng, thứ trong tuần. Cách đọc ngày tháng năm.','["Ngay thang","Thu","Lich"]','Thoi gian','easy','Bài 7: Cách nói ngày tháng trong tiếng Trung. Thứ: xīngqī yī (thứ Hai) ~ xīngqī tiān (Chủ nhật). Ngày tháng: jǐ yuè jǐ hào. Hỏi: Jīntiān jǐ hào? Jīntiān xīngqī jǐ? Từ vựng: jīntiān (hôm nay), míngtiān (ngày mai), zuótiān (hôm qua).');
$v7=0;
$v7_1=v($conn,$L7,1,'今天','jīntiān','hôm nay','hôm nay','今天星期一。','Jīntiān xīngqī yī.','Hôm nay thứ Hai.','noun','jīn (nay) + tiān (ngày).',++$v7);
$v7_2=v($conn,$L7,1,'明天','míngtiān','ngày mai','ngày mai','明天星期三。','Míngtiān xīngqī sān.','Ngày mai thứ Tư.','noun','míng (sáng) + tiān (ngày).',++$v7);
$v7_3=v($conn,$L7,1,'昨天','zuótiān','hôm qua','hôm qua','昨天星期一。','Zuótiān xīngqī yī.','Hôm qua thứ Hai.','noun','zuó (hôm qua) + tiān (ngày).',++$v7);
$v7_4=v($conn,$L7,1,'年','nián','năm','năm','2024年。','Èr líng èr sì nián.','Năm 2024.','noun','Đơn vị năm.',++$v7);
$v7_5=v($conn,$L7,1,'月','yuè','tháng','tháng','一月。','Yī yuè.','Tháng Một.','noun','Đơn vị tháng.',++$v7);
$v7_6=v($conn,$L7,1,'号','hào','ngày (thông tục)','ngày','今天几号？','Jīntiān jǐ hào?','Hôm nay ngày mấy?','noun','Dùng trong khẩu ngữ thay cho 日.',++$v7);
$v7_7=v($conn,$L7,1,'星期','xīngqī','tuần, thứ (trong tuần)','tuần','一星期七天。','Yì xīngqī qī tiān.','Một tuần bảy ngày.','noun','Đơn vị tuần.',++$v7);
$v7_8=v($conn,$L7,1,'星期天','xīngqī tiān','Chủ nhật','Chủ nhật','星期天休息。','Xīngqī tiān xiūxi.','Chủ nhật nghỉ ngơi.','noun','Cũng nói 星期日.',++$v7);
$v7_9=v($conn,$L7,1,'现在','xiànzài','bây giờ, hiện tại','bây giờ','现在几点？','Xiànzài jǐ diǎn?','Bây giờ mấy giờ?','noun','Chỉ thời điểm hiện tại.',++$v7);
$v7_10=v($conn,$L7,1,'生日','shēngrì','sinh nhật','sinh nhật','我的生日是五月十号。','Wǒ de shēngrì shì wǔ yuè shí hào.','Sinh nhật tôi là ngày 10 tháng 5.','noun','shēng (sinh) + rì (ngày).',++$v7);
// Grammar L7
$g7_1=g($conn,$L7,'Cách nói thứ trong tuần','星期 + Số (一~六) / 天','Thứ Hai ~ Chủ nhật','星期 + số: 星期一 (thứ 2) ~ 星期六 (thứ 7). Chủ nhật: 星期天 hoặc 星期日.','Thứ tự: 星期一=Thứ 2, 星期二=Thứ 3,..., 星期六=Thứ 7. Lưu ý 星期天=CN.','Hệ thống thứ tự.',1);
ge($conn,$g7_1,'今天星期一。','Jīntiān xīngqī yī.','Hôm nay thứ Hai.',1);
ge($conn,$g7_1,'明天星期三。','Míngtiān xīngqī sān.','Ngày mai thứ Tư.',2);
ge($conn,$g7_1,'昨天星期天。','Zuótiān xīngqī tiān.','Hôm qua Chủ nhật.',3);
$g7_2=g($conn,$L7,'Cách nói ngày tháng','Tháng + 月 + Ngày + 号','Ngày ... tháng ...','Thứ tự: tháng trước ngày sau. Hỏi: 几月几号？ (Tháng mấy ngày mấy?).','Có thể nói 日 (rì) thay cho 号 (hào) trong văn viết trang trọng.','Cấu trúc ngày tháng.',2);
ge($conn,$g7_2,'今天五月八号。','Jīntiān wǔ yuè bā hào.','Hôm nay ngày 8 tháng 5.',1);
ge($conn,$g7_2,'你的生日是几月几号？','Nǐ de shēngrì shì jǐ yuè jǐ hào?','Sinh nhật bạn ngày mấy?',2);
ge($conn,$g7_2,'一月一号。','Yī yuè yī hào.','Ngày 1 tháng 1.',3);
// Dialogues L7
$d7_1=d($conn,$L7,'Hoi hom nay ngay may','Hỏi về ngày tháng.',1);
ds($conn,$d7_1,'Anna','今天几月几号？','Jīntiān jǐ yuè jǐ hào?','Hôm nay ngày mấy?',1);
ds($conn,$d7_1,'Xiao Ming','五月八号。','Wǔ yuè bā hào.','Ngày 8 tháng 5.',2);
ds($conn,$d7_1,'Anna','星期几？','Xīngqī jǐ?','Thứ mấy?',3);
ds($conn,$d7_1,'Xiao Ming','星期三。','Xīngqī sān.','Thứ Tư.',4);
$d7_2=d($conn,$L7,'Hoi ve sinh nhat','Hỏi về sinh nhật.',2);
ds($conn,$d7_2,'Xiao Ming','你的生日是几月几号？','Nǐ de shēngrì shì jǐ yuè jǐ hào?','Sinh nhật bạn ngày nào?',1);
ds($conn,$d7_2,'Anna','六月十五号。','Liù yuè shíwǔ hào.','Ngày 15 tháng 6.',2);
ds($conn,$d7_2,'Xiao Ming','我的生日是十月一号。','Wǒ de shēngrì shì shí yuè yī hào.','Sinh nhật tôi là ngày 1 tháng 10.',3);
$d7_3=d($conn,$L7,'Hẹn lịch','Hẹn đi chơi cuối tuần.',3);
ds($conn,$d7_3,'Anna','星期六你有空吗？','Xīngqī liù nǐ yǒu kòng ma?','Thứ Bảy bạn có rảnh không?',1);
ds($conn,$d7_3,'Xiao Ming','有。我们去看电影吧。','Yǒu. Wǒmen qù kàn diànyǐng ba.','Rảnh. Chúng ta đi xem phim nhé.',2);
ds($conn,$d7_3,'Anna','好的。星期六见！','Hǎo de. Xīngqī liù jiàn!','Được. Thứ Bảy gặp nhé!',3);
// Reading L7
r($conn,$L7,'Lich cua toi','今天星期三，五月八号。明天五月九号，星期四。昨天五月七号，星期二。今年是2024年。我的生日是六月十五号。星期六我有空，想去看电影。','Jīntiān xīngqī sān, wǔ yuè bā hào. Míngtiān wǔ yuè jiǔ hào, xīngqī sì. Zuótiān wǔ yuè qī hào, xīngqī èr. Jīnnián shì èr líng èr sì nián. Wǒ de shēngrì shì liù yuè shíwǔ hào. Xīngqī liù wǒ yǒu kòng, xiǎng qù kàn diànyǐng.','Hôm nay thứ Tư, 8/5. Ngày mai thứ Năm, 9/5. Hôm qua thứ Ba, 7/5. Năm nay là 2024. Sinh nhật tôi 15/6. Thứ Bảy rảnh, muốn đi xem phim.','easy',65,1);
// Listening L7
$L7l=l($conn,$L7,'Ngay thang','A:今天几月几号？B:十月一号。A:星期几？B:星期二。A:你的生日是几月几号？B:我的生日是十二月二十五号。','A:Jīntiān jǐ yuè jǐ hào? B:Shí yuè yī hào. A:Xīngqī jǐ? B:Xīngqī èr. A:Nǐ de shēngrì shì jǐ yuè jǐ hào? B:Wǒ de shēngrì shì shíèr yuè èrshíwǔ hào.','A:Hôm nay ngày mấy? B:1/10. A:Thứ mấy? B:Thứ Ba. A:SN bạn ngày nào? B:25/12.','1');
lq($conn,$L7l,'Hôm nay ngày mấy?','{"A":"1/9","B":"1/10","C":"2/10"}','1/10','Ngày 1 tháng 10.','multiple_choice',1);
lq($conn,$L7l,'Hôm nay thứ mấy?','{"A":"Thứ Hai","B":"Thứ Ba","C":"Thứ Tư"}','Thứ Ba','Hôm nay thứ Ba.','multiple_choice',2);
lq($conn,$L7l,'Sinh nhật người B ngày nào?','{"A":"25/12","B":"1/10","C":"15/6"}','25/12','25 tháng 12.','multiple_choice',3);
// Exercises L7
$E7_1=e($conn,$L7,'Chọn đáp án','"Hôm qua" trong tiếng Trung là:','multiple_choice','easy',1,'C',1);
eo($conn,$E7_1,'今天','A',0,1); eo($conn,$E7_1,'明天','B',0,2); eo($conn,$E7_1,'昨天','C',1,3);
$E7_2=e($conn,$L7,'Dịch','"Hôm nay thứ Hai."','translation','easy',1,'今天星期一。',2);
$E7_3=e($conn,$L7,'Điền số thứ tự','星期一 = Thứ ___','fill_blank','easy',1,'Hai',3);
$E7_4=e($conn,$L7,'Sắp xếp câu','号 / 几 / 今天','sentence_order','easy',1,'今天几号？',4);
$E7_5=e($conn,$L7,'Chọn đúng/sai','"星期天" và "星期日" đều là Chủ nhật.','true_false','easy',1,'true',5);
eo($conn,$E7_5,'Đúng','A',1,1); eo($conn,$E7_5,'Sai','B',0,2);
$E7_6=e($conn,$L7,'Viết câu trả lời','Trả lời: 今天几月几号？','translation','easy',1,'今天八月二十号。',6);
// Review L7
foreach ([$v7_1,$v7_2,$v7_3,$v7_4,$v7_5,$v7_6,$v7_7,$v7_8,$v7_10] as $i=>$vid) if ($vid) rv($conn,$L7,$vid,'core',$i+1);
echo " L7 done: $v7 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L8: 我想喝茶 ───
$L8=createLesson($conn,1,8,'Bài 8: Wo xiang he cha - Tôi muốn uống trà','Đồ uống, thực phẩm. Diễn tả mong muốn: xiang/yao. Lượng từ chuyên dụng.','["Do uong","Thuc pham","Mong muon"]','Am thuc','easy','Bài 8: Từ vựng về đồ uống (chá-trà, kāfēi-cà phê, shuǐ-nước) và thực phẩm (fàn-cơm, miànbāo-bánh mì, píngguǒ-táo). Lượng từ chuyên dụng: bēi (ly), wǎn (bát), píng (chai). Động từ: chī (ăn), hē (uống). Phân biệt 想 và 要.');
$v8=0;
$v8_1=v($conn,$L8,1,'茶','chá','trà','trà','我想喝茶。','Wǒ xiǎng hē chá.','Tôi muốn uống trà.','noun','Đồ uống phổ biến ở Trung Quốc.',++$v8);
$v8_2=v($conn,$L8,1,'咖啡','kāfēi','cà phê','cà phê','一杯咖啡。','Yì bēi kāfēi.','Một ly cà phê.','noun','Từ vay mượn.',++$v8);
$v8_3=v($conn,$L8,1,'水','shuǐ','nước','nước','喝水。','Hē shuǐ.','Uống nước.','noun','Nước nói chung.',++$v8);
$v8_4=v($conn,$L8,1,'饭','fàn','cơm, đồ ăn','cơm','吃饭了吗？','Chī fàn le ma?','Ăn cơm chưa?','noun','Chỉ bữa ăn nói chung.',++$v8);
$v8_5=v($conn,$L8,1,'面包','miànbāo','bánh mì','bánh mì','我吃面包。','Wǒ chī miànbāo.','Tôi ăn bánh mì.','noun','miàn (bột mì) + bāo (bọc).',++$v8);
$v8_6=v($conn,$L8,1,'苹果','píngguǒ','táo','táo','一个苹果。','Yí gè píngguǒ.','Một quả táo.','noun','Trái cây phổ biến.',++$v8);
$v8_7=v($conn,$L8,1,'杯','bēi','cốc, ly (lượng từ)','ly','一杯茶。','Yì bēi chá.','Một ly trà.','measure','Lượng từ cho đồ uống.',++$v8);
$v8_8=v($conn,$L8,1,'碗','wǎn','bát (lượng từ)','bát','一碗饭。','Yì wǎn fàn.','Một bát cơm.','measure','Lượng từ cho bát.',++$v8);
$v8_9=v($conn,$L8,1,'瓶','píng','chai (lượng từ)','chai','一瓶水。','Yì píng shuǐ.','Một chai nước.','measure','Lượng từ cho chai.',++$v8);
$v8_10=v($conn,$L8,1,'吃','chī','ăn','ăn','吃饭。','Chī fàn.','Ăn cơm.','verb','Động từ ăn.',++$v8);
$v8_11=v($conn,$L8,1,'喝','hē','uống','uống','喝水。','Hē shuǐ.','Uống nước.','verb','Động từ uống.',++$v8);
// Grammar L8
$g8_1=g($conn,$L8,'Lượng từ chuyên dụng: 杯/碗/瓶','Số + 杯/碗/瓶 + Danh từ','Phân loại danh từ theo đồ chứa.','杯: đồ uống trong ly/cốc. 碗: đồ ăn trong bát. 瓶: đồ uống trong chai.','Không dùng 个 khi đã có lượng từ chuyên dụng.','Lượng từ đi kèm danh từ cụ thể.',1);
ge($conn,$g8_1,'一杯咖啡。','Yì bēi kāfēi.','Một ly cà phê.',1);
ge($conn,$g8_1,'一碗饭。','Yì wǎn fàn.','Một bát cơm.',2);
ge($conn,$g8_1,'一瓶水。','Yì píng shuǐ.','Một chai nước.',3);
$g8_2=g($conn,$L8,'Động từ 吃 và 喝','吃 + đồ ăn. 喝 + đồ uống.','Ăn (thức ăn), Uống (đồ uống).','吃 dùng với đồ ăn đặc: 吃饭, 吃面包, 吃苹果. 喝 dùng với đồ uống lỏng: 喝茶, 喝咖啡, 喝水.','Không nói "喝饭" hoặc "吃水".','Phân biệt rõ.',2);
ge($conn,$g8_2,'我吃面包。','Wǒ chī miànbāo.','Tôi ăn bánh mì.',1);
ge($conn,$g8_2,'我喝茶。','Wǒ hē chá.','Tôi uống trà.',2);
// Dialogues L8
$d8_1=d($conn,$L8,'Goi do uong','Tại quán nước.',1);
ds($conn,$d8_1,'Nhân viên','你想喝什么？','Nǐ xiǎng hē shénme?','Bạn muốn uống gì?',1);
ds($conn,$d8_1,'Xiao Ming','我要一杯茶。','Wǒ yào yì bēi chá.','Tôi muốn một ly trà.',2);
ds($conn,$d8_1,'Anna','我要一杯咖啡。','Wǒ yào yì bēi kāfēi.','Tôi muốn một ly cà phê.',3);
ds($conn,$d8_1,'Nhân viên','还要别的吗？','Hái yào biéde ma?','Còn muốn gì nữa không?',4);
ds($conn,$d8_1,'Xiao Ming','不要了，谢谢。','Bú yào le, xièxie.','Không ạ, cảm ơn.',5);
$d8_2=d($conn,$L8,'Mua đồ ăn','Mua đồ ăn sáng.',2);
ds($conn,$d8_2,'Anna','你吃什么？','Nǐ chī shénme?','Bạn ăn gì?',1);
ds($conn,$d8_2,'Xiao Ming','我吃面包，喝牛奶。','Wǒ chī miànbāo, hē niúnǎi.','Tôi ăn bánh mì, uống sữa.',2);
ds($conn,$d8_2,'Anna','我要一碗米饭。','Wǒ yào yì wǎn mǐfàn.','Tôi muốn một bát cơm.',3);
$d8_3=d($conn,$L8,'Mời khách ăn','Mời bạn về nhà ăn cơm.',3);
ds($conn,$d8_3,'Xiao Ming','请进！请坐。','Qǐng jìn! Qǐng zuò.','Mời vào! Mời ngồi.',1);
ds($conn,$d8_3,'Anna','谢谢。你想吃什么？','Xièxie. Nǐ xiǎng chī shénme?','Cảm ơn. Bạn muốn ăn gì?',2);
ds($conn,$d8_3,'Xiao Ming','我想吃苹果。','Wǒ xiǎng chī píngguǒ.','Tôi muốn ăn táo.',3);
// Reading L8
r($conn,$L8,'Buoi an cua toi','今天我去餐厅吃饭。我吃了一碗米饭，喝了一杯茶。朋友吃了一碗面条，喝了一瓶水。我们都吃得很饱。苹果很好吃。','Jīntiān wǒ qù cāntīng chīfàn. Wǒ chī le yì wǎn mǐfàn, hē le yì bēi chá. Péngyou chī le yì wǎn miàntiáo, hē le yì píng shuǐ. Wǒmen dōu chī de hěn bǎo. Píngguǒ hěn hǎochī.','Hôm nay tôi đi nhà hàng ăn cơm. Tôi ăn một bát cơm, uống một ly trà. Bạn tôi ăn một bát mì, uống một chai nước. Chúng tôi đều ăn no. Táo rất ngon.','easy',60,1);
// Listening L8
$L8l=l($conn,$L8,'Đồ uong va đồ an','A:你想喝什么？B:我想喝水。A:你要茶吗？B:不，我要咖啡。A:你吃什么？B:我吃面包和苹果。','A:Nǐ xiǎng hē shénme? B:Wǒ xiǎng hē shuǐ. A:Nǐ yào chá ma? B:Bù, wǒ yào kāfēi. A:Nǐ chī shénme? B:Wǒ chī miànbāo hé píngguǒ.','A:Bạn muốn uống gì? B:Tôi muốn uống nước. A:Bạn uống trà không? B:Không, tôi uống cà phê. A:Bạn ăn gì? B:Tôi ăn bánh mì và táo.','2');
lq($conn,$L8l,'Người B muốn uống gì trước tiên?','{"A":"Trà","B":"Nước","C":"Cà phê"}','Nước','Muốn uống nước.','multiple_choice',1);
lq($conn,$L8l,'Sau đó người B uống gì?','{"A":"Trà","B":"Nước","C":"Cà phê"}','Cà phê','Sau đó uống cà phê.','multiple_choice',2);
lq($conn,$L8l,'Người B ăn gì?','{"A":"Cơm","B":"Bánh mì và táo","C":"Mì"}','Bánh mì và táo','Ăn bánh mì và táo.','multiple_choice',3);
// Exercises L8
$E8_1=e($conn,$L8,'Chọn đáp án','"Bánh mì" tiếng Trung là:','multiple_choice','easy',1,'C',1);
eo($conn,$E8_1,'米饭','A',0,1); eo($conn,$E8_1,'苹果','B',0,2); eo($conn,$E8_1,'面包','C',1,3);
$E8_2=e($conn,$L8,'Dịch','"Một ly trà."','translation','easy',1,'一杯茶。',2);
$E8_3=e($conn,$L8,'Điền lượng từ','一___咖啡 (một ly cà phê)','fill_blank','easy',1,'杯',3);
$E8_4=e($conn,$L8,'Phân biệt 吃 và 喝','___茶 (uống trà) dùng từ nào?','multiple_choice','easy',1,'A',4);
eo($conn,$E8_4,'喝','A',1,1); eo($conn,$E8_4,'吃','B',0,2); eo($conn,$E8_4,'要','C',0,3);
$E8_5=e($conn,$L8,'Sắp xếp câu','一杯 / 我 / 咖啡 / 要','sentence_order','easy',1,'我要一杯咖啡。',5);
$E8_6=e($conn,$L8,'Chọn đúng/sai','"饭" có nghĩa là "cơm".','true_false','easy',1,'true',6);
eo($conn,$E8_6,'Đúng','A',1,1); eo($conn,$E8_6,'Sai','B',0,2);
$E8_7=e($conn,$L8,'Điền động từ','我___苹果。(ăn)','fill_blank','easy',1,'吃',7);
// Review L8
foreach ([$v8_1,$v8_3,$v8_4,$v8_5,$v8_7,$v8_8,$v8_10,$v8_11] as $i=>$vid) if ($vid) rv($conn,$L8,$vid,'core',$i+1);
echo " L8 done: $v8 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";

echo "\n HSK1 Lessons 5-8 done.\n";
echo "Continue with seed_hsk1_l9_15.php for lessons 9-15.\n";
