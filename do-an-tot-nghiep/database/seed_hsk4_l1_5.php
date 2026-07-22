<?php
/**
 * HANNGU - HSK4 Content Seeder (Lessons 1-5)
 * HSK Standard Course 4 : 600+ words, complex grammar, 3 dialogues/lesson
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK4 L1: jian dan de ai qing - Tinh yeu gian di
// ═══════════════════════════════════════════════════
$L1=createLesson($conn,4,1,'Bai 1: Jian dan de ai qing - Tinh yeu gian di','Tinh yeu, hon nhan va cac moi quan he. Phó tu "cónglái" + phu dinh. Cau truc "duì...lái shuō".','["Tinh yeu","Hon nhan","Quan he"]','Tinh yeu','medium','HSK4 Bai 1: Tu vung ve tinh yeu va hon nhan. Phó tu 从来 (chua bao gio) chi dung voi cau phu dinh. Cau truc 对...来说 (doi voi...ma noi). 越来越 (ngay cang). Cac trang thai quan he: ganqing, guanxi.');
$v1=0;
$v1_1=v($conn,$L1,4,'爱情','aiqing','tinh yeu','tinh yeu','他们的爱情很美好。','Tamen de aiqing hen meihao.','Tinh yeu cua ho rat dep.','noun','Tinh cam nam nu.',++$v1);
$v1_2=v($conn,$L1,4,'简单','jiandan','don gian','don gian','生活很简单。','Shenghuo hen jiandan.','Cuoc song rat don gian.','adj','Trai nghia: fuza.',++$v1);
$v1_3=v($conn,$L1,4,'幸福','xingfu','hanh phuc','hanh phuc','一家人很幸福。','Yi jia ren hen xingfu.','Ca nha rat hanh phuc.','adj/noun','Trang thai tot dep.',++$v1);
$v1_4=v($conn,$L1,4,'从来','conglai','tu truoc den nay','chua tung','从来不喜欢。','Conglai bu xihuan.','Tu truoc den nay khong thich.','adv','Chi dung trong cau phu dinh.',++$v1);
$v1_5=v($conn,$L1,4,'结婚','jiehun','ket hon','cuoi','他们去年结婚了。','Tamen qunian jiehun le.','Ho nam ngoai ket hon.','verb','Phan ly dong tu.',++$v1);
$v1_6=v($conn,$L1,4,'感情','ganqing','tinh cam','tinh cam','感情很好。','Ganqing hen hao.','Tinh cam rat tot.','noun','Cam xuc giua nguoi.',++$v1);
$v1_7=v($conn,$L1,4,'浪漫','langman','lang man','lang man','很浪漫的约会。','Hen langman de yuehui.','Buoi hen rat lang man.','adj','Tu vay muon.',++$v1);
$v1_8=v($conn,$L1,4,'永远','yongyuan','mai mai','mai mai','永远爱你。','Yongyuan ai ni.','Mai mai yeu em.','adv','Thoi gian vo tan.',++$v1);
$v1_9=v($conn,$L1,4,'温柔','wenrou','diu dang','diu dang','她很温柔。','Ta hen wenrou.','Co ay rat diu dang.','adj','Tinh cach hien diu.',++$v1);
$v1_10=v($conn,$L1,4,'相信','xiangxin','tin tuong','tin','我相信你。','Wo xiangxin ni.','Toi tin ban.','verb','Tin vao ai do.',++$v1);
$v1_11=v($conn,$L1,4,'感动','gandong','cam dong','cam dong','很感动的故事。','Hen gandong de gushi.','Cau chuyen rat cam dong.','verb/adj','Xuc dong sau sac.',++$v1);
$v1_12=v($conn,$L1,4,'责任','zeren','trach nhiem','trac nhiem','爱情需要责任。','Aiqing xuyao zeren.','Tinh yeu can co trach nhiem.','noun','Nghia vu phai lam.',++$v1);
// Grammar L1
$g1_1=g($conn,$L1,'Phó tu 从来 + phu dinh','从来 + dou/ye + bu/mei + Dong tu','Tu truoc den nay chua tung/chang bao gio','从来 chi dung trong cau phu dinh, nhan manh tu truoc den nay chua tung xay ra. dou va ye co the them vao de nhan manh.','从来不喜欢 = chua bao gio thich. 从来没去过 = chua tung di qua.','Phu dinh hoan toan trong qua khu.',1);
ge($conn,$g1_1,'我从来不相信一见钟情。','Wo conglai bu xiangxin yi jian zhongqing.','Toi chua bao gio tin vao tinh yeu set danh.',1);
ge($conn,$g1_2,'他从来没说过爱我。','Ta conglai mei shuo guo ai wo.','Anh ay chua tung noi yeu toi.',2);
$g1_2=g($conn,$L1,'Cau truc 对...来说','对 + Nguoi + 来说 + (Subject) + Adj/V','Doi voi ai do ma noi','对...来说 dua ra quan diem hoac danh gia tu goc nhin cua mot nguoi nao do. Thuong dat o dau cau.','对我来说，幸福很简单 = Voi toi HP rat don gian.','Danh gia tu goc nhin.',2);
ge($conn,$g1_2,'对我来说，幸福很简单。','Dui wo laishuo, xingfu hen jiandan.','Doi voi toi, hanh phuc rat don gian.',1);
ge($conn,$g1_2,'对年轻人来说，爱情很重要。','Dui nianqing ren laishuo, aiqing hen zhongyao.','Doi voi nguoi tre, tinh yeu rat quan trong.',2);
$g1_3=g($conn,$L1,'越来越','越来越 + Tinh tu / Dong tu tam ly','Ngay cang...','越来越 dien ta su thay doi tang dan theo thoi gian. Tinh tu hoac dong tu tam ly dung sau.','越来越幸福 = ngay cang HP. 越来越喜欢 = cang ngay cang thich.','Muc do tang dan.',3);
ge($conn,$g1_3,'他们的感情越来越好。','Tamen de ganqing yue lai yue hao.','Tinh cam cua ho ngay cang tot.',1);
ge($conn,$g1_3,'她越来越漂亮了。','Ta yue lai yue piaoliang le.','Co ay ngay cang xinh dep.',2);
$g1_4=g($conn,$L1,'Cau truc 不是...而是...','不是 + A + 而是 + B','Khong phai A ma la B','Dung de phu dinh dieu vua neu va khang dinh dieu khac. Nhan manh su tuong phan, thuong dung de lam ro ban chat su viec.','不是简单而是幸福 = Khong phai la don gian ma la HP.','Phu dinh roi khang dinh.',4);
ge($conn,$g1_4,'爱情不是浪漫而是责任。','Aiqing bu shi langman er shi zeren.','Tinh yeu khong phai lang man ma la trach nhiem.',1);
ge($conn,$g1_4,'幸福不是得到多而是计较少。','Xingfu bu shi dedao duo er shi jijiao shao.','Hanh phuc khong phai nhan duoc nhieu ma la bot tinh toan.',2);
// Dialogues L1
$d1_1=d($conn,$L1,'Quan niem ve tinh yeu','Ban ve quan niem tinh yeu.',1);
ds($conn,$d1_1,'Lan','你觉得什么是真正的爱情？','Ni juede shenme shi zhenzheng de aiqing?','Ban nghi tinh yeu dich thuc la gi?',1);
ds($conn,$d1_1,'Minh','对我来说，爱情不是浪漫的约会，而是每天的关心。','Dui wo laishuo, aiqing bu shi langman de yuehui, er shi meitian de guanxin.','Voi toi, tinh yeu khong phai nhung buoi hen lang man ma la su quan tam hang ngay.',2);
ds($conn,$d1_1,'Lan','你说得对。感情需要两个人一起努力。','Ni shuo de dui. Ganqing xuyao liang ge ren yiqi nuli.','Ban noi dung. Tinh cam can hai nguoi cung co gang.',3);
ds($conn,$d1_1,'Minh','是啊，简单的爱情最幸福。','Shi a, jiandan de aiqing zui xingfu.','Phai, tinh yeu gian di la hanh phuc nhat.',4);
ds($conn,$d1_1,'Lan','你父母感情一定很好吧？','Ni fumu ganqing yiding hen hao ba?','Tinh cam bo me ban chac rat tot nhi?',5);
ds($conn,$d1_1,'Minh','对，他们从来不会吵架。','Dui, tamen conglai bu hui chaojia.','Dung, ho chua bao gio cai nhau.',6);
$d1_2=d($conn,$L1,'Chuyen hon nhan','Noi ve hon nhan.',2);
ds($conn,$d1_2,'Minh','你和男朋友打算什么时候结婚？','Ni he nanpengyou dasuan shenme shihou jiehun?','Ban va ban trai du dinh khi nao ket hon?',1);
ds($conn,$d1_2,'Lan','我们还没决定。结婚是大事，不能着急。','Women hai mei jueding. Jiehun shi da shi, bu neng zhaoji.','Bon minh chua quyet dinh. Cuoi la chuyen lon, khong the voi.',2);
ds($conn,$d1_2,'Minh','当然要找到对的人。','Dangran yao zhaodao dui de ren.','Duong nhien phai tim dung nguoi.',3);
ds($conn,$d1_2,'Lan','我希望能和温柔体贴的人过一辈子。','Wo xiwang neng he wenrou titie de ren guo yi beizi.','Toi hy vong co the song ca doi voi nguoi diu dang biet quan tam.',4);
$d1_3=d($conn,$L1,'Tinh cam gia dinh','Tinh cam gia dinh ben vung.',3);
ds($conn,$d1_3,'Lan','结婚以后，感情会变吗？','Jiehun yihou, ganqing hui bian ma?','Sau khi ket hon, tinh cam co thay doi khong?',1);
ds($conn,$d1_3,'Minh','会变，但可以越来越好。','Hui bian, dan keyi yue lai yue hao.','Se thay doi, nhung co the ngay cang tot hon.',2);
ds($conn,$d1_3,'Lan','我父母结婚二十年了，感情一直很好。','Wo fumu jiehun ershinian le, ganqing yizhi hen hao.','Bo me toi cuoi nhau 20 nam roi, tinh cam luon tot.',3);
ds($conn,$d1_3,'Minh','真让人感动。','Zhen rang ren gandong.','That dang cam dong.',4);
ds($conn,$d1_3,'Lan','所以我相信婚姻可以很幸福。','Suoyi wo xiangxin hunyin keyi hen xingfu.','Vi vay toi tin hon nhan co the rat hanh phuc.',5);
// Reading L1
r($conn,$L1,'Tinh yeu gian di','很多人都认为爱情应该是浪漫的、复杂的。但是对我来说，真正的爱情其实很简单。幸福不是每天都送鲜花，而是每天早上的一句关心。真正的感情不需要永远说"我爱你"，而是生活中的相互理解和体贴。我父母结婚二十多年了，他们的感情从来没有变淡，反而越来越好。从他们身上我明白了一个道理：简单的爱情才是最幸福的。','Hen duo ren dou renwei aiqing yinggai shi langman de、fuza de. Danshi dui wo laishuo, zhenzheng de aiqing qishi hen jiandan. Xingfu bu shi meitian dou song xianhua, er shi meitian zaoshang de yi ju guanxin. Zhenzheng de ganqing bu xuyao yongyuan shuo "wo ai ni", er shi shenghuo zhong de xianghu lijie he titie. Wo fumu jiehun ershih duo nian le, tamen de ganqing conglai meiyou bian dan, fan\'er yue lai yue hao. Cong tamen shenshang wo mingbai le yi ge daoli: jiandan de aiqing cai shi zui xingfu de.','Nhieu nguoi cho rang tinh yeu nen lang man va phuc tap. Nhung doi voi toi, tinh yeu dich thuc thu ra rat don gian. Hanh phuc khong phai la ngay nao cung tang hoa tuoi, ma la mot cau quan tam moi sang. Tinh cam dich thuc khong can mai mai noi "anh yeu em", ma la su thau hieu va quan tam lan nhau trong cuoc song. Bo me toi ket hon hon 20 nam roi, tinh cam cua ho chua bao gio nhat di, nguoc lai ngay cang tot hon. Tu ho toi hieu ra mot dao ly: tinh yeu gian di moi la hanh phuc nhat.','medium',195,1);
// Listening L1
$L1l=l($conn,$L1,'Cau chuyen tinh yeu','Nu: Ban co tin vao tinh yeu set danh khong? Nam: Toi chua bao gio tin. Tinh cam can tu tu hieu nhau. Nu: Nhung toi thay an tuong dau rat quan trong. Nam: Quan trong khong phai an tuong dau ma la cam giac sau khi o canh nhau. Nu: Ban noi co ly. Toi va ban trai quen ba nam moi den voi nhau.','Nu: Ni xiangxin yi jian zhongqing ma? Nan: Wo conglai bu xiangxin. Ganqing xuyao man man liaojie. Nu: Keshi wo juede di yi yinxiang hen zhongyao. Nan: Zhongyao de bu shi di yi yinxiang, er shi xiangchu yihou de ganjue. Nu: Ni shuo de you daoli. Wo he nanpengyou renshi le san nian cai zai yiqi.','Nu: Ban co tin vao tinh yeu set danh khong? Nam: Toi chua bao gio tin. Tinh cam can tu tu hieu nhau. Nu: Nhung toi thay an tuong dau rat quan trong. Nam: Quan trong khong phai an tuong dau ma la cam giac sau khi o canh nhau. Nu: Ban noi co ly. Toi va ban trai quen ba nam moi den voi nhau.','1');
lq($conn,$L1l,'Nguoi nam co tin vao tinh yeu set danh khong?','{"A":"Tin","B":"Khong tin","C":"Cung tin"}','Khong tin','Nguoi nam noi chua bao gio tin.','multiple_choice',1);
lq($conn,$L1l,'Nguoi nam cho rang dieu gi quan trong hon an tuong dau?','{"A":"Ngoai hinh","B":"Cam giac khi o canh nhau","C":"Tien bac"}','Cam giac khi o canh nhau','Quan trong la cam giac khi o canh nhau.','multiple_choice',2);
lq($conn,$L1l,'Nguoi nu quen ban trai bao lau moi den voi nhau?','{"A":"1 nam","B":"2 nam","C":"3 nam"}','3 nam','Quen ba nam.','multiple_choice',3);
// Exercises L1
$E1_1=e($conn,$L1,'Chon dap an','"从来" dung trong loai cau nao?','multiple_choice','medium',1,'B',1);
eo($conn,$E1_1,'Cau khang dinh','A',0,1); eo($conn,$E1_1,'Cau phu dinh','B',1,2); eo($conn,$E1_1,'Cau nghi van','C',0,3);
$E1_2=e($conn,$L1,'Dich cau','"Doi voi toi, hanh phuc rat don gian."','translation','medium',1,'对我来说，幸福很简单。',2);
$E1_3=e($conn,$L1,'Dien tu','他们的感情越___越好。(ngay cang)','fill_blank','medium',1,'来越',3);
$E1_4=e($conn,$L1,'Sap xep cau','我 / 从来 / 爱情 / 不 / 相信 / 浪漫 / 的','sentence_order','medium',1,'我从来不相信浪漫的爱情。',4);
$E1_5=e($conn,$L1,'Chon dung sai','"幸福" co nghia la "hanh phuc".','true_false','easy',1,'true',5);
eo($conn,$E1_5,'Dung','A',1,1); eo($conn,$E1_5,'Sai','B',0,2);
$E1_6=e($conn,$L1,'Chon tu phu hop','他从来没有说___爱我。','multiple_choice','medium',1,'B',6);
eo($conn,$E1_6,'了','A',0,1); eo($conn,$E1_6,'过','B',1,2); eo($conn,$E1_6,'着','C',0,3);
$E1_7=e($conn,$L1,'Dien tu','___我来说，家庭最重要。(doi voi)','fill_blank','medium',1,'对',7);
$E1_8=e($conn,$L1,'Chon dap an','"对...来说" dung de:','multiple_choice','medium',1,'A',8);
eo($conn,$E1_8,'Dua ra quan diem','A',1,1); eo($conn,$E1_8,'Hoi dia diem','B',0,2); eo($conn,$E1_8,'Mieu ta hanh dong','C',0,3);
$E1_9=e($conn,$L1,'Dien tu','真正的幸福不是___爱而是责任。','multiple_choice','medium',1,'A',9);
eo($conn,$E1_9,'浪漫','A',1,1); eo($conn,$E1_9,'简单','B',0,2); eo($conn,$E1_9,'幸福','C',0,3);
// Review L1
foreach ([$v1_1,$v1_2,$v1_3,$v1_4,$v1_5,$v1_6,$v1_7,$v1_8,$v1_9,$v1_10,$v1_11,$v1_12] as $i=>$vid) if ($vid) rv($conn,$L1,$vid,'core',$i+1);
echo " HSK4 L1 done: $v1 vocab, 4 grammar, 3 dialogues, 1 reading, 1 listening, 9 exercises\n";

// ═══════════════════════════════════════════════════
// HSK4 L2: zhen zheng de peng you - Nguoi ban that su
// ═══════════════════════════════════════════════════
$L2=createLesson($conn,4,2,'Bai 2: Zhen zheng de peng you - Nguoi ban that su','Tinh ban, long tin, ca tinh. Cau truc "wulun...dou..." (du the nao...cung...).','["Tinh ban","Long tin","Ca tinh"]','Tinh ban','medium','HSK4 Bai 2: Tu vung ve tinh ban va long tin. Cau truc 无论...都... (du the nao...cung...). 既...又... (vua...vua...). 只要...就... (chi can...la...). 为了 (de, vi).');
$v2=0;
$v2_1=v($conn,$L2,4,'真正','zhenzheng','that su, dich thuc','that su','他是真正的朋友。','Ta shi zhenzheng de pengyou.','Anh ay la ban that su.','adj','That su, khong gia.',++$v2);
$v2_2=v($conn,$L2,4,'信任','xinren','tin tuong, long tin','tin tuong','朋友之间需要信任。','Pengyou zhijian xuyao xinren.','Giua ban be can co long tin.','verb/noun','Tin tuong lan nhau.',++$v2);
$v2_3=v($conn,$L2,4,'性格','xingge','tinh cach','tinh cach','她性格很开朗。','Ta xingge hen kailang.','Co ay tinh cach rat hoa dong.','noun','Tinh cach con nguoi.',++$v2);
$v2_4=v($conn,$L2,4,'无论','wulun','du, bat ke','du the nao','无论多难，我都坚持。','Wulun duo nan, wo dou jianchi.','Du kho den dau, toi cung kien tri.','conj','Thuong dung voi 都.',++$v2);
$v2_5=v($conn,$L2,4,'友谊','youyi','tinh ban','tinh ban','友谊很珍贵。','Youyi hen zhengui.','Tinh ban rat quy gia.','noun','Tinh cam ban be.',++$v2);
$v2_6=v($conn,$L2,4,'帮助','bangzhu','giup do','giup','他帮助了我很多。','Ta bangzhu le wo hen duo.','Anh ay da giup toi nhieu.','verb','Su giup do.',++$v2);
$v2_7=v($conn,$L2,4,'理解','lijie','hieu, thau hieu','hieu','我理解你的心情。','Wo lijie ni de xinqing.','Toi hieu tam trang cua ban.','verb','Hieu biet sau sac.',++$v2);
$v2_8=v($conn,$L2,4,'支持','zhichi','ung ho, ho tro','ung ho','他支持我的决定。','Ta zhichi wo de jueding.','Anh ay ung ho quyet dinh cua toi.','verb','Ung ho ai do.',++$v2);
$v2_9=v($conn,$L2,4,'共同','gongtong','chung, cung nhau','cung','我们有共同的爱好。','Women you gongtong de aihao.','Chung toi co so thich chung.','adj','Cung nhau.',++$v2);
$v2_10=v($conn,$L2,4,'分享','fenxiang','chia se','chia se','和朋友分享快乐。','He pengyou fenxiang kuaile.','Cung ban be chia se niem vui.','verb','Chia se voi nhau.',++$v2);
$v2_11=v($conn,$L2,4,'诚实','chengshi','thanh that, trung thuc','thanh that','诚实很重要。','Chengshi hen zhongyao.','Thanh that rat quan trong.','adj','Pham chat tot.',++$v2);
// Grammar L2
$g2_1=g($conn,$L2,'Cau truc 无论...都...','无论 + (ai/gi/the nao) + 都 + Dong tu','Du the nao...cung...','无论 (wulun) mang y nghia "du the nao di chang", ket hop voi 都 (dou) de nhan manh ket qua khong thay doi. Co the dung: 无论谁 (du ai), 无论什么 (du gi), 无论多 (du bao nhieu).','无论多难都不放弃 = Du kho den may cung ko bo cuoc.','Dieu kien bat bien.',1);
ge($conn,$g2_1,'无论多忙，我都会联系你。','Wulun duo mang, wo dou hui lianxi ni.','Du ban den may, toi cung se lien lac voi ban.',1);
ge($conn,$g2_1,'无论发生什么事，我们都在一起。','Wulun fasheng shenme shi, women dou zai yiqi.','Du co chuyen gi xay ra, chung ta cung o ben nhau.',2);
$g2_2=g($conn,$L2,'Cau truc 既...又...','既 + A + 又 + B','Vua...vua...',' 既...又... dien ta mot nguoi/vat co ca hai thuoc tinh. Hai tinh tu hoac dong tu dat sau 既 va 又 phai la cung loai.','他既聪明又努力 = Anh ay vua thong minh vua cham chi.',2);
ge($conn,$g2_2,'他既聪明又努力。','Ta ji congming you nuli.','Anh ay vua thong minh vua cham chi.',1);
ge($conn,$g2_2,'真正的朋友既会分享快乐，又会分担痛苦。','Zhenzheng de pengyou ji hui fenxiang kuaile, you hui fendan tongku.','Ban that su vua biet chia se niem vui, vua biet chia se noi kho.',2);
$g2_3=g($conn,$L2,'Cau truc 只要...就...','只要 + Dieu kien + 就 + Ket qua','Chi can...la...','只要 (zhiyao) neu len dieu kien can thiet, 就 (jiu) dan den ket qua. Dieu kien trong 只要 la dieu kien toi thieu.','只要努力就能成功 = Chi can co gang la se thanh cong.','Dieu kien toi thieu.',3);
ge($conn,$g2_3,'只要有信任，友谊就会长久。','Zhiyao you xinren, youyi jiu hui changjiu.','Chi can co long tin, tinh ban se lau ben.',1);
ge($conn,$g2_3,'只要你需要，我就来帮你。','Zhiyao ni xuyao, wo jiu lai bang ni.','Chi can ban can, toi se den giup ban.',2);
$g2_4=g($conn,$L2,'Cau truc 为了','为了 + Muc dich + (Subject + Dong tu)','De, vi muc dich gi','为了 (weile) dat o dau cau hoac truoc dong tu de chi muc dich. Phan biet: 因为 (nguyen nhan) vs 为了 (muc dich).','为了学好汉语，我每天练习 = De hoc tot TTrung, toi luyen tap moi ngay.','Muc dich.',4);
ge($conn,$g2_4,'为了朋友，我愿意做任何事。','Weile pengyou, wo yuanyi zuo renhe shi.','Vi ban be, toi nguyen lam bat cu dieu gi.',1);
ge($conn,$g2_4,'为了健康，他开始运动了。','Weile jiankang, ta kaishi yundong le.','Vi suc khoe, anh ay bat dau van dong.',2);
// Dialogues L2
$d2_1=d($conn,$L2,'The nao la ban that su','Ban ve ban that su.',1);
ds($conn,$d2_1,'Lan','你觉得什么样的朋友才是真正的朋友？','Ni juede shenmeyang de pengyou cai shi zhenzheng de pengyou?','Ban nghi ban nhu the nao moi la ban that su?',1);
ds($conn,$d2_1,'Minh','对我来说，真正的朋友既会支持我，也能理解我。','Dui wo laishuo, zhenzheng de pengyou ji hui zhichi wo, ye neng lijie wo.','Voi toi, ban that su vua ung ho toi, vua co the thau hieu toi.',2);
ds($conn,$d2_1,'Lan','你说得对。无论发生什么事，真正的朋友都会在你身边。','Ni shuo de dui. Wulun fasheng shenme shi, zhenzheng de pengyou dou hui zai ni shenbian.','Ban noi dung. Du co chuyen gi xay ra, ban that su deu o ben ban.',3);
ds($conn,$d2_1,'Minh','而且朋友之间最重要的是信任和诚实。','Erqie pengyou zhijian zui zhongyao de shi xinren he chengshi.','Hon nua, giua ban be quan trong nhat la long tin va thanh that.',4);
$d2_2=d($conn,$L2,'Giup do ban be','Giup do khi ban gap kho khan.',2);
ds($conn,$d2_2,'Lan','我最近心情不好，工作压力很大。','Wo zuijin xinqing bu hao, gongzuo yali hen da.','Gan day tam trang toi khong tot, ap luc cong viec lon.',1);
ds($conn,$d2_2,'Minh','别担心，有我在呢。无论你需要什么帮助，我都支持你。','Bie danxin, you wo zai ne. Wulun ni xuyao shenme bangzhu, wo dou zhichi ni.','Dung lo, co toi day. Du ban can su giup do gi, toi deu ung ho ban.',2);
ds($conn,$d2_2,'Lan','谢谢你一直这么理解我。','Xiexie ni yizhi zheme lijie wo.','Cam on ban luon thau hieu toi.',3);
ds($conn,$d2_2,'Minh','只要你能开心起来，我就放心了。','Zhiyao ni neng kaixin qilai, wo jiu fangxin le.','Chi can ban vui ve len, toi yen tam roi.',4);
$d2_3=d($conn,$L2,'So thich chung','Cung nhau chia se so thich.',3);
ds($conn,$d2_3,'Lan','你有什么爱好？','Ni you shenme aihao?','Ban co so thich gi?',1);
ds($conn,$d2_3,'Minh','我喜欢读书和旅行。我们有很多共同的爱好。','Wo xihuan dushu he luxing. Women you hen duo gongtong de aihao.','Toi thich doc sach va du lich. Chung ta co nhieu so thich chung.',2);
ds($conn,$d2_3,'Lan','太好了！以后我们可以一起分享读书的心得。','Tai hao le! Yihou women keyi yiqi fenxiang dushu de xinde.','Tuyet qua! Sau nay chung ta co the cung chia se cam nhan doc sach.',3);
ds($conn,$d2_3,'Minh','当然，友谊就是从分享开始的。','Dangran, youyi jiushi cong fenxiang kaishi de.','Duong nhien, tinh ban bat dau tu su chia se.',4);
// Reading L2
r($conn,$L2,'Tinh ban that su','我有一个认识十年的好朋友，叫小华。无论我开心还是难过，他总是陪在我身边。他性格很开朗，既幽默又善良。记得有一次我遇到了很大的困难，他不仅帮助我，还一直鼓励我。他对我说："只要你不放弃，我就一直支持你。" 那时候我很感动，明白了真正的友谊是什么。真正的朋友不需要天天见面，但无论距离多远，心里都会想着对方。信任和理解，是友谊的基础。','Wo you yi ge renshi shi nian de hao pengyou, jiao Xiao Hua. Wulun wo kaixin haishi nanguo, ta zongshi pei zai wo shenbian. Ta xingge hen kailang, ji youmo you shanliang. Jide you yi ci wo yudao le hen da de kunnan, ta bujin bangzhu wo, hai yizhi guli wo. Ta dui wo shuo: "Zhiyao ni bu fangqi, wo jiu yizhi zhichi ni." Na shihou wo hen gandong, mingbai le zhenzheng de youyi shi shenme. Zhenzheng de pengyou bu xuyao tiantian jianmian, dan wulun juli duo yuan, xin li dou hui xiangzhe duifang. Xinren he lijie, shi youyi de jichu.','Toi co mot nguoi ban quen muoi nam, ten la Tieu Hoa. Du toi vui hay buon, anh ay luon o ben canh toi. Tinh cach anh ay rat hoa dong, vua hoi huoc vua tot bung. Nho mot lan toi gap kho khan rat lon, anh ay khong chi giup do toi, ma con luon khuyen khich toi. Anh ay noi voi toi: "Chi can ban khong bo cuoc, toi se luon ung ho ban." Luc do toi rat cam dong, hieu duoc tinh ban that su la gi. Ban that su khong can gap mat hang ngay, nhung du khoang cach xa den may, trong long deu nho den nhau. Long tin va thau hieu, la nen tang cua tinh ban.','medium',200,1);
// Listening L2
$L2l=l($conn,$L2,'Tinh ban','A: Ban hinh nhu co chuyen buon. B: U, toi va ban than cai nhau roi. A: Sao vay? B: Vi mot chuyen nho. Nhung gio toi rat hoi han. A: Toi nghi ban that su se thong cam cho ban. Chi can ban xin loi, anh ay se tha thu cho ban. B: Hy vong vay. toi rat quy tinh ban nay.','A: Ni haoxiang you xinshi. B: En, wo he hao pengyou chaojia le. A: Zenme le? B: Yinwei yi jian xiao shi. Dan xianzai wo hen houhui. A: Wo juede zhenzheng de pengyou hui liangjie ni. Zhiyao ni daoqian, ta hui yuanying ni de. B: Xiwang ba. Wo hen zhenxi zhe fen youyi.','A: Ban hinh nhu co tam su. B: U, toi va ban than cai nhau roi. A: Sao vay? B: Vi mot chuyen nho. Nhung bay gio toi rat hoi han. A: Toi nghi ban that su se thau hieu cho ban. Chi can ban xin loi, anh ay se tha thu cho ban. B: Hy vong vay. Toi rat quy tinh ban nay.','1');
lq($conn,$L2l,'Tai sao nguoi B buon?','{"A":"Mat viec","B":"Cai nhau voi ban than","C":"O benh"}','Cai nhau voi ban than','Vi cai nhau voi ban than.','multiple_choice',1);
lq($conn,$L2l,'Nguoi A khuyen B lam gi?','{"A":"Quen ban ay di","B":"Xin loi","C":"Khong can lam gi"}','Xin loi','Chi can xin loi.','multiple_choice',2);
lq($conn,$L2l,'Nguoi B cam thay the nao ve tinh ban nay?','{"A":"Khong quan tam","B":"Rat quy","C":"Muon ket thuc"}','Rat quy','Toi rat quy tinh ban nay.','multiple_choice',3);
// Exercises L2
$E2_1=e($conn,$L2,'Chon dap an','"无论...都..." co nghia la:','multiple_choice','medium',1,'C',1);
eo($conn,$E2_1,'Vi...nen...','A',0,1); eo($conn,$E2_1,'Neu...thi...','B',0,2); eo($conn,$E2_1,'Du...cung...','C',1,3);
$E2_2=e($conn,$L2,'Dich','"Chi can ban can, toi se giup."','translation','medium',1,'只要你需要，我就帮你。',2);
$E2_3=e($conn,$L2,'Dien tu','他既聪明___努力。(lai)','fill_blank','medium',1,'又',3);
$E2_4=e($conn,$L2,'Sap xep cau','无论 / 我 / 都 / 多忙 / 你 / 联系','sentence_order','medium',1,'无论多忙，我都会联系你。',4);
$E2_5=e($conn,$L2,'Chon dung sai','"为了" dung de chi nguyen nhan.','true_false','medium',1,'false',5);
eo($conn,$E2_5,'Dung','A',0,1); eo($conn,$E2_5,'Sai','B',1,2);
$E2_6=e($conn,$L2,'Dien tu','___健康，他每天跑步。(de/vi)','fill_blank','medium',1,'为了',6);
$E2_7=e($conn,$L2,'Chon dap an','"既...又..." dung de:','multiple_choice','medium',1,'C',7);
eo($conn,$E2_7,'So sanh','A',0,1); eo($conn,$E2_7,'Lua chon','B',0,2); eo($conn,$E2_7,'Song song hai thuoc tinh','C',1,3);
$E2_8=e($conn,$L2,'Dien tu','真正的朋友会___你的快乐。(chia se)','fill_blank','medium',1,'分享',8);
$E2_9=e($conn,$L2,'Chon tu dung','___多难，我都会坚持下去。','multiple_choice','medium',1,'A',9);
eo($conn,$E2_9,'无论','A',1,1); eo($conn,$E2_9,'虽然','B',0,2); eo($conn,$E2_9,'因为','C',0,3);
// Review L2
foreach ([$v2_1,$v2_2,$v2_3,$v2_4,$v2_5,$v2_6,$v2_7,$v2_8,$v2_9,$v2_10,$v2_11] as $i=>$vid) if ($vid) rv($conn,$L2,$vid,'core',$i+1);
echo " HSK4 L2 done: $v2 vocab, 4 grammar, 3 dialogues, 1 reading, 1 listening, 9 exercises\n";

// ═══════════════════════════════════════════════════
// HSK4 L3: ren sheng mei you cai pai - Doi khong co tap tran
// ═══════════════════════════════════════════════════
$L3=createLesson($conn,4,3,'Bai 3: Ren sheng mei you cai pai - Doi khong co tap tran','Cuoc song, su lua chon, co hoi. Cau truc "ruguo...jiu..." (neu...thi...). "jishi...ye..." (thu the...cung...).','["Cuoc song","Lua chon","Co hoi"]','Cuoc song','medium','HSK4 Bai 3: Tu vung ve cuoc song va su lua chon. Cau truc 如果...就... (neu...thi...). 即使...也... (thu the...cung...). 只有...才... (chi...moi...). 不但...反而... (khong nhung...nguoc lai...).');
$v3=0;
$v3_1=v($conn,$L3,4,'人生','rensheng','cuoc song, nhan sinh','cuoc doi','人生很短，要珍惜。','Rensheng hen duan, yao zhenxi.','Cuoc doi ngan, phai tran trong.','noun','Cuoc song con nguoi.',++$v3);
$v3_2=v($conn,$L3,4,'如果','ruguo','neu','neu','如果你来，我会很高兴。','Ruguo ni lai, wo hui hen gaoxing.','Neu ban den, toi se rat vui.','conj','Gia dinh dieu kien.',++$v3);
$v3_3=v($conn,$L3,4,'即使','jishi','thu the...di chang','thu the','即使下雨，我也要去。','Jishi xiayu, wo ye yao qu.','Thu the mua, toi cung phai di.','conj','Gia du nhuong bo.',++$v3);
$v3_4=v($conn,$L3,4,'机会','jihui','co hoi','co hoi','这是一个好机会。','Zhe shi yi ge hao jihui.','Day la mot co hoi tot.','noun','Thoi co thuan loi.',++$v3);
$v3_5=v($conn,$L3,4,'选择','xuanze','lua chon','chon','你要做出选择。','Ni yao zuochu xuanze.','Ban phai dua ra lua chon.','verb/noun','Su lua chon.',++$v3);
$v3_6=v($conn,$L3,4,'后悔','houhui','hoi han, an han','hoi han','做了就不要后悔。','Zuo le jiu bu yao houhui.','Lam roi thi dung hoi han.','verb','Cam giac an han.',++$v3);
$v3_7=v($conn,$L3,4,'努力','nuli','co gang, no luc','co gang','努力才有收获。','Nuli cai you shouhuo.','Co gang moi co thu hoach.','verb/adv','No luc het minh.',++$v3);
$v3_8=v($conn,$L3,4,'失败','shibai','that bai','that bai','失败是成功之母。','Shibai shi chenggong zhi mu.','That bai la me thanh cong.','verb/noun','Khong thanh cong.',++$v3);
$v3_9=v($conn,$L3,4,'经验','jingyan','kinh nghiem','kinh nghiem','他有丰富的经验。','Ta you fengfu de jingyan.','Anh ay co kinh nghiem phong phu.','noun','Trai nghiem tich luy.',++$v3);
$v3_10=v($conn,$L3,4,'珍惜','zhenxi','tran trong, giu gin','tran trong','珍惜时间。','Zhenxi shijian.','Tran trong thoi gian.','verb','Quy trong giu gin.',++$v3);
$v3_11=v($conn,$L3,4,'继续','jixu','tiep tuc','tiep tuc','继续努力。','Jixu nuli.','Tiep tuc co gang.','verb','Khong dung lai.',++$v3);
// Grammar L3
$g3_1=g($conn,$L3,'Cau truc 如果...就...','如果 + Dieu kien + 就 + Ket qua','Neu...thi...','如果 (ruguo) neu len dieu kien, 就 (jiu) dan den ket qua. Day la cau dieu kien co ban nhat. Trong khau ngu co the bo 如果 va chi dung 就.','如果下雨，我就不去了 = Neu mua thi toi ko di.','Cau dieu kien.',1);
ge($conn,$g3_1,'如果人生有选择，你会怎么做？','Ruguo rensheng you xuanze, ni hui zenme zuo?','Neu cuoc song co lua chon, ban se lam the nao?',1);
ge($conn,$g3_1,'如果失败了，不要放弃，继续努力。','Ruguo shibai le, bu yao fangqi, jixu nuli.','Neu that bai, dung bo cuoc, hay tiep tuc co gang.',2);
$g3_2=g($conn,$L3,'Cau truc 即使...也...','即使 + Nhuong bo + 也 + Ket qua','Thu the...cung...',' 即使 (jishi) dien ta mot Dieu kien nhuong bo, hanh dong o ve sau khong bi anh huong. Khac voi 虽然 (mac du la thuc te), 即使 la gia su.','即使失败，也不后悔 = Thu the that bai, cung ko hoi han.','Gia su nhuong bo.',2);
ge($conn,$g3_2,'即使遇到困难，也不要放弃梦想。','Jishi yudao kunnan, ye bu yao fangqi mengxiang.','Thu the gap kho khan, cung dung bo cuoc uoc mo.',1);
ge($conn,$g3_2,'即使没有人理解，我也要坚持。','Jishi meiyou ren lijie, wo ye yao jianchi.','Thu the khong ai thau hieu, toi cung phai kien tri.',2);
$g3_3=g($conn,$L3,'Cau truc 只有...才...','只有 + Dieu kien + 才 + Ket qua','Chi...moi...',' 只有 (zhiyou) neu len dieu kien duy nhat can thiet, 才 (cai) dan den ket qua. Day la dieu kien bat buoc.','只有努力才能成功 = Chi co gang moi thanh cong.','Dieu kien bat buoc.',3);
ge($conn,$g3_3,'只有珍惜现在，才不会后悔未来。','Zhiyou zhenxi xianzai, cai bu hui houhui weilai.','Chi co tran trong hien tai, moi khong hoi han tuong lai.',1);
ge($conn,$g3_3,'只有经历过失败，才能获得真正的经验。','Zhiyou jingli guo shibai, cai neng huode zhenzheng de jingyan.','Chi co trai qua that bai, moi co duoc kinh nghiem that su.',2);
$g3_4=g($conn,$L3,'Cau truc 不但...反而...','不但 + Khong + A + 反而 + B','Khong nhung khong...nguoc lai con...',' 不但...反而... dung de bieu thi su nguoc lai: dieu du kien se xay ra lai khong xay ra, thay vao do la ket qua nguoc lai.','不但不生气，反而笑了 = Ko nhung ko gian, nguoc lai con cuoi.','Trai nguoc su mong doi.',4);
ge($conn,$g3_4,'他不但没有放弃，反而更加努力了。','Ta budan meiyou fangqi, fan\'er gengjia nuli le.','Anh ay khong nhung khong bo cuoc, nguoc lai con co gap hon.',1);
ge($conn,$g3_4,'失败不但没有让他后悔，反而让他学到了很多。','Shibai budan meiyou rang ta houhui, fan\'er rang ta xuedao le hen duo.','That bai khong nhung khong khien anh ay hoi han, nguoc lai con giup anh ay hoc duoc nhieu.',2);
// Dialogues L3
$d3_1=d($conn,$L3,'Cuoc song khong co tap tran','Ban ve nhung lua chon trong cuoc song.',1);
ds($conn,$d3_1,'Lan','如果人生可以重来，你会选择不一样的路吗？','Ruguo rensheng keyi chong lai, ni hui xuanze bu yiyang de lu ma?','Neu cuoc doi co the lam lai, ban se chon con duong khac khong?',1);
ds($conn,$d3_1,'Minh','人生没有彩排，每天都是现场直播。我从不后悔自己的选择。','Rensheng meiyou caipai, meitian dou shi xianchang zhibo. Wo conglai bu houhui ziji de xuanze.','Cuoc doi khong co tap tran, moi ngay deu la truc tiep. Toi chua bao gio hoi han lua chon cua minh.',2);
ds($conn,$d3_1,'Lan','说得好。即使走错了路，也是一种经验。','Shuo de hao. Jishi zoucuo le lu, ye shi yi zhong jingyan.','Noi hay. Thu the di nham duong, cung la mot kinh nghiem.',3);
ds($conn,$d3_1,'Minh','对，只有经历过，才知道什么最重要。','Dui, zhiyou jingli guo, cai zhidao shenme zui zhongyao.','Dung, chi co trai qua roi, moi biet dieu gi quan trong nhat.',4);
$d3_2=d($conn,$L3,'That bai va bai hoc','Noi ve that bai va bai hoc.',2);
ds($conn,$d3_2,'Lan','上次考试我失败了，心里很难过。','Shangci kaoshi wo shibai le, xin li hen nanguo.','Lan thi truoc toi that bai, trong long rat buon.',1);
ds($conn,$d3_2,'Minh','如果因为一次失败就放弃，那才可惜呢。','Ruguo yinwei yi ci shibai jiu fangqi, na cai kexi ne.','Neu vi mot lan that bai ma bo cuoc, moi dang tiec.',2);
ds($conn,$d3_2,'Lan','你说得对。我不会放弃，我要继续努力。','Ni shuo de dui. Wo bu hui fangqi, wo yao jixu nuli.','Ban noi dung. Toi se khong bo cuoc, toi se tiep tuc co gang.',3);
ds($conn,$d3_2,'Minh','这次失败不但没有打败你，反而让你更坚强了。','Zhe ci shibai budan meiyou dabai ni, fan\'er rang ni geng jianqiang le.','Lan that bai nay khong nhung khong danh bai ban, nguoc lai con khien ban manh me hon.',4);
$d3_3=d($conn,$L3,'Co hoi va quyet dinh','Nam bat co hoi.',3);
ds($conn,$d3_3,'Lan','有一个去中国留学的机会，我很想去。','You yi ge qu Zhongguo liuxue de jihui, wo hen xiang qu.','Co mot co hoi di du hoc Trung Quoc, toi rat muon di.',1);
ds($conn,$d3_3,'Minh','这是好机会啊！如果想去，就不要犹豫。','Zhe shi hao jihui a! Ruguo xiang qu, jiu bu yao youyu.','Day la co hoi tot! Neu muon di, thi dung do du.',2);
ds($conn,$d3_3,'Lan','但是我担心自己能力不够。','Danshi wo danxin ziji nengli bu gou.','Nhung toi lo nang luc minh khong du.',3);
ds($conn,$d3_3,'Minh','即使现在不够好，去了以后会越来越好的。','Jishi xianzai bu gou hao, qu le yihou hui yue lai yue hao de.','Thu the bay gio chua tot, di roi se ngay cang tot hon.',4);
ds($conn,$d3_3,'Lan','你说得对。那我就试试看。','Ni shuo de dui. Na wo jiu shishi kan.','Ban noi dung. Vay toi se thu xem.',5);
// Reading L3
r($conn,$L3,'Doi khong co tap tran','人生没有彩排，每一天都是现场直播。我们每个人都会面临很多选择，也会经历很多失败。但是，如果因为害怕失败就不敢选择，那就会失去很多机会。我记得三年前，我有一个去北京工作的机会。那时我很犹豫，担心自己能力不够。但是朋友对我说："如果不去试试，你永远不知道自己能做到什么。" 于是我决定去了。虽然遇到了很多困难，但是我学到了很多经验，也变得更加独立。现在回想起来，我很感谢自己当初的选择。即使再难，也值得。','Rensheng meiyou caipai, meitian dou shi xianchang zhibo. Women mei ge ren dou hui mianlin hen duo xuanze, ye hui jingli hen duo shibai. Danshi, ruguo yinwei haipa shibai jiu bu gan xuanze, na jiu hui shiqu hen duo jihui. Wo jide san nian qian, wo you yi ge qu Beijing gongzuo de jihui. Na shi wo hen youyu, danxin ziji nengli bu gou. Danshi pengyou dui wo shuo: "Ruguo bu qu shishi, ni yongyuan bu zhidao ziji neng zuodao shenme." Yushi wo jueding qu le. Suiran yudao le hen duo kunnan, danshi wo xuedao le hen duo jingyan, ye bian de gengjia duli. Xianzai huixiang qilai, wo hen ganxie ziji dangchu de xuanze. Jishi zai nan, ye zhide.','Cuoc doi khong co tap tran, moi ngay deu la truc tiep. Moi nguoi chung ta deu phai doi mat voi nhieu lua chon, va cung se trai qua nhieu that bai. Nhung, neu vi so that bai ma khong dam chon, thi se mat di nhieu co hoi. Toi nho ba nam truoc, toi co co hoi di lam viec o Bac Kinh. Luc do toi rat do du, lo nang luc minh khong du. Nhung ban be noi voi toi: "Neu khong thu, ban mai mai khong biet minh co the lam duoc gi." The la toi quyet dinh di. Mac du gap nhieu kho khan, nhung toi hoc duoc nhieu kinh nghiem, va cung tro nen doc lap hon. Bay gio nho lai, toi rat cam on lua chon ngay ay cua minh. Du co kho, cung dang.','medium',210,1);
// Listening L3
$L3l=l($conn,$L3,'Lua chon trong doi','Nam: Toi dang phan van co nen doi viec hay khong. Cong viec hien tai on dinh nhung toi muon thu thach ban than. Nu: Neu ban cam thay khong con phat trien, thi nen doi. Co hoi moi se mang lai nhieu kinh nghiem quy gia. Nam: Nhung toi so that bai. Nu: That bai cung la mot bai hoc. Chi co trai qua, ban moi biet minh co the lam duoc gi.','Nan: Wo zhengzai fanyu yao bu yao huan gongzuo. Xianzai de gongzuo wending dan wo xiang tiaozhan ziji. Nu: Ruguo ni ganjue bu neng zai fazhan le, na jiu yinggai huan. Xin jihui hui gei ni hen duo baogui jingyan. Nan: Keshi wo pa shibai. Nu: Shibai ye shi yi ke baogui de ke. Zhiyou jingli guo, ni cai zhidao neng zuo shenme.','Nam: Toi dang phan van co nen doi viec hay khong. Cong viec hien tai on dinh nhung toi muon thu thach ban than. Nu: Neu ban cam thay khong con phat trien, thi nen doi. Co hoi moi se mang lai nhieu kinh nghiem quy gia. Nam: Nhung toi so that bai. Nu: That bai cung la mot bai hoc. Chi co trai qua, ban moi biet minh co the lam duoc gi.','1');
lq($conn,$L3l,'Nguoi nam dang phan van ve dieu gi?','{"A":"Co nen hoc tiep khong","B":"Co nen doi viec khong","C":"Co nen ket hon khong"}','Co nen doi viec khong','Phan van co nen doi viec.','multiple_choice',1);
lq($conn,$L3l,'Nguoi nu khuyen anh ay gi?','{"A":"O lai","B":"Di tim co hoi moi","C":"Nghi ngoi"}','Di tim co hoi moi','Co hoi moi se mang lai kinh nghiem.','multiple_choice',2);
lq($conn,$L3l,'Tai sao nguoi nam so doi viec?','{"A":"Luong thap","B":"So that bai","C":"Xa nha"}','So that bai','Anh ay so that bai.','multiple_choice',3);
// Exercises L3
$E3_1=e($conn,$L3,'Chon dap an','"如果...就..." bieu thi:','multiple_choice','medium',1,'A',1);
eo($conn,$E3_1,'Dieu kien - ket qua','A',1,1); eo($conn,$E3_1,'Nhuong bo','B',0,2); eo($conn,$E3_1,'Tuong phan','C',0,3);
$E3_2=e($conn,$L3,'Dich','"Thu the that bai, cung dung bo cuoc."','translation','medium',1,'即使失败，也不要放弃。',2);
$E3_3=e($conn,$L3,'Dien tu','___你努力，就___成功。(neu...thi...)','fill_blank','medium',1,'如果...就...',3);
$E3_4=e($conn,$L3,'Sap xep cau','没有 / 人生 / 彩排 / 每天 / 直播 / 是 / 现场','sentence_order','medium',1,'人生没有彩排，每天都是现场直播。',4);
$E3_5=e($conn,$L3,'Chon dung sai','"只有...才..." chi dieu kien bat buoc.','true_false','medium',1,'true',5);
eo($conn,$E3_5,'Dung','A',1,1); eo($conn,$E3_5,'Sai','B',0,2);
$E3_6=e($conn,$L3,'Dien tu','___没有人理解，我也___坚持。(thu the...cung)','fill_blank','medium',1,'即使...也...',6);
$E3_7=e($conn,$L3,'Phan biet tu','"即使" va "虽然" khac nhau the nao?','multiple_choice','medium',1,'B',7);
eo($conn,$E3_7,'Giong nhau','A',0,1); eo($conn,$E3_7,'即使 la gia su, 虽然 la thuc te','B',1,2); eo($conn,$E3_7,'即使 la qua khu','C',0,3);
$E3_8=e($conn,$L3,'Dien tu','这次失败不但没有让他倒下，___让他更坚强了。(nguoc lai)','fill_blank','medium',1,'反而',8);
$E3_9=e($conn,$L3,'Chon tu dung','___经历过失败，___能获得真正的经验。','multiple_choice','medium',1,'B',9);
eo($conn,$E3_9,'只要...就...','A',0,1); eo($conn,$E3_9,'只有...才...','B',1,2); eo($conn,$E3_9,'无论...都...','C',0,3);
// Review L3
foreach ([$v3_1,$v3_2,$v3_3,$v3_4,$v3_5,$v3_6,$v3_7,$v3_8,$v3_9,$v3_10,$v3_11] as $i=>$vid) if ($vid) rv($conn,$L3,$vid,'core',$i+1);
echo " HSK4 L3 done: $v3 vocab, 4 grammar, 3 dialogues, 1 reading, 1 listening, 9 exercises\n";

// ═══════════════════════════════════════════════════
// HSK4 L4: du shu shi yi zhong sheng huo - Doc sach la mot cach song
// ═══════════════════════════════════════════════════
$L4=createLesson($conn,4,4,'Bai 4: Du shu shi yi zhong sheng huo - Doc sach la mot cach song','Doc sach, tri thuc, thoi quen. Cau truc "bujin...erqie..." (khong nhung...ma con...).','["Doc sach","Tri thuc","Thoi quen"]','Doc sach','medium','HSK4 Bai 4: Tu vung ve doc sach va tri thuc. Cau truc 不仅...而且... (khong nhung...ma con...). 从...中... (tu...trong...). 连...都/也... (ngay ca...cung...). Cach noi ve loi ich cua viec doc sach.');
$v4=0;
$v4_1=v($conn,$L4,4,'读书','dushu','doc sach','doc sach','我喜欢读书。','Wo xihuan dushu.','Toi thich doc sach.','verb','Hoat dong doc sach.',++$v4);
$v4_2=v($conn,$L4,4,'知识','zhishi','tri thuc, kien thuc','kien thuc','知识就是力量。','Zhishi jiushi liliang.','Tri thuc la suc manh.','noun','Kien thuc hoc duoc.',++$v4);
$v4_3=v($conn,$L4,4,'不仅','bujin','khong nhung','khong nhung','他不仅聪明，而且努力。','Ta bujin congming, erqie nuli.','Anh ay khong nhung thong minh ma con cham chi.','conj','Thuong dung voi 而且.',++$v4);
$v4_4=v($conn,$L4,4,'而且','erqie','ma con','ma con','这件衣服便宜而且好看。','Zhe jian yifu pianyi erqie haokan.','Cai ao nay re ma con dep.','conj','Noi tiep bo sung.',++$v4);
$v4_5=v($conn,$L4,4,'兴趣','xingqu','so thich, hung thu','ham thich','我对汉语很感兴趣。','Wo dui Hanyu hen gan xingqu.','Toi rat ham thich tieng Trung.','noun','Su yeu thich.',++$v4);
$v4_6=v($conn,$L4,4,'习惯','xiguan','thoi quen','thoi quen','每天读书是好习惯。','Meitian dushu shi hao xiguan.','Moi ngay doc sach la thoi quen tot.','noun','Thoi quen hinh thanh.',++$v4);
$v4_7=v($conn,$L4,4,'提高','tigao','nang cao, cai thien','nang cao','提高汉语水平。','Tigao Hanyu shuiping.','Nang cao trinh do tieng Trung.','verb','Lam cho tot hon.',++$v4);
$v4_8=v($conn,$L4,4,'内容','neirong','noi dung','noi dung','这本书内容很丰富。','Zhe ben shu neirong hen fengfu.','Cuon sach nay noi dung rat phong phu.','noun','Noi dung ben trong.',++$v4);
$v4_9=v($conn,$L4,4,'作者','zuozhe','tac gia','tac gia','作者是谁？','Zuozhe shi shei?','Tac gia la ai?','noun','Nguoi viet sach.',++$v4);
$v4_10=v($conn,$L4,4,'思考','sikao','suy nghi, tu duy','suy nghi','读书要思考。','Dushu yao sikao.','Doc sach can suy nghi.','verb','Tu duy sau sac.',++$v4);
$v4_11=v($conn,$L4,4,'丰富','fengfu','phong phu','phong phu','生活很丰富。','Shenghuo hen fengfu.','Cuoc song rat phong phu.','adj/verb','Nhieu ve so luong/loai.',++$v4);
// Grammar L4
$g4_1=g($conn,$L4,'Cau truc 不仅...而且...','不仅 + A + 而且 + B + (C)','Khong nhung...ma con...',' 不仅...而且... dung de noi ket hai ve cau, ve sau co y nghia bo sung va tang tien cho ve truoc. Chu ngu co the dung truoc 不仅 hoac sau.','他不仅会说汉语，而且会写汉字.',1);
ge($conn,$g4_1,'读书不仅可以增长知识，而且可以丰富生活。','Dushu bujin keyi zengzhang zhishi, erqie keyi fengfu shenghuo.','Doc sach khong nhung co the tang them tri thuc, ma con co the lam phong phu cuoc song.',1);
ge($conn,$g4_1,'他不仅喜欢读书，而且喜欢思考。','Ta bujin xihuan dushu, erqie xihuan sikao.','Anh ay khong nhung thich doc sach, ma con thich suy nghi.',2);
$g4_2=g($conn,$L4,'Cau truc 从...中...','从 + Danh tu + 中 + Dong tu','Tu...trong...','从...中... chi xuat phat hoac thu duoc tu trong mot pham vi nao do. 从 chi diem dau, 中 chi pham vi.','从书中获得知识 = Tu trong sach ma co duoc kien thuc.',2);
ge($conn,$g4_2,'从读书中，我学到了很多知识。','Cong dushu zhong, wo xuedao le hen duo zhishi.','Tu viec doc sach, toi hoc duoc rat nhieu kien thuc.',1);
ge($conn,$g4_2,'从这本书中，我了解到中国的文化。','Cong zhe ben shu zhong, wo liaojie dao Zhongguo de wenhua.','Tu cuon sach nay, toi hieu duoc van hoa Trung Quoc.',2);
$g4_3=g($conn,$L4,'Cau truc 连...都/也...','连 + Danh tu/Dong tu + 都/也 + Phu dinh/Khang dinh','Ngay ca...cung/khong...','连...都/也... nhan manh mot truong hop ca biet, thuong dung trong cau phu dinh de bieu thi "ngay ca...cung khong".','连这么简单的字都不认识 = Ngay ca chu don gian nhat cung ko biet.',3);
ge($conn,$g4_3,'他连周末都在读书。','Ta lian zhoumo dou zai dushu.','Anh ay ngay ca cuoi tuan cung doc sach.',1);
ge($conn,$g4_3,'这本书连作者都忘了写什么了。','Zhe ben shu lian zuozhe dou wang le xie shenme le.','Cuon sach nay ngay ca tac gia cung quen viet gi roi.',2);
$g4_4=g($conn,$L4,'Cau truc 对...感兴趣','对 + Danh tu + 感兴趣','Cam thay hung thu voi...','对...感兴趣 bieu thi su yeu thich hoac quan tam den mot doi tuong nao do. 感兴趣 la tinh tu dong thai.','我对历史很感兴趣 = Toi rat thich lich su.',4);
ge($conn,$g4_4,'我对中国文化很感兴趣。','Wo dui Zhongguo wenhua hen gan xingqu.','Toi rat ham thich van hoa Trung Quoc.',1);
ge($conn,$g4_4,'你对什么类型的书感兴趣？','Ni dui shenme leixing de shu gan xingqu?','Ban ham thich the loai sach nao?',2);
// Dialogues L4
$d4_1=d($conn,$L4,'Loi ich cua doc sach','Ban ve loi ich cua doc sach.',1);
ds($conn,$d4_1,'Lan','你平时喜欢读书吗？','Ni pingshi xihuan dushu ma?','Binh thuong ban co thich doc sach khong?',1);
ds($conn,$d4_1,'Minh','非常喜欢。读书不仅让我学到知识，还让我的生活更丰富。','Feichang xihuan. Dushu bujin rang wo xuedao zhishi, hai rang wo de shenghuo geng fengfu.','Rat thich. Doc sach khong nhung giup toi hoc duoc kien thuc, ma con lam cuoc song toi phong phu hon.',2);
ds($conn,$d4_1,'Lan','我也有这个习惯。从书中能了解到不同的世界。','Wo ye you zhe ge xiguan. Cong shu zhong neng liaojie dao butong de shijie.','Toi cung co thoi quen nay. Tu sach co the hieu duoc nhung the gioi khac nhau.',3);
ds($conn,$d4_1,'Minh','对，而且读书还能提高思考能力。','Dui, erqie dushu hai neng tigao sikao nengli.','Dung, hon nua doc sach con co the nang cao kha nang tu duy.',4);
$d4_2=d($conn,$L4,'Chia se sach hay','Chia se ve mot cuon sach hay.',2);
ds($conn,$d4_2,'Minh','我最近在读一本很有意思的书，内容非常丰富。','Wo zuijin zai du yi ben hen you yisi de shu, neirong feichang fengfu.','Gan day toi dang doc mot cuon sach rat thu vi, noi dung rat phong phu.',1);
ds($conn,$d4_2,'Lan','是什么书？作者是谁？','Shi shenme shu? Zuozhe shi shei?','La sach gi? Tac gia la ai?',2);
ds($conn,$d4_2,'Minh','是一本关于中国历史的小说，作者是著名的作家。','Shi yi ben guanyu Zhongguo lishi de xiaoshuo, zuozhe shi zhuming de zuojia.','La mot cuon tieu thuyet ve lich su Trung Quoc, tac gia la nha van noi tieng.',3);
ds($conn,$d4_2,'Lan','我对中国文化也很感兴趣，能借给我看看吗？','Wo dui Zhongguo wenhua ye hen gan xingqu, neng jie gei wo kankan ma?','Toi cung rat ham thich van hoa Trung Quoc, co the cho toi muon xem khong?',4);
ds($conn,$d4_2,'Minh','当然可以！','Dangran keyi!','Duong nhien co the!',5);
$d4_3=d($conn,$L4,'Hinh thanh thoi quen doc sach','Cach hinh thanh thoi quen doc sach.',3);
ds($conn,$d4_3,'Lan','我想养成每天读书的习惯，但总是坚持不下来。','Wo xiang yangcheng meitian dushu de xiguan, dan zongshi jianchi bu xialai.','Toi muon tao thoi quen doc sach moi ngay, nhung luon khong kien tri duoc.',1);
ds($conn,$d4_3,'Minh','你可以从每天读十页开始，慢慢来。','Ni keyi cong meitian du shi ye kaishi, manman lai.','Ban co the bat dau tu doc moi ngay muoi trang, tu tu thoi.',2);
ds($conn,$d4_3,'Lan','好主意。连周末也要坚持吗？','Hao zhuyi. Lian zhoumo ye yao jianchi ma?','Y hay. Ngay ca cuoi tuan cung phai kien tri a?',3);
ds($conn,$d4_3,'Minh','对，坚持就会变成习惯。','Dui, jianchi jiu hui biancheng xiguan.','Dung, kien tri se tro thanh thoi quen.',4);
// Reading L4
r($conn,$L4,'Doc sach va cuoc song','对我来说，读书不仅是一种学习，更是一种生活方式。从书中，我们可以了解到世界上不同地方的文化、历史和人们的思想。读一本好书，就像和一位聪明的朋友聊天，不仅能增长知识，还能丰富我们的内心世界。我每天都会花一个小时读书，这已经成为我的习惯了。无论是小说、历史还是哲学，我对各种类型的书都很感兴趣。读书让我学会了思考，也让我越来越喜欢这个世界。如果你还没有养成读书的习惯，不妨从现在开始，每天读一点，你会发现生活因为读书而变得更加美好。','Dui wo laishuo, dushu bujin shi yi zhong xuexi, geng shi yi zhong shenghuo fangshi. Cong shu zhong, women keyi liaojie dao shijie shang butong difang de wenhua、lishi he renmen de sixiang. Du yi ben hao shu, jiu xiang he yi wei congming de pengyou liaotian, bujin neng zengzhang zhishi, hai neng fengfu women de neixin shijie. Wo meitian dou hui hua yi ge xiaoshi dushu, zhe yi jing chengwei wo de xiguan le. Wulun shi xiaoshuo、lishi haishi zhexue, wo dui ge zhong leixing de shu dou hen gan xingqu. Dushu rang wo xuehui le sikao, ye rang wo yue lai yue xihuan zhe ge shijie. Ruguo ni hai meiyou yangcheng dushu de xiguan, bufang cong xianzai kaishi, meitian du yi dian, ni hui faxian shenghuo yinwei dushu er bian de gengjia meihao.','Doi voi toi, doc sach khong nhung la mot hinh thuc hoc tap, ma con la mot cach song. Tu sach, chung ta co the biet den van hoa, lich su va tu tuong cua nguoi dan o nhung vung khac nhau tren the gioi. Doc mot cuon sach hay, giong nhu tro chuyen voi mot nguoi ban thong minh, khong nhung co the tang them kien thuc, ma con lam phong phu tam hon chung ta. Toi moi ngay deu danh mot tieng doc sach, dieu nay da tro thanh thoi quen cua toi. Du la tieu thuyet, lich su hay triet hoc, toi deu rat ham thich cac the loai sach khac nhau. Doc sach khien toi hoc duoc suy nghi va cang ngay cang yeu the gioi nay. Neu ban chua tao thoi quen doc sach, hay bat dau tu bay gio, moi ngay doc mot chut, ban se phat hien cuoc song tro nen tot dep hon nho doc sach.','medium',215,1);
// Listening L4
$L4l=l($conn,$L4,'Thoi quen doc sach','A: Ban co thoi quen doc sach khong? B: Co, toi doc sach moi ngay. A: Ban hay doc loai sach nao? B: Toi thich doc tieu thuyet va lich su. A: Tai sao ban thich doc sach? B: Vi doc sach khong nhung giup toi thu duoc kien thuc ma con giup toi thu gian. A: Nghe hay qua. Toi cung muon thu.','A: Ni you dushu de xiguan ma? B: You, wo meitian dou dushu. A: Ni xihuan du shenme leixing de shu? B: Wo xihuan du xiaoshuo he lishi. A: Wei shenme ni xihuan dushu? B: Yinwei dushu bujin bang wo huode zhishi, erqie bang wo fangsong. A: Ting qilai hen hao. Wo ye xiang shishi.','A: Ban co thoi quen doc sach khong? B: Co, toi doc sach moi ngay. A: Ban hay doc loai sach nao? B: Toi thich doc tieu thuyet va lich su. A: Tai sao ban thich doc sach? B: Vi doc sach khong nhung giup toi thu duoc kien thuc ma con giup toi thu gian. A: Nghe hay qua. Toi cung muon thu.','1');
lq($conn,$L4l,'Nguoi B doc sach voi tan suat the nao?','{"A":"Thinh thoang","B":"Moi ngay","C":"Cuoi tuan"}','Moi ngay','Doc sach moi ngay.','multiple_choice',1);
lq($conn,$L4l,'Nguoi B thich doc the loai sach nao?','{"A":"Khoa hoc","B":"Tieu thuyet va lich su","C":"Kinh te"}','Tieu thuyet va lich su','Thich tieu thuyet va lich su.','multiple_choice',2);
lq($conn,$L4l,'Tai sao nguoi B thich doc sach?','{"A":"De kiem tien","B":"De thu duoc kien thuc va thu gian","C":"De ket ban"}','De thu duoc kien thuc va thu gian','Khong nhung co kien thuc ma con thu gian.','multiple_choice',3);
// Exercises L4
$E4_1=e($conn,$L4,'Chon dap an','"不仅...而且..." co nghia la:','multiple_choice','medium',1,'C',1);
eo($conn,$E4_1,'Neu...thi...','A',0,1); eo($conn,$E4_1,'Du...cung...','B',0,2); eo($conn,$E4_1,'Khong nhung...ma con...','C',1,3);
$E4_2=e($conn,$L4,'Dich','"Doc sach khong nhung tang kien thuc ma con lam phong phu cuoc song."','translation','medium',1,'读书不仅可以增长知识，而且可以丰富生活。',2);
$E4_3=e($conn,$L4,'Dien tu','我___中国文化很感兴趣。(voi)','fill_blank','medium',1,'对',3);
$E4_4=e($conn,$L4,'Sap xep cau','不仅 / 知识 / 可以 / 读书 / 增长 / 而且 / 思考 / 可以 / 提高','sentence_order','medium',1,'读书不仅可以增长知识，而且可以提高思考能力。',4);
$E4_5=e($conn,$L4,'Chon dung sai','"从...中..." chi su xuat phat.','true_false','medium',1,'true',5);
eo($conn,$E4_5,'Dung','A',1,1); eo($conn,$E4_5,'Sai','B',0,2);
$E4_6=e($conn,$L4,'Dien tu','从这本书___，我了解了很多中国历史。','fill_blank','medium',1,'中',6);
$E4_7=e($conn,$L4,'Chon dap an','"连...都..." dung de:','multiple_choice','medium',1,'C',7);
eo($conn,$E4_7,'So sanh','A',0,1); eo($conn,$E4_7,'Dieu kien','B',0,2); eo($conn,$E4_7,'Nhan manh truong hop ca biet','C',1,3);
$E4_8=e($conn,$L4,'Dien tu','他对什么___型的书感兴趣？','fill_blank','medium',1,'类',8);
$E4_9=e($conn,$L4,'Chon tu dung','读一本好书就___和一个聪明的朋友聊天。','multiple_choice','medium',1,'C',9);
eo($conn,$E4_9,'是','A',0,1); eo($conn,$E4_9,'像','B',1,2); eo($conn,$E4_9,'一样','C',0,3);
// Review L4
foreach ([$v4_1,$v4_2,$v4_3,$v4_4,$v4_5,$v4_6,$v4_7,$v4_8,$v4_9,$v4_10,$v4_11] as $i=>$vid) if ($vid) rv($conn,$L4,$vid,'core',$i+1);
echo " HSK4 L4 done: $v4 vocab, 4 grammar, 3 dialogues, 1 reading, 1 listening, 9 exercises\n";

// ═══════════════════════════════════════════════════
// HSK4 L5: wei shen me xue Han yu - Tai sao hoc tieng Trung
// ═══════════════════════════════════════════════════
$L5=createLesson($conn,4,5,'Bai 5: Wei shen me xue Han yu - Tai sao hoc tieng Trung','Muc dich hoc tap, cai thien trinh do, giao tiep. Cau truc "weile..." (de...). Cau bi dong "bei".','["Hoc tieng Trung","Muc dich","Giao tiep"]','Hoc tap','medium','HSK4 Bai 5: Tu vung ve viec hoc tieng Trung. Cau truc 为了 (de, vi muc dich). Cau bi dong 被 (bi/duoc). Gioi tu 通过 (thong qua). Cau truc 把 (disposal construction). Cach noi ve trinh do va su tien bo.');
$v5=0;
$v5_1=v($conn,$L5,4,'目的','mudi','muc dich','muc dich','我学习汉语的目的是为了交流。','Wo xuexi Hanyu de mudi shi weile jiaoliu.','Muc dich hoc tieng Trung cua toi la de giao tiep.','noun','Muc tieu nham den.',++$v5);
$v5_2=v($conn,$L5,4,'为了','weile','de, vi (muc dich)','de','为了学好汉语，我每天练习。','Weile xuehao Hanyu, wo meitian lianxi.','De hoc tot tieng Trung, toi luyen tap moi ngay.','prep','Chi muc dich.',++$v5);
$v5_3=v($conn,$L5,4,'提高','tigao','nang cao','nang cao','提高汉语水平。','Tigao Hanyu shuiping.','Nang cao trinh do tieng Trung.','verb','Lam cho cao hon.',++$v5);
$v5_4=v($conn,$L5,4,'交流','jiaoliu','giao tiep','giao tiep','用汉语交流。','Yong Hanyu jiaoliu.','Giao tiep bang tieng Trung.','verb','Trao doi thong tin.',++$v5);
$v5_5=v($conn,$L5,4,'水平','shuiping','trinh do','trinh do','汉语水平提高了。','Hanyu shuiping tigao le.','Trinh do tieng Trung da nang cao.','noun','Trinh do nang luc.',++$v5);
$v5_6=v($conn,$L5,4,'成绩','chengji','thanh tich, diem so','ket qua','考试成绩很好。','Kaoshi chengji hen hao.','Diem thi rat tot.','noun','Ket qua hoc tap.',++$v5);
$v5_7=v($conn,$L5,4,'进步','jinbu','tien bo','tien bo','你的汉语进步很大。','Ni de Hanyu jinbu hen da.','Tieng Trung cua ban tien bo rat lon.','verb/noun','Su tien bo.',++$v5);
$v5_8=v($conn,$L5,4,'方法','fangfa','phuong phap','cach','学习方法很重要。','Xuexi fangfa hen zhongyao.','Phuong phap hoc tap rat quan trong.','noun','Cach thuc hien.',++$v5);
$v5_9=v($conn,$L5,4,'文化','wenhua','van hoa','van hoa','了解中国文化。','Liaojie Zhongguo wenhua.','Hieu van hoa Trung Quoc.','noun','Van hoa xa hoi.',++$v5);
$v5_10=v($conn,$L5,4,'通过','tongguo','thong qua, bang cach','qua','通过练习提高。','Tongguo lianxi tigao.','Thong qua luyen tap de nang cao.','prep','Dung cong cu/phuong tien.',++$v5);
$v5_11=v($conn,$L5,4,'把','ba','(cau truc disposal)','(truc tiep)','请把门关上。','Qing ba men guanshang.','Lam on dong cua lai.','prep','Cau truc xu ly.',++$v5);
// Grammar L5
$g5_1=g($conn,$L5,'Cau truc 为了 + Muc dich','为了 + (Danh tu/Dong tu) + Subject + V','De lam gi / Vi muc dich gi',' 为了 dat o dau cau hoac sau chu ngu de chi muc dich. Khi 为了 o dau cau, thuong co dau phay. Phan biet 因为 (vi - nguyen nhan) va 为了 (de - muc dich).','为了健康，我每天运动 = De suc khoe, toi van dong moi ngay.','Muc dich.',1);
ge($conn,$g5_1,'为了提高汉语水平，我每天和中国朋友聊天。','Weile tigao Hanyu shuiping, wo meitian he Zhongguo pengyou liaotian.','De nang cao trinh do tieng Trung, toi moi ngay noi chuyen voi ban Trung Quoc.',1);
ge($conn,$g5_1,'我学汉语是为了了解中国文化。','Wo xue Hanyu shi weile liaojie Zhongguo wenhua.','Toi hoc tieng Trung la de hieu ve van hoa Trung Quoc.',2);
$g5_2=g($conn,$L5,'Cau bi dong 被','Subject + 被 + (Agent) + V + Complement','Bi / Duoc lam gi',' 被 dung de bieu thi cau bi dong. Agent (nguoi thuc hien) co the duoc bo qua. 被 thuong dung cho su viec khong mong muon.','他被老师批评了 = Anh ay bi co giao phe binh.','Cau bi dong.',2);
ge($conn,$g5_2,'他的努力被大家看到了。','Ta de nuli bei dajia kandao le.','Su co gang cua anh ay da duoc moi nguoi nhin thay.',1);
ge($conn,$g5_2,'这个问题被我们解决了。','Zhe ge wenti bei women jiejue le.','Van de nay da duoc chung toi giai quyet.',2);
$g5_3=g($conn,$L5,'Cau truc 把 (disposal)','Subject + 把 + Object + V + Complement','Xu ly / Tac dong len doi tuong','Cau truc 把 nhan manh tac dong cua chu the len doi tuong, lam doi tuong thay doi trang thai hoac vi tri. Dong tu phai la ngoai dong tu, va phai co bo ngu hoac thanh phan khac sau dong tu.','请把书放在桌子上 = Hay dat sach len ban.','Tac dong len doi tuong.',3);
ge($conn,$g5_3,'请把汉语书打开。','Qing ba Hanyu shu dakai.','Hay mo sach tieng Trung ra.',1);
ge($conn,$g5_3,'我把作业做完了。','Wo ba zuoye zuo wan le.','Toi da lam xong bai tap.',2);
$g5_4=g($conn,$L5,'Cau truc 通过...来...','通过 + Phuong thuc + 来 + Muc dich','Thong qua...de...',' 通过 (tongguo) neu len phuong thuc, cach thuc, 来 (lai) chi muc dich hoac huong toi. Day la cau truc thuong dung trong van viet va noi.','通过练习来提高 = Thong qua luyen tap de nang cao.',4);
ge($conn,$g5_4,'通过和中国朋友交流来提高口语。','Tongguo he Zhongguo pengyou jiaoliu lai tigao kouyu.','Thong qua giao tiep voi ban Trung Quoc de nang cao khau ngu.',1);
ge($conn,$g5_4,'通过多听多说来学习汉语。','Tongguo duo ting duo shuo lai xuexi Hanyu.','Thong qua nghe nhieu noi nhieu de hoc tieng Trung.',2);
// Dialogues L5
$d5_1=d($conn,$L5,'Tai sao hoc tieng Trung','Ban ve muc dich hoc tieng Trung.',1);
ds($conn,$d5_1,'Lan','你学汉语的目的是什么？','Ni xue Hanyu de mudi shi shenme?','Muc dich hoc tieng Trung cua ban la gi?',1);
ds($conn,$d5_1,'Minh','我学汉语是为了去中国旅游时能和当地人交流。','Wo xue Hanyu shi weile qu Zhongguo luyou shi neng he dangdi ren jiaoliu.','Toi hoc tieng Trung la de co the giao tiep voi nguoi dia phuong khi du lich Trung Quoc.',2);
ds($conn,$d5_1,'Lan','我也是。而且通过学汉语，我了解了很多中国文化。','Wo ye shi. Erqie tongguo xue Hanyu, wo liaojie le hen duo Zhongguo wenhua.','Toi cung vay. Hon nua thong qua hoc tieng Trung, toi biet duoc nhieu ve van hoa Trung Quoc.',3);
ds($conn,$d5_1,'Minh','对，我觉得学习语言最好的方法就是多交流。','Dui, wo juede xuexi yuyan zui hao de fangfa jiushi duo jiaoliu.','Dung, toi thay phuong phap hoc ngon ngu tot nhat la giao tiep nhieu.',4);
$d5_2=d($conn,$L5,'Phuong phap hoc tap','Chia se phuong phap hoc tap.',2);
ds($conn,$d5_2,'Lan','你的汉语进步这么快，有什么好方法吗？','Ni de Hanyu jinbu zheme kuai, you shenme hao fangfa ma?','Tieng Trung ban tien bo nhanh vay, co phuong phap hay khong?',1);
ds($conn,$d5_2,'Minh','我每天都会把新学的单词复习一遍。','Wo meitian dou hui ba xin xue de danci fuxi yi bian.','Toi moi ngay deu on lai nhung tu da hoc.',2);
ds($conn,$d5_2,'Lan','还有呢？','Hai you ne?','Con gi nua khong?',3);
ds($conn,$d5_2,'Minh','为了练习听力，我每天听中文播客。','Weile lianxi tingli, wo meitian ting Zhongwen boke.','De luyen nghe, toi moi ngay nghe podcast tieng Trung.',4);
ds($conn,$d5_2,'Lan','我也试试这些方法。','Wo ye shishi zhexie fangfa.','Toi cung thu nhung phuong phap nay.',5);
$d5_3=d($conn,$L5,'Thanh tich hoc tap','Cam nhan ve thanh tich hoc tap.',3);
ds($conn,$d5_3,'Lan','这次HSK考试成绩出来了，我过了四级！','Zhe ci HSK kaoshi chengji chulai le, wo guo le si ji!','Lan nay diem thi HSK da ra, toi do HSK4 roi!',1);
ds($conn,$d5_3,'Minh','恭喜你！你的努力终于被大家看到了。','Gongxi ni! Ni de nuli zhongyu bei dajia kandao le.','Chuc mung ban! Su co gang cua ban cuoi cung da duoc moi nguoi nhin thay.',2);
ds($conn,$d5_3,'Lan','谢谢！我会继续进步的。','Xiexie! Wo hui jixu jinbu de.','Cam on! Toi se tiep tuc tien bo.',3);
ds($conn,$d5_3,'Minh','为了更高的目标，我们一起努力吧。','Weile geng gao de mubiao, women yiqi nuli ba.','De dat duoc muc tieu cao hon, chung ta cung co gang nhe.',4);
ds($conn,$d5_3,'Lan','好！把汉语学得越来越好。','Hao! Ba Hanyu xue de yue lai yue hao.','Tot! Hay hoc tieng Trung ngay cang tot hon.',5);
// Reading L5
r($conn,$L5,'Tai sao toi hoc tieng Trung','我学习汉语已经三年了。很多人问我为什么学汉语。其实我的目的很简单：为了能和中国人交流，为了了解丰富多彩的中国文化。刚开始的时候我觉得汉语很难，特别是声调。但是通过每天坚持练习，我的汉语水平慢慢提高了。我用的方法是多听多说，把学到的单词立刻用在对话中。为了练习口语，我经常和中国朋友聊天。他们的鼓励让我很感动，也让我的进步更快。现在我已经通过了HSK四级，但我不会停止学习。我的下一个目标是通过HSK五级。我相信只要能坚持，就一定能成功。','Wo xuexi Hanyu yijing san nian le. Hen duo ren wen wo wei shenme xue Hanyu. Qishi wo de mudi hen jiandan: weile neng he Zhongguo ren jiaoliu, weile liaojie fengfu duocai de Zhongguo wenhua. Gang kaishi de shihou wo juede Hanyu hen nan, tebie shi shengdiao. Danshi tongguo meitian jianchi lianxi, wo de Hanyu shuiping manman tigao le. Wo yong de fangfa shi duo ting duo shuo, ba xuedao de danci like yong zai duihua zhong. Weile lianxi kouyu, wo jingchang he Zhongguo pengyou liaotian. Tamen de guli rang wo hen gandong, ye rang wo de jinbu geng kuai. Xianzai wo yijing tongguo le HSK si ji, dan wo bu hui tingzhi xuexi. Wo de xia yi ge mubiao shi tongguo HSK wu ji. Wo xiangxin zhiyao neng jianchi, jiu yi ding neng chenggong.','Toi hoc tieng Trung da ba nam roi. Nhieu nguoi hoi toi tai sao hoc tieng Trung. Thuc ra muc dich cua toi rat don gian: de co the giao tiep voi nguoi Trung Quoc, de hieu ve van hoa Trung Quoc phong phu va da dang. Ban dau toi thay tieng Trung rat kho, nhat la thanh dieu. Nhung thong qua kien tri luyen tap moi ngay, trinh do tieng Trung cua toi dan dan nang cao. Phuong phap toi dung la nghe nhieu noi nhieu, ap dung ngay nhung tu da hoc vao hoi thoai. De luyen khau ngu, toi thuong xuyen noi chuyen voi ban Trung Quoc. Su khuyen khich cua ho khien toi rat cam dong, cung giup toi tien bo nhanh hon. Bay gio toi da do HSK4, nhung toi se khong ngung hoc tap. Muc tieu tiep theo cua toi la do HSK5. Toi tin chi can kien tri, nhat dinh se thanh cong.','medium',220,1);
// Listening L5
$L5l=l($conn,$L5,'Hoc tieng Trung','A: Ban hoc tieng Trung bao lau roi? B: Da ba nam roi. A: Tai sao ban bat dau hoc? B: Ban dau la vi toi thich phim Trung Quoc. Nhung sau do toi phat hien hoc tieng Trung con giup toi hieu them ve van hoa. A: Ban co phuong phap hoc nao hay khong? B: Phuong phap cua toi la xem phim Trung Quoc va noi chuyen voi ban Trung Quoc. Qua trinh nay that thu vi.','A: Ni xue Hanyu duo chang shijian le? B: Yi jing san nian le. A: Wei shenme ni kaishi xue de? B: Kaishi shi yinwei wo xihuan Zhongguo dianying. Danshi hou lai wo faxian xue Hanyu hai neng bang wo liaojie wenhua. A: Ni you shenme hao de xuexi fangfa ma? B: Wo de fangfa shi kan Zhongguo dianying he he Zhongguo pengyou jiaoliu. Zhe ge guocheng hen you yisi.','A: Ban hoc tieng Trung bao lau roi? B: Da ba nam roi. A: Tai sao ban bat dau hoc? B: Ban dau la vi toi thich phim Trung Quoc. Nhung sau do toi phat hien hoc tieng Trung con giup toi hieu them ve van hoa. A: Ban co phuong phap hoc nao hay khong? B: Phuong phap cua toi la xem phim Trung Quoc va noi chuyen voi ban Trung Quoc. Qua trinh nay rat thu vi.','1');
lq($conn,$L5l,'Nguoi B da hoc tieng Trung bao lau?','{"A":"1 nam","B":"2 nam","C":"3 nam"}','3 nam','Da hoc ba nam.','multiple_choice',1);
lq($conn,$L5l,'Tai sao ban dau nguoi B hoc tieng Trung?','{"A":"Vi thich phim Trung Quoc","B":"Vi cong viec","C":"Vi ban be"}','Vi thich phim Trung Quoc','Ban dau vi thich phim Trung Quoc.','multiple_choice',2);
lq($conn,$L5l,'Phuong phap hoc cua nguoi B la gi?','{"A":"Doc sach","B":"Xem phim va giao tiep","C":"Hoc thuoc long"}','Xem phim va giao tiep','Xem phim Trung Quoc va noi chuyen voi ban.','multiple_choice',3);
// Exercises L5
$E5_1=e($conn,$L5,'Chon dap an','"为了" chi:','multiple_choice','medium',1,'B',1);
eo($conn,$E5_1,'Nguyen nhan','A',0,1); eo($conn,$E5_1,'Muc dich','B',1,2); eo($conn,$E5_1,'Ket qua','C',0,3);
$E5_2=e($conn,$L5,'Dich','"Toi hoc tieng Trung de hieu ve van hoa Trung Quoc."','translation','medium',1,'我学汉语是为了了解中国文化。',2);
$E5_3=e($conn,$L5,'Dien tu','请把书___在桌子上。(dat)','fill_blank','medium',1,'放',3);
$E5_4=e($conn,$L5,'Sap xep cau','为了 / 汉语 / 提高 / 水平 / 我 / 每天 / 练习','sentence_order','medium',1,'为了提高汉语水平，我每天练习。',4);
$E5_5=e($conn,$L5,'Chon dung sai','"被" dung trong cau bi dong.','true_false','medium',1,'true',5);
eo($conn,$E5_5,'Dung','A',1,1); eo($conn,$E5_5,'Sai','B',0,2);
$E5_6=e($conn,$L5,'Dien tu','我把作业做___了。(xong)','fill_blank','medium',1,'完',6);
$E5_7=e($conn,$L5,'Chon dap an','Cau truc "把" nhan manh:','multiple_choice','medium',1,'C',7);
eo($conn,$E5_7,'Chu the','A',0,1); eo($conn,$E5_7,'Thoi gian','B',0,2); eo($conn,$E5_7,'Tac dong len doi tuong','C',1,3);
$E5_8=e($conn,$L5,'Dien tu','通___多练习来提高口语。(qua)','fill_blank','medium',1,'过',8);
$E5_9=e($conn,$L5,'Chon tu dung','他的努力___大家看到了。','multiple_choice','medium',1,'B',9);
eo($conn,$E5_9,'把','A',0,1); eo($conn,$E5_9,'被','B',1,2); eo($conn,$E5_9,'对','C',0,3);
$E5_10=e($conn,$L5,'Dien tu','通过和中国朋友交流___提高口语。','fill_blank','medium',1,'来',10);
// Review L5
foreach ([$v5_1,$v5_2,$v5_3,$v5_4,$v5_5,$v5_6,$v5_7,$v5_8,$v5_9,$v5_10,$v5_11] as $i=>$vid) if ($vid) rv($conn,$L5,$vid,'core',$i+1);
echo " HSK4 L5 done: $v5 vocab, 4 grammar, 3 dialogues, 1 reading, 1 listening, 10 exercises\n";

$conn->exec("SET FOREIGN_KEY_CHECKS=1");
echo "\n HSK4 Lessons 1-5 seeding complete!\n";
