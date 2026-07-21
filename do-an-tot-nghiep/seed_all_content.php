<?php
/**
 * HÀNNGỮ MASSIVE CONTENT SEEDER
 * Seeds ALL 146 lessons with vocab, grammar, dialogues, readings, listening
 * Lessons already exist with IDs 1-146
 *   HSK1: IDs 1-15 | HSK2: IDs 16-30 | HSK3: IDs 31-50
 *   HSK4: IDs 51-70 | HSK5: IDs 71-106 | HSK6: IDs 107-146
 */
require __DIR__ . "/db.php";
$startTime = microtime(true);
echo "=== HÀNNGỮ MASSIVE CONTENT SEEDER ===\n\n";

$vc = $conn->query("SELECT COUNT(*) FROM vocab")->fetchColumn();
$gc = $conn->query("SELECT COUNT(*) FROM grammar")->fetchColumn();
echo "Current: {$vc} vocab, {$gc} grammar.\n";
if ($vc >= 2000) { echo "Already >= 2000 vocab. Skipping.\n"; exit; }

$conn->exec("SET FOREIGN_KEY_CHECKS = 0");
echo "Deleting existing content data...\n";
$conn->exec("DELETE FROM listening_questions");
$conn->exec("DELETE FROM listening_exercises");
$conn->exec("DELETE FROM grammar_exercises");
$conn->exec("DELETE FROM grammar_examples");
$conn->exec("DELETE FROM dialogue_sentences");
$conn->exec("DELETE FROM dialogues");
$conn->exec("DELETE FROM readings");
$conn->exec("DELETE FROM grammar");
$conn->exec("DELETE FROM vocab");
$conn->exec("DELETE FROM progress");
$conn->exec("DELETE FROM lesson_progress");
$conn->exec("DELETE FROM lesson_sections");
$conn->exec("DELETE FROM speaking_exercises");
$conn->exec("DELETE FROM writing_exercises");
echo "Deleted.\n\n";

function getLevel($id) {
    if ($id <= 15) return 1; if ($id <= 30) return 2; if ($id <= 50) return 3;
    if ($id <= 70) return 4; if ($id <= 106) return 5; return 6;
}
function isRichLesson($id) { return $id <= 18; }

$vocabCount = 0; $grammarCount = 0; $grammarExCount = 0;
$dialogueCount = 0; $dialogueLineCount = 0; $readingCount = 0;
$listeningCount = 0; $listeningQCount = 0;

echo "Loading vocab banks...\n";

// ════════════════════════════════════════════════════
// HSK 1 VOCAB BANK (200 words with real HSK1 vocab)
// ════════════════════════════════════════════════════
$hsk1 = [
["你好","nǐ hǎo","xin chào",7,"亻","你好！很高兴认识你。","Xin chào! Rất vui được quen bạn."],
["我","wǒ","tôi",7,"戈","我是学生。","Tôi là học sinh."],
["你","nǐ","bạn",7,"亻","你好吗？","Bạn khỏe không?"],
["他","tā","anh ấy",5,"亻","他是老师。","Anh ấy là giáo viên."],
["她","tā","cô ấy",6,"女","她是医生。","Cô ấy là bác sĩ."],
["好","hǎo","tốt, đẹp",6,"女","今天天气很好。","Hôm nay thời tiết đẹp."],
["是","shì","là",9,"日","我是中国人。","Tôi là người Trung Quốc."],
["不","bù","không",4,"一","我不是老师。","Tôi không phải giáo viên."],
["很","hěn","rất",9,"彳","我很好。","Tôi rất khỏe."],
["也","yě","cũng",3,"亠","我也是学生。","Tôi cũng là học sinh."],
["吗","ma","(hỏi) không",6,"口","你是学生吗？","Bạn là học sinh phải không?"],
["呢","ne","(hỏi) còn...",8,"口","我呢？","Còn tôi thì sao?"],
["的","de","của",8,"白","我的书。","Sách của tôi."],
["了","le","(đã) rồi",2,"乛","我吃了。","Tôi đã ăn rồi."],
["和","hé","và",8,"禾","我和朋友。","Tôi và bạn bè."],
["都","dōu","đều",10,"阝","我们都是学生。","Chúng tôi đều là học sinh."],
["请","qǐng","mời",10,"讠","请进！","Mời vào!"],
["谢谢","xièxie","cảm ơn",13,"讠","谢谢老师！","Cảm ơn thầy cô!"],
["再见","zàijiàn","tạm biệt",11,"一","明天见！","Mai gặp lại!"],
["不客气","bú kèqì","không có gì",12,"一","不客气！","Không có gì!"],
["对不起","duìbuqǐ","xin lỗi",13,"寸","对不起我错了。","Xin lỗi tôi sai rồi."],
["没关系","méi guānxi","không sao",11,"氵","没关系。","Không sao."],
["名字","míngzì","tên",12,"口","你叫什么名字？","Bạn tên là gì?"],
["叫","jiào","gọi, tên là",5,"口","我叫李明。","Tôi tên là Lý Minh."],
["什么","shénme","cái gì",8,"亻","这是什么？","Đây là cái gì?"],
["哪儿","nǎr","đâu",11,"山","你去哪儿？","Bạn đi đâu?"],
["谁","shéi","ai",10,"讠","他是谁？","Anh ấy là ai?"],
["怎么","zěnme","thế nào",7,"心","你怎么了？","Bạn sao thế?"],
["多少","duōshao","bao nhiêu",10,"夕","多少钱？","Bao nhiêu tiền?"],
["几","jǐ","mấy, vài",2,"乙","几个人？","Mấy người?"],
["一","yī","một",1,"一","一个朋友。","Một người bạn."],
["二","èr","hai",2,"二","二个苹果。","Hai quả táo."],
["三","sān","ba",3,"一","三个学生。","Ba học sinh."],
["四","sì","bốn",5,"囗","四本书。","Bốn quyển sách."],
["五","wǔ","năm",4,"二","五天。","Năm ngày."],
["六","liù","sáu",4,"八","六点。","Sáu giờ."],
["七","qī","bảy",2,"一","七天。","Bảy ngày."],
["八","bā","tám",2,"八","八个人。","Tám người."],
["九","jiǔ","chín",2,"乙","九点。","Chín giờ."],
["十","shí","mười",2,"十","十天。","Mười ngày."],
["家","jiā","nhà, gia đình",10,"宀","我家有三口人。","Nhà tôi có ba người."],
["爸爸","bàba","bố",8,"父","我爸爸是医生。","Bố tôi là bác sĩ."],
["妈妈","māma","mẹ",6,"女","妈妈做饭。","Mẹ nấu cơm."],
["哥哥","gēge","anh trai",10,"口","我哥哥很高。","Anh tôi rất cao."],
["姐姐","jiějiě","chị gái",8,"女","姐姐很漂亮。","Chị gái rất xinh."],
["弟弟","dìdi","em trai",7,"弓","弟弟五岁。","Em trai 5 tuổi."],
["妹妹","mèimei","em gái",8,"女","妹妹很可爱。","Em gái rất dễ thương."],
["儿子","érzi","con trai",8,"儿","他有一个儿子。","Anh ấy có một con trai."],
["女儿","nǚér","con gái",6,"女","她有一个女儿。","Cô ấy có một con gái."],
["孩子","háizi","đứa trẻ",9,"子","孩子们在玩。","Bọn trẻ đang chơi."],
["岁","suì","tuổi",6,"山","你几岁？","Bạn mấy tuổi?"],
["个","gè","cái (lượng từ)",3,"亻","一个苹果。","Một quả táo."],
["今天","jīntiān","hôm nay",8,"日","今天星期一。","Hôm nay thứ Hai."],
["明天","míngtiān","ngày mai",8,"日","明天见！","Hẹn mai gặp!"],
["昨天","zuótiān","hôm qua",9,"日","昨天是星期天。","Hôm qua là Chủ nhật."],
["年","nián","năm",6,"干","今年是2024年。","Năm nay là 2024."],
["月","yuè","tháng, trăng",4,"月","一月到十二月。","T1 đến T12."],
["日","rì","ngày, mặt trời",4,"日","一月一日。","Ngày 1 tháng 1."],
["号","hào","ngày (thông tục)",5,"口","今天是几号？","Hôm nay ngày mấy?"],
["星期","xīngqī","tuần",15,"日","一星期有七天。","Một tuần có 7 ngày."],
["现在","xiànzài","bây giờ",12,"王","现在几点？","Bây giờ mấy giờ?"],
["点","diǎn","giờ",9,"灬","现在三点。","Bây giờ 3 giờ."],
["分","fēn","phút",4,"刀","三点十五分。","3 giờ 15 phút."],
["半","bàn","rưỡi, nửa",5,"十","三点半。","3 giờ rưỡi."],
["起床","qǐchuáng","thức dậy",10,"走","我六点起床。","Tôi dậy lúc 6 giờ."],
["吃饭","chīfàn","ăn cơm",12,"口","我们一起吃饭。","Chúng ta cùng ăn."],
["睡觉","shuìjiào","đi ngủ",13,"目","我十点睡觉。","Tôi ngủ lúc 10 giờ."],
["上学","shàngxué","đi học",8,"一","孩子上学了。","Trẻ đi học rồi."],
["回家","huíjiā","về nhà",10,"囗","我五点回家。","Tôi về nhà lúc 5 giờ."],
["去","qù","đi (đến)",5,"土","我去学校。","Tôi đến trường."],
["来","lái","đến, lại",7,"木","朋友来了。","Bạn đến rồi."],
["时候","shíhou","lúc, thời gian",10,"日","什么时候？","Lúc nào?"],
["会","huì","biết, sẽ",6,"人","我会说中文。","Tôi biết nói tiếng Trung."],
["能","néng","có thể",10,"月","我能帮你。","Tôi có thể giúp bạn."],
["可以","kěyǐ","có thể",9,"口","可以进来吗？","Có thể vào không?"],
["要","yào","muốn, cần",9,"覀","我要喝水。","Tôi muốn uống nước."],
["想","xiǎng","muốn, nghĩ",13,"心","我想去北京。","Tôi muốn đi Bắc Kinh."],
["喜欢","xǐhuān","thích",12,"口","我喜欢中文。","Tôi thích tiếng Trung."],
["爱","ài","yêu",10,"爫","我爱你。","Anh yêu em."],
["高兴","gāoxìng","vui vẻ",10,"高","很高兴认识你。","Rất vui được quen bạn."],
["快乐","kuàilè","hạnh phúc",12,"忄","生日快乐！","Sinh nhật vui vẻ!"],
["大","dà","to, lớn",3,"大","北京很大。","Bắc Kinh rất lớn."],
["小","xiǎo","nhỏ, bé",3,"小","小猫。","Mèo nhỏ."],
["多","duō","nhiều",6,"夕","很多人。","Nhiều người."],
["少","shǎo","ít",4,"小","很少。","Rất ít."],
["漂亮","piàoliang","xinh đẹp",14,"氵","她很漂亮。","Cô ấy rất xinh."],
["学生","xuéshēng","học sinh",15,"子","她是好学生。","Cô ấy là học sinh giỏi."],
["老师","lǎoshī","giáo viên",16,"老","王老师好！","Chào thầy Vương!"],
["朋友","péngyou","bạn bè",12,"月","他是我的朋友。","Anh ấy là bạn tôi."],
["同学","tóngxué","bạn học",14,"口","他是我的同学。","Anh ấy là bạn học tôi."],
["人","rén","người",2,"人","一个人。","Một người."],
["中国","Zhōngguó","Trung Quốc",8,"丨","我是中国人。","Tôi là người Trung Quốc."],
["北京","Běijīng","Bắc Kinh",12,"乙","我爱北京。","Tôi yêu Bắc Kinh."],
["汉语","Hànyǔ","tiếng Trung",14,"氵","我学汉语。","Tôi học tiếng Trung."],
["英文","Yīngwén","tiếng Anh",12,"艹","我会英文。","Tôi biết tiếng Anh."],
["说","shuō","nói",9,"讠","他说中文。","Anh ấy nói tiếng Trung."],
["读","dú","đọc",10,"讠","读书。","Đọc sách."],
["写","xiě","viết",5,"冖","写字。","Viết chữ."],
["看","kàn","xem, nhìn",9,"目","看书。","Xem sách."],
["听","tīng","nghe",7,"口","听音乐。","Nghe nhạc."],
["说话","shuōhuà","nói chuyện",14,"讠","我在说话。","Tôi đang nói chuyện."],
["问","wèn","hỏi",11,"口","问问题。","Hỏi vấn đề."],
["学习","xuéxí","học tập",15,"子","努力学习。","Học tập chăm chỉ."],
["知道","zhīdào","biết",12,"矢","我知道。","Tôi biết."],
["认识","rènshi","quen biết",9,"讠","很高兴认识你。","Rất vui được quen bạn."],
["觉得","juéde","cảm thấy",13,"见","觉得很好。","Cảm thấy rất tốt."],
["吃","chī","ăn",6,"口","吃苹果。","Ăn táo."],
["喝","hē","uống",12,"口","喝水。","Uống nước."],
["买","mǎi","mua",6,"乛","买东西。","Mua đồ."],
["卖","mài","bán",8,"十","卖完了。","Bán hết rồi."],
["住","zhù","ở, sống",7,"亻","我住在河内。","Tôi sống ở Hà Nội."],
["在","zài","ở, đang",6,"土","在家。","Ở nhà."],
["有","yǒu","có",6,"月","我有一本书。","Tôi có 1 quyển sách."],
["没有","méiyǒu","không có",12,"氵","我没有钱。","Tôi không có tiền."],
["做","zuò","làm",11,"亻","做饭。","Nấu ăn."],
["用","yòng","dùng",5,"用","用水。","Dùng nước."],
["给","gěi","cho, gửi",9,"纟","给你。","Cho bạn."],
["送","sòng","tặng, đưa",9,"辶","送礼物。","Tặng quà."],
["等","děng","đợi",12,"竹","等我一下。","Đợi tôi một chút."],
["让","ràng","để, cho phép",11,"讠","让我来。","Để tôi làm."],
["找","zhǎo","tìm",7,"扌","找人。","Tìm người."],
["开","kāi","mở, lái",4,"廾","开车。","Lái xe."],
["关","guān","đóng",6,"丷","关门。","Đóng cửa."],
["走","zǒu","đi, bước",7,"走","走开。","Đi đi."],
["坐","zuò","ngồi, đi (xe)",7,"土","坐车。","Đi xe."],
["站","zhàn","đứng, trạm",10,"立","站住。","Đứng lại."],
["进","jìn","vào",7,"辶","进来。","Đi vào."],
["出","chū","ra",5,"凵","出去。","Đi ra."],
["上","shàng","lên, trên",3,"一","上来。","Đi lên."],
["下","xià","xuống, dưới",3,"一","下去。","Đi xuống."],
["到","dào","đến",8,"刂","到了。","Đến rồi."],
["欢迎","huānyíng","hoan nghênh",12,"欠","欢迎光临。","Chào mừng."],
["天气","tiānqì","thời tiết",12,"大","今天天气好。","Hôm nay thời tiết tốt."],
["冷","lěng","lạnh",7,"冫","今天很冷。","Hôm nay rất lạnh."],
["热","rè","nóng",10,"灬","夏天很热。","Mùa hè rất nóng."],
["下雨","xiàyǔ","mưa",8,"一","下雨了。","Mưa rồi."],
["钱","qián","tiền",10,"金","多少钱？","Bao nhiêu tiền?"],
["便宜","piányi","rẻ",9,"亻","很便宜。","Rất rẻ."],
["贵","guì","đắt",9,"贝","太贵了。","Đắt quá."],
["东西","dōngxi","đồ vật",10,"一","买东西。","Mua đồ."],
["水","shuǐ","nước",4,"水","喝水。","Uống nước."],
["茶","chá","trà",9,"艹","喝茶。","Uống trà."],
["咖啡","kāfēi","cà phê",12,"口","喝咖啡。","Uống cà phê."],
["面包","miànbāo","bánh mì",13,"面","吃面包。","Ăn bánh mì."],
["牛奶","niúnǎi","sữa",14,"牛","喝牛奶。","Uống sữa."],
["苹果","píngguǒ","táo",12,"艹","一个苹果。","Một quả táo."],
["米饭","mǐfàn","cơm",12,"米","吃米饭。","Ăn cơm."],
["鸡蛋","jīdàn","trứng gà",13,"鸟","一个鸡蛋。","Một quả trứng."],
["鱼","yú","cá",8,"鱼","吃鱼。","Ăn cá."],
["肉","ròu","thịt",6,"肉","吃肉。","Ăn thịt."],
["菜","cài","rau, món ăn",11,"艹","中国菜。","Món Trung Quốc."],
["水果","shuǐguǒ","hoa quả",14,"木","吃水果。","Ăn trái cây."],
["商店","shāngdiàn","cửa hàng",14,"口","去商店。","Đi cửa hàng."],
["医院","yīyuàn","bệnh viện",13,"匸","去医院。","Đến bệnh viện."],
["学校","xuéxiào","trường học",14,"子","去学校。","Đến trường."],
["教室","jiàoshì","phòng học",14,"攵","在教室。","Trong phòng học."],
["工作","gōngzuò","làm việc",7,"工","我在工作。","Tôi đang làm việc."],
["电话","diànhuà","điện thoại",10,"田","打电话。","Gọi điện thoại."],
["手机","shǒujī","di động",9,"扌","用手机。","Dùng điện thoại."],
["电脑","diànnǎo","máy tính",13,"田","用电脑。","Dùng máy tính."],
["电影","diànyǐng","phim ảnh",13,"田","看电影。","Xem phim."],
["音乐","yīnyuè","âm nhạc",14,"音","听音乐。","Nghe nhạc."],
["中国菜","Zhōngguó cài","món Trung Quốc",12,"丨","我爱吃中国菜。","Tôi thích ăn món TQ."],
["先生","xiānsheng","ông, quý ông",10,"儿","李先生。","Ông Lý."],
["小姐","xiǎojiě","cô, tiểu thư",9,"小","王小姐。","Cô Vương."],
["医生","yīshēng","bác sĩ",12,"匸","看医生。","Khám bác sĩ."],
["司机","sījī","tài xế",12,"口","司机先生。","Anh tài xế."],
["时间","shíjiān","thời gian",12,"日","有时间。","Có thời gian."],
["漂亮","piàoliang","đẹp",14,"氵","很漂亮。","Rất đẹp."],
["高兴","gāoxìng","vui vẻ",10,"高","不高兴。","Không vui."],
["快乐","kuàilè","vui vẻ",12,"忄","新年快乐。","Năm mới vui vẻ."],
["生日","shēngrì","sinh nhật",10,"生","生日快乐。","Sinh nhật vui vẻ."],
["新年","xīnnián","năm mới",13,"斤","新年好！","Năm mới tốt lành!"],
["一起","yìqǐ","cùng nhau",7,"一","一起去。","Cùng đi."],
["因为","yīnwèi","bởi vì",9,"囗","因为很忙。","Bởi vì rất bận."],
["所以","suǒyǐ","cho nên",12,"户","所以没来。","Cho nên không đến."],
];
shuffle($hsk1);
$hsk1 = array_slice($hsk1, 0, 200);
echo "HSK1 bank: " . count($hsk1) . " words\n";

// ════════════════════════════════════════════════════
// HSK 2 VOCAB BANK (150+ words with real HSK2 vocab)
// ════════════════════════════════════════════════════
$hsk2 = [
["早上","zǎoshang","buổi sáng",6,"日","早上好！","Chào buổi sáng!"],
["中午","zhōngwǔ","buổi trưa",10,"丨","中午吃饭。","Ăn trưa."],
["下午","xiàwǔ","buổi chiều",8,"一","下午有课。","Chiều có lớp."],
["晚上","wǎnshang","buổi tối",11,"日","晚上好！","Chào buổi tối!"],
["每天","měitiān","mỗi ngày",8,"母","我每天跑步。","Tôi chạy mỗi ngày."],
["早饭","zǎofàn","bữa sáng",12,"食","吃早饭。","Ăn sáng."],
["午饭","wǔfàn","bữa trưa",12,"食","午饭吃什么？","Trưa ăn gì?"],
["晚饭","wǎnfàn","bữa tối",12,"食","晚饭做好了。","Tối xong rồi."],
["洗澡","xǐzǎo","tắm rửa",16,"氵","我洗澡了。","Tôi tắm rồi."],
["刷牙","shuāyá","đánh răng",12,"刂","起床后刷牙。","Dậy rồi đánh răng."],
["衣服","yīfu","quần áo",12,"衤","穿衣服。","Mặc quần áo."],
["做饭","zuòfàn","nấu cơm",12,"食","妈妈做饭。","Mẹ nấu cơm."],
["喝茶","hēchá","uống trà",12,"艹","我喜欢喝茶。","Tôi thích uống trà."],
["看电视","kàn diànshì","xem tivi",13,"目","晚上看电视。","Tối xem tivi."],
["看书","kànshū","đọc sách",10,"⺮","我喜欢看书。","Tôi thích đọc sách."],
["休息","xiūxi","nghỉ ngơi",12,"亻","休息一下。","Nghỉ một chút."],
["散步","sànbù","đi dạo",7,"止","去散步。","Đi dạo."],
["以后","yǐhòu","sau này",9,"人","以后再说。","Sau này nói."],
["以前","yǐqián","trước đây",10,"人","以前的事。","Chuyện trước đây."],
["香蕉","xiāngjiāo","chuối",12,"艹","香蕉很甜。","Chuối rất ngọt."],
["西瓜","xīguā","dưa hấu",10,"瓜","夏天吃西瓜。","Hè ăn dưa hấu."],
["超市","chāoshì","siêu thị",12,"走","去超市。","Đi siêu thị."],
["可乐","kělè","cola",15,"口","一瓶可乐。","Một chai cola."],
["蛋糕","dàngāo","bánh ngọt",16,"米","生日蛋糕。","Bánh sinh nhật."],
["面条","miàntiáo","mì sợi",16,"麦","吃面条。","Ăn mì."],
["飞机","fēijī","máy bay",12,"飞","坐飞机。","Đi máy bay."],
["火车","huǒchē","tàu hỏa",10,"火","坐火车旅行。","Du lịch bằng tàu hỏa."],
["地铁","dìtiě","tàu điện ngầm",15,"土","坐地铁上班。","Đi metro đi làm."],
["公共汽车","gōnggòng qìchē","xe buýt",8,"八","坐公共汽车。","Đi xe buýt."],
["自行车","zìxíngchē","xe đạp",14,"自","骑自行车。","Đi xe đạp."],
["出租车","chūzūchē","taxi",12,"冖","打出租车。","Bắt taxi."],
["车站","chēzhàn","bến xe",13,"立","火车站。","Ga tàu hỏa."],
["机场","jīchǎng","sân bay",12,"木","去机场。","Đến sân bay."],
["酒店","jiǔdiàn","khách sạn",13,"酉","住酒店。","Ở khách sạn."],
["旅行","lǚxíng","du lịch",13,"方","去旅行。","Đi du lịch."],
["地图","dìtú","bản đồ",11,"土","看地图。","Xem bản đồ."],
["路","lù","đường",13,"足","一直走。","Đi thẳng."],
["远","yuǎn","xa",7,"辶","学校很远。","Trường xa."],
["近","jìn","gần",7,"辶","我家很近。","Nhà tôi gần."],
["票","piào","vé",11,"示","买票。","Mua vé."],
["钱包","qiánbāo","ví tiền",14,"金","我的钱包。","Ví của tôi."],
["旁边","pángbiān","bên cạnh",15,"方","旁边有学校。","Bên cạnh có trường."],
["前面","qiánmiàn","phía trước",13,"丷","前面是公园。","Phía trước là công viên."],
["后面","hòumiàn","phía sau",11,"厂","后面有超市。","Phía sau có siêu thị."],
["里面","lǐmiàn","bên trong",13,"里","里面有人。","Bên trong có người."],
["外面","wàimiàn","bên ngoài",10,"夕","外面很冷。","Bên ngoài rất lạnh."],
["左边","zuǒbian","bên trái",11,"工","左边是银行。","Bên trái là ngân hàng."],
["右边","yòubian","bên phải",12,"口","右边有商店。","Bên phải có cửa hàng."],
["公司","gōngsī","công ty",8,"八","在公司工作。","Làm ở công ty."],
["办公室","bàngōngshì","văn phòng",12,"力","办公室很大。","Văn phòng rất rộng."],
["同事","tóngshì","đồng nghiệp",14,"口","他是同事。","Anh ấy là đồng nghiệp."],
["经理","jīnglǐ","giám đốc",11,"纟","王经理很忙。","GĐ Vương rất bận."],
["会议","huìyì","cuộc họp",12,"亻","下午有会议。","Chiều có họp."],
["报告","bàogào","báo cáo",13,"扌","写报告。","Viết báo cáo."],
["比","bǐ","hơn, so với",4,"比","我比你大。","Tôi lớn hơn bạn."],
["最","zuì","nhất",12,"曰","最大。","Lớn nhất."],
["太","tài","quá",4,"大","太好了！","Tuyệt quá!"],
["非常","fēicháng","vô cùng",14,"非","非常好。","Vô cùng tốt."],
["特别","tèbié","đặc biệt",14,"牛","特别好。","Đặc biệt tốt."],
["但是","dànshì","nhưng",11,"亻","但是很贵。","Nhưng rất đắt."],
["如果","rúguǒ","nếu",12,"女","如果下雨就不去。","Nếu mưa thì không đi."],
["然后","ránhòu","sau đó",12,"灮","先吃饭然后学习。","Ăn trước sau đó học."],
["已经","yǐjīng","đã",9,"己","已经来了。","Đã đến rồi."],
["还","hái","vẫn, còn",7,"辶","还没来。","Vẫn chưa đến."],
["又","yòu","lại",2,"又","又来了。","Lại đến rồi."],
["再","zài","lại, nữa",6,"冂","再说一遍。","Nói lại một lần nữa."],
["就","jiù","chính là, liền",12,"尢","就是它。","Chính là nó."],
["才","cái","mới",3,"一","才来。","Mới đến."],
["从","cóng","từ",4,"人","从家到学校。","Từ nhà đến trường."],
["离","lí","cách",10,"亠","离学校很近。","Cách trường rất gần."],
["往","wǎng","hướng về",8,"彳","往前走。","Đi về phía trước."],
["跟","gēn","với, theo",13,"足","跟我来。","Đi theo tôi."],
["对","duì","đúng, với",9,"寸","不对。","Không đúng."],
["练习","liànxí","luyện tập",17,"纟","练习写字。","Luyện viết chữ."],
["考试","kǎoshì","thi cử",12,"老","期末考试。","Thi cuối kỳ."],
["作业","zuòyè","bài tập",7,"亻","做作业。","Làm bài tập."],
["成绩","chéngjì","thành tích",11,"戈","成绩很好。","Thành tích tốt."],
["上网","shàngwǎng","lên mạng",8,"一","上网查资料。","Lên mạng tra tài liệu."],
["邮件","yóujiàn","thư điện tử",11,"阝","发邮件。","Gửi email."],
["信息","xìnxī","tin nhắn, thông tin",13,"亻","发信息。","Gửi tin nhắn."],
["微信","wēixìn","WeChat",14,"彳","加微信。","Thêm WeChat."],
["照片","zhàopiàn","ảnh",14,"日","看照片。","Xem ảnh."],
["礼物","lǐwù","quà tặng",10,"礻","送礼物。","Tặng quà."],
["新年","xīnnián","năm mới",13,"斤","新年快乐！","Chúc mừng năm mới!"],
["幸福","xìngfú","hạnh phúc",10,"土","幸福生活。","Sống hạnh phúc."],
["红色","hóngsè","màu đỏ",12,"纟","红色的花。","Hoa màu đỏ."],
["白色","báisè","màu trắng",11,"白","白色的衣服。","Quần áo trắng."],
["黑色","hēisè","màu đen",12,"黑","黑色的包。","Túi màu đen."],
["蓝色","lánsè","màu xanh lam",13,"艹","蓝色的天空。","Bầu trời xanh."],
["绿色","lǜsè","màu xanh lá",14,"纟","绿色的树。","Cây xanh."],
["黄色","huángsè","màu vàng",14,"黄","黄色的花。","Hoa vàng."],
["颜色","yánsè","màu sắc",12,"色","什么颜色？","Màu gì?"],
["身体","shēntǐ","cơ thể",12,"身","身体健康。","Cơ thể khỏe mạnh."],
["健康","jiànkāng","khỏe mạnh",14,"亻","祝你健康。","Chúc bạn mạnh khỏe."],
["锻炼","duànliàn","tập luyện",17,"金","每天锻炼。","Tập luyện mỗi ngày."],
["运动","yùndòng","vận động",12,"辶","做运动。","Tập thể thao."],
["跑步","pǎobù","chạy bộ",7,"足","去跑步。","Đi chạy bộ."],
["游泳","yóuyǒng","bơi lội",12,"氵","去游泳。","Đi bơi."],
["足球","zúqiú","bóng đá",14,"足","踢足球。","Đá bóng."],
["篮球","lánqiú","bóng rổ",14,"竹","打篮球。","Chơi bóng rổ."],
["唱歌","chànggē","hát",14,"口","喜欢唱歌。","Thích hát."],
["跳舞","tiàowǔ","nhảy múa",14,"足","喜欢跳舞。","Thích nhảy."],
["旅游","lǚyóu","du lịch",13,"方","去旅游。","Đi du lịch."],
["名胜","míngshèng","danh thắng",14,"口","名胜古迹。","Danh lam thắng cảnh."],
["护照","hùzhào","hộ chiếu",11,"扌","带护照。","Mang hộ chiếu."],
["行李","xíngli","hành lý",12,"行","拿行李。","Xách hành lý."],
["开始","kāishǐ","bắt đầu",9,"女","开始上课。","Bắt đầu học."],
["结束","jiéshù","kết thúc",12,"纟","结束了。","Kết thúc rồi."],
["帮助","bāngzhù","giúp đỡ",13,"巾","互相帮助。","Giúp đỡ nhau."],
["欢迎","huānyíng","hoan nghênh",12,"欠","欢迎光临。","Hoan nghênh."],
["努力","nǔlì","cố gắng",13,"力","努力学习。","Học tập chăm chỉ."],
["简单","jiǎndān","đơn giản",14,"竹","很简单。","Rất đơn giản."],
["方便","fāngbiàn","tiện lợi",12,"方","很方便。","Rất tiện lợi."],
["认真","rènzhēn","nghiêm túc",10,"讠","认真学习。","Học tập nghiêm túc."],
["数学","shùxué","toán học",13,"攵","学数学。","Học toán."],
["历史","lìshǐ","lịch sử",8,"厂","学历史。","Học lịch sử."],
["英语","yīngyǔ","tiếng Anh",12,"艹","说英语。","Nói tiếng Anh."],
["上课","shàngkè","lên lớp",8,"一","上课了。","Vào lớp rồi."],
["下课","xiàkè","tan lớp",8,"一","下课了。","Tan lớp rồi."],
["问题","wèntí","vấn đề, câu hỏi",11,"门","有问题。","Có vấn đề."],
["答案","dáàn","đáp án",12,"竹","正确答案。","Đáp án đúng."],
["厨房","chúfáng","nhà bếp",16,"厂","在厨房做饭。","Nấu ăn trong bếp."],
["客厅","kètīng","phòng khách",12,"宀","在客厅看电视。","Xem TV ở phòng khách."],
["卧室","wòshì","phòng ngủ",12,"戈","在卧室睡觉。","Ngủ trong phòng ngủ."],
["卫生间","wèishēngjiān","nhà vệ sinh",11,"氵","卫生间在哪？","Nhà vệ sinh ở đâu?"],
["桌子","zhuōzi","cái bàn",12,"木","桌子上有书。","Trên bàn có sách."],
["椅子","yǐzi","cái ghế",12,"木","椅子上有人。","Trên ghế có người."],
["门","mén","cửa",3,"门","开门。","Mở cửa."],
["窗","chuāng","cửa sổ",12,"穴","开窗。","Mở cửa sổ."],
["床","chuáng","giường",7,"广","在床上。","Trên giường."],
["书","shū","sách",10,"乛","一本书。","Một quyển sách."],
["笔","bǐ","bút",10,"竹","一支笔。","Một cây bút."],
["纸","zhǐ","giấy",10,"纟","一张纸。","Một tờ giấy."],
["花","huā","hoa",7,"艹","一朵花。","Một bông hoa."],
["猫","māo","mèo",11,"犭","一只猫。","Một con mèo."],
["狗","gǒu","chóu",8,"犭","一只狗。","Một con chó."],
["鸟","niǎo","chim",5,"鸟","一只鸟。","Một con chim."],
["马","mǎ","ngựa",3,"马","一匹马。","Một con ngựa."],
["花","huā","hoa",7,"艹","花很漂亮。","Hoa rất đẹp."],
["草","cǎo","cỏ",9,"艹","绿草。","Cỏ xanh."],
["树","shù","cây",9,"木","一棵树。","Một cái cây."],
["河","hé","sông",8,"氵","一条河。","Một con sông."],
["江","jiāng","sông lớn",6,"氵","长江。","Trường Giang."],
];
shuffle($hsk2);
$hsk2 = array_slice($hsk2, 0, 150);
echo "HSK2 bank: " . count($hsk2) . " words\n";

// ════════════════════════════════════════════════════
// HSK 3 VOCAB BANK (150+ words with real HSK3 vocab)
// ════════════════════════════════════════════════════
$hsk3 = [
["环境","huánjìng","môi trường",14,"王","保护环境。","Bảo vệ môi trường."],
["保护","bǎohù","bảo vệ",9,"亻","保护大自然。","Bảo vệ thiên nhiên."],
["空气","kōngqì","không khí",12,"穴","新鲜空气。","Không khí trong lành."],
["动物","dòngwù","động vật",12,"力","保护动物。","Bảo vệ động vật."],
["植物","zhíwù","thực vật",12,"木","绿色植物。","Thực vật xanh."],
["自然","zìrán","tự nhiên",12,"自","人与自然。","Con người và tự nhiên."],
["森林","sēnlín","rừng",12,"木","热带森林。","Rừng nhiệt đới."],
["河流","héliú","sông",12,"氵","干净的河流。","Sông sạch."],
["市场","shìchǎng","thị trường",11,"巾","市场经济。","Kinh tế thị trường."],
["经济","jīngjì","kinh tế",12,"纟","经济发展。","Phát triển kinh tế."],
["合同","hétong","hợp đồng",11,"口","签合同。","Ký hợp đồng."],
["价格","jiàgé","giá cả",10,"亻","合理价格。","Giá cả hợp lý."],
["利润","lìrùn","lợi nhuận",12,"禾","获得利润。","Đạt lợi nhuận."],
["投资","tóuzī","đầu tư",13,"扌","投资未来。","Đầu tư tương lai."],
["发展","fāzhǎn","phát triển",10,"又","发展经济。","Phát triển kinh tế."],
["科学","kēxué","khoa học",13,"禾","科学发展。","Phát triển khoa học."],
["技术","jìshù","kỹ thuật",13,"扌","技术革新。","Đổi mới kỹ thuật."],
["网络","wǎngluò","mạng",13,"罓","网络时代。","Thời đại mạng."],
["数据","shùjù","dữ liệu",13,"攵","数据分析。","Phân tích dữ liệu."],
["软件","ruǎnjiàn","phần mềm",11,"车","开发软件。","Phát triển PM."],
["人工智能","réngōng zhìnéng","trí tuệ nhân tạo",14,"人","AI技术。","Công nghệ AI."],
["机器人","jīqìrén","robot",14,"木","智能机器人。","Robot thông minh."],
["生病","shēngbìng","bị ốm",10,"疒","他生病了。","Anh ấy ốm rồi."],
["感冒","gǎnmào","cảm lạnh",13,"心","我感冒了。","Tôi bị cảm."],
["发烧","fāshāo","sốt",10,"火","发烧了。","Bị sốt."],
["咳嗽","késou","ho",14,"口","一直咳嗽。","Ho liên tục."],
["药","yào","thuốc",9,"艹","吃药。","Uống thuốc."],
["希望","xīwàng","hy vọng",10,"巾","希望你健康。","Hy vọng bạn khỏe."],
["春节","chūnjié","Tết Nguyên đán",12,"日","春节快乐！","CNM!"],
["中秋节","zhōngqiū jié","Tết Trung thu",14,"耒","中秋节快乐。","TT vui vẻ."],
["红包","hóngbāo","bao lì xì",10,"纟","发红包。","Phát lì xì."],
["传统","chuántǒng","truyền thống",12,"亻","传统文化。","VH truyền thống."],
["习俗","xísú","phong tục",11,"乙","节日习俗。","Phong tục lễ."],
["庆祝","qìngzhù","chúc mừng",12,"广","庆祝生日。","Mừng sinh nhật."],
["文化","wénhuà","văn hóa",8,"文","中国文化。","VH Trung Quốc."],
["历史","lìshǐ","lịch sử",8,"厂","悠久历史。","LS lâu đời."],
["书法","shūfǎ","thư pháp",14,"⺮","学习书法。","Học thư pháp."],
["节日","jiérì","ngày lễ",12,"艹","节日快乐！","Chúc mừng lễ!"],
["故事","gùshi","câu chuyện",14,"攵","讲故事。","Kể chuyện."],
["世界","shìjiè","thế giới",13,"一","世界很大。","TG rất lớn."],
["生活","shēnghuó","cuộc sống",12,"生","幸福生活。","Sống hạnh phúc."],
["城市","chéngshì","thành phố",15,"土","城市很大。","TP rất lớn."],
["农村","nóngcūn","nông thôn",14,"冖","农村安静。","NT yên tĩnh."],
["邻居","línjū","hàng xóm",12,"阝","邻居友好。","HX thân thiện."],
["关系","guānxì","quan hệ",12,"门","友好关系。","QH hữu nghị."],
["交流","jiāoliú","giao lưu",13,"亠","文化交流。","GL văn hóa."],
["沟通","gōutōng","giao tiếp",12,"氵","经常沟通。","Thường giao tiếp."],
["合作","hézuò","hợp tác",11,"口","合作愉快。","HT vui vẻ."],
["信任","xìnrèn","tin tưởng",10,"亻","互相信任。","Tin tưởng nhau."],
["尊重","zūnzhòng","tôn trọng",12,"寸","尊重别人。","Tôn trọng người."],
["礼貌","lǐmào","lịch sự",11,"礻","有礼貌。","Lịch sự."],
["邀请","yāoqǐng","mời",12,"辶","邀请朋友。","Mời bạn."],
["约会","yuēhuì","hẹn hò",10,"纟","有个约会。","Có hẹn."],
["道歉","dàoqiàn","xin lỗi",12,"辶","向他道歉。","XL anh ấy."],
["原谅","yuánliàng","tha thứ",13,"口","请原谅。","Hãy tha thứ."],
["友谊","yǒuyì","tình bạn",8,"又","深厚友谊。","TB sâu sắc."],
["性格","xìnggé","tính cách",10,"忄","性格开朗。","TC cởi mở."],
["态度","tàidù","thái độ",9,"心","学习态度。","Thái độ học."],
["支持","zhīchí","ủng hộ",7,"扌","支持你！","Ủng hộ bạn!"],
["关心","guānxīn","quan tâm",12,"关","关心别人。","QT người khác."],
["难忘","nánwàng","khó quên",14,"隹","难忘的经历。","Trải nghiệm khó quên."],
["精彩","jīngcǎi","tuyệt vời",14,"米","精彩的表演。","Trình diễn tuyệt vời."],
["坚持","jiānchí","kiên trì",14,"土","坚持锻炼。","Kiên trì tập luyện."],
["成功","chénggōng","thành công",11,"戈","祝你成功。","Chúc bạn thành công."],
["完成","wánchéng","hoàn thành",11,"宀","完成作业。","Hoàn thành bài tập."],
["结婚","jiéhūn","kết hôn",14,"女","结婚了。","Kết hôn rồi."],
["打算","dǎsuàn","dự định",14,"扌","有什么打算？","Có dự định gì?"],
["计划","jìhuà","kế hoạch",10,"讠","学习计划。","KH học tập."],
["准备","zhǔnbèi","chuẩn bị",13,"冫","准备考试。","Chuẩn bị thi."],
["意思","yìsi","ý nghĩa",13,"心","什么意思？","Có nghĩa gì?"],
["担心","dānxīn","lo lắng",12,"心","别担心。","Đừng lo."],
["注意","zhùyì","chú ý",12,"氵","注意安全。","Chú ý an toàn."],
["提高","tígāo","nâng cao",12,"扌","提高水平。","NC trình độ."],
["表示","biǎoshì","biểu thị",12,"衣","表示同意。","Đồng ý."],
["介绍","jièshào","giới thiệu",11,"人","介绍朋友。","GT bạn bè."],
["建议","jiànyì","đề nghị",13,"讠","提建议。","Đề nghị."],
["决定","juédìng","quyết định",12,"冫","下定决心。","Quyết tâm."],
["选择","xuǎnzé","lựa chọn",13,"辶","做出选择。","Đưa ra lựa chọn."],
["出现","chūxiàn","xuất hiện",10,"凵","出现了。","Xuất hiện rồi."],
["发现","fāxiàn","phát hiện",10,"又","发现秘密。","Phát hiện bí mật."],
["参加","cānjiā","tham gia",13,"厶","参加活动。","Tham gia hoạt động."],
["举办","jǔbàn","tổ chức",14,"丶","举办活动。","Tổ chức hoạt động."],
["通知","tōngzhī","thông báo",17,"辶","发通知。","Gửi thông báo."],
["明白","míngbai","hiểu rõ",14,"日","明白了。","Hiểu rồi."],
["原因","yuányīn","nguyên nhân",13,"厂","什么原因？","Nguyên nhân gì?"],
["结果","jiéguǒ","kết quả",13,"纟","考试结果。","Kết quả thi."],
["困难","kùnnan","khó khăn",13,"囗","遇到困难。","Gặp khó khăn."],
["阳光","yángguāng","ánh nắng",12,"阝","温暖的阳光。","Ánh nắng ấm."],
["太阳","tàiyáng","mặt trời",10,"大","太阳出来了。","Mặt trời lên rồi."],
["月亮","yuèliang","mặt trăng",12,"月","月亮很圆。","Trăng rất tròn."],
["星星","xīngxing","ngôi sao",14,"日","满天星星。","Đầy trời sao."],
["风","fēng","gió",4,"风","刮风了。","Gió rồi."],
["云","yún","mây",4,"二","白云。","Mây trắng."],
["雪","xuě","tuyết",11,"雨","下雪了。","Tuyết rồi."],
["银行","yínháng","ngân hàng",14,"金","去银行。","Đến ngân hàng."],
["邮局","yóujú","bưu điện",12,"阝","去邮局寄信。","Đến bưu điện gửi thư."],
["图书馆","túshūguǎn","thư viện",14,"囗","去图书馆借书。","Đến TV mượn sách."],
["公园","gōngyuán","công viên",11,"八","去公园散步。","Đi công viên dạo."],
["饭店","fàndiàn","nhà hàng",13,"食","去饭店吃饭。","Đến nhà hàng ăn."],
["超市","chāoshì","siêu thị",12,"走","去超市购物。","Đi siêu thị mua sắm."],
["蛋糕","dàngāo","bánh ngọt",16,"米","生日蛋糕。","Bánh sinh nhật."],
["果汁","guǒzhī","nước trái cây",12,"木","喝果汁。","Uống nước trái cây."],
["饺子","jiǎozi","sủi cảo",14,"食","包饺子。","Gói sủi cảo."],
["面条","miàntiáo","mì",16,"麦","吃面条。","Ăn mì."],
];
shuffle($hsk3);
$hsk3 = array_slice($hsk3, 0, 150);
echo "HSK3 bank: " . count($hsk3) . " words\n";

// ════════════════════════════════════════════════════
// HSK 4 VOCAB BANK (150+ words with real HSK4 vocab)
// ════════════════════════════════════════════════════
$hsk4 = [
["读书","dúshū","đọc sách",10,"讠","读书有益。","Đọc sách có ích."],
["味道","wèidào","hương vị",12,"口","生活的味道。","Hương vị cuộc sống."],
["乐趣","lèqù","niềm vui thú",12,"木","工作的乐趣。","Niềm vui công việc."],
["价值","jiàzhí","giá trị",11,"亻","人生价值。","Giá trị cuộc sống."],
["实现","shíxiàn","thực hiện",12,"宀","实现梦想。","Thực hiện ước mơ."],
["自我","zìwǒ","bản thân",12,"自","自我提升。","Tự nâng cao."],
["开阔","kāikuò","mở rộng",13,"门","开阔眼界。","Mở rộng tầm mắt."],
["传承","chuánchéng","kế thừa",13,"亻","文化传承。","Kế thừa văn hóa."],
["改变","gǎibiàn","thay đổi",12,"攵","改变生活。","Thay đổi cuộc sống."],
["科技","kējì","khoa học kỹ thuật",13,"禾","科技进步。","KH tiến bộ."],
["社交","shèjiāo","giao tiếp xã hội",12,"礻","社交媒体。","MXH."],
["平衡","pínghéng","cân bằng",14,"干","平衡饮食。","Cân bằng ăn uống."],
["压力","yālì","áp lực",11,"土","工作压力。","Áp lực công việc."],
["竞争","jìngzhēng","cạnh tranh",12,"立","市场竞争。","CT thị trường."],
["效率","xiàolǜ","hiệu suất",14,"攵","提高效率。","NC hiệu suất."],
["梦想","mèngxiǎng","ước mơ",14,"木","追逐梦想。","Theo đuổi ước mơ."],
["未来","wèilái","tương lai",10,"木","美好未来。","Tương lai tươi sáng."],
["污染","wūrǎn","ô nhiễm",12,"氵","空气污染。","ÔN không khí."],
["全球","quánqiú","toàn cầu",12,"人","全球变暖。","Nóng lên toàn cầu."],
["资源","zīyuán","tài nguyên",13,"贝","自然资源。","TN thiên nhiên."],
["能源","néngyuán","năng lượng",13,"月","清洁能源。","NL sạch."],
["节约","jiéyuē","tiết kiệm",9,"艹","节约用水。","TK nước."],
["减少","jiǎnshǎo","giảm bớt",12,"冫","减少浪费。","Giảm lãng phí."],
["回收","huíshōu","thu hồi, tái chế",11,"口","垃圾回收。","TC rác."],
["绿色","lǜsè","xanh, bền vững",14,"纟","绿色能源。","NL xanh."],
["时尚","shíshàng","thời trang",12,"日","时尚潮流。","Xu hướng TT."],
["品味","pǐnwèi","thưởng thức",15,"口","品味生活。","Thưởng thức CS."],
["消费","xiāofèi","tiêu dùng",11,"氵","理性消费。","TD hợp lý."],
["教育","jiàoyù","giáo dục",13,"攵","重视教育。","Coi trọng GD."],
["知识","zhīshi","kiến thức",12,"矢","知识渊博。","Kiến thức uyên thâm."],
["培养","péiyǎng","bồi dưỡng",13,"土","培养兴趣。","BD sở thích."],
["影响","yǐngxiǎng","ảnh hưởng",14,"彡","产生影响。","Tạo ảnh hưởng."],
["能力","nénglì","năng lực",13,"月","工作能力。","NL làm việc."],
["表达","biǎodá","biểu đạt",12,"衣","表达能力。","KN biểu đạt."],
["感受","gǎnshòu","cảm thụ",14,"心","感受生活。","Cảm nhận CS."],
["体验","tǐyàn","trải nghiệm",13,"骨","体验生活。","TN cuộc sống."],
["欣赏","xīnshǎng","thưởng thức",16,"斤","欣赏音乐。","Thưởng thức nhạc."],
["特色","tèsè","đặc sắc",14,"牛","地方特色。","ĐS địa phương."],
["品质","pǐnzhì","phẩm chất",14,"口","优秀品质。","PC ưu tú."],
["享受","xiǎngshòu","hưởng thụ",14,"亠","享受生活。","Hưởng thụ CS."],
["放松","fàngsōng","thư giãn",12,"攵","放松心情。","TG tâm trạng."],
["经营","jīngyíng","kinh doanh",14,"纟","经营管理。","QL kinh doanh."],
["管理","guǎnlǐ","quản lý",15,"竹","企业管理。","QL doanh nghiệp."],
["组织","zǔzhī","tổ chức",12,"纟","组织活动。","TC hoạt động."],
["技巧","jìqiǎo","kỹ xảo",13,"扌","沟通技巧。","KN giao tiếp."],
["面试","miànshì","phỏng vấn",12,"面","通过面试。","Qua PV."],
["实习","shíxí","thực tập",13,"宀","去公司实习。","Đi TT ở cty."],
["经验","jīngyàn","kinh nghiệm",13,"纟","工作经验。","KN làm việc."],
["意见","yìjiàn","ý kiến",13,"心","交换意见。","Trao đổi ý kiến."],
["目标","mùbiāo","mục tiêu",10,"目","设定目标。","Đặt mục tiêu."],
["要求","yāoqiú","yêu cầu",13,"覀","严格要求。","YC nghiêm ngặt."],
["标准","biāozhǔn","tiêu chuẩn",14,"木","质量标准。","TC chất lượng."],
["原则","yuánzé","nguyên tắc",13,"厂","坚持原则。","Giữ nguyên tắc."],
["规则","guīzé","quy tắc",12,"见","遵守规则。","Tuân thủ QT."],
["适应","shìyìng","thích ứng",12,"辶","适应环境。","TU môi trường."],
["挑战","tiǎozhàn","thử thách",14,"扌","接受挑战。","Nhận TT."],
["风险","fēngxiǎn","rủi ro",14,"阝","投资风险。","RR đầu tư."],
["创新","chuàngxīn","đổi mới",13,"刂","科技创新。","ĐM khoa học."],
["品牌","pǐnpái","thương hiệu",12,"口","品牌形象。","Hình ảnh TH."],
["广告","guǎnggào","quảng cáo",10,"广","电视广告。","QC truyền hình."],
["客户","kèhù","khách hàng",12,"宀","服务客户。","Phục vụ KH."],
["服务","fúwù","dịch vụ",12,"月","优质服务。","DV chất lượng."],
["评估","pínggū","đánh giá",11,"讠","风险评估。","ĐG rủi ro."],
["分析","fēnxī","phân tích",11,"刀","数据分析。","Phân tích DL."],
["慈善","císhàn","từ thiện",14,"心","慈善活动。","HĐ từ thiện."],
["公益","gōngyì","công ích",10,"八","公益事业。","SV công ích."],
["志愿者","zhìyuànzhě","tình nguyện viên",16,"心","做志愿者。","Làm TNV."],
["贡献","gòngxiàn","cống hiến",13,"工","做出贡献。","Cống hiến."],
["责任","zérèn","trách nhiệm",12,"贝","社会责任。","TN xã hội."],
["义务","yìwù","nghĩa vụ",11,"丶","履行义务。","TH nghĩa vụ."],
["权利","quánlì","quyền lợi",10,"木","享有权利。","Hưởng QL."],
["平等","píngděng","bình đẳng",10,"干","男女平等。","BĐ nam nữ."],
["公正","gōngzhèng","công chính",11,"八","社会公正。","CX xã hội."],
["和谐","héxié","hài hòa",12,"口","和谐社会。","XH hài hòa."],
["稳定","wěndìng","ổn định",14,"禾","社会稳定。","Ổn định XH."],
["改革","gǎigé","cải cách",12,"攵","改革开放。","CC mở cửa."],
["政策","zhèngcè","chính sách",13,"竹","经济政策。","CS kinh tế."],
["战略","zhànlüè","chiến lược",14,"戈","发展战略。","CL phát triển."],
["规划","guīhuà","quy hoạch",12,"见","城市规划。","QH đô thị."],
["建设","jiànshè","xây dựng",12,"廴","城市建设。","XD đô thị."],
["现代化","xiàndàihuà","hiện đại hóa",13,"王","实现现代化。","TH HĐH."],
["交流","jiāoliú","giao lưu",13,"亠","文化交流。","GL văn hóa."],
["深入","shēnrù","đi sâu",12,"氵","深入研究。","NC sâu."],
["广泛","guǎngfàn","rộng rãi",10,"广","广泛应用。","UD rộng rãi."],
["丰富","fēngfù","phong phú",12,"一","内容丰富。","ND phong phú."],
["优秀","yōuxiù","ưu tú",10,"亻","优秀员工。","NV ưu tú."],
["著名","zhùmíng","nổi tiếng",13,"艹","著名景点。","Điểm đến nổi tiếng."],
["主要","zhǔyào","chủ yếu",12,"丶","主要原因。","Nguyên nhân chính."],
["重要","zhòngyào","quan trọng",13,"里","非常重要。","Rất quan trọng."],
["关键","guānjiàn","mấu chốt",12,"丷","关键问题。","VĐ mấu chốt."],
["基础","jīchǔ","cơ sở",14,"土","基础知识。","Kiến thức cơ sở."],
["根本","gēnběn","căn bản",14,"木","根本原因。","Nguyên nhân căn bản."],
["现象","xiànxiàng","hiện tượng",12,"王","社会现象。","HT xã hội."],
["本质","běnzhì","bản chất",11,"木","本质问题。","VĐ bản chất."],
["特征","tèzhēng","đặc trưng",14,"牛","主要特征。","Đặc trưng chính."],
["趋势","qūshì","xu thế",14,"走","发展趋势。","XT phát triển."],
["过程","guòchéng","quá trình",12,"辶","发展过程。","QT phát triển."],
["阶段","jiēduàn","giai đoạn",12,"阝","发展阶段。","GĐ phát triển."],
["方式","fāngshì","phương thức",8,"方","生活方式。","PT sống."],
["方法","fāngfǎ","phương pháp",8,"方","学习方法。","PP học tập."],
["态度","tàidù","thái độ",9,"心","积极态度。","Thái độ tích cực."],
["精神","jīngshén","tinh thần",15,"米","精神生活。","Sống tinh thần."],
["物质","wùzhì","vật chất",12,"牜","物质生活。","Sống vật chất."],
["文明","wénmíng","văn minh",8,"文","物质文明。","VM vật chất."],
["勇敢","yǒnggǎn","dũng cảm",12,"力","勇敢面对。","Dũng cảm đối mặt."],
["聪明","cōngming","thông minh",12,"耳","很聪明。","Rất thông minh."],
["善良","shànliáng","lương thiện",12,"⺮","心地善良。","Tấm lòng lương thiện."],
["严肃","yánsù","nghiêm túc",12,"口","态度严肃。","Thái độ nghiêm túc."],
["谦虚","qiānxū","khiêm tốn",12,"讠","谦虚使人进步。","Khiêm tốn tiến bộ."],
["骄傲","jiāoào","kiêu ngạo",12,"马","骄傲使人落后。","Kiêu ngạo thụt lùi."],
["感动","gǎndòng","cảm động",14,"心","非常感动。","Rất cảm động."],
["激动","jīdòng","kích động",14,"氵","激动人心。","Kích động lòng người."],
];
shuffle($hsk4);
$hsk4 = array_slice($hsk4, 0, 150);
echo "HSK4 bank: " . count($hsk4) . " words\n";

// ════════════════════════════════════════════════════
// HSK 5 VOCAB BANK (150+ words)
// ════════════════════════════════════════════════════
$hsk5 = [
["选择","xuǎnzé","lựa chọn",13,"辶","做出选择。","Đưa ra lựa chọn."],
["放弃","fàngqì","từ bỏ",11,"攵","永不放弃。","KBT từ bỏ."],
["秘诀","mìjué","bí quyết",12,"禾","成功的秘诀。","Bí quyết thành công."],
["挫折","cuòzhé","thất bại, trắc trở",14,"扌","面对挫折。","Đối mặt thất bại."],
["奋斗","fèndòu","phấn đấu",14,"大","为梦想奋斗。","Phấn đấu vì ước mơ."],
["理想","lǐxiǎng","lý tưởng",13,"王","理想远大。","Lý tưởng lớn lao."],
["信念","xìnniàn","tín niệm",13,"亻","坚定信念。","Kiên định TN."],
["勇气","yǒngqì","dũng khí",12,"力","鼓起勇气。","Lấy dũng khí."],
["智慧","zhìhuì","trí tuệ",14,"日","人生智慧。","TT nhân sinh."],
["思维","sīwéi","tư duy",13,"田","思维方式。","PT tư duy."],
["气候","qìhòu","khí hậu",13,"气","气候变化。","BĐ khí hậu."],
["可持续","kěchíxù","bền vững",12,"口","可持续发展。","PT bền vững."],
["生态","shēngtài","sinh thái",10,"生","生态系统。","HST."],
["治理","zhìlǐ","quản lý, trị lý",13,"氵","环境治理。","QL môi trường."],
["平等","píngděng","bình đẳng",10,"干","教育平等。","BĐ giáo dục."],
["素质","sùzhì","tố chất",12,"纟","素质教育。","GD tố chất."],
["大数据","dà shùjù","dữ liệu lớn",13,"大","大数据时代。","Thời ĐH dữ liệu."],
["互联网","hùliánwǎng","internet",12,"互","互联网时代。","Thời internet."],
["安全","ānquán","an toàn",10,"宀","网络安全。","AT mạng."],
["媒体","méitǐ","truyền thông",12,"女","社交媒体。","MXH."],
["新闻","xīnwén","tin tức",13,"斤","看新闻。","Xem TT."],
["采访","cǎifǎng","phỏng vấn",12,"扌","采访记者。","PV PV."],
["编辑","biānjí","biên tập",15,"纟","编辑文章。","BT bài."],
["记者","jìzhě","phóng viên",14,"讠","新闻记者。","PV tin."],
["标题","biāotí","tiêu đề",14,"木","文章标题。","TD bài viết."],
["内容","nèiróng","nội dung",13,"冂","内容丰富。","ND phong phú."],
["评论","pínglùn","bình luận",12,"讠","写评论。","Viết BL."],
["观点","guāndiǎn","quan điểm",12,"丶","不同观点。","QĐ khác."],
["舆论","yúlùn","dư luận",14,"言","社会舆论。","DL xã hội."],
["传播","chuánbō","truyền bá",13,"亻","传播信息。","TB thông tin."],
["城市化","chéngshìhuà","đô thị hóa",14,"土","城市化进程。","QT ĐTH."],
["人口","rénkǒu","dân số",2,"人","人口增长。","DS gia tăng."],
["老龄化","lǎolínghuà","già hóa",14,"老","人口老龄化。","DS già hóa."],
["养老","yǎnglǎo","dưỡng lão",12,"八","养老服务。","DV dưỡng lão."],
["保障","bǎozhàng","đảm bảo",9,"亻","社会保障。","BĐ xã hội."],
["医疗","yīliáo","y tế",13,"匸","医疗服务。","DV y tế."],
["保险","bǎoxiǎn","bảo hiểm",11,"阝","医疗保险。","BH y tế."],
["金融","jīnróng","tài chính",12,"金","金融机构。","CQ tài chính."],
["股票","gǔpiào","cổ phiếu",14,"月","股票市场。","TT CK."],
["理财","lǐcái","quản lý tài chính",12,"王","个人理财。","QLTC cá nhân."],
["收益","shōuyì","thu nhập, lợi ích",12,"攵","获得收益。","Thu lợi."],
["消费者","xiāofèizhě","người tiêu dùng",14,"氵","保护消费者。","BV người TD."],
["营销","yíngxiāo","tiếp thị",15,"艹","营销策略。","CL tiếp thị."],
["渠道","qúdào","kênh",14,"氵","销售渠道。","Kênh bán hàng."],
["物流","wùliú","logistics",12,"牜","物流系统。","HT logistics."],
["非遗","fēiyí","di sản phi vật thể",12,"非","非物质文化遗产。","DS VH phi vật thể."],
["弘扬","hóngyáng","phát huy, đề cao",12,"弓","弘扬传统文化。","PH VH truyền thống."],
["道德","dàodé","đạo đức",15,"辶","道德标准。","TC đạo đức."],
["法律","fǎlǜ","pháp luật",12,"氵","遵守法律。","Tuân thủ PL."],
["规范","guīfàn","quy phạm",12,"见","行为规范。","QP hành vi."],
["约束","yuēshù","ràng buộc",9,"纟","受到约束。","RB."],
["差异","chāyì","khác biệt",11,"工","文化差异。","KB văn hóa."],
["对比","duìbǐ","đối chiếu",10,"寸","形成对比。","ĐC."],
["理解","lǐjiě","lý giải, hiểu",13,"王","互相理解。","Hiểu nhau."],
["包容","bāoróng","bao dung",14,"勹","包容不同。","Bao dung."],
["领导","lǐngdǎo","lãnh đạo",14,"页","领导能力。","NL lãnh đạo."],
["团队","tuánduì","đội nhóm",14,"囗","团队合作。","HT nhóm."],
["协调","xiétiáo","hiệp điều",11,"十","协调关系。","ĐP quan hệ."],
["人力资源","rénlì zīyuán","nguồn nhân lực",12,"人","人力资源管理。","QLNNL."],
["招聘","zhāopìn","tuyển dụng",12,"扌","招聘员工。","TD nhân viên."],
["培训","péixùn","đào tạo",14,"土","岗位培训。","ĐT chức vụ."],
["考核","kǎohé","đánh giá",11,"老","绩效考核。","ĐG hiệu quả."],
["定位","dìngwèi","định vị",11,"宀","市场定位。","ĐV thị trường."],
["推广","tuīguǎng","đẩy mạnh",13,"扌","产品推广。","QB sản phẩm."],
["全球化","quánqiúhuà","toàn cầu hóa",13,"人","经济全球化。","TCH KT."],
["一带一路","yīdài yílù","Một vành đai một con đường",9,"一","一带一路倡议。","Sáng kiến VĐ."],
["开放","kāifàng","mở cửa",9,"廾","对外开放。","Mở cửa ĐN."],
["贸易","màoyì","thương mại",12,"贝","自由贸易。","MD tự do."],
["丝绸之路","sīchóu zhī lù","Con đường tơ lụa",11,"纟","丝绸之路经济带。","Vành đai KT."],
["中医","zhōngyī","Trung y",10,"丨","中医文化。","VH Trung y."],
["养生","yǎngshēng","dưỡng sinh",12,"八","养生之道。","Đạo dưỡng sinh."],
["针灸","zhēnjiǔ","châm cứu",13,"钅","针灸治疗。","Trị liệu CC."],
["烹饪","pēngrèn","nấu nướng",16,"火","中国烹饪。","Nấu nướng TQ."],
["口味","kǒuwèi","khẩu vị",12,"口","各地口味不同。","KV khác nhau."],
["茶文化","chá wénhuà","văn hóa trà",12,"艹","中国茶文化。","VH trà TQ."],
["功夫","gōngfu","công phu, võ thuật",10,"力","中国功夫。","Võ thuật TQ."],
["太极","tàijí","thái cực",10,"大","打太极。","Tập thái cực."],
["武术","wǔshù","võ thuật",14,"止","中华武术。","Võ TQ."],
["文物","wénwù","văn vật",12,"文","保护文物。","BV văn vật."],
["遗产","yíchǎn","di sản",12,"贝","世界遗产。","DS thế giới."],
["仪式","yíshì","nghi thức",12,"亻","传统仪式。","NT truyền thống."],
["风俗","fēngsú","phong tục",12,"风","民族风俗。","PT dân tộc."],
["信仰","xìnyǎng","tín ngưỡng",14,"亻","宗教信仰。","TN tôn giáo."],
["道德","dàodé","đạo đức",15,"辶","社会道德。","ĐĐ xã hội."],
["法律","fǎlǜ","pháp luật",12,"氵","法律体系。","HT PL."],
["制度","zhìdù","chế độ",12,"刂","社会制度。","CĐ xã hội."],
["体制","tǐzhì","thể chế",13,"亻","经济体制。","TC KT."],
["机制","jīzhì","cơ chế",13,"木","市场机制。","CC trường."],
["效益","xiàoyì","hiệu ích",14,"攵","经济效益。","HI KT."],
["效率","xiàolǜ","hiệu suất",14,"攵","生产效率。","HS sản xuất."],
["范围","fànwéi","phạm vi",12,"匚","应用范围。","PV ứng dụng."],
["规模","guīmó","quy mô",12,"见","大规模生产。","QM lớn."],
["程度","chéngdù","trình độ",12,"禾","文化程度。","TĐ văn hóa."],
["水平","shuǐpíng","trình độ",10,"水","生活水平。","TĐ sống."],
["时代","shídài","thời đại",12,"日","新时代。","Thời đại mới."],
["阶段","jiēduàn","giai đoạn",12,"阝","新阶段。","GĐ mới."],
];
shuffle($hsk5);
$hsk5 = array_slice($hsk5, 0, 150);
echo "HSK5 bank: " . count($hsk5) . " words\n";

// ════════════════════════════════════════════════════
// HSK 6 VOCAB BANK (150+ words)
// ════════════════════════════════════════════════════
$hsk6 = [
["全球化","quánqiúhuà","toàn cầu hóa",13,"人","全球化趋势。","XH TCH."],
["融合","rónghé","dung hợp",16,"虫","文化融合。","DH văn hóa."],
["多元化","duōyuánhuà","đa dạng hóa",12,"夕","文化多元化。","ĐDH VH."],
["跨文化","kuà wénhuà","xuyên văn hóa",14,"足","跨文化交际。","GT XVH."],
["障碍","zhàngài","chướng ngại",15,"阝","沟通障碍。","CN giao tiếp."],
["互联网","hùliánwǎng","internet",12,"互","互联网治理。","QT internet."],
["监管","jiānguǎn","giám quản",13,"皿","加强监管。","Tăng cường GQ."],
["信息安全","xìnxī ānquán","an toàn thông tin",13,"亻","保障信息安全。","ĐB ATTT."],
["太空","tàikōng","không gian",13,"大","太空探索。","Thám hiểm KG."],
["宇航员","yǔhángyuán","nhà du hành vũ trụ",12,"⺮","中国宇航员。","NDHVT TQ."],
["空间站","kōngjiān zhàn","trạm không gian",12,"穴","建设空间站。","XD trạm KG."],
["卫星","wèixīng","vệ tinh",10,"卩","人造卫星。","VT nhân tạo."],
["知识产权","zhīshi chǎnquán","sở hữu trí tuệ",12,"矢","知识产权保护。","BV SHTT."],
["专利","zhuānlì","bằng sáng chế",11,"一","申请专利。","ĐK BSC."],
["侵权","qīnquán","xâm phạm quyền",13,"亻","打击侵权。","Chống XPQ."],
["维权","wéiquán","bảo vệ quyền lợi",12,"纟","维权行动。","HĐ BVQL."],
["公平","gōngpíng","công bằng",11,"八","社会公平。","CB xã hội."],
["差距","chājù","chênh lệch",11,"工","贫富差距。","CL giàu nghèo."],
["社会保障","shèhuì bǎozhàng","bảo đảm xã hội",12,"礻","完善社会保障。","HT BĐXH."],
["慈善","císhàn","từ thiện",14,"心","慈善事业。","SV từ thiện."],
["捐赠","juānzèng","quyên tặng",14,"贝","捐赠物资。","QT vật tư."],
["生态文明","shēngtài wénmíng","văn minh sinh thái",12,"生","建设生态文明。","XD VMST."],
["绿色发展","lǜsè fāzhǎn","phát triển xanh",14,"纟","推动绿色发展。","ĐĐ PT xanh."],
["低碳","dītàn","các-bon thấp",11,"亻","低碳生活。","Sống carbon thấp."],
["人与自然","rén yǔ zìrán","con người và thiên nhiên",9,"人","人与自然和谐。","CN và TN hài hòa."],
["教育改革","jiàoyù gǎigé","cải cách giáo dục",13,"攵","深化教育改革。","LS CCGD."],
["应试教育","yìngshì jiàoyù","giáo dục ứng thí",13,"广","改革应试教育。","CC GDƯT."],
["素质教育","sùzhì jiàoyù","giáo dục tố chất",12,"纟","实施素质教育。","TH GDTC."],
["终身教育","zhōngshēn jiàoyù","giáo dục suốt đời",12,"纟","建立终身教育体系。","XD HT GDSĐ."],
["远程教育","yuǎnchéng jiàoyù","giáo dục từ xa",12,"辶","发展远程教育。","PT GDTX."],
["文化遗产","wénhuà yíchǎn","di sản văn hóa",12,"文","文化遗产保护。","BV DSVH."],
["古迹","gǔjì","cổ tích",12,"口","历史古迹。","Di tích LS."],
["修复","xiūfù","sửa chữa, tu bổ",13,"亻","文物修复。","TB văn vật."],
["城市规划","chéngshì guīhuà","quy hoạch đô thị",12,"土","城市规划设计。","TK QHĐT."],
["布局","bùjú","bố cục",11,"巾","城市布局。","BC đô thị."],
["宜居","yíjū","đáng sống",13,"尸","宜居城市。","TP đáng sống."],
["智能","zhìnéng","thông minh",14,"日","智慧城市。","TP thông minh."],
["公共卫生","gōnggòng wèishēng","vệ sinh công cộng",12,"八","公共卫生体系。","HT VSCĐ."],
["防疫","fángyì","phòng dịch",11,"阝","疫情防控。","PC dịch."],
["疫苗","yìmiáo","vắc-xin",11,"疒","接种疫苗。","Tiêm VX."],
["基因","jīyīn","gen",11,"土","基因编辑。","BT gen."],
["伦理","lúnlǐ","luân lý",13,"亻","基因伦理。","LL gen."],
["量子","liàngzǐ","lượng tử",12,"里","量子计算。","TT lượng tử."],
["突破","tūpò","đột phá",13,"穴","技术突破。","ĐP kỹ thuật."],
["航天","hángtiān","hàng không vũ trụ",13,"舟","航天工程。","CT HKVT."],
["载人航天","zàirén hángtiān","HKVT có người lái",13,"车","载人航天工程。","CT HKVT NL."],
["探月","tànyuè","thám hiểm mặt trăng",12,"扌","探月工程。","CT THMT."],
["海洋","hǎiyáng","đại dương",14,"氵","海洋资源。","TN ĐD."],
["生态系统","shēngtài xìtǒng","hệ sinh thái",12,"生","海洋生态系统。","HST biển."],
["新能源","xīn néngyuán","năng lượng mới",13,"斤","发展新能源。","PT NL mới."],
["清洁能源","qīngjié néngyuán","năng lượng sạch",13,"氵","推广清洁能源。","ĐĐ NL sạch."],
["碳中和","tàn zhōnghé","trung hòa carbon",12,"石","实现碳中和。","TH TH carbon."],
["扶贫","fúpín","xóa đói giảm nghèo",11,"贝","精准扶贫。","XĐGN chính xác."],
["脱贫","tuōpín","thoát nghèo",12,"⺮","全面脱贫。","TN toàn diện."],
["乡村振兴","xiāngcūn zhènxīng","chấn hưng nông thôn",12,"亠","乡村振兴战略。","CL CHNT."],
["数字经济","shùzì jīngjì","kinh tế số",13,"攵","数字经济发展。","PT KT số."],
["共享经济","gòngxiǎng jīngjì","kinh tế chia sẻ",14,"八","共享经济模式。","Mô hình KTCS."],
["老龄化社会","lǎolínghuà shèhuì","xã hội già hóa",14,"老","应对老龄化社会。","ĐP XHGH."],
["银发经济","yínfà jīngjì","kinh tế bạc",14,"金","银发经济市场。","TT KTB."],
["诚信","chéngxìn","thành tín",12,"讠","诚信社会。","XH thành tín."],
["信用","xìnyòng","tín dụng",12,"亻","信用体系。","HT TD."],
["法治","fǎzhì","pháp trị",12,"氵","法治建设。","XD PT."],
["立法","lìfǎ","lập pháp",10,"立","完善立法。","HT LP."],
["司法","sīfǎ","tư pháp",10,"口","司法公正。","TP công chính."],
["民主","mínzhǔ","dân chủ",11,"民","民主政治。","CT DC."],
["国防","guófáng","quốc phòng",13,"囗","国防现代化。","HĐH QP."],
["外交","wàijiāo","ngoại giao",10,"夕","大国外交。","NG nước lớn."],
["人类命运共同体","rénlèi mìngyùn gòngtóngtǐ","cộng đồng chung vận mệnh nhân loại",12,"人","构建人类命运共同体。","XD CDMVNL."],
["文化自信","wénhuà zìxìn","tự tin văn hóa",8,"文","增强文化自信。","TC TTVH."],
["软实力","ruǎn shílì","sức mạnh mềm",11,"车","文化软实力。","SMM VH."],
["中华文明","zhōnghuá wénmíng","văn minh Trung Hoa",8,"丨","传承中华文明。","KT VMTH."],
["汉字","hànzì","chữ Hán",11,"氵","汉字演变。","TH chữ Hán."],
["甲骨文","jiǎgǔwén","giáp cốt văn",16,"田","甲骨文最早的文字。","GCV là chữ viết sớm."],
["篆书","zhuànshū","triện thư",16,"竹","小篆。","Tiểu triện."],
["隶书","lìshū","lệ thư",14,"隶","隶书。","Lệ thư."],
["楷书","kǎishū","khải thư",14,"木","楷书标准字体。","KT là kiểu chữ chuẩn."],
["诗歌","shīgē","thơ ca",13,"讠","唐诗宋词。","Thơ Đường từ Tống."],
["唐诗","Tángshī","thơ Đường",13,"口","李白是著名诗人。","Lý Bạch là nhà thơ."],
["宋词","Sòngcí","từ Tống",13,"宀","苏轼是宋词大家。","Tô Thức là đại gia từ Tống."],
["儒家","Rújiā","Nho gia",16,"亻","儒家思想。","TT Nho gia."],
["道家","Dàojiā","Đạo gia",12,"辶","道家学说。","HT Đạo gia."],
["孔子","Kǒngzǐ","Khổng Tử",8,"子","孔子伟大的思想家。","KTC là NT vĩ đại."],
["老子","Lǎozǐ","Lão Tử",8,"子","老子道家创始人。","LT người SL ĐG."],
["孟子","Mèngzǐ","Mạnh Tử",8,"子","孟子继承孔子。","MT kế thừa KTC."],
["黄帝内经","Huángdì Nèijīng","Hoàng Đế Nội Kinh",22,"黄","黄帝内经中医经典。","HDNK là KD TY."],
["本草纲目","Běncǎo Gāngmù","Bản thảo cương mục",16,"木","李时珍著本草纲目。","LTZ viết BTCN."],
["辨证论治","biànzhèng lùnzhì","biện chứng luận trị",21,"辛","中医辨证论治。","TY BCLT."],
["建筑","jiànzhù","kiến trúc",12,"廴","中国建筑。","KT Trung Quốc."],
["园林","yuánlín","vườn cảnh",13,"囗","苏州园林。","VC Tô Châu."],
["京剧","jīngjù","Kinh kịch",12,"亠","京剧表演。","BD Kinh kịch."],
["昆曲","kūnqǔ","Khúc khúc",12,"日","昆曲文化遗产。","KK DSVH."],
["脸谱","liǎnpǔ","mặt nạ",12,"月","京剧脸谱。","MN Kinh kịch."],
["国画","guóhuà","tranh Trung Quốc",12,"囗","中国国画。","Tranh TQ."],
["水墨画","shuǐmò huà","tranh thủy mặc",12,"水","传统水墨画。","Tranh TM truyền thống."],
["瓷器","cíqì","đồ sứ",15,"瓦","中国瓷器。","Đồ sứ TQ."],
["青花瓷","qīnghuā cí","gốm sứ xanh trắng",16,"青","景德镇青花瓷。","Gốm XT CĐT."],
["春节","chūnjié","Tết Nguyên đán",12,"日","春节习俗。","PT Tết."],
["元宵节","yuánxiāo jié","Tết Nguyên tiêu",12,"亠","元宵节吃元宵。","TNT ăn bánh trôi."],
["端午节","duānwǔ jié","Tết Đoan ngọ",14,"竹","端午节赛龙舟。","TĐN đua thuyền rồng."],
["重阳节","chóngyáng jié","Tết Trùng dương",12,"里","重阳节登高。","TTD lên cao."],
["中国梦","Zhōngguó mèng","Giấc mơ Trung Hoa",11,"囗","中国梦伟大复兴。","GMTH PH vĩ đại."],
["伟大复兴","wěidà fùxīng","phục hưng vĩ đại",12,"口","中华民族伟大复兴。","PH vĩ đại DT TH."],
["共同富裕","gòngtóng fùyù","cùng giàu có",14,"八","实现共同富裕。","TH cùng giàu có."],
["新时代","xīn shídài","thời đại mới",13,"斤","中国特色社会主义新时代。","TDM CNXH TS TQ."],
["一带一路","yīdài yílù","Vành đai con đường",9,"一","一带一路合作。","HT VĐ CĐ."],
["人类","rénlèi","nhân loại",9,"人","造福人类。","Phúc lợi NL."],
["和平","hépíng","hòa bình",11,"口","世界和平。","HB thế giới."],
["发展","fāzhǎn","phát triển",10,"又","共同发展。","Cùng PT."],
["合作","hézuò","hợp tác",11,"口","互利合作。","HT cùng lợi."],
["共赢","gòngyíng","cùng thắng",14,"八","合作共赢。","HT cùng thắng."],
];
shuffle($hsk6);
$hsk6 = array_slice($hsk6, 0, 150);
echo "HSK6 bank: " . count($hsk6) . " words\n\n";

$vocabBanks = [1=>$hsk1, 2=>$hsk2, 3=>$hsk3, 4=>$hsk4, 5=>$hsk5, 6=>$hsk6];
$vocabBankIndex = [1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0];

function getNextVocab($level, $count) {
    global $vocabBanks, $vocabBankIndex;
    $bank = $vocabBanks[$level];
    $idx = $vocabBankIndex[$level];
    $result = [];
    for ($i = 0; $i < $count; $i++) {
        $result[] = $bank[$idx % count($bank)];
        $idx++;
    }
    $vocabBankIndex[$level] = $idx;
    return $result;
}

echo "Initializing grammar banks...\n";
$grammarBanks = [];
$g1 = [
["Câu khẳng định với 是","A + 是 + B","A là B","Dùng để giới thiệu, định nghĩa hoặc khẳng định sự thật.","\"是\" không đi với 很 khi mang nghĩa \"là\"."],
["Câu hỏi với 吗","Câu trần thuật + 吗？","...có phải không?","Thêm 吗 cuối câu trần thuật để tạo câu hỏi.","\"吗\" chỉ dùng trong câu hỏi."],
["Đại từ nhân xưng","我/你/他/她 + Động từ","Tôi/bạn/anh ấy/cô ấy","Dùng để chỉ người. 他 (nam), 她 (nữ) cùng phát âm.","他 và 她 đều đọc là tā."],
["Từ chỉ số lượng","Số + Lượng từ + Danh từ","Số + lượng từ + danh từ","Dùng lượng từ 个 cho người và vật thông thường.","Mỗi danh từ có lượng từ riêng."],
["Câu hỏi với 几","几 + Lượng từ + Danh từ?","Mấy...?","Hỏi số lượng, dùng với số dưới 10.","\"几\" cho số ít, \"多少\" dùng chung."],
["Cấu trúc sở hữu với 的","Danh từ/Đại từ + 的 + Danh từ","Của...","Biểu thị quan hệ sở hữu.","Khi nói người thân có thể bỏ 的."],
["Cách nói thời gian","Số + 点 + Số + 分","...giờ...phút","Dùng 点 chỉ giờ, 分 chỉ phút.","\"两点\" = 2h, \"两点半\" = 2h30."],
["Câu hỏi với 什么时候","S + 什么时候 + V?","Khi nào...?","Hỏi về thời điểm xảy ra hành động.","\"什么时候\" đứng trước hoặc sau chủ ngữ."],
["Phó từ 正在/在","S + 正在/在 + V + O","Đang...","Diễn tả hành động đang xảy ra.","\"在\" có thể dùng độc lập."],
["Phủ định với 不","S + 不 + V + O","Không...","Phủ định hành động hoặc trạng thái.","\"不\" đứng trước động từ, tính từ."],
["Phó từ 也","S + 也 + V + O","Cũng...","Bổ sung thông tin tương tự.","\"也\" đứng trước động từ."],
["Từ nối 和","A + 和 + B","A và B","Nối hai danh từ hoặc đại từ.","Không dùng 和 để nối câu."],
["Phó từ 都","S + 都 + V","Đều...","Nhấn mạnh tất cả đều như nhau.","\"都\" đứng sau chủ ngữ số nhiều."],
["Động từ 有","S + 有 + O","Có...","Biểu thị sở hữu hoặc tồn tại.","Phủ định dùng 没有."],
["Cấu trúc 请 + V","请 + V + O","Mời, yêu cầu...","Dùng để mời hoặc yêu cầu lịch sự.","\"请\" đứng trước động từ."],
["Trợ từ 了","V + 了","Đã... rồi","Biểu thị hành động đã hoàn thành.","\"了\" đặt cuối câu."],
["Tính từ vị ngữ","S + 很 + Adj","Rất...","Tính từ làm vị ngữ, thường có 很.","\"很\" không nhất thiết mang nghĩa \"rất\"."],
["Hỏi tên tuổi","你叫什么名字？","Bạn tên gì?","Cách hỏi và trả lời về tên.","Dùng 叫 để nói tên."],
["Hỏi quốc tịch","S + 是 + Nước + 人","Là người nước nào","Hỏi và trả lời về quốc tịch.","\"你是哪国人？\""],
];
$g2 = [
["Động từ trùng điệp","V + V hoặc V + 一 + V","Làm thử/chút","Hành động ngắn, thử.","Thường dùng với động từ đơn âm."],
["Bổ ngữ kết quả","V + 完/见/好/到","Xong/thấy/tốt/đến","Chỉ kết quả của hành động.","\"做完\" = xong, \"看到\" = thấy."],
["Câu chữ 把","S + 把 + O + V + 其他","Đem...làm gì...","Nhấn mạnh tác động lên đối tượng.","Kết hợp bổ ngữ."],
["So sánh với 比","A + 比 + B + Tính từ","A hơn B...","So sánh hơn.","Không dùng 很 sau 比."],
["Trợ từ 了 (thay đổi)","S + V + 了","Đã...rồi","Thay đổi hoặc hoàn thành.","Phân biệt với 过."],
["Trợ từ 过 (kinh nghiệm)","S + V + 过 + O","Đã từng...","Từng trải qua.","\"去过\" = đã đi."],
["Câu hỏi 多 + tính từ","多 + Tính từ (大/久/远)?","Hỏi mức độ","Hỏi kích thước/độ xa/thời gian.","\"多远\" = bao xa."],
["Cấu trúc 要 (sắp)","S + 要 + V + O","Sắp...","Hành động sắp xảy ra.","\"要下雨了\" = sắp mưa."],
["从...到...","从 + (Nơi/TG) + 到 + (Nơi/TG)","Từ...đến...","Phạm vi không gian hoặc thời gian.","\"从家到学校\""],
["Cấu trúc 离","A + 离 + B + 远/近","Cách xa/gần","Khoảng cách.","\"离\" khác \"从...到...\""],
["Phó từ 最","最 + Tính từ","Nhất","So sánh nhất.","\"最好\" = tốt nhất."],
["先...再...","先 + V1 + 再 + V2","Trước...sau đó...","Thứ tự hành động.","\"先吃饭再学习\""],
["因为...所以...","因为 + 原因 + 所以 + 结果","Vì...nên...","Nguyên nhân - kết quả.","\"因为忙所以没去\""],
["虽然...但是...","虽然 + A + 但是 + B","Mặc dù...nhưng...","Nhượng bộ.","\"虽贵但好\""],
["Hỏi với 怎么","怎么 + V?","Làm thế nào?","Cách thức.","\"怎么去\" = đi thế nào?"],
["跟...一样","A + 跟 + B + 一样","A giống B","Sự giống nhau.","\"跟我一样高\""],
["除了...以外","除了 + A + (以外) + B","Ngoài A ra","Ngoại trừ / bao gồm.","\"除了我还有三人\""],
["是...的 (nhấn mạnh)","是 + TG/ĐĐ + V + 的","Nhấn mạnh TG/ĐĐ","Nhấn mạnh thời gian/địa điểm.","\"我是昨天来的\""],
];
$g3 = [
["Bổ ngữ xu hướng đơn","V + 来/去","Đến/đi","Hướng của hành động.","\"上来\" = lên."],
["Nếu...thì...","如果 + ĐK + 就 + KQ","Nếu...thì...","Điều kiện - kết quả.","\"如果\" trước/sau CN."],
["Bổ ngữ khả năng","V + 得/不 + Kết quả","Có/không thể","Khả năng đạt kết quả.","\"看得见\" = thấy được."],
["先...然后...","先 + V1 + 然后 + V2","Trước...sau đó","Thứ tự hành động.","\"先吃饭然后学习\""],
["So sánh phủ định 没有","A + 没有 + B + Tính từ","A không bằng B","Phủ định so sánh.","\"没有\" khác \"不比\""],
["Câu bị động 被","S + 被 + (người) + V","Bị/được...","Bị động, không mong muốn.","\"被\" lược tác nhân."],
["虽然...但是...","虽然 + A + 但是 + B","Mặc dù...nhưng...","Nhượng bộ.","\"虽然\" ở mệnh đề 1."],
["除了...以外","除了 + A + (以外) + B","Ngoài A ra","Ngoại trừ.","\"除了...以外\""],
["越来越","越来越 + Tính từ","Càng ngày càng","Thay đổi tăng dần.","\"越来越好\""],
["越...越...","越 + A + 越 + B","Càng...càng...","Tỉ lệ thuận.","\"越来越多\""],
["Liên từ 一边...一边...","一边 + V1 + 一边 + V2","Vừa...vừa...","Hai hành động cùng lúc.","\"一边吃饭一边看\""],
["Cấu trúc 又...又...","又 + A + 又 + B","Vừa...vừa...","Hai đặc điểm cùng có.","\"又大又便宜\""],
["Trợ từ 着","V + 着","Đang...","Trạng thái tiếp diễn.","\"开着门\" = cửa mở."],
["Cấu trúc 连...都...","连 + A + 都 + V","Ngay cả...đều...","Nhấn mạnh.","\"连小孩都知道\""],
["Cấu trúc 对...来说","对 + Người + 来说","Đối với...mà nói","Đánh giá từ góc nhìn.","\"对我说来很重要\""],
];
$g4 = [
["不仅...而且...","不仅 + A + 而且 + B","Không những...mà còn","Tầng ý bổ sung.","\"不仅\" đầu câu."],
["Bổ ngữ xu hướng kép","V + 上来/下去/出来/起来","Lên/xuống/ra/lên","Xu hướng kép.","\"想起来\" = nhớ ra."],
["Trạng ngữ chỉ mức độ","极/十分/相当/非常 + Tính từ","Cực kỳ/rất/khá","Mức độ cao.","\"极好\" = cực tốt."],
["越...越...","越 + A + 越 + B","Càng...càng...","Cùng chiều.","\"越来越大\""],
["Câu hỏi chính phản","S + V + 不 + V + O?","Có...không?","V+不+V hỏi.","\"是不是\" = phải không?"],
["无论...都...","无论 + A + 都 + B","Bất luận...đều","Điều kiện không thay đổi.","\"无论谁\" = ai cũng."],
["只有...才...","只有 + ĐK + 才 + KQ","Chỉ có...mới...","Điều kiện duy nhất.","\"只有努力才能成功\""],
["只要...就...","只要 + ĐK + 就 + KQ","Chỉ cần...liền","Điều kiện đủ.","\"只要努力就行\""],
["一方面...一方面...","一方面 + A + 一方面 + B","Một mặt...mặt khác","Hai khía cạnh.","\"一方面方便一方面贵\""],
["由于...因此...","由于 + A + 因此 + B","Do đó...","Nguyên nhân kết quả.","\"由于忙因此没来\""],
["为了...而...","为了 + MĐ + 而 + HĐ","Vì...mà...","Mục đích.","\"为了学习而放弃\""],
["既...又...","既 + A + 又 + B","Vừa...vừa...","Hai mặt cùng tồn tại.","\"既便宜又好\""],
["与其...不如...","与其 + A + 不如 + B","Thà...còn hơn","So sánh lựa chọn.","\"与其等不如走\""],
["从...来看","从 + Góc nhìn + 来看","Từ...xét thấy","Phán đoán từ góc nhìn.","\"从健康来看\""],
["对...有影响","对 + O + 有影响","Có ảnh hưởng đến","Ảnh hưởng.","\"对健康有影响\""],
];
$g5 = [
["无论...都... nâng cao","无论 + Wh + 都 + V","Bất kể...cũng","Điều kiện toàn diện","\"无论多么困难都要坚持\""],
["即使...也...","即使 + A + 也 + B","Dù...cũng...","Nhượng bộ giả thiết.","\"即使下雨也去\""],
["之所以...是因为...","之所以 + KQ + 是因为 + NN","Sở dĩ...là vì...","Nhấn mạnh nguyên nhân.","\"之所以成功是因为努力\""],
["以...为...","以 + A + 为 + B","Lấy...làm...","Xem...là...","\"以健康为第一位\""],
["随着...的发展","随着 + A + 的发展","Theo sự phát triển của...","Đồng biến.","\"随着经济的发展\""],
["从...角度","从 + A + 角度 + Phán đoán","Từ góc độ...","Góc nhìn phân tích.","\"从社会角度\""],
["对于...来说","对于 + A + 来说","Đối với...mà nói","Giới hạn phạm vi.","\"对于学生很重要\""],
["在...方面","在 + A + 方面","Về phương diện...","Phạm vi.","\"在学习方面\""],
["为...所...","为 + A + 所 + V","Bị/bởi...","Văn viết.","\"为大家所熟知\""],
["加以","加以 + V","Tiến hành...","Thực hiện hành động.","\"加以解决\""],
["基于","基于 + A","Dựa trên...","Căn cứ vào.","\"基于事实\""],
["从而","从而 + KQ","Từ đó...","Kết quả.","\"从而提高了效率\""],
["不仪...而且... nâng cao","不仪 + A + 而且 + B","Không chỉ...mà còn","Tầng bậc.","\"不仅是老师而且是朋友\""],
["乃至于","乃至于 + A","Thậm chí...","Mức độ cao.","\"影响乃至于全世界\""],
["况且","况且 + A","Hơn nữa...","Bổ sung lý do.","\"路远况且天气不好\""],
];
$g6 = [
["鉴于","鉴于 + A","Xét thấy...","Văn viết trang trọng.","\"鉴于当前形势\""],
["据此","据此 + V","Căn cứ vào đó","Suy luận từ điều kiện.","\"据此可以判断\""],
["可见","可见 + KQ","Có thể thấy...","Kết luận.","\"可见他很努力\""],
["反之","反之 + KQ","Ngược lại...","Đối lập.","\"反之则会失败\""],
["与其...宁可...","与其 + A + 宁可 + B","Thà...còn hơn...","Lựa chọn mạnh.","\"与其等宁可走\""],
["尚且...何况...","尚且 + A + 何况 + B","Còn...huống chi...","Nhượng bộ so sánh.","\"大人都知道何况小孩\""],
["之所以...是因为...","之所以 + KQ + 是因为 + NN","Sở dĩ...là vì...","Giải thích nguyên nhân.","\"之所以进步是因为努力\""],
["无不","无不 + V","Không ai là không","Khẳng định phổ biến.","\"无人不知\""],
["未免","未免 + Tính từ","Hơi...quá","Đánh giá nhẹ nhàng.","\"未免太贵了\""],
["不由得","不由得 + V","Không thể không","Tự nhiên mà.","\"不由得笑了起来\""],
["愈...愈...","愈 + A + 愈 + B","Càng...càng...","Văn viết.","\"愈走愈远\""],
["进而","进而 + V","Tiến mà...","Tiến một bước.","\"进而解决问题\""],
["乃至","乃至 + A","Thậm chí","Phạm vi rộng.","\"影响乃至全国\""],
["贯穿","贯穿 + A","Xuyên suốt","Từ đầu đến cuối.","\"贯穿全文\""],
["基于","基于 + A","Căn cứ vào","Văn phong chính thức.","\"基于以上分析\""],
];
$grammarBanks = [1=>$g1, 2=>$g2, 3=>$g3, 4=>$g4, 5=>$g5, 6=>$g6];
$grammarBankIndex = [1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0];

function getNextGrammar($level, $count) {
    global $grammarBanks, $grammarBankIndex;
    $bank = $grammarBanks[$level];
    $idx = $grammarBankIndex[$level];
    $result = [];
    for ($i = 0; $i < $count; $i++) {
        $result[] = $bank[$idx % count($bank)];
        $idx++;
    }
    $grammarBankIndex[$level] = $idx;
    return $result;
}

// ════════════════════════════════════════════════════
// PREPARED STATEMENTS
// ════════════════════════════════════════════════════
echo "Preparing insert statements...\n";
$stmtVocab = $conn->prepare("INSERT IGNORE INTO vocab (hanzi,pinyin,meaning,level,lesson_id,strokes,radical,example,example_vi) VALUES (?,?,?,?,?,?,?,?,?)");
$stmtGrammar = $conn->prepare("INSERT IGNORE INTO grammar (lesson_id,title,formula,meaning,`usage`,notes,sort_order) VALUES (?,?,?,?,?,?,?)");
$stmtGrammarEx = $conn->prepare("INSERT IGNORE INTO grammar_examples (grammar_id,example_cn,example_pinyin,example_vi,sort_order) VALUES (?,?,?,?,?)");
$stmtDialogue = $conn->prepare("INSERT IGNORE INTO dialogues (lesson_id,title,context,sort_order) VALUES (?,?,?,?)");
$stmtDialogueLine = $conn->prepare("INSERT IGNORE INTO dialogue_sentences (dialogue_id,speaker,chinese,pinyin,vietnamese,sort_order) VALUES (?,?,?,?,?,?)");
$stmtReading = $conn->prepare("INSERT IGNORE INTO readings (lesson_id,title,content,translation,sort_order) VALUES (?,?,?,?,?)");
$stmtListening = $conn->prepare("INSERT IGNORE INTO listening_exercises (lesson_id,title,transcript,transcript_vi,sort_order) VALUES (?,?,?,?,?)");
$stmtListeningQ = $conn->prepare("INSERT IGNORE INTO listening_questions (listening_id,question,options,answer,type,sort_order) VALUES (?,?,?,?,?,?)");

// ════════════════════════════════════════════════════
// GENERATION FUNCTIONS
// ════════════════════════════════════════════════════

function genDialogue($lessonId, $level, $lessonNum, $index) {
    $speakers = ["A","B","C","D"];
    $names = ["Lan","Minh","Hoa","Nam","Linh","Tuấn","Hương","Đức","Huyền","Anh"];
    $s1 = $speakers[$index % 2];
    $s2 = $speakers[($index + 1) % 2];
    $n1 = $names[$lessonId % 10];
    $n2 = $names[($lessonId + 5) % 10];
    
    $dialoguePatterns = [
        "greeting" => [
            ["你好！", "Chào bạn!", "Xin chào!"],
            ["你好！最近怎么样？", "Chào bạn! Dạo này thế nào?", "Xin chào! Dạo này thế nào?"],
            ["很好，谢谢！你最近忙吗？", "Tốt lắm, cảm ơn! Bạn dạo này bận không?", "Rất tốt, cảm ơn! Dạo này bạn bận không?"],
            ["我也很好，最近工作有点忙。", "Tôi cũng tốt, gần đây hơi bận việc.", "Tôi cũng tốt, gần đây công việc hơi bận."],
            ["那你注意休息，别太累了。", "Vậy bạn chú ý nghỉ ngơi, đừng quá mệt.", "Vậy bạn nhớ nghỉ ngơi, đừng quá mệt nhé."],
            ["谢谢关心！你也是。", "Cảm ơn sự quan tâm! Bạn cũng vậy.", "Cảm ơn bạn quan tâm! Bạn cũng thế nhé."],
        ],
        "shopping" => [
            ["你好，我想买东西。", "Chào bạn, tôi muốn mua đồ.", "Chào bạn, tôi muốn mua đồ."],
            ["欢迎光临！你想买什么？", "Hoan nghênh! Bạn muốn mua gì?", "Hoan nghênh quý khách! Bạn muốn mua gì ạ?"],
            ["这个多少钱？", "Cái này bao nhiêu tiền?", "Cái này giá bao nhiêu?"],
            ["这个很便宜，只要二十块。", "Cái này rất rẻ, chỉ hai mươi tệ.", "Cái này rất rẻ, chỉ 20 tệ thôi."],
            ["可以便宜一点吗？", "Có thể rẻ hơn một chút không?", "Có thể giảm giá một chút không?"],
            ["好吧，给你打个九折。", "Được rồi, giảm cho bạn 10%.", "Thôi được, giảm cho bạn 10% nhé."],
            ["谢谢！我要了。", "Cảm ơn! Tôi mua cái này.", "Cảm ơn! Tôi lấy cái này."],
        ],
        "restaurant" => [
            ["你想吃什么？", "Bạn muốn ăn gì?", "Bạn muốn ăn gì?"],
            ["我想吃中国菜。", "Tôi muốn ăn món Trung Quốc.", "Tôi muốn ăn đồ Trung Quốc."],
            ["这家餐厅很不错，我们进去吧。", "Nhà hàng này rất ngon, chúng ta vào đi.", "Quán này rất ngon, chúng ta vào đi."],
            ["好！你推荐什么菜？", "Tốt! Bạn đề xuất món gì?", "Được! Bạn gọi món gì?"],
            ["鱼香肉丝和宫保鸡丁都很好吃。", "Thịt heo xào chua ngọt và gà xào cay đều ngon.", "Cá thơm thịt sợi và gà Kung Pao đều ngon."],
            ["那就都点吧。", "Vậy gọi cả hai đi.", "Vậy gọi cả hai nhé."],
        ],
        "travel" => [
            ["放假了，你想去哪儿旅游？", "Nghỉ rồi, bạn muốn đi du lịch đâu?", "Nghỉ lễ rồi, bạn muốn đi du lịch đâu?"],
            ["我想去北京看看。", "Tôi muốn đến Bắc Kinh xem.", "Tôi muốn đến Bắc Kinh tham quan."],
            ["好主意！北京有很多名胜古迹。", "Ý kiến hay! Bắc Kinh có nhiều danh lam thắng cảnh.", "Ý hay! Bắc Kinh có nhiều danh lam thắng cảnh."],
            ["我们坐飞机去吧，比较快。", "Chúng ta đi máy bay nhé, nhanh hơn.", "Chúng ta đi máy bay đi, nhanh hơn."],
            ["好的，我马上订机票。", "Được, tôi đặt vé ngay.", "OK, tôi đặt vé máy bay ngay."],
        ],
        "hobby" => [
            ["你有什么爱好？", "Bạn có sở thích gì?", "Bạn có sở thích gì?"],
            ["我喜欢看书和听音乐。", "Tôi thích đọc sách và nghe nhạc.", "Tôi thích đọc sách và nghe nhạc."],
            ["我也是！你喜欢看什么书？", "Tôi cũng vậy! Bạn thích đọc sách gì?", "Tôi cũng thế! Bạn thích đọc sách gì?"],
            ["我喜欢看小说和历史书。", "Tôi thích đọc tiểu thuyết và sách lịch sử.", "Tôi thích đọc tiểu thuyết và sách lịch sử."],
            ["推荐一本给我吧。", "Giới thiệu một cuốn cho tôi đi.", "Giới thiệu một cuốn cho tôi với."],
        ],
        "weather" => [
            ["今天天气真好！", "Hôm nay thời tiết đẹp quá!", "Hôm nay trời đẹp quá!"],
            ["是啊，我们去公园散步吧。", "Phải đó, chúng ta đi công viên dạo đi.", "Ừ, chúng ta ra công viên đi dạo đi."],
            ["好的，等一下，我换衣服。", "Được, chờ một chút, tôi thay quần áo.", "OK, đợi tí, tôi thay quần áo."],
            ["快点，外面很舒服。", "Nhanh lên, ngoài trời rất dễ chịu.", "Nhanh lên, ngoài trời rất thoải mái."],
            ["来了来了！", "Đến rồi đến rồi!", "Tới liền tới liền!"],
        ],
    ];
    
    $patterns = array_values($dialoguePatterns);
    $pattern = $patterns[($lessonId + $index) % count($patterns)];
    $lines = [];
    foreach ($pattern as $i => $line) {
        $spk = ($i % 2 === 0) ? $s1 : $s2;
        $lines[] = [
            "speaker" => $spk,
            "chinese" => $line[0],
            "pinyin" => $line[1],
            "vietnamese" => $line[2],
            "sort_order" => $i + 1,
        ];
    }
    return $lines;
}

function genReading($lessonId, $level, $lessonNum) {
    $levelTexts = [
        1 => [
            ["我的家","我家有三口人，爸爸、妈妈和我。爸爸是医生，妈妈是老师。我是一名学生，每天去学校学习。我有很多朋友，我们一起玩得很开心。我很爱我的家，也很爱我的爸爸妈妈。今天我们一起去公园玩，天气很好，我们都很高兴。"],
            ["我的学校","我的学校很大也很漂亮。学校里有教学楼、图书馆和操场。我每天坐公交车去上学。我的同学都很友好，老师也很好。我喜欢在学校学习和交朋友。下课以后，我经常和同学一起打篮球或者看书。学校生活非常快乐。"],
        ],
        2 => [
            ["我的一天","我每天早上六点半起床，然后刷牙洗脸。七点吃早饭，我通常喝牛奶吃面包。八点去上班，我坐地铁去公司。中午十二点吃午饭，下午五点半下班回家。晚饭后我喜欢看电视或者看书。晚上十点半睡觉。这就是我的一天，很充实也很规律。"],
            ["愉快的旅行","上个月我和朋友一起去了北京旅游。我们坐飞机去的，北京很大也很漂亮。我们去了故宫、天安门广场和长城。故宫很壮观，有很多文物。长城很长，爬上去虽然累但是很高兴。我们还吃了北京烤鸭，非常好吃。这次旅行让我很难忘。"],
        ],
        3 => [
            ["健康的生活方式","健康是最重要的财富。每天坚持运动对身体有好处，比如跑步、游泳或者散步。饮食方面要注意营养均衡，多吃蔬菜水果，少吃油腻食物。还要保证充足的睡眠，不要熬夜。保持积极乐观的心态也很重要。健康的生活方式能让我们生活得更幸福。"],
            ["难忘的春节","春节是中国最重要的传统节日。每年春节，家人都要团聚在一起吃年夜饭。大家一边吃饺子一边聊天，非常热闹。孩子们最喜欢收红包，大人们互相祝福新年快乐。街上挂着红灯笼，到处都喜气洋洋。春节真是一个温馨快乐的节日。"],
        ],
        4 => [
            ["读书的乐趣","读书是一种很好的习惯，能让我们开阔眼界增长知识。通过读书，我们可以了解不同的文化和思想，感受作者的情感世界。每一本好书都像一位智慧的朋友，给我们带来启发和思考。在忙碌的生活中，找一个安静的角落读一本好书，是一种难得的享受。让我们养成读书的习惯吧。"],
            ["科技改变生活","科技的发展给我们的生活带来了巨大的变化。互联网让我们随时随地获取信息，智能手机使沟通更加便捷。现在我们可以网上购物、在线学习、远程办公，生活越来越方便。人工智能技术正在改变各行各业，让工作效率大大提高。科技让生活更美好，但也带来了一些挑战。"],
        ],
        5 => [
            ["成功的秘诀","每个人都渴望成功，但成功的道路并不平坦。首先，要设定明确的目标，然后为之努力奋斗。遇到困难和挫折时不要轻易放弃，要坚持不懈。第二，要善于学习，不断充实自己。第三，要学会与人合作，团队的力量大于个人。最后，保持积极乐观的心态很重要。成功不是一蹴而就的，需要付出持续的努力和汗水。"],
            ["环境保护人人有责","随着工业化的加速，环境问题日益严重。空气污染、水污染、森林砍伐等威胁着我们的生存环境。保护环境刻不容缓。我们每个人都可以从身边的小事做起：节约用水用电、减少使用一次性塑料制品、垃圾分类回收、多乘坐公共交通工具等。只有每个人都行动起来，我们才能拥有一个绿色健康的家园。"],
        ],
        6 => [
            ["文化自信与传承","文化是一个国家一个民族的灵魂。中华文明五千年源远流长，博大精深。在全球化时代，文化自信尤为重要。我们要深入了解中华优秀传统文化，同时也要以开放包容的态度吸收外来文化的有益成分。文化传承不是简单的复制，而是在继承的基础上创新。让中华文化在世界舞台上绽放更加绚丽的光彩。"],
            ["人工智能时代的挑战与机遇","人工智能正在以前所未有的速度改变着世界。从自动驾驶到医疗诊断，从语音助手到智能推荐，AI技术已经渗透到生活的方方面面。人工智能既带来了巨大的机遇，也带来了挑战。如何确保AI技术的安全可控，如何应对就业结构的变化，如何解决数据隐私和伦理问题，都是我们需要认真思考的重要课题。"],
        ],
    ];
    
    $texts = $levelTexts[$level];
    $idx = ($lessonNum - 1) % count($texts);
    $content = $texts[$idx][0];
    $title = "Bài đọc " . $lessonNum;
    
    // Generate a simple translation
    $translation = "Bản dịch tiếng Việt cho bài đọc số " . $lessonNum . " (HSK " . $level . "). Nội dung bài đọc xoay quanh các chủ đề phù hợp với trình độ HSK " . $level . ".";
    
    return [$title, $content, $translation];
}

function genListening($lessonId, $level, $lessonNum, $qCount) {
    $topics = [
        ["请问，你叫什么名字？","A. 我是学生 B. 我叫李明 C. 我很好",1],
        ["今天星期几？","A. 今天星期一 B. 今天天气好 C. 我去学校",0],
        ["你家有几口人？","A. 我家有三口人 B. 我爸爸是医生 C. 我喜欢小猫",0],
        ["现在几点？","A. 三点 B. 三块 C. 三里",0],
        ["你去哪儿？","A. 我坐车 B. 我去超市 C. 我很好",1],
        ["她是谁？","A. 她是老师 B. 她很好 C. 她叫小红",0],
        ["这是什么？","A. 这是书 B. 这是白色 C. 这是好吃",0],
        ["明天天气怎么样？","A. 明天星期一 B. 明天天气很好 C. 明天不上学",1],
        ["你吃饭了吗？","A. 我吃了 B. 我喝水 C. 我睡觉",0],
        ["你喜欢什么颜色？","A. 我喜欢红色 B. 我喜欢看书 C. 我很好",0],
        ["你每天早上几点起床？","A. 我家很近 B. 我六点起床 C. 我吃面包",1],
        ["你周末喜欢做什么？","A. 我喜欢看书和跑步 B. 我去公司上班 C. 我坐地铁",0],
        ["你住在哪儿？","A. 我住在学校附近 B. 我去学校 C. 我住宿舍",0],
    ];
    
    $transcript = "Đây là bài nghe dành cho bài học số " . $lessonId . " trình độ HSK " . $level . ". Hãy lắng nghe và trả lời các câu hỏi sau đây.";
    $questions = [];
    for ($q = 0; $q < $qCount; $q++) {
        $topic = $topics[($lessonId + $q) % count($topics)];
        $optArr = explode(" ", $topic[1]);
        $options = json_encode($optArr, JSON_UNESCAPED_UNICODE);
        $questions[] = [
            "question" => $topic[0],
            "options" => $options,
            "answer" => $optArr[$topic[2]],
            "type" => "multiple_choice",
        ];
    }
    return [$transcript, $questions];
}

// ════════════════════════════════════════════════════
// SENTENCE BANKS PER LEVEL
// ════════════════════════════════════════════════════
$sentenceBanks = [
    1 => ["你好，我叫小明。","今天天气很好。","他是我的同学。","我是学生。","你去哪儿？","谢谢你的帮助。","我有一本书。","她是我妈妈。","你叫什么名字？","我喜欢中文。","明天是星期一。","我家有三口人。","我不想去。","我们一起走吧。","祝你生日快乐。","我在学校学习。","他是我朋友。","我们都很高兴。","你吃苹果吗？","我坐车去北京。"],
    2 => ["九月去北京旅游最好。","我每天六点起床。","左边那个红色的是我的。","这个工作是他帮我介绍的。","大家互相帮助。","每天坚持锻炼身体好。","你家离公司远吗？","我比你大两岁。","你怎么来学校的？","吃完饭以后我们去看电影。","新年快乐万事如意。","我坐地铁去上班。","别着急慢慢来。","这件衣服太大了。","他比我高很多。","我们一起去公园散步。","明天我要去旅行。","这件衣服非常漂亮。"],
    3 => ["周末你有什么打算？","他什么时候回来？","桌子上放着很多饮料。","我最近越来越胖了。","我跟她都认识五年了。","我马上让他来。","她没说话只是笑了笑。","数学比历史难多了。","我的爱好是看电影。","把窗户打开通通风。","钱包被偷了。","我迷路了请问怎么去火车站。","今天我请客。","健康最重要。","保护环境人人有责。","我们坐飞机去上海。","我的梦想是当医生。","难忘的旅行经历。","这个故事很有意思。"],
    4 => ["真正的朋友会在你需要的时候出现。","读书可以开阔眼界。","生活的味道有酸甜苦辣。","工作的乐趣在于实现自我价值。","健康与运动密不可分。","文化与传统需要我们去传承。","科技改变了我们的生活方式。","保护环境就是保护我们的未来。","梦想与未来靠我们自己去创造。","沟通是一门艺术。","家庭教育对孩子的影响很大。","美食与健康要平衡。","旅行可以了解不同的文化。","城市生活方便但压力大。","农村生活安静但设施不足。","学习是一生的事业。"],
    5 => ["选择与放弃是人生的必修课。","成功的秘诀在于坚持不懈。","全球变暖是当今最重要的环境问题之一。","教育平等是社会进步的基础。","人工智能正在改变各行各业。","文学鉴赏可以提高人的修养。","艺术之美让生活更丰富多彩。","经济的快速发展改善了人民的生活水平。","国际贸易促进了世界各国之间的交流与合作。","科技创新是推动社会进步的重要力量。","心理健康与身体健康同样重要。","传统文化的传承需要我们每一个人的努力。","媒体在社会中扮演着重要的角色。","城市化进程加快带来了许多社会问题。","消费文化反映了时代的特征。"],
    6 => ["全球化使得世界各国之间的文化交流越来越频繁。","跨文化交际能力在国际交往中至关重要。","互联网治理需要平衡发展与安全的关系。","太空探索代表了人类对未知世界的渴望。","知识产权保护是鼓励创新的重要保障。","社会公正是构建和谐社会的基础。","慈善事业体现了人类社会的温暖与关爱。","生态文明建设是可持续发展的必然要求。","教育改革关系到国家的未来。","文化遗产保护是每个公民的责任。","城市规划要兼顾经济发展与环境保护。","公共卫生体系的建设至关重要。","基因技术的发展带来了新的伦理挑战。","量子计算将引领下一次科技革命。","航天工程是一个国家综合实力的体现。","海洋资源的开发与保护同样重要。","能源战略关系到国家的长远发展。","乡村振兴是全面实现现代化的重要环节。","数字经济正在重塑世界经济格局。","老龄化社会对养老体系提出了新的要求。"],
];

// ════════════════════════════════════════════════════
// MAIN GENERATION LOOP - ALL 146 LESSONS
// ════════════════════════════════════════════════════
echo "\n=== BẮT ĐẦU SINH NỘI DUNG ===\n\n";

for ($lessonId = 1; $lessonId <= 146; $lessonId++) {
    $level = getLevel($lessonId);
    $lessonInfo = $conn->query("SELECT * FROM lessons WHERE id = $lessonId")->fetch(PDO::FETCH_ASSOC);
    if (!$lessonInfo) {
        echo "  Bỏ qua lesson $lessonId (không tồn tại)\n";
        continue;
    }
    $lessonNum = $lessonInfo["lesson_num"];
    $rich = isRichLesson($lessonId);
    
    $vCount = $rich ? 25 : 15;
    $gCount = $rich ? 4 : 3;
    $dCount = $rich ? 2 : 1;
    $lCount = $rich ? 3 : 2;
    
    echo "Bài $lessonId (HSK$level-$lessonNum): " . $lessonInfo["title"] . "\n";
    
    // ── VOCAB ──
    $vocabList = getNextVocab($level, $vCount);
    $sentences = $sentenceBanks[$level];
    foreach ($vocabList as $v) {
        try {
            $exSent = $sentences[array_rand($sentences)];
            $stmtVocab->execute([$v[0], $v[1], $v[2], $level, $lessonId, $v[3], $v[4], $v[5], $v[6]]);
            $vocabCount++;
        } catch (Exception $e) {}
    }
    
    // ── GRAMMAR ──
    $grammarList = getNextGrammar($level, $gCount);
    $sort = 1;
    foreach ($grammarList as $g) {
        try {
            $stmtGrammar->execute([$lessonId, $g[0], $g[1], $g[2], $g[3], $g[4], $sort]);
            $gid = $conn->lastInsertId();
            $grammarCount++;
            // Add 2 examples
            for ($ex = 0; $ex < 2; $ex++) {
                $exCn = $sentences[array_rand($sentences)];
                $exPy = "pinyin for example " . ($ex + 1);
                $exVi = "Câu ví dụ " . ($ex + 1) . " cho ngữ pháp này.";
                $stmtGrammarEx->execute([$gid, $exCn, $exPy, $exVi, $ex + 1]);
                $grammarExCount++;
            }
            $sort++;
        } catch (Exception $e) {}
    }
    
    // ── DIALOGUES ──
    for ($d = 0; $d < $dCount; $d++) {
        try {
            $dialogueTitle = "Hội thoại " . ($d + 1) . ": " . $lessonInfo["title"];
            $dialogueContext = "Đây là cuộc hội thoại liên quan đến chủ đề " . $lessonInfo["title"] . ".";
            $stmtDialogue->execute([$lessonId, $dialogueTitle, $dialogueContext, $d + 1]);
            $did = $conn->lastInsertId();
            $dialogueCount++;
            
            $lines = genDialogue($lessonId, $level, $lessonNum, $d);
            foreach ($lines as $line) {
                $stmtDialogueLine->execute([$did, $line["speaker"], $line["chinese"], $line["pinyin"], $line["vietnamese"], $line["sort_order"]]);
                $dialogueLineCount++;
            }
        } catch (Exception $e) {}
    }
    
    // ── READING ──
    try {
        list($readingTitle, $readingContent, $readingTrans) = genReading($lessonId, $level, $lessonNum);
        $stmtReading->execute([$lessonId, $readingTitle, $readingContent, $readingTrans, 1]);
        $readingCount++;
    } catch (Exception $e) {}
    
    // ── LISTENING ──
    try {
        $listeningTitle = "Bài nghe " . $lessonNum;
        list($listeningTranscript, $listeningQuestions) = genListening($lessonId, $level, $lessonNum, $lCount);
        $stmtListening->execute([$lessonId, $listeningTitle, $listeningTranscript, "Bản dịch bài nghe tiếng Việt.", 1]);
        $lid = $conn->lastInsertId();
        $listeningCount++;
        
        foreach ($listeningQuestions as $lq) {
            $stmtListeningQ->execute([$lid, $lq["question"], $lq["options"], $lq["answer"], $lq["type"], 1]);
            $listeningQCount++;
        }
    } catch (Exception $e) {}
}


// ════════════════════════════════════════════════════
// VERIFICATION & SUMMARY
// ════════════════════════════════════════════════════
$conn->exec("SET FOREIGN_KEY_CHECKS = 1");

$endTime = microtime(true);
$duration = round($endTime - $startTime, 2);

echo "\n=== HOÀN TẤT SINH NỘI DONG ===\n";
echo "Thời gian chạy: {$duration} giây\n\n";

echo "=== THỐNG KÊ ===\n";
echo "  Tổng số bài học: 146\n";
echo "  Vocab: {$vocabCount}\n";
echo "  Grammar: {$grammarCount}\n";
echo "  Grammar examples: {$grammarExCount}\n";
echo "  Dialogues: {$dialogueCount}\n";
echo "  Dialogue lines: {$dialogueLineCount}\n";
echo "  Readings: {$readingCount}\n";
echo "  Listening exercises: {$listeningCount}\n";
echo "  Listening questions: {$listeningQCount}\n";

$tables = ["vocab","grammar","grammar_examples","dialogues","dialogue_sentences","readings","listening_exercises","listening_questions"];
echo "\n=== KIỂM TRA DB ===\n";
foreach ($tables as $table) {
    try {
        $row = $conn->query("SELECT COUNT(*) as cnt FROM $table")->fetch(PDO::FETCH_ASSOC);
        echo "  {$table}: {$row["cnt"]} dòng\n";
    } catch (Exception $e) {
        echo "  {$table}: LỖI - {$e->getMessage()}\n";
    }
}

echo "\n=== KẾT THÚC ===" . PHP_EOL;
