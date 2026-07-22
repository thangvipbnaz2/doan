<?php
/**
 * HÀNNGỮ - HSK1 Content Seeder (Lessons 9-12)
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ─── L9: 你住在哪儿 ───
$L9=createLesson($conn,1,9,'Bài 9: Ni zhu zai na er - Bạn sống ở đâu','Địa điểm, phương hướng. Giới từ 在. Động từ 住/去/来.','["Địa điểm","Phuong huong","Noi ở"]','Nha cua','easy','Bài 9: Từ vựng về địa điểm: xuéxiào (trường học), shāngdiàn (cửa hàng), yīyuàn (bệnh viện), túshūguǎn (thư viện). Cách hỏi và chỉ địa điểm với 在哪儿. Động từ: zhù (ở), qù (đi đến), lái (đến).');
$v9=0;
$v9_1=v($conn,$L9,1,'住','zhù','sống, ở','sống','我住在学校。','Wǒ zhù zài xuéxiào.','Tôi sống ở trường.','verb','Động từ chỉ nơi cư trú.',++$v9);
$v9_2=v($conn,$L9,1,'在','zài','ở, tại (giới từ)','ở','我在学校学习。','Wǒ zài xuéxiào xuéxí.','Tôi học ở trường.','verb/prep','Chỉ vị trí hoặc nơi chốn.',++$v9);
$v9_3=v($conn,$L9,1,'学校','xuéxiào','trường học','trường','在学校。','Zài xuéxiào.','Ở trường.','noun','xué (học) + xiào (trường).',++$v9);
$v9_4=v($conn,$L9,1,'商店','shāngdiàn','cửa hàng','cửa hàng','去商店。','Qù shāngdiàn.','Đi cửa hàng.','noun','shāng (buôn bán) + diàn (cửa hiệu).',++$v9);
$v9_5=v($conn,$L9,1,'医院','yīyuàn','bệnh viện','bệnh viện','去医院。','Qù yīyuàn.','Đi bệnh viện.','noun','yī (chữa bệnh) + yuàn (viện).',++$v9);
$v9_6=v($conn,$L9,1,'图书馆','túshūguǎn','thư viện','thư viện','在图书馆看书。','Zài túshūguǎn kàn shū.','Đọc sách ở thư viện.','noun','tú (hình vẽ) + shū (sách) + guǎn (quán).',++$v9);
$v9_7=v($conn,$L9,1,'去','qù','đi (đến một nơi)','đi','我去北京。','Wǒ qù Běijīng.','Tôi đi Bắc Kinh.','verb','Động từ chỉ sự di chuyển đến nơi khác.',++$v9);
$v9_8=v($conn,$L9,1,'来','lái','đến (tới nơi)','đến','你来我家。','Nǐ lái wǒ jiā.','Bạn đến nhà tôi.','verb','Động từ chỉ sự di chuyển đến gần người nói.',++$v9);
$v9_9=v($conn,$L9,1,'教室','jiàoshì','phòng học','phòng học','在教室学习。','Zài jiàoshì xuéxí.','Học trong phòng học.','noun','jiào (dạy) + shì (phòng).',++$v9);
$v9_10=v($conn,$L9,1,'里','lǐ','trong, bên trong','trong','在学校里。','Zài xuéxiào lǐ.','Ở trong trường.','noun','Chỉ vị trí bên trong.',++$v9);
// Grammar L9
$g9_1=g($conn,$L9,'Giới từ 在 (chỉ nơi chốn)','Chủ ngữ + 在 + Nơi chốn + Động từ','Ở đâu làm gì','在 đứng trước địa điểm để chỉ nơi diễn ra hành động. Trả lời câu hỏi 在哪儿.','Phủ định: 不在 (bú zài). Câu hỏi: 在哪儿 + Động từ？','Giới từ chỉ địa điểm quan trọng.',1);
ge($conn,$g9_1,'我在学校学习。','Wǒ zài xuéxiào xuéxí.','Tôi học ở trường.',1);
ge($conn,$g9_1,'他在家看书。','Tā zài jiā kàn shū.','Anh ấy đọc sách ở nhà.',2);
ge($conn,$g9_1,'你在哪儿住？','Nǐ zài nǎr zhù?','Bạn sống ở đâu?',3);
$g9_2=g($conn,$L9,'Động từ 去 và 来','去 + Nơi đến. 来 + Nơi đến.','Đi (xa người nói), Đến (gần người nói).','去: từ vị trí hiện tại đi đến nơi khác. 来: từ nơi khác đến vị trí hiện tại. Phân biệt tương tự tiếng Việt.','去 và 来 đều có thể dùng với 吗 để hỏi.','Cặp động từ đối lập.',2);
ge($conn,$g9_2,'我去商店。','Wǒ qù shāngdiàn.','Tôi đi cửa hàng.',1);
ge($conn,$g9_2,'你来我家吗？','Nǐ lái wǒ jiā ma?','Bạn đến nhà tôi không?',2);
// Dialogues L9
$d9_1=d($conn,$L9,'Hoi noi o','Hỏi về nơi ở.',1);
ds($conn,$d9_1,'Xiao Ming','你住在哪儿？','Nǐ zhù zài nǎr?','Bạn sống ở đâu?',1);
ds($conn,$d9_1,'Anna','我住在学校附近。','Wǒ zhù zài xuéxiào fùjìn.','Tôi sống gần trường.',2);
ds($conn,$d9_1,'Xiao Ming','我也住在学校附近。','Wǒ yě zhù zài xuéxiào fùjìn.','Tôi cũng sống gần trường.',3);
$d9_2=d($conn,$L9,'Chi duong','Chỉ đường đến thư viện.',2);
ds($conn,$d9_2,'Anna','请问，图书馆在哪儿？','Qǐngwèn, túshūguǎn zài nǎr?','Xin hỏi, thư viện ở đâu?',1);
ds($conn,$d9_2,'Xiao Ming','在学校里面。','Zài xuéxiào lǐmiàn.','Ở trong trường.',2);
ds($conn,$d9_2,'Anna','谢谢！我去图书馆看书。','Xièxie! Wǒ qù túshūguǎn kàn shū.','Cảm ơn! Tôi đi thư viện đọc sách.',3);
$d9_3=d($conn,$L9,'Ru nhau đi choi','Rủ nhau đi chơi cuối tuần.',3);
ds($conn,$d9_3,'Anna','明天你去哪儿？','Míngtiān nǐ qù nǎr?','Ngày mai bạn đi đâu?',1);
ds($conn,$d9_3,'Xiao Ming','我去商店买东西。','Wǒ qù shāngdiàn mǎi dōngxi.','Tôi đi cửa hàng mua đồ.',2);
ds($conn,$d9_3,'Anna','我也想买。我们一起去！','Wǒ yě xiǎng mǎi. Wǒmen yìqǐ qù!','Tôi cũng muốn mua. Chúng ta cùng đi!',3);
// Reading L9
r($conn,$L9,'Noi o va truong hoc','我住在学校附近的宿舍。学校里有图书馆、教室和商店。我每天去图书馆学习。朋友来我家玩。我们都很高兴。学校附近还有医院。','Wǒ zhù zài xuéxiào fùjìn de sùshè. Xuéxiào lǐ yǒu túshūguǎn, jiàoshì hé shāngdiàn. Wǒ měitiān qù túshūguǎn xuéxí. Péngyou lái wǒ jiā wán. Wǒmen dōu hěn gāoxìng. Xuéxiào fùjìn hái yǒu yīyuàn.','Tôi ở ký túc xá gần trường. Trong trường có thư viện, phòng học và cửa hàng. Hàng ngày tôi đến thư viện học. Bạn đến nhà tôi chơi. Chúng tôi đều vui. Gần trường còn có bệnh viện.','easy',68,1);
// Listening L9
$L9l=l($conn,$L9,'Hoi duong','A:你去哪儿？B:我去图书馆。A:图书馆在哪儿？B:在学校里面。A:你每天去吗？B:对，我每天去。','A:Nǐ qù nǎr? B:Wǒ qù túshūguǎn. A:Túshūguǎn zài nǎr? B:Zài xuéxiào lǐmiàn. A:Nǐ měitiān qù ma? B:Duì, wǒ měitiān qù.','A:Bạn đi đâu? B:Tôi đi thư viện. A:Thư viện ở đâu? B:Trong trường. A:Bạn đi mỗi ngày à? B:Đúng, tôi đi mỗi ngày.','1');
lq($conn,$L9l,'Người B đi đâu?','{"A":"Cửa hàng","B":"Thư viện","C":"Bệnh viện"}','Thư viện','Đi thư viện.','multiple_choice',1);
lq($conn,$L9l,'Thư viện ở đâu?','{"A":"Trong trường","B":"Gần trường","C":"Trong nhà"}','Trong trường','Trong trường học.','multiple_choice',2);
// Exercises L9
$E9_1=e($conn,$L9,'Chọn đáp án','"Bệnh viện" tiếng Trung là:','multiple_choice','easy',1,'B',1);
eo($conn,$E9_1,'学校','A',0,1); eo($conn,$E9_1,'医院','B',1,2); eo($conn,$E9_1,'商店','C',0,3);
$E9_2=e($conn,$L9,'Dịch','"Tôi học ở thư viện."','translation','easy',1,'我在图书馆学习。',2);
$E9_3=e($conn,$L9,'Điền giới từ','我___学校学习。(ở)','fill_blank','easy',1,'在',3);
$E9_4=e($conn,$L9,'Phân biệt 去 và 来','Tôi ___ nhà bạn. (đến)','multiple_choice','easy',1,'B',4);
eo($conn,$E9_4,'去','A',0,1); eo($conn,$E9_4,'来','B',1,2);
$E9_5=e($conn,$L9,'Sắp xếp câu','哪儿 / 在 / 图书馆','sentence_order','easy',1,'图书馆在哪儿？',5);
$E9_6=e($conn,$L9,'Chọn đúng/sai','"在" có thể đứng một mình làm động từ.','true_false','easy',1,'true',6);
eo($conn,$E9_6,'Đúng','A',1,1); eo($conn,$E9_6,'Sai','B',0,2);
// Review L9
foreach ([$v9_1,$v9_2,$v9_3,$v9_4,$v9_5,$v9_6,$v9_7,$v9_8] as $i=>$vid) if ($vid) rv($conn,$L9,$vid,'core',$i+1);
echo " L9 done: $v9 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L10: 你的生日是几月几号 ───
$L10=createLesson($conn,1,10,'Bài 10: Ni de sheng ri shi ji yue ji hao','Sinh nhật, quà tặng. Trợ từ 了. Câu chúc.','["Sinh nhat","Qua tang","Chuc mung"]','Sinh nhat','easy','Bài 10: Chủ đề sinh nhật: shēngrì (sinh nhật), lǐwù (quà tặng), dàngāo (bánh kem). Trợ từ 了 biểu thị sự hoàn thành hoặc thay đổi. Câu chúc: zhù nǐ shēngrì kuàilè (chúc mừng sinh nhật).');
$v10=0;
$v10_1=v($conn,$L10,1,'生日','shēngrì','sinh nhật','sinh nhật','生日快乐！','Shēngrì kuàilè!','Chúc mừng sinh nhật!','noun','shēng (sinh) + rì (ngày).',++$v10);
$v10_2=v($conn,$L10,1,'快乐','kuàilè','vui vẻ, hạnh phúc','vui vẻ','新年快乐！','Xīnnián kuàilè!','Chúc mừng năm mới!','adj','kuài (nhanh) + lè (vui).',++$v10);
$v10_3=v($conn,$L10,1,'礼物','lǐwù','quà tặng','quà','送礼物。','Sòng lǐwù.','Tặng quà.','noun','lǐ (lễ) + wù (vật).',++$v10);
$v10_4=v($conn,$L10,1,'蛋糕','dàngāo','bánh kem','bánh kem','吃蛋糕。','Chī dàngāo.','Ăn bánh kem.','noun','dàn (trứng) + gāo (bánh).',++$v10);
$v10_5=v($conn,$L10,1,'送','sòng','tặng, tiễn','tặng','送你一个礼物。','Sòng nǐ yí gè lǐwù.','Tặng bạn một món quà.','verb','Động từ trao tặng.',++$v10);
$v10_6=v($conn,$L10,1,'祝','zhù','chúc','chúc','祝你生日快乐！','Zhù nǐ shēngrì kuàilè!','Chúc bạn sinh nhật vui vẻ!','verb','Dùng trong lời chúc.',++$v10);
$v10_7=v($conn,$L10,1,'高兴','gāoxìng','vui vẻ, phấn khởi','vui','我很高兴。','Wǒ hěn gāoxìng.','Tôi rất vui.','adj','Cảm xúc tích cực.',++$v10);
$v10_8=v($conn,$L10,1,'漂亮','piàoliang','đẹp, xinh đẹp','đẹp','她真漂亮！','Tā zhēn piàoliang!','Cô ấy thật đẹp!','adj','Miêu tả ngoại hình.',++$v10);
$v10_9=v($conn,$L10,1,'花','huā','hoa, bông hoa','hoa','送花。','Sòng huā.','Tặng hoa.','noun','Bông hoa.',++$v10);
// Grammar L10
$g10_1=g($conn,$L10,'Trợ từ 了 (thay đổi)','Chủ ngữ + V + 了 (+ Tân ngữ)','Đã... rồi / Bây giờ thì...','了 biểu thị sự thay đổi hoặc hành động đã xảy ra. Đặt sau động từ. Phủ định: 没有 + V.','了 ở cuối câu chỉ thay đổi trạng thái. 了 sau động từ chỉ hành động hoàn thành.','Trợ từ quan trọng chỉ sự hoàn thành.',1);
ge($conn,$g10_1,'我吃了饭。','Wǒ chī le fàn.','Tôi đã ăn cơm (rồi).',1);
ge($conn,$g10_1,'他来了。','Tā lái le.','Anh ấy đến rồi.',2);
ge($conn,$g10_1,'生日到了。','Shēngrì dào le.','Sinh nhật đến rồi.',3);
$g10_2=g($conn,$L10,'Câu chúc với 祝','祝 + Người + (Tính từ) + Danh từ','Chúc ai đó...','Cấu trúc chúc mừng. Thường đứng đầu câu. Có thể thay bằng 祝愿 (zhùyuàn) trong văn viết.','Câu chúc thường có 快乐, 幸福, 健康.','Văn hóa chúc mừng.',2);
ge($conn,$g10_2,'祝你生日快乐！','Zhù nǐ shēngrì kuàilè!','Chúc bạn sinh nhật vui vẻ!',1);
ge($conn,$g10_2,'祝你新年快乐！','Zhù nǐ xīnnián kuàilè!','Chúc bạn năm mới vui vẻ!',2);
// Dialogues L10
$d10_1=d($conn,$L10,'Sinh nhat vui ve','Tổ chức sinh nhật cho bạn.',1);
ds($conn,$d10_1,'Xiao Ming','今天是我的生日！','Jīntiān shì wǒ de shēngrì!','Hôm nay là sinh nhật tôi!',1);
ds($conn,$d10_1,'Anna','生日快乐！这是你的礼物。','Shēngrì kuàilè! Zhè shì nǐ de lǐwù.','Chúc mừng sinh nhật! Đây là quà cho bạn.',2);
ds($conn,$d10_1,'Xiao Ming','谢谢！我很高兴。','Xièxie! Wǒ hěn gāoxìng.','Cảm ơn! Tôi rất vui.',3);
ds($conn,$d10_1,'Anna','我们吃蛋糕吧。','Wǒmen chī dàngāo ba.','Chúng ta ăn bánh kem nhé.',4);
$d10_2=d($conn,$L10,'Tang qua','Tặng quà cho nhau.',2);
ds($conn,$d10_2,'Xiao Ming','送给你！生日快乐！','Sòng gěi nǐ! Shēngrì kuàilè!','Tặng bạn! Sinh nhật vui vẻ!',1);
ds($conn,$d10_2,'Anna','哇，好漂亮的花！谢谢你！','Wa, hǎo piàoliang de huā! Xièxie nǐ!','Wow, hoa đẹp quá! Cảm ơn bạn!',2);
$d10_3=d($conn,$L10,'Moi du sinh nhat','Mời bạn đến dự sinh nhật.',3);
ds($conn,$d10_3,'Anna','星期六是我的生日，你来吗？','Xīngqī liù shì wǒ de shēngrì, nǐ lái ma?','Thứ Bảy là sinh nhật tôi, bạn đến không?',1);
ds($conn,$d10_3,'Xiao Ming','我来。祝你生日快乐！','Wǒ lái. Zhù nǐ shēngrì kuàilè!','Tôi đến. Chúc bạn sinh nhật vui vẻ!',2);
// Reading L10
r($conn,$L10,'Buoi sinh nhat vui ve','今天是我的生日。我二十岁了。朋友来我家。Anna送我礼物和花。妈妈做了蛋糕。蛋糕很好吃。我们都很高兴。生日快乐！','Jīntiān shì wǒ de shēngrì. Wǒ èrshí suì le. Péngyou lái wǒ jiā. Anna sòng wǒ lǐwù hé huā. Māma zuò le dàngāo. Dàngāo hěn hǎochī. Wǒmen dōu hěn gāoxìng. Shēngrì kuàilè!','Hôm nay là sinh nhật tôi. Tôi 20 tuổi rồi. Bạn bè đến nhà. Anna tặng tôi quà và hoa. Mẹ làm bánh kem. Bánh kem rất ngon. Chúng tôi đều vui. Sinh nhật vui vẻ!','easy',72,1);
// Listening L10
$L10l=l($conn,$L10,'Sinh nhat','A:你的生日是几月几号？B:五月十号。A:你几岁了？B:我二十岁。A:生日快乐！送你一个礼物。B:谢谢！','A:Nǐ de shēngrì shì jǐ yuè jǐ hào? B:Wǔ yuè shí hào. A:Nǐ jǐ suì le? B:Wǒ èrshí suì. A:Shēngrì kuàilè! Sòng nǐ yí gè lǐwù. B:Xièxie!','A:SN bạn ngày nào? B:10/5. A:Bạn bao nhiêu tuổi? B:20. A:SN vui vẻ! Tặng bạn quà. B:Cảm ơn!','2');
lq($conn,$L10l,'Sinh nhật người B ngày nào?','{"A":"10/4","B":"10/5","C":"5/10"}','10/5','Ngày 10 tháng 5.','multiple_choice',1);
lq($conn,$L10l,'Người B bao nhiêu tuổi?','{"A":"18","B":"20","C":"22"}','20','20 tuổi.','multiple_choice',2);
// Exercises L10
$E10_1=e($conn,$L10,'Chọn đáp án','"Chúc mừng sinh nhật" là:','multiple_choice','easy',1,'B',1);
eo($conn,$E10_1,'新年快乐','A',0,1); eo($conn,$E10_1,'生日快乐','B',1,2); eo($conn,$E10_1,'节日快乐','C',0,3);
$E10_2=e($conn,$L10,'Dịch','"Tôi rất vui."','translation','easy',1,'我很高兴。',2);
$E10_3=e($conn,$L10,'Điền từ','祝你生日___！(vui vẻ)','fill_blank','easy',1,'快乐',3);
$E10_4=e($conn,$L10,'Sắp xếp câu','礼物 / 你 / 送 / 我','sentence_order','easy',1,'我送你礼物。',4);
$E10_5=e($conn,$L10,'Chọn đúng/sai','"了" đặt cuối câu chỉ sự thay đổi.','true_false','easy',1,'true',5);
eo($conn,$E10_5,'Đúng','A',1,1); eo($conn,$E10_5,'Sai','B',0,2);
$E10_6=e($conn,$L10,'Chọn đáp án','"Quà tặng" tiếng Trung là:','multiple_choice','easy',1,'A',6);
eo($conn,$E10_6,'礼物','A',1,1); eo($conn,$E10_6,'蛋糕','B',0,2); eo($conn,$E10_6,'花','C',0,3);
// Review L10
foreach ([$v10_1,$v10_2,$v10_3,$v10_4,$v10_5,$v10_6,$v10_7,$v10_9] as $i=>$vid) if ($vid) rv($conn,$L10,$vid,'core',$i+1);
echo " L10 done: $v10 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L11: 看电影 ───
$L11=createLesson($conn,1,11,'Bài 11: Kan dian ying - Xem phim','Giải trí, sở thích. Cách nói thích. Hẹn với 一起.','["Giai tri","So thich","Hen ho"]','So thich','easy','Bài 11: Từ vựng giải trí: kàn diànyǐng (xem phim), tīng yīnyuè (nghe nhạc). Động từ thích: xǐhuan (thích), ài (yêu). Hẹn nhau: yìqǐ (cùng nhau). Động từ làm chủ ngữ.');
$v11=0;
$v11_1=v($conn,$L11,1,'看','kàn','xem, nhìn','xem','看电影。','Kàn diànyǐng.','Xem phim.','verb','Hành động xem/nhìn.',++$v11);
$v11_2=v($conn,$L11,1,'电影','diànyǐng','phim ảnh','phim','我喜欢看电影。','Wǒ xǐhuan kàn diànyǐng.','Tôi thích xem phim.','noun','diàn (điện) + yǐng (bóng).',++$v11);
$v11_3=v($conn,$L11,1,'电视','diànshì','tivi','tivi','看电视。','Kàn diànshì.','Xem tivi.','noun','diàn (điện) + shì (thị).',++$v11);
$v11_4=v($conn,$L11,1,'音乐','yīnyuè','âm nhạc, nhạc','nhạc','听音乐。','Tīng yīnyuè.','Nghe nhạc.','noun','yīn (âm) + yuè (nhạc).',++$v11);
$v11_5=v($conn,$L11,1,'喜欢','xǐhuan','thích','thích','我很喜欢。','Wǒ hěn xǐhuan.','Tôi rất thích.','verb','Động từ chỉ sự yêu thích.',++$v11);
$v11_6=v($conn,$L11,1,'爱','ài','yêu','yêu','我爱你。','Wǒ ài nǐ.','Anh yêu em.','verb','Tình cảm mạnh mẽ, sâu sắc.',++$v11);
$v11_7=v($conn,$L11,1,'一起','yìqǐ','cùng nhau','cùng','一起看电影。','Yìqǐ kàn diànyǐng.','Cùng nhau xem phim.','adv','Trạng từ, đặt trước động từ.',++$v11);
$v11_8=v($conn,$L11,1,'运动','yùndòng','thể thao, vận động','thể thao','做运动。','Zuò yùndòng.','Làm thể thao.','noun','yùn (vận) + dòng (động).',++$v11);
// Grammar L11
$g11_1=g($conn,$L11,'Cấu trúc thích: 喜欢/爱','S + 喜欢/爱 + (V) + O','Thích/Yêu ai/cái gì','喜欢 chỉ sự yêu thích nói chung. 爱 chỉ tình yêu sâu sắc. Cả hai đều có thể đứng trước động từ.','喜欢 + V: 喜欢看电影. 爱 + V: 爱吃苹果.','Phân biệt 喜欢 và 爱.',1);
ge($conn,$g11_1,'我喜欢看电影。','Wǒ xǐhuan kàn diànyǐng.','Tôi thích xem phim.',1);
ge($conn,$g11_1,'她喜欢音乐。','Tā xǐhuan yīnyuè.','Cô ấy thích âm nhạc.',2);
ge($conn,$g11_1,'我爱运动。','Wǒ ài yùndòng.','Tôi yêu thể thao.',3);
$g11_2=g($conn,$L11,'Hẹn với 一起 (cùng nhau)','S + 一起 + V (+ O)','Cùng nhau làm gì','一起 đứng trước động từ. Có thể dùng trong câu rủ rê.','Thường kết hợp với ba (nhé): 我们一起去吧！','Rủ rê, hẹn hò.',2);
ge($conn,$g11_2,'我们一起去。','Wǒmen yìqǐ qù.','Chúng ta cùng đi.',1);
ge($conn,$g11_2,'一起看电视吧。','Yìqǐ kàn diànshì ba.','Cùng xem tivi nhé.',2);
// Dialogues L11
$d11_1=d($conn,$L11,'Ru xem phim','Rủ bạn đi xem phim cuối tuần.',1);
ds($conn,$d11_1,'Xiao Ming','你喜欢看电影吗？','Nǐ xǐhuan kàn diànyǐng ma?','Bạn thích xem phim không?',1);
ds($conn,$d11_1,'Anna','很喜欢！','Hěn xǐhuan!','Rất thích!',2);
ds($conn,$d11_1,'Xiao Ming','星期六我们一起去。','Xīngqī liù wǒmen yìqǐ qù.','Thứ Bảy chúng ta cùng đi.',3);
ds($conn,$d11_1,'Anna','好的！几点？','Hǎo de! Jǐ diǎn?','Được! Mấy giờ?',4);
$d11_2=d($conn,$L11,'So thich ca nhan','Nói về sở thích của mỗi người.',2);
ds($conn,$d11_2,'Anna','你喜欢什么运动？','Nǐ xǐhuan shénme yùndòng?','Bạn thích thể thao gì?',1);
ds($conn,$d11_2,'Xiao Ming','我喜欢跑步。你呢？','Wǒ xǐhuan pǎobù. Nǐ ne?','Tôi thích chạy bộ. Còn bạn?',2);
ds($conn,$d11_2,'Anna','我喜欢听音乐和看电影。','Wǒ xǐhuan tīng yīnyuè hé kàn diànyǐng.','Tôi thích nghe nhạc và xem phim.',3);
$d11_3=d($conn,$L11,'Hen di nghe nhac','Rủ nhau đi nghe nhạc.',3);
ds($conn,$d11_3,'Xiao Ming','有音乐会，你想去吗？','Yǒu yīnyuèhuì, nǐ xiǎng qù ma?','Có buổi hòa nhạc, bạn muốn đi không?',1);
ds($conn,$d11_3,'Anna','想！我爱听音乐。','Xiǎng! Wǒ ài tīng yīnyuè.','Muốn! Tôi yêu nghe nhạc.',2);
// Reading L11
r($conn,$L11,'So thich cuoi tuan','我喜欢看电影和听音乐。周末我常和朋友一起看电影。她喜欢运动，她每天跑步。我们一起去公园。她在公园跑步，我在公园看书。我们都喜欢周末。','Wǒ xǐhuan kàn diànyǐng hé tīng yīnyuè. Zhōumò wǒ cháng hé péngyou yìqǐ kàn diànyǐng. Tā xǐhuan yùndòng, tā měitiān pǎobù. Wǒmen yìqǐ qù gōngyuán. Tā zài gōngyuán pǎobù, wǒ zài gōngyuán kàn shū. Wǒmen dōu xǐhuan zhōumò.','Tôi thích xem phim và nghe nhạc. Cuối tuần tôi thường cùng bạn xem phim. Cô ấy thích thể thao, chạy bộ mỗi ngày. Chúng tôi cùng đi công viên.','easy',70,1);
// Listening L11
$L11l=l($conn,$L11,'So thich','A:你喜欢什么？B:我喜欢听音乐。A:你呢？B:我也喜欢看电影。A:我们星期六一起去看电影吧。B:好的！','A:Nǐ xǐhuan shénme? B:Wǒ xǐhuan tīng yīnyuè. A:Nǐ ne? B:Wǒ yě xǐhuan kàn diànyǐng. A:Wǒmen xīngqī liù yìqǐ qù kàn diànyǐng ba. B:Hǎo de!','A:Bạn thích gì? B:Tôi thích nghe nhạc. A:Còn bạn? B:Tôi cũng thích xem phim. A:Chúng ta thứ 7 cùng đi xem phim nhé. B:Được!','1');
lq($conn,$L11l,'Người B thích gì?','{"A":"Phim","B":"Nhạc","C":"Thể thao"}','Nhạc','Thích nghe nhạc.','multiple_choice',1);
lq($conn,$L11l,'Họ dự định làm gì thứ Bảy?','{"A":"Nghe nhạc","B":"Xem phim","C":"Chạy bộ"}','Xem phim','Đi xem phim.','multiple_choice',2);
// Exercises L11
$E11_1=e($conn,$L11,'Chọn đáp án','"Thích" trong tiếng Trung là:','multiple_choice','easy',1,'B',1);
eo($conn,$E11_1,'爱','A',0,1); eo($conn,$E11_1,'喜欢','B',1,2); eo($conn,$E11_1,'要','C',0,3);
$E11_2=e($conn,$L11,'Dịch','"Chúng ta cùng đi xem phim nhé."','translation','easy',1,'我们一起去看电影吧。',2);
$E11_3=e($conn,$L11,'Điền từ','我___看电影。(thích)','fill_blank','easy',1,'喜欢',3);
$E11_4=e($conn,$L11,'Sắp xếp câu','一起 / 我们 / 去','sentence_order','easy',1,'我们一起去。',4);
$E11_5=e($conn,$L11,'Chọn đúng/sai','"爱" mạnh hơn "喜欢".','true_false','easy',1,'true',5);
eo($conn,$E11_5,'Đúng','A',1,1); eo($conn,$E11_5,'Sai','B',0,2);
$E11_6=e($conn,$L11,'Chọn đáp án','"一起去" có nghĩa là:','multiple_choice','easy',1,'C',6);
eo($conn,$E11_6,'Đi một mình','A',0,1); eo($conn,$E11_6,'Đi sau','B',0,2); eo($conn,$E11_6,'Cùng nhau đi','C',1,3);
// Review L11
foreach ([$v11_1,$v11_2,$v11_4,$v11_5,$v11_6,$v11_7,$v11_8] as $i=>$vid) if ($vid) rv($conn,$L11,$vid,'core',$i+1);
echo " L11 done: $v11 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

// ─── L12: 天气怎么样 ───
$L12=createLesson($conn,1,12,'Bài 12: Tian qi - Thời tiết','Thời tiết, mùa trong năm. 怎么样. Tính từ mô tả.','["Thoi tiet","Mua","Mo ta"]','Thoi tiet','easy','Bài 12: Từ vựng thời tiết: tiānqì (thời tiết), lěng (lạnh), rè (nóng), xià yǔ (mưa). Bốn mùa: chūntiān (xuân), xiàtiān (hè), qiūtiān (thu), dōngtiān (đông). Câu hỏi với zěnmeyàng (thế nào). Cấu trúc 不...不...');
$v12=0;
$v12_1=v($conn,$L12,1,'天气','tiānqì','thời tiết','thời tiết','今天天气很好。','Jīntiān tiānqì hěn hǎo.','Hôm nay thời tiết rất đẹp.','noun','tiān (trời) + qì (khí).',++$v12);
$v12_2=v($conn,$L12,1,'冷','lěng','lạnh, lạnh giá','lạnh','今天很冷。','Jīntiān hěn lěng.','Hôm nay rất lạnh.','adj','Tính từ chỉ nhiệt độ thấp.',++$v12);
$v12_3=v($conn,$L12,1,'热','rè','nóng, nóng bức','nóng','夏天很热。','Xiàtiān hěn rè.','Mùa hè nóng.','adj','Tính từ chỉ nhiệt độ cao.',++$v12);
$v12_4=v($conn,$L12,1,'下雨','xià yǔ','mưa, trời mưa','mưa','今天下雨。','Jīntiān xià yǔ.','Hôm nay trời mưa.','verb','xià (rơi) + yǔ (mưa).',++$v12);
$v12_5=v($conn,$L12,1,'春天','chūntiān','mùa xuân','mùa xuân','春天不冷不热。','Chūntiān bù lěng bú rè.','Mùa xuân không lạnh không nóng.','noun','chūn (xuân) + tiān (trời).',++$v12);
$v12_6=v($conn,$L12,1,'夏天','xiàtiān','mùa hè','mùa hè','夏天游泳。','Xiàtiān yóuyǒng.','Mùa hè đi bơi.','noun','xià (hạ) + tiān (trời).',++$v12);
$v12_7=v($conn,$L12,1,'秋天','qiūtiān','mùa thu','mùa thu','秋天很凉快。','Qiūtiān hěn liángkuai.','Mùa thu mát mẻ.','noun','qiū (thu) + tiān (trời).',++$v12);
$v12_8=v($conn,$L12,1,'冬天','dōngtiān','mùa đông','mùa đông','冬天很冷。','Dōngtiān hěn lěng.','Mùa đông lạnh.','noun','dōng (đông) + tiān (trời).',++$v12);
$v12_9=v($conn,$L12,1,'怎么样','zěnmeyàng','thế nào, ra sao','thế nào','天气怎么样？','Tiānqì zěnmeyàng?','Thời tiết thế nào?','pronoun','Hỏi về tình trạng, tính chất.',++$v12);
$v12_10=v($conn,$L12,1,'风','fēng','gió','gió','今天有风。','Jīntiān yǒu fēng.','Hôm nay có gió.','noun','Hiện tượng gió.',++$v12);
// Grammar L12
$g12_1=g($conn,$L12,'Câu hỏi với 怎么样','S + 怎么样？','...thế nào?','Hỏi về tình trạng, tính chất hoặc ý kiến. 怎么样 đứng cuối câu.','Dùng để hỏi thời tiết, sức khỏe, chất lượng. Có thể trả lời bằng 很好/不太好.','Câu hỏi tổng quát.',1);
ge($conn,$g12_1,'今天天气怎么样？','Jīntiān tiānqì zěnmeyàng?','Hôm nay thời tiết thế nào?',1);
ge($conn,$g12_1,'工作怎么样？','Gōngzuò zěnmeyàng?','Công việc thế nào?',2);
ge($conn,$g12_1,'这本书怎么样？','Zhè běn shū zěnmeyàng?','Cuốn sách này thế nào?',3);
$g12_2=g($conn,$L12,'Cấu trúc 不...不...','不 + A + 不 + B','Không...không... (vừa phải)','Diễn tả mức độ vừa phải, không quá. Thường dùng với cặp tính từ trái nghĩa.','不冷不热 = không lạnh không nóng = mát mẻ. 不大不小 = không lớn không nhỏ = vừa.','Cấu trúc đặc biệt.',2);
ge($conn,$g12_2,'春天不冷不热。','Chūntiān bù lěng bú rè.','Mùa xuân không lạnh không nóng.',1);
ge($conn,$g12_2,'这个不大不小。','Zhè ge bú dà bù xiǎo.','Cái này không lớn không nhỏ.',2);
// Dialogues L12
$d12_1=d($conn,$L12,'Hoi ve thoi tiet','Hỏi về thời tiết hôm nay.',1);
ds($conn,$d12_1,'Anna','今天天气怎么样？','Jīntiān tiānqì zěnmeyàng?','Hôm nay thời tiết thế nào?',1);
ds($conn,$d12_1,'Xiao Ming','今天很冷，下雨了。','Jīntiān hěn lěng, xià yǔ le.','Hôm nay lạnh, trời mưa rồi.',2);
ds($conn,$d12_1,'Anna','我不喜欢下雨天。','Wǒ bù xǐhuan xià yǔ tiān.','Tôi không thích ngày mưa.',3);
$d12_2=d($conn,$L12,'Bon mua','Nói về các mùa trong năm.',2);
ds($conn,$d12_2,'Xiao Ming','你最喜欢哪个季节？','Nǐ zuì xǐhuan nǎ ge jìjié?','Bạn thích mùa nào nhất?',1);
ds($conn,$d12_2,'Anna','我喜欢春天，不冷不热。','Wǒ xǐhuan chūntiān, bù lěng bú rè.','Tôi thích mùa xuân, không lạnh không nóng.',2);
ds($conn,$d12_2,'Xiao Ming','我喜欢夏天，可以游泳。','Wǒ xǐhuan xiàtiān, kěyǐ yóuyǒng.','Tôi thích mùa hè, có thể bơi.',3);
$d12_3=d($conn,$L12,'Du bao thoi tiet','Xem dự báo thời tiết.',3);
ds($conn,$d12_3,'Anna','明天天气好不好？','Míngtiān tiānqì hǎo bù hǎo?','Ngày mai thời tiết có tốt không?',1);
ds($conn,$d12_3,'Xiao Ming','明天不下雨，有风。','Míngtiān bú xià yǔ, yǒu fēng.','Ngày mai không mưa, có gió.',2);
// Reading L12
r($conn,$L12,'Bon mua trong nam','一年有四个季节：春天、夏天、秋天、冬天。春天不冷不热。夏天很热。秋天很凉快。冬天很冷，下雪。我喜欢春天和秋天，天气好。','Yì nián yǒu sì gè jìjié: chūntiān, xiàtiān, qiūtiān, dōngtiān. Chūntiān bù lěng bú rè. Xiàtiān hěn rè. Qiūtiān hěn liángkuai. Dōngtiān hěn lěng, xià xuě. Wǒ xǐhuan chūntiān hé qiūtiān, tiānqì hǎo.','Một năm có bốn mùa: xuân, hạ, thu, đông. Xuân không lạnh không nóng. Hè rất nóng. Thu mát mẻ. Đông rất lạnh, có tuyết. Tôi thích xuân và thu, thời tiết đẹp.','easy',70,1);
// Listening L12
$L12l=l($conn,$L12,'Thoi tiet','A:今天天气怎么样？B:下雨，很冷。A:你带伞了吗？B:带了。A:明天呢？B:明天不下雨，暖和。','A:Jīntiān tiānqì zěnmeyàng? B:Xià yǔ, hěn lěng. A:Nǐ dài sǎn le ma? B:Dài le. A:Míngtiān ne? B:Míngtiān bú xià yǔ, nuǎnhuo.','A:Hôm nay thời tiết thế nào? B:Mưa, lạnh. A:Bạn mang ô chưa? B:Rồi. A:Ngày mai? B:Ngày mai không mưa, ấm áp.','1');
lq($conn,$L12l,'Hôm nay thời tiết thế nào?','{"A":"Nắng","B":"Mưa","C":"Tuyết"}','Mưa','Trời mưa.','multiple_choice',1);
lq($conn,$L12l,'Ngày mai thời tiết thế nào?','{"A":"Mưa","B":"Không mưa, ấm","C":"Lạnh"}','Không mưa, ấm','Không mưa, ấm áp.','multiple_choice',2);
// Exercises L12
$E12_1=e($conn,$L12,'Chọn đáp án','"Nóng" tiếng Trung là:','multiple_choice','easy',1,'A',1);
eo($conn,$E12_1,'热','A',1,1); eo($conn,$E12_1,'冷','B',0,2); eo($conn,$E12_1,'风','C',0,3);
$E12_2=e($conn,$L12,'Dịch','"Hôm nay rất lạnh."','translation','easy',1,'今天很冷。',2);
$E12_3=e($conn,$L12,'Điền từ','今天___雨。(trời mưa)','fill_blank','easy',1,'下',3);
$E12_4=e($conn,$L12,'Sắp xếp câu','天气 / 今天 / 怎么样','sentence_order','easy',1,'今天天气怎么样？',4);
$E12_5=e($conn,$L12,'Chọn đúng/sai','"秋天" là mùa thu.','true_false','easy',1,'true',5);
eo($conn,$E12_5,'Đúng','A',1,1); eo($conn,$E12_5,'Sai','B',0,2);
$E12_6=e($conn,$L12,'Điền từ','春天不冷___热。','fill_blank','easy',1,'不',6);
// Review L12
foreach ([$v12_1,$v12_2,$v12_3,$v12_4,$v12_5,$v12_6,$v12_9,$v12_10] as $i=>$vid) if ($vid) rv($conn,$L12,$vid,'core',$i+1);
echo " L12 done: $v12 vocab, 2 grammar, 3 dialogues, 1 reading, 1 listening, 6 exercises\n";

echo "\n HSK1 Lessons 9-12 done.\n";
echo "Continue with seed_hsk1_l13_15.php for lessons 13-15.\n";
