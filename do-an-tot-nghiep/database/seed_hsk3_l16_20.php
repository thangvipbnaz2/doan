<?php
/**
 * HANNGU - HSK3 Content Seeder (Lessons 16-20)
 * HSK Standard Course 3: complex grammar, longer dialogues, intermediate level
 */
require_once __DIR__ . '/seed_helpers.php';
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ═══════════════════════════════════════════════════
// HSK3 L16: 我现在就给你做
// ═══════════════════════════════════════════════════
$L16=createLesson($conn,3,16,'Bai 16: Wo xian zai jiu gei ni zuo - Bay gio toi lam cho ban ngay','Pho tu jiu (nhan manh). Gioi tu gei (cho). V + yixia.','["Nhan manh","Gioi tu gei","Dong tu + yixia"]','Am thuc','medium','HSK3 Bai 16: Pho tu jiu dien ta su nhan manh hoac hanh dong xay ra ngay. Gioi tu gei dung de chi doi tuong nhan hanh dong. V + yixia: lam hanh dong mot chut, nhe nhang. Tu vung: jiu (ngay), gei (cho), zuofan (nau com), tang (canh), weidao (mui vi), haochi (ngon), jiandan (don gian).');
$v16=0;
$v16_1=v($conn,$L16,3,'就','jiu','ngay, lien','ngay','我现在就做。','Wo xianzai jiu zuo.','Toi lam ngay bay gio.','adv','Nhan manh hanh dong ngay lap tuc.',++$v16);
$v16_2=v($conn,$L16,3,'给','gei','cho (gioi tu)','cho','给你做饭。','Gei ni zuofan.','Nau com cho ban.','prep','Chi doi tuong nhan hanh dong.',++$v16);
$v16_3=v($conn,$L16,3,'饭','fan','com, do an','com','吃饭。','Chifan.','An com.','noun','Bua an noi chung.',++$v16);
$v16_4=v($conn,$L16,3,'菜','cai','mon an, rau','mon an','做菜。','Zuo cai.','Nau mon an.','noun','Thuc an, mon an.',++$v16);
$v16_5=v($conn,$L16,3,'汤','tang','canh, sup','canh','一碗汤。','Yi wan tang.','Mot bat canh.','noun','Mon canh.',++$v16);
$v16_6=v($conn,$L16,3,'好吃','haochi','ngon','ngon','很好吃。','Hen haochi.','Rat ngon.','adj','Do an ngon.',++$v16);
$v16_7=v($conn,$L16,3,'简单','jiandan','don gian','don gian','很简单。','Hen jiandan.','Rat don gian.','adj','Khong phuc tap.',++$v16);
$v16_8=v($conn,$L16,3,'马上','mashang','ngay lap tuc','ngay','马上来。','Mashang lai.','Den ngay.','adv','Hanh dong tuc thi.',++$v16);
$v16_9=v($conn,$L16,3,'一会儿','yihuir','mot lat','mot lat','等一会儿。','Deng yihuir.','Doi mot lat.','time','Khoang thoi gian ngan.',++$v16);
$v16_10=v($conn,$L16,3,'做','zuo','lam, nau','lam','做饭。','Zuofan.','Nau com.','verb','Dong tu chung.',++$v16);
// Grammar L16
$g16_1=g($conn,$L16,'Pho tu jiu nhan manh','就 + V','Ngay, lien (nhan manh)','jiu dat truoc dong tu, nhan manh hanh dong xay ra ngay lap tuc hoac khang dinh su chac chan.','Wo xianzai jiu zuo = Toi lam ngay bay gio.','Nhan manh hanh dong ngay.',1);
ge($conn,$g16_1,'我现在就给你做。','Wo xianzai jiu gei ni zuo.','Toi lam cho ban ngay bay gio.',1);
ge($conn,$g16_1,'我马上就回来。','Wo mashang jiu huilai.','Toi se ve ngay.','2');
$g16_2=g($conn,$L16,'Gioi tu gei','给 + Nguoi + V','Lam gi cho ai','gei la gioi tu chi doi tuong nhan hanh dong. Dung truoc dong tu chinh.','Gei ta da dianhua = Goi dien cho anh ay.','Doi tuong nhan hanh dong.',2);
ge($conn,$g16_2,'我给你倒杯茶。','Wo gei ni dao bei cha.','Toi rot cho ban mot tach tra.',1);
ge($conn,$g16_2,'妈妈给我做了晚饭。','Mama gei wo zuo le wanfan.','Me nau bua toi cho toi.','2');
$g16_3=g($conn,$L16,'V + yixia','V + 一下','Lam mot chut / mot lat','yixia sau dong tu lam nhe hanh dong, the hien su lich su hoac thoi gian ngan.','Qing kan yixia = Lam on xem mot chut.','Lam nhe hanh dong.',3);
ge($conn,$g16_3,'你等一下，我马上就来。','Ni deng yixia, wo mashang jiu lai.','Ban doi mot lat, toi den ngay.',1);
ge($conn,$g16_3,'请帮我一下。','Qing bang wo yixia.','Lam on giup toi mot chut.','2');
// Dialogues L16
$d16_1=d($conn,$L16,'Nau com cho khach','Nau com moi khach.',1);
ds($conn,$d16_1,'Anna','我饿了，有什么吃的吗？','Wo e le, you shenme chi de ma?','Toi doi roi, co gi an khong?',1);
ds($conn,$d16_1,'Xiao Ming','你想吃什么？我现在就给你做。','Ni xiang chi shenme? Wo xianzai jiu gei ni zuo.','Ban muon an gi? Toi nau cho ban ngay.','2');
ds($conn,$d16_1,'Anna','太麻烦你了。做个简单的菜就好。','Tai mafan ni le. Zuo ge jiandan de cai jiu hao.','Phien ban qua. Lam mon don gian thoi.',3);
ds($conn,$d16_1,'Xiao Ming','不麻烦，马上就好。你先等一下。','Bu mafan, mashang jiu hao. Ni xian deng yixia.','Khong phien, xong ngay. Ban doi mot lat.','4');
$d16_2=d($conn,$L16,'Thu mon an','Nau canh va nem thu.',2);
ds($conn,$d16_2,'Anna','你做的汤真好吃！','Ni zuo de tang zhen haochi!','Canh ban nau ngon qua!',1);
ds($conn,$d16_2,'Xiao Ming','是吗？我尝尝。还可以。','Shi ma? Wo changchang. Hai keyi.','The a? Toi nem thu. Cung duoc.','2');
ds($conn,$d16_2,'Anna','你能教我做吗？','Ni neng jiao wo zuo ma?','Ban co the day toi nau khong?',3);
ds($conn,$d16_2,'Xiao Ming','当然可以。下次我给你做，你学着做。','Dangran keyi. Xia ci wo gei ni zuo, ni xue zhe zuo.','Duong nhien duoc. Lan sau toi nau, ban hoc nhe.','4');
// Reading L16
r($conn,$L16,'Bua toi ngon','今天朋友来我家做客。她说饿了，我马上就给她做饭。我做了三菜一汤。菜很简单，但是味道很好。朋友说很好吃，问我怎么做的。我教了她一下。她说以后也要给我做饭。吃完饭以后，我们一起看了一会儿电视。朋友说今天很感谢我，我说不用客气。','Jintian pengyou lai wo jia zuoke. Ta shuo e le, wo mashang jiu gei ta zuofan. Wo zuo le san cai yi tang. Cai hen jiandan, danshi weidao hen hao. Pengyou shuo hen haochi, wen wo zenme zuo de. Wo jiao le ta yixia. Ta shuo yihou ye yao gei wo zuofan. Chi wan fan yihou, women yiqi kan le yihuir dianshi. Pengyou shuo jintian hen ganxie wo, wo shuo buyong keqi.','Hom nay ban den nha toi choi. Co ay noi doi, toi lien nau com cho co ay. Toi nau ba mon mot canh. Mon an rat don gian nhung mui vi rat ngon. Ban toi noi rat ngon, hoi toi nau the nao. Toi chi co ay mot chut. Co ay noi sau nay cung se nau cho toi. An xong chung toi cung xem TV mot lat. Ban toi noi hom nay rat cam on toi, toi noi khong can khach sao.','medium',150,1);
// Listening L16
$L16l=l($conn,$L16,'Nau an','A:我饿了。B:我给你做饭吧。A:做什么？B:做个汤和炒鸡蛋。很简单。A:好，我等你。马上就好。B:对，一会儿就好。','A:Wo e le. B:Wo gei ni zuofan ba. A:Zuo shenme? B:Zuo ge tang he chao jidan. Hen jiandan. A:Hao, wo deng ni. Mashang jiu hao. B:Dui, yihuir jiu hao.','A:Toi doi roi. B:Toi nau com cho ban nhe. A:Nau gi? B:Nau canh va trung ran. Rat don gian. A:Duoc, toi doi ban. Xong ngay. B:Pha, mot lat la xong.','1');
lq($conn,$L16l,'Nguoi B se nau gi?','{"A":"Com rang","B":"Canh va trung","C":"Thit kho"}','Canh va trung','Nau canh va trung ran.','multiple_choice',1);
lq($conn,$L16l,'Mon an do the nao?','{"A":"Kho lam","B":"Don gian","C":"Cau ky"}','Don gian','Rat don gian.','multiple_choice',2);
// Exercises L16
$E16_1=e($conn,$L16,'Chon dap an','jiu trong cau Wo xianzai jiu zuo co nghia la:','multiple_choice','medium',1,'A',1);
eo($conn,$E16_1,'Ngay, lien','A',1,1); eo($conn,$E16_1,'Sau nay','B',0,2); eo($conn,$E16_1,'Thuong xuyen','C',0,3);
$E16_2=e($conn,$L16,'Dich','Toi nau com cho ban ngay bay gio.','translation','medium',1,'我现在就给你做。',2);
$E16_3=e($conn,$L16,'Dien tu','我___你倒杯茶。(cho)','fill_blank','medium',1,'给',3);
$E16_4=e($conn,$L16,'Sap xep cau','做 / 给 / 你 / 我 / 就 / 现在','sentence_order','medium',1,'我现在就给你做。',4);
$E16_5=e($conn,$L16,'Chon dung sai','V + yixia dung de lam nhe hanh dong.','true_false','medium',1,'true',5);
eo($conn,$E16_5,'Dung','A',1,1); eo($conn,$E16_5,'Sai','B',0,2);
$E16_6=e($conn,$L16,'Dien tu','请等一___。(mot lat)','fill_blank','medium',1,'下',6);
$E16_7=e($conn,$L16,'Chon dap an','Cau nao dung gei?','multiple_choice','medium',1,'B',7);
eo($conn,$E16_7,'我给一杯茶。','A',0,1); eo($conn,$E16_7,'我给你倒杯茶。','B',1,2); eo($conn,$E16_7,'我倒给茶你。','C',0,3);
// Review L16
foreach ([$v16_1,$v16_2,$v16_3,$v16_4,$v16_5,$v16_6,$v16_7,$v16_8,$v16_9,$v16_10] as $i=>$vid) if ($vid) rv($conn,$L16,$vid,'core',$i+1);
echo " HSK3 L16 done: $v16 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L17: 我们俩谁都不认识谁
// ═══════════════════════════════════════════════════
$L17=createLesson($conn,3,17,'Bai 17: Wo men lia shui dou bu ren shi shui - Hai dua chung toi chang ai biet ai','Dai tu nghi van + dou/ye. Tu any. Phan biet bieren va ziji.','["Phu dinh toan the","Dai tu","Phan biet nguoi khac"]','Giao tiep','medium','HSK3 Bai 17: Cau truc phu dinh toan the: shei + dou/ye + bu/mei. Shei cung co the lam tan ngu: dou bu renshi shei. Tu renhe + N + dou (bat ky ai/cai gi cung). Phan biet bieren (nguoi khac) va ziji (ban than). Tu vung: lia (hai dua), shei (ai), renshi (quen), mingzi (ten), huxiang (lan nhau), bieren (nguoi khac), ziji (ban than).');
$v17=0;
$v17_1=v($conn,$L17,3,'俩','lia','hai dua, hai nguoi','hai dua','我们俩。','Women lia.','Hai dua chung toi.','num','Chi hai nguoi, khong dung cho vat.',++$v17);
$v17_2=v($conn,$L17,3,'谁','shei/shui','ai','ai','谁来了？','Shei lai le?','Ai den the?','pron','Dai tu nghi van chi nguoi.',++$v17);
$v17_3=v($conn,$L17,3,'都','dou','deu, tat ca','deu','都不知道。','Dou bu zhidao.','Deu khong biet.','adv','Pho tu chi toan bo.',++$v17);
$v17_4=v($conn,$L17,3,'任何','renhe','bat ky, bat cu','bat ky','任何人都可以。','Renhe ren dou keyi.','Bat ky ai cung duoc.','adj','Di voi dou/ye.',++$v17);
$v17_5=v($conn,$L17,3,'别人','bieren','nguoi khac','nguoi khac','问别人。','Wen bieren.','Hoi nguoi khac.','noun','Chi nguoi ngoai.',++$v17);
$v17_6=v($conn,$L17,3,'自己','ziji','ban than, tu minh','ban than','我自己做。','Wo ziji zuo.','Toi tu lam.','pron','Chi chinh minh.',++$v17);
$v17_7=v($conn,$L17,3,'名字','mingzi','ten','ten','你叫什么名字？','Ni jiao shenme mingzi?','Ban ten la gi?','noun','Ten goi cua nguoi.',++$v17);
$v17_8=v($conn,$L17,3,'认识','renshi','quen biet','quen','认识你很高兴。','Renshi ni hen gaoxing.','Rat vui duoc quen ban.','verb','Quen biet lan dau.',++$v17);
$v17_9=v($conn,$L17,3,'互相','huxiang','lan nhau','lan nhau','互相帮助。','Huxiang bangzhu.','Giup do lan nhau.','adv','Quan he hai chieu.',++$v17);
// Grammar L17
$g17_1=g($conn,$L17,'Dai tu nghi van + dou/ye + phu dinh','谁/什么/哪儿 + 都/也 + 不/没','Khong ai/cai gi/dau ca','Dai tu nghi van ket hop voi dou/ye va phu dinh de dien ta y phu dinh toan the: khong mot ai.','Shei dou bu zhidao = Khong ai biet.','Phu dinh toan the.',1);
ge($conn,$g17_1,'我们俩谁都不认识谁。','Women lia shei dou bu renshi shei.','Hai dua chung toi chang ai biet ai.',1);
ge($conn,$g17_1,'我哪儿都不想去。','Wo nar dou bu xiang qu.','Toi chang muon di dau ca.','2');
$g17_2=g($conn,$L17,'Cau truc renhe + N + dou','任何 + N + 都 + V','Bat ky... cung...','renhe + danh tu chi bat ky ai/vat gi, ket hop voi dou de nhan manh tinh toan the.','Renhe ren dou keyi = Bat ky ai cung duoc.','Bat ky ai/vat gi.',2);
ge($conn,$g17_2,'任何人都可以参加。','Renhe ren dou keyi canjia.','Bat ky ai cung co the tham gia.',1);
ge($conn,$g17_2,'任何问题都可以问。','Renhe wenti dou keyi wen.','Bat ky van de gi cung co the hoi.','2');
$g17_3=g($conn,$L17,'Phan biet bieren va ziji','别人 vs 自己','Nguoi khac vs ban than','bieren chi nguoi khac, khong phai minh. ziji chi chinh ban than minh. Co the dat truoc hoac sau dong tu.','Bieren shuo = Nguoi khac noi. Ziji zuo = Tu minh lam.','Nguoi khac va ban than.',3);
ge($conn,$g17_3,'别管别人怎么说。','Bie guan bieren zenme shuo.','Dung quan tam nguoi khac noi gi.',1);
ge($conn,$g17_3,'自己的事情自己做。','Ziji de shiqing ziji zuo.','Viec cua minh tu minh lam.','2');
// Dialogues L17
$d17_1=d($conn,$L17,'Gap mat lan dau','Hai nguoi moi quen.',1);
ds($conn,$d17_1,'Anna','你好！你叫什么名字？','Ni hao! Ni jiao shenme mingzi?','Chao ban! Ban ten gi?',1);
ds($conn,$d17_1,'Xiao Ming','我叫小明。你呢？','Wo jiao Xiao Ming. Ni ne?','Toi ten Tieu Minh. Con ban?','2');
ds($conn,$d17_1,'Anna','我叫安娜。很高兴认识你。','Wo jiao Anna. Hen gaoxing renshi ni.','Toi ten Anna. Rat vui duoc quen ban.','3');
ds($conn,$d17_1,'Xiao Ming','我也是。以后我们互相帮助吧。','Wo ye shi. Yihou women huxiang bangzhu ba.','Toi cung vay. Sau nay chung ta giup do lan nhau nhe.','4');
$d17_2=d($conn,$L17,'Khong biet ai ca','Trong buoi tiec khong quen ai.',2);
ds($conn,$d17_2,'Anna','这个聚会的人你认识吗？','Zhe ge juhui de ren ni renshi ma?','Nhung nguoi o buoi tiec nay ban quen khong?',1);
ds($conn,$d17_2,'Xiao Ming','谁都不认识。','Shei dou bu renshi.','Chang quen ai ca.','2');
ds($conn,$d17_2,'Anna','我也是。我们问别人吧。','Wo ye shi. Women wen bieren ba.','Toi cung vay. Chung ta hoi nguoi khac di.','3');
ds($conn,$d17_2,'Xiao Ming','不用问，我们自己聊聊吧。','Bu yong wen, women ziji liao liao ba.','Khong can hoi, chung ta tu noi chuyen di.','4');
$d17_3=d($conn,$L17,'Bat ky ai cung duoc','Hoi ve nguoi co the giup.',3);
ds($conn,$d17_3,'Anna','谁能帮我搬一下桌子？','Shei neng bang wo ban yixia zhuozi?','Ai co the giup toi chuyen ban mot chut?',1);
ds($conn,$d17_3,'Xiao Ming','任何人都可以帮你。','Renhe ren dou keyi bang ni.','Bat ky ai cung co the giup ban.','2');
ds($conn,$d17_3,'Anna','那你帮我一下吧。','Na ni bang wo yixia ba.','Vay ban giup toi mot chut di.','3');
// Reading L17
r($conn,$L17,'Buoi gap mat','昨天我去参加一个聚会。到了以后发现谁都不认识。我一个人都不认识，觉得很尴尬。后来有一个叫小王的走过来跟我说话。我们互相介绍了自己的名字。聊了一会儿发现我们俩有很多共同爱好。任何话题我们都能聊。最后我们成了好朋友。别人都说我们很像。我觉得认识新朋友其实没有那么难。','Zuotian wo qu canjia yi ge juhui. Dao le yihou faxian shei dou bu renshi. Wo yi ge ren dou bu renshi, juede hen ganga. Houlai you yi ge jiao Xiao Wang de zou guolai gen wo shuohua. Women huxiang jieshao le ziji de mingzi. Liao le yihuir faxian women lia you hen duo gongtong aihao. Renhe huati dou keyi liao. Zuihou women cheng le hao pengyou. Bieren dou shuo women hen xiang. Wo juede renshi xin pengyou qishi meiyou name nan.','Hom qua toi di du mot buoi tiec. Den noi moi phat hien chang quen ai ca. Toi chang quen mot ai, cam thay rat nguong. Sau do co mot nguoi ten Tieu Vuong den noi chuyen voi toi. Chung toi gioi thieu ten cua minh cho nhau. Noi chuyen mot lat phat hien hai dua co nhieu so thich chung. Bat ky chu de gi cung co the noi. Cuoi cung chung toi thanh ban tot. Nguoi khac deu noi chung toi rat giong nhau. Toi thay rang ket ban moi thuc ra khong kho nhu vay.','medium',155,1);
// Listening L17
$L17l=l($conn,$L17,'Nguoi moi','A:你认识那些人吗？B:谁都不认识。A:那你怎么来的？B:朋友叫我来的。他说任何人都可以来。A:那我们一起聊聊吧。B:好啊。我先自我介绍一下。','A:Ni renshi naxie ren ma? B:Shei dou bu renshi. A:Na ni zenme lai de? B:Pengyou jiao wo lai de. Ta shuo renhe ren dou keyi lai. A:Na women yiqi liao liao ba. B:Hao a. Wo xian ziwo jieshao yixia.','A:Ban quen nhung nguoi do khong? B:Chang quen ai. A:Vay ban den the nao? B:Ban ru toi den. Anh ay noi bat ky ai cung co the den. A:Vay chung ta cung noi chuyen di. B:Hay. Toi tu gioi thieu truoc nhe.','1');
lq($conn,$L17l,'Nguoi B co quen ai o buoi tiec khong?','{"A":"Co nhieu","B":"Khong ai","C":"Mot nguoi"}','Khong ai','Nguoi B noi shei dou bu renshi.','multiple_choice',1);
lq($conn,$L17l,'Ai co the den buoi tiec?','{"A":"Chi ban","B":"Nguoi quen","C":"Bat ky ai"}','Bat ky ai','Renhe ren dou keyi lai.','multiple_choice',2);
// Exercises L17
$E17_1=e($conn,$L17,'Chon dap an','Cau truc shei dou bu... co nghia la:','multiple_choice','medium',1,'C',1);
eo($conn,$E17_1,'Ai cung biet','A',0,1); eo($conn,$E17_1,'Co nguoi biet','B',0,2); eo($conn,$E17_1,'Khong ai ca','C',1,3);
$E17_2=e($conn,$L17,'Dich','Hai dua chung toi chang ai biet ai.','translation','medium',1,'我们俩谁都不认识谁。',2);
$E17_3=e($conn,$L17,'Dien tu','我___都不认识。(ai)','fill_blank','medium',1,'谁',3);
$E17_4=e($conn,$L17,'Sap xep cau','谁 / 认识 / 都 / 不 / 我们 / 俩','sentence_order','medium',1,'我们俩谁都不认识。',4);
$E17_5=e($conn,$L17,'Chon dung sai','renhe + N + dou co nghia la bat ky... cung.','true_false','medium',1,'true',5);
eo($conn,$E17_5,'Dung','A',1,1); eo($conn,$E17_5,'Sai','B',0,2);
$E17_6=e($conn,$L17,'Dien tu','___都可以参加。(bat ky ai)','fill_blank','medium',1,'任何人',6);
$E17_7=e($conn,$L17,'Chon dap an','bieren la:','multiple_choice','medium',1,'A',7);
eo($conn,$E17_7,'Nguoi khac','A',1,1); eo($conn,$E17_7,'Ban than','B',0,2); eo($conn,$E17_7,'Nguoi than','C',0,3);
// Review L17
foreach ([$v17_1,$v17_2,$v17_3,$v17_4,$v17_5,$v17_6,$v17_7,$v17_8,$v17_9] as $i=>$vid) if ($vid) rv($conn,$L17,$vid,'core',$i+1);
echo " HSK3 L17 done: $v17 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L18: 我相信他们会同意的
// ═══════════════════════════════════════════════════
$L18=createLesson($conn,3,18,'Bai 18: Wo xiang xin ta men hui tong yi de - Toi tin ho se dong y','Bieu thi quan diem. V + cau. Tu hui (se). Dong y.','["Quan diem","Y kien","Du doan"]','Cong viec','medium','HSK3 Bai 18: Cac dong tu bieu thi quan diem: xiangxin (tin), juede (thay rang), renwei (cho rang). Tro tu hui + V: se, se lam gi. Cau truc tongyi (dong y) + yijian/kanfa. Tu vung: xiangxin (tin), tongyi (dong y), juede (thay), renwei (cho rang), kanfa (cach nhin), yijian (y kien), jueding (quyet dinh), canjia (tham gia), huodong (hoat dong), zhongyao (quan trong).');
$v18=0;
$v18_1=v($conn,$L18,3,'相信','xiangxin','tin tuong','tin','我相信你。','Wo xiangxin ni.','Toi tin ban.','verb','Tin ai do, tin tuong.',++$v18);
$v18_2=v($conn,$L18,3,'同意','tongyi','dong y','dong y','我同意。','Wo tongyi.','Toi dong y.','verb','Dong y voi ai/cai gi.',++$v18);
$v18_3=v($conn,$L18,3,'觉得','juede','thay, cam thay','thay','觉得很好。','Juede hen hao.','Thay rat tot.','verb','Chu quan cam thay.',++$v18);
$v18_4=v($conn,$L18,3,'认为','renwei','cho rang','cho rang','我认为不对。','Wo renwei bu dui.','Toi cho rang khong dung.','verb','Quan diem ca nhan.',++$v18);
$v18_5=v($conn,$L18,3,'看法','kanfa','cach nhin, quan diem','quan diem','有不同的看法。','You butong de kanfa.','Co cach nhin khac nhau.','noun','Y kien ca nhan.',++$v18);
$v18_6=v($conn,$L18,3,'意见','yijian','y kien','y kien','提意见。','Ti yijian.','Dua ra y kien.','noun','Y kien, de xuat.',++$v18);
$v18_7=v($conn,$L18,3,'决定','jueding','quyet dinh','quyet dinh','决定了。','Jueding le.','Da quyet dinh roi.','verb','Dua ra quyet dinh.',++$v18);
$v18_8=v($conn,$L18,3,'参加','canjia','tham gia','tham gia','参加活动。','Canjia huodong.','Tham gia hoat dong.','verb','Tham gia vao gi.',++$v18);
$v18_9=v($conn,$L18,3,'活动','huodong','hoat dong','hoat dong','学校活动。','Xuexiao huodong.','Hoat dong cua truong.','noun','Su kien, sinh hoat.',++$v18);
$v18_10=v($conn,$L18,3,'重要','zhongyao','quan trong','quan trong','很重要。','Hen zhongyao.','Rat quan trong.','adj','Co y nghia lon.',++$v18);
// Grammar L18
$g18_1=g($conn,$L18,'Dong tu bieu thi quan diem + cau','相信/觉得/认为 + Cau','Tin/Thay/Cho rang...','Cac dong tu nay co the mang mot menh de lam tan ngu, dien ta y kien chu quan.','Wo xiangxin ta hui lai = Toi tin anh ay se den.','Bieu thi quan diem.',1);
ge($conn,$g18_1,'我相信他们会同意的。','Wo xiangxin tamen hui tongyi de.','Toi tin ho se dong y.',1);
ge($conn,$g18_1,'我觉得这个主意不错。','Wo juede zhe ge zhuyi bu cuo.','Toi thay y kien nay khong te.','2');
$g18_2=g($conn,$L18,'Tro tu hui + V','会 + V','Se lam gi (du doan / tuong lai)','hui dung truoc dong tu de dien ta su viec se xay ra trong tuong lai hoac du doan. Khac voi neng (co the).','Ta hui lai = Anh ay se den.','Du doan tuong lai.',2);
ge($conn,$g18_2,'明天会下雨吗？','Mingtian hui xia yu ma?','Ngay mai se mua khong?',1);
ge($conn,$g18_2,'我相信他会来的。','Wo xiangxin ta hui lai de.','Toi tin anh ay se den.','2');
$g18_3=g($conn,$L18,'Cau truc dong y + y kien','同意 + (V) + 看法/意见','Dong y voi...','tongyi (dong y) co the di kem kanfa (cach nhin) hoac yijian (y kien). Thuong dung trong thao luan, hop.','Wo tongyi ni de kanfa = Toi dong y voi cach nhin cua ban.','Dong y voi y kien.',3);
ge($conn,$g18_3,'我同意你的看法。','Wo tongyi ni de kanfa.','Toi dong y voi cach nhin cua ban.',1);
ge($conn,$g18_3,'大家同意这个决定吗？','Dajia tongyi zhe ge jueding ma?','Moi nguoi dong y voi quyet dinh nay khong?','2');
// Dialogues L18
$d18_1=d($conn,$L18,'Ban ke hoach','Ban ke hoach hoat dong.',1);
ds($conn,$d18_1,'Anna','你觉得这个计划怎么样？','Ni juede zhe ge jihua zenme yang?','Ban thay ke hoach nay the nao?',1);
ds($conn,$d18_1,'Xiao Ming','我觉得不错。我相信大家会同意。','Wo juede bu cuo. Wo xiangxin dajia hui tongyi.','Toi thay khong te. Toi tin moi nguoi se dong y.','2');
ds($conn,$d18_1,'Anna','但是还有人没提意见。','Danshi hai you ren mei ti yijian.','Nhung con nguoi chua dua ra y kien.','3');
ds($conn,$d18_1,'Xiao Ming','我们等他们说一下看法吧。','Women deng tamen shuo yixia kanfa ba.','Chung ta doi ho noi quan diem da.','4');
$d18_2=d($conn,$L18,'Quyet dinh quan trong','Thao luan ve quyet dinh.',2);
ds($conn,$d18_2,'Anna','你决定参加明天的活动吗？','Ni jueding canjia mingtian de huodong ma?','Ban quyet dinh tham gia hoat dong ngay mai khong?',1);
ds($conn,$d18_2,'Xiao Ming','我还没决定。你认为重要吗？','Wo hai mei jueding. Ni renwei zhongyao ma?','Toi chua quyet dinh. Ban cho rang quan trong khong?','2');
ds($conn,$d18_2,'Anna','我觉得很重要，你应该参加。','Wo juede hen zhongyao, ni yinggai canjia.','Toi thay rat quan trong, ban nen tham gia.','3');
ds($conn,$d18_2,'Xiao Ming','好，我同意你的看法。我会去的。','Hao, wo tongyi ni de kanfa. Wo hui qu de.','Duoc, toi dong y voi ban. Toi se di.','4');
// Reading L18
r($conn,$L18,'Cuoc hop quan trong','今天公司开了一个重要的会。大家讨论了新项目的计划。每个人都有不同的看法。我觉得计划很好，但是需要更多时间。同事小李认为应该马上开始。经理说大家先提意见，再决定。我相信最后大家会同意一个最好的方案。重要的是一起努力，把工作做好。','Jintian gongsi kai le yi ge zhongyao de hui. Dajia taolun le xin xiangmu de jihua. Meige ren dou you butong de kanfa. Wo juede jihua hen hao, danshi xuyao geng duo shijian. Tongshi Xiao Li renwei yinggai mashang kaishi. Jingli shuo dajia xian ti yijian, zai jueding. Wo xiangxin zuihou dajia hui tongyi yi ge zui hao de fangan. Zhongyao de shi yiqi nuli, ba gongzuo zuo hao.','Hom nay cong ty hop mot cuoc hop quan trong. Moi nguoi thao luan ke hoach du an moi. Moi nguoi deu co cach nhin khac nhau. Toi thay ke hoach rat tot, nhung can nhieu thoi gian hon. Dong nghiep Tieu Ly cho rang nen bat dau ngay. Quan ly noi moi nguoi dua ra y kien truoc, roi quyet dinh. Toi tin cuoi cung moi nguoi se dong y mot phuong an tot nhat. Quan trong la cung nhau co gang, lam tot cong viec.','medium',150,1);
// Listening L18
$L18l=l($conn,$L18,'Y kien','A:你觉得这个活动怎么样？B:我觉得很有意思。A:你同意参加吗？B:同意。我相信很多人也会来。A:那太好了。我们决定周末做。B:好，我会准时到的。','A:Ni juede zhe ge huodong zenme yang? B:Wo juede hen you yisi. A:Ni tongyi canjia ma? B:Tongyi. Wo xiangxin hen duo ren ye hui lai. A:Na tai hao le. Women jueding zhoumo zuo. B:Hao, wo hui zhunshi dao de.','A:Ban thay hoat dong nay the nao? B:Toi thay rat thu vi. A:Ban dong y tham gia khong? B:Dong y. Toi tin nhieu nguoi cung se den. A:The thi qua tot. Chung ta quyet dinh cuoi tuan lam. B:Tot, toi se den dung gio.','1');
lq($conn,$L18l,'Nguoi B thay hoat dong the nao?','{"A":"Chan","B":"Thu vi","C":"Met"}','Thu vi','Thay rat thu vi.','multiple_choice',1);
lq($conn,$L18l,'Nguoi B co tham gia khong?','{"A":"Khong","B":"Chua biet","C":"Co"}','Co','Dong y tham gia.','multiple_choice',2);
// Exercises L18
$E18_1=e($conn,$L18,'Chon dap an','Xiangxin co nghia la:','multiple_choice','medium',1,'B',1);
eo($conn,$E18_1,'Hieu','A',0,1); eo($conn,$E18_1,'Tin','B',1,2); eo($conn,$E18_1,'Nho','C',0,3);
$E18_2=e($conn,$L18,'Dich','Toi tin ho se dong y.','translation','medium',1,'我相信他们会同意的。',2);
$E18_3=e($conn,$L18,'Dien tu','我___他们会来。(tin)','fill_blank','medium',1,'相信',3);
$E18_4=e($conn,$L18,'Sap xep cau','同意 / 会 / 他们 / 相信 / 我','sentence_order','medium',1,'我相信他们会同意的。',4);
$E18_5=e($conn,$L18,'Chon dung sai','hui + V chi hanh dong trong qua khu.','true_false','medium',1,'false',5);
eo($conn,$E18_5,'Dung','A',0,1); eo($conn,$E18_5,'Sai','B',1,2);
$E18_6=e($conn,$L18,'Dien tu','我同意你的___。(cach nhin)','fill_blank','medium',1,'看法',6);
$E18_7=e($conn,$L18,'Chon dap an','Juede khac renwei nhu the nao?','multiple_choice','medium',1,'C',7);
eo($conn,$E18_7,'Khong khac','A',0,1); eo($conn,$E18_7,'Juede manh hon','B',0,2); eo($conn,$E18_7,'Juede chu quan hon','C',1,3);
// Review L18
foreach ([$v18_1,$v18_2,$v18_3,$v18_4,$v18_5,$v18_6,$v18_7,$v18_8,$v18_9,$v18_10] as $i=>$vid) if ($vid) rv($conn,$L18,$vid,'core',$i+1);
echo " HSK3 L18 done: $v18 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L19: 你在这儿签一下字
// ═══════════════════════════════════════════════════
$L19=createLesson($conn,3,19,'Bai 19: Ni zai zhe er qian yi xia zi - Ban ky ten o day','V + yixia (lam nhe). ba + O + V + bo ngu ket qua. ba + O + V + gei + O.','["Ky ten","Thu tuc","Cau truc ba nang cao"]','Cong viec','medium','HSK3 Bai 19: V + yixia dung de lam nhe hanh dong, dac biet trong tinh huong lich su. ba + O + V + bo ngu ket qua (ba zi xie qingchu). ba + O + V + gei + Nguoi (ba hetong di gei ta). Tu vung: qian (ky), zi (chu), hetong (hop dong), tian (dien), biao (bieu), xie (viet), qingchu (ro rang), mingbai (hieu ro).');
$v19=0;
$v19_1=v($conn,$L19,3,'签','qian','ky, ky ten','ky','签字。','Qian zi.','Ky ten.','verb','Ky vao giay to.',++$v19);
$v19_2=v($conn,$L19,3,'字','zi','chu, chu viet','chu','写名字。','Xie mingzi.','Viet ten.','noun','Ky tu van ban.',++$v19);
$v19_3=v($conn,$L19,3,'名字','mingzi','ten','ten','签名字。','Qian mingzi.','Ky ten.','noun','Ten goi.',++$v19);
$v19_4=v($conn,$L19,3,'公司','gongsi','cong ty','cong ty','一家公司。','Yi jia gongsi.','Mot cong ty.','noun','Doanh nghiep.',++$v19);
$v19_5=v($conn,$L19,3,'合同','hetong','hop dong','hop dong','签合同。','Qian hetong.','Ky hop dong.','noun','Van ban thoa thuan.',++$v19);
$v19_6=v($conn,$L19,3,'填','tian','dien (thong tin)','dien','填表。','Tian biao.','Dien vao mau don.','verb','Dien thong tin.',++$v19);
$v19_7=v($conn,$L19,3,'表','biao','mau don, bang bieu','mau don','填表。','Tian biao.','Dien mau don.','noun','Giay to can dien.',++$v19);
$v19_8=v($conn,$L19,3,'写','xie','viet','viet','写清楚。','Xie qingchu.','Viet ro rang.','verb','Viet chu.',++$v19);
$v19_9=v($conn,$L19,3,'清楚','qingchu','ro rang','ro','说清楚。','Shuo qingchu.','Noi ro rang.','adj','De hieu, khong mo ho.',++$v19);
$v19_10=v($conn,$L19,3,'明白','mingbai','hieu ro','hieu','明白了。','Mingbai le.','Da hieu ro.','verb','Hieu ro rang.',++$v19);
// Grammar L19
$g19_1=g($conn,$L19,'V + yixia (lich su)','V + 一下','Lam mot chut / nhe nhang','Trong tinh huong lich su hoac giao tiep hang ngay, yixia lam giam cuong do hanh dong, tao cam giac than thien.','Qian yixia zi = Ky ten mot chut.','Lich su, nhe nhang.',1);
ge($conn,$g19_1,'你在这儿签一下字。','Ni zai zher qian yixia zi.','Ban ky ten o day mot chut.',1);
ge($conn,$g19_1,'请填一下这张表。','Qing tian yixia zhe zhang biao.','Lam on dien mau don nay mot chut.','2');
$g19_2=g($conn,$L19,'ba + O + V + bo ngu ket qua','把 + O + V + 清楚/好/完','Lam cho O tro nen...','Dung ba de nhan manh viec xu ly O dat den trang thai nhat dinh.','Ba zi xie qingchu = Viet chu cho ro rang.','Xu ly O dat ket qua.',2);
ge($conn,$g19_2,'请把你的名字写清楚。','Qing ba ni de mingzi xie qingchu.','Lam on viet ten cua ban cho ro rang.',1);
ge($conn,$g19_2,'我把合同看完了。','Wo ba hetong kan wan le.','Toi da xem xong hop dong roi.','2');
$g19_3=g($conn,$L19,'ba + O + V + gei + Nguoi','把 + O + V + 给 + Nguoi','Dua O cho ai','Cau truc nay nhan manh viec chuyen giao vat cho ai do via hanh dong.','Ba zhe fen wenjian di gei ta = Dua van ban nay cho anh ay.','Chuyen giao cho ai.',3);
ge($conn,$g19_3,'请把这份文件交给他。','Qing ba zhe fen wenjiao jiao gei ta.','Lam on dua van ban nay cho anh ay.',1);
ge($conn,$g19_3,'你把合同递给经理吧。','Ni ba hetong di gei jingli ba.','Ban dua hop dong cho quan ly di.','2');
// Dialogues L19
$d19_1=d($conn,$L19,'Ky hop dong','Ky ket hop dong tai cong ty.',1);
ds($conn,$d19_1,'Anna','王经理，这是合同，请您看一下。','Wang jingli, zhe shi hetong, qing nin kan yixia.','Quan ly Vuong, day la hop dong, moi ngai xem qua a.',1);
ds($conn,$d19_1,'Wang jingli','好，我看一下。...没问题，你在这儿签一下字。','Hao, wo kan yixia... Mei wenti, ni zai zher qian yixia zi.','Tot, toi xem qua... Khong van de, ban ky ten o day mot chut.','2');
ds($conn,$d19_1,'Anna','好的。签在哪里？','Hao de. Qian zai nali?','Vang. Ky o dau a?',3);
ds($conn,$d19_1,'Wang jingli','签在下面，把名字写清楚。','Qian zai xiamian, ba mingzi xie qingchu.','Ky o phia duoi, viet ten cho ro rang.','4');
$d19_2=d($conn,$L19,'Dien mau don','Xin viec phai dien mau don.',2);
ds($conn,$d19_2,'Truong phong','请先填一下这张表。','Qing xian tian yixia zhe zhang biao.','Lam on dien truoc mau don nay.','1');
ds($conn,$d19_2,'Anna','好的。需要填什么？','Hao de. Xuyao tian shenme?','Vang. Can dien gi a?',2);
ds($conn,$d19_2,'Truong phong','把你的名字、地址和电话写清楚。','Ba ni de mingzi, dizhi he dianhua xie qingchu.','Viet ro ten, dia chi va dien thoai cua ban.','3');
ds($conn,$d19_2,'Anna','写好了，给您。','Xie hao le, gei nin.','Viet xong roi, moi ngai.','4');
// Reading L19
r($conn,$L19,'Xin viec','今天我去一家公司面试。到了以后，前台让我先填一下表。我把名字、电话和地址都写清楚了。然后经理让我去办公室谈。经理看了一下我的表，问了我一些问题。最后他说如果没问题，明天就可以来签合同。我听了很高兴。经理让我把合同仔细看一下，明天签字。我觉得这份工作很适合我。','Jintian wo qu yi jia gongsi mianshi. Dao le yihou, qiantai rang wo xian tian yixia biao. Wo ba mingzi, dianhua he dizhi dou xie qingchu le. Ranhou jingli rang wo qu bangongshi tan. Jingli kan le yixia wo de biao, wen le wo yixie wenti. Zuihou ta shuo ruguo mei wenti, mingtian jiu keyi lai qian hetong. Wo ting le hen gaoxing. Jingli rang wo ba hetong zixi kan yixia, mingtian qianzi. Wo juede zhe fen gongzuo hen shihe wo.','Hom nay toi di phong van mot cong ty. Den noi, le tan bao toi dien truoc mau don. Toi viet ro ten, dien thoai va dia chi. Sau do quan ly bao toi vao phong lam noi chuyen. Quan ly xem mau don cua toi, hoi toi mot vai cau hoi. Cuoi cung anh ay noi neu khong co van de, ngay mai co the den ky hop dong. Toi nghe xong rat vui. Quan ly bao toi xem ky hop dong, ngay mai ky. Toi thay cong viec nay rat phu hop voi toi.','medium',160,1);
// Listening L19
$L19l=l($conn,$L19,'Ky ten','A:您好，我来签合同。B:好的，请在这儿签一下名字。A:签在哪儿？B:签在这条线下面。请把名字写清楚。A:好了。还需要做什么？B:再填一下这张表就可以了。','A:Nin hao, wo lai qian hetong. B:Hao de, qing zai zher qian yixia mingzi. A:Qian zai nar? B:Qian zai zhe tiao xian xiamian. Qing ba mingzi xie qingchu. A:Hao le. Hai xuyao zuo shenme? B:Zai tian yixia zhe zhang biao jiu keyi le.','A:Chao anh, toi den ky hop dong. B:Duoc, moi anh ky ten o day. A:Ky o dau? B:Ky ben duong gach nay. Lam on viet ro ten. A:Xong roi. Con can lam gi nua? B:Dien them mau don nay la duoc.','1');
lq($conn,$L19l,'Nguoi A den lam gi?','{"A":"Phong van","B":"Ky hop dong","C":"Nop don"}','Ky hop dong','Den ky hop dong.','multiple_choice',1);
lq($conn,$L19l,'Con can lam gi sau khi ky?','{"A":"Khong gi","B":"Dien them mau don","C":"Tra tien"}','Dien them mau don','Dien them mau don.','multiple_choice',2);
// Exercises L19
$E19_1=e($conn,$L19,'Chon dap an','Qian zi co nghia la:','multiple_choice','medium',1,'B',1);
eo($conn,$E19_1,'Doc sach','A',0,1); eo($conn,$E19_1,'Ky ten','B',1,2); eo($conn,$E19_1,'Viet thu','C',0,3);
$E19_2=e($conn,$L19,'Dich','Ban ky ten o day mot chut.','translation','medium',1,'你在这儿签一下字。',2);
$E19_3=e($conn,$L19,'Dien tu','请你___一下这张表。(dien)','fill_blank','medium',1,'填',3);
$E19_4=e($conn,$L19,'Sap xep cau','签字 / 这儿 / 在 / 你 / 一下','sentence_order','medium',1,'你在这儿签一下字。',4);
$E19_5=e($conn,$L19,'Chon dung sai','yixia lam cho hanh dong tro nen lich su hon.','true_false','medium',1,'true',5);
eo($conn,$E19_5,'Dung','A',1,1); eo($conn,$E19_5,'Sai','B',0,2);
$E19_6=e($conn,$L19,'Dien tu','请把名字写___。(ro rang)','fill_blank','medium',1,'清楚',6);
$E19_7=e($conn,$L19,'Chon dap an','Cau nao dung cau truc ba?','multiple_choice','medium',1,'C',7);
eo($conn,$E19_7,'写清楚你的名字。','A',0,1); eo($conn,$E19_7,'你写清楚名字。','B',0,2); eo($conn,$E19_7,'把你的名字写清楚。','C',1,3);
// Review L19
foreach ([$v19_1,$v19_2,$v19_3,$v19_4,$v19_5,$v19_6,$v19_7,$v19_8,$v19_9,$v19_10] as $i=>$vid) if ($vid) rv($conn,$L19,$vid,'core',$i+1);
echo " HSK3 L19 done: $v19 vocab, 3 grammar, 2 dialogues, 1 reading, 1 listening, 7 exercises\n";

// ═══════════════════════════════════════════════════
// HSK3 L20: 我跟你一起去
// ═══════════════════════════════════════════════════
$L20=createLesson($conn,3,20,'Bai 20: Wo gen ni yiqi qu - Toi di cung voi ban','Gioi tu gen/he. Tu yiqi. Tu tongshi.','["Cung nhau","Gioi tu","Thoi gian dong thoi"]','Giao tiep','medium','HSK3 Bai 20: Gioi tu gen (voi) va he (va, cung) chi su cung nhau. Yiqi (cung nhau) dat truoc V. Tongshi (dong thoi) chi hai hanh dong xay ra cung luc. Tu vung: gen (voi), he (va), yiqi (cung nhau), tongshi (dong thoi), yue (hen), jianmian (gap mat), dianyingyuan (rap chieu phim), gongyuan (cong vien), sanbu (di bo), liaotian (tam su).');
$v20=0;
$v20_1=v($conn,$L20,3,'跟','gen','voi, cung','cung','跟我来。','Gen wo lai.','Di voi toi.','prep','Gioi tu chi cung nhau.',++$v20);
$v20_2=v($conn,$L20,3,'和','he','va, voi','va','我和你。','Wo he ni.','Toi va ban.','conj','Lien tu noi ket.',++$v20);
$v20_3=v($conn,$L20,3,'一起','yiqi','cung nhau','cung','一起去。','Yiqi qu.','Cung nhau di.','adv','Dat truoc dong tu.',++$v20);
$v20_4=v($conn,$L20,3,'同时','tongshi','dong thoi','dong thoi','同时进行。','Tongshi jinxing.','Tien hanh dong thoi.','adv','Cung mot luc.',++$v20);
$v20_5=v($conn,$L20,3,'约','yue','hen, ru','hen','约朋友。','Yue pengyou.','Hen ban.','verb','Hen ai do di dau.',++$v20);
$v20_6=v($conn,$L20,3,'见面','jianmian','gap mat','gap','见面聊聊。','Jianmian liao liao.','Gap nhau noi chuyen.','verb','Phan ly dong tu.',++$v20);
$v20_7=v($conn,$L20,3,'电影院','dianyingyuan','rap chieu phim','rap phim','去电影院。','Qu dianyingyuan.','Di rap chieu phim.','noun','Noi xem phim.',++$v20);
$v20_8=v($conn,$L20,3,'公园','gongyuan','cong vien','cong vien','去公园。','Qu gongyuan.','Di cong vien.','noun','Noi cong cong xanh.',++$v20);
$v20_9=v($conn,$L20,3,'散步','sanbu','di bo, tan bo','di bo','去散步。','Qu sanbu.','Di bo.','verb','Phan ly dong tu.',++$v20);
$v20_10=v($conn,$L20,3,'聊天','liaotian','tam su, noi chuyen','tam su','一起聊天。','Yiqi liaotian.','Cung nhau tam su.','verb','Phan ly dong tu.',++$v20);
// Grammar L20
$g20_1=g($conn,$L20,'Gioi tu gen / he + yiqi','跟/和 + Nguoi + 一起 + V','Cung nhau lam gi','gen va he deu co nghia la voi/cung. yiqi dat truoc dong tu de dien ta hanh dong cung nhau.','Gen pengyou yiqi qu = Cung ban di.','Cung nhau lam gi.',1);
ge($conn,$g20_1,'我跟你一起去。','Wo gen ni yiqi qu.','Toi di cung voi ban.',1);
ge($conn,$g20_1,'我和朋友一起看电影。','Wo he pengyou yiqi kan dianying.','Toi va ban cung xem phim.','2');
$g20_2=g($conn,$L20,'Cau truc yue + Nguoi + V','约 + Nguoi + V','Hen ai lam gi','yue (hen) thuong di kem voi nguoi duoc hen va hanh dong. Co the dung: yue hao = hen truoc.','Yue pengyou kan dianying = Hen ban xem phim.','Hen hoi.',2);
ge($conn,$g20_2,'我约了朋友去看电影。','Wo yue le pengyou qu kan dianying.','Toi hen ban di xem phim.',1);
ge($conn,$g20_2,'我们约好明天见面。','Women yue hao mingtian jianmian.','Chung ta hen gap mat ngay mai.','2');
$g20_3=g($conn,$L20,'Phan biet yiqi va tongshi','一起 + V / 同时 + V','Cung nhau / Dong thoi','yiqi chi hanh dong cung nhau, cung dia diem. tongshi chi hanh dong xay ra cung mot thoi diem, co the khac dia diem.','Yiqi chi fan = Cung nhau an com. Tongshi kaishi = Bat dau dong thoi.','Cung nhau vs dong thoi.',3);
ge($conn,$g20_3,'他们同时到了公司。','Tamen tongshi dao le gongsi.','Ho dong thoi den cong ty.',1);
ge($conn,$g20_3,'我们一边散步一边聊天。','Women yi bian sanbu yi bian liaotian.','Chung ta vua di bo vua tam su.','2');
// Dialogues L20
$d20_1=d($conn,$L20,'Hen ban di choi','Hen ban cung di xem phim.',1);
ds($conn,$d20_1,'Anna','这个周末你想做什么？','Zhe ge zhoumo ni xiang zuo shenme?','Cuoi tuan nay ban muon lam gi?',1);
ds($conn,$d20_1,'Xiao Ming','我想去看电影。你跟我一起去吗？','Wo xiang qu kan dianying. Ni gen wo yiqi qu ma?','Toi muon di xem phim. Ban di cung voi toi khong?','2');
ds($conn,$d20_1,'Anna','好啊！我们约什么时间？','Hao a! Women yue shenme shijian?','Hay! Chung ta hen gio nao?',3);
ds($conn,$d20_1,'Xiao Ming','周六下午三点，在电影院见面。','Zhouliu xiawu san dian, zai dianyingyuan jianmian.','Thu 7 luc 3h chieu, gap o rap chieu phim.','4');
$d20_2=d($conn,$L20,'Di bo trong cong vien','Cung nhau di cong vien.',2);
ds($conn,$d20_2,'Anna','天气真好，我们去公园散步吧。','Tianqi zhen hao, women qu gongyuan sanbu ba.','Thoi tiet dep qua, chung ta di cong vien di bo di.',1);
ds($conn,$d20_2,'Xiao Ming','好，我和你一起去。','Hao, wo he ni yiqi qu.','Tot, toi di cung voi ban.','2');
ds($conn,$d20_2,'Anna','我们可以一边散步一边聊天。','Women keyi yi bian sanbu yi bian liaotian.','Chung ta co the vua di bo vua tam su.','3');
ds($conn,$d20_2,'Xiao Ming','太好了！我很久没去公园了。','Tai hao le! Wo hen jiu mei qu gongyuan le.','Tuyet qua! Toi lau lam khong di cong vien roi.','4');
$d20_3=d($conn,$L20,'Hoc cung nhau','Cung nhau hoc tieng Trung.',3);
ds($conn,$d20_3,'Anna','你什么时候学汉语？','Ni shenme shihou xue Hanyu?','Bao gio ban hoc tieng Trung?',1);
ds($conn,$d20_3,'Xiao Ming','我每天晚上学习。','Wo meitian wanshang xuexi.','Toi moi toi hoc.','2');
ds($conn,$d20_3,'Anna','我们可以一起学吗？','Women keyi yiqi xue ma?','Chung ta co the cung nhau hoc khong?',3);
ds($conn,$d20_3,'Xiao Ming','当然可以！我们同时开始学吧。','Dangran keyi! Women tongshi kaishi xue ba.','Duong nhien duoc! Chung ta bat dau hoc dong thoi nhe.','4');
// Reading L20
r($conn,$L20,'Ngay cuoi tuan vui ve','这个周末我和朋友约好了去公园散步。周六下午，我们在公园门口见面。公园里有很多花和树，空气很好。我们一起散步、聊天，非常开心。朋友说以后每个周末都想跟我一起来。我觉得和朋友一起做事情很有意思。同时，我也决定以后多约朋友出来玩。','Zhe ge zhoumo wo he pengyou yue hao le qu gongyuan sanbu. Zhouliu xiawu, women zai gongyuan menkou jianmian. Gongyuan li you hen duo hua he shu, kongqi hen hao. Women yiqi sanbu, liaotian, feichang kaixin. Pengyou shuo yihou meige zhoumo dou xiang gen wo yiqi lai. Wo juede he pengyou yiqi zuo shiqing hen you yisi. Tongshi, wo ye jueding yihou duo yue pengyou chulai wan.','Cuoi tuan nay toi va ban hen nhau di cong vien di bo. Chieu thu bay, chung toi gap o cong cong vien. Trong cong vien co nhieu hoa va cay, khong khi rat tot. Chung toi cung di bo, tam su, rat vui ve. Ban noi sau nay moi cuoi tuan deu muon di cung voi toi. Toi thay cung ban lam viec gi do rat thu vi. Dong thoi, toi cung quyet dinh sau nay se hen ban ra ngoai choi nhieu hon.','medium',155,1);
// Listening L20
$L20l=l($conn,$L20,'Cung di choi','A:这个周末你有空吗？B:有空。A:我们一起去游泳吧。B:好啊！我跟你一起去。A:再约几个朋友吧。B:可以，我叫他们同时到。','A:Zhe ge zhoumo ni you kong ma? B:You kong. A:Women yiqi qu youyong ba. B:Hao a! Wo gen ni yiqi qu. A:Zai yue ji ge pengyou ba. B:Keyi, wo jiao tamen tongshi dao.','A:Cuoi tuan nay ban ranh khong? B:Ranh. A:Chung ta cung di boi di. B:Hay! Toi di cung voi ban. A:Ru them vai nguoi ban nhe. B:Duoc, toi bao ho den dong thoi.','1');
lq($conn,$L20l,'Ho du dinh lam gi cuoi tuan?','{"A":"Xem phim","B":"Di boi","C":"Di cong vien"}','Di boi','Cung nhau di boi.','multiple_choice',1);
lq($conn,$L20l,'Nguoi B se di cung ai?','{"A":"Mot minh","B":"Cung ban A","C":"Dong nghiep"}','Cung ban A','Di cung voi ban A.','multiple_choice',2);
// Exercises L20
$E20_1=e($conn,$L20,'Chon dap an','Gen trong cau Wo gen ni yiqi qu co nghia la:','multiple_choice','medium',1,'B',1);
eo($conn,$E20_1,'Cho','A',0,1); eo($conn,$E20_1,'Cung voi','B',1,2); eo($conn,$E20_1,'Tu','C',0,3);
$E20_2=e($conn,$L20,'Dich','Toi di cung voi ban.','translation','medium',1,'我跟你一起去。',2);
$E20_3=e($conn,$L20,'Dien tu','我___你一起去。(cung)','fill_blank','medium',1,'跟',3);
$E20_4=e($conn,$L20,'Sap xep cau','一起 / 你 / 去 / 跟 / 我','sentence_order','medium',1,'我跟你一起去。',4);
$E20_5=e($conn,$L20,'Chon dung sai','yiqi chi hanh dong cung nhau cung dia diem.','true_false','medium',1,'true',5);
eo($conn,$E20_5,'Dung','A',1,1); eo($conn,$E20_5,'Sai','B',0,2);
$E20_6=e($conn,$L20,'Dien tu','我约了朋友___见面。(gap)','fill_blank','medium',1,'见面',6);
$E20_7=e($conn,$L20,'Chon dap an','Phan biet yiqi va tongshi: cau nao dung?','multiple_choice','medium',1,'A',7);
eo($conn,$E20_7,'他们同时到了。','A',1,1); eo($conn,$E20_7,'他们同时一起去。','B',0,2); eo($conn,$E20_7,'他们同时一起到了。','C',0,3);
// Review L20
foreach ([$v20_1,$v20_2,$v20_3,$v20_4,$v20_5,$v20_6,$v20_7,$v20_8,$v20_9,$v20_10] as $i=>$vid) if ($vid) rv($conn,$L20,$vid,'core',$i+1);
echo " HSK3 L20 done: $v20 vocab, 3 grammar, 3 dialogues, 1 reading, 1 listening, 7 exercises\n";
