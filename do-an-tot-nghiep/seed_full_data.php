<?php
require __DIR__ . '/db.php';
echo "=== HànNgữ Full Data Seeder ===\n\n";
$vc = $conn->query("SELECT COUNT(*) FROM vocab")->fetchColumn();
echo "Existing: $vc vocab\n";
if ($vc > 200) { echo "Already seeded.\n"; exit; }
$conn->exec("SET FOREIGN_KEY_CHECKS=0");

// ── LESSONS ──
$lessons = [
    [1,1,'Chào hỏi cơ bản','Học cách chào hỏi, giới thiệu bản thân.',20,'Câu khẳng định với 是, Câu hỏi với 吗'],
    [1,2,'Gia đình và số đếm','Học về gia đình, số đếm.',20,'Từ chỉ số lượng, Câu hỏi với 几'],
    [1,3,'Thời gian và ngày tháng','Học cách nói về thời gian.',20,'Cách nói thời gian, Câu hỏi với 什么时候'],
    [2,1,'Sinh hoạt hàng ngày','Từ vựng về sinh hoạt hàng ngày.',20,'Động từ trùng điệp, Bổ ngữ kết quả'],
    [2,2,'Mua sắm và ẩm thực','Từ vựng về mua sắm, đồ ăn.',20,'Câu so sánh với 比, 了 thay đổi'],
    [2,3,'Giao thông và du lịch','Từ vựng về phương tiện giao thông.',20,'Câu hỏi với 多+tính từ, 从...到...'],
    [3,1,'Công việc và học tập','Từ vựng về môi trường làm việc.',20,'Bổ ngữ xu hướng, Câu điều kiện 如果'],
    [3,2,'Sức khỏe và thể thao','Từ vựng về sức khỏe, tập luyện.',20,'Bổ ngữ khả năng, So sánh với 没有'],
    [3,3,'Văn hóa và phong tục','Từ vựng về văn hóa, lễ hội Trung Quốc.',20,'Câu bị động 被, Liên từ 虽然...但是...'],
    [4,1,'Xã hội và quan hệ','Từ vựng về các mối quan hệ xã hội.',20,'Câu phức 不仅...而且..., Bổ ngữ xu hướng kép'],
    [4,2,'Khoa học và công nghệ','Từ vựng về khoa học, công nghệ.',20,'Cấu trúc 越...越..., Liên từ 无论...都...'],
    [4,3,'Kinh tế và thương mại','Từ vựng về kinh tế, thị trường.',20,'Cấu trúc 只有...才..., Câu nhấn mạnh 是...的'],
    [5,1,'Báo chí và truyền thông','Đọc hiểu tin tức, bài báo.',20,'Cấu trúc 以...为..., Câu đảo ngữ'],
    [5,2,'Văn học và nghệ thuật','Từ vựng về văn học, nghệ thuật.',20,'Thành ngữ, Cấu trúc 随着...'],
    [5,3,'Môi trường và phát triển','Từ vựng về môi trường, phát triển bền vững.',20,'Cấu trúc 之所以...是因为..., 从而'],
    [6,1,'Triết học và tư tưởng','Từ vựng về triết học, nhân sinh quan.',20,'Cấu trúc văn viết nâng cao, 乃至'],
    [6,2,'Chính trị và ngoại giao','Từ vựng về chính trị, quan hệ quốc tế.',20,'Cấu trúc 鉴于, 据此'],
    [6,3,'Y học và sức khỏe cộng đồng','Từ vựng y học, sức khỏe cộng đồng.',20,'Cấu trúc 可见, 反之'],
];
$lmap = [];
$li = $conn->prepare("INSERT IGNORE INTO lessons (level,lesson_num,title,description,vocab_count,grammar) VALUES (?,?,?,?,?,?)");
foreach ($lessons as $l) {
    $li->execute([$l[0],$l[1],$l[2],$l[3],$l[4],$l[5]]);
    if ($li->rowCount()>0) { $lid = $conn->lastInsertId(); $lmap[$l[0]][$l[1]]=$lid; echo "  Created lesson HSK{$l[0]}-{$l[1]}: {$l[2]} (id=$lid)\n"; }
    else { $chk=$conn->prepare("SELECT id FROM lessons WHERE level=? AND lesson_num=?"); $chk->execute([$l[0],$l[1]]); $lmap[$l[0]][$l[1]]=$chk->fetchColumn(); }
}
function lid($m,$lv,$n) { return $m[$lv][$n]??null; }

// ── VOCAB ──
$vs = $conn->prepare("INSERT IGNORE INTO vocab (hanzi,pinyin,meaning,level,lesson_id,strokes,radical,example,example_vi) VALUES (?,?,?,?,?,?,?,?,?)");
$va = 0;
function av($vs,&$va,$h,$p,$m,$l,$lid,$s,$r,$e,$ev) { try { $vs->execute([$h,$p,$m,$l,$lid,$s,$r,$e,$ev]); $va++; } catch(Exception $x) {} }
// HSK1-L1
av($vs,$va,'你好','nǐ hǎo','xin chào',1,lid($lmap,1,1),7,'亻','你好！很高兴认识你。','Xin chào! Rất vui được quen bạn.');
av($vs,$va,'我','wǒ','tôi, tớ',1,lid($lmap,1,1),7,'戈','我是学生。','Tôi là học sinh.');
av($vs,$va,'你','nǐ','bạn, anh/chị',1,lid($lmap,1,1),7,'亻','你好吗？','Bạn khỏe không?');
av($vs,$va,'他','tā','anh ấy',1,lid($lmap,1,1),5,'亻','他是老师。','Anh ấy là giáo viên.');
av($vs,$va,'她','tā','cô ấy',1,lid($lmap,1,1),6,'女','她是学生。','Cô ấy là học sinh.');
av($vs,$va,'是','shì','là',1,lid($lmap,1,1),9,'日','我是中国人。','Tôi là người Trung Quốc.');
av($vs,$va,'学生','xuéshēng','học sinh',1,lid($lmap,1,1),15,'子','她是好学生。','Cô ấy là học sinh giỏi.');
av($vs,$va,'老师','lǎoshī','giáo viên',1,lid($lmap,1,1),16,'老','王老师好！','Chào thầy Vương!');
av($vs,$va,'叫','jiào','gọi, tên là',1,lid($lmap,1,1),5,'口','你叫什么名字？','Bạn tên là gì?');
av($vs,$va,'名字','míngzì','tên',1,lid($lmap,1,1),12,'口','我的名字是李明。','Tên tôi là Lý Minh.');
av($vs,$va,'什么','shénme','gì, cái gì',1,lid($lmap,1,1),8,'亻','这是什么？','Đây là cái gì?');
av($vs,$va,'谢谢','xièxie','cảm ơn',1,lid($lmap,1,1),13,'讠','谢谢老师！','Cảm ơn thầy!');
av($vs,$va,'不','bù','không',1,lid($lmap,1,1),4,'一','我不是老师。','Tôi không phải giáo viên.');
av($vs,$va,'很','hěn','rất',1,lid($lmap,1,1),9,'彳','我很好。','Tôi rất khỏe.');
av($vs,$va,'也','yě','cũng',1,lid($lmap,1,1),3,'乛','我也是学生。','Tôi cũng là học sinh.');
av($vs,$va,'吗','ma','không (từ hỏi)',1,lid($lmap,1,1),6,'口','你好吗？','Bạn khỏe không?');
av($vs,$va,'再见','zàijiàn','tạm biệt',1,lid($lmap,1,1),11,'一','明天见！','Hẹn gặp lại ngày mai!');
av($vs,$va,'请','qǐng','mời, làm ơn',1,lid($lmap,1,1),10,'讠','请进！','Mời vào!');
av($vs,$va,'好','hǎo','tốt, khỏe',1,lid($lmap,1,1),6,'女','很好！','Rất tốt!');
av($vs,$va,'认识','rènshi','quen biết',1,lid($lmap,1,1),9,'讠','很高兴认识你。','Rất vui được quen bạn.');

// HSK1-L2
av($vs,$va,'一','yī','một',1,lid($lmap,1,2),1,'一','一个学生。','Một học sinh.');
av($vs,$va,'二','èr','hai',1,lid($lmap,1,2),2,'二','二个朋友。','Hai người bạn.');
av($vs,$va,'三','sān','ba',1,lid($lmap,1,2),3,'一','三个苹果。','Ba quả táo.');
av($vs,$va,'四','sì','bốn',1,lid($lmap,1,2),5,'囗','四个杯子。','Bốn cái cốc.');
av($vs,$va,'五','wǔ','năm',1,lid($lmap,1,2),4,'二','五本书。','Năm quyển sách.');
av($vs,$va,'六','liù','sáu',1,lid($lmap,1,2),4,'八','六个人。','Sáu người.');
av($vs,$va,'七','qī','bảy',1,lid($lmap,1,2),2,'一','七天。','Bảy ngày.');
av($vs,$va,'八','bā','tám',1,lid($lmap,1,2),2,'八','八点。','Tám giờ.');
av($vs,$va,'九','jiǔ','chín',1,lid($lmap,1,2),2,'乙','九个星期。','Chín tuần.');
av($vs,$va,'十','shí','mười',1,lid($lmap,1,2),2,'十','十个人。','Mười người.');
av($vs,$va,'家','jiā','nhà, gia đình',1,lid($lmap,1,2),10,'宀','我家有三口人。','Nhà tôi có ba người.');
av($vs,$va,'爸爸','bàba','bố, ba',1,lid($lmap,1,2),8,'父','我爸爸是医生。','Bố tôi là bác sĩ.');
av($vs,$va,'妈妈','māma','mẹ, má',1,lid($lmap,1,2),6,'女','妈妈做饭。','Mẹ nấu cơm.');
av($vs,$va,'哥哥','gēge','anh trai',1,lid($lmap,1,2),10,'口','我哥哥很高。','Anh trai tôi rất cao.');
av($vs,$va,'姐姐','jiějiě','chị gái',1,lid($lmap,1,2),8,'女','姐姐很漂亮。','Chị gái rất xinh.');
av($vs,$va,'妹妹','mèimei','em gái',1,lid($lmap,1,2),8,'女','妹妹五岁。','Em gái 5 tuổi.');
av($vs,$va,'孩子','háizi','đứa trẻ',1,lid($lmap,1,2),9,'子','孩子很可爱。','Đứa trẻ rất đáng yêu.');
av($vs,$va,'岁','suì','tuổi',1,lid($lmap,1,2),6,'山','你几岁？','Bạn mấy tuổi?');
av($vs,$va,'几','jǐ','mấy, vài',1,lid($lmap,1,2),2,'乙','几个人？','Mấy người?');
av($vs,$va,'个','gè','cái (lượng từ)',1,lid($lmap,1,2),3,'亻','一个朋友。','Một người bạn.');

// HSK1-L3
av($vs,$va,'今天','jīntiān','hôm nay',1,lid($lmap,1,3),8,'日','今天星期一。','Hôm nay thứ Hai.');
av($vs,$va,'明天','míngtiān','ngày mai',1,lid($lmap,1,3),8,'日','明天见！','Hẹn mai gặp!');
av($vs,$va,'昨天','zuótiān','hôm qua',1,lid($lmap,1,3),9,'日','昨天是星期天。','Hôm qua là CN.');
av($vs,$va,'年','nián','năm',1,lid($lmap,1,3),6,'干','今年是二零二四年。','Năm nay là 2024.');
av($vs,$va,'月','yuè','tháng, trăng',1,lid($lmap,1,3),4,'月','一月到十二月。','T1 đến T12.');
av($vs,$va,'日','rì','ngày, mặt trời',1,lid($lmap,1,3),4,'日','一月一日。','Ngày 1 T1.');
av($vs,$va,'号','hào','ngày (thông tục)',1,lid($lmap,1,3),5,'口','今天是几号？','Hôm nay ngày mấy?');
av($vs,$va,'星期','xīngqī','tuần',1,lid($lmap,1,3),15,'日','一星期有七天。','Một tuần có 7 ngày.');
av($vs,$va,'现在','xiànzài','bây giờ',1,lid($lmap,1,3),12,'王','现在几点？','Bây giờ mấy giờ?');
av($vs,$va,'点','diǎn','giờ',1,lid($lmap,1,3),9,'灬','现在三点。','Bây giờ 3 giờ.');
av($vs,$va,'分','fēn','phút',1,lid($lmap,1,3),4,'刀','三点十五分。','3 giờ 15 phút.');
av($vs,$va,'半','bàn','rưỡi, nửa',1,lid($lmap,1,3),5,'十','三点半。','3 giờ rưỡi.');
av($vs,$va,'起床','qǐchuáng','thức dậy',1,lid($lmap,1,3),10,'走','我六点起床。','Tôi dậy lúc 6h.');
av($vs,$va,'吃饭','chīfàn','ăn cơm',1,lid($lmap,1,3),12,'口','我们一起吃饭。','Chúng ta cùng ăn.');
av($vs,$va,'睡觉','shuìjiào','đi ngủ',1,lid($lmap,1,3),13,'目','我十点睡觉。','Tôi ngủ lúc 10h.');
av($vs,$va,'上学','shàngxué','đi học',1,lid($lmap,1,3),8,'一','孩子上学了。','Trẻ đi học rồi.');
av($vs,$va,'回家','huíjiā','về nhà',1,lid($lmap,1,3),10,'囗','我五点回家。','Tôi về nhà lúc 5h.');
av($vs,$va,'去','qù','đi (đến)',1,lid($lmap,1,3),5,'土','我去学校。','Tôi đến trường.');
av($vs,$va,'来','lái','đến, lại',1,lid($lmap,1,3),7,'木','朋友来了。','Bạn đến rồi.');
av($vs,$va,'时候','shíhòu','lúc, thời gian',1,lid($lmap,1,3),10,'日','什么时候？','Lúc nào?');
// HSK2-L1
av($vs,$va,'早上','zǎoshang','buổi sáng',2,lid($lmap,2,1),6,'日','早上好！','Chào buổi sáng!');
av($vs,$va,'中午','zhōngwǔ','buổi trưa',2,lid($lmap,2,1),10,'丨','中午吃面。','Trưa ăn mì.');
av($vs,$va,'下午','xiàwǔ','buổi chiều',2,lid($lmap,2,1),8,'一','下午有课。','Chiều có học.');
av($vs,$va,'晚上','wǎnshang','buổi tối',2,lid($lmap,2,1),11,'日','晚上好！','Chào buổi tối!');
av($vs,$va,'每天','měitiān','mỗi ngày',2,lid($lmap,2,1),8,'母','我每天跑步。','Mỗi ngày tôi chạy.');
av($vs,$va,'早饭','zǎofàn','bữa sáng',2,lid($lmap,2,1),12,'食','吃早饭了。','Ăn sáng rồi.');
av($vs,$va,'午饭','wǔfàn','bữa trưa',2,lid($lmap,2,1),12,'食','午饭吃什么？','Trưa ăn gì?');
av($vs,$va,'晚饭','wǎnfàn','bữa tối',2,lid($lmap,2,1),12,'食','晚饭做好了。','Tối xong rồi.');
av($vs,$va,'洗澡','xǐzǎo','tắm rửa',2,lid($lmap,2,1),16,'氵','我洗澡了。','Tôi tắm rồi.');
av($vs,$va,'刷牙','shuāyá','đánh răng',2,lid($lmap,2,1),12,'刂','起床后刷牙。','Dậy đánh răng.');
av($vs,$va,'衣服','yīfu','quần áo',2,lid($lmap,2,1),12,'衤','穿衣服。','Mặc quần áo.');
av($vs,$va,'做饭','zuòfàn','nấu cơm',2,lid($lmap,2,1),12,'食','妈妈做饭。','Mẹ nấu cơm.');
av($vs,$va,'喝茶','hēchá','uống trà',2,lid($lmap,2,1),12,'艹','我喜欢喝茶。','Tôi thích uống trà.');
av($vs,$va,'看电视','kàn diànshì','xem tivi',2,lid($lmap,2,1),13,'田','晚上看电视。','Tối xem tivi.');
av($vs,$va,'看书','kànshū','đọc sách',2,lid($lmap,2,1),10,'⺮','我喜欢看书。','Tôi thích đọc sách.');
av($vs,$va,'工作','gōngzuò','làm việc',2,lid($lmap,2,1),7,'工','我在工作。','Tôi đang làm việc.');
av($vs,$va,'学习','xuéxí','học tập',2,lid($lmap,2,1),15,'子','努力学习。','Học tập chăm chỉ.');
av($vs,$va,'休息','xiūxi','nghỉ ngơi',2,lid($lmap,2,1),12,'亻','休息一下。','Nghỉ một chút.');
av($vs,$va,'散步','sànbù','đi dạo',2,lid($lmap,2,1),7,'止','去散步。','Đi dạo.');
av($vs,$va,'以后','yǐhòu','sau này',2,lid($lmap,2,1),9,'人','以后再说。','Sau này nói.');

// HSK2-L2
av($vs,$va,'水果','shuǐguǒ','hoa quả',2,lid($lmap,2,2),14,'木','吃水果好。','Ăn hoa quả tốt.');
av($vs,$va,'苹果','píngguǒ','táo',2,lid($lmap,2,2),12,'艹','一个苹果。','Một quả táo.');
av($vs,$va,'香蕉','xiāngjiāo','chuối',2,lid($lmap,2,2),12,'艹','香蕉很甜。','Chuối rất ngọt.');
av($vs,$va,'西瓜','xīguā','dưa hấu',2,lid($lmap,2,2),10,'瓜','夏天吃西瓜。','Hè ăn dưa hấu.');
av($vs,$va,'买菜','mǎi cài','mua thức ăn',2,lid($lmap,2,2),12,'冖','我去买菜。','Tôi đi mua đồ.');
av($vs,$va,'超市','chāoshì','siêu thị',2,lid($lmap,2,2),12,'走','去超市买东西。','Đi siêu thị mua đồ.');
av($vs,$va,'商店','shāngdiàn','cửa hàng',2,lid($lmap,2,2),14,'口','商店开门了。','Cửa hàng mở cửa.');
av($vs,$va,'多少钱','duōshǎo qián','bao nhiêu tiền',2,lid($lmap,2,2),10,'夕','多少钱？','Bao nhiêu tiền?');
av($vs,$va,'便宜','piányi','rẻ',2,lid($lmap,2,2),9,'亻','这个很便宜。','Cái này rất rẻ.');
av($vs,$va,'贵','guì','đắt',2,lid($lmap,2,2),9,'贝','太贵了。','Đắt quá.');
av($vs,$va,'咖啡','kāfēi','cà phê',2,lid($lmap,2,2),12,'口','喝咖啡。','Uống cà phê.');
av($vs,$va,'牛奶','niúnǎi','sữa bò',2,lid($lmap,2,2),14,'牜','喝牛奶。','Uống sữa.');
av($vs,$va,'可乐','kělè','cola',2,lid($lmap,2,2),15,'口','一瓶可乐。','Một chai cola.');
av($vs,$va,'蛋糕','dàngāo','bánh ngọt',2,lid($lmap,2,2),16,'米','生日蛋糕。','Bánh sinh nhật.');
av($vs,$va,'面条','miàntiáo','mì sợi',2,lid($lmap,2,2),16,'麦','吃面条。','Ăn mì.');
av($vs,$va,'米饭','mǐfàn','cơm',2,lid($lmap,2,2),12,'米','吃米饭。','Ăn cơm.');
av($vs,$va,'鸡蛋','jīdàn','trứng gà',2,lid($lmap,2,2),13,'鸟','一个鸡蛋。','Một quả trứng.');
av($vs,$va,'肉','ròu','thịt',2,lid($lmap,2,2),6,'肉','吃肉。','Ăn thịt.');
av($vs,$va,'鱼','yú','cá',2,lid($lmap,2,2),8,'鱼','吃鱼。','Ăn cá.');
av($vs,$va,'菜','cài','rau, món ăn',2,lid($lmap,2,2),11,'艹','中国菜。','Món Trung Quốc.');

// HSK2-L3
av($vs,$va,'飞机','fēijī','máy bay',2,lid($lmap,2,3),12,'飞','坐飞机去北京。','Bay đến Bắc Kinh.');
av($vs,$va,'火车','huǒchē','tàu hỏa',2,lid($lmap,2,3),10,'火','坐火车旅行。','Đi tàu du lịch.');
av($vs,$va,'地铁','dìtiě','tàu điện ngầm',2,lid($lmap,2,3),15,'土','坐地铁去公司。','Đi metro đến cty.');
av($vs,$va,'公共汽车','gōnggòng qìchē','xe buýt',2,lid($lmap,2,3),8,'八','坐公共汽车上学。','Đi buýt đến trường.');
av($vs,$va,'自行车','zìxíngchē','xe đạp',2,lid($lmap,2,3),14,'自','骑自行车上班。','Đi xe đạp đi làm.');
av($vs,$va,'出租车','chūzūchē','taxi',2,lid($lmap,2,3),12,'冖','打出租车。','Bắt taxi.');
av($vs,$va,'车站','chēzhàn','bến xe',2,lid($lmap,2,3),13,'立','火车站。','Ga tàu hỏa.');
av($vs,$va,'机场','jīchǎng','sân bay',2,lid($lmap,2,3),12,'木','去机场。','Đến sân bay.');
av($vs,$va,'酒店','jiǔdiàn','khách sạn',2,lid($lmap,2,3),13,'酉','住酒店。','Ở khách sạn.');
av($vs,$va,'旅行','lǚxíng','du lịch',2,lid($lmap,2,3),13,'方','去旅行。','Đi du lịch.');
av($vs,$va,'地图','dìtú','bản đồ',2,lid($lmap,2,3),11,'土','看地图。','Xem bản đồ.');
av($vs,$va,'路','lù','đường',2,lid($lmap,2,3),13,'足','一直走。','Đi thẳng.');
av($vs,$va,'远','yuǎn','xa',2,lid($lmap,2,3),7,'辶','学校很远。','Trường xa.');
av($vs,$va,'近','jìn','gần',2,lid($lmap,2,3),7,'辶','我家很近。','Nhà tôi gần.');
av($vs,$va,'票','piào','vé',2,lid($lmap,2,3),11,'示','买票。','Mua vé.');
av($vs,$va,'钱包','qiánbāo','ví tiền',2,lid($lmap,2,3),14,'金','我的钱包。','Ví của tôi.');
av($vs,$va,'护照','hùzhào','hộ chiếu',2,lid($lmap,2,3),11,'扌','带护照。','Mang hộ chiếu.');
av($vs,$va,'行李','xíngli','hành lý',2,lid($lmap,2,3),12,'行','拿行李。','Xách hành lý.');
av($vs,$va,'旅游','lǚyóu','du lịch',2,lid($lmap,2,3),13,'方','去旅游。','Đi du lịch.');
av($vs,$va,'名胜','míngshèng','danh thắng',2,lid($lmap,2,3),14,'口','看名胜古迹。','Xem danh lam.');

// HSK3-L1
av($vs,$va,'公司','gōngsī','công ty',3,lid($lmap,3,1),8,'八','我在公司工作。','Tôi làm ở công ty.');
av($vs,$va,'办公室','bàngōngshì','văn phòng',3,lid($lmap,3,1),12,'力','办公室很大。','VP rất rộng.');
av($vs,$va,'同事','tóngshì','đồng nghiệp',3,lid($lmap,3,1),14,'口','他是同事。','Anh ấy là đồng nghiệp.');
av($vs,$va,'经理','jīnglǐ','giám đốc',3,lid($lmap,3,1),11,'纟','王经理很忙。','GĐ Vương bận.');
av($vs,$va,'会议','huìyì','cuộc họp',3,lid($lmap,3,1),12,'亻','下午有会议。','Chiều có họp.');
av($vs,$va,'报告','bàogào','báo cáo',3,lid($lmap,3,1),13,'扌','写报告。','Viết báo cáo.');
av($vs,$va,'计划','jìhuà','kế hoạch',3,lid($lmap,3,1),10,'讠','工作计划。','KH công việc.');
av($vs,$va,'项目','xiàngmù','dự án',3,lid($lmap,3,1),13,'工','这个项目重要。','DA này quan trọng.');
av($vs,$va,'经验','jīngyàn','kinh nghiệm',3,lid($lmap,3,1),13,'纟','工作经验。','KN làm việc.');
av($vs,$va,'面试','miànshì','phỏng vấn',3,lid($lmap,3,1),12,'面','去面试。','Đi phỏng vấn.');
av($vs,$va,'工资','gōngzī','lương',3,lid($lmap,3,1),14,'贝','发工资。','Phát lương.');
av($vs,$va,'大学','dàxué','đại học',3,lid($lmap,3,1),11,'大','上大学。','Học đại học.');
av($vs,$va,'专业','zhuānyè','chuyên ngành',3,lid($lmap,3,1),12,'一','专业是什么？','Ngành gì?');
av($vs,$va,'毕业','bìyè','tốt nghiệp',3,lid($lmap,3,1),11,'匕','大学毕业。','TN đại học.');
av($vs,$va,'考试','kǎoshì','thi',3,lid($lmap,3,1),12,'老','通过考试。','Qua kỳ thi.');
av($vs,$va,'成绩','chéngjì','điểm số',3,lid($lmap,3,1),11,'戈','成绩很好。','Điểm tốt.');
av($vs,$va,'奖学金','jiǎngxuéjīn','học bổng',3,lid($lmap,3,1),16,'贝','获得奖学金。','Đạt H Bổng.');
av($vs,$va,'图书馆','túshūguǎn','thư viện',3,lid($lmap,3,1),14,'囗','去图书馆看书。','Đến TV đọc sách.');
av($vs,$va,'作业','zuòyè','bài tập',3,lid($lmap,3,1),7,'亻','做作业。','Làm BT.');
av($vs,$va,'教室','jiàoshì','phòng học',3,lid($lmap,3,1),14,'攵','在教室学习。','Học ở phòng học.');
// HSK3-L2
av($vs,$va,'医院','yīyuàn','bệnh viện',3,lid($lmap,3,2),13,'匸','去医院看病。','Đến BV khám.');
av($vs,$va,'医生','yīshēng','bác sĩ',3,lid($lmap,3,2),12,'匸','看医生。','Khám BS.');
av($vs,$va,'护士','hùshi','y tá',3,lid($lmap,3,2),11,'扌','护士小姐。','Cô y tá.');
av($vs,$va,'生病','shēngbìng','bị ốm',3,lid($lmap,3,2),10,'疒','他生病了。','Anh ấy ốm.');
av($vs,$va,'感冒','gǎnmào','cảm lạnh',3,lid($lmap,3,2),13,'心','我感冒了。','Tôi bị cảm.');
av($vs,$va,'发烧','fāshāo','sốt',3,lid($lmap,3,2),10,'火','发烧了。','Bị sốt.');
av($vs,$va,'头疼','tóuténg','đau đầu',3,lid($lmap,3,2),10,'疒','我头疼。','Tôi đau đầu.');
av($vs,$va,'咳嗽','késou','ho',3,lid($lmap,3,2),14,'口','一直咳嗽。','Ho liên tục.');
av($vs,$va,'药','yào','thuốc',3,lid($lmap,3,2),9,'艹','吃药。','Uống thuốc.');
av($vs,$va,'锻炼','duànliàn','tập luyện',3,lid($lmap,3,2),17,'金','每天锻炼。','Tập luyện mỗi ngày.');
av($vs,$va,'跑步','pǎobù','chạy bộ',3,lid($lmap,3,2),7,'足','早上跑步。','Chạy sáng.');
av($vs,$va,'游泳','yóuyǒng','bơi lội',3,lid($lmap,3,2),12,'氵','去游泳。','Đi bơi.');
av($vs,$va,'足球','zúqiú','bóng đá',3,lid($lmap,3,2),14,'足','踢足球。','Đá bóng.');
av($vs,$va,'篮球','lánqiú','bóng rổ',3,lid($lmap,3,2),14,'竹','打篮球。','Chơi bóng rổ.');
av($vs,$va,'健康','jiànkāng','khỏe mạnh',3,lid($lmap,3,2),14,'亻','身体健康。','SK khỏe.');
av($vs,$va,'体重','tǐzhòng','cân nặng',3,lid($lmap,3,2),13,'亻','控制体重。','Kiểm soát cân.');
av($vs,$va,'运动','yùndòng','vận động',3,lid($lmap,3,2),12,'辶','做运动。','Tập thể thao.');
av($vs,$va,'比赛','bǐsài','thi đấu',3,lid($lmap,3,2),14,'比','足球比赛。','Trận bóng đá.');
av($vs,$va,'身体','shēntǐ','cơ thể',3,lid($lmap,3,2),12,'身','身体好。','Cơ thể khỏe.');
av($vs,$va,'希望','xīwàng','hy vọng',3,lid($lmap,3,2),10,'巾','希望你健康。','Hy vọng bạn khỏe.');

// HSK3-L3
av($vs,$va,'春节','chūnjié','Tết Nguyên đán',3,lid($lmap,3,3),12,'日','春节快乐！','CNM!');
av($vs,$va,'中秋节','zhōngqiū jié','Tết Trung thu',3,lid($lmap,3,3),14,'耒','中秋节吃月饼。','TT ăn bánh.');
av($vs,$va,'红包','hóngbāo','bao lì xì',3,lid($lmap,3,3),10,'纟','给红包。','Tặng lì xì.');
av($vs,$va,'礼物','lǐwù','quà tặng',3,lid($lmap,3,3),10,'礻','送礼物。','Tặng quà.');
av($vs,$va,'传统','chuántǒng','truyền thống',3,lid($lmap,3,3),12,'亻','传统文化。','VH truyền thống.');
av($vs,$va,'习俗','xísú','tập tục',3,lid($lmap,3,3),11,'乙','节日习俗。','Phong tục lễ.');
av($vs,$va,'庆祝','qìngzhù','chúc mừng',3,lid($lmap,3,3),12,'广','庆祝生日。','Mừng sinh nhật.');
av($vs,$va,'灯笼','dēnglóng','lồng đèn',3,lid($lmap,3,3),13,'火','红灯笼。','Lồng đèn đỏ.');
av($vs,$va,'团圆','tuányuán','đoàn tụ',3,lid($lmap,3,3),10,'囗','一家团圆。','Cả nhà sum họp.');
av($vs,$va,'年夜饭','niányèfàn','tất niên',3,lid($lmap,3,3),13,'食','吃年夜饭。','Ăn tất niên.');
av($vs,$va,'饺子','jiǎozi','sủi cảo',3,lid($lmap,3,3),14,'食','包饺子。','Gói sủi cảo.');
av($vs,$va,'对联','duìlián','câu đối',3,lid($lmap,3,3),10,'寸','贴对联。','Dán câu đối.');
av($vs,$va,'文化','wénhuà','văn hóa',3,lid($lmap,3,3),8,'文','中国文化。','VH Trung Quốc.');
av($vs,$va,'历史','lìshǐ','lịch sử',3,lid($lmap,3,3),8,'厂','悠久历史。','LS lâu đời.');
av($vs,$va,'祖先','zǔxiān','tổ tiên',3,lid($lmap,3,3),12,'礻','纪念祖先。','Tưởng niệm TT.');
av($vs,$va,'庙会','miàohuì','hội chùa',3,lid($lmap,3,3),12,'广','去庙会玩。','Đi hội chùa.');
av($vs,$va,'书法','shūfǎ','thư pháp',3,lid($lmap,3,3),14,'⺮','学习书法。','Học thư pháp.');
av($vs,$va,'节日','jiérì','ngày lễ',3,lid($lmap,3,3),12,'艹','节日快乐！','Chúc mừng lễ!');
av($vs,$va,'幸福','xìngfú','hạnh phúc',3,lid($lmap,3,3),10,'土','幸福生活。','Sống HP.');
av($vs,$va,'快乐','kuàilè','vui vẻ',3,lid($lmap,3,3),12,'忄','生日快乐！','SN vui vẻ!');

// HSK4-L1
av($vs,$va,'关系','guānxì','quan hệ',4,lid($lmap,4,1),12,'门','人际关系。','QH người.');
av($vs,$va,'交流','jiāoliú','giao lưu',4,lid($lmap,4,1),13,'亠','文化交流。','GL văn hóa.');
av($vs,$va,'沟通','gōutōng','giao tiếp',4,lid($lmap,4,1),12,'氵','好好沟通。','GT tốt.');
av($vs,$va,'合作','hézuò','hợp tác',4,lid($lmap,4,1),11,'口','合作愉快。','HT vui vẻ.');
av($vs,$va,'信任','xìnrèn','tin tưởng',4,lid($lmap,4,1),10,'亻','互相信任。','Tin tưởng nhau.');
av($vs,$va,'尊重','zūnzhòng','tôn trọng',4,lid($lmap,4,1),12,'寸','尊重别人。','Tôn trọng người.');
av($vs,$va,'礼貌','lǐmào','lịch sự',4,lid($lmap,4,1),11,'礻','有礼貌。','LS sự.');
av($vs,$va,'邀请','yāoqǐng','mời',4,lid($lmap,4,1),12,'辶','邀请朋友。','Mời bạn.');
av($vs,$va,'拜访','bàifǎng','thăm viếng',4,lid($lmap,4,1),11,'访','拜访老师。','Thăm thầy.');
av($vs,$va,'约会','yuēhuì','hẹn hò',4,lid($lmap,4,1),10,'纟','有个约会。','Có hẹn.');
av($vs,$va,'道歉','dàoqiàn','xin lỗi',4,lid($lmap,4,1),12,'辶','向他道歉。','XL anh ấy.');
av($vs,$va,'原谅','yuánliàng','tha thứ',4,lid($lmap,4,1),13,'口','请原谅。','Hãy tha thứ.');
av($vs,$va,'感谢','gǎnxiè','cảm ơn',4,lid($lmap,4,1),13,'心','衷心感谢。','Chân thành cảm ơn.');
av($vs,$va,'友谊','yǒuyì','tình bạn',4,lid($lmap,4,1),8,'又','深厚友谊。','TB sâu sắc.');
av($vs,$va,'邻居','línjū','hàng xóm',4,lid($lmap,4,1),12,'阝','邻居友好。','HX thân thiện.');
av($vs,$va,'性格','xìnggé','tính cách',4,lid($lmap,4,1),10,'忄','性格开朗。','TC cởi mở.');
av($vs,$va,'态度','tàidù','thái độ',4,lid($lmap,4,1),9,'心','学习态度。','Thái độ học.');
av($vs,$va,'帮助','bāngzhù','giúp đỡ',4,lid($lmap,4,1),13,'巾','互相帮助。','Giúp nhau.');
av($vs,$va,'支持','zhīchí','ủng hộ',4,lid($lmap,4,1),7,'扌','支持你！','Ủng hộ bạn!');
av($vs,$va,'关心','guānxīn','quan tâm',4,lid($lmap,4,1),12,'关','关心别人。','QT người khác.');

// HSK4-L2
av($vs,$va,'科技','kējì','khoa học kỹ thuật',4,lid($lmap,4,2),13,'禾','科技进步。','KH tiến bộ.');
av($vs,$va,'网络','wǎngluò','mạng internet',4,lid($lmap,4,2),13,'罓','网络时代。','Thời internet.');
av($vs,$va,'电脑','diànnǎo','máy tính',4,lid($lmap,4,2),13,'田','用电脑。','Dùng MT.');
av($vs,$va,'手机','shǒujī','điện thoại',4,lid($lmap,4,2),9,'扌','用手机上网。','Dùng ĐT lên mạng.');
av($vs,$va,'软件','ruǎnjiàn','phần mềm',4,lid($lmap,4,2),11,'车','下载软件。','Tải PM.');
av($vs,$va,'数据','shùjù','dữ liệu',4,lid($lmap,4,2),13,'攵','收集数据。','Thu thập DL.');
av($vs,$va,'信息','xìnxī','thông tin',4,lid($lmap,4,2),13,'亻','信息时代。','Thời TT.');
av($vs,$va,'人工智能','réngōng zhìnéng','trí tuệ nhân tạo',4,lid($lmap,4,2),14,'人','人工智能技术。','CN AI.');
av($vs,$va,'机器人','jīqìrén','robot',4,lid($lmap,4,2),14,'木','智能机器人。','Robot thông minh.');
av($vs,$va,'网站','wǎngzhàn','website',4,lid($lmap,4,2),13,'亠','访问网站。','Truy cập web.');
av($vs,$va,'搜索','sōusuǒ','tìm kiếm',4,lid($lmap,4,2),13,'扌','搜索信息。','Tìm kiếm TT.');
av($vs,$va,'密码','mìmǎ','mật khẩu',4,lid($lmap,4,2),14,'宀','设置密码。','Đặt MK.');
av($vs,$va,'充电','chōngdiàn','sạc điện',4,lid($lmap,4,2),12,'冫','给手机充电。','Sạc ĐT.');
av($vs,$va,'电池','diànchí','pin',4,lid($lmap,4,2),11,'田','电池没电了。','Hết pin.');
av($vs,$va,'无线','wúxiàn','không dây',4,lid($lmap,4,2),12,'无','无线网络。','WiFi.');
av($vs,$va,'上传','shàngchuán','tải lên',4,lid($lmap,4,2),9,'亻','上传照片。','Tải ảnh lên.');
av($vs,$va,'下载','xiàzài','tải xuống',4,lid($lmap,4,2),10,'一','下载文件。','Tải file xuống.');
av($vs,$va,'博客','bókè','blog',4,lid($lmap,4,2),9,'十','写博客。','Viết blog.');
av($vs,$va,'点击','diǎnjī','click, nhấp',4,lid($lmap,4,2),13,'灬','点击这里。','Click vào đây.');
av($vs,$va,'更新','gēngxīn','cập nhật',4,lid($lmap,4,2),12,'日','更新软件。','CN PM.');

// HSK4-L3
av($vs,$va,'经济','jīngjì','kinh tế',4,lid($lmap,4,3),12,'纟','经济发展。','PT KT.');
av($vs,$va,'市场','shìchǎng','thị trường',4,lid($lmap,4,3),11,'巾','市场经济。','KTTT.');
av($vs,$va,'价格','jiàgé','giá cả',4,lid($lmap,4,3),10,'亻','价格合理。','Giá hợp lý.');
av($vs,$va,'贸易','màoyì','thương mại',4,lid($lmap,4,3),12,'贝','国际贸易。','TM quốc tế.');
av($vs,$va,'投资','tóuzī','đầu tư',4,lid($lmap,4,3),13,'扌','投资未来。','ĐT tương lai.');
av($vs,$va,'利润','lìrùn','lợi nhuận',4,lid($lmap,4,3),12,'禾','获得利润。','Lợi nhuận.');
av($vs,$va,'消费','xiāofèi','tiêu dùng',4,lid($lmap,4,3),11,'氵','消费水平。','Mức TD.');
av($vs,$va,'产品','chǎnpǐn','sản phẩm',4,lid($lmap,4,3),12,'亠','优质产品。','SP chất lượng.');
av($vs,$va,'服务','fúwù','dịch vụ',4,lid($lmap,4,3),12,'月','优质服务。','DV tốt.');
av($vs,$va,'广告','guǎnggào','quảng cáo',4,lid($lmap,4,3),10,'广','打广告。','QC.');
av($vs,$va,'品牌','pǐnpái','thương hiệu',4,lid($lmap,4,3),12,'口','知名品牌。','TH nổi tiếng.');
av($vs,$va,'竞争','jìngzhēng','cạnh tranh',4,lid($lmap,4,3),12,'立','市场竞争。','CT thị trường.');
av($vs,$va,'合同','hétong','hợp đồng',4,lid($lmap,4,3),11,'口','签订合同。','Ký HĐ.');
av($vs,$va,'成本','chéngběn','chi phí',4,lid($lmap,4,3),11,'戈','控制成本。','KS chi phí.');
av($vs,$va,'银行','yínháng','ngân hàng',4,lid($lmap,4,3),14,'金','去银行。','Đến NH.');
av($vs,$va,'贷款','dàikuǎn','vay, khoản vay',4,lid($lmap,4,3),12,'贝','银行贷款。','Vay NH.');
av($vs,$va,'会计','kuàijì','kế toán',4,lid($lmap,4,3),11,'亻','会计工作。','CV kế toán.');
av($vs,$va,'预算','yùsuàn','ngân sách',4,lid($lmap,4,3),14,'页','做预算。','Làm NS.');
av($vs,$va,'收入','shōurù','thu nhập',4,lid($lmap,4,3),11,'攵','月收入。','TN tháng.');
av($vs,$va,'支出','zhīchū','chi tiêu',4,lid($lmap,4,3),10,'支','控制支出。','KS chi tiêu.');
// HSK5-L1
av($vs,$va,'新闻','xīnwén','tin tức',5,lid($lmap,5,1),13,'斤','看新闻。','Xem TT.');
av($vs,$va,'报道','bàodào','đưa tin',5,lid($lmap,5,1),12,'扌','新闻报道。','Tin báo.');
av($vs,$va,'媒体','méitǐ','truyền thông',5,lid($lmap,5,1),12,'女','社交媒体。','MXH.');
av($vs,$va,'采访','cǎifǎng','phỏng vấn',5,lid($lmap,5,1),12,'扌','采访记者。','PV PV.');
av($vs,$va,'编辑','biānjí','biên tập',5,lid($lmap,5,1),15,'纟','编辑文章。','BT bài.');
av($vs,$va,'记者','jìzhě','phóng viên',5,lid($lmap,5,1),14,'讠','新闻记者。','PV tin.');
av($vs,$va,'杂志','zázhì','tạp chí',5,lid($lmap,5,1),13,'木','读杂志。','Đọc TC.');
av($vs,$va,'直播','zhíbō','phát trực tiếp',5,lid($lmap,5,1),15,'氵','看直播。','Xem TT.');
av($vs,$va,'广播','guǎngbō','phát thanh',5,lid($lmap,5,1),15,'广','听广播。','Nghe radio.');
av($vs,$va,'传播','chuánbō','truyền bá',5,lid($lmap,5,1),13,'亻','传播信息。','TB TT.');
av($vs,$va,'标题','biāotí','tiêu đề',5,lid($lmap,5,1),14,'木','文章标题。','TD bài.');
av($vs,$va,'内容','nèiróng','nội dung',5,lid($lmap,5,1),13,'冂','内容丰富。','ND phong phú.');
av($vs,$va,'评论','pínglùn','bình luận',5,lid($lmap,5,1),12,'讠','写评论。','Viết BL.');
av($vs,$va,'观点','guāndiǎn','quan điểm',5,lid($lmap,5,1),12,'丶','不同观点。','Điểm khác.');
av($vs,$va,'事实','shìshí','sự thật',5,lid($lmap,5,1),13,'一','基于事实。','Dựa ST.');
av($vs,$va,'视频','shìpín','video',5,lid($lmap,5,1),14,'见','看视频。','Xem video.');
av($vs,$va,'舆论','yúlùn','dư luận',5,lid($lmap,5,1),14,'言','社会舆论。','DL xã hội.');
av($vs,$va,'渠道','qúdào','kênh',5,lid($lmap,5,1),14,'氵','销售渠道。','Kênh bán.');
av($vs,$va,'影响力','yǐngxiǎnglì','sức ảnh hưởng',5,lid($lmap,5,1),14,'彡','有影响力。','Có AH.');
av($vs,$va,'发布','fābù','phát hành',5,lid($lmap,5,1),9,'又','发布新闻。','PH tin.');

// HSK5-L2
av($vs,$va,'文学','wénxué','văn học',5,lid($lmap,5,2),11,'文','中国文学。','VH TQ.');
av($vs,$va,'诗歌','shīgē','thơ ca',5,lid($lmap,5,2),13,'讠','写诗歌。','Viết thơ.');
av($vs,$va,'小说','xiǎoshuō','tiểu thuyết',5,lid($lmap,5,2),13,'⺮','读小说。','Đọc TT.');
av($vs,$va,'散文','sǎnwén','tản văn',5,lid($lmap,5,2),13,'攵','写散文。','Viết TV.');
av($vs,$va,'画家','huàjiā','họa sĩ',5,lid($lmap,5,2),11,'田','著名画家。','HS nổi tiếng.');
av($vs,$va,'书法家','shūfǎjiā','nhà thư pháp',5,lid($lmap,5,2),14,'⺮','书法家作品。','TP thư pháp.');
av($vs,$va,'创作','chuàngzuò','sáng tác',5,lid($lmap,5,2),12,'刂','文学创作。','ST VH.');
av($vs,$va,'艺术','yìshù','nghệ thuật',5,lid($lmap,5,2),10,'艹','艺术作品。','TP NT.');
av($vs,$va,'古典','gǔdiǎn','cổ điển',5,lid($lmap,5,2),13,'口','古典音乐。','Nhạc CD.');
av($vs,$va,'现代','xiàndài','hiện đại',5,lid($lmap,5,2),13,'王','现代艺术。','NT HĐ.');
av($vs,$va,'博物馆','bówùguǎn','bảo tàng',5,lid($lmap,5,2),16,'十','去博物馆。','Đến BT.');
av($vs,$va,'展览','zhǎnlǎn','triển lãm',5,lid($lmap,5,2),17,'尸','看展览。','Xem TL.');
av($vs,$va,'摄影','shèyǐng','nhiếp ảnh',5,lid($lmap,5,2),15,'扌','摄影作品。','TP NA.');
av($vs,$va,'戏剧','xìjù','kịch',5,lid($lmap,5,2),12,'刂','看戏剧。','Xem kịch.');
av($vs,$va,'审美','shěnměi','thẩm mỹ',5,lid($lmap,5,2),12,'宀','审美能力。','NL TM.');
av($vs,$va,'灵感','línggǎn','cảm hứng',5,lid($lmap,5,2),15,'雨','获得灵感。','Có CH.');
av($vs,$va,'雕塑','diāosù','điêu khắc',5,lid($lmap,5,2),16,'石','雕塑作品。','TP ĐK.');
av($vs,$va,'名著','míngzhù','tác phẩm nổi tiếng',5,lid($lmap,5,2),12,'艹','世界名著。','TP nổi tiếng TG.');
av($vs,$va,'文艺','wényì','văn nghệ',5,lid($lmap,5,2),11,'文','文艺演出。','Biểu diễn VN.');
av($vs,$va,'乐器','yuèqì','nhạc cụ',5,lid($lmap,5,2),14,'⺮','弹乐器。','Chơi nhạc cụ.');

// HSK5-L3
av($vs,$va,'环境','huánjìng','môi trường',5,lid($lmap,5,3),14,'王','保护环境。','BV MT.');
av($vs,$va,'污染','wūrǎn','ô nhiễm',5,lid($lmap,5,3),12,'氵','空气污染。','ÔN KK.');
av($vs,$va,'气候','qìhòu','khí hậu',5,lid($lmap,5,3),13,'气','气候变化。','BĐ KH.');
av($vs,$va,'生态','shēngtài','sinh thái',5,lid($lmap,5,3),10,'生','生态系统。','HST.');
av($vs,$va,'可持续','kěchíxù','bền vững',5,lid($lmap,5,3),12,'口','可持续发展。','PTBV.');
av($vs,$va,'资源','zīyuán','tài nguyên',5,lid($lmap,5,3),13,'贝','自然资源。','TN TN.');
av($vs,$va,'能源','néngyuán','năng lượng',5,lid($lmap,5,3),13,'月','可再生能源。','NL tái tạo.');
av($vs,$va,'太阳能','tàiyángnéng','năng lượng mặt trời',5,lid($lmap,5,3),14,'大','太阳能发电。','NLMT.');
av($vs,$va,'回收','huíshōu','tái chế',5,lid($lmap,5,3),11,'口','垃圾回收。','TC rác.');
av($vs,$va,'减少','jiǎnshǎo','giảm bớt',5,lid($lmap,5,3),12,'冫','减少污染。','Giảm ON.');
av($vs,$va,'排放','páifàng','xả thải',5,lid($lmap,5,3),12,'扌','碳排放。','Khí thải C.');
av($vs,$va,'保护','bǎohù','bảo vệ',5,lid($lmap,5,3),9,'亻','保护大自然。','BV TN.');
av($vs,$va,'森林','sēnlín','rừng',5,lid($lmap,5,3),12,'木','热带森林。','Rừng NĐ.');
av($vs,$va,'绿色','lǜsè','màu xanh',5,lid($lmap,5,3),14,'纟','绿色能源。','NL xanh.');
av($vs,$va,'低碳','dītàn','các-bon thấp',5,lid($lmap,5,3),11,'亻','低碳生活。','Sống carbon thấp.');
av($vs,$va,'物种','wùzhǒng','loài',5,lid($lmap,5,3),12,'牜','濒危物种。','Loài nguy cấp.');
av($vs,$va,'全球变暖','quánqiú biàn nuǎn','ấm lên toàn cầu',5,lid($lmap,5,3),12,'人','全球变暖问题。','VĐ nóng lên T Cầu.');
av($vs,$va,'环保','huánbǎo','bảo vệ môi trường',5,lid($lmap,5,3),12,'王','环保意识。','YT BVMT.');
av($vs,$va,'节能','jiénéng','tiết kiệm năng lượng',5,lid($lmap,5,3),11,'力','节能环保。','TKNL BVMT.');
av($vs,$va,'大自然','dàzìrán','thiên nhiên',5,lid($lmap,5,3),11,'大','爱护大自然。','Yêu TN.');

// HSK6-L1
av($vs,$va,'哲学','zhéxué','triết học',6,lid($lmap,6,1),14,'口','哲学思想。','TT TH.');
av($vs,$va,'思想','sīxiǎng','tư tưởng',6,lid($lmap,6,1),14,'心','儒家思想。','TT Nho.');
av($vs,$va,'价值观','jiàzhíguān','quan niệm giá trị',6,lid($lmap,6,1),15,'亻','价值观不同。','QN GT khác.');
av($vs,$va,'人生观','rénshēngguān','nhân sinh quan',6,lid($lmap,6,1),15,'人','人生观积极。','NSQ tích cực.');
av($vs,$va,'道德','dàodé','đạo đức',6,lid($lmap,6,1),15,'辶','道德标准。','Tiêu chuẩn ĐĐ.');
av($vs,$va,'智慧','zhìhuì','trí tuệ',6,lid($lmap,6,1),14,'日','人生智慧。','TT nhân sinh.');
av($vs,$va,'真理','zhēnlǐ','chân lý',6,lid($lmap,6,1),13,'目','追求真理。','Theo đuổi CL.');
av($vs,$va,'思维','sīwéi','tư duy',6,lid($lmap,6,1),13,'田','思维方式。','PT TD.');
av($vs,$va,'意识','yìshi','ý thức',6,lid($lmap,6,1),13,'心','意识提高。','YT nâng cao.');
av($vs,$va,'存在','cúnzài','tồn tại',6,lid($lmap,6,1),12,'子','存在问题。','VĐ TN.');
av($vs,$va,'本质','běnzhì','bản chất',6,lid($lmap,6,1),11,'木','本质问题。','VĐ BC.');
av($vs,$va,'现象','xiànxiàng','hiện tượng',6,lid($lmap,6,1),12,'王','社会现象。','HT XH.');
av($vs,$va,'矛盾','máodùn','mâu thuẫn',6,lid($lmap,6,1),10,'矛','矛盾问题。','VĐ MT.');
av($vs,$va,'辩证','biànzhèng','biện chứng',6,lid($lmap,6,1),16,'辛','辩证思维。','TD BC.');
av($vs,$va,'逻辑','luóji','lô-gic',6,lid($lmap,6,1),15,'辶','逻辑思维。','TD LG.');
av($vs,$va,'观念','guānniàn','quan niệm',6,lid($lmap,6,1),12,'又','传统观念。','QN TT.');
av($vs,$va,'信念','xìnniàn','tín niệm',6,lid($lmap,6,1),13,'亻','坚定信念。','Kiên định TN.');
av($vs,$va,'精神','jīngshén','tinh thần',6,lid($lmap,6,1),15,'米','精神生活。','Sống TT.');
av($vs,$va,'物质','wùzhì','vật chất',6,lid($lmap,6,1),12,'牜','物质生活。','Sống VC.');
av($vs,$va,'灵魂','línghún','linh hồn',6,lid($lmap,6,1),16,'鬼','灵魂深处。','Sâu thẳm LH.');

// HSK6-L2
av($vs,$va,'政治','zhèngzhì','chính trị',6,lid($lmap,6,2),14,'攵','政治制度。','Chế độ CT.');
av($vs,$va,'外交','wàijiāo','ngoại giao',6,lid($lmap,6,2),10,'夕','外交政策。','CS NG.');
av($vs,$va,'政策','zhèngcè','chính sách',6,lid($lmap,6,2),13,'竹','经济政策。','CS KT.');
av($vs,$va,'制度','zhìdù','chế độ',6,lid($lmap,6,2),12,'刂','教育制度。','CĐ GD.');
av($vs,$va,'民主','mínzhǔ','dân chủ',6,lid($lmap,6,2),11,'民','民主制度。','CĐ DC.');
av($vs,$va,'法律','fǎlǜ','pháp luật',6,lid($lmap,6,2),12,'氵','法律制度。','CĐ PL.');
av($vs,$va,'权利','quánlì','quyền lợi',6,lid($lmap,6,2),10,'木','人权。','Nhân quyền.');
av($vs,$va,'义务','yìwù','nghĩa vụ',6,lid($lmap,6,2),11,'丶','公民义务。','NV công dân.');
av($vs,$va,'谈判','tánpàn','đàm phán',6,lid($lmap,6,2),13,'讠','贸易谈判。','ĐP TM.');
av($vs,$va,'协议','xiéyì','hiệp định',6,lid($lmap,6,2),11,'十','达成协议。','Đạt HĐ.');
av($vs,$va,'代表团','dàibiǎo tuán','đoàn đại biểu',6,lid($lmap,6,2),11,'亻','代表团访问。','Đoàn DB thăm.');
av($vs,$va,'联合国','Liánhéguó','Liên Hợp Quốc',6,lid($lmap,6,2),13,'耳','联合国大会。','ĐH LHQ.');
av($vs,$va,'和平','hépíng','hòa bình',6,lid($lmap,6,2),11,'口','世界和平。','HB TG.');
av($vs,$va,'发展','fāzhǎn','phát triển',6,lid($lmap,6,2),10,'又','经济发展。','PT KT.');
av($vs,$va,'合作','hézuò','hợp tác',6,lid($lmap,6,2),11,'口','国际合作。','HT QT.');
av($vs,$va,'关系','guānxì','quan hệ',6,lid($lmap,6,2),12,'门','外交关系。','QH NG.');
av($vs,$va,'大使','dàshǐ','đại sứ',6,lid($lmap,6,2),11,'大','中国大使。','ĐS TQ.');
av($vs,$va,'领事馆','lǐngshìguǎn','lãnh sự quán',6,lid($lmap,6,2),15,'页','去领事馆。','Đến LSQ.');
av($vs,$va,'主权','zhǔquán','chủ quyền',6,lid($lmap,6,2),11,'丶','国家主权。','CQ quốc gia.');
av($vs,$va,'领土','lǐngtǔ','lãnh thổ',6,lid($lmap,6,2),14,'页','领土完整。','LT toàn vẹn.');

// HSK6-L3
av($vs,$va,'医学','yīxué','y học',6,lid($lmap,6,3),13,'匸','医学研究。','NC YH.');
av($vs,$va,'临床','línchuáng','lâm sàng',6,lid($lmap,6,3),11,'丨','临床医学。','YH LS.');
av($vs,$va,'诊断','zhěnduàn','chẩn đoán',6,lid($lmap,6,3),14,'讠','诊断病情。','CĐ bệnh.');
av($vs,$va,'治疗','zhìliáo','trị liệu',6,lid($lmap,6,3),12,'氵','治疗方法。','PP TL.');
av($vs,$va,'手术','shǒushù','phẫu thuật',6,lid($lmap,6,3),9,'扌','做手术。','PT.');
av($vs,$va,'疫苗','yìmiáo','vắc-xin',6,lid($lmap,6,3),11,'疒','接种疫苗。','Tiêm VX.');
av($vs,$va,'预防','yùfáng','dự phòng',6,lid($lmap,6,3),12,'页','预防疾病。','DP bệnh.');
av($vs,$va,'营养','yíngyǎng','dinh dưỡng',6,lid($lmap,6,3),12,'艹','营养均衡。','DD cân bằng.');
av($vs,$va,'健康检查','jiànkāng jiǎnchá','kiểm tra sức khỏe',6,lid($lmap,6,3),14,'亻','做健康检查。','KTSK.');
av($vs,$va,'慢性病','mànxìng bìng','bệnh mãn tính',6,lid($lmap,6,3),12,'忄','慢性病治疗。','Điều trị bệnh MT.');
av($vs,$va,'传染病','chuánrǎn bìng','bệnh truyền nhiễm',6,lid($lmap,6,3),13,'亻','预防传染病。','DP BTN.');
av($vs,$va,'癌症','áizhèng','ung thư',6,lid($lmap,6,3),16,'疒','癌症治疗。','Điều trị UT.');
av($vs,$va,'心理','xīnlǐ','tâm lý',6,lid($lmap,6,3),10,'心','心理健康。','SK TL.');
av($vs,$va,'压力','yālì','áp lực, stress',6,lid($lmap,6,3),11,'土','工作压力。','AL công việc.');
av($vs,$va,'焦虑','jiāolǜ','lo lắng',6,lid($lmap,6,3),13,'心','感到焦虑。','Cảm thấy LL.');
av($vs,$va,'医疗保险','yīliáo bǎoxiǎn','bảo hiểm y tế',6,lid($lmap,6,3),14,'阝','医疗保险制度。','CĐ BHYT.');
av($vs,$va,'公共卫生','gōnggòng wèishēng','y tế công cộng',6,lid($lmap,6,3),12,'八','公共卫生体系。','HT YTCC.');
av($vs,$va,'康复','kāngfù','phục hồi',6,lid($lmap,6,3),14,'广','康复治疗。','PH hồi.');
av($vs,$va,'养生','yǎngshēng','dưỡng sinh',6,lid($lmap,6,3),12,'八','养生之道。','Đạo DS.');
av($vs,$va,'寿命','shòumìng','tuổi thọ',6,lid($lmap,6,3),11,'士','平均寿命。','TT TB.');
echo "\n$va vocab entries inserted.\n";

// ═══════════════ GRAMMAR ═══════════════
echo "Inserting grammar...\n";
$gs = $conn->prepare("INSERT IGNORE INTO grammar (lesson_id,title,formula,meaning,`usage`,notes,sort_order) VALUES (?,?,?,?,?,?,?)");
$gxs = $conn->prepare("INSERT IGNORE INTO grammar_examples (grammar_id,example_cn,example_pinyin,example_vi,sort_order) VALUES (?,?,?,?,?)");
$gxs2 = $conn->prepare("INSERT IGNORE INTO grammar_exercises (grammar_id,type,question,options,answer,explanation,sort_order) VALUES (?,?,?,?,?,?,?)");
$ga = 0;
function ag($gs,&$ga,$lid,$t,$f,$m,$u,$n,$s) { try { $gs->execute([$lid,$t,$f,$m,$u,$n,$s]); $ga++; return $gs->errorCode()==='00000' ? true : false; } catch(Exception $x) {} return false; }
// HSK1-L1: Grammar
ag($gs,$ga,lid($lmap,1,1),'Câu khẳng định với 是','A + 是 + B','A là B','Dùng để giới thiệu, định nghĩa hoặc khẳng định một sự thật.','"是" không đi kèm với 很 khi là động từ "là".',1);
ag($gs,$ga,lid($lmap,1,1),'Câu hỏi với 吗','Câu trần thuật + 吗？','...có phải không?','Thêm 吗 cuối câu trần thuật để tạo câu hỏi.','"吗" chỉ dùng trong câu hỏi, không dùng trong câu trả lời.',2);
ag($gs,$ga,lid($lmap,1,1),'Đại từ nhân xưng','我/你/他/她 + động từ','Tôi/bạn/anh ấy/cô ấy','Dùng để chỉ người. 他 (nam), 她 (nữ) phát âm giống nhau.','他/她 cùng phát âm tā.',3);

// HSK1-L2: Grammar
ag($gs,$ga,lid($lmap,1,2),'Từ chỉ số lượng','Số + Lượng từ + Danh từ','Số + lượng từ + danh từ','Dùng lượng từ 个 cho người và vật thông thường.','Mỗi danh từ có lượng từ riêng.',1);
ag($gs,$ga,lid($lmap,1,2),'Câu hỏi với 几','几 + Lượng từ + Danh từ?','Mấy...?','Dùng 几 để hỏi số lượng, thường dùng với số nhỏ (dưới 10).','"几" dùng cho số ít, "多少" dùng chung.',2);
ag($gs,$ga,lid($lmap,1,2),'Cấu trúc sở hữu với 的','Danh từ/Đại từ + 的 + Danh từ','Của...','Biểu thị quan hệ sở hữu.','Khi nói người thân có thể bỏ 的.',3);

// HSK1-L3: Grammar
ag($gs,$ga,lid($lmap,1,3),'Cách nói thời gian','Số + 点 + Số + 分','...giờ...phút','Dùng 点 chỉ giờ, 分 chỉ phút. 半 = 30 phút.','"两点" = 2h, "两点半" = 2h30.',1);
ag($gs,$ga,lid($lmap,1,3),'Câu hỏi với 什么时候','S + 什么时候 + V?','Khi nào...?','Dùng 什么时候 để hỏi thời điểm xảy ra hành động.','"什么时候" đứng trước hoặc sau chủ ngữ.',2);
ag($gs,$ga,lid($lmap,1,3),'Phó từ 在/正在','S + 正在/在 + V + O','Đang... (hành động tiếp diễn)','Diễn tả hành động đang xảy ra.','"在" có thể dùng độc lập hoặc với "正在".',3);

// HSK2-L1: Grammar
ag($gs,$ga,lid($lmap,2,1),'Động từ trùng điệp','V + V hoặc V + 一 + V','Làm thử/làm một chút','Động từ trùng điệp thể hiện hành động ngắn, thử.','Thường dùng với động từ đơn âm tiết.',1);
ag($gs,$ga,lid($lmap,2,1),'Bổ ngữ kết quả','V + 完/见/好/到','Xong/thấy/tốt/đến','Chỉ kết quả của hành động.','"做完" = làm xong, "看到" = nhìn thấy.',2);
ag($gs,$ga,lid($lmap,2,1),'Câu chữ 把','S + 把 + O + V + 其他','Đem/mang...làm gì...','Dùng để nhấn mạnh tác động lên đối tượng.','"把" thường dùng với bổ ngữ.',3);

// HSK2-L2: Grammar
ag($gs,$ga,lid($lmap,2,2),'Câu so sánh với 比','A + 比 + B + Tính từ','A hơn B...','Dùng để so sánh hơn, 比 = hơn.','Phó từ như 很/非常 không dùng sau 比.',1);
ag($gs,$ga,lid($lmap,2,2),'Trợ từ 了 (thay đổi)','S + V + 了 + O','Đã... rồi','Diễn tả sự thay đổi hoặc hành động đã hoàn thành.','Phân biệt 了 với 过.',2);
ag($gs,$ga,lid($lmap,2,2),'Trợ từ 过 (kinh nghiệm)','S + V + 过 + O','Đã từng...','Diễn tả từng trải qua một việc gì đó.','"去过" = đã từng đi, "吃过" = đã ăn.',3);

// HSK2-L3: Grammar
ag($gs,$ga,lid($lmap,2,3),'Câu hỏi với 多 + tính từ','多 + Tính từ (大/久/远/高)?','Hỏi về mức độ','Dùng 多 với tính từ để hỏi về kích thước/độ xa/thời gian.','"多大" = bao lớn, "多远" = bao xa.',1);
ag($gs,$ga,lid($lmap,2,3),'Cấu trúc 要 (sắp xảy ra)','S + 要 + V + O','Sắp...','Diễn tả hành động sắp xảy ra.','"要下雨了" = sắp mưa rồi.',2);
ag($gs,$ga,lid($lmap,2,3),'Cấu trúc 从...到...','从 + Nơi/Thời gian + 到 + Nơi/Thời gian','Từ...đến...','Diễn tả phạm vi không gian hoặc thời gian.','"从家到学校" = từ nhà đến trường.',3);

// HSK3-L1: Grammar
ag($gs,$ga,lid($lmap,3,1),'Bổ ngữ xu hướng đơn','V + 来/去','Đến.../đi...','Diễn tả hướng của hành động.','"上来" = đi lên, "下去" = đi xuống.',1);
ag($gs,$ga,lid($lmap,3,1),'Câu điều kiện 如果...就...','如果 + ĐK + 就 + KQ','Nếu...thì...','Biểu thị quan hệ điều kiện-kết quả.','"如果" có thể đứng trước hoặc sau chủ ngữ.',2);
ag($gs,$ga,lid($lmap,3,1),'Đại từ nghi vấn mở rộng','怎么/怎么样/为什么/哪儿','Thế nào/thế nào/tại sao/đâu','Các từ hỏi mở rộng.','"怎么" hỏi cách thức, "为什么" hỏi nguyên nhân.',3);

// HSK3-L2: Grammar
ag($gs,$ga,lid($lmap,3,2),'Bổ ngữ khả năng','V + 得/不 + Kết quả','Có thể/không thể...','Diễn tả khả năng đạt kết quả.','"看得见" = thấy được, "看不见" = không thấy.',1);
ag($gs,$ga,lid($lmap,3,2),'Câu liên tiếp 先...然后...','先 + V1 + 然后 + V2','Trước...sau đó...','Diễn tả thứ tự hành động.','"先吃饭，然后学习" = ăn trước rồi học sau.',2);
ag($gs,$ga,lid($lmap,3,2),'So sánh phủ định với 没有','A + 没有 + B + Tính từ','A không bằng B','Dùng phủ định 没有 để so sánh không bằng.','"没有" != "不比", sắc thái khác.',3);

// HSK3-L3: Grammar
ag($gs,$ga,lid($lmap,3,3),'Câu bị động với 被','S + 被 + (người) + V','Bị/được...','Diễn tả hành động bị động, thường mang ý không mong muốn.','"被" có thể lược bỏ tác nhân.',1);
ag($gs,$ga,lid($lmap,3,3),'Liên từ 虽然...但是...','虽然 + A + 但是 + B','Mặc dù...nhưng...','Biểu thị quan hệ nhượng bộ.','"虽然" đứng ở mệnh đề 1.',2);
ag($gs,$ga,lid($lmap,3,3),'Cấu trúc 除了...以外','除了 + A + (以外) + B','Ngoại trừ A (ra) B','Diễn tả ngoại trừ hoặc bao gồm cả.','"除了...以外" = ngoài...ra.',3);

// HSK4-L1: Grammar
ag($gs,$ga,lid($lmap,4,1),'Câu phức 不仅...而且...','不仅 + A + 而且 + B','Không những...mà còn...','Diễn tả tầng ý, bổ sung thêm thông tin.','"不仅" đứng đầu câu.',1);
ag($gs,$ga,lid($lmap,4,1),'Bổ ngữ xu hướng kép','V + 上来/下去/出来/起来','Lên/xuống/ra/lên','Diễn tả xu hướng kép của hành động.','"想起来" = nhớ ra.',2);
ag($gs,$ga,lid($lmap,4,1),'Trạng ngữ chỉ mức độ','极/十分/相当/非常 + Tính từ','Cực kỳ/rất/khá/rất','Các trạng từ chỉ mức độ cao.','Sắc thái từ mạnh đến yếu khác nhau.',3);

// HSK4-L2: Grammar
ag($gs,$ga,lid($lmap,4,2),'Cấu trúc 越...越...','越 + A + 越 + B','Càng...càng...','Diễn tả hai sự việc thay đổi cùng chiều.','"越来越大" = càng ngày càng lớn.',1);
ag($gs,$ga,lid($lmap,4,2),'Câu hỏi chính phản','S + V + 不 + V + O?','Có...không?','Dùng V+不+V đặt câu hỏi.','"是不是" = có phải không?',2);
ag($gs,$ga,lid($lmap,4,2),'Liên từ 无论...都...','无论 + A + 都 + B','Bất luận...đều...','Diễn tả điều kiện dù thế nào cũng không thay đổi.','"无论谁" = bất kỳ ai.',3);

// HSK4-L3: Grammar
ag($gs,$ga,lid($lmap,4,3),'Cấu trúc 只有...才...','只有 + ĐK + 才 + KQ','Chỉ có...mới...','Diễn tả điều kiện duy nhất mới đạt kết quả.','"只要...就..." nhẹ hơn "只有...才..."',1);
ag($gs,$ga,lid($lmap,4,3),'Câu nhấn mạnh với 是...的','是 + Thành phần nhấn mạnh + 的','Chính là...','Nhấn mạnh thời gian/địa điểm/cách thức.','"我是昨天来的" = Tôi đến hôm qua.',2);
ag($gs,$ga,lid($lmap,4,3),'Cấu trúc 对...来说','对 + Người + 来说','Đối với...mà nói','Đưa ra quan điểm/đánh giá từ góc nhìn.','"对我来说" = đối với tôi.',3);

// HSK5-L1: Grammar
ag($gs,$ga,lid($lmap,5,1),'Cấu trúc 以...为...','以 + A + 为 + B','Lấy A làm B','Diễn tả xem A là B, dùng trong văn viết.','"以市场为导向" = lấy thị trường làm định hướng.',1);
ag($gs,$ga,lid($lmap,5,1),'Cấu trúc 对...来说','对 + N + 来说','Đối với...','Đưa ra nhận định từ góc nhìn của ai.','"对学生来说" = Đối với học sinh.',2);
ag($gs,$ga,lid($lmap,5,1),'Câu đảo ngữ (văn viết)','Adv + V + S','Trạng ngữ + V + S','Dùng để nhấn mạnh, thường trong văn viết.','"近年来" = những năm gần đây.',3);

// HSK5-L2: Grammar
ag($gs,$ga,lid($lmap,5,2),'Thành ngữ và quán dụng ngữ','Cố định, 4 chữ','Nghĩa bóng','Thành ngữ 4 chữ thường có ý nghĩa sâu sắc.','"千方百计" = trăm phương ngàn kế.',1);
ag($gs,$ga,lid($lmap,5,2),'Cấu trúc 随着...','随着 + N + V','Cùng với...','Diễn tả sự thay đổi theo thời gian.','"随着发展" = cùng với sự phát triển.',2);
ag($gs,$ga,lid($lmap,5,2),'Liên từ 从而','V/A + 从而 + KQ','Do đó mà','Dùng trong văn viết, chỉ kết quả.','"从而提高" = do đó nâng cao.',3);

// HSK5-L3: Grammar
ag($gs,$ga,lid($lmap,5,3),'Cấu trúc 之所以...是因为...','之所以 + A + 是因为 + B','Sở dĩ...là vì...','Nhấn mạnh nguyên nhân trong văn viết.','"之所以成功，是因为努力" = thành công vì cố gắng.',1);
ag($gs,$ga,lid($lmap,5,3),'Phó từ 并非 (văn viết)','并非 + A','Không phải là...','Phủ định trang trọng, thường dùng trong văn viết.','"并非如此" = không phải như vậy.',2);
ag($gs,$ga,lid($lmap,5,3),'Liên từ 进而','V + 进而 + V','Mà còn, hơn nữa','Biểu thị tầng ý, tiến thêm một bước.','"进而推动" = hơn nữa thúc đẩy.',3);

// HSK6-L1: Grammar
ag($gs,$ga,lid($lmap,6,1),'Cấu trúc văn viết 乃至','乃至 + N/V','Thậm chí đến cả','Dùng trong văn viết để nhấn mạnh phạm vi mở rộng.','"乃至全国" = thậm chí cả nước.',1);
ag($gs,$ga,lid($lmap,6,1),'Liên từ 故此','故此 + KQ','Vì vậy cho nên','Dùng trong văn viết trang trọng.','"故此决定" = vì vậy quyết định.',2);
ag($gs,$ga,lid($lmap,6,1),'Cấu trúc 鉴于此','鉴于此 + KQ','Xét thấy vậy','Mở đầu câu trong văn bản chính thức.','"鉴于此，我们建议" = xét thấy, chúng tôi đề nghị.',3);

// HSK6-L2: Grammar
ag($gs,$ga,lid($lmap,6,2),'Cấu trúc 鉴于','鉴于 + N','Căn cứ vào, do','Dùng trong văn bản chính thức để chỉ căn cứ.','"鉴于上述情况" = căn cứ tình hình trên.',1);
ag($gs,$ga,lid($lmap,6,2),'Cấu trúc 据此','据此 + V','Căn cứ vào đó','Dùng trong văn bản pháp lý/hành chính.','"据此做出决定" = căn cứ đó ra quyết định.',2);
ag($gs,$ga,lid($lmap,6,2),'Cấu trúc 为宜','以 + V + 为宜','Nên, tốt nhất là','Dùng trong văn viết trang trọng.','"以早日解决为宜" = nên sớm giải quyết.',3);

// HSK6-L3: Grammar
ag($gs,$ga,lid($lmap,6,3),'Cấu trúc 可见','可见 + KQ','Có thể thấy rằng','Dùng để kết luận từ phân tích.','"可见健康很重要" = có thể thấy SK rất quan trọng.',1);
ag($gs,$ga,lid($lmap,6,3),'Cấu trúc 以达到','以达到 + Mục đích','Để đạt được','Dùng trong văn bản chính thức chỉ mục đích.','"以达到预期效果" = để đạt hiệu quả dự kiến.',2);
ag($gs,$ga,lid($lmap,6,3),'Liên từ 反之','反之 + KQ','Ngược lại','Dùng trong lập luận, đưa ra mặt đối lập.','"反之亦然" = ngược lại cũng vậy.',3);

echo "$ga grammar points inserted.\n";
// ── Grammar Examples ──
echo "Inserting grammar examples & exercises...\n";
$gids = $conn->query("SELECT id, lesson_id FROM grammar ORDER BY id")->fetchAll();
$gxe = 0; $gxr = 0;
foreach ($gids as $gr) {
    $lid = $gr['lesson_id']; $gid = $gr['id'];
    // Add 2 examples per grammar point
    $ex = [];
    if ($lid==lid($lmap,1,1)) { $ex=[['我是学生。','Wǒ shì xuéshēng.','Tôi là học sinh.'],['她是老师。','Tā shì lǎoshī.','Cô ấy là giáo viên.']]; }
    elseif ($lid==lid($lmap,1,2)) { $ex=[['我家有三口人。','Wǒ jiā yǒu sān kǒu rén.','Nhà tôi có 3 người.'],['你有几个哥哥？','Nǐ yǒu jǐ gē ge?','Bạn có mấy anh trai?']]; }
    elseif ($lid==lid($lmap,1,3)) { $ex=[['现在三点半。','Xiànzài sān diǎn bàn.','Bây giờ 3h30.'],['我早上六点起床。','Wǒ zǎoshang liù diǎn qǐchuáng.','Tôi dậy lúc 6h sáng.']]; }
    elseif ($lid==lid($lmap,2,1)) { $ex=[['你看看这本书。','Nǐ kànkan zhè běn shū.','Bạn xem thử quyển sách này.'],['我做完了作业。','Wǒ zuò wán le zuòyè.','Tôi làm xong bài tập.']]; }
    elseif ($lid==lid($lmap,2,2)) { $ex=[['苹果比香蕉便宜。','Píngguǒ bǐ xiāngjiāo piányí.','Táo rẻ hơn chuối.'],['我去过北京。','Wǒ qù guo Běijīng.','Tôi đã từng đi Bắc Kinh.']]; }
    elseif ($lid==lid($lmap,2,3)) { $ex=[['你家离公司多远？','Nǐ jiā lí gōngsī duō yuǎn?','Nhà bạn xa cty bao xa?'],['我要去上海旅行。','Wǒ yào qù Shànghǎi lǚxíng.','Tôi sắp đi Thượng Hải du lịch.']]; }
    elseif ($lid==lid($lmap,3,1)) { $ex=[['如果你努力，就会成功。','Rúguǒ nǔlì, jiù huì chénggōng.','Nếu cố gắng sẽ thành công.'],['他走过去了。','Tā zǒu guò qù le.','Anh ấy đi qua đó.']]; }
    elseif ($lid==lid($lmap,3,2)) { $ex=[['我看得清楚。','Wǒ kàn de qīngchu.','Tôi nhìn rõ.'],['先吃饭，然后洗澡。','Xiān chīfàn, ránhòu xǐzǎo.','Ăn trước rồi tắm sau.']]; }
    elseif ($lid==lid($lmap,3,3)) { $ex=[['杯子被我打破了。','Bēizi bèi wǒ dǎpò le.','Cái cốc bị tôi làm vỡ.'],['虽然累了，但是很开心。','Suīrán lèi le, dànshì hěn kāixīn.','Dù mệt nhưng rất vui.']]; }
    elseif ($lid==lid($lmap,4,1)) { $ex=[['他不仅聪明，而且努力。','Tā bùjǐn cōngmíng, érqiě nǔlì.','Anh ấy không chỉ thông minh mà còn chăm chỉ.'],['我想起来了。','Wǒ xiǎng qǐlai le.','Tôi nhớ ra rồi.']]; }
    elseif ($lid==lid($lmap,4,2)) { $ex=[['天气越来越好。','Tiānqì yuè lái yuè hǎo.','Thời tiết càng ngày càng tốt.'],['无论多难，都要坚持。','Wúlùn duō nán, dōu yào jiānchí.','Dù khó thế nào cũng phải kiên trì.']]; }
    elseif ($lid==lid($lmap,4,3)) { $ex=[['只有努力才能成功。','Zhǐyǒu nǔlì cái néng chénggōng.','Chỉ có cố gắng mới thành công.'],['我是昨天到的。','Wǒ shì zuótiān dào de.','Tôi đến hôm qua.']]; }
    elseif ($lid==lid($lmap,5,1)) { $ex=[['以市场为导向。','Yǐ shìchǎng wéi dǎoxiàng.','Lấy thị trường làm định hướng.'],['对年轻人来说，机会很多。','Duì niánqīng rén lái shuō, jīhuì hěn duō.','Với người trẻ, cơ hội rất nhiều.']]; }
    elseif ($lid==lid($lmap,5,2)) { $ex=[['我们应该千方百计地解决问题。','Wǒmen yīnggāi qiānfāngbǎijì de jiějué wèntí.','Chúng ta nên dùng trăm phương ngàn kế giải quyết vấn đề.'],['随着科技发展，生活更方便了。','Suízhe kējì fāzhǎn, shēnghuó gèng fāngbiàn le.','Cùng với sự phát triển của KHKT, cuộc sống tiện lợi hơn.']]; }
    elseif ($lid==lid($lmap,5,3)) { $ex=[['之所以成功，是因为努力。','Zhī suǒyǐ chénggōng, shì yīnwèi nǔlì.','Sở dĩ thành công là vì cố gắng.'],['事实并非如此。','Shìshí bìng fēi rúcǐ.','Sự thật không phải như vậy.']]; }
    elseif ($lid==lid($lmap,6,1)) { $ex=[['这一政策影响乃至全国。','Zhè yī zhèngcè yǐngxiǎng nǎizhì quánguó.','Chính sách này ảnh hưởng tới cả nước.'],['鉴于此，我们需重新考虑。','Jiàn yú cǐ, wǒmen xū chóngxīn kǎolǜ.','Xét thấy vậy, chúng tôi cần xem xét lại.']]; }
    elseif ($lid==lid($lmap,6,2)) { $ex=[['鉴于上述情况，我们决定延期。','Jiànyú shàngshù qíngkuàng, wǒmen juédìng yánqī.','Căn cứ tình hình trên, chúng tôi quyết định gia hạn.'],['据此作出判决。','Jù cǐ zuòchū pànjué.','Căn cứ đó đưa ra phán quyết.']]; }
    elseif ($lid==lid($lmap,6,3)) { $ex=[['他经常锻炼，可见他很重视健康。','Tā jīngcháng duànliàn, kějiàn tā hěn zhòngshì jiànkāng.','Anh ấy thường tập, có thể thấy anh ấy coi trọng sức khỏe.'],['反之，如果放弃就什么都没了。','Fǎnzhī, rúguǒ fàngqì jiù shénme dōu méi le.','Ngược lại, nếu từ bỏ thì không còn gì.']]; }
    for ($i=0; $i<count($ex); $i++) {
        try { $gxs->execute([$gid, $ex[$i][0], $ex[$i][1], $ex[$i][2], $i]); $gxe++; } catch(Exception $x) {}
    }
    // Add 1 exercise per grammar point
    $exer = [];
    if ($lid==lid($lmap,1,1)) { $exer=[['fill_blank','我____学生。',null,'是','Điền "是" (là).']]; }
    elseif ($lid==lid($lmap,1,2)) { $exer=[['fill_blank','我家有____口人。',null,'三','Điền số thích hợp.']]; }
    elseif ($lid==lid($lmap,1,3)) { $exer=[['multiple_choice','现在8点30分怎么说？','["八点","八点三十分","八点半","八点三十"]','八点半','Chọn cách nói đúng.']]; }
    elseif ($lid==lid($lmap,2,1)) { $exer=[['fill_blank','请____看（看一下）。','["看","看看","看了","看过"]','看看','Điền dạng trùng điệp.']]; }
    elseif ($lid==lid($lmap,2,2)) { $exer=[['fill_blank','我____过长城。','["去","去了","去过","去着"]','去过','Tôi đã từng đến Vạn Lý Trường Thành.']]; }
    elseif ($lid==lid($lmap,2,3)) { $exer=[['fill_blank','从北京____上海。','["到","在","是","有"]','到','Từ Bắc Kinh đến Thượng Hải.']]; }
    elseif ($lid==lid($lmap,3,1)) { $exer=[['fill_blank','如果明天不下雨，我____去公园。','["就","才","也","还"]','就','Nếu mai không mưa thì tôi đi công viên.']]; }
    elseif ($lid==lid($lmap,3,2)) { $exer=[['fill_blank','这些字我看得____。','["清楚","很清楚","不清楚","清楚吗"]','清楚','Mấy chữ này tôi nhìn rõ.']]; }
    elseif ($lid==lid($lmap,3,3)) { $exer=[['fill_blank','____我很忙，但是我每天都锻炼。','["虽然","因为","如果","所以"]','虽然','Mặc dù bận nhưng mỗi ngày đều tập.']]; }
    elseif ($lid==lid($lmap,4,1)) { $exer=[['fill_blank','他不仅学习好，____很努力。','["而且","但是","因为","所以"]','而且','Không chỉ học giỏi mà còn chăm chỉ.']]; }
    elseif ($lid==lid($lmap,4,2)) { $exer=[['fill_blank','天气____来____热了。','["又...又...","越...越...","一边...一边...","先...然后..."]','越...越...','Thời tiết càng ngày càng nóng.']]; }
    elseif ($lid==lid($lmap,4,3)) { $exer=[['fill_blank','只有努力____能成功。','["就","才","都","也"]','才','Chỉ cố gắng mới thành công.']]; }
    elseif ($lid==lid($lmap,5,1)) { $exer=[['fill_blank','____市场为导向。','["以","把","被","从"]','以','Lấy thị trường làm định hướng.']]; }
    elseif ($lid==lid($lmap,5,2)) { $exer=[['fill_blank','____科技发展，生活变了。','["因为","随着","为了","除了"]','随着','Cùng với sự phát triển KHKT.']]; }
    elseif ($lid==lid($lmap,5,3)) { $exer=[['fill_blank','之所以成功____因为努力。','["是","就","才","为"]','是','Sở dĩ thành công là vì cố gắng.']]; }
    elseif ($lid==lid($lmap,6,1)) { $exer=[['fill_blank','____此，我们决定修改方案。','["鉴于","因为","由于","根据"]','鉴于','Xét thấy vậy, chúng tôi quyết định sửa đổi phương án.']]; }
    elseif ($lid==lid($lmap,6,2)) { $exer=[['fill_blank','____作出如下判决。','["据此","因为","由于","根据"]','据此','Căn cứ đó đưa ra phán quyết.']]; }
    elseif ($lid==lid($lmap,6,3)) { $exer=[['fill_blank','他每天锻炼，____身体很好。','["可见","所以","因为","但是"]','可见','Anh ấy tập mỗi ngày, có thể thấy sức khỏe tốt.']]; }
    foreach ($exer as $e) {
        try { $gxs2->execute([$gid,$e[0],$e[1],$e[2],$e[3],$e[4],1]); $gxr++; } catch(Exception $x) {}
    }
}
echo "$gxe examples, $gxr exercises inserted.\n";
// ═══════════════ DIALOGUES ═══════════════
echo "Inserting dialogues...\n";
$ds = $conn->prepare("INSERT IGNORE INTO dialogues (lesson_id,title,context,sort_order) VALUES (?,?,?,?)");
$dss = $conn->prepare("INSERT IGNORE INTO dialogue_sentences (dialogue_id,speaker,chinese,pinyin,vietnamese,sort_order) VALUES (?,?,?,?,?,?)");
$da = 0; $dsa = 0;

function mkDialogue($ds,$dss,&$da,&$dsa,$lid,$title,$ctx,$order,$lines) {
    global $conn;
    try { $ds->execute([$lid,$title,$ctx,$order]); $da++; } catch(Exception $x) {}
    $q = $conn->prepare("SELECT id FROM dialogues WHERE lesson_id=? AND title=?");
    $q->execute([$lid,$title]); $did = $q->fetchColumn();
    if (!$did) return;
    foreach ($lines as $i=>$l) {
        try { $dss->execute([$did, $l[0], $l[1], $l[2], $l[3], $i]); $dsa++; } catch(Exception $x) {}
    }
}

// HSK1-L1 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,1,1),'Gặp mặt lần đầu','Lan và Minh gặp nhau lần đầu tại trường học.',1,[
    ['Lan','你好！','Nǐ hǎo!','Xin chào!'],
    ['Minh','你好！我叫明，你叫什么名字？','Nǐ hǎo! Wǒ jiào Míng, nǐ jiào shénme míngzì?','Xin chào! Tôi là Minh, bạn tên gì?'],
    ['Lan','我叫兰，很高兴认识你。','Wǒ jiào Lán, hěn gāoxìng rènshi nǐ.','Tôi là Lan, rất vui được quen bạn.'],
    ['Minh','我也是，你是学生吗？','Wǒ yě shì, nǐ shì xuéshēng ma?','Tôi cũng vậy, bạn là học sinh à?'],
    ['Lan','是的，我是学生。','Shì de, wǒ shì xuéshēng.','Đúng vậy, tôi là học sinh.'],
    ['Minh','我也是学生，太好了！','Wǒ yě shì xuéshēng, tài hǎo le!','Tôi cũng là học sinh, tuyệt quá!'],
    ['Lan','明天见！','Míngtiān jiàn!','Hẹn gặp lại ngày mai!'],
    ['Minh','明天见！','Míngtiān jiàn!','Hẹn gặp lại!'],
]);

// HSK1-L2 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,1,2),'Giới thiệu gia đình','Lan kể về gia đình mình.',1,[
    ['Minh','你家有几口人？','Nǐ jiā yǒu jǐ kǒu rén?','Nhà bạn có mấy người?'],
    ['Lan','我家有四口人。','Wǒ jiā yǒu sì kǒu rén.','Nhà tôi có 4 người.'],
    ['Minh','都有谁？','Dōu yǒu shuí?','Gồm những ai?'],
    ['Lan','爸爸、妈妈、哥哥和我。','Bàba, māma, gēge hé wǒ.','Bố, mẹ, anh trai và tôi.'],
    ['Minh','你哥哥几岁？','Nǐ gēge jǐ suì?','Anh trai bạn mấy tuổi?'],
    ['Lan','他二十岁。','Tā èrshí suì.','Anh ấy 20 tuổi.'],
    ['Minh','你呢？你几岁？','Nǐ ne? Nǐ jǐ suì?','Còn bạn? Bạn mấy tuổi?'],
    ['Lan','我十八岁。','Wǒ shíbā suì.','Tôi 18 tuổi.'],
]);

// HSK1-L3 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,1,3),'Hỏi giờ','Minh hỏi Lan về thời gian.',1,[
    ['Minh','请问，现在几点？','Qǐngwèn, xiànzài jǐ diǎn?','Xin hỏi, bây giờ mấy giờ?'],
    ['Lan','现在八点半。','Xiànzài bā diǎn bàn.','Bây giờ 8h30.'],
    ['Minh','你几点上课？','Nǐ jǐ diǎn shàngkè?','Mấy giờ bạn vào học?'],
    ['Lan','我九点上课。','Wǒ jiǔ diǎn shàngkè.','9h tôi vào học.'],
    ['Minh','现在去教室吗？','Xiànzài qù jiàoshi ma?','Bây giờ đi lớp à?'],
    ['Lan','对，一起去吧。','Duì, yīqǐ qù ba.','Đúng, cùng đi nhé.'],
]);

// HSK2-L1 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,2,1),'Sinh hoạt hàng ngày','Minh và Lan nói về thói quen hàng ngày.',1,[
    ['Lan','你每天几点起床？','Nǐ měitiān jǐ diǎn qǐchuáng?','Mỗi ngày bạn dậy mấy giờ?'],
    ['Minh','我每天六点起床。','Wǒ měitiān liù diǎn qǐchuáng.','Mỗi ngày tôi dậy lúc 6h.'],
    ['Lan','这么早！起床后做什么？','Zhème zǎo! Qǐchuáng hòu zuò shénme?','Sớm vậy! Dậy xong làm gì?'],
    ['Minh','刷牙洗脸，然后吃早饭。','Shuāyá xǐliǎn, ránhòu chī zǎofàn.','Đánh răng rửa mặt, rồi ăn sáng.'],
    ['Lan','你几点上班？','Nǐ jǐ diǎn shàngbān?','Mấy giờ bạn đi làm?'],
    ['Minh','八点上班。','Bā diǎn shàngbān.','8h đi làm.'],
    ['Lan','晚上做什么？','Wǎnshang zuò shénme?','Tối làm gì?'],
    ['Minh','看电视或者看书。','Kàn diànshì huòzhě kànshū.','Xem TV hoặc đọc sách.'],
]);

// HSK2-L2 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,2,2),'Đi siêu thị','Lan và Minh đi siêu thị mua đồ.',1,[
    ['Lan','我们去超市吧！','Wǒmen qù chāoshì ba!','Chúng ta đi siêu thị đi!'],
    ['Minh','好，要买什么？','Hǎo, yào mǎi shénme?','Được, cần mua gì?'],
    ['Lan','我想买水果和牛奶。','Wǒ xiǎng mǎi shuǐguǒ hé niúnǎi.','Tôi muốn mua hoa quả và sữa.'],
    ['Minh','苹果多少钱一斤？','Píngguǒ duōshao qián yī jīn?','Táo bao nhiêu tiền một cân?'],
    ['Lan','五块一斤，很便宜。','Wǔ kuài yī jīn, hěn piányi.','5 tệ một cân, rất rẻ.'],
    ['Minh','那买两斤吧。','Nà mǎi liǎng jīn ba.','Vậy mua 2 cân nhé.'],
    ['Lan','还要买什么？','Hái yào mǎi shénme?','Còn cần mua gì không?'],
    ['Minh','够了，去付钱吧。','Gòu le, qù fù qián ba.','Đủ rồi, đi trả tiền thôi.'],
]);

// HSK2-L3 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,2,3),'Đi du lịch','Lan và Minh kế hoạch đi du lịch.',1,[
    ['Minh','暑假你去哪儿？','Shǔjià nǐ qù nǎr?','Hè này bạn đi đâu?'],
    ['Lan','我要去北京旅行。','Wǒ yào qù Běijīng lǚxíng.','Tôi sẽ đi Bắc Kinh du lịch.'],
    ['Minh','坐飞机还是火车？','Zuò fēijī háishì huǒchē?','Đi máy bay hay tàu hỏa?'],
    ['Lan','坐高铁，六个小时到。','Zuò gāotiě, liù gè xiǎoshí dào.','Đi tàu cao tốc, 6 tiếng đến.'],
    ['Minh','订酒店了吗？','Dìng jiǔdiàn le ma?','Đã đặt khách sạn chưa?'],
    ['Lan','订了，离天安门很近。','Dìng le, lí Tiānānmén hěn jìn.','Đặt rồi, gần Thiên An Môn.'],
    ['Minh','祝你旅途愉快！','Zhù nǐ lǚtú yúkuài!','Chúc bạn chuyến đi vui vẻ!'],
    ['Lan','谢谢！','Xièxie!','Cảm ơn!'],
]);

// HSK3-L1 Dialogues  
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,3,1),'Phỏng vấn xin việc','Minh đi phỏng vấn tại công ty.',1,[
    ['Quản lý','你好，请坐。请简单介绍一下自己。','Nǐ hǎo, qǐng zuò. Qǐng jiǎndān jièshào yīxià zìjǐ.','Xin chào, mời ngồi. Hãy tự giới thiệu.'],
    ['Minh','您好，我叫明，今年24岁，大学毕业。','Nín hǎo, wǒ jiào Míng, jīnnián 24 suì, dàxué bìyè.','Chào anh, tôi là Minh, 24 tuổi, tốt nghiệp ĐH.'],
    ['Quản lý','你学的是什么专业？','Nǐ xué de shì shénme zhuānyè?','Bạn học chuyên ngành gì?'],
    ['Minh','我学的是国际贸易。','Wǒ xué de shì guójì màoyì.','Tôi học thương mại quốc tế.'],
    ['Quản lý','有工作经验吗？','Yǒu gōngzuò jīngyàn ma?','Có kinh nghiệm làm việc không?'],
    ['Minh','有一年的相关工作经验。','Yǒu yī nián de xiāngguān gōngzuò jīngyàn.','Có 1 năm kinh nghiệm liên quan.'],
    ['Quản lý','好的，我们会通知你。','Hǎo de, wǒmen huì tōngzhī nǐ.','Tốt, chúng tôi sẽ thông báo.'],
    ['Minh','谢谢您给我这个机会。','Xièxie nín gěi wǒ zhège jīhuì.','Cảm ơn anh đã cho tôi cơ hội này.'],
]);

// HSK3-L2 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,3,2),'Khám bệnh','Minh bị ốm đến bệnh viện.',1,[
    ['Bác sĩ','你怎么了？','Nǐ zěnme le?','Bạn làm sao thế?'],
    ['Minh','医生，我头疼，还咳嗽。','Yīshēng, wǒ tóuténg, hái késou.','Bác sĩ, tôi đau đầu còn ho nữa.'],
    ['Bác sĩ','发烧吗？量一下体温。','Fāshāo ma? Liáng yīxià tǐwēn.','Có sốt không? Đo nhiệt độ nào.'],
    ['Minh','有点发烧。','Yǒudiǎn fāshāo.','Hơi sốt.'],
    ['Bác sĩ','感冒了，要多休息，多喝水。','Gǎnmào le, yào duō xiūxi, duō hē shuǐ.','Bị cảm rồi, phải nghỉ nhiều, uống nhiều nước.'],
    ['Minh','需要吃药吗？','Xūyào chī yào ma?','Cần uống thuốc không?'],
    ['Bác sĩ','我给你开一些药，按时吃。','Wǒ gěi nǐ kāi yīxiē yào, ànshí chī.','Tôi kê cho bạn ít thuốc, uống đúng giờ.'],
    ['Minh','谢谢医生！','Xièxie yīshēng!','Cảm ơn bác sĩ!'],
]);

// HSK3-L3 Dialogues
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,3,3),'Tết Nguyên đán','Lan kể về Tết cho Minh.',1,[
    ['Minh','春节你们怎么庆祝？','Chūnjié nǐmen zěnme qìngzhù?','Tết các bạn ăn mừng thế nào?'],
    ['Lan','我们一家人团圆，吃年夜饭。','Wǒmen yījiā rén tuányuán, chī niányèfàn.','Cả nhà sum họp, ăn tất niên.'],
    ['Minh','包饺子吗？','Bāo jiǎozi ma?','Có gói sủi cảo không?'],
    ['Lan','对，大家一起包饺子，很有趣。','Duì, dàjiā yīqǐ bāo jiǎozi, hěn yǒuqù.','Đúng, mọi người cùng gói, rất vui.'],
    ['Minh','小孩儿是不是有红包？','Xiǎohái er shì bù shì yǒu hóngbāo?','Trẻ con có được lì xì không?'],
    ['Lan','对啊，长辈会给红包。','Duì a, zhǎngbèi huì gěi hóngbāo.','Đúng, người lớn tặng lì xì.'],
    ['Minh','真有意思！有机会我也想过春节。','Zhēn yǒuyìsi! Yǒu jīhuì wǒ yě xiǎng guò Chūnjié.','Thú vị thật! Có cơ hội tôi cũng muốn ăn Tết.'],
]);

// HSK4-6 Dialogues (1 each)
mkDialogue($ds,$dss,$da,$dsa,lid($lmap,4,1),'Mời bạn dự tiệc','Lan mời Minh đến dự tiệc sinh nhật.',1,[
    ['Lan','这周六是我的生日，我想邀请你来参加。','Zhè zhōuliù shì wǒ de shēngrì, wǒ xiǎng yāoqǐng nǐ lái cānjiā.','Thứ 7 này là sinh nhật tôi, muốn mời bạn đến.'],
    ['Minh','真的吗？太好了！几点开始？','Zhēn de ma? Tài hǎo le! Jǐ diǎn kāishǐ?','Thật á? Tuyệt quá! Mấy giờ bắt đầu?'],
    ['Lan','晚上七点在我家。','Wǎnshang qī diǎn zài wǒ jiā.','7h tối tại nhà tôi.'],
    ['Minh','需要我带什么吗？','Xūyào wǒ dài shénme ma?','Cần tôi mang gì không?'],
    ['Lan','不用，人来就行！','Bùyòng, rén lái jiù xíng!','Không cần, người đến là được!'],
]);

mkDialogue($ds,$dss,$da,$dsa,lid($lmap,4,2),'Công nghệ mới','Minh và Lan nói về AI.',1,[
    ['Lan','你听说过人工智能吗？','Nǐ tīngshuō guo réngōng zhìnéng ma?','Bạn từng nghe về AI chưa?'],
    ['Minh','当然，现在人工智能发展很快。','Dāngrán, xiànzài réngōng zhìnéng fāzhǎn hěn kuài.','Tất nhiên, AI phát triển rất nhanh.'],
    ['Lan','你觉得机器人能取代人类吗？','Nǐ juéde jīqìrén néng qǔdài rénlèi ma?','Bạn nghĩ robot có thể thay thế con người không?'],
    ['Minh','有些工作可以，但不是全部。','Yǒuxiē gōngzuò kěyǐ, dàn bù shì quánbù.','Một số công việc có thể, nhưng không phải tất cả.'],
]);

mkDialogue($ds,$dss,$da,$dsa,lid($lmap,5,1),'Tin tức trong ngày','Minh và Lan thảo luận về tin tức.',1,[
    ['Lan','今天你看新闻了吗？','Jīntiān nǐ kàn xīnwén le ma?','Hôm nay bạn xem tin tức chưa?'],
    ['Minh','看了，空气质量问题很严重。','Kàn le, kōngqì zhìliàng wèntí hěn yánzhòng.','Xem rồi, vấn đề chất lượng không khí rất nghiêm trọng.'],
    ['Lan','对，我们应该关注环保。','Duì, wǒmen yīnggāi guānzhù huánbǎo.','Đúng, chúng ta nên quan tâm bảo vệ môi trường.'],
    ['Minh','是的，人人有责。','Shì de, rénrén yǒu zé.','Vâng, mọi người có trách nhiệm.'],
]);

mkDialogue($ds,$dss,$da,$dsa,lid($lmap,6,1),'Triết lý cuộc sống','Minh và Lan thảo luận về triết học.',1,[
    ['Minh','你觉得人生的意义是什么？','Nǐ juéde rénshēng de yìyì shì shénme?','Bạn nghĩ ý nghĩa cuộc sống là gì?'],
    ['Lan','每个人有不同的价值观。','Měi gè rén yǒu bùtóng de jiàzhíguān.','Mỗi người có giá trị quan khác nhau.'],
    ['Minh','我认为追求真理和幸福很重要。','Wǒ rènwéi zhuīqiú zhēnlǐ hé xìngfú hěn zhòngyào.','Tôi nghĩ theo đuổi chân lý và hạnh phúc rất quan trọng.'],
    ['Lan','我同意，还要有信念。','Wǒ tóngyì, hái yào yǒu xìnniàn.','Tôi đồng ý, còn phải có tín niệm.'],
]);

echo "$da dialogues, $dsa sentences inserted.\n";
// ═══════════════ READINGS ═══════════════
echo "Inserting readings...\n";
$rs = $conn->prepare("INSERT IGNORE INTO readings (lesson_id,title,content,pinyin,translation,sort_order) VALUES (?,?,?,?,?,?)");
$ra = 0;
function mr($rs,&$ra,$lid,$t,$c,$p,$tr) {
    try { $rs->execute([$lid,$t,$c,$p,$tr,1]); $ra++; } catch(Exception $x) {}
}

mr($rs,$ra,lid($lmap,1,1),'第一次见面','今天是我第一天上学。在学校里，我认识了很多新同学。有一个同学叫小明，他来自北京。我们用中文打招呼，他说"你好"，我也说"你好"。我们都喜欢学中文。','Jīntiān shì wǒ dì yī tiān shàngxué. Zài xuéxiào lǐ, wǒ rènshi le hěn duō xīn tóngxué. Yǒu yī gè tóngxué jiào Xiǎo Míng, tā láizì Běijīng. Wǒmen yòng Zhōngwén dǎ zhāohu, tā shuō "nǐ hǎo", wǒ yě shuō "nǐ hǎo". Wǒmen dōu xǐhuān xué Zhōngwén.','Hôm nay là ngày đầu tiên tôi đi học. Ở trường, tôi đã quen rất nhiều bạn mới. Có một bạn tên là Tiểu Minh, bạn ấy đến từ Bắc Kinh. Chúng tôi dùng tiếng Trung chào hỏi, bạn ấy nói "xin chào", tôi cũng nói "xin chào". Chúng tôi đều thích học tiếng Trung.');
mr($rs,$ra,lid($lmap,1,2),'我的家人','我叫兰，我家有三口人：爸爸、妈妈和我。爸爸是医生，妈妈是老师。我没有哥哥姐姐，也没有弟弟妹妹。我很爱我的家人。','Wǒ jiào Lán, wǒ jiā yǒu sān kǒu rén: bàba, māma hé wǒ. Bàba shì yīshēng, māma shì lǎoshī. Wǒ méiyǒu gēge jiějie, yě méiyǒu dìdi mèimei. Wǒ hěn ài wǒ de jiārén.','Tôi tên Lan, nhà tôi có ba người: bố, mẹ và tôi. Bố là bác sĩ, mẹ là giáo viên. Tôi không có anh chị, cũng không có em. Tôi rất yêu gia đình mình.');
mr($rs,$ra,lid($lmap,1,3),'一天的生活','我每天早上六点起床，六点半吃早饭。七点去学校，八点上课。中午十二点吃午饭，下午三点半放学。晚上七点做作业，九点洗澡，十点睡觉。','Wǒ měitiān zǎoshang liù diǎn qǐchuáng, liù diǎn bàn chī zǎofàn. Qī diǎn qù xuéxiào, bā diǎn shàngkè. Zhōngwǔ shíèr diǎn chī wǔfàn, xiàwǔ sān diǎn bàn fàngxué. Wǎnshang qī diǎn zuò zuòyè, jiǔ diǎn xǐzǎo, shí diǎn shuìjiào.','Mỗi ngày tôi dậy lúc 6h sáng, 6h30 ăn sáng. 7h đi học, 8h vào lớp. Trưa 12h ăn trưa, chiều 3h30 tan học. Tối 7h làm bài tập, 9h tắm, 10h đi ngủ.');
mr($rs,$ra,lid($lmap,2,1),'我的日常生活','我是公司的职员，每天的生活很有规律。早上七点起床，吃早饭后就坐地铁去上班。中午在食堂吃午饭，下午五点半下班。晚饭后我常常去散步，回家后看看电视或者上上网。周末我有时候去游泳。','Wǒ shì gōngsī de zhíyuán, měitiān de shēnghuó hěn yǒu guīlǜ. Zǎoshang qī diǎn qǐchuáng, chī zǎofàn hòu jiù zuò dìtiě qù shàngbān. Zhōngwǔ zài shítáng chī wǔfàn, xiàwǔ wǔ diǎn bàn xiàbān. Wǎnfàn hòu wǒ chángcháng qù sànbù, huíjiā hòu kànkan diànshì huòzhě shàngshang wǎng. Zhōumò wǒ yǒu shíhòu qù yóuyǒng.','Tôi là nhân viên công ty, cuộc sống hàng ngày rất có quy tắc. Sáng 7h dậy, ăn sáng xong thì đi metro đến chỗ làm. Trưa ăn ở căng tin, chiều 5h30 tan làm. Sau bữa tối tôi thường đi dạo, về nhà xem tivi hoặc lướt web. Cuối tuần tôi thỉnh thoảng đi bơi.');
mr($rs,$ra,lid($lmap,2,2),'去市场买菜','今天是星期天，我和妈妈去菜市场买菜。市场里的人很多，有卖水果的、卖蔬菜的、卖肉的。妈妈买了苹果、香蕉和西瓜，还买了鸡蛋和鱼。我问妈妈："多少钱？"妈妈说："一共五十块。"我觉得很便宜，因为菜很新鲜。','Jīntiān shì xīngqītiān, wǒ hé māma qù cài shìchǎng mǎi cài. Shìchǎng lǐ de rén hěn duō, yǒu mài shuǐguǒ de, mài shūcài de, mài ròu de. Māma mǎi le píngguǒ, xiāngjiāo hé xīguā, hái mǎi le jīdàn hé yú. Wǒ wèn māma: "Duōshao qián?" Māma shuō: "Yīgòng wǔshí kuài." Wǒ juéde hěn piányi, yīnwèi cài hěn xīnxiān.','Hôm nay là chủ nhật, tôi và mẹ đi chợ mua đồ. Trong chợ rất nhiều người, có người bán hoa quả, bán rau, bán thịt. Mẹ mua táo, chuối và dưa hấu, còn mua trứng và cá. Tôi hỏi mẹ: "Bao nhiêu tiền?" Mẹ nói: "Tổng cộng 50 tệ." Tôi thấy rất rẻ, vì đồ rất tươi.');
mr($rs,$ra,lid($lmap,2,3),'一次旅行','去年暑假，我和两个朋友一起去了北京旅行。我们坐高铁去的，从上海到北京只要四个半小时。在北京我们去了长城、故宫和天安门广场。还吃了北京烤鸭，很好吃！这次旅行让我很难忘，我希望以后还能再去。','Qùnián shǔjià, wǒ hé liǎng gè péngyou yīqǐ qù le Běijīng lǚxíng. Wǒmen zuò gāotiě qù de, cóng Shànghǎi dào Běijīng zhǐ yào sì gè bàn xiǎoshí. Zài Běijīng wǒmen qù le Chángchéng, Gùgōng hé Tiānānmén Guǎngchǎng. Hái chī le Běijīng kǎoyā, hěn hǎochī! Zhè cì lǚxíng ràng wǒ hěn nánwàng, wǒ xīwàng yǐhòu hái néng zài qù.','Hè năm ngoái, tôi và hai bạn đi Bắc Kinh du lịch. Chúng tôi đi tàu cao tốc, từ Thượng Hải đến Bắc Kinh chỉ mất 4h30. Ở Bắc Kinh chúng tôi đi Vạn Lý Trường Thành, Tử Cấm Thành và Quảng trường Thiên An Môn. Còn ăn vịt quay Bắc Kinh, rất ngon! Chuyến đi này khiến tôi khó quên, hy vọng sau này còn đi nữa.');
mr($rs,$ra,lid($lmap,3,1),'找工作的经历','大学毕业后，我开始找工作。我投了很多简历，也参加了几次面试。最后我通过了一家贸易公司的面试，成为了一名业务员。我的工作主要是和客户沟通、写报告、参加会议。虽然工作很忙，但是我很喜欢这份工作，因为可以学到很多经验。','Dàxué bìyè hòu, wǒ kāishǐ zhǎo gōngzuò. Wǒ tóu le hěn duō jiǎnlì, yě cānjiā le jǐ cì miànshì. Zuìhòu wǒ tōngguò le yī jiā màoyì gōngsī de miànshì, chéngwéi le yī míng yèwùyuán. Wǒ de gōngzuò zhǔyào shì hé kèhù gōutōng, xiě bàogào, cānjiā huìyì. Suīrán gōngzuò hěn máng, dànshì wǒ hěn xǐhuān zhè fèn gōngzuò, yīnwèi kěyǐ xué dào hěn duō jīngyàn.','Sau khi tốt nghiệp đại học, tôi bắt đầu tìm việc. Tôi đã nộp rất nhiều CV và tham gia mấy lần phỏng vấn. Cuối cùng tôi đã qua một công ty thương mại và trở thành nhân viên kinh doanh. Công việc của tôi chủ yếu là giao tiếp với khách hàng, viết báo cáo và tham gia họp. Dù bận nhưng tôi rất thích công việc này vì học được nhiều kinh nghiệm.');
mr($rs,$ra,lid($lmap,3,2),'健康最重要','最近我的身体不太好，总是觉得累。医生说我缺乏锻炼，需要多运动。从那天开始，我每天早上去公园跑步半小时。周末还去游泳或者打篮球。坚持了一个月后，我感觉好多了，身体也越来越健康。我明白了，健康最重要。','Zuìjìn wǒ de shēntǐ bù tài hǎo, zǒngshì juéde lèi. Yīshēng shuō wǒ quēfá duànliàn, xūyào duō yùndòng. Cóng nà tiān kāishǐ, wǒ měitiān zǎoshang qù gōngyuán pǎobù bàn xiǎoshí. Zhōumò hái qù yóuyǒng huòzhě dǎ lánqiú. Jiānchí le yī gè yuè hòu, wǒ gǎnjué hǎo duō le, shēntǐ yě yuè lái yuè jiànkāng. Wǒ míngbai le, jiànkāng zuì zhòngyào.','Gần đây sức khỏe của tôi không tốt, luôn cảm thấy mệt. Bác sĩ nói tôi thiếu vận động, cần tập thể thao nhiều. Từ hôm đó, mỗi sáng tôi chạy bộ ở công viên nửa tiếng. Cuối tuần còn đi bơi hoặc chơi bóng rổ. Sau một tháng kiên trì, tôi thấy khỏe hơn nhiều. Tôi hiểu rằng, sức khỏe là quan trọng nhất.');
mr($rs,$ra,lid($lmap,3,3),'春节的习俗','春节是中国最重要的传统节日。每年春节，人们都会回家团圆，吃年夜饭。大家还会包饺子、贴对联、放鞭炮。长辈会给小孩红包，寓意祝福。大年初一，人们穿新衣服去拜年。庙会上有舞龙舞狮，非常热闹。我每年都盼着过春节。','Chūnjié shì Zhōngguó zuì zhòngyào de chuántǒng jiérì. Měinián chūnjié, rénmen dōu huì huíjiā tuányuán, chī niányèfàn. Dàjiā hái huì bāo jiǎozi, tiē duìlián, fàng biānpào. Zhǎngbèi huì gěi xiǎohái hóngbāo, yùyì zhùfú. Dà nián chū yī, rénmen chuān xīn yīfu qù bàinián. Miàohuì shàng yǒu wǔlóng wǔshī, fēicháng rènao. Wǒ měinián dōu pànzhe guò Chūnjié.','Tết Nguyên đán là ngày lễ truyền thống quan trọng nhất ở Trung Quốc. Mỗi dịp Tết, mọi người đều về nhà sum họp và ăn tất niên. Mọi người còn gói sủi cảo, dán câu đối, đốt pháo. Người lớn tặng trẻ em bao lì xì với ý nghĩa chúc phúc. Mùng 1, mọi người mặc quần áo mới đi chúc Tết. Ở hội chùa có múa rồng múa lân, rất náo nhiệt. Năm nào tôi cũng mong Tết đến.');
mr($rs,$ra,lid($lmap,4,1),'友谊的重要性','人生中，友谊是非常珍贵的。好朋友不仅能在你困难的时候帮助你，也能在你快乐的时候分享你的喜悦。我认为建立友谊需要信任和理解。多跟朋友交流、沟通，互相尊重，友谊才能长久。','Rénshēng zhōng, yǒuyì shì fēicháng zhēnguì de. Hǎo péngyou bùjǐn néng zài nǐ kùnnán de shíhòu bāngzhù nǐ, yě néng zài nǐ kuàilè de shíhòu fēnxiǎng nǐ de xǐyuè. Wǒ rènwéi jiànlì yǒuyì xūyào xìnrèn hé lǐjiě. Duō gēn péngyou jiāoliú, gōutōng, hùxiāng zūnzhòng, yǒuyì cáinéng chángjiǔ.','Trong cuộc sống, tình bạn là rất quý giá. Bạn tốt không những giúp đỡ bạn lúc khó khăn, mà còn chia sẻ niềm vui khi bạn hạnh phúc. Tôi cho rằng xây dựng tình bạn cần sự tin tưởng và thấu hiểu. Giao tiếp nhiều với bạn bè, tôn trọng lẫn nhau thì tình bạn mới lâu dài.');
mr($rs,$ra,lid($lmap,4,2),'人工智能改变生活','人工智能正在改变我们的生活方式。从智能手机到自动驾驶汽车，AI技术无处不在。我们可以用语音控制家电，用手机支付购物，用导航软件找路。未来，人工智能将会在医疗、教育等领域发挥更大的作用。','Réngōng zhìnéng zhèngzài gǎibiàn wǒmen de shēnghuó fāngshì. Cóng zhìnéng shǒujī dào zìdòng jiàshǐ qìchē, AI jìshù wúchù bùzài. Wǒmen kěyǐ yòng yǔyīn kòngzhì jiādiàn, yòng shǒujī zhīfù gòuwù, yòng dǎoháng ruǎnjiàn zhǎo lù. Wèilái, réngōng zhìnéng jiāng huì zài yīliáo, jiàoyù děng lǐngyù fāhuī gèng dà de zuòyòng.','Trí tuệ nhân tạo đang thay đổi cách sống của chúng ta. Từ điện thoại thông minh đến xe tự lái, công nghệ AI có mặt ở khắp nơi. Chúng ta có thể dùng giọng nói điều khiển thiết bị, dùng điện thoại thanh toán, dùng phần mềm định vị tìm đường. Trong tương lai, AI sẽ phát huy vai trò lớn hơn trong y tế, giáo dục,...');
mr($rs,$ra,lid($lmap,5,1),'媒体的社会责任','在现代社会，媒体扮演着重要的角色。新闻媒体应该客观、真实地报道事实，不应该传播虚假信息。同时，我们作为读者也要有判断能力，不盲目相信网络上的每一篇文章。','Zài xiàndài shèhuì, méitǐ bànyǎn zhe zhòngyào de juésè. Xīnwén méitǐ yīnggāi kèguān, zhēnshí de bàodào shìshí, bù yīnggāi chuánbō xǔjiǎ xìnxī. Tóngshí, wǒmen zuòwéi dúzhě yě yào yǒu pànduàn nénglì, bù mángmù xiāngxìn wǎngluò shàng de měi yī piān wénzhāng.','Trong xã hội hiện đại, truyền thông đóng vai trò quan trọng. Báo chí cần đưa tin khách quan, trung thực, không nên lan truyền thông tin giả. Đồng thời, chúng ta với tư cách độc giả cũng cần có khả năng phán đoán, không mù quáng tin vào từng bài viết trên mạng.');
mr($rs,$ra,lid($lmap,6,1),'人生的意义','人生的意义是什么？这是一个古老而深刻的哲学问题。有人认为人生的意义在于追求幸福，有人认为在于实现自我价值。中国古代哲学家孔子说「仁者爱人」，强调人与人之间的关爱。无论我们选择什么样的人生道路，重要的是保持信念、坚持真理。','Rénshēng de yìyì shì shénme? Zhè shì yī gè gǔlǎo ér shēnkè de zhéxué wèntí. Yǒurén rènwéi rénshēng de yìyì zàiyú zhuīqiú xìngfú, yǒurén rènwéi zàiyú shíxiàn zìwǒ jiàzhí. Zhōngguó gǔdài zhéxuéjiā Kǒngzǐ shuō 「rénzhě àirén」, qiángdiào rén yǔ rén zhījiān de guānài. Wúlùn wǒmen xuǎnzé shénme yàng de rénshēng dàolù, zhòngyào de shì bǎochí xìnniàn, jiānchí zhēnlǐ.','Ý nghĩa cuộc sống là gì? Đây là một câu hỏi triết học cổ xưa và sâu sắc. Có người cho rằng ý nghĩa cuộc sống là theo đuổi hạnh phúc, có người cho rằng là thực hiện giá trị bản thân. Nhà triết học cổ đại Trung Quốc Khổng Tử nói "người nhân yêu người", nhấn mạnh sự quan tâm giữa người với người. Dù chọn con đường nào, điều quan trọng là giữ vững tín niệm và kiên trì chân lý.');

echo "$ra readings inserted.\n";
// ═══════════════ LISTENING ═══════════════
echo "Inserting listening exercises...\n";
$ls = $conn->prepare("INSERT IGNORE INTO listening_exercises (lesson_id,title,transcript,transcript_pinyin,transcript_vi,sort_order) VALUES (?,?,?,?,?,?)");
$lqs = $conn->prepare("INSERT IGNORE INTO listening_questions (listening_id,question,options,answer,type,sort_order) VALUES (?,?,?,?,?,?)");
$la = 0; $lqa = 0;
function ml($ls,$lqs,&$la,&$lqa,$lid,$t,$tr,$trp,$trv,$q) {
    global $conn;
    try { $ls->execute([$lid,$t,$tr,$trp,$trv,1]); $la++; } catch(Exception $x) {}
    $q2 = $conn->prepare("SELECT id FROM listening_exercises WHERE lesson_id=? AND title=?");
    $q2->execute([$lid,$t]); $lid2 = $q2->fetchColumn();
    if (!$lid2) return;
    foreach ($q as $i=>$qq) {
        try { $lqs->execute([$lid2, $qq[0], $qq[1], $qq[2], $qq[3], $i]); $lqa++; } catch(Exception $x) {}
    }
}

ml($ls,$lqs,$la,$lqa,lid($lmap,1,1),'Nghe và chọn đáp án đúng','A: 你好！我叫王明。B: 你好！我叫李华。很高兴认识你。','A: Nǐ hǎo! Wǒ jiào Wáng Míng. B: Nǐ hǎo! Wǒ jiào Lǐ Huá. Hěn gāoxìng rènshi nǐ.','A: Xin chào! Tôi là Vương Minh. B: Xin chào! Tôi là Lý Hoa. Rất vui được quen bạn.',[
    ['Người thứ nhất tên là gì?','["Vương Minh","Lý Hoa","Vương Hoa","Lý Minh"]','Vương Minh','multiple_choice'],
    ['Họ dùng ngôn ngữ gì để chào?','["Tiếng Anh","Tiếng Trung","Tiếng Việt","Tiếng Nhật"]','Tiếng Trung','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,1,2),'Nghe về gia đình','A: 你家有几口人？B: 我家有五口人，爸爸、妈妈、一个哥哥、一个妹妹和我。','A: Nǐ jiā yǒu jǐ kǒu rén? B: Wǒ jiā yǒu wǔ kǒu rén, bàba, māma, yī gè gēge, yī gè mèimei hé wǒ.','A: Nhà bạn có mấy người? B: Nhà tôi có 5 người: bố, mẹ, một anh trai, một em gái và tôi.',[
    ['Bạn đó có mấy anh trai?','["0","1","2","3"]','1','multiple_choice'],
    ['Nhà bạn đó có mấy người?','["3","4","5","6"]','5','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,1,3),'Nghe thời gian','A: 现在几点？B: 现在八点四十五分。A: 我九点上课。','A: Xiànzài jǐ diǎn? B: Xiànzài bā diǎn sìshíwǔ fēn. A: Wǒ jiǔ diǎn shàngkè.','A: Bây giờ mấy giờ? B: Bây giờ 8h45. A: Tôi 9h vào học.',[
    ['Hiện tại là mấy giờ?','["8:30","8:45","9:00","8:15"]','8:45','multiple_choice'],
    ['Cô ấy mấy giờ vào học?','["9:00","8:45","10:00","8:30"]','9:00','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,2,1),'Nghe sinh hoạt hàng ngày','A: 你每天几点起床？B: 我六点半起床，然后去跑步。A: 跑步以后做什么？B: 回家洗澡，吃早饭。','A: Nǐ měitiān jǐ diǎn qǐchuáng? B: Wǒ liù diǎn bàn qǐchuáng, ránhòu qù pǎobù. A: Pǎobù yǐhòu zuò shénme? B: Huíjiā xǐzǎo, chī zǎofàn.','A: Mỗi ngày bạn dậy mấy giờ? B: Tôi dậy 6h30 rồi đi chạy bộ. A: Chạy xong làm gì? B: Về nhà tắm, ăn sáng.',[
    ['Người đó dậy lúc mấy giờ?','["6:00","6:30","7:00","5:30"]','6:30','multiple_choice'],
    ['Sau khi chạy bộ làm gì?','["Đi làm","Đi học","Tắm và ăn sáng","Ngủ tiếp"]','Tắm và ăn sáng','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,2,2),'Nghe mua sắm','A: 这个苹果多少钱？B: 五块一斤。A: 很便宜，我要三斤。B: 还要别的吗？A: 不要了，谢谢。','A: Zhège píngguǒ duōshao qián? B: Wǔ kuài yī jīn. A: Hěn piányi, wǒ yào sān jīn. B: Hái yào biéde ma? A: Bù yào le, xièxie.','A: Táo này bao nhiêu? B: 5 tệ một cân. A: Rẻ quá, tôi lấy 3 cân. B: Còn cần gì nữa không? A: Không cần ạ, cảm ơn.',[
    ['Táo bao nhiêu một cân?','["3 tệ","4 tệ","5 tệ","6 tệ"]','5 tệ','multiple_choice'],
    ['Khách mua mấy cân?','["1 cân","2 cân","3 cân","4 cân"]','3 cân','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,2,3),'Nghe du lịch','A: 暑假你去哪儿？B: 去上海。A: 怎么去？B: 坐高铁，四个半小时。A: 酒店订了吗？B: 订了。','A: Shǔjià nǐ qù nǎr? B: Qù Shànghǎi. A: Zěnme qù? B: Zuò gāotiě, sì gè bàn xiǎoshí. A: Jiǔdiàn dìng le ma? B: Dìng le.','A: Hè này bạn đi đâu? B: Đi Thượng Hải. A: Đi bằng gì? B: Tàu cao tốc, 4 tiếng rưỡi. A: Đặt khách sạn chưa? B: Đặt rồi.',[
    ['Họ đi đâu vào hè?','["Bắc Kinh","Thượng Hải","Quảng Châu","Thâm Quyến"]','Thượng Hải','multiple_choice'],
    ['Đi bằng phương tiện gì?','["Máy bay","Tàu hỏa","Tàu cao tốc","Xe buýt"]','Tàu cao tốc','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,3,1),'Nghe phỏng vấn','A: 你学什么专业？B: 我学国际贸易。A: 有工作经验吗？B: 有一年相关经验。A: 好，我们会在三天内通知你。','A: Nǐ xué shénme zhuānyè? B: Wǒ xué guójì màoyì. A: Yǒu gōngzuò jīngyàn ma? B: Yǒu yī nián xiāngguān jīngyàn. A: Hǎo, wǒmen huì zài sān tiān nèi tōngzhī nǐ.','A: Bạn học chuyên ngành gì? B: Tôi học thương mại quốc tế. A: Có kinh nghiệm không? B: Có 1 năm kinh nghiệm. A: Tốt, chúng tôi sẽ thông báo trong 3 ngày.',[
    ['Chuyên ngành của ứng viên là gì?','["Kinh tế","TMQT","Tài chính","Kế toán"]','TMQT','multiple_choice'],
    ['Khi nào sẽ thông báo?','["Trong 1 ngày","Trong 3 ngày","Trong 1 tuần","Sau phỏng vấn"]','Trong 3 ngày','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,3,2),'Nghe sức khỏe','A: 你脸色不太好，怎么了？B: 我感冒了，头疼。A: 去看医生了吗？B: 看了，医生让我多休息。','A: Nǐ liǎnsè bù tài hǎo, zěnme le? B: Wǒ gǎnmào le, tóuténg. A: Qù kàn yīshēng le ma? B: Kàn le, yīshēng ràng wǒ duō xiūxi.','A: Mặt bạn không tốt, sao vậy? B: Tôi bị cảm, đau đầu. A: Đi khám chưa? B: Khám rồi, bác sĩ bảo nghỉ nhiều.',[
    ['Người đó bị làm sao?','["Đau bụng","Đau đầu","Đau chân","Đau răng"]','Đau đầu','multiple_choice'],
    ['Bác sĩ khuyên gì?','["Tập thể dục","Nghỉ ngơi","Ăn nhiều","Uống thuốc"]','Nghỉ ngơi','multiple_choice'],
]);
ml($ls,$lqs,$la,$lqa,lid($lmap,4,1),'Nghe mời sinh nhật','A: 明天是我的生日，晚上来我家吃饭吧。B: 好啊！几点？A: 七点。B: 需要我带什么吗？A: 不用，人来就行。','A: Míngtiān shì wǒ de shēngrì, wǎnshang lái wǒ jiā chīfàn ba. B: Hǎo a! Jǐ diǎn? A: Qī diǎn. B: Xūyào wǒ dài shénme ma? A: Bùyòng, rén lái jiù xíng.','A: Ngày mai là sinh nhật tôi, tối đến nhà ăn cơm nhé. B: Được! Mấy giờ? A: 7 giờ. B: Cần mang gì không? A: Không cần, người đến là được.',[
    ['Sinh nhật khi nào?','["Hôm qua","Hôm nay","Ngày mai","Cuối tuần"]','Ngày mai','multiple_choice'],
    ['Khách cần mang gì?','["Đồ uống","Bánh","Hoa","Không cần"]','Không cần','multiple_choice'],
]);

echo "$la listening, $lqa questions inserted.\n";

// ── FINAL ──
$conn->exec("SET FOREIGN_KEY_CHECKS = 1");
$vc2 = $conn->query("SELECT COUNT(*) FROM vocab")->fetchColumn();
$gc2 = $conn->query("SELECT COUNT(*) FROM grammar")->fetchColumn();
$dc2 = $conn->query("SELECT COUNT(*) FROM dialogues")->fetchColumn();
$rc2 = $conn->query("SELECT COUNT(*) FROM readings")->fetchColumn();
$lc2 = $conn->query("SELECT COUNT(*) FROM listening_exercises")->fetchColumn();
echo "\n=== SEED COMPLETE ===\n";
echo "  Vocab: $vc2 words\n";
echo "  Grammar: $gc2 points\n";
echo "  Dialogues: $dc2\n";
echo "  Readings: $rc2\n";
echo "  Listening: $lc2\n";
echo "Done!\n";
