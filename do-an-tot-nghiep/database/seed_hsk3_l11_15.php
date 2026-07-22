<?php
/**
 * HÀNNGỮ - HSK3 Content Seeder (Lessons 11-15)
 * HSK Standard Course 3: complex grammar, longer dialogues, intermediate level
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK3 L11: 他忘了带钥匙
// ═══════════════════════════════════════════════════
$L11=createLesson($conn,3,11,'Bài 11: Ta wang le dai yao shi - Anh ay quen mang chia khoa','Quen, bo ngo. Cau truc ba. Dong tu + bo ngu ket qua.','["Quen","Cau truc ba","Bo ngu ket qua"]','Giao tiep','medium','HSK3 Bai 11: Dong tu wangji (quen). Cau truc ba + O + V + bo ngu ket qua (ba men dakai). Cac bo ngu ket qua: dao, jian, wan, dong, qingchu. Phan biet wangji V vs wangji le V.');
$v11=0;
$v11_1=v($conn,$L11,3,'忘记','wàngjì','quên','quên','他忘记了带钥匙。','Ta wàngjì le dài yàoshi.','Anh ay quen mang chia khoa.','verb','wangji + V: quen lam gi.',++$v11);
$v11_2=v($conn,$L11,3,'钥匙','yàoshi','chia khoa','chia khoa','一把钥匙。','Yì bǎ yàoshi.','Mot chiec chia khoa.','noun','Luong tu: ba.',++$v11);
$v11_3=v($conn,$L11,3,'带','dài','mang theo','mang theo','带手机。','Dài shǒujī.','Mang dien thoai.','verb','Mang vat gi ben nguoi.',++$v11);
$v11_4=v($conn,$L11,3,'发现','fāxiàn','phat hien','phat hien','我发现钥匙丢了。','Wǒ fāxiàn yàoshi diū le.','Toi phat hien chia khoa mat roi.','verb','Nhan ra, phat hien.',++$v11);
$v11_5=v($conn,$L11,3,'回来','huílái','quay lai','quay lai','快回来拿。','Kuài huílái ná.','Mau quay lai lay.','verb','Xu huong: lai.',++$v11);
$v11_6=v($conn,$L11,3,'手机','shǒujī','dien thoai di dong','dien thoai','打手机。','Dǎ shǒujī.','Goi dien thoai.','noun','Thiet bi di dong.',++$v11);
$v11_7=v($conn,$L11,3,'钱包','qiánbāo','vi tien','vi','钱包丢了。','Qiánbāo diū le.','Vi tien mat roi.','noun','Vi dung tien.',++$v11);
$v11_8=v($conn,$L11,3,'丢','diū','mat, danh mat','mat','我把钥匙丢了。','Wǒ bǎ yàoshi diū le.','Toi danh mat chia khoa roi.','verb','Mat do vat.',++$v11);
$v11_9=v($conn,$L11,3,'着急','zháojí','lo lang','lo lang','别着急。','Bié zháojí.','Dung lo.','adj','Trang thai lo lang.',++$v11);
$v11_10=v($conn,$L11,3,'门','mén','cua','cua','开门。','Kāi mén.','Mo cua.','noun','Cua ra vao.',++$v11);
// Grammar L11
$g11_1=g($conn,$L11,'Dong tu wangji + V','忘记 + V / 忘记 + le + V','Quen lam gi','wangji co the di kem V chi hanh dong. Them le nhan manh hanh dong da xay ra.','wangji dai yaoshi = quen mang chia khoa. wangji le dai yaoshi = da quen mang chia khoa.','Quen mot hanh dong.',1);
ge($conn,$g11_1,'他忘记了带钥匙。','Ta wàngjì le dài yàoshi.','Anh ay quen mang chia khoa.',1);
ge($conn,$g11_1,'别忘记买票。','Bié wàngjì mǎi piào.','Dung quen mua ve.',2);
$g11_2=g($conn,$L11,'Cau truc ba co ban','把 + O + V + Bo ngu ket qua','Xu ly doi tuong bang hanh dong','Cau truc ba dua tan ngu len truoc dong tu, nhan manh tac dong len doi tuong. Thuong di kem bo ngu ket qua.','Phu dinh: bie / mei + ba. Bat buoc phai co bo ngu sau V.','Cau truc tac dong.',2);
ge($conn,$g11_2,'请把门打开。','Qǐng bǎ mén dǎkāi.','Lam on mo cua ra.',1);
ge($conn,$g11_2,'他把手机忘在家里了。','Ta bǎ shǒujī wàng zài jiā lǐ le.','Anh ay quen dien thoai o nha.',2);
$g11_3=g($conn,$L11,'Bo ngu ket qua','V + 到/见/完/懂/清楚','Hanh dong dat ket qua','Bo ngu ket qua cho biet hanh dong da hoan thanh hay chua. Dang phu dinh: V + bu + bo ngu.','Zhaodao (tim thay), kanjian (nhin thay), tingdong (nghe hieu), zuowan (lam xong).','Ket qua hanh dong.',3);
ge($conn,$g11_3,'我找不到钥匙了。','Wǒ zhǎo bú dào yàoshi le.','Toi tim khong thay chia khoa roi.',1);
ge($conn,$g11_3,'你听清楚了吗？','Nǐ tīng qīngchu le ma?','Ban nghe ro chua?',2);
// Dialogues L11
$d11_1=d($conn,$L11,'Quen chia khoa','Anh ay phat hien quen chia khoa o nha.',1);
ds($conn,$d11_1,'Xiao Ming','你怎么了？','Nǐ zěnme le?','Ban sao the?',1);
ds($conn,$d11_1,'Anna','我忘记带钥匙了。','Wǒ wàngjì dài yàoshi le.','Toi quen mang chia khoa.','2');
ds($conn,$d11_1,'Xiao Ming','把门打开了吗？','Bǎ mén dǎkāi le ma?','Mo cua duoc chua?','3');
ds($conn,$d11_1,'Anna','没有，我回来拿。','Méiyǒu, wǒ huílái ná.','Chua, toi quay ve lay.','4');
$d11_2=d($conn,$L11,'Tim dien thoai','Hoi ve dien thoai de quen.',2);
ds($conn,$d11_2,'Xiao Ming','你的手机呢？','Nǐ de shǒujī ne?','Dien thoai cua ban dau?',1);
ds($conn,$d11_2,'Anna','我忘了带手机。','Wǒ wàng le dài shǒujī.','Toi quen mang dien thoai.','2');
ds($conn,$d11_2,'Xiao Ming','我给你打电话吧。','Wǒ gěi nǐ dǎ diànhuà ba.','Toi goi dien cho ban nhe.','3');
ds($conn,$d11_2,'Anna','不用了，我回去拿。','Bú yòng le, wǒ huíqù ná.','Khong can, toi ve lay.','4');
$d11_3=d($conn,$L11,'Mat vi tien','Lo lang vi mat vi.',3);
ds($conn,$d11_3,'Xiao Ming','你怎么这么着急？','Nǐ zěnme zhème zháojí?','Sao ban lo lang the?',1);
ds($conn,$d11_3,'Anna','我的钱包丢了！','Wǒ de qiánbāo diū le!','Vi tien cua toi mat roi!','2');
ds($conn,$d11_3,'Xiao Ming','别着急，我们一起找。','Bié zháojí, wǒmen yìqǐ zhǎo.','Dung lo, chung ta cung tim.','3');
ds($conn,$d11_3,'Anna','谢谢你帮我。','Xièxie nǐ bāng wǒ.','Cam on ban giup toi.','4');
// Reading L11
r($conn,$L11,'Quen do vat','今天早上我出门的时候，忘记了带钥匙。到了公司才发现。我很着急，因为手机也忘在家里了。我赶紧回家拿钥匙，然后回到公司已经九点半了。同事说以后一定要记得带钥匙。我觉得他说得很对。我应该把钥匙放在包里。','Jīntiān zǎoshang wǒ chūmén de shíhou, wàngjì le dài yàoshi. Dào le gōngsī cái fāxiàn. Wǒ hěn zháojí, yīnwèi shǒujī yě wàng zài jiā lǐ le. Wǒ gǎnjǐn huí jiā ná yàoshi, ránhòu huí dào gōngsī yǐjīng jiǔ diǎn bàn le. Tóngshì shuō yǐhòu yídìng yào jìde dài yàoshi. Wǒ juéde tā shuō de hěn duì. Wǒ yīnggāi bǎ yàoshi fàng zài bāo lǐ.','Sang nay luc toi ra khoi nha, da quen mang chia khoa. Den cong ty moi phat hien. Toi rat lo lang, vi dien thoai cung quen o nha. Toi voi ve nha lay chia khoa, roi quay lai cong ty da 9h30 roi. Dong nghiep noi sau nay nhat dinh phai nho mang chia khoa. Toi thay anh ay noi rat dung. Toi nen de chia khoa trong tui.','medium',130,1);
// Listening L11
$L11l=l($conn,$L11,'Quen chia khoa','A:你怎么来得这么晚？B:我忘记带钥匙了，回家拿。A:把钥匙放在包里就好了。B:你说得对，下次我一定记住。A:快进去吧，要开会了。','A:Nǐ zěnme lái de zhème wǎn? B:Wǒ wàngjì dài yàoshi le, huí jiā ná. A:Bǎ yàoshi fàng zài bāo lǐ jiù hǎo le. B:Nǐ shuō de duì, xià cì wǒ yídìng jìzhù. A:Kuài jìnqù ba, yào kāihuì le.','A:Sao ban den muon the? B:Toi quen mang chia khoa, ve nha lay. A:De chia khoa trong tui la duoc roi. B:Ban noi dung, lan sau nhat dinh toi se nho. A:Mau vao di, sap hop roi.','1');
lq($conn,$L11l,'Tai sao nguoi B den muon?','{"A":"Ngu day muon","B":"Quen chia khoa","C":"Tac duong"}','Quen chia khoa','Vi quen chia khoa phai ve nha lay.','multiple_choice',1);
lq($conn,$L11l,'Nguoi A khuyen B lam gi?','{"A":"De chia khoa trong tui","B":"Mua chia khoa moi","C":"Di som hon"}','De chia khoa trong tui','A khuyen B de chia khoa trong cap de khoi quen.','multiple_choice',2);
// Exercises L11
$E11_1=e($conn,$L11,'Chon dap an','wangji co nghia la gi?','multiple_choice','medium',1,'B',1);
eo($conn,$E11_1,'Nho','A',0,1); eo($conn,$E11_1,'Quen','B',1,2); eo($conn,$E11_1,'Hieu','C',0,3);
$E11_2=e($conn,$L11,'Dich','Anh ay quen mang chia khoa.','translation','medium',1,'他忘记带钥匙了。',2);
$E11_3=e($conn,$L11,'Dien tu','他忘___带钥匙。','fill_blank','medium',1,'记',3);
$E11_4=e($conn,$L11,'Sap xep cau','钥匙 / 忘记 / 了 / 带 / 他','sentence_order','medium',1,'他忘记了带钥匙。',4);
$E11_5=e($conn,$L11,'Chon dung sai','Cau truc ba la: ba + O + V + bo ngu.','true_false','medium',1,'true',5);
eo($conn,$E11_5,'Dung','A',1,1); eo($conn,$E11_5,'Sai','B',0,2);
$E11_6=e($conn,$L11,'Dien tu','请___门打开。(ba)','fill_blank','medium',1,'把',6);
$E11_7=e($conn,$L11,'Chon dap an','Zhaodao co nghia la:','multiple_choice','medium',1,'C',7);
eo($conn,$E11_7,'Tim','A',0,1); eo($conn,$E11_7,'Thay','B',0,2); eo($conn,$E11_7,'Tim thay','C',1,3);
$E11_8=e($conn,$L11,'Dien tu','我听不___。(khong ro)','fill_blank','medium',1,'清楚',8);
// Review L11
foreach ([$v11_1,$v11_2,$v11_3,$v11_4,$v11_5,$v11_6,$v11_7,$v11_8,$v11_9,$v11_10] as $i=>$vid) if ($vid) rv($conn,$L11,$vid,'core',$i+1);
echo " HSK3 L11 done: $v11 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 8 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L12: 他们都认识一年多了
// ═══════════════════════════════════════════════════
$L12=createLesson($conn,3,12,'Bài 12: Ta men dou ren shi yi nian duo le - Ho quen biet nhau hon mot nam roi','Thoi gian ke tu hanh dong. Phan biet hai, yijing. Cau truc V + le + thoi gian + le.','["Thoi gian","Quan he","Trang thai"]','Giao tiep','medium','HSK3 Bai 12: Cau truc V + le + thoi gian + le dien ta hanh dong keo dai den hien tai. Phan biet hai (van con) va yijing (da...roi). Tu vung: renshi (quen biet), jiehun (ket hon), danshen (doc than), tongxue (ban hoc), yiqian (truoc day), zuijin (gan day).');
$v12=0;
$v12_1=v($conn,$L12,3,'认识','rènshi','quen biet','quen','我们认识一年了。','Wǒmen rènshi yì nián le.','Chung toi quen nhau mot nam roi.','verb','Quen biet ai do.',++$v12);
$v12_2=v($conn,$L12,3,'年','nián','nam','nam','两年。','Liǎng nián.','Hai nam.','noun','Don vi thoi gian.',++$v12);
$v12_3=v($conn,$L12,3,'还','hái','van con, con','van','还在学习。','Hái zài xuéxí.','Van dang hoc.','adv','Chi trang thai tiep dien.',++$v12);
$v12_4=v($conn,$L12,3,'已经','yǐjīng','da...roi','da','已经结婚了。','Yǐjīng jiéhūn le.','Da ket hon roi.','adv','Thuong di kem le.',++$v12);
$v12_5=v($conn,$L12,3,'结婚','jiéhūn','ket hon','ket hon','他们结婚了。','Tāmen jiéhūn le.','Ho ket hon roi.','verb','Phan ly dong tu.',++$v12);
$v12_6=v($conn,$L12,3,'单身','dānshēn','doc than','doc than','还是单身。','Hái shì dānshēn.','Van con doc than.','adj','Chua ket hon.',++$v12);
$v12_7=v($conn,$L12,3,'同学','tóngxué','ban hoc','ban hoc','大学同学。','Dàxué tóngxué.','Ban hoc dai hoc.','noun','Cung hoc.',++$v12);
$v12_8=v($conn,$L12,3,'以前','yǐqián','truoc day','truoc','以前不认识。','Yǐqián bú rènshi.','Truoc day khong quen.','time','Chi thoi diem qua.',++$v12);
$v12_9=v($conn,$L12,3,'最近','zuìjìn','gan day','gan day','最近很忙。','Zuìjìn hěn máng.','Gan day rat ban.','time','Thoi gian gan hien tai.',++$v12);
$v12_10=v($conn,$L12,3,'多','duō','hon (so luong)','hon','三年多。','Sān nián duō.','Hon ba nam.','adj','Chi so luong vuot qua.',++$v12);
// Grammar L12
$g12_1=g($conn,$L12,'V + le + Thoi gian + le','V + 了 + Thoi gian + 了','Hanh dong keo dai tu qua khu den nay','Cau truc nay dien ta mot hanh dong da bat dau trong qua khu va con tiep tuc den hien tai.','Ta xue Hanyu xue le yi nian le = Toi hoc tieng Trung duoc 1 nam roi (va van dang hoc).','Hanh dong keo dai.',1);
ge($conn,$g12_1,'他们都认识一年多了。','Tāmen dōu rènshi yì nián duō le.','Ho quen nhau hon mot nam roi.',1);
ge($conn,$g12_1,'我学汉语学了两年了。','Wǒ xué Hànyǔ xué le liǎng nián le.','Toi hoc tieng Trung duoc 2 nam roi.',2);
$g12_2=g($conn,$L12,'Phan biet hai va yijing','还 + V / 已经 + V + 了','Van con / Da...roi','hai chi hanh dong con tiep dien, chua ket thuc. yijing + le chi hanh dong da hoan thanh.','Hai zai gongsi = Van o cong ty. Yijing huijia le = Da ve nha roi.','Trang thai tiep dien / hoan thanh.',2);
ge($conn,$g12_2,'他还在公司工作。','Tā hái zài gōngsī gōngzuò.','Anh ay van con lam o cong ty.',1);
ge($conn,$g12_2,'他已经下班了。','Tā yǐjīng xiàbān le.','Anh ay da tan lam roi.',2);
$g12_3=g($conn,$L12,'Bieu thi su thay doi','... le','Da thay doi roi / Khac truoc roi','Tro tu le o cuoi cau bieu thi su thay doi trang thai hoac tinh huong moi.','Ta bu mang le = Toi khong ban nua. Xia yu le = Troi mua roi.','Thay doi trang thai.',3);
ge($conn,$g12_3,'他以前是单身，现在结婚了。','Tā yǐqián shì dānshēn, xiànzài jiéhūn le.','Anh ay truoc doc than, bay gio ket hon roi.',1);
ge($conn,$g12_3,'我不饿了。','Wǒ bú è le.','Toi khong doi nua.',2);
// Dialogues L12
$d12_1=d($conn,$L12,'Quen biet bao lau','Hoi ve thoi gian quen biet.',1);
ds($conn,$d12_1,'Anna','你认识小王多久了？','Nǐ rènshi Xiǎo Wáng duōjiǔ le?','Ban quen Tieu Vuong bao lau roi?',1);
ds($conn,$d12_1,'Xiao Ming','我们认识一年多了。','Wǒmen rènshi yì nián duō le.','Chung toi quen nhau hon mot nam roi.',2);
ds($conn,$d12_1,'Anna','他现在还是单身吗？','Tā xiànzài hái shì dānshēn ma?','Anh ay bay gio van doc than a?',3);
ds($conn,$d12_1,'Xiao Ming','不是，他已经结婚了。','Bú shì, tā yǐjīng jiéhūn le.','Khong, anh ay da ket hon roi.',4);
$d12_2=d($conn,$L12,'Hoc tieng Trung','Hoi qua trinh hoc tieng Trung.',2);
ds($conn,$d12_2,'Xiao Ming','你学汉语多长时间了？','Nǐ xué Hànyǔ duō cháng shíjiān le?','Ban hoc tieng Trung bao lau roi?',1);
ds($conn,$d12_2,'Anna','学了两年多了。','Xué le liǎng nián duō le.','Hoc duoc hon 2 nam roi.',2);
ds($conn,$d12_2,'Xiao Ming','还在学习吗？','Hái zài xuéxí ma?','Van con hoc a?',3);
ds($conn,$d12_2,'Anna','对，我还在学习。','Duì, wǒ hái zài xuéxí.','Vang, toi van con hoc.','4');
// Reading L12
r($conn,$L12,'Quen biet lau nam','我和小王是大学同学，我们认识五年多了。以前我们都是单身，现在已经结婚了。他还在北京工作，我已经搬到上海了。最近我们很少见面，但是还经常打电话。认识了这么久，他是我最好的朋友。','Wǒ hé Xiǎo Wáng shì dàxué tóngxué, wǒmen rènshi wǔ nián duō le. Yǐqián wǒmen dōu shì dānshēn, xiànzài yǐjīng jiéhūn le. Tā hái zài Běijīng gōngzuò, wǒ yǐjīng bān dào Shànghǎi le. Zuìjìn wǒmen hěn shǎo jiànmiàn, dànshì hái jīngcháng dǎ diànhuà. Rènshi le zhème jiǔ, tā shì wǒ zuì hǎo de péngyou.','Toi va Tieu Vuong la ban hoc dai hoc, chung toi quen nhau hon 5 nam roi. Truoc day chung toi deu doc than, bay gio da ket hon roi. Anh ay van lam o Bac Kinh, toi da chuyen den Thuong Hai. Gan day chung toi it gap nhau, nhung van thuong xuyen goi dien. Quen nhau lau nhu vay, anh ay la ban tot nhat cua toi.','medium',135,1);
// Listening L12
$L12l=l($conn,$L12,'Quen bao lau','A:你和小李认识多久了？B:我们认识三年多了。A:他结婚了吗？B:还没有，还是单身。A:你有女朋友吗？B:我已经结婚了。','A:Nǐ hé Xiǎo Lǐ rènshi duōjiǔ le? B:Wǒmen rènshi sān nián duō le. A:Tā jiéhūn le ma? B:Hái méiyǒu, hái shì dānshēn. A:Nǐ yǒu nǚpéngyou ma? B:Wǒ yǐjīng jiéhūn le.','A:Ban va Tieu Ly quen bao lau? B:Chung toi quen hon 3 nam. A:Anh ay ket hon chua? B:Chua, van doc than. A:Ban co ban gai chua? B:Toi da ket hon roi.','1');
lq($conn,$L12l,'Nguoi B quen Tieu Ly bao lau?','{"A":"1 nam","B":"2 nam","C":"3 nam"}','3 nam','Quen hon 3 nam.','multiple_choice',1);
lq($conn,$L12l,'Nguoi B da ket hon chua?','{"A":"Chua","B":"Roi","C":"Sap cuoi"}','Roi','Nguoi B da ket hon.','multiple_choice',2);
// Exercises L12
$E12_1=e($conn,$L12,'Chon dap an','Cau truc V + le + thoi gian + le bieu thi:','multiple_choice','medium',1,'B',1);
eo($conn,$E12_1,'Hanh dong da xay ra','A',0,1); eo($conn,$E12_1,'Hanh dong keo dai den hien tai','B',1,2); eo($conn,$E12_1,'Hanh dong sap xay ra','C',0,3);
$E12_2=e($conn,$L12,'Dich','Ho quen nhau hon mot nam roi.','translation','medium',1,'他们认识一年多了。',2);
$E12_3=e($conn,$L12,'Dien tu','我学汉语学了两___了。(nam)','fill_blank','medium',1,'年',3);
$E12_4=e($conn,$L12,'Sap xep cau','认识 / 他们 / 多了 / 一年 / 都','sentence_order','medium',1,'他们都认识一年多了。',4);
$E12_5=e($conn,$L12,'Chon dung sai','hai co nghia la da...roi.','true_false','medium',1,'false',5);
eo($conn,$E12_5,'Dung','A',0,1); eo($conn,$E12_5,'Sai','B',1,2);
$E12_6=e($conn,$L12,'Dien tu','他___在公司工作。(van)','fill_blank','medium',1,'还',6);
$E12_7=e($conn,$L12,'Chon dap an','Phan biet hai / yijing: cau nao dung?','multiple_choice','medium',1,'A',7);
eo($conn,$E12_7,'他已经结婚了。','A',1,1); eo($conn,$E12_7,'他还没结婚了。','B',0,2); eo($conn,$E12_7,'他还没结婚了。','C',0,3);
// Review L12
foreach ([$v12_1,$v12_2,$v12_3,$v12_4,$v12_5,$v12_6,$v12_7,$v12_8,$v12_9,$v12_10] as $i=>$vid) if ($vid) rv($conn,$L12,$vid,'core',$i+1);
echo " HSK3 L12 done: $v12 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L13: 我的车被朋友借走了
// ═══════════════════════════════════════════════════
$L13=createLesson($conn,3,13,'Bài 13: Wo de che bei peng you jie zou le - Xe cua toi bi ban muon di roi','Cau bi dong. Bo ngu xu huong V + zou/qu/lai.','["Cau bi dong","Bo ngu xu huong","Muon do"]','Giao tiep','medium','HSK3 Bai 13: Cau truc bi bei (bi dong): O + bei + Nguoi + V. Bo ngu xu huong: V + zou (di mat), V + qu (di), V + lai (den). Tu vung: jie (muon), zixingche (xe dap), kai (lai xe), huan (tra), zang (ban), xi (rua), ganjing (sach), huai (hong).');
$v13=0;
$v13_1=v($conn,$L13,3,'借','jiè','muon, cho muon','muon','借书。','Jiè shū.','Muon sach.','verb','jiè + vat: muon do.',++$v13);
$v13_2=v($conn,$L13,3,'被','bèi','bi (bi dong)','bi','被朋友借走了。','Bèi péngyou jiè zǒu le.','Bi ban muon di roi.','prep','Cau truc bi dong.',++$v13);
$v13_3=v($conn,$L13,3,'自行车','zìxíngchē','xe dap','xe dap','骑自行车。','Qí zìxíngchē.','Di xe dap.','noun','Phuong tien di chuyen.',++$v13);
$v13_4=v($conn,$L13,3,'开','kāi','lai (xe)','lai','开车。','Kāi chē.','Lai xe.','verb','Lai xe hoi, xe may.',++$v13);
$v13_5=v($conn,$L13,3,'还','huán','tra lai','tra','还书。','Huán shū.','Tra sach.','verb','Tra do da muon.',++$v13);
$v13_6=v($conn,$L13,3,'脏','zāng','ban, do','ban','衣服脏了。','Yīfu zāng le.','Quan ao ban roi.','adj','Khong sach.',++$v13);
$v13_7=v($conn,$L13,3,'洗','xǐ','rua, giat','rua','洗衣服。','Xǐ yīfu.','Giat quan ao.','verb','Lam sach.',++$v13);
$v13_8=v($conn,$L13,3,'干净','gānjìng','sach se','sach','洗干净。','Xǐ gānjìng.','Rua sach.','adj','Sach, khong ban.',++$v13);
$v13_9=v($conn,$L13,3,'坏','huài','hong, hong','hong','车坏了。','Chē huài le.','Xe hong roi.','adj','Khong hoat dong.',++$v13);
$v13_10=v($conn,$L13,3,'走','zǒu','di, di mat (xu huong)','di','拿走了。','Ná zǒu le.','Cam di roi.','verb','Bieu thi su di chuyen ra xa.',++$v13);
// Grammar L13
$g13_1=g($conn,$L13,'Cau bi dong voi bei','O (nguoi/vat) + 被 + Nguoi + V (+ bo ngu)','Bi / duoc ai do lam gi','Cau truc bei chi the bi dong, thuong dung khi viec xay ra khong mong muon hoac khong chu y.','Che bei pengyou jie zou le = Xe bi ban muon di roi.','Cau bi dong.',1);
ge($conn,$g13_1,'我的车被朋友借走了。','Wǒ de chē bèi péngyou jiè zǒu le.','Xe cua toi bi ban muon di roi.',1);
ge($conn,$g13_1,'手机被弟弟摔坏了。','Shǒujī bèi dìdi shuāi huài le.','Dien thoai bi em trai lam hong roi.',2);
$g13_2=g($conn,$L13,'Bo ngu xu huong','V + 走/去/来','Di chuyen cua hanh dong','Bo ngu xu huong cho biet huong di chuyen: zou (di mat), qu (di xa trung tam), lai (lai gan trung tam).','Nazou = cam di. Naqu = mang di. Nalai = mang lai.','Huong di chuyen.',2);
ge($conn,$g13_2,'他把我的书拿走了。','Tā bǎ wǒ de shū ná zǒu le.','Anh ay cam sach cua toi di roi.',1);
ge($conn,$g13_2,'你能带一些水果来吗？','Nǐ néng dài yìxiē shuǐguǒ lái ma?','Ban co the mang it hoa qua den khong?',2);
$g13_3=g($conn,$L13,'Bi dong voi gei','被 + Nguoi + 给 + V','Cau truc bi dong nhan manh','Trong cau bi dong, co the them gei truoc V de nhan manh hanh dong. Thuong dung trong khau ngu.','Bei pengyou gei na zou le = Bi ban lay di mat roi.','Nhan manh bi dong.',3);
ge($conn,$g13_3,'我的钱包被小偷偷给偷走了。','Wǒ de qiánbāo bèi xiǎotōu gěi tōu zǒu le.','Vi tien cua toi bi ke trom lay mat roi.',1);
ge($conn,$g13_3,'自行车被朋友给借走了。','Zìxíngchē bèi péngyou gěi jiè zǒu le.','Xe dap bi ban muon di roi.',2);
// Dialogues L13
$d13_1=d($conn,$L13,'Xe bi muon','Xe bi ban muon di roi.',1);
ds($conn,$d13_1,'Anna','你的车呢？','Nǐ de chē ne?','Xe cua ban dau?',1);
ds($conn,$d13_1,'Xiao Ming','被朋友借走了。','Bèi péngyou jiè zǒu le.','Bi ban muon di roi.',2);
ds($conn,$d13_1,'Anna','他什么时候还？','Tā shénme shíhou huán?','Khi nao anh ay tra?',3);
ds($conn,$d13_1,'Xiao Ming','他说后天还给我。','Tā shuō hòutiān huán gěi wǒ.','Anh ay noi ngay kia tra toi.','4');
$d13_2=d($conn,$L13,'Do ban','Xe dap bi ban.',2);
ds($conn,$d13_2,'Anna','你的自行车呢？','Nǐ de zìxíngchē ne?','Xe dap cua ban dau?',1);
ds($conn,$d13_2,'Xiao Ming','被弟弟骑走了。','Bèi dìdi qí zǒu le.','Bi em trai di mat roi.',2);
ds($conn,$d13_2,'Anna','你的车太脏了，该洗了。','Nǐ de chē tài zāng le, gāi xǐ le.','Xe ban ban qua, nen rua roi.',3);
ds($conn,$d13_2,'Xiao Ming','是啊，我打算周末洗干净。','Shì a, wǒ dǎsuàn zhōumò xǐ gānjìng.','Pha, toi dinh cuoi tuan rua sach.','4');
// Reading L13
r($conn,$L13,'Xe bi hong','上个周末我的自行车被朋友借走了。他说两天就还，可是过了三天还没还。我打电话问他，他说自行车被骑坏了，正在修。我有点生气，因为那是我新买的自行车。后来他修好了还给我，但是车还是有点问题。我决定以后不随便借给别人了。','Shàng ge zhōumò wǒ de zìxíngchē bèi péngyou jiè zǒu le. Tā shuō liǎng tiān jiù huán, kěshì guò le sān tiān hái méi huán. Wǒ dǎ diànhuà wèn tā, tā shuō zìxíngchē bèi qí huài le, zhèngzài xiū. Wǒ yǒudiǎn shēngqì, yīnwèi nà shì wǒ xīn mǎi de zìxíngchē. Hòulái tā xiū hǎo le huán gěi wǒ, dànshì chē háishì yǒudiǎn wèntí. Wǒ juédìng yǐhòu bù suíbiàn jiè gěi biérén le.','Cuoi tuan truoc xe dap cua toi bi ban muon di. Anh ay noi 2 ngay tra, nhung qua 3 ngay van chua tra. Toi goi dien hoi, anh ay noi xe dap bi di hong, dang sua. Toi hoi tuc, vi do la xe dap toi moi mua. Sau do anh ay sua xong tra toi, nhung xe van con chut van de. Toi quyet dinh sau nay khong tuy tien cho nguoi khac muon nua.','medium',140,1);
// Listening L13
$L13l=l($conn,$L13,'Xe bi muon','A:你的车呢？B:被朋友开走了。A:他不是有自己的车吗？B:他的车坏了，所以借我的。A:什么时候还？B:说明天还。A:希望别又坏了。','A:Nǐ de chē ne? B:Bèi péngyou kāi zǒu le. A:Tā bú shì yǒu zìjǐ de chē ma? B:Tā de chē huài le, suǒyǐ jiè wǒ de. A:Shénme shíhou huán? B:Shuō míngtiān huán. A:Xīwàng bié yòu huài le.','A:Xe ban dau? B:Bi ban lai di roi. A:Anh ay khong co xe rieng a? B:Xe anh ay hong roi, nen muon cua toi. A:Khi nao tra? B:Noi ngay mai tra. A:Hy vong dung lai hong.','1');
lq($conn,$L13l,'Tai sao ban muon xe?','{"A":"Xe hong","B":"Het xang","C":"Mat xe"}','Xe hong','Vi xe cua anh ay hong.','multiple_choice',1);
lq($conn,$L13l,'Xe se duoc tra khi nao?','{"A":"Hom nay","B":"Ngay mai","C":"Ngay kia"}','Ngay mai','Noi la ngay mai tra.','multiple_choice',2);
// Exercises L13
$E13_1=e($conn,$L13,'Chon dap an','Cau truc bei dung de:','multiple_choice','medium',1,'B',1);
eo($conn,$E13_1,'Chu dong','A',0,1); eo($conn,$E13_1,'Bi dong','B',1,2); eo($conn,$E13_1,'Sai khien','C',0,3);
$E13_2=e($conn,$L13,'Dich','Xe cua toi bi ban muon di roi.','translation','medium',1,'我的车被朋友借走了。',2);
$E13_3=e($conn,$L13,'Dien tu','自行车被朋友___走了。(muon)','fill_blank','medium',1,'借',3);
$E13_4=e($conn,$L13,'Sap xep cau','被 / 借 / 朋友 / 走了 / 我的车','sentence_order','medium',1,'我的车被朋友借走了。',4);
$E13_5=e($conn,$L13,'Chon dung sai','Bo ngu zou chi huong di xa nguoi noi.','true_false','medium',1,'true',5);
eo($conn,$E13_5,'Dung','A',1,1); eo($conn,$E13_5,'Sai','B',0,2);
$E13_6=e($conn,$L13,'Dien tu','请把窗户___。(mo ra)','fill_blank','medium',1,'打开',6);
$E13_7=e($conn,$L13,'Chon dap an','Na zou co nghia la:','multiple_choice','medium',1,'C',7);
eo($conn,$E13_7,'Cam lai','A',0,1); eo($conn,$E13_7,'Cam den','B',0,2); eo($conn,$E13_7,'Cam di','C',1,3);
// Review L13
foreach ([$v13_1,$v13_2,$v13_3,$v13_4,$v13_5,$v13_6,$v13_7,$v13_8,$v13_9,$v13_10] as $i=>$vid) if ($vid) rv($conn,$L13,$vid,'core',$i+1);
echo " HSK3 L13 done: $v13 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L14: 你把水果拿过来
// ═══════════════════════════════════════════════════
$L14=createLesson($conn,3,14,'Bài 14: Ni ba shui guo na guo lai - Ban mang hoa qua lai day','Cau truc ba hoan chinh voi bo ngu xu huong va ket qua.','["Cau truc ba","Bo ngu xu huong","Di chuyen do vat"]','Giao tiep','medium','HSK3 Bai 14: Cau truc ba hoan chinh: ba + O + V + bo ngu. Bo ngu xu huong: lai (lai gan), qu (di xa). Bo ngu ket qua: zai (o), dao (den), gei (cho). Tu vung: shuiguo (hoa qua), na (cam), guolai (qua day), guoqu (qua do), ban (chuyen), zhuozi (ban), yizi (ghe), gua (treo), qiang (tuong), hua (tranh).');
$v14=0;
$v14_1=v($conn,$L14,3,'水果','shuǐguǒ','hoa qua','hoa qua','吃水果。','Chī shuǐguǒ.','An hoa qua.','noun','Cac loai trai cay.',++$v14);
$v14_2=v($conn,$L14,3,'拿','ná','cam, lay','cam','拿过来。','Ná guòlái.','Cam qua day.','verb','Dong tu cam nam.',++$v14);
$v14_3=v($conn,$L14,3,'过来','guòlái','qua day','qua day','走过来。','Zǒu guòlái.','Di qua day.','verb','Xu huong lai gan.',++$v14);
$v14_4=v($conn,$L14,3,'过去','guòqù','qua do','qua do','拿过去。','Ná guòqù.','Cam qua do.','verb','Xu huong di xa.',++$v14);
$v14_5=v($conn,$L14,3,'搬','bān','chuyen, doi','chuyen','搬桌子。','Bān zhuōzi.','Chuyen ban.','verb','Di chuyen do vat nang.',++$v14);
$v14_6=v($conn,$L14,3,'桌子','zhuōzi','cai ban','ban','放桌子上。','Fàng zhuōzi shang.','De tren ban.','noun','Do vat trong phong.',++$v14);
$v14_7=v($conn,$L14,3,'挂','guà','treo','treo','挂在墙上。','Guà zài qiáng shang.','Treo tren tuong.','verb','Treo vat gi do.',++$v14);
$v14_8=v($conn,$L14,3,'墙','qiáng','buc tuong','tuong','白墙。','Bái qiáng.','Tuong trang.','noun','Phan cua can phong.',++$v14);
$v14_9=v($conn,$L14,3,'画','huà','buc tranh, ve','tranh','一幅画。','Yì fú huà.','Mot buc tranh.','noun','Tac pham nghe thuat.',++$v14);
$v14_10=v($conn,$L14,3,'放','fàng','de, dat','de','放好。','Fàng hǎo.','De ngon.','verb','Dat do vat vao cho.',++$v14);
// Grammar L14
$g14_1=g($conn,$L14,'ba + O + V + lai/qu','把 + O + V + 过来/过去','Dua vat lai gan / di xa','Dung ba de nhan manh viec di chuyen do vat. guolai = qua phia nguoi noi. guoqu = qua phia xa nguoi noi.','Ba shuiguo na guolai = Mang hoa qua lai day.','Di chuyen do vat.',1);
ge($conn,$g14_1,'你把水果拿过来。','Nǐ bǎ shuǐguǒ ná guòlái.','Ban mang hoa qua lai day.',1);
ge($conn,$g14_1,'请把椅子搬过去。','Qǐng bǎ yǐzi bān guòqù.','Lam on chuyen cai ghe qua do.',2);
$g14_2=g($conn,$L14,'ba + O + V + zai/dao','把 + O + V + 在/到 + Noi chon','Dat vat vao mot noi','Su dung ba de chi ro rang viec dat vat vao mot vi tri cu the.','Ba shu fang zai zhuozi shang = De sach len ban.','Dat do vao cho.',2);
ge($conn,$g14_2,'把画挂在墙上。','Bǎ huà guà zài qiáng shang.','Treo buc tranh len tuong.',1);
ge($conn,$g14_2,'他把书放到书架上了。','Tā bǎ shū fàng dào shūjià shang le.','Anh ay de sach len gia sach roi.',2);
$g14_3=g($conn,$L14,'ba + O + V + gei + Nguoi','把 + O + V + 给 + Nguoi','Dua vat cho ai','Cau truc nay nhan manh viec chuyen giao vat cho nguoi khac.','Ba qianbao di gei ta = Dua vi tien cho anh ay.','Chuyen giao cho ai.',3);
ge($conn,$g14_3,'请把这本书给他。','Qǐng bǎ zhè běn shū gěi tā.','Lam on dua cuon sach nay cho anh ay.',1);
ge($conn,$g14_3,'我把钱包递给服务员了。','Wǒ bǎ qiánbāo dì gěi fúwùyuán le.','Toi dua vi tien cho nhan vien phuc vu roi.',2);
// Dialogues L14
$d14_1=d($conn,$L14,'Mang hoa qua','Nho mang hoa qua lai.',1);
ds($conn,$d14_1,'Xiao Ming','桌子上的水果是给谁的？','Zhuōzi shang de shuǐguǒ shì gěi shuí de?','Hoa qua tren ban la cho ai?',1);
ds($conn,$d14_1,'Anna','是给客人的。你把水果拿过来吧。','Shì gěi kèrén de. Nǐ bǎ shuǐguǒ ná guòlái ba.','La cho khach. Ban mang hoa qua lai day di.',2);
ds($conn,$d14_1,'Xiao Ming','好，我马上拿过去。','Hǎo, wǒ mǎshàng ná guòqù.','Tot, toi mang qua do ngay.','3');
$d14_2=d($conn,$L14,'Trang tri phong','Sap xep do dac.',2);
ds($conn,$d14_2,'Anna','这幅画放在哪儿？','Zhè fú huà fàng zài nǎr?','Buc tranh nay de o dau?',1);
ds($conn,$d14_2,'Xiao Ming','把它挂在墙上吧。','Bǎ tā guà zài qiáng shang ba.','Treo no len tuong di.',2);
ds($conn,$d14_2,'Anna','挂在这边墙上可以吗？','Guà zài zhè biān qiáng shang kěyǐ ma?','Treo o ben tuong nay duoc khong?',3);
ds($conn,$d14_2,'Xiao Ming','可以，挂高一点儿。','Kěyǐ, guà gāo yìdiǎnr.','Duoc, treo cao len mot chut.','4');
$d14_3=d($conn,$L14,'Chuyen ban ghe','Chuyen do dac trong phong.',3);
ds($conn,$d14_3,'Anna','这张桌子太重了，我搬不动。','Zhè zhāng zhuōzi tài zhòng le, wǒ bān bú dòng.','Cai ban nay nang qua, toi chuyen khong noi.','1');
ds($conn,$d14_3,'Xiao Ming','我来帮你。我们一起把它搬过去。','Wǒ lái bāng nǐ. Wǒmen yìqǐ bǎ tā bān guòqù.','De toi giup ban. Chung ta cung chuyen no qua do.','2');
ds($conn,$d14_3,'Anna','好，放到窗户旁边吧。','Hǎo, fàng dào chuānghu pángbiān ba.','Duoc, de no ben canh cua so di.','3');
// Reading L14
r($conn,$L14,'Sap xep phong khach','今天我和朋友一起整理房间。我们把桌子搬到窗户旁边，把画挂在墙上。朋友说墙上应该挂一幅风景画。我把水果放在桌子上，又把椅子搬过来。朋友把书放到书架上。整理完以后，房间看起来漂亮多了。我很喜欢这个新样子。','Jīntiān wǒ hé péngyou yìqǐ zhěnglǐ fángjiān. Wǒmen bǎ zhuōzi bān dào chuānghu pángbiān, bǎ huà guà zài qiáng shang. Péngyou shuō qiáng shang yīnggāi guà yì fú fēngjǐng huà. Wǒ bǎ shuǐguǒ fàng zài zhuōzi shang, yòu bǎ yǐzi bān guòlái. Péngyou bǎ shū fàng dào shūjià shang. Zhěnglǐ wán yǐhòu, fángjiān kàn qǐlái piàoliang duō le. Wǒ hěn xǐhuan zhè ge xīn yàngzi.','Hom nay toi va ban cung nhau don dep phong. Chung toi chuyen ban den ben canh cua so, treo tranh len tuong. Ban noi tren tuong nen treo mot buc tranh phong canh. Toi de hoa qua tren ban, roi chuyen ghe lai. Ban de sach len gia sach. Don dep xong, can phong trong dep hon nhieu. Toi rat thich bo dang moi nay.','medium',145,1);
// Listening L14
$L14l=l($conn,$L14,'Don dep','A:帮我把桌子搬一下。B:搬到哪儿？A:搬到窗户那边。B:椅子也搬过去吗？A:对，把椅子放在桌子旁边。B:好，我马上搬。','A:Bāng wǒ bǎ zhuōzi bān yíxià. B:Bān dào nǎr? A:Bān dào chuānghu nà biān. B:Yǐzi yě bān guòqù ma? A:Duì, bǎ yǐzi fàng zài zhuōzi pángbiān. B:Hǎo, wǒ mǎshàng bān.','A:Giup toi chuyen ban mot chut. B:Chuyen den dau? A:Chuyen den ben cua so. B:Ghe cung chuyen qua a? A:Dung, de ghe canh ban. B:Tot, toi chuyen ngay.','1');
lq($conn,$L14l,'Cai ban duoc chuyen den dau?','{"A":"Gan cua ra vao","B":"Ben canh cua so","C":"Giua phong"}','Ben canh cua so','Chuyen den ben cua so.','multiple_choice',1);
lq($conn,$L14l,'Ghe duoc de o dau?','{"A":"Canh ban","B":"Canh tuong","C":"Ngoai cua"}','Canh ban','De ghe canh ban.','multiple_choice',2);
// Exercises L14
$E14_1=e($conn,$L14,'Chon dap an','Cau nao dung cau truc ba?','multiple_choice','medium',1,'B',1);
eo($conn,$E14_1,'我拿水果来。','A',0,1); eo($conn,$E14_1,'你把水果拿过来。','B',1,2); eo($conn,$E14_1,'水果你拿过来。','C',0,3);
$E14_2=e($conn,$L14,'Dich','Ban mang hoa qua lai day.','translation','medium',1,'你把水果拿过来。',2);
$E14_3=e($conn,$L14,'Dien tu','请把画___在墙上。(treo)','fill_blank','medium',1,'挂',3);
$E14_4=e($conn,$L14,'Sap xep cau','把 / 桌子 / 搬 / 过来 / 请','sentence_order','medium',1,'请把桌子搬过来。',4);
$E14_5=e($conn,$L14,'Chon dung sai','guolai la qua phia xa nguoi noi.','true_false','medium',1,'false',5);
eo($conn,$E14_5,'Dung','A',0,1); eo($conn,$E14_5,'Sai','B',1,2);
$E14_6=e($conn,$L14,'Dien tu','把书___到书架上。(de)','fill_blank','medium',1,'放',6);
$E14_7=e($conn,$L14,'Chon dap an','Bo ngu trong cau truc ba khong the thieu?','multiple_choice','medium',1,'C',7);
eo($conn,$E14_7,'Co the bo','A',0,1); eo($conn,$E14_7,'Co the thay bang le','B',0,2); eo($conn,$E14_7,'Bat buoc phai co','C',1,3);
// Review L14
foreach ([$v14_1,$v14_2,$v14_3,$v14_4,$v14_5,$v14_6,$v14_7,$v14_8,$v14_9,$v14_10] as $i=>$vid) if ($vid) rv($conn,$L14,$vid,'core',$i+1);
echo " HSK3 L14 done: $v14 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L15: 我才吃了饭，不饿
// ═══════════════════════════════════════════════════
$L15=createLesson($conn,3,15,'Bài 15: Wo cai chi le fan, bu e - Toi vua an com xong, khong doi','Phan biet cai vs gang. Phan biet bu vs mei. Dong tu + guo (kinh nghiem).','["Phan biet tu","Kinh nghiem","Trang thai"]','Giao tiep','medium','HSK3 Bai 15: Phan biet cai (vua moi - thoi gian tre) va gang (vua moi - thoi gian gan). Bu (khong - phu dinh hien tai/tuong lai) vs mei (chua - phu dinh qua khu). V + guo: da tung lam gi. Tu vung: cai (moi), gang (vua), e (doi), bao (no), guo (da tung), chang (nem), wan (bat), kuaizi (dua), cai (mon an), weidao (huong vi).');
$v15=0;
$v15_1=v($conn,$L15,3,'才','cái','vua moi (muon)','vua moi','我才起床。','Wǒ cái qǐchuáng.','Toi vua moi day.','adv','Hanh dong xay ra muon hon du kien.',++$v15);
$v15_2=v($conn,$L15,3,'刚','gāng','vua (gan day)','vua','刚吃了饭。','Gāng chī le fàn.','Vua an com xong.','adv','Hanh dong xay ra gan day.',++$v15);
$v15_3=v($conn,$L15,3,'饿','è','doi','doi','我饿了。','Wǒ è le.','Toi doi roi.','adj','Cam giac muon an.',++$v15);
$v15_4=v($conn,$L15,3,'饱','bǎo','no','no','吃饱了。','Chī bǎo le.','An no roi.','adj','Khong con muon an.',++$v15);
$v15_5=v($conn,$L15,3,'过','guo','da tung (kinh nghiem)','da tung','去过北京。','Qù guo Běijīng.','Da tung di Bac Kinh.','part','Bieu thi kinh nghiem.',++$v15);
$v15_6=v($conn,$L15,3,'尝','cháng','nem, thu','nem','尝尝这个。','Chángchang zhè ge.','Nem cai nay thu.','verb','Thu an thu.',++$v15);
$v15_7=v($conn,$L15,3,'碗','wǎn','cai bat','bat','一碗饭。','Yì wǎn fàn.','Mot bat com.','noun','Dung cu an com.',++$v15);
$v15_8=v($conn,$L15,3,'筷子','kuàizi','doi dua','dua','一双筷子。','Yì shuāng kuàizi.','Mot doi dua.','noun','Dung cu an.',++$v15);
$v15_9=v($conn,$L15,3,'菜','cài','mon an, rau','mon an','做菜。','Zuò cài.','Nau an.','noun','Thuc an, mon an.',++$v15);
$v15_10=v($conn,$L15,3,'味道','wèidao','huong vi, mui vi','huong vi','味道很好。','Wèidao hěn hǎo.','Mui vi rat ngon.','noun','Vi cua thuc an.',++$v15);
// Grammar L15
$g15_1=g($conn,$L15,'Phan biet cai va gang','才 + V / 刚 + V','Vua moi (tre/muon) vs vua (gan day)','cai nhan manh hanh dong xay ra muon hoac cham hon du kien. gang nhan manh hanh dong xay ra khong lau, tu nhien.','Ta cai qi lai = Toi 8h moi day (muon). Ta gang qi lai = Toi vua moi day (gan day).','Phan biet thoi gian.',1);
ge($conn,$g15_1,'我才吃了饭，不饿。','Wǒ cái chī le fàn, bú è.','Toi vua an com xong, khong doi.',1);
ge($conn,$g15_1,'他刚走，你打电话给他吧。','Tā gāng zǒu, nǐ dǎ diànhuà gěi tā ba.','Anh ay vua di, ban goi dien cho anh ay di.',2);
$g15_2=g($conn,$L15,'Phan biet bu va mei','不 + V (HT/TL) / 没 + V (QK)','Khong / Chua','bu phu dinh hien tai hoac tuong lai. mei phu dinh qua khu (chua xay ra).','Bu e = Khong doi. Mei chi fan = Chua an com.','Phu dinh theo thoi gian.',2);
ge($conn,$g15_2,'我不饿，不想吃。','Wǒ bú è, bù xiǎng chī.','Toi khong doi, khong muon an.',1);
ge($conn,$g15_2,'我还没吃饭呢。','Wǒ hái méi chīfàn ne.','Toi van chua an com.',2);
$g15_3=g($conn,$L15,'V + guo - kinh nghiem','V + 过','Da tung lam gi (co kinh nghiem)','guo di sau dong tu de chi mot hanh dong da xay ra it nhat mot lan trong qua khu. Khong xac dinh thoi gian cu the.','Qu guo Zhongguo = Da tung di Trung Quoc. Mei chi guo = Chua tung an.','Kinh nghiem qua khu.',3);
ge($conn,$g15_3,'你去过北京吗？','Nǐ qù guo Běijīng ma?','Ban da tung di Bac Kinh chua?',1);
ge($conn,$g15_3,'我吃过中国菜，很好吃。','Wǒ chī guo Zhōngguó cài, hěn hǎochī.','Toi da tung an mon Trung Hoa, rat ngon.',2);
// Dialogues L15
$d15_1=d($conn,$L15,'An com','Hoi ve an com.',1);
ds($conn,$d15_1,'Xiao Ming','你饿了吗？我们一起去吃饭吧。','Nǐ è le ma? Wǒmen yìqǐ qù chīfàn ba.','Ban doi chua? Chung ta cung di an com di.',1);
ds($conn,$d15_1,'Anna','我才吃了饭，不饿。你去吧。','Wǒ cái chī le fàn, bú è. Nǐ qù ba.','Toi vua an com xong, khong doi. Ban di di.','2');
ds($conn,$d15_1,'Xiao Ming','你什么时候吃的？','Nǐ shénme shíhou chī de?','Ban an luc nao?','3');
ds($conn,$d15_1,'Anna','刚吃了一会儿。','Gāng chī le yíhuìr.','Vua an duoc mot luc.',4);
$d15_2=d($conn,$L15,'Kinh nghiem am thuc','Hoi ve mon an da tung thu.',2);
ds($conn,$d15_2,'Anna','你吃过中国菜吗？','Nǐ chī guo Zhōngguó cài ma?','Ban da tung an mon Trung Hoa chua?',1);
ds($conn,$d15_2,'Xiao Ming','吃过，味道很好。','Chī guo, wèidao hěn hǎo.','Da tung, mui vi rat ngon.',2);
ds($conn,$d15_2,'Anna','你尝过这个菜吗？','Nǐ cháng guo zhè ge cài ma?','Ban nem mon nay chua?',3);
ds($conn,$d15_2,'Xiao Ming','还没有，我尝尝。','Hái méiyǒu, wǒ chángchang.','Chua, toi nem thu.',4);
$d15_3=d($conn,$L15,'Chua an sang','Sang muon chua kip an.',3);
ds($conn,$d15_3,'Anna','你吃早饭了吗？','Nǐ chī zǎofàn le ma?','Ban an sang chua?',1);
ds($conn,$d15_3,'Xiao Ming','还没吃呢。我刚刚起床。','Hái méi chī ne. Wǒ gānggāng qǐchuáng.','Chua an. Toi vua moi thuc day.','2');
ds($conn,$d15_3,'Anna','都九点了，你才起床？','Dōu jiǔ diǎn le, nǐ cái qǐchuáng?','Da 9h roi, ban moi day a?',3);
ds($conn,$d15_3,'Xiao Ming','昨天睡得太晚了。','Zuótiān shuì de tài wǎn le.','Hom qua ngu muon qua.','4');
// Reading L15
r($conn,$L15,'Buoi an gia dinh','今天晚上我做了三个菜。爸爸刚下班回来，他说很饿。妈妈还没回家，她要加班。我说我们先吃吧。爸爸吃了两碗饭，说味道很好。我问他吃过中国菜没有，他说去过中国，吃过很多中国菜。我还没去过中国，但是我很想去。以后我一定要去中国旅游。','Jīntiān wǎnshang wǒ zuò le sān ge cài. Bàba gāng xiàbān huílái, tā shuō hěn è. Māma hái méi huí jiā, tā yào jiābān. Wǒ shuō wǒmen xiān chī ba. Bàba chī le liǎng wǎn fàn, shuō wèidao hěn hǎo. Wǒ wèn tā chī guo Zhōngguó cài méiyǒu, tā shuō qù guo Zhōngguó, chī guo hěn duō Zhōngguó cài. Wǒ hái méi qù guo Zhōngguó, dànshì wǒ hěn xiǎng qù. Yǐhòu wǒ yídìng yào qù Zhōngguó lǚyóu.','Toi nay toi nau ba mon an. Bo vua tan lam ve, noi rat doi. Me chua ve nha, me phai tang ca. Toi noi chung ta an truoc di. Bo an hai bat com, noi mui vi rat ngon. Toi hoi bo tung an mon Trung Hoa chua, bo noi da tung di Trung Quoc, an nhieu mon Trung Hoa. Toi chua tung di Trung Quoc, nhung toi rat muon di. Sau nay nhat dinh toi se di Trung Quoc du lich.','medium',150,1);
// Listening L15
$L15l=l($conn,$L15,'An com','A:你吃饭了吗？B:刚吃了。A:吃饱了吗？B:吃饱了。你吃过了没有？A:我还没吃呢。B:那你去吃吧。这家的菜味道不错。','A:Nǐ chīfàn le ma? B:Gāng chī le. A:Chī bǎo le ma? B:Chī bǎo le. Nǐ chī guo le méiyǒu? A:Wǒ hái méi chī ne. B:Nà nǐ qù chī ba. Zhè jiā de cài wèidao búcuò.','A:Ban an com chua? B:Vua an xong. A:An no chua? B:No roi. Ban an chua? A:Toi chua an. B:Vay ban di an di. Nha nay mon an mui vi khong te.','1');
lq($conn,$L15l,'Nguoi B da an com chua?','{"A":"Chua","B":"Vua an xong","C":"Dang an"}','Vua an xong','Nguoi B noi gang chi le, vua an xong.','multiple_choice',1);
lq($conn,$L15l,'Nguoi A da an chua?','{"A":"Roi","B":"Chua","C":"An roi"}','Chua','Nguoi A noi hai mei chi ne.','multiple_choice',2);
// Exercises L15
$E15_1=e($conn,$L15,'Chon dap an','Phan biet cai va gang: cai nao dung?','multiple_choice','medium',1,'A',1);
eo($conn,$E15_1,'他刚走。(vua di)','A',1,1); eo($conn,$E15_1,'他刚走了。(sai)','B',0,2); eo($conn,$E15_1,'他才刚走了。(sai)','C',0,3);
$E15_2=e($conn,$L15,'Dich','Toi vua an com xong, khong doi.','translation','medium',1,'我才吃了饭，不饿。',2);
$E15_3=e($conn,$L15,'Dien tu','我___吃了饭。(vua - moi)','fill_blank','medium',1,'才',3);
$E15_4=e($conn,$L15,'Sap xep cau','不饿 / 饭 / 才 / 我 / 了 / 吃','sentence_order','medium',1,'我才吃了饭，不饿。',4);
$E15_5=e($conn,$L15,'Chon dung sai','guo dung de bieu thi hanh dong dang xay ra.','true_false','medium',1,'false',5);
eo($conn,$E15_5,'Dung','A',0,1); eo($conn,$E15_5,'Sai','B',1,2);
$E15_6=e($conn,$L15,'Dien tu','你去___北京吗？(da tung)','fill_blank','medium',1,'过',6);
$E15_7=e($conn,$L15,'Chon dap an','Phu dinh cua qua khu dung:','multiple_choice','medium',1,'B',7);
eo($conn,$E15_7,'不吃饭','A',0,1); eo($conn,$E15_7,'没吃饭','B',1,2); eo($conn,$E15_7,'不吃过饭','C',0,3);
// Review L15
foreach ([$v15_1,$v15_2,$v15_3,$v15_4,$v15_5,$v15_6,$v15_7,$v15_8,$v15_9,$v15_10] as $i=>$vid) if ($vid) rv($conn,$L15,$vid,'core',$i+1);
echo " HSK3 L15 done: $v15 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";
