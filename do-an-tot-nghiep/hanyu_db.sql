-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 12, 2026 lúc 11:15 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hanyu_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ai_image_history`
--

CREATE TABLE `ai_image_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `detected_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `author` varchar(100) DEFAULT 'Ẩn danh',
  `content` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `daily_streak`
--

CREATE TABLE `daily_streak` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `streak_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `daily_streak`
--

INSERT INTO `daily_streak` (`id`, `user_id`, `streak_date`) VALUES
(1, 'user_3', '2026-06-12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `lesson_num` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `vocab_count` int(11) DEFAULT 10,
  `grammar` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'vocab',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lessons`
--

INSERT INTO `lessons` (`id`, `level`, `lesson_num`, `title`, `description`, `vocab_count`, `grammar`, `type`, `created_at`) VALUES
(1, 1, 1, 'Chào hỏi & Giới thiệu', 'Học cách chào hỏi, giới thiệu bản thân', 8, 'Cấu trúc: Subject + 是 + Object', 'vocab', '2026-05-10 11:43:46'),
(2, 1, 2, 'Số đếm & Đếm số', 'Số từ 0-100, cách đếm', 10, 'Số + danh từ', 'vocab', '2026-05-10 11:43:46'),
(3, 1, 3, 'Gia đình & Quan hệ', 'Tên gọi trong gia đình', 8, 'Cái/Ai/Con gì', 'vocab', '2026-05-10 11:43:46'),
(4, 1, 4, 'Thời gian & Ngày tháng', 'Ngày, tháng, năm, giờ', 10, 'Mấy giờ/ngày nào', 'vocab', '2026-05-10 11:43:46'),
(5, 1, 5, 'Màu sắc & Hình dạng', 'Tên màu, hình dạng', 8, 'Tính từ + danh từ', 'vocab', '2026-05-10 11:43:46'),
(6, 1, 6, 'Đồ ăn & Thức uống', 'Tên món ăn, đồ uống hàng ngày', 10, 'Động từ + Tân ngữ (Verb + Object)… Ví dụ: 吃面包 (chī miànbāo) - Ăn bánh mì', 'vocab', '2026-06-09 10:15:29'),
(7, 1, 7, 'Thời tiết & Mùa', 'Thời tiết, các mùa trong năm', 8, 'Câu miêu tả thời tiết: 今天 + Tính từ… Ví dụ: 今天很冷 (jīntiān hěn lěng) - Hôm nay rất lạnh', 'vocab', '2026-06-09 10:15:29'),
(8, 1, 8, 'Phương hướng & Vị trí', 'Chỉ đường, vị trí', 8, 'Danh từ chỉ phương hướng + 边/面… Ví dụ: 前面 (qiánmiàn) - Phía trước', 'vocab', '2026-06-09 10:15:29'),
(9, 2, 9, 'Mua sắm & Giá cả', 'Mua bán, hỏi giá, thanh toán', 10, 'Câu hỏi giá cả: 多少钱？(duōshao qián?) - Bao nhiêu tiền?… Cấu trúc: Chủ ngữ + 多少钱', 'vocab', '2026-06-09 10:15:29'),
(10, 2, 10, 'Du lịch & Phương tiện', 'Tàu xe, máy bay, khách sạn', 10, 'Cấu trúc: 坐/骑/开 + Phương tiện… Ví dụ: 坐飞机 (zuò fēijī) - Đi máy bay', 'vocab', '2026-06-09 10:15:29'),
(11, 2, 11, 'Sức khỏe & Bệnh viện', 'Khám bệnh, thuốc men', 8, 'Cấu trúc: 了 (le) chỉ sự thay đổi trạng thái… Ví dụ: 生病了 (shēngbìng le) - Bị ốm rồi', 'vocab', '2026-06-09 10:15:29'),
(12, 2, 12, 'Sở thích & Thể thao', 'Thể thao, sở thích cá nhân', 10, 'Cấu trúc: 喜欢/爱 + Động từ… Ví dụ: 喜欢唱歌 (xǐhuān chànggē) - Thích hát', 'vocab', '2026-06-09 10:15:29'),
(13, 2, 13, 'Công việc & Nghề nghiệp', 'Nghề nghiệp, công việc hàng ngày', 8, 'Cấu trúc: 在 + Nơi chốn + Động từ… Ví dụ: 在公司工作 (zài gōngsī gōngzuò) - Làm việc ở công ty', 'vocab', '2026-06-09 10:15:29'),
(14, 2, 14, 'Điện thoại & Internet', 'Gọi điện, mạng internet', 8, 'Cấu trúc: 用 + Công cụ + Động từ… Ví dụ: 用手机打电话 (yòng shǒujī dǎ diànhuà) - Dùng điện thoại gọi', 'vocab', '2026-06-09 10:15:29'),
(15, 2, 15, 'Giáo dục & Trường học', 'Học tập, trường lớp', 8, 'Cấu trúc: 在 + Địa điểm + Động từ… Ví dụ: 在教室学习 (zài jiàoshì xuéxí) - Học trong lớp', 'vocab', '2026-06-09 10:15:29'),
(16, 3, 16, 'Ngân hàng & Bưu điện', 'Giao dịch ngân hàng, gửi thư', 8, 'Cấu trúc: 去 + Địa điểm + Động từ… Ví dụ: 去银行取款 (qù yínháng qǔkuǎn) - Đi ngân hàng rút tiền', 'vocab', '2026-06-09 10:15:29'),
(17, 3, 17, 'Văn hóa & Phong tục', 'Tết, lễ hội, phong tục tập quán', 8, 'Cấu trúc: 过 + Tết/Lễ hội… Ví dụ: 过春节 (guò chūnjié) - Đón Tết Nguyên đán', 'vocab', '2026-06-09 10:15:29'),
(18, 3, 18, 'Môi trường & Thiên nhiên', 'Bảo vệ môi trường, động thực vật', 8, 'Cấu trúc: 保护/爱护 + Danh từ… Ví dụ: 保护环境 (bǎohù huánjìng) - Bảo vệ môi trường', 'vocab', '2026-06-09 10:15:29'),
(19, 3, 19, 'Kinh tế & Thương mại', 'Kinh doanh, hợp đồng, thị trường', 8, 'Cấu trúc: 发展/投资 + Danh từ… Ví dụ: 发展经济 (fāzhǎn jīngjì) - Phát triển kinh tế', 'vocab', '2026-06-09 10:15:29'),
(20, 3, 20, 'Công nghệ & Khoa học', 'Máy tính, khoa học kỹ thuật', 8, 'Cấu trúc: 人工智能/技术 + Danh từ… Ví dụ: 科学技术 (kēxué jìshù) - Khoa học kỹ thuật', 'vocab', '2026-06-09 10:15:29'),
(21, 4, 1, 'Cuộc sống hàng ngày', 'Thói quen, sinh hoạt thường ngày', 10, 'Cấu trúc: 每天/经常 + Động từ… Chỉ thói quen hàng ngày', 'vocab', '2026-06-12 05:15:36'),
(22, 4, 2, 'Công việc & Sự nghiệp', 'Môi trường làm việc, thăng tiến', 10, 'Cấu trúc: 已经/正在/将要 + Động từ… Diễn tả thời gian', 'vocab', '2026-06-12 05:15:36'),
(23, 4, 3, 'Sức khỏe & Thể thao', 'Tập luyện, sức khỏe, bệnh tật', 10, 'Cấu trúc: 多/少 + Động từ… Khuyên bảo sức khỏe', 'vocab', '2026-06-12 05:15:36'),
(24, 4, 4, 'Du lịch & Giao thông', 'Đi lại, khách sạn, phương tiện', 10, 'Cấu trúc: 从 + Địa điểm + 到 + Địa điểm… Chỉ lộ trình', 'vocab', '2026-06-12 05:15:36'),
(25, 4, 5, 'Mua sắm & Tiêu dùng', 'Mua bán, dịch vụ, thanh toán', 10, 'Cấu trúc: 太 + Tính từ + 了… Nhấn mạnh mức độ', 'vocab', '2026-06-12 05:15:36'),
(26, 4, 6, 'Giáo dục & Học tập', 'Trường lớp, phương pháp học', 10, 'Cấu trúc: 除了…以外, 还/也… Ngoại trừ', 'vocab', '2026-06-12 05:15:36'),
(27, 4, 7, 'Văn hóa & Xã hội', 'Phong tục, lễ hội, xã hội', 10, 'Cấu trúc: 对 + Danh từ + 感兴趣… Bày tỏ sự quan tâm', 'vocab', '2026-06-12 05:15:36'),
(28, 4, 8, 'Cảm xúc & Tâm trạng', 'Vui buồn, lo lắng, hy vọng', 10, 'Cấu trúc: 感到/觉得 + Tính từ… Diễn tả cảm xúc', 'vocab', '2026-06-12 05:15:36'),
(29, 4, 9, 'Khoa học & Công nghệ', 'Internet, máy tính, phát minh', 10, 'Cấu trúc: 越来 + 越 + Tính từ… Càng ngày càng', 'vocab', '2026-06-12 05:15:36'),
(30, 4, 10, 'Môi trường & Thiên nhiên', 'Bảo vệ môi trường, thời tiết', 10, 'Cấu trúc: 如果…就… Câu điều kiện', 'vocab', '2026-06-12 05:15:36'),
(31, 5, 1, 'Kinh tế & Tài chính', 'Thị trường, đầu tư, ngân hàng', 10, 'Cấu trúc: 随着 + Danh từ… Diễn tả sự thay đổi theo thời gian', 'vocab', '2026-06-12 05:15:36'),
(32, 5, 2, 'Nghệ thuật & Văn học', 'Hội họa, âm nhạc, văn chương', 10, 'Cấu trúc: 不仅…而且… Không những…mà còn', 'vocab', '2026-06-12 05:15:36'),
(33, 5, 3, 'Luật pháp & Chính trị', 'Pháp luật, chính quyền, quyền lợi', 10, 'Cấu trúc: 根据/按照 + Danh từ… Theo như/Căn cứ vào', 'vocab', '2026-06-12 05:15:36'),
(34, 5, 4, 'Ngoại giao & Quan hệ quốc tế', 'Đối ngoại, hòa bình, hợp tác', 10, 'Cấu trúc: 无论…都… Bất kể…đều', 'vocab', '2026-06-12 05:15:36'),
(35, 5, 5, 'Y học & Dược phẩm', 'Bệnh viện, thuốc men, điều trị', 10, 'Cấu trúc: 即使…也… Cho dù…cũng', 'vocab', '2026-06-12 05:15:36'),
(36, 5, 6, 'Báo chí & Truyền thông', 'Tin tức, báo đài, mạng xã hội', 10, 'Cấu trúc: 对于 + Danh từ… Đối với', 'vocab', '2026-06-12 05:15:36'),
(37, 5, 7, 'Kiến trúc & Xây dựng', 'Nhà cửa, công trình, thiết kế', 10, 'Cấu trúc: 通过 + Danh từ/Động từ… Thông qua', 'vocab', '2026-06-12 05:15:36'),
(38, 5, 8, 'Ẩm thực & Nấu nướng', 'Món ăn, nguyên liệu, chế biến', 10, 'Cấu trúc: 之一… Một trong những', 'vocab', '2026-06-12 05:15:36'),
(39, 5, 9, 'Thể thao chuyên nghiệp', 'Giải đấu, vận động viên, kỷ lục', 10, 'Cấu trúc: 由于 + Danh từ… Do/Bởi vì', 'vocab', '2026-06-12 05:15:36'),
(40, 5, 10, 'Khoa học xã hội', 'Xã hội học, tâm lý, giáo dục', 10, 'Cấu trúc: 以 + Động từ… Để/Nhằm', 'vocab', '2026-06-12 05:15:36'),
(41, 6, 1, 'Triết học & Tư tưởng', 'Tư duy, học thuyết, quan điểm', 10, 'Cấu trúc: 从…角度/方面来看… Xét từ góc độ', 'vocab', '2026-06-12 05:15:36'),
(42, 6, 2, 'Khoa học tự nhiên', 'Vật lý, hóa học, sinh học', 10, 'Cấu trúc: 之所以…是因为… Sở dĩ…là vì', 'vocab', '2026-06-12 05:15:36'),
(43, 6, 3, 'Lịch sử & Khảo cổ', 'Sử ký, di tích, văn minh', 10, 'Cấu trúc: 由此可见… Từ đó có thể thấy', 'vocab', '2026-06-12 05:15:36'),
(44, 6, 4, 'Kinh doanh & Quản lý', 'Chiến lược, lãnh đạo, tổ chức', 10, 'Cấu trúc: 尽管如此… Tuy nhiên/Mặc dù vậy', 'vocab', '2026-06-12 05:15:36'),
(45, 6, 5, 'Quân sự & Quốc phòng', 'An ninh, chiến tranh, hòa bình', 10, 'Cấu trúc: 不但…反而… Không những…ngược lại', 'vocab', '2026-06-12 05:15:36'),
(46, 6, 6, 'Tôn giáo & Tín ngưỡng', 'Đức tin, lễ nghi, tâm linh', 10, 'Cấu trúc: 与其…不如… Thà…còn hơn', 'vocab', '2026-06-12 05:15:36'),
(47, 6, 7, 'Mỹ thuật & Thiết kế', 'Hội họa, điêu khắc, thời trang', 10, 'Cấu trúc: 凡是…都… Hễ là…đều', 'vocab', '2026-06-12 05:15:36'),
(48, 6, 8, 'Công nghệ thông tin', 'AI, dữ liệu, lập trình', 10, 'Cấu trúc: 基于 + Danh từ… Dựa trên', 'vocab', '2026-06-12 05:15:36'),
(49, 6, 9, 'Y học hiện đại', 'Di truyền, giải phẫu, công nghệ y', 10, 'Cấu trúc: 以至于… Đến nỗi mà…', 'vocab', '2026-06-12 05:15:36'),
(50, 6, 10, 'Toàn cầu hóa', 'Hội nhập, đa văn hóa, phát triển', 10, 'Cấu trúc: 从…出发… Xuất phát từ…', 'vocab', '2026-06-12 05:15:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `identifier` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `attempted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `identifier`, `ip_address`, `attempted_at`) VALUES
(1, 'test', '::1', '2026-06-12 09:12:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notebook`
--

CREATE TABLE `notebook` (
  `id` int(11) NOT NULL,
  `vocab_id` int(11) NOT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(50) DEFAULT 'default_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notebook`
--

INSERT INTO `notebook` (`id`, `vocab_id`, `saved_at`, `user_id`) VALUES
(5, 77, '2026-06-09 12:16:38', 'default_user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) DEFAULT 'Ẩn danh',
  `tags` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `likes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `vocab_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT 'default_user',
  `write_completed` tinyint(1) DEFAULT 0,
  `speech_completed` tinyint(1) DEFAULT 0,
  `quiz_score` int(11) DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `progress`
--

INSERT INTO `progress` (`id`, `vocab_id`, `lesson_id`, `user_id`, `write_completed`, `speech_completed`, `quiz_score`, `completed_at`, `created_at`) VALUES
(4, 1, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 11:56:11'),
(5, 2, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 11:56:12'),
(6, 3, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 11:56:13'),
(7, 4, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 11:56:13'),
(8, 5, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 11:56:13'),
(9, 6, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 11:56:14'),
(10, 7, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 11:56:14'),
(11, NULL, 1, 'default_user', 1, 0, 0, '2026-06-09 11:56:27', '2026-06-09 11:56:27'),
(12, 8, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:14'),
(13, 77, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:53'),
(14, 78, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:53'),
(15, 79, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:54'),
(16, 80, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:54'),
(17, 81, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:55'),
(18, 84, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:56'),
(19, 85, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:56'),
(20, 86, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:17:58'),
(21, 9, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:27'),
(22, 10, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:27'),
(23, 11, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:28'),
(24, 12, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:28'),
(25, 13, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:28'),
(26, 14, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:28'),
(27, 15, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:29'),
(28, 16, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:29'),
(29, 17, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:29'),
(30, 69, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:55'),
(31, 70, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:55'),
(32, 71, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:56'),
(33, 72, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:56'),
(34, 73, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:56'),
(35, 74, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:56'),
(36, 75, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:18:56'),
(37, 67, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:19:09'),
(38, 68, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:19:10'),
(39, 115, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:19:59'),
(40, 116, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:19:59'),
(41, 117, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:19:59'),
(42, 118, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:19:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pvp_rooms`
--

CREATE TABLE `pvp_rooms` (
  `id` int(11) NOT NULL,
  `room_code` varchar(6) NOT NULL,
  `player1_id` varchar(50) NOT NULL,
  `player1_name` varchar(100) DEFAULT '',
  `player2_id` varchar(50) DEFAULT NULL,
  `player2_name` varchar(100) DEFAULT '',
  `level` int(11) DEFAULT 1,
  `quiz_type` varchar(20) DEFAULT 'choice',
  `status` varchar(20) DEFAULT 'waiting',
  `total_questions` int(11) DEFAULT 10,
  `player1_score` int(11) DEFAULT 0,
  `player1_total` int(11) DEFAULT 0,
  `player2_score` int(11) DEFAULT 0,
  `player2_total` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `pvp_rooms`
--

INSERT INTO `pvp_rooms` (`id`, `room_code`, `player1_id`, `player1_name`, `player2_id`, `player2_name`, `level`, `quiz_type`, `status`, `total_questions`, `player1_score`, `player1_total`, `player2_score`, `player2_total`, `created_at`, `completed_at`) VALUES
(1, '4RGH6V', 'default_user', 'TestUser', 'user_2', 'Player2', 1, 'choice', 'finished', 5, 8, 10, 6, 10, '2026-06-09 09:41:29', '2026-06-09 09:41:39'),
(2, '814EEC', 'test1', 'TestUser', 'test2', 'Player2', 1, 'choice', 'finished', 5, 3, 5, 4, 5, '2026-06-12 05:13:36', '2026-06-12 05:13:47'),
(3, 'F9F422', 'default_user', 'default_user', NULL, '', 1, 'choice', 'waiting', 10, 2, 10, 0, 0, '2026-06-12 07:10:18', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT 'default_user',
  `quiz_type` varchar(50) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `radicals`
--

CREATE TABLE `radicals` (
  `id` int(11) NOT NULL,
  `char` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `name_vietnamese` varchar(50) NOT NULL,
  `strokes` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `examples` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `radicals`
--

INSERT INTO `radicals` (`id`, `char`, `name`, `name_vietnamese`, `strokes`, `category`, `examples`, `created_at`) VALUES
(1, '亻', 'ren2', 'Nhân (Người)', 2, 'Người', '你,我,他', '2026-06-09 07:54:39'),
(2, '女', 'nv3', 'Nữ', 3, 'Nữ', '好,妈,她', '2026-06-09 07:54:39'),
(3, '宀', 'mian4', 'Miên (Mái)', 3, 'Miên', '家,字,安', '2026-06-09 07:54:39'),
(4, '口', 'kou3', 'Khẩu (Miệng)', 3, 'Khẩu', '吃,喝,叫', '2026-06-09 07:54:39'),
(5, '忄', 'xin1', 'Tâm (Tim)', 3, 'Tâm', '想,情,怕', '2026-06-09 07:54:39'),
(6, '氵', 'san1', 'Thủy (Nước)', 3, 'Thủy', '江,海,河', '2026-06-09 07:54:39'),
(7, '火', 'huo3', 'Hỏa (Lửa)', 4, 'Hỏa', '火,灯,热', '2026-06-09 07:54:39'),
(8, '木', 'mu4', 'Mộc (Cây)', 4, 'Mộc', '树,本,林', '2026-06-09 07:54:39'),
(9, '钅', 'jin1', 'Kim (Kim loại)', 5, 'Kim', '钱,铁,铜', '2026-06-09 07:54:39'),
(10, '艹', 'cao3', 'Hoa (Cỏ)', 3, 'Hoa', '花,菜,苹', '2026-06-09 07:54:39'),
(11, '讠', 'yan2', 'Ngôn (Lời)', 2, 'Ngôn', '说,话,请', '2026-06-09 07:54:39'),
(12, '日', 'ri4', 'Nhật (Mặt trời)', 4, 'Nhật', '明,早,天', '2026-06-09 07:54:39'),
(13, '月', 'yue4', 'Nguyệt (Trăng)', 4, 'Nguyệt', '明,朋,有', '2026-06-09 07:54:39'),
(14, '扌', 'shou3', 'Thủ (Tay)', 3, 'Thủ', '打,把,提', '2026-06-09 07:54:39'),
(15, '心', 'xin1', 'Tâm (Tim)', 4, 'Tâm', '想,心', '2026-06-09 07:54:39'),
(16, '土', 'tu3', 'Thổ (Đất)', 3, 'Thổ', '地,块,场', '2026-06-09 07:54:39'),
(17, '山', 'shan1', 'Sơn (Núi)', 3, 'Sơn', '山,岛,岭', '2026-06-09 07:54:39'),
(18, '石', 'shi2', 'Thạch (Đá)', 5, 'Thạch', '石,矿,磁', '2026-06-09 07:54:39'),
(19, '田', 'tian2', 'Điền (Ruộng)', 5, 'Điền', '田,男,备', '2026-06-09 07:54:39'),
(20, '目', 'mu4', 'Mục (Mắt)', 5, 'Mục', '眼,看,睛', '2026-06-09 07:54:39'),
(21, '耳', 'er3', 'Nhĩ (Tai)', 6, 'Nhĩ', '听,声,闻', '2026-06-09 07:54:39'),
(22, '米', 'mi3', 'Mễ (Gạo)', 6, 'Mễ', '米,粮,粉', '2026-06-09 07:54:39'),
(23, '虫', 'chong2', 'Trùng (Sâu)', 6, 'Trùng', '虫,蚂,蚁', '2026-06-09 07:54:39'),
(24, '雨', 'yu3', 'Vũ (Mưa)', 8, 'Vũ', '雨,雪,雷', '2026-06-09 07:54:39'),
(25, '风', 'feng1', 'Phong (Gió)', 4, 'Phong', '风,飘,疯', '2026-06-09 07:54:39'),
(26, '马', 'ma3', 'Mã (Ngựa)', 3, 'Mã', '马,骑,驴', '2026-06-09 07:54:39'),
(27, '鸟', 'niao3', 'Điểu (Chim)', 5, 'Điểu', '鸟,鸡,鸭', '2026-06-09 07:54:39'),
(28, '鱼', 'yu2', 'Ngư (Cá)', 8, 'Ngư', '鱼,鲜,鲁', '2026-06-09 07:54:39'),
(29, '车', 'che1', 'Xa (Xe)', 4, 'Xa', '车,转,轻', '2026-06-09 07:54:39'),
(30, '门', 'men2', 'Môn (Cửa)', 3, 'Môn', '门,问,间', '2026-06-09 07:54:39'),
(31, '马', 'ma3', 'Mã (Ngựa)', 3, 'Mã', '马,骑', '2026-06-09 07:54:39'),
(32, '亻', 'ren2', 'Nhân (Người)', 2, 'Người', '你,我,他', '2026-06-09 07:58:56'),
(33, '女', 'nv3', 'Nữ', 3, 'Nữ', '好,妈,她', '2026-06-09 07:58:56'),
(34, '宀', 'mian4', 'Miên (Mái)', 3, 'Miên', '家,字,安', '2026-06-09 07:58:56'),
(35, '口', 'kou3', 'Khẩu (Miệng)', 3, 'Khẩu', '吃,喝,叫', '2026-06-09 07:58:56'),
(36, '忄', 'xin1', 'Tâm (Tim)', 3, 'Tâm', '想,情,怕', '2026-06-09 07:58:56'),
(37, '氵', 'san1', 'Thủy (Nước)', 3, 'Thủy', '江,海,河', '2026-06-09 07:58:56'),
(38, '火', 'huo3', 'Hỏa (Lửa)', 4, 'Hỏa', '火,灯,热', '2026-06-09 07:58:56'),
(39, '木', 'mu4', 'Mộc (Cây)', 4, 'Mộc', '树,本,林', '2026-06-09 07:58:56'),
(40, '钅', 'jin1', 'Kim (Kim loại)', 5, 'Kim', '钱,铁,铜', '2026-06-09 07:58:56'),
(41, '艹', 'cao3', 'Hoa (Cỏ)', 3, 'Hoa', '花,菜,苹', '2026-06-09 07:58:56'),
(42, '讠', 'yan2', 'Ngôn (Lời)', 2, 'Ngôn', '说,话,请', '2026-06-09 07:58:56'),
(43, '日', 'ri4', 'Nhật (Mặt trời)', 4, 'Nhật', '明,早,天', '2026-06-09 07:58:56'),
(44, '月', 'yue4', 'Nguyệt (Trăng)', 4, 'Nguyệt', '明,朋,有', '2026-06-09 07:58:56'),
(45, '扌', 'shou3', 'Thủ (Tay)', 3, 'Thủ', '打,把,提', '2026-06-09 07:58:56'),
(46, '心', 'xin1', 'Tâm (Tim)', 4, 'Tâm', '想,心', '2026-06-09 07:58:56'),
(47, '土', 'tu3', 'Thổ (Đất)', 3, 'Thổ', '地,块,场', '2026-06-09 07:58:56'),
(48, '山', 'shan1', 'Sơn (Núi)', 3, 'Sơn', '山,岛,岭', '2026-06-09 07:58:56'),
(49, '石', 'shi2', 'Thạch (Đá)', 5, 'Thạch', '石,矿,磁', '2026-06-09 07:58:56'),
(50, '田', 'tian2', 'Điền (Ruộng)', 5, 'Điền', '田,男,备', '2026-06-09 07:58:56'),
(51, '目', 'mu4', 'Mục (Mắt)', 5, 'Mục', '眼,看,睛', '2026-06-09 07:58:56'),
(52, '耳', 'er3', 'Nhĩ (Tai)', 6, 'Nhĩ', '听,声,闻', '2026-06-09 07:58:56'),
(53, '米', 'mi3', 'Mễ (Gạo)', 6, 'Mễ', '米,粮,粉', '2026-06-09 07:58:56'),
(54, '虫', 'chong2', 'Trùng (Sâu)', 6, 'Trùng', '虫,蚂,蚁', '2026-06-09 07:58:56'),
(55, '雨', 'yu3', 'Vũ (Mưa)', 8, 'Vũ', '雨,雪,雷', '2026-06-09 07:58:56'),
(56, '风', 'feng1', 'Phong (Gió)', 4, 'Phong', '风,飘,疯', '2026-06-09 07:58:56'),
(57, '马', 'ma3', 'Mã (Ngựa)', 3, 'Mã', '马,骑,驴', '2026-06-09 07:58:56'),
(58, '鸟', 'niao3', 'Điểu (Chim)', 5, 'Điểu', '鸟,鸡,鸭', '2026-06-09 07:58:56'),
(59, '鱼', 'yu2', 'Ngư (Cá)', 8, 'Ngư', '鱼,鲜,鲁', '2026-06-09 07:58:56'),
(60, '车', 'che1', 'Xa (Xe)', 4, 'Xa', '车,转,轻', '2026-06-09 07:58:56'),
(61, '门', 'men2', 'Môn (Cửa)', 3, 'Môn', '门,问,间', '2026-06-09 07:58:56'),
(62, '马', 'ma3', 'Mã (Ngựa)', 3, 'Mã', '马,骑', '2026-06-09 07:58:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `remember_token` varchar(64) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `display_name`, `role`, `remember_token`, `avatar`, `created_at`) VALUES
(2, 'test', 'test@test.com', '$2y$10$2Ub0tRm4Z.duF8E25YGx9O39jYhv4O5wMDZMVpy9quZnxc5AW3vuK', 'Test User', 'user', NULL, NULL, '2026-06-09 09:44:41'),
(3, 'admin', '', '$2y$10$fxCTXAIgUHlyeFy570iR8uA16izO5zD/l/E645O1dphSgmhW6.2qi', 'Administrator', 'admin', NULL, NULL, '2026-06-09 10:06:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vocab`
--

CREATE TABLE `vocab` (
  `id` int(11) NOT NULL,
  `hanzi` varchar(50) NOT NULL,
  `pinyin` varchar(100) NOT NULL,
  `meaning` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `lesson_id` int(11) DEFAULT NULL,
  `strokes` int(11) DEFAULT 0,
  `radical` varchar(100) DEFAULT NULL,
  `example` text DEFAULT NULL,
  `example_vi` text DEFAULT NULL,
  `char_data` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vocab`
--

INSERT INTO `vocab` (`id`, `hanzi`, `pinyin`, `meaning`, `level`, `lesson_id`, `strokes`, `radical`, `example`, `example_vi`, `char_data`, `created_at`) VALUES
(1, '你', 'nǐ', 'Bạn / Anh / Chị', 1, NULL, 7, '亻 (nhân)', '你好！(nǐ hǎo) - Xin chào!', 'Xin chào!', '[{\"char\":\"你\",\"strokes\":7,\"radical\":\"亻 (nhân)\",\"pinyin\":\"nǐ\",\"meaning\":\"Bạn \\/ Anh \\/ Chị\"}]', '2026-05-10 11:43:46'),
(2, '好', 'hǎo', 'Tốt / Được / Xin chào', 1, NULL, 6, '女 (nữ)', '很好 (hěn hǎo) - Rất tốt!', 'Rất tốt!', '[{\"char\":\"好\",\"strokes\":6,\"radical\":\"女 (nữ)\",\"pinyin\":\"hǎo\",\"meaning\":\"Tốt \\/ Được \\/ Xin chào\"}]', '2026-05-10 11:43:46'),
(3, '我', 'wǒ', 'Tôi / Tớ', 1, NULL, 7, '戈 (qua)', '我是学生 (wǒ shì xuéshēng) - Tôi là học sinh', 'Tôi là học sinh.', '[{\"char\":\"我\",\"strokes\":7,\"radical\":\"戈 (qua)\",\"pinyin\":\"wǒ\",\"meaning\":\"Tôi \\/ Tớ\"}]', '2026-05-10 11:43:46'),
(4, '是', 'shì', 'Là / Đúng', 1, NULL, 9, '日 (nhật)', '他是老师 (tā shì lǎoshī) - Anh ấy là giáo viên', 'Anh ấy là giáo viên.', '[{\"char\":\"是\",\"strokes\":9,\"radical\":\"日 (nhật)\",\"pinyin\":\"shì\",\"meaning\":\"Là \\/ Đúng\"}]', '2026-05-10 11:43:46'),
(5, '学', 'xué', 'Học', 1, NULL, 8, '子 (tử)', '学中文 (xué zhōngwén) - Học tiếng Trung', 'Học tiếng Trung.', '[{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\",\"pinyin\":\"xué\",\"meaning\":\"Học\"}]', '2026-05-10 11:43:46'),
(6, '他', 'tā', 'Anh ấy / Ông ấy', 1, NULL, 5, '亻 (nhân)', '他是谁？(tā shì shéi?) - Anh ấy là ai?', 'Anh ấy là ai?', '[{\"char\":\"他\",\"strokes\":5,\"radical\":\"亻 (nhân)\",\"pinyin\":\"tā\",\"meaning\":\"Anh ấy \\/ Ông ấy\"}]', '2026-05-10 11:43:46'),
(7, '她', 'tā', 'Cô ấy / Bà ấy', 1, NULL, 5, '女 (nữ)', '她是我老师 (tā shì wǒ lǎoshī) - Cô ấy là giáo viên tôi', 'Cô ấy là giáo viên của tôi.', '[{\"char\":\"她\",\"strokes\":5,\"radical\":\"女 (nữ)\",\"pinyin\":\"tā\",\"meaning\":\"Cô ấy \\/ Bà ấy\"}]', '2026-05-10 11:43:46'),
(8, '它', 'tā', 'Nó (đồ vật)', 1, NULL, 5, '宀 (miên)', '它是什么？(tā shì shénme?) - Nó là gì?', 'Nó là cái gì?', '[{\"char\":\"它\",\"strokes\":5,\"radical\":\"宀 (miên)\",\"pinyin\":\"tā\",\"meaning\":\"Nó (đồ vật)\"}]', '2026-05-10 11:43:46'),
(9, '人', 'rén', 'Người', 1, NULL, 2, '人 (nhân)', '中国人 (zhōngguórén) - Người Trung Quốc', 'Người Trung Quốc.', '[{\"char\":\"人\",\"strokes\":2,\"radical\":\"人 (nhân)\",\"pinyin\":\"rén\",\"meaning\":\"Người\"}]', '2026-05-10 11:43:46'),
(10, '名', 'míng', 'Tên / Danh tiếng', 1, NULL, 6, '口 (khẩu)', '你叫什么名字？(nǐ jiào shénme míngzi?) - Bạn tên gì?', 'Bạn tên là gì?', '[{\"char\":\"名\",\"strokes\":6,\"radical\":\"口 (khẩu)\",\"pinyin\":\"míng\",\"meaning\":\"Tên \\/ Danh tiếng\"}]', '2026-05-10 11:43:46'),
(11, '什', 'shén', 'Gì / Cái gì', 1, NULL, 4, '亻 (nhân)', '什么 (shénme) - Cái gì', 'Cái gì?', '[{\"char\":\"什\",\"strokes\":4,\"radical\":\"亻 (nhân)\",\"pinyin\":\"shén\",\"meaning\":\"Gì \\/ Cái gì\"}]', '2026-05-10 11:43:46'),
(12, '吗', 'ma', 'Không (câu hỏi)', 1, NULL, 3, '口 (khẩu)', '你好吗？(nǐ hǎo ma?) - Bạn khỏe không?', 'Bạn có khỏe không?', '[{\"char\":\"吗\",\"strokes\":3,\"radical\":\"口 (khẩu)\",\"pinyin\":\"ma\",\"meaning\":\"Không (câu hỏi)\"}]', '2026-05-10 11:43:46'),
(13, '谢谢', 'xièxie', 'Cảm ơn', 1, NULL, 6, '讠 (ngôn)', '谢谢您 (xièxie nín) - Cảm ơn bạn', 'Cảm ơn bạn.', '[{\"char\":\"谢\",\"strokes\":12,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"xiè\",\"meaning\":\"cảm ơn\"},{\"char\":\"谢\",\"strokes\":12,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"xiè\",\"meaning\":\"cảm ơn\"}]', '2026-05-10 11:43:46'),
(14, '再见', 'zàijiàn', 'Tạm biệt', 1, NULL, 6, '冂 (đông)', '再见！(zàijiàn) - Tạm biệt!', 'Tạm biệt!', '[{\"char\":\"再\",\"strokes\":6,\"radical\":\"一 (nhất)\",\"pinyin\":\"zài\",\"meaning\":\"lại\"},{\"char\":\"见\",\"strokes\":7,\"radical\":\"见 (kiến)\",\"pinyin\":\"jiàn\",\"meaning\":\"thấy\"}]', '2026-05-10 11:43:46'),
(15, '对不起', 'duìbuqǐ', 'Xin lỗi', 1, NULL, 5, '小 (tiểu)', '对不起 (duìbuqǐ) - Xin lỗi', 'Xin lỗi.', '[{\"char\":\"对\",\"strokes\":5,\"radical\":\"寸 (thốn)\",\"pinyin\":\"duì\",\"meaning\":\"đúng\"},{\"char\":\"不\",\"strokes\":4,\"radical\":\"一 (nhất)\",\"pinyin\":\"bù\",\"meaning\":\"không\"},{\"char\":\"起\",\"strokes\":10,\"radical\":\"走 (tẩu)\",\"pinyin\":\"qǐ\",\"meaning\":\"đứng dậy\"}]', '2026-05-10 11:43:46'),
(16, '没关系', 'méiguānxi', 'Không sao', 1, NULL, 10, '小 (tiểu)', '没关系 (méiguānxi) - Không sao đâu', 'Không sao đâu.', '[{\"char\":\"没\",\"strokes\":7,\"radical\":\"氵 (thủy)\",\"pinyin\":\"méi\",\"meaning\":\"không có\"},{\"char\":\"关\",\"strokes\":6,\"radical\":\"八 (bát)\",\"pinyin\":\"guān\",\"meaning\":\"đóng\\/quan\"},{\"char\":\"系\",\"strokes\":7,\"radical\":\"糸 (mịch)\",\"pinyin\":\"xì\",\"meaning\":\"hệ\"}]', '2026-05-10 11:43:46'),
(17, '请', 'qǐng', 'Mời / Xin', 1, NULL, 10, '讠 (ngôn)', '请坐 (qǐng zuò) - Mời ngồi', 'Mời ngồi.', '[{\"char\":\"请\",\"strokes\":10,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"qǐng\",\"meaning\":\"Mời \\/ Xin\"}]', '2026-05-10 11:43:46'),
(18, '坐', 'zuò', 'Ngồi', 1, NULL, 7, '土 (thổ)', '请坐 (qǐng zuò) - Mời ngồi', 'Mời ngồi.', '[{\"char\":\"坐\",\"strokes\":7,\"radical\":\"土 (thổ)\",\"pinyin\":\"zuò\",\"meaning\":\"Ngồi\"}]', '2026-05-10 11:43:46'),
(19, '吃', 'chī', 'Ăn', 1, NULL, 6, '口 (khẩu)', '吃饭 (chī fàn) - Ăn cơm', 'Ăn cơm.', '[{\"char\":\"吃\",\"strokes\":6,\"radical\":\"口 (khẩu)\",\"pinyin\":\"chī\",\"meaning\":\"Ăn\"}]', '2026-05-10 11:43:46'),
(20, '喝', 'hē', 'Uống', 1, NULL, 12, '口 (khẩu)', '喝茶 (hē chá) - Uống trà', 'Uống trà.', '[{\"char\":\"喝\",\"strokes\":12,\"radical\":\"口 (khẩu)\",\"pinyin\":\"hē\",\"meaning\":\"Uống\"}]', '2026-05-10 11:43:46'),
(21, '爱', 'ài', 'Yêu / Thích', 2, NULL, 10, '爪 (trảo)', '我爱你 (wǒ ài nǐ) - Tôi yêu bạn', 'Tôi yêu bạn.', '[{\"char\":\"爱\",\"strokes\":10,\"radical\":\"爪 (trảo)\",\"pinyin\":\"ài\",\"meaning\":\"Yêu \\/ Thích\"}]', '2026-05-10 11:43:46'),
(22, '想', 'xiǎng', 'Nghĩ / Muốn', 2, NULL, 13, '心 (tâm)', '我想你 (wǒ xiǎng nǐ) - Tôi nhớ bạn', 'Tôi nhớ bạn.', '[{\"char\":\"想\",\"strokes\":13,\"radical\":\"心 (tâm)\",\"pinyin\":\"xiǎng\",\"meaning\":\"Nghĩ \\/ Muốn\"}]', '2026-05-10 11:43:46'),
(23, '看', 'kàn', 'Nhìn / Xem', 2, NULL, 9, '目 (mục)', '看书 (kàn shū) - Đọc sách', 'Đọc sách.', '[{\"char\":\"看\",\"strokes\":9,\"radical\":\"目 (mục)\",\"pinyin\":\"kàn\",\"meaning\":\"Nhìn \\/ Xem\"}]', '2026-05-10 11:43:46'),
(24, '听', 'tīng', 'Nghe', 2, NULL, 7, '耳 (nhĩ)', '听音乐 (tīng yīnyuè) - Nghe nhạc', 'Nghe nhạc.', '[{\"char\":\"听\",\"strokes\":7,\"radical\":\"耳 (nhĩ)\",\"pinyin\":\"tīng\",\"meaning\":\"Nghe\"}]', '2026-05-10 11:43:46'),
(25, '说', 'shuō', 'Nói', 2, NULL, 9, '言 (ngôn)', '说话 (shuō huà) - Nói chuyện', 'Nói chuyện.', '[{\"char\":\"说\",\"strokes\":9,\"radical\":\"言 (ngôn)\",\"pinyin\":\"shuō\",\"meaning\":\"Nói\"}]', '2026-05-10 11:43:46'),
(26, '写', 'xiě', 'Viết', 2, NULL, 5, '冖 (bị)', '写字 (xiě zì) - Viết chữ', 'Viết chữ.', '[{\"char\":\"写\",\"strokes\":5,\"radical\":\"冖 (bị)\",\"pinyin\":\"xiě\",\"meaning\":\"Viết\"}]', '2026-05-10 11:43:46'),
(27, '读', 'dú', 'Đọc', 2, NULL, 10, '讠 (ngôn)', '读书 (dú shū) - Đọc sách', 'Đọc sách.', '[{\"char\":\"读\",\"strokes\":10,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"dú\",\"meaning\":\"Đọc\"}]', '2026-05-10 11:43:46'),
(28, '来', 'lái', 'Đến', 2, NULL, 7, '木 (mộc)', '你来吗？(nǐ lái ma?) - Bạn đến không?', 'Bạn có đến không?', '[{\"char\":\"来\",\"strokes\":7,\"radical\":\"木 (mộc)\",\"pinyin\":\"lái\",\"meaning\":\"Đến\"}]', '2026-05-10 11:43:46'),
(29, '去', 'qù', 'Đi (đến)', 2, NULL, 5, '厶 (khư)', '去医院 (qù yīyuàn) - Đi bệnh viện', 'Đi bệnh viện.', '[{\"char\":\"去\",\"strokes\":5,\"radical\":\"厶 (khư)\",\"pinyin\":\"qù\",\"meaning\":\"Đi (đến)\"}]', '2026-05-10 11:43:46'),
(30, '买', 'mǎi', 'Mua', 2, NULL, 6, '冂 (đông)', '买东西 (mǎi dōngxi) - Mua đồ', 'Mua đồ.', '[{\"char\":\"买\",\"strokes\":6,\"radical\":\"冂 (đông)\",\"pinyin\":\"mǎi\",\"meaning\":\"Mua\"}]', '2026-05-10 11:43:46'),
(31, '卖', 'mài', 'Bán', 2, NULL, 8, '口 (khẩu)', '卖东西 (mài dōngxi) - Bán đồ', 'Bán đồ.', '[{\"char\":\"卖\",\"strokes\":8,\"radical\":\"口 (khẩu)\",\"pinyin\":\"mài\",\"meaning\":\"Bán\"}]', '2026-05-10 11:43:46'),
(32, '给', 'gěi', 'Cho / Đưa', 2, NULL, 9, '纟 (tơ)', '给你 (gěi nǐ) - Cho bạn', 'Cho bạn.', '[{\"char\":\"给\",\"strokes\":9,\"radical\":\"纟 (tơ)\",\"pinyin\":\"gěi\",\"meaning\":\"Cho \\/ Đưa\"}]', '2026-05-10 11:43:46'),
(33, '做', 'zuò', 'Làm / Làm việc', 2, NULL, 11, '亻 (nhân)', '做事 (zuò shì) - Làm việc', 'Làm việc.', '[{\"char\":\"做\",\"strokes\":11,\"radical\":\"亻 (nhân)\",\"pinyin\":\"zuò\",\"meaning\":\"Làm \\/ Làm việc\"}]', '2026-05-10 11:43:46'),
(34, '工', 'gōng', 'Công / Làm việc', 2, NULL, 3, '工 (công)', '工作 (gōngzuò) - Làm việc', 'Làm việc.', '[{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\",\"pinyin\":\"gōng\",\"meaning\":\"Công \\/ Làm việc\"}]', '2026-05-10 11:43:46'),
(35, '饭', 'fàn', 'Cơm / Bữa ăn', 2, NULL, 12, '饣 (thực)', '吃饭 (chī fàn) - Ăn cơm', 'Ăn cơm.', '[{\"char\":\"饭\",\"strokes\":12,\"radical\":\"饣 (thực)\",\"pinyin\":\"fàn\",\"meaning\":\"Cơm \\/ Bữa ăn\"}]', '2026-05-10 11:43:46'),
(36, '学习', 'xuéxí', 'Học tập', 3, NULL, 8, '子 (tử)', '学习中文 (xuéxí zhōngwén) - Học tiếng Trung', 'Học tiếng Trung.', '[{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\",\"pinyin\":\"xué\",\"meaning\":\"Học\"},{\"char\":\"习\",\"strokes\":3,\"radical\":\"乙 (ất)\",\"pinyin\":\"xí\",\"meaning\":\"tập\"}]', '2026-05-10 11:43:46'),
(37, '工作', 'gōngzuò', 'Làm việc', 3, NULL, 7, '工 (công)', '我在工作 (wǒ zài gōngzuò) - Tôi đang làm việc', 'Tôi đang làm việc.', '[{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\",\"pinyin\":\"gōng\",\"meaning\":\"Công \\/ Làm việc\"},{\"char\":\"作\",\"strokes\":7,\"radical\":\"亻 (nhân)\",\"pinyin\":\"zuò\",\"meaning\":\"làm\"}]', '2026-05-10 11:43:46'),
(38, '朋友', 'péngyou', 'Bạn bè', 3, NULL, 4, '月 (nhật)', '他是我的朋友 (tā shì wǒ de péngyou) - Anh ấy là bạn tôi', 'Anh ấy là bạn của tôi.', '[{\"char\":\"朋\",\"strokes\":8,\"radical\":\"月 (nguyệt)\",\"pinyin\":\"péng\",\"meaning\":\"bạn\"},{\"char\":\"友\",\"strokes\":4,\"radical\":\"又 (hựu)\",\"pinyin\":\"yǒu\",\"meaning\":\"bạn\"}]', '2026-05-10 11:43:46'),
(39, '时间', 'shíjiān', 'Thời gian', 3, NULL, 7, '日 (nhật)', '现在几点？(xiànzài jǐ diǎn?) - Bây giờ mấy giờ?', 'Bây giờ là mấy giờ?', '[{\"char\":\"时\",\"strokes\":7,\"radical\":\"日 (nhật)\",\"pinyin\":\"shí\",\"meaning\":\"thời gian\"},{\"char\":\"间\",\"strokes\":7,\"radical\":\"门 (môn)\",\"pinyin\":\"jiān\",\"meaning\":\"khoảng\"}]', '2026-05-10 11:43:46'),
(40, '问题', 'wèntí', 'Câu hỏi / Vấn đề', 3, NULL, 7, '口 (khẩu)', '你有什么问题？(nǐ yǒu shénme wèntí?) - Bạn có câu hỏi gì?', 'Bạn có câu hỏi gì?', '[{\"char\":\"问\",\"strokes\":6,\"radical\":\"门 (môn)\",\"pinyin\":\"wèn\",\"meaning\":\"hỏi\"},{\"char\":\"题\",\"strokes\":15,\"radical\":\"页 (hiệt)\",\"pinyin\":\"tí\",\"meaning\":\"đề\"}]', '2026-05-10 11:43:46'),
(41, '知道', 'zhīdào', 'Biết (thông tin)', 3, NULL, 8, '矢 (thỉ)', '我知道 (wǒ zhīdào) - Tôi biết', 'Tôi biết.', '[{\"char\":\"知\",\"strokes\":8,\"radical\":\"矢 (thỉ)\",\"pinyin\":\"zhī\",\"meaning\":\"biết\"},{\"char\":\"道\",\"strokes\":12,\"radical\":\"辶 (sước)\",\"pinyin\":\"dào\",\"meaning\":\"đường\\/nói\"}]', '2026-05-10 11:43:46'),
(42, '觉得', 'juéde', 'Cảm thấy', 3, NULL, 7, '见 (kiến)', '我觉得 (wǒ juéde) - Tôi cảm thấy', 'Tôi cảm thấy.', '[{\"char\":\"觉\",\"strokes\":9,\"radical\":\"见 (kiến)\",\"pinyin\":\"jué\",\"meaning\":\"cảm thấy\"},{\"char\":\"得\",\"strokes\":11,\"radical\":\"彳 (sách)\",\"pinyin\":\"dé\",\"meaning\":\"được\"}]', '2026-05-10 11:43:46'),
(43, '因为', 'yīnwèi', 'Bởi vì', 3, NULL, 6, '口 (khẩu)', '因为我爱你 (yīnwèi wǒ ài nǐ) - Bởi vì tôi yêu bạn', 'Bởi vì tôi yêu bạn.', '[{\"char\":\"因\",\"strokes\":6,\"radical\":\"囗 (vi)\",\"pinyin\":\"yīn\",\"meaning\":\"bởi vì\"},{\"char\":\"为\",\"strokes\":4,\"radical\":\"丶 (chủ)\",\"pinyin\":\"wèi\",\"meaning\":\"vì\"}]', '2026-05-10 11:43:46'),
(44, '所以', 'suǒyǐ', 'Nên / Vì thế', 3, NULL, 9, '米 (mễ)', '所以... (suǒyǐ...) - Nên...', 'Cho nên...', '[{\"char\":\"所\",\"strokes\":8,\"radical\":\"户 (hộ)\",\"pinyin\":\"suǒ\",\"meaning\":\"nơi\"},{\"char\":\"以\",\"strokes\":4,\"radical\":\"人 (nhân)\",\"pinyin\":\"yǐ\",\"meaning\":\"để\"}]', '2026-05-10 11:43:46'),
(45, '但是', 'dànshì', 'Nhưng / Tuy nhiên', 3, NULL, 7, '月 (nhật)', '但是... (dànshì...) - Nhưng...', 'Nhưng mà...', '[{\"char\":\"但\",\"strokes\":7,\"radical\":\"亻 (nhân)\",\"pinyin\":\"dàn\",\"meaning\":\"nhưng\"},{\"char\":\"是\",\"strokes\":9,\"radical\":\"日 (nhật)\",\"pinyin\":\"shì\",\"meaning\":\"Là \\/ Đúng\"}]', '2026-05-10 11:43:46'),
(46, '如果', 'rúguǒ', 'Nếu / Giả sử', 3, NULL, 6, '女 (nữ)', '如果你来 (rúguǒ nǐ lái) - Nếu bạn đến', 'Nếu bạn đến.', '[{\"char\":\"如\",\"strokes\":6,\"radical\":\"女 (nữ)\",\"pinyin\":\"rú\",\"meaning\":\"nếu\"},{\"char\":\"果\",\"strokes\":8,\"radical\":\"木 (mộc)\",\"pinyin\":\"guǒ\",\"meaning\":\"quả\"}]', '2026-05-10 11:43:46'),
(47, '时候', 'shíhou', 'Thời điểm / Lúc', 3, NULL, 7, '日 (nhật)', '什么时候？(shénme shíhou?) - Lúc nào?', 'Lúc nào?', '[{\"char\":\"时\",\"strokes\":7,\"radical\":\"日 (nhật)\",\"pinyin\":\"shí\",\"meaning\":\"thời gian\"},{\"char\":\"候\",\"strokes\":10,\"radical\":\"亻 (nhân)\",\"pinyin\":\"hòu\",\"meaning\":\"lúc\"}]', '2026-05-10 11:43:46'),
(48, '地方', 'dìfang', 'Nơi chốn / Địa điểm', 3, NULL, 6, '土 (thổ)', '这个地方 (zhège dìfang) - Nơi này', 'Nơi này.', '[{\"char\":\"地\",\"strokes\":6,\"radical\":\"土 (thổ)\",\"pinyin\":\"dì\",\"meaning\":\"đất\"},{\"char\":\"方\",\"strokes\":4,\"radical\":\"方 (phương)\",\"pinyin\":\"fāng\",\"meaning\":\"phương\"}]', '2026-05-10 11:43:46'),
(49, '事情', 'shìqing', 'Việc / Sự việc', 3, NULL, 8, '心 (tâm)', '什么事情？(shénme shìqing?) - Việc gì?', 'Việc gì thế?', '[{\"char\":\"事\",\"strokes\":8,\"radical\":\"亅 (quyết)\",\"pinyin\":\"shì\",\"meaning\":\"sự việc\"},{\"char\":\"情\",\"strokes\":11,\"radical\":\"忄 (tâm)\",\"pinyin\":\"qíng\",\"meaning\":\"tình cảm\"}]', '2026-05-10 11:43:46'),
(50, '告诉', 'gàosu', 'Nói cho / Báo', 3, NULL, 7, '口 (khẩu)', '告诉你 (gàosu nǐ) - Nói cho bạn', 'Nói cho bạn.', '[{\"char\":\"告\",\"strokes\":7,\"radical\":\"口 (khẩu)\",\"pinyin\":\"gào\",\"meaning\":\"nói\\/bảo\"},{\"char\":\"诉\",\"strokes\":7,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"sù\",\"meaning\":\"kể\\/tố\"}]', '2026-05-10 11:43:46'),
(51, '面包', 'miànbāo', 'bánh mì', 1, 6, 9, '面 (diện)', '吃面包。', 'Ăn bánh mì.', '[{\"char\":\"面\",\"strokes\":9,\"radical\":\"面 (diện)\",\"pinyin\":\"miàn\",\"meaning\":\"mặt\\/mì\"},{\"char\":\"包\",\"strokes\":5,\"radical\":\"勹 (bao)\",\"pinyin\":\"bāo\",\"meaning\":\"gói\\/bao\"}]', '2026-06-09 10:15:29'),
(52, '鸡蛋', 'jīdàn', 'trứng gà', 1, 6, 7, '鸟 (điểu)', '一个鸡蛋。', 'Một quả trứng gà.', '[{\"char\":\"鸡\",\"strokes\":7,\"radical\":\"鸟 (điểu)\",\"pinyin\":\"jī\",\"meaning\":\"gà\"},{\"char\":\"蛋\",\"strokes\":11,\"radical\":\"虫 (trùng)\",\"pinyin\":\"dàn\",\"meaning\":\"trứng\"}]', '2026-06-09 10:15:29'),
(53, '牛肉', 'niúròu', 'thịt bò', 1, 6, 4, '牛 (ngưu)', '牛肉面。', 'Mì bò.', '[{\"char\":\"牛\",\"strokes\":4,\"radical\":\"牛 (ngưu)\",\"pinyin\":\"niú\",\"meaning\":\"bò\"},{\"char\":\"肉\",\"strokes\":6,\"radical\":\"肉 (nhục)\",\"pinyin\":\"ròu\",\"meaning\":\"thịt\"}]', '2026-06-09 10:15:29'),
(54, '鸡肉', 'jīròu', 'thịt gà', 1, 6, 7, '鸟 (điểu)', '鸡肉饭。', 'Cơm gà.', '[{\"char\":\"鸡\",\"strokes\":7,\"radical\":\"鸟 (điểu)\",\"pinyin\":\"jī\",\"meaning\":\"gà\"},{\"char\":\"肉\",\"strokes\":6,\"radical\":\"肉 (nhục)\",\"pinyin\":\"ròu\",\"meaning\":\"thịt\"}]', '2026-06-09 10:15:29'),
(55, '鱼', 'yú', 'cá', 1, 6, 8, '鱼', '吃鱼。', 'Ăn cá.', '[{\"char\":\"鱼\",\"strokes\":8,\"radical\":\"鱼\",\"pinyin\":\"yú\",\"meaning\":\"cá\"}]', '2026-06-09 10:15:29'),
(56, '水果', 'shuǐguǒ', 'hoa quả', 1, 6, 4, '水 (thủy)', '吃水果。', 'Ăn hoa quả.', '[{\"char\":\"水\",\"strokes\":4,\"radical\":\"水 (thủy)\",\"pinyin\":\"shuǐ\",\"meaning\":\"nước\"},{\"char\":\"果\",\"strokes\":8,\"radical\":\"木 (mộc)\",\"pinyin\":\"guǒ\",\"meaning\":\"quả\"}]', '2026-06-09 10:15:29'),
(57, '面条', 'miàntiáo', 'mì sợi', 1, 6, 9, '面 (diện)', '吃面条。', 'Ăn mì.', '[{\"char\":\"面\",\"strokes\":9,\"radical\":\"面 (diện)\",\"pinyin\":\"miàn\",\"meaning\":\"mặt\\/mì\"},{\"char\":\"条\",\"strokes\":7,\"radical\":\"木 (mộc)\",\"pinyin\":\"tiáo\",\"meaning\":\"cây\\/sợi\"}]', '2026-06-09 10:15:29'),
(58, '蛋糕', 'dàngāo', 'bánh gatô', 1, 6, 11, '虫 (trùng)', '生日蛋糕。', 'Bánh sinh nhật.', '[{\"char\":\"蛋\",\"strokes\":11,\"radical\":\"虫 (trùng)\",\"pinyin\":\"dàn\",\"meaning\":\"trứng\"},{\"char\":\"糕\",\"strokes\":16,\"radical\":\"米 (mễ)\",\"pinyin\":\"gāo\",\"meaning\":\"bánh\"}]', '2026-06-09 10:15:29'),
(59, '果汁', 'guǒzhī', 'nước hoa quả', 1, 6, 8, '木 (mộc)', '喝果汁。', 'Uống nước ép trái cây.', '[{\"char\":\"果\",\"strokes\":8,\"radical\":\"木 (mộc)\",\"pinyin\":\"guǒ\",\"meaning\":\"quả\"},{\"char\":\"汁\",\"strokes\":5,\"radical\":\"氵 (thủy)\",\"pinyin\":\"zhī\",\"meaning\":\"nước ép\"}]', '2026-06-09 10:15:29'),
(60, '糖', 'táng', 'kẹo, đường', 1, 6, 16, '米', '吃糖。', 'Ăn kẹo.', '[{\"char\":\"糖\",\"strokes\":16,\"radical\":\"米\",\"pinyin\":\"táng\",\"meaning\":\"kẹo, đường\"}]', '2026-06-09 10:15:29'),
(61, '天气', 'tiānqì', 'thời tiết', 1, 7, 4, '大 (đại)', '天气好。', 'Thời tiết đẹp.', '[{\"char\":\"天\",\"strokes\":4,\"radical\":\"大 (đại)\",\"pinyin\":\"tiān\",\"meaning\":\"trời\"},{\"char\":\"气\",\"strokes\":4,\"radical\":\"气 (khí)\",\"pinyin\":\"qì\",\"meaning\":\"khí\"}]', '2026-06-09 10:15:29'),
(62, '冷', 'lěng', 'lạnh', 1, 7, 7, '冫', '很冷。', 'Rất lạnh.', '[{\"char\":\"冷\",\"strokes\":7,\"radical\":\"冫\",\"pinyin\":\"lěng\",\"meaning\":\"lạnh\"}]', '2026-06-09 10:15:29'),
(63, '热', 'rè', 'nóng', 1, 7, 10, '灬', '很热。', 'Rất nóng.', '[{\"char\":\"热\",\"strokes\":10,\"radical\":\"灬\",\"pinyin\":\"rè\",\"meaning\":\"nóng\"}]', '2026-06-09 10:15:29'),
(64, '下雨', 'xiàyǔ', 'mưa', 1, 7, 3, '一 (nhất)', '下雨了。', 'Trời đang mưa.', '[{\"char\":\"下\",\"strokes\":3,\"radical\":\"一\",\"pinyin\":\"xià\",\"meaning\":\"dưới\"},{\"char\":\"雨\",\"strokes\":8,\"radical\":\"雨 (vũ)\",\"pinyin\":\"yǔ\",\"meaning\":\"mưa\"}]', '2026-06-09 10:15:29'),
(65, '刮风', 'guāfēng', 'gió', 1, 7, 8, '刂 (đao)', '刮大风。', 'Gió to.', '[{\"char\":\"刮\",\"strokes\":8,\"radical\":\"刂 (đao)\",\"pinyin\":\"guā\",\"meaning\":\"thổi\\/gạt\"},{\"char\":\"风\",\"strokes\":4,\"radical\":\"风 (phong)\",\"pinyin\":\"fēng\",\"meaning\":\"gió\"}]', '2026-06-09 10:15:29'),
(66, '晴天', 'qíngtiān', 'trời nắng', 1, 7, 12, '日 (nhật)', '今天晴天。', 'Hôm nay trời nắng.', '[{\"char\":\"晴\",\"strokes\":12,\"radical\":\"日 (nhật)\",\"pinyin\":\"qíng\",\"meaning\":\"nắng\"},{\"char\":\"天\",\"strokes\":4,\"radical\":\"大 (đại)\",\"pinyin\":\"tiān\",\"meaning\":\"trời\"}]', '2026-06-09 10:15:29'),
(67, '阴天', 'yīntiān', 'trời âm u', 1, 7, 7, '阝 (phụ)', '明天阴天。', 'Ngày mai trời âm u.', '[{\"char\":\"阴\",\"strokes\":7,\"radical\":\"阝 (phụ)\",\"pinyin\":\"yīn\",\"meaning\":\"âm u\"},{\"char\":\"天\",\"strokes\":4,\"radical\":\"大 (đại)\",\"pinyin\":\"tiān\",\"meaning\":\"trời\"}]', '2026-06-09 10:15:29'),
(68, '暖和', 'nuǎnhuo', 'ấm áp', 1, 7, 13, '日 (nhật)', '天气暖和。', 'Thời tiết ấm áp.', '[{\"char\":\"暖\",\"strokes\":13,\"radical\":\"日 (nhật)\",\"pinyin\":\"nuǎn\",\"meaning\":\"ấm\"},{\"char\":\"和\",\"strokes\":8,\"radical\":\"口 (khẩu)\",\"pinyin\":\"hé\",\"meaning\":\"và\\/hòa\"}]', '2026-06-09 10:15:29'),
(69, '前', 'qián', 'trước', 1, 8, 9, '丷', '前面。', 'Phía trước.', '[{\"char\":\"前\",\"strokes\":9,\"radical\":\"丷\",\"pinyin\":\"qián\",\"meaning\":\"trước\"}]', '2026-06-09 10:15:29'),
(70, '后', 'hòu', 'sau', 1, 8, 6, '厂', '后面。', 'Phía sau.', '[{\"char\":\"后\",\"strokes\":6,\"radical\":\"厂\",\"pinyin\":\"hòu\",\"meaning\":\"sau\"}]', '2026-06-09 10:15:29'),
(71, '左', 'zuǒ', 'trái', 1, 8, 5, '工', '左边。', 'Bên trái.', '[{\"char\":\"左\",\"strokes\":5,\"radical\":\"工\",\"pinyin\":\"zuǒ\",\"meaning\":\"trái\"}]', '2026-06-09 10:15:29'),
(72, '右', 'yòu', 'phải', 1, 8, 5, '口', '右边。', 'Bên phải.', '[{\"char\":\"右\",\"strokes\":5,\"radical\":\"口\",\"pinyin\":\"yòu\",\"meaning\":\"phải\"}]', '2026-06-09 10:15:29'),
(73, '上', 'shàng', 'trên', 1, 8, 3, '一', '上面。', 'Phía trên.', '[{\"char\":\"上\",\"strokes\":3,\"radical\":\"一\",\"pinyin\":\"shàng\",\"meaning\":\"trên\"}]', '2026-06-09 10:15:29'),
(74, '下', 'xià', 'dưới', 1, 8, 3, '一', '下面。', 'Phía dưới.', '[{\"char\":\"下\",\"strokes\":3,\"radical\":\"一\",\"pinyin\":\"xià\",\"meaning\":\"dưới\"}]', '2026-06-09 10:15:29'),
(75, '里', 'lǐ', 'trong', 1, 8, 7, '里', '里面。', 'Bên trong.', '[{\"char\":\"里\",\"strokes\":7,\"radical\":\"里\",\"pinyin\":\"lǐ\",\"meaning\":\"trong\"}]', '2026-06-09 10:15:29'),
(76, '外', 'wài', 'ngoài', 1, 8, 5, '夕', '外面。', 'Bên ngoài.', '[{\"char\":\"外\",\"strokes\":5,\"radical\":\"夕\",\"pinyin\":\"wài\",\"meaning\":\"ngoài\"}]', '2026-06-09 10:15:29'),
(77, '商店', 'shāngdiàn', 'cửa hàng', 2, 9, 11, '口 (khẩu)', '去商店。', 'Đi cửa hàng.', '[{\"char\":\"商\",\"strokes\":11,\"radical\":\"口 (khẩu)\",\"pinyin\":\"shāng\",\"meaning\":\"thương mại\"},{\"char\":\"店\",\"strokes\":8,\"radical\":\"广 (yểm)\",\"pinyin\":\"diàn\",\"meaning\":\"cửa hàng\"}]', '2026-06-09 10:15:29'),
(78, '超市', 'chāoshì', 'siêu thị', 2, 9, 12, '走 (tẩu)', '去超市。', 'Đi siêu thị.', '[{\"char\":\"超\",\"strokes\":12,\"radical\":\"走 (tẩu)\",\"pinyin\":\"chāo\",\"meaning\":\"siêu\"},{\"char\":\"市\",\"strokes\":5,\"radical\":\"巾 (cân)\",\"pinyin\":\"shì\",\"meaning\":\"chợ\\/thành phố\"}]', '2026-06-09 10:15:29'),
(79, '便宜', 'piányi', 'rẻ', 2, 9, 9, '亻 (nhân)', '很便宜。', 'Rất rẻ.', '[{\"char\":\"便\",\"strokes\":9,\"radical\":\"亻 (nhân)\",\"pinyin\":\"biàn\",\"meaning\":\"tiện\"},{\"char\":\"宜\",\"strokes\":8,\"radical\":\"宀 (miên)\",\"pinyin\":\"yí\",\"meaning\":\"hợp\\/nên\"}]', '2026-06-09 10:15:29'),
(80, '贵', 'guì', 'đắt', 2, 9, 9, '贝', '太贵了。', 'Đắt quá.', '[{\"char\":\"贵\",\"strokes\":9,\"radical\":\"贝\",\"pinyin\":\"guì\",\"meaning\":\"đắt\"}]', '2026-06-09 10:15:29'),
(81, '钱', 'qián', 'tiền', 2, 9, 10, '金', '多少钱？', 'Bao nhiêu tiền?', '[{\"char\":\"钱\",\"strokes\":10,\"radical\":\"金\",\"pinyin\":\"qián\",\"meaning\":\"tiền\"}]', '2026-06-09 10:15:29'),
(84, '还价', 'huánjià', 'trả giá', 2, 9, 7, '辶 (sước)', '可以还价吗？', 'Có thể trả giá không?', '[{\"char\":\"还\",\"strokes\":7,\"radical\":\"辶 (sước)\",\"pinyin\":\"hái\",\"meaning\":\"còn\"},{\"char\":\"价\",\"strokes\":6,\"radical\":\"亻 (nhân)\",\"pinyin\":\"jià\",\"meaning\":\"giá\"}]', '2026-06-09 10:15:29'),
(85, '打折', 'dǎzhé', 'giảm giá', 2, 9, 5, '扌 (thủ)', '打折吗？', 'Có giảm giá không?', '[{\"char\":\"打\",\"strokes\":5,\"radical\":\"扌 (thủ)\",\"pinyin\":\"dǎ\",\"meaning\":\"đánh\"},{\"char\":\"折\",\"strokes\":7,\"radical\":\"扌 (thủ)\",\"pinyin\":\"zhé\",\"meaning\":\"giảm\\/gấp\"}]', '2026-06-09 10:15:29'),
(86, '免费', 'miǎnfèi', 'miễn phí', 2, 9, 7, '儿 (nhân)', '免费入场。', 'Vào cửa miễn phí.', '[{\"char\":\"免\",\"strokes\":7,\"radical\":\"儿 (nhân)\",\"pinyin\":\"miǎn\",\"meaning\":\"miễn\"},{\"char\":\"费\",\"strokes\":9,\"radical\":\"贝 (bối)\",\"pinyin\":\"fèi\",\"meaning\":\"phí\"}]', '2026-06-09 10:15:29'),
(87, '飞机', 'fēijī', 'máy bay', 2, 10, 3, '飞 (phi)', '坐飞机。', 'Đi máy bay.', '[{\"char\":\"飞\",\"strokes\":3,\"radical\":\"飞 (phi)\",\"pinyin\":\"fēi\",\"meaning\":\"bay\"},{\"char\":\"机\",\"strokes\":6,\"radical\":\"木 (mộc)\",\"pinyin\":\"jī\",\"meaning\":\"máy\"}]', '2026-06-09 10:15:29'),
(88, '火车', 'huǒchē', 'tàu hỏa', 2, 10, 4, '火 (hỏa)', '坐火车。', 'Đi tàu hỏa.', '[{\"char\":\"火\",\"strokes\":4,\"radical\":\"火 (hỏa)\",\"pinyin\":\"huǒ\",\"meaning\":\"lửa\"},{\"char\":\"车\",\"strokes\":4,\"radical\":\"车 (xa)\",\"pinyin\":\"chē\",\"meaning\":\"xe\"}]', '2026-06-09 10:15:29'),
(89, '地铁', 'dìtiě', 'tàu điện ngầm', 2, 10, 6, '土 (thổ)', '坐地铁。', 'Đi tàu điện ngầm.', '[{\"char\":\"地\",\"strokes\":6,\"radical\":\"土 (thổ)\",\"pinyin\":\"dì\",\"meaning\":\"đất\"},{\"char\":\"铁\",\"strokes\":10,\"radical\":\"金 (kim)\",\"pinyin\":\"tiě\",\"meaning\":\"sắt\"}]', '2026-06-09 10:15:29'),
(90, '公共汽车', 'gōnggòng qìchē', 'xe buýt', 2, 10, 4, '八 (bát)', '坐公共汽车。', 'Đi xe buýt.', '[{\"char\":\"公\",\"strokes\":4,\"radical\":\"八 (bát)\",\"pinyin\":\"gōng\",\"meaning\":\"công\"},{\"char\":\"共\",\"strokes\":6,\"radical\":\"八 (bát)\",\"pinyin\":\"gòng\",\"meaning\":\"cùng\"},{\"char\":\"汽\",\"strokes\":7,\"radical\":\"氵 (thủy)\",\"pinyin\":\"qì\",\"meaning\":\"hơi\"},{\"char\":\"车\",\"strokes\":4,\"radical\":\"车 (xa)\",\"pinyin\":\"chē\",\"meaning\":\"xe\"}]', '2026-06-09 10:15:29'),
(91, '出租車', 'chūzūchē', 'taxi', 2, 10, 5, '凵 (khảm)', '打出租车。', 'Bắt taxi.', '[{\"char\":\"出\",\"strokes\":5,\"radical\":\"凵 (khảm)\",\"pinyin\":\"chū\",\"meaning\":\"ra\\/đi ra\"},{\"char\":\"租\",\"strokes\":10,\"radical\":\"禾 (hòa)\",\"pinyin\":\"zū\",\"meaning\":\"thuê\"},{\"char\":\"車\",\"strokes\":7,\"radical\":\"车 (xa)\",\"pinyin\":\"chē\",\"meaning\":\"xe\"}]', '2026-06-09 10:15:29'),
(92, '自行车', 'zìxíngchē', 'xe đạp', 2, 10, 6, '自 (tự)', '骑自行车。', 'Đi xe đạp.', '[{\"char\":\"自\",\"strokes\":6,\"radical\":\"自 (tự)\",\"pinyin\":\"zì\",\"meaning\":\"tự\"},{\"char\":\"行\",\"strokes\":6,\"radical\":\"彳 (sách)\",\"pinyin\":\"xíng\",\"meaning\":\"đi\\/hành\"},{\"char\":\"车\",\"strokes\":4,\"radical\":\"车 (xa)\",\"pinyin\":\"chē\",\"meaning\":\"xe\"}]', '2026-06-09 10:15:29'),
(93, '站', 'zhàn', 'bến, ga', 2, 10, 10, '立', '火车站。', 'Ga tàu hỏa.', '[{\"char\":\"站\",\"strokes\":10,\"radical\":\"立\",\"pinyin\":\"zhàn\",\"meaning\":\"bến, ga\"}]', '2026-06-09 10:15:29'),
(94, '票', 'piào', 'vé', 2, 10, 11, '示', '买票。', 'Mua vé.', '[{\"char\":\"票\",\"strokes\":11,\"radical\":\"示\",\"pinyin\":\"piào\",\"meaning\":\"vé\"}]', '2026-06-09 10:15:29'),
(95, '酒店', 'jiǔdiàn', 'khách sạn', 2, 10, 10, '酉 (dậu)', '住酒店。', 'Ở khách sạn.', '[{\"char\":\"酒\",\"strokes\":10,\"radical\":\"酉 (dậu)\",\"pinyin\":\"jiǔ\",\"meaning\":\"rượu\"},{\"char\":\"店\",\"strokes\":8,\"radical\":\"广 (yểm)\",\"pinyin\":\"diàn\",\"meaning\":\"cửa hàng\"}]', '2026-06-09 10:15:29'),
(96, '旅行', 'lǚxíng', 'du lịch', 2, 10, 10, '方 (phương)', '去旅行。', 'Đi du lịch.', '[{\"char\":\"旅\",\"strokes\":10,\"radical\":\"方 (phương)\",\"pinyin\":\"lǚ\",\"meaning\":\"du lịch\"},{\"char\":\"行\",\"strokes\":6,\"radical\":\"彳 (sách)\",\"pinyin\":\"xíng\",\"meaning\":\"đi\\/hành\"}]', '2026-06-09 10:15:29'),
(97, '医院', 'yīyuàn', 'bệnh viện', 2, 11, 7, '匚 (phương)', '去医院。', 'Đến bệnh viện.', '[{\"char\":\"医\",\"strokes\":7,\"radical\":\"匚 (phương)\",\"pinyin\":\"yī\",\"meaning\":\"y\"},{\"char\":\"院\",\"strokes\":10,\"radical\":\"阝 (phụ)\",\"pinyin\":\"yuàn\",\"meaning\":\"viện\"}]', '2026-06-09 10:15:29'),
(98, '医生', 'yīshēng', 'bác sĩ', 2, 11, 7, '匚 (phương)', '看医生。', 'Khám bác sĩ.', '[{\"char\":\"医\",\"strokes\":7,\"radical\":\"匚 (phương)\",\"pinyin\":\"yī\",\"meaning\":\"y\"},{\"char\":\"生\",\"strokes\":5,\"radical\":\"生 (sinh)\",\"pinyin\":\"shēng\",\"meaning\":\"sinh\\/sống\"}]', '2026-06-09 10:15:29'),
(99, '生病', 'shēngbìng', 'bị ốm', 2, 11, 5, '生 (sinh)', '生病了。', 'Bị ốm rồi.', '[{\"char\":\"生\",\"strokes\":5,\"radical\":\"生 (sinh)\",\"pinyin\":\"shēng\",\"meaning\":\"sinh\\/sống\"},{\"char\":\"病\",\"strokes\":10,\"radical\":\"疒 (nạch)\",\"pinyin\":\"bìng\",\"meaning\":\"bệnh\"}]', '2026-06-09 10:15:29'),
(100, '药', 'yào', 'thuốc', 2, 11, 9, '艹', '吃药。', 'Uống thuốc.', '[{\"char\":\"药\",\"strokes\":9,\"radical\":\"艹\",\"pinyin\":\"yào\",\"meaning\":\"thuốc\"}]', '2026-06-09 10:15:29'),
(101, '休息', 'xiūxi', 'nghỉ ngơi', 2, 11, 6, '亻 (nhân)', '多休息。', 'Nghỉ ngơi nhiều.', '[{\"char\":\"休\",\"strokes\":6,\"radical\":\"亻 (nhân)\",\"pinyin\":\"xiū\",\"meaning\":\"nghỉ\"},{\"char\":\"息\",\"strokes\":10,\"radical\":\"心 (tâm)\",\"pinyin\":\"xī\",\"meaning\":\"nghỉ ngơi\"}]', '2026-06-09 10:15:29'),
(102, '锻炼', 'duànliàn', 'tập luyện', 2, 11, 14, '金 (kim)', '锻炼身体。', 'Tập luyện thân thể.', '[{\"char\":\"锻\",\"strokes\":14,\"radical\":\"金 (kim)\",\"pinyin\":\"duàn\",\"meaning\":\"rèn\\/luyện\"},{\"char\":\"炼\",\"strokes\":9,\"radical\":\"火 (hỏa)\",\"pinyin\":\"liàn\",\"meaning\":\"luyện\"}]', '2026-06-09 10:15:29'),
(103, '身体', 'shēntǐ', 'cơ thể', 2, 11, 7, '身 (thân)', '身体健康。', 'Sức khỏe tốt.', '[{\"char\":\"身\",\"strokes\":7,\"radical\":\"身 (thân)\",\"pinyin\":\"shēn\",\"meaning\":\"thân thể\"},{\"char\":\"体\",\"strokes\":7,\"radical\":\"亻 (nhân)\",\"pinyin\":\"tǐ\",\"meaning\":\"thể\"}]', '2026-06-09 10:15:29'),
(104, '健康', 'jiànkāng', 'khỏe mạnh', 2, 11, 10, '亻 (nhân)', '祝你健康！', 'Chúc bạn sức khỏe!', '[{\"char\":\"健\",\"strokes\":10,\"radical\":\"亻 (nhân)\",\"pinyin\":\"jiàn\",\"meaning\":\"khỏe\"},{\"char\":\"康\",\"strokes\":11,\"radical\":\"广 (yểm)\",\"pinyin\":\"kāng\",\"meaning\":\"an khang\"}]', '2026-06-09 10:15:29'),
(105, '运动', 'yùndòng', 'vận động', 2, 12, 7, '辶 (sước)', '做运动。', 'Tập thể dục.', '[{\"char\":\"运\",\"strokes\":7,\"radical\":\"辶 (sước)\",\"pinyin\":\"yùn\",\"meaning\":\"vận động\"},{\"char\":\"动\",\"strokes\":6,\"radical\":\"力 (lực)\",\"pinyin\":\"dòng\",\"meaning\":\"động\"}]', '2026-06-09 10:15:29'),
(106, '跑步', 'pǎobù', 'chạy bộ', 2, 12, 12, '足 (túc)', '去跑步。', 'Đi chạy bộ.', '[{\"char\":\"跑\",\"strokes\":12,\"radical\":\"足 (túc)\",\"pinyin\":\"pǎo\",\"meaning\":\"chạy\"},{\"char\":\"步\",\"strokes\":7,\"radical\":\"止 (chỉ)\",\"pinyin\":\"bù\",\"meaning\":\"bước\"}]', '2026-06-09 10:15:29'),
(107, '游泳', 'yóuyǒng', 'bơi lội', 2, 12, 12, '氵 (thủy)', '去游泳。', 'Đi bơi.', '[{\"char\":\"游\",\"strokes\":12,\"radical\":\"氵 (thủy)\",\"pinyin\":\"yóu\",\"meaning\":\"bơi\\/du\"},{\"char\":\"泳\",\"strokes\":8,\"radical\":\"氵 (thủy)\",\"pinyin\":\"yǒng\",\"meaning\":\"bơi lội\"}]', '2026-06-09 10:15:29'),
(108, '足球', 'zúqiú', 'bóng đá', 2, 12, 7, '足 (túc)', '踢足球。', 'Đá bóng.', '[{\"char\":\"足\",\"strokes\":7,\"radical\":\"足 (túc)\",\"pinyin\":\"zú\",\"meaning\":\"chân\\/túc\"},{\"char\":\"球\",\"strokes\":11,\"radical\":\"王 (vương)\",\"pinyin\":\"qiú\",\"meaning\":\"bóng\"}]', '2026-06-09 10:15:29'),
(109, '篮球', 'lánqiú', 'bóng rổ', 2, 12, 13, '竹 (trúc)', '打篮球。', 'Chơi bóng rổ.', '[{\"char\":\"篮\",\"strokes\":13,\"radical\":\"竹 (trúc)\",\"pinyin\":\"lán\",\"meaning\":\"rổ\"},{\"char\":\"球\",\"strokes\":11,\"radical\":\"王 (vương)\",\"pinyin\":\"qiú\",\"meaning\":\"bóng\"}]', '2026-06-09 10:15:29'),
(110, '唱歌', 'chànggē', 'hát', 2, 12, 11, '口 (khẩu)', '喜欢唱歌。', 'Thích hát.', '[{\"char\":\"唱\",\"strokes\":11,\"radical\":\"口 (khẩu)\",\"pinyin\":\"chàng\",\"meaning\":\"hát\"},{\"char\":\"歌\",\"strokes\":14,\"radical\":\"欠 (khiếm)\",\"pinyin\":\"gē\",\"meaning\":\"bài hát\"}]', '2026-06-09 10:15:29'),
(111, '跳舞', 'tiàowǔ', 'nhảy múa', 2, 12, 13, '足 (túc)', '喜欢跳舞。', 'Thích khiêu vũ.', '[{\"char\":\"跳\",\"strokes\":13,\"radical\":\"足 (túc)\",\"pinyin\":\"tiào\",\"meaning\":\"nhảy\"},{\"char\":\"舞\",\"strokes\":14,\"radical\":\"夕 (tịch)\",\"pinyin\":\"wǔ\",\"meaning\":\"múa\"}]', '2026-06-09 10:15:29'),
(112, '音乐', 'yīnyuè', 'âm nhạc', 2, 12, 9, '音 (âm)', '听音乐。', 'Nghe nhạc.', '[{\"char\":\"音\",\"strokes\":9,\"radical\":\"音 (âm)\",\"pinyin\":\"yīn\",\"meaning\":\"âm thanh\"},{\"char\":\"乐\",\"strokes\":5,\"radical\":\"丿 (phiệt)\",\"pinyin\":\"lè\",\"meaning\":\"vui\\/nhạc\"}]', '2026-06-09 10:15:29'),
(113, '电影', 'diànyǐng', 'phim ảnh', 2, 12, 5, '田 (điền)', '看电影。', 'Xem phim.', '[{\"char\":\"电\",\"strokes\":5,\"radical\":\"田 (điền)\",\"pinyin\":\"diàn\",\"meaning\":\"điện\"},{\"char\":\"影\",\"strokes\":15,\"radical\":\"彡 (sam)\",\"pinyin\":\"yǐng\",\"meaning\":\"bóng\\/hình\"}]', '2026-06-09 10:15:29'),
(114, '电视', 'diànshì', 'tivi', 2, 12, 5, '田 (điền)', '看电视。', 'Xem tivi.', '[{\"char\":\"电\",\"strokes\":5,\"radical\":\"田 (điền)\",\"pinyin\":\"diàn\",\"meaning\":\"điện\"},{\"char\":\"视\",\"strokes\":9,\"radical\":\"见 (kiến)\",\"pinyin\":\"shì\",\"meaning\":\"xem\"}]', '2026-06-09 10:15:29'),
(115, '工作', 'gōngzuò', 'công việc', 2, 13, 3, '工 (công)', '去工作。', 'Đi làm việc.', '[{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\",\"pinyin\":\"gōng\",\"meaning\":\"Công \\/ Làm việc\"},{\"char\":\"作\",\"strokes\":7,\"radical\":\"亻 (nhân)\",\"pinyin\":\"zuò\",\"meaning\":\"làm\"}]', '2026-06-09 10:15:29'),
(116, '上班', 'shàngbān', 'đi làm', 2, 13, 3, '一 (nhất)', '去上班。', 'Đi làm.', '[{\"char\":\"上\",\"strokes\":3,\"radical\":\"一\",\"pinyin\":\"shàng\",\"meaning\":\"trên\"},{\"char\":\"班\",\"strokes\":10,\"radical\":\"王 (vương)\",\"pinyin\":\"bān\",\"meaning\":\"ca\\/lớp\"}]', '2026-06-09 10:15:29'),
(117, '下班', 'xiàbān', 'tan làm', 2, 13, 3, '一 (nhất)', '下班了。', 'Tan làm rồi.', '[{\"char\":\"下\",\"strokes\":3,\"radical\":\"一\",\"pinyin\":\"xià\",\"meaning\":\"dưới\"},{\"char\":\"班\",\"strokes\":10,\"radical\":\"王 (vương)\",\"pinyin\":\"bān\",\"meaning\":\"ca\\/lớp\"}]', '2026-06-09 10:15:29'),
(118, '公司', 'gōngsī', 'công ty', 2, 13, 4, '八 (bát)', '在公司。', 'Ở công ty.', '[{\"char\":\"公\",\"strokes\":4,\"radical\":\"八 (bát)\",\"pinyin\":\"gōng\",\"meaning\":\"công\"},{\"char\":\"司\",\"strokes\":5,\"radical\":\"口 (khẩu)\",\"pinyin\":\"sī\",\"meaning\":\"công ty\"}]', '2026-06-09 10:15:29'),
(119, '经理', 'jīnglǐ', 'giám đốc', 2, 13, 8, '纟 (tơ)', '王经理。', 'Giám đốc Vương.', '[{\"char\":\"经\",\"strokes\":8,\"radical\":\"纟 (tơ)\",\"pinyin\":\"jīng\",\"meaning\":\"kinh qua\"},{\"char\":\"理\",\"strokes\":11,\"radical\":\"王 (vương)\",\"pinyin\":\"lǐ\",\"meaning\":\"lý\"}]', '2026-06-09 10:15:29'),
(120, '老师', 'lǎoshī', 'giáo viên', 2, 13, 6, '老 (lão)', '李老师。', 'Thầy Lý.', '[{\"char\":\"老\",\"strokes\":6,\"radical\":\"老 (lão)\",\"pinyin\":\"lǎo\",\"meaning\":\"già\"},{\"char\":\"师\",\"strokes\":6,\"radical\":\"巾 (cân)\",\"pinyin\":\"shī\",\"meaning\":\"thầy\"}]', '2026-06-09 10:15:29'),
(121, '护士', 'hùshi', 'y tá', 2, 13, 7, '扌 (thủ)', '护士小姐。', 'Cô y tá.', '[{\"char\":\"护\",\"strokes\":7,\"radical\":\"扌 (thủ)\",\"pinyin\":\"hù\",\"meaning\":\"hộ\\/bảo vệ\"},{\"char\":\"士\",\"strokes\":3,\"radical\":\"士 (sĩ)\",\"pinyin\":\"shì\",\"meaning\":\"sĩ\"}]', '2026-06-09 10:15:29'),
(122, '司机', 'sījī', 'tài xế', 2, 13, 5, '口 (khẩu)', '司机先生。', 'Bác tài xế.', '[{\"char\":\"司\",\"strokes\":5,\"radical\":\"口 (khẩu)\",\"pinyin\":\"sī\",\"meaning\":\"công ty\"},{\"char\":\"机\",\"strokes\":6,\"radical\":\"木 (mộc)\",\"pinyin\":\"jī\",\"meaning\":\"máy\"}]', '2026-06-09 10:15:29'),
(123, '电话', 'diànhuà', 'điện thoại', 2, 14, 5, '田 (điền)', '打电话。', 'Gọi điện thoại.', '[{\"char\":\"电\",\"strokes\":5,\"radical\":\"田 (điền)\",\"pinyin\":\"diàn\",\"meaning\":\"điện\"},{\"char\":\"话\",\"strokes\":8,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"huà\",\"meaning\":\"lời nói\"}]', '2026-06-09 10:15:29'),
(124, '手机', 'shǒujī', 'điện thoại di động', 2, 14, 4, '手 (thủ)', '用手机。', 'Dùng điện thoại.', '[{\"char\":\"手\",\"strokes\":4,\"radical\":\"手 (thủ)\",\"pinyin\":\"shǒu\",\"meaning\":\"tay\"},{\"char\":\"机\",\"strokes\":6,\"radical\":\"木 (mộc)\",\"pinyin\":\"jī\",\"meaning\":\"máy\"}]', '2026-06-09 10:15:29'),
(125, '电脑', 'diànnǎo', 'máy tính', 2, 14, 5, '田 (điền)', '用电脑。', 'Dùng máy tính.', '[{\"char\":\"电\",\"strokes\":5,\"radical\":\"田 (điền)\",\"pinyin\":\"diàn\",\"meaning\":\"điện\"},{\"char\":\"脑\",\"strokes\":10,\"radical\":\"月 (nguyệt)\",\"pinyin\":\"nǎo\",\"meaning\":\"não\"}]', '2026-06-09 10:15:29'),
(126, '上网', 'shàngwǎng', 'lên mạng', 2, 14, 3, '一 (nhất)', '上网查资料。', 'Lên mạng tra tài liệu.', '[{\"char\":\"上\",\"strokes\":3,\"radical\":\"一\",\"pinyin\":\"shàng\",\"meaning\":\"trên\"},{\"char\":\"网\",\"strokes\":6,\"radical\":\"网 (võng)\",\"pinyin\":\"wǎng\",\"meaning\":\"mạng\\/lưới\"}]', '2026-06-09 10:15:29'),
(127, '邮件', 'yóujiàn', 'thư điện tử', 2, 14, 7, '阝 (phụ)', '发邮件。', 'Gửi email.', '[{\"char\":\"邮\",\"strokes\":7,\"radical\":\"阝 (phụ)\",\"pinyin\":\"yóu\",\"meaning\":\"bưu\"},{\"char\":\"件\",\"strokes\":6,\"radical\":\"亻 (nhân)\",\"pinyin\":\"jiàn\",\"meaning\":\"kiện\\/vật\"}]', '2026-06-09 10:15:29'),
(128, '微信', 'Wēixìn', 'WeChat', 2, 14, 13, '彳 (sách)', '加微信。', 'Thêm WeChat.', '[{\"char\":\"微\",\"strokes\":13,\"radical\":\"彳 (sách)\",\"pinyin\":\"wēi\",\"meaning\":\"vi\\/nhỏ\"},{\"char\":\"信\",\"strokes\":9,\"radical\":\"亻 (nhân)\",\"pinyin\":\"xìn\",\"meaning\":\"tin\"}]', '2026-06-09 10:15:29'),
(129, '信息', 'xìnxī', 'tin nhắn', 2, 14, 9, '亻 (nhân)', '发信息。', 'Gửi tin nhắn.', '[{\"char\":\"信\",\"strokes\":9,\"radical\":\"亻 (nhân)\",\"pinyin\":\"xìn\",\"meaning\":\"tin\"},{\"char\":\"息\",\"strokes\":10,\"radical\":\"心 (tâm)\",\"pinyin\":\"xī\",\"meaning\":\"nghỉ ngơi\"}]', '2026-06-09 10:15:29'),
(130, '网站', 'wǎngzhàn', 'website', 2, 14, 6, '网 (võng)', '访问网站。', 'Truy cập trang web.', '[{\"char\":\"网\",\"strokes\":6,\"radical\":\"网 (võng)\",\"pinyin\":\"wǎng\",\"meaning\":\"mạng\\/lưới\"},{\"char\":\"站\",\"strokes\":10,\"radical\":\"立\",\"pinyin\":\"zhàn\",\"meaning\":\"bến, ga\"}]', '2026-06-09 10:15:29'),
(131, '教室', 'jiàoshì', 'phòng học', 2, 15, 11, '攵 (phộc)', '在教室。', 'Ở lớp học.', '[{\"char\":\"教\",\"strokes\":11,\"radical\":\"攵 (phộc)\",\"pinyin\":\"jiào\",\"meaning\":\"dạy\"},{\"char\":\"室\",\"strokes\":9,\"radical\":\"宀 (miên)\",\"pinyin\":\"shì\",\"meaning\":\"phòng\"}]', '2026-06-09 10:15:29'),
(132, '图书馆', 'túshūguǎn', 'thư viện', 2, 15, 8, '囗 (vi)', '去图书馆。', 'Đi thư viện.', '[{\"char\":\"图\",\"strokes\":8,\"radical\":\"囗 (vi)\",\"pinyin\":\"tú\",\"meaning\":\"hình\\/tranh\"},{\"char\":\"书\",\"strokes\":4,\"radical\":\"乛 (chiết)\",\"pinyin\":\"shū\",\"meaning\":\"sách\"},{\"char\":\"馆\",\"strokes\":11,\"radical\":\"饣 (thực)\",\"pinyin\":\"guǎn\",\"meaning\":\"quán\"}]', '2026-06-09 10:15:29'),
(133, '考试', 'kǎoshì', 'thi cử', 2, 15, 6, '老 (lão)', '期末考试。', 'Thi cuối kỳ.', '[{\"char\":\"考\",\"strokes\":6,\"radical\":\"老 (lão)\",\"pinyin\":\"kǎo\",\"meaning\":\"thi\"},{\"char\":\"试\",\"strokes\":8,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"shì\",\"meaning\":\"thử\"}]', '2026-06-09 10:15:29'),
(134, '作业', 'zuòyè', 'bài tập', 2, 15, 7, '亻 (nhân)', '做作业。', 'Làm bài tập.', '[{\"char\":\"作\",\"strokes\":7,\"radical\":\"亻 (nhân)\",\"pinyin\":\"zuò\",\"meaning\":\"làm\"},{\"char\":\"业\",\"strokes\":5,\"radical\":\"一 (nhất)\",\"pinyin\":\"yè\",\"meaning\":\"nghiệp\"}]', '2026-06-09 10:15:29'),
(135, '词典', 'cídiǎn', 'từ điển', 2, 15, 7, '讠 (ngôn)', '查词典。', 'Tra từ điển.', '[{\"char\":\"词\",\"strokes\":7,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"cí\",\"meaning\":\"từ\"},{\"char\":\"典\",\"strokes\":8,\"radical\":\"八 (bát)\",\"pinyin\":\"diǎn\",\"meaning\":\"điển\"}]', '2026-06-09 10:15:29'),
(136, '铅笔', 'qiānbǐ', 'bút chì', 2, 15, 10, '金 (kim)', '一支铅笔。', 'Một cây bút chì.', '[{\"char\":\"铅\",\"strokes\":10,\"radical\":\"金 (kim)\",\"pinyin\":\"qiān\",\"meaning\":\"chì\"},{\"char\":\"笔\",\"strokes\":10,\"radical\":\"竹 (trúc)\",\"pinyin\":\"bǐ\",\"meaning\":\"bút\"}]', '2026-06-09 10:15:29'),
(137, '问题', 'wèntí', 'vấn đề, câu hỏi', 2, 15, 6, '门 (môn)', '回答问题。', 'Trả lời câu hỏi.', '[{\"char\":\"问\",\"strokes\":6,\"radical\":\"门 (môn)\",\"pinyin\":\"wèn\",\"meaning\":\"hỏi\"},{\"char\":\"题\",\"strokes\":15,\"radical\":\"页 (hiệt)\",\"pinyin\":\"tí\",\"meaning\":\"đề\"}]', '2026-06-09 10:15:29'),
(138, '答案', 'dáàn', 'đáp án', 2, 15, 12, '竹 (trúc)', '正确答案。', 'Đáp án chính xác.', '[{\"char\":\"答\",\"strokes\":12,\"radical\":\"竹 (trúc)\",\"pinyin\":\"dá\",\"meaning\":\"trả lời\"},{\"char\":\"案\",\"strokes\":10,\"radical\":\"木 (mộc)\",\"pinyin\":\"àn\",\"meaning\":\"án\"}]', '2026-06-09 10:15:29'),
(139, '银行', 'yínháng', 'ngân hàng', 3, 16, 14, '金 (kim)', '去银行。', 'Đi ngân hàng.', '[{\"char\":\"银\",\"strokes\":14,\"radical\":\"金 (kim)\",\"pinyin\":\"yín\",\"meaning\":\"bạc\"},{\"char\":\"行\",\"strokes\":6,\"radical\":\"彳 (sách)\",\"pinyin\":\"xíng\",\"meaning\":\"đi\\/hành\"}]', '2026-06-09 10:15:29'),
(140, '邮政局', 'yóuzhèngjú', 'bưu điện', 3, 16, 7, '阝 (phụ)', '去邮政局。', 'Đi bưu điện.', '[{\"char\":\"邮\",\"strokes\":7,\"radical\":\"阝 (phụ)\",\"pinyin\":\"yóu\",\"meaning\":\"bưu\"},{\"char\":\"政\",\"strokes\":9,\"radical\":\"攵 (phộc)\",\"pinyin\":\"zhèng\",\"meaning\":\"chính\"},{\"char\":\"局\",\"strokes\":7,\"radical\":\"尸 (thi)\",\"pinyin\":\"jú\",\"meaning\":\"cục\"}]', '2026-06-09 10:15:29'),
(141, '账户', 'zhànghù', 'tài khoản', 3, 16, 7, '贝 (bối)', '开账户。', 'Mở tài khoản.', '[{\"char\":\"账\",\"strokes\":7,\"radical\":\"贝 (bối)\",\"pinyin\":\"zhàng\",\"meaning\":\"tài khoản\"},{\"char\":\"户\",\"strokes\":4,\"radical\":\"户 (hộ)\",\"pinyin\":\"hù\",\"meaning\":\"hộ\"}]', '2026-06-09 10:15:29'),
(142, '存款', 'cúnkuǎn', 'tiền gửi', 3, 16, 6, '子 (tử)', '去存款。', 'Đi gửi tiền.', '[{\"char\":\"存\",\"strokes\":6,\"radical\":\"子 (tử)\",\"pinyin\":\"cún\",\"meaning\":\"tồn\\/gửi\"},{\"char\":\"款\",\"strokes\":12,\"radical\":\"欠 (khiếm)\",\"pinyin\":\"kuǎn\",\"meaning\":\"khoản tiền\"}]', '2026-06-09 10:15:29'),
(143, '取款', 'qǔkuǎn', 'rút tiền', 3, 16, 8, '又 (hựu)', '取款机。', 'Máy rút tiền.', '[{\"char\":\"取\",\"strokes\":8,\"radical\":\"又 (hựu)\",\"pinyin\":\"qǔ\",\"meaning\":\"lấy\"},{\"char\":\"款\",\"strokes\":12,\"radical\":\"欠 (khiếm)\",\"pinyin\":\"kuǎn\",\"meaning\":\"khoản tiền\"}]', '2026-06-09 10:15:29'),
(144, '汇款', 'huìkuǎn', 'chuyển tiền', 3, 16, 5, '氵 (thủy)', '汇款单。', 'Đơn chuyển tiền.', '[{\"char\":\"汇\",\"strokes\":5,\"radical\":\"氵 (thủy)\",\"pinyin\":\"huì\",\"meaning\":\"chuyển\"},{\"char\":\"款\",\"strokes\":12,\"radical\":\"欠 (khiếm)\",\"pinyin\":\"kuǎn\",\"meaning\":\"khoản tiền\"}]', '2026-06-09 10:15:29'),
(145, '邮票', 'yóupiào', 'tem thư', 3, 16, 7, '阝 (phụ)', '买邮票。', 'Mua tem.', '[{\"char\":\"邮\",\"strokes\":7,\"radical\":\"阝 (phụ)\",\"pinyin\":\"yóu\",\"meaning\":\"bưu\"},{\"char\":\"票\",\"strokes\":11,\"radical\":\"示\",\"pinyin\":\"piào\",\"meaning\":\"vé\"}]', '2026-06-09 10:15:29'),
(146, '信封', 'xìnfēng', 'phong bì', 3, 16, 9, '亻 (nhân)', '一个信封。', 'Một phong bì.', '[{\"char\":\"信\",\"strokes\":9,\"radical\":\"亻 (nhân)\",\"pinyin\":\"xìn\",\"meaning\":\"tin\"},{\"char\":\"封\",\"strokes\":9,\"radical\":\"寸 (thốn)\",\"pinyin\":\"fēng\",\"meaning\":\"phong bì\"}]', '2026-06-09 10:15:29'),
(147, '春节', 'Chūnjié', 'Tết Nguyên đán', 3, 17, 9, '日 (nhật)', '春节快乐！', 'Chúc mừng năm mới!', '[{\"char\":\"春\",\"strokes\":9,\"radical\":\"日 (nhật)\",\"pinyin\":\"chūn\",\"meaning\":\"mùa xuân\"},{\"char\":\"节\",\"strokes\":5,\"radical\":\"艹 (thảo)\",\"pinyin\":\"jié\",\"meaning\":\"tiết\\/lễ\"}]', '2026-06-09 10:15:29'),
(148, '中秋节', 'Zhōngqiūjié', 'Tết Trung thu', 3, 17, 4, '丨 (cổn)', '中秋节快乐。', 'Chúc Tết Trung thu vui vẻ.', '[{\"char\":\"中\",\"strokes\":4,\"radical\":\"丨 (cổn)\",\"pinyin\":\"zhōng\",\"meaning\":\"trung\"},{\"char\":\"秋\",\"strokes\":9,\"radical\":\"禾 (hòa)\",\"pinyin\":\"qiū\",\"meaning\":\"mùa thu\"},{\"char\":\"节\",\"strokes\":5,\"radical\":\"艹 (thảo)\",\"pinyin\":\"jié\",\"meaning\":\"tiết\\/lễ\"}]', '2026-06-09 10:15:29'),
(149, '礼物', 'lǐwù', 'quà tặng', 3, 17, 5, '礻 (thị)', '送礼物。', 'Tặng quà.', '[{\"char\":\"礼\",\"strokes\":5,\"radical\":\"礻 (thị)\",\"pinyin\":\"lǐ\",\"meaning\":\"lễ\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\",\"pinyin\":\"wù\",\"meaning\":\"vật\"}]', '2026-06-09 10:15:29'),
(150, '红包', 'hóngbāo', 'bao lì xì', 3, 17, 6, '纟 (tơ)', '发红包。', 'Phát bao lì xì.', '[{\"char\":\"红\",\"strokes\":6,\"radical\":\"纟 (tơ)\",\"pinyin\":\"hóng\",\"meaning\":\"đỏ\"},{\"char\":\"包\",\"strokes\":5,\"radical\":\"勹 (bao)\",\"pinyin\":\"bāo\",\"meaning\":\"gói\\/bao\"}]', '2026-06-09 10:15:29'),
(151, '传统', 'chuántǒng', 'truyền thống', 3, 17, 6, '亻 (nhân)', '传统文化。', 'Văn hóa truyền thống.', '[{\"char\":\"传\",\"strokes\":6,\"radical\":\"亻 (nhân)\",\"pinyin\":\"chuán\",\"meaning\":\"truyền\"},{\"char\":\"统\",\"strokes\":9,\"radical\":\"纟 (tơ)\",\"pinyin\":\"tǒng\",\"meaning\":\"thống\"}]', '2026-06-09 10:15:29'),
(152, '文化', 'wénhuà', 'văn hóa', 3, 17, 4, '文 (văn)', '中国文化。', 'Văn hóa Trung Quốc.', '[{\"char\":\"文\",\"strokes\":4,\"radical\":\"文 (văn)\",\"pinyin\":\"wén\",\"meaning\":\"văn\"},{\"char\":\"化\",\"strokes\":4,\"radical\":\"亻 (nhân)\",\"pinyin\":\"huà\",\"meaning\":\"hóa\"}]', '2026-06-09 10:15:29'),
(153, '习俗', 'xísú', 'phong tục', 3, 17, 3, '乙 (ất)', '春节习俗。', 'Phong tục Tết.', '[{\"char\":\"习\",\"strokes\":3,\"radical\":\"乙 (ất)\",\"pinyin\":\"xí\",\"meaning\":\"tập\"},{\"char\":\"俗\",\"strokes\":9,\"radical\":\"亻 (nhân)\",\"pinyin\":\"sú\",\"meaning\":\"tục\"}]', '2026-06-09 10:15:29'),
(154, '庆祝', 'qìngzhù', 'chúc mừng', 3, 17, 6, '广 (yểm)', '庆祝新年。', 'Chúc mừng năm mới.', '[{\"char\":\"庆\",\"strokes\":6,\"radical\":\"广 (yểm)\",\"pinyin\":\"qìng\",\"meaning\":\"mừng\"},{\"char\":\"祝\",\"strokes\":9,\"radical\":\"礻 (thị)\",\"pinyin\":\"zhù\",\"meaning\":\"chúc\"}]', '2026-06-09 10:15:29'),
(155, '环境', 'huánjìng', 'môi trường', 3, 18, 8, '王 (vương)', '保护环境。', 'Bảo vệ môi trường.', '[{\"char\":\"环\",\"strokes\":8,\"radical\":\"王 (vương)\",\"pinyin\":\"huán\",\"meaning\":\"hoàn\\/huân\"},{\"char\":\"境\",\"strokes\":14,\"radical\":\"土 (thổ)\",\"pinyin\":\"jìng\",\"meaning\":\"cảnh\"}]', '2026-06-09 10:15:29'),
(156, '保护', 'bǎohù', 'bảo vệ', 3, 18, 9, '亻 (nhân)', '保护大自然。', 'Bảo vệ thiên nhiên.', '[{\"char\":\"保\",\"strokes\":9,\"radical\":\"亻 (nhân)\",\"pinyin\":\"bǎo\",\"meaning\":\"bảo\"},{\"char\":\"护\",\"strokes\":7,\"radical\":\"扌 (thủ)\",\"pinyin\":\"hù\",\"meaning\":\"hộ\\/bảo vệ\"}]', '2026-06-09 10:15:29'),
(157, '森林', 'sēnlín', 'rừng', 3, 18, 12, '木 (mộc)', '热带森林。', 'Rừng nhiệt đới.', '[{\"char\":\"森\",\"strokes\":12,\"radical\":\"木 (mộc)\",\"pinyin\":\"sēn\",\"meaning\":\"rừng\"},{\"char\":\"林\",\"strokes\":8,\"radical\":\"木 (mộc)\",\"pinyin\":\"lín\",\"meaning\":\"rừng\\/lâm\"}]', '2026-06-09 10:15:29'),
(158, '河流', 'héliú', 'sông', 3, 18, 8, '氵 (thủy)', '干净的河流。', 'Dòng sông sạch.', '[{\"char\":\"河\",\"strokes\":8,\"radical\":\"氵 (thủy)\",\"pinyin\":\"hé\",\"meaning\":\"sông\"},{\"char\":\"流\",\"strokes\":10,\"radical\":\"氵 (thủy)\",\"pinyin\":\"liú\",\"meaning\":\"chảy\"}]', '2026-06-09 10:15:29'),
(159, '空气', 'kōngqì', 'không khí', 3, 18, 8, '穴 (huyệt)', '新鲜空气。', 'Không khí trong lành.', '[{\"char\":\"空\",\"strokes\":8,\"radical\":\"穴 (huyệt)\",\"pinyin\":\"kōng\",\"meaning\":\"không\"},{\"char\":\"气\",\"strokes\":4,\"radical\":\"气 (khí)\",\"pinyin\":\"qì\",\"meaning\":\"khí\"}]', '2026-06-09 10:15:29'),
(160, '阳光', 'yángguāng', 'ánh nắng', 3, 18, 6, '阝 (phụ)', '温暖的阳光。', 'Ánh nắng ấm áp.', '[{\"char\":\"阳\",\"strokes\":6,\"radical\":\"阝 (phụ)\",\"pinyin\":\"yáng\",\"meaning\":\"dương\"},{\"char\":\"光\",\"strokes\":6,\"radical\":\"儿 (nhân)\",\"pinyin\":\"guāng\",\"meaning\":\"ánh sáng\"}]', '2026-06-09 10:15:29'),
(161, '动物', 'dòngwù', 'động vật', 3, 18, 6, '力 (lực)', '保护动物。', 'Bảo vệ động vật.', '[{\"char\":\"动\",\"strokes\":6,\"radical\":\"力 (lực)\",\"pinyin\":\"dòng\",\"meaning\":\"động\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\",\"pinyin\":\"wù\",\"meaning\":\"vật\"}]', '2026-06-09 10:15:29'),
(162, '植物', 'zhíwù', 'thực vật', 3, 18, 12, '木 (mộc)', '绿色植物。', 'Cây xanh.', '[{\"char\":\"植\",\"strokes\":12,\"radical\":\"木 (mộc)\",\"pinyin\":\"zhí\",\"meaning\":\"thực vật\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\",\"pinyin\":\"wù\",\"meaning\":\"vật\"}]', '2026-06-09 10:15:29'),
(163, '市场', 'shìchǎng', 'thị trường', 3, 19, 5, '巾 (cân)', '市场经济。', 'Kinh tế thị trường.', '[{\"char\":\"市\",\"strokes\":5,\"radical\":\"巾 (cân)\",\"pinyin\":\"shì\",\"meaning\":\"chợ\\/thành phố\"},{\"char\":\"场\",\"strokes\":6,\"radical\":\"土 (thổ)\",\"pinyin\":\"chǎng\",\"meaning\":\"trường\\/chợ\"}]', '2026-06-09 10:15:29'),
(164, '经济', 'jīngjì', 'kinh tế', 3, 19, 8, '纟 (tơ)', '经济发展。', 'Phát triển kinh tế.', '[{\"char\":\"经\",\"strokes\":8,\"radical\":\"纟 (tơ)\",\"pinyin\":\"jīng\",\"meaning\":\"kinh qua\"},{\"char\":\"济\",\"strokes\":9,\"radical\":\"氵 (thủy)\",\"pinyin\":\"jì\",\"meaning\":\"tế\"}]', '2026-06-09 10:15:29'),
(165, '贸易', 'màoyì', 'thương mại', 3, 19, 9, '贝 (bối)', '国际贸易。', 'Thương mại quốc tế.', '[{\"char\":\"贸\",\"strokes\":9,\"radical\":\"贝 (bối)\",\"pinyin\":\"mào\",\"meaning\":\"mậu dịch\"},{\"char\":\"易\",\"strokes\":8,\"radical\":\"日 (nhật)\",\"pinyin\":\"yì\",\"meaning\":\"dễ\\/dịch\"}]', '2026-06-09 10:15:29'),
(166, '合同', 'hétong', 'hợp đồng', 3, 19, 6, '口 (khẩu)', '签合同。', 'Ký hợp đồng.', '[{\"char\":\"合\",\"strokes\":6,\"radical\":\"口 (khẩu)\",\"pinyin\":\"hé\",\"meaning\":\"hợp\"},{\"char\":\"同\",\"strokes\":6,\"radical\":\"口 (khẩu)\",\"pinyin\":\"tóng\",\"meaning\":\"cùng\"}]', '2026-06-09 10:15:29'),
(167, '价格', 'jiàgé', 'giá cả', 3, 19, 6, '亻 (nhân)', '合理价格。', 'Giá cả hợp lý.', '[{\"char\":\"价\",\"strokes\":6,\"radical\":\"亻 (nhân)\",\"pinyin\":\"jià\",\"meaning\":\"giá\"},{\"char\":\"格\",\"strokes\":10,\"radical\":\"木 (mộc)\",\"pinyin\":\"gé\",\"meaning\":\"cách\"}]', '2026-06-09 10:15:29'),
(168, '利润', 'lìrùn', 'lợi nhuận', 3, 19, 7, '刂 (đao)', '获得利润。', 'Thu được lợi nhuận.', '[{\"char\":\"利\",\"strokes\":7,\"radical\":\"刂 (đao)\",\"pinyin\":\"lì\",\"meaning\":\"lợi\"},{\"char\":\"润\",\"strokes\":10,\"radical\":\"氵 (thủy)\",\"pinyin\":\"rùn\",\"meaning\":\"nhuận\"}]', '2026-06-09 10:15:29'),
(169, '投资', 'tóuzī', 'đầu tư', 3, 19, 7, '扌 (thủ)', '投资未来。', 'Đầu tư tương lai.', '[{\"char\":\"投\",\"strokes\":7,\"radical\":\"扌 (thủ)\",\"pinyin\":\"tóu\",\"meaning\":\"đầu tư\"},{\"char\":\"资\",\"strokes\":10,\"radical\":\"贝 (bối)\",\"pinyin\":\"zī\",\"meaning\":\"tư bản\"}]', '2026-06-09 10:15:29'),
(170, '发展', 'fāzhǎn', 'phát triển', 3, 19, 5, '乛 (chiết)', '发展经济。', 'Phát triển kinh tế.', '[{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\",\"pinyin\":\"fā\",\"meaning\":\"phát\"},{\"char\":\"展\",\"strokes\":10,\"radical\":\"尸 (thi)\",\"pinyin\":\"zhǎn\",\"meaning\":\"triển\"}]', '2026-06-09 10:15:29'),
(171, '科学', 'kēxué', 'khoa học', 3, 20, 9, '禾 (hòa)', '科学技术。', 'Khoa học kỹ thuật.', '[{\"char\":\"科\",\"strokes\":9,\"radical\":\"禾 (hòa)\",\"pinyin\":\"kē\",\"meaning\":\"khoa\"},{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\",\"pinyin\":\"xué\",\"meaning\":\"Học\"}]', '2026-06-09 10:15:29'),
(172, '技术', 'jìshù', 'kỹ thuật', 3, 20, 7, '扌 (thủ)', '信息技术。', 'Công nghệ thông tin.', '[{\"char\":\"技\",\"strokes\":7,\"radical\":\"扌 (thủ)\",\"pinyin\":\"jì\",\"meaning\":\"kỹ\"},{\"char\":\"术\",\"strokes\":5,\"radical\":\"木 (mộc)\",\"pinyin\":\"shù\",\"meaning\":\"thuật\"}]', '2026-06-09 10:15:29'),
(173, '网络', 'wǎngluò', 'mạng lưới', 3, 20, 6, '网 (võng)', '网络时代。', 'Thời đại mạng.', '[{\"char\":\"网\",\"strokes\":6,\"radical\":\"网 (võng)\",\"pinyin\":\"wǎng\",\"meaning\":\"mạng\\/lưới\"},{\"char\":\"络\",\"strokes\":9,\"radical\":\"纟 (tơ)\",\"pinyin\":\"luò\",\"meaning\":\"lưới\"}]', '2026-06-09 10:15:29'),
(174, '数据', 'shùjù', 'dữ liệu', 3, 20, 13, '攵 (phộc)', '大数据。', 'Dữ liệu lớn.', '[{\"char\":\"数\",\"strokes\":13,\"radical\":\"攵 (phộc)\",\"pinyin\":\"shù\",\"meaning\":\"số\"},{\"char\":\"据\",\"strokes\":11,\"radical\":\"扌 (thủ)\",\"pinyin\":\"jù\",\"meaning\":\"cứ\"}]', '2026-06-09 10:15:29'),
(175, '软件', 'ruǎnjiàn', 'phần mềm', 3, 20, 8, '车 (xa)', '开发软件。', 'Phát triển phần mềm.', '[{\"char\":\"软\",\"strokes\":8,\"radical\":\"车 (xa)\",\"pinyin\":\"ruǎn\",\"meaning\":\"mềm\"},{\"char\":\"件\",\"strokes\":6,\"radical\":\"亻 (nhân)\",\"pinyin\":\"jiàn\",\"meaning\":\"kiện\\/vật\"}]', '2026-06-09 10:15:29');
INSERT INTO `vocab` (`id`, `hanzi`, `pinyin`, `meaning`, `level`, `lesson_id`, `strokes`, `radical`, `example`, `example_vi`, `char_data`, `created_at`) VALUES
(176, '硬件', 'yìngjiàn', 'phần cứng', 3, 20, 12, '石 (thạch)', '电脑硬件。', 'Phần cứng máy tính.', '[{\"char\":\"硬\",\"strokes\":12,\"radical\":\"石 (thạch)\",\"pinyin\":\"yìng\",\"meaning\":\"cứng\"},{\"char\":\"件\",\"strokes\":6,\"radical\":\"亻 (nhân)\",\"pinyin\":\"jiàn\",\"meaning\":\"kiện\\/vật\"}]', '2026-06-09 10:15:29'),
(177, '人工智能', 'réngōng zhìnéng', 'trí tuệ nhân tạo', 3, 20, 2, '人 (nhân)', '人工智能时代。', 'Kỷ nguyên trí tuệ nhân tạo.', '[{\"char\":\"人\",\"strokes\":2,\"radical\":\"人 (nhân)\",\"pinyin\":\"rén\",\"meaning\":\"Người\"},{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\",\"pinyin\":\"gōng\",\"meaning\":\"Công \\/ Làm việc\"},{\"char\":\"智\",\"strokes\":12,\"radical\":\"日 (nhật)\",\"pinyin\":\"zhì\",\"meaning\":\"trí tuệ\"},{\"char\":\"能\",\"strokes\":10,\"radical\":\"月 (nguyệt)\",\"pinyin\":\"néng\",\"meaning\":\"năng\"}]', '2026-06-09 10:15:29'),
(178, '机器人', 'jīqìrén', 'robot', 3, 20, 6, '木 (mộc)', '智能机器人。', 'Robot thông minh.', '[{\"char\":\"机\",\"strokes\":6,\"radical\":\"木 (mộc)\",\"pinyin\":\"jī\",\"meaning\":\"máy\"},{\"char\":\"器\",\"strokes\":16,\"radical\":\"口 (khẩu)\",\"pinyin\":\"qì\",\"meaning\":\"khí cụ\"},{\"char\":\"人\",\"strokes\":2,\"radical\":\"人 (nhân)\",\"pinyin\":\"rén\",\"meaning\":\"Người\"}]', '2026-06-09 10:15:29'),
(179, '而且', 'érqiě', 'hơn nữa', 3, NULL, 6, '而 (nhi)', '而且很好。', 'Hơn nữa rất tốt.', '[{\"char\":\"而\",\"strokes\":6,\"radical\":\"而 (nhi)\",\"pinyin\":\"ér\",\"meaning\":\"mà\"},{\"char\":\"且\",\"strokes\":5,\"radical\":\"一 (nhất)\",\"pinyin\":\"qiě\",\"meaning\":\"hơn nữa\"}]', '2026-06-09 10:15:29'),
(181, '虽然', 'suīrán', 'mặc dù', 3, NULL, 9, '虫 (trùng)', '虽然...但是...', 'Tuy...nhưng...', '[{\"char\":\"虽\",\"strokes\":9,\"radical\":\"虫 (trùng)\",\"pinyin\":\"suī\",\"meaning\":\"tuy\"},{\"char\":\"然\",\"strokes\":12,\"radical\":\"火 (hỏa)\",\"pinyin\":\"rán\",\"meaning\":\"nhiên\"}]', '2026-06-09 10:15:29'),
(183, '特别', 'tèbié', 'đặc biệt', 3, NULL, 10, '牛 (ngưu)', '特别好。', 'Đặc biệt tốt.', '[{\"char\":\"特\",\"strokes\":10,\"radical\":\"牛 (ngưu)\",\"pinyin\":\"tè\",\"meaning\":\"đặc biệt\"},{\"char\":\"别\",\"strokes\":7,\"radical\":\"刂 (đao)\",\"pinyin\":\"bié\",\"meaning\":\"khác\\/biệt\"}]', '2026-06-09 10:15:29'),
(184, '提高', 'tígāo', 'nâng cao', 3, NULL, 12, '扌 (thủ)', '提高水平。', 'Nâng cao trình độ.', '[{\"char\":\"提\",\"strokes\":12,\"radical\":\"扌 (thủ)\",\"pinyin\":\"tí\",\"meaning\":\"đề\\/nâng\"},{\"char\":\"高\",\"strokes\":10,\"radical\":\"高 (cao)\",\"pinyin\":\"gāo\",\"meaning\":\"cao\"}]', '2026-06-09 10:15:29'),
(185, '喜欢', 'xǐhuān', 'thích', 1, NULL, 12, '口 (khẩu)', '我喜欢你。', 'Anh thích em.', '[{\"char\":\"喜\",\"strokes\":12,\"radical\":\"口 (khẩu)\",\"pinyin\":\"xǐ\",\"meaning\":\"thích\\/vui\"},{\"char\":\"欢\",\"strokes\":6,\"radical\":\"欠 (khiếm)\",\"pinyin\":\"huān\",\"meaning\":\"vui\"}]', '2026-06-09 10:15:29'),
(186, '高兴', 'gāoxìng', 'vui vẻ', 1, NULL, 10, '高 (cao)', '很高兴。', 'Rất vui.', '[{\"char\":\"高\",\"strokes\":10,\"radical\":\"高 (cao)\",\"pinyin\":\"gāo\",\"meaning\":\"cao\"},{\"char\":\"兴\",\"strokes\":6,\"radical\":\"八 (bát)\",\"pinyin\":\"xīng\",\"meaning\":\"hứng\"}]', '2026-06-09 10:15:29'),
(187, '漂亮', 'piàoliang', 'xinh đẹp', 2, NULL, 14, '氵 (thủy)', '很漂亮。', 'Rất đẹp.', '[{\"char\":\"漂\",\"strokes\":14,\"radical\":\"氵 (thủy)\",\"pinyin\":\"piào\",\"meaning\":\"đẹp\"},{\"char\":\"亮\",\"strokes\":9,\"radical\":\"亠 (đầu)\",\"pinyin\":\"liàng\",\"meaning\":\"sáng\"}]', '2026-06-09 10:15:29'),
(188, '努力', 'nǔlì', 'cố gắng', 2, NULL, 7, '力 (lực)', '努力学习。', 'Học tập chăm chỉ.', '[{\"char\":\"努\",\"strokes\":7,\"radical\":\"力 (lực)\",\"pinyin\":\"nǔ\",\"meaning\":\"cố gắng\"},{\"char\":\"力\",\"strokes\":2,\"radical\":\"力 (lực)\",\"pinyin\":\"lì\",\"meaning\":\"sức\"}]', '2026-06-09 10:15:29'),
(189, '简单', 'jiǎndān', 'đơn giản', 2, NULL, 13, '竹 (trúc)', '很简单。', 'Rất đơn giản.', '[{\"char\":\"简\",\"strokes\":13,\"radical\":\"竹 (trúc)\",\"pinyin\":\"jiǎn\",\"meaning\":\"đơn giản\"},{\"char\":\"单\",\"strokes\":8,\"radical\":\"十 (thập)\",\"pinyin\":\"dān\",\"meaning\":\"đơn\"}]', '2026-06-09 10:15:29'),
(190, '方便', 'fāngbiàn', 'tiện lợi', 2, NULL, 4, '方 (phương)', '很方便。', 'Rất tiện lợi.', '[{\"char\":\"方\",\"strokes\":4,\"radical\":\"方 (phương)\",\"pinyin\":\"fāng\",\"meaning\":\"phương\"},{\"char\":\"便\",\"strokes\":9,\"radical\":\"亻 (nhân)\",\"pinyin\":\"biàn\",\"meaning\":\"tiện\"}]', '2026-06-09 10:15:29'),
(191, '幸福', 'xìngfú', 'hạnh phúc', 3, NULL, 8, '干 (can)', '幸福生活。', 'Cuộc sống hạnh phúc.', '[{\"char\":\"幸\",\"strokes\":8,\"radical\":\"干 (can)\",\"pinyin\":\"xìng\",\"meaning\":\"hạnh phúc\"},{\"char\":\"福\",\"strokes\":13,\"radical\":\"礻 (thị)\",\"pinyin\":\"fú\",\"meaning\":\"phúc\"}]', '2026-06-09 10:15:29'),
(192, '勇敢', 'yǒnggǎn', 'dũng cảm', 3, NULL, 9, '力 (lực)', '勇敢的人。', 'Người dũng cảm.', '[{\"char\":\"勇\",\"strokes\":9,\"radical\":\"力 (lực)\",\"pinyin\":\"yǒng\",\"meaning\":\"dũng cảm\"},{\"char\":\"敢\",\"strokes\":11,\"radical\":\"攵 (phộc)\",\"pinyin\":\"gǎn\",\"meaning\":\"dám\"}]', '2026-06-09 10:15:29'),
(193, '热情', 'rèqíng', 'nhiệt tình', 3, NULL, 10, '灬 (hỏa)', '热情服务。', 'Phục vụ nhiệt tình.', '[{\"char\":\"热\",\"strokes\":10,\"radical\":\"灬\",\"pinyin\":\"rè\",\"meaning\":\"nóng\"},{\"char\":\"情\",\"strokes\":11,\"radical\":\"忄 (tâm)\",\"pinyin\":\"qíng\",\"meaning\":\"tình cảm\"}]', '2026-06-09 10:15:29'),
(194, '认真', 'rènzhēn', 'nghiêm túc', 2, NULL, 4, '讠 (ngôn)', '认真学习。', 'Học tập nghiêm túc.', '[{\"char\":\"认\",\"strokes\":4,\"radical\":\"讠 (ngôn)\",\"pinyin\":\"rèn\",\"meaning\":\"nhận\"},{\"char\":\"真\",\"strokes\":10,\"radical\":\"目 (mục)\",\"pinyin\":\"zhēn\",\"meaning\":\"thật\"}]', '2026-06-09 10:15:29'),
(195, '帮助', 'bāngzhù', 'giúp đỡ', 2, NULL, 9, '巾 (cân)', '互相帮助。', 'Giúp đỡ lẫn nhau.', '[{\"char\":\"帮\",\"strokes\":9,\"radical\":\"巾 (cân)\",\"pinyin\":\"bāng\",\"meaning\":\"giúp\"},{\"char\":\"助\",\"strokes\":7,\"radical\":\"力 (lực)\",\"pinyin\":\"zhù\",\"meaning\":\"trợ giúp\"}]', '2026-06-09 10:15:29'),
(196, '欢迎', 'huānyíng', 'hoan nghênh', 2, NULL, 6, '欠 (khiếm)', '欢迎光临！', 'Hoan nghênh quý khách!', '[{\"char\":\"欢\",\"strokes\":6,\"radical\":\"欠 (khiếm)\",\"pinyin\":\"huān\",\"meaning\":\"vui\"},{\"char\":\"迎\",\"strokes\":7,\"radical\":\"辶 (sước)\",\"pinyin\":\"yíng\",\"meaning\":\"chào đón\"}]', '2026-06-09 10:15:29'),
(197, '继续', 'jìxù', 'tiếp tục', 3, NULL, 10, '纟 (tơ)', '继续努力。', 'Tiếp tục cố gắng.', '[{\"char\":\"继\",\"strokes\":10,\"radical\":\"纟 (tơ)\",\"pinyin\":\"jì\",\"meaning\":\"kế tiếp\"},{\"char\":\"续\",\"strokes\":11,\"radical\":\"纟 (tơ)\",\"pinyin\":\"xù\",\"meaning\":\"tiếp tục\"}]', '2026-06-09 10:15:29'),
(198, '成功', 'chénggōng', 'thành công', 3, NULL, 6, '戈 (qua)', '祝你成功！', 'Chúc bạn thành công!', '[{\"char\":\"成\",\"strokes\":6,\"radical\":\"戈 (qua)\",\"pinyin\":\"chéng\",\"meaning\":\"thành công\"},{\"char\":\"功\",\"strokes\":5,\"radical\":\"力 (lực)\",\"pinyin\":\"gōng\",\"meaning\":\"công\"}]', '2026-06-09 10:15:29'),
(199, '开始', 'kāishǐ', 'bắt đầu', 2, NULL, 4, '廾 (thảo)', '开始上课。', 'Bắt đầu vào lớp.', '[{\"char\":\"开\",\"strokes\":4,\"radical\":\"廾 (thảo)\",\"pinyin\":\"kāi\",\"meaning\":\"mở\"},{\"char\":\"始\",\"strokes\":8,\"radical\":\"女 (nữ)\",\"pinyin\":\"shǐ\",\"meaning\":\"bắt đầu\"}]', '2026-06-09 10:15:29'),
(200, '结束', 'jiéshù', 'kết thúc', 2, NULL, 9, '纟 (tơ)', '结束了吗？', 'Kết thúc chưa?', '[{\"char\":\"结\",\"strokes\":9,\"radical\":\"纟 (tơ)\",\"pinyin\":\"jié\",\"meaning\":\"kết\"},{\"char\":\"束\",\"strokes\":7,\"radical\":\"木 (mộc)\",\"pinyin\":\"shù\",\"meaning\":\"kết thúc\"}]', '2026-06-09 10:15:29'),
(201, '起床', 'qǐchuáng', 'thức dậy', 4, NULL, 10, '走 (tẩu)', '我每天六点起床。', 'Tôi thức dậy lúc 6 giờ mỗi ngày.', '[{\"char\":\"\\u8d77\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5e8a\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(202, '刷牙', 'shuāyá', 'đánh răng', 4, NULL, 8, '刂 (đao)', '早上刷牙很重要。', 'Đánh răng buổi sáng rất quan trọng.', '[{\"char\":\"\\u5237\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7259\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(203, '洗脸', 'xǐliǎn', 'rửa mặt', 4, NULL, 10, '氵 (thủy)', '起床后先洗脸。', 'Sau khi dậy hãy rửa mặt.', '[{\"char\":\"\\u6d17\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8138\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(204, '早餐', 'zǎocān', 'bữa sáng', 4, NULL, 6, '日 (nhật)', '早餐要吃好。', 'Bữa sáng phải ăn tốt.', '[{\"char\":\"\\u65e9\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9910\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(205, '上班', 'shàngbān', 'đi làm', 4, NULL, 3, '一', '我八点上班。', 'Tôi đi làm lúc 8 giờ.', '[{\"char\":\"\\u4e0a\",\"strokes\":3,\"radical\":\"\\u4e00\"},{\"char\":\"\\u73ed\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(206, '下班', 'xiàbān', 'tan làm', 4, NULL, 3, '一', '下午五点下班。', 'Tan làm lúc 5 giờ chiều.', '[{\"char\":\"\\u4e0b\",\"strokes\":3,\"radical\":\"\\u4e00\"},{\"char\":\"\\u73ed\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(207, '休息', 'xiūxi', 'nghỉ ngơi', 4, NULL, 6, '亻 (nhân)', '周末我在家休息。', 'Cuối tuần tôi nghỉ ở nhà.', '[{\"char\":\"\\u4f11\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u606f\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(208, '看电视', 'kàn diànshì', 'xem tivi', 4, NULL, 9, '目 (mục)', '晚上看电视。', 'Buổi tối xem tivi.', '[{\"char\":\"\\u770b\",\"strokes\":9,\"radical\":\"\\u76ee (m\\u1ee5c)\"},{\"char\":\"\\u7535\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u89c6\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(209, '睡觉', 'shuìjiào', 'ngủ', 4, NULL, 10, '冖 (mịch)', '十点睡觉。', 'Ngủ lúc 10 giờ.', '[{\"char\":\"\\u7761\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u89c9\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(210, '散步', 'sànbù', 'đi dạo', 4, NULL, 12, '攵 (phộc)', '饭后散步。', 'Đi dạo sau bữa ăn.', '[{\"char\":\"\\u6563\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6b65\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(211, '面试', 'miànshì', 'phỏng vấn', 4, NULL, 9, '面 (diện)', '明天有面试。', 'Ngày mai có phỏng vấn.', '[{\"char\":\"\\u9762\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bd5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(212, '简历', 'jiǎnlì', 'sơ yếu lý lịch', 4, NULL, 13, '竹 (trúc)', '请发简历。', 'Hãy gửi sơ yếu lý lịch.', '[{\"char\":\"\\u7b80\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5386\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(213, '升职', 'shēngzhí', 'thăng chức', 4, NULL, 4, '十 (thập)', '他升职了。', 'Anh ấy được thăng chức.', '[{\"char\":\"\\u5347\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u804c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(214, '辞职', 'cízhí', 'từ chức', 4, NULL, 13, '辛 (tân)', '她辞职了。', 'Cô ấy đã từ chức.', '[{\"char\":\"\\u8f9e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u804c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(215, '工资', 'gōngzī', 'lương', 4, NULL, 3, '工 (công)', '工资很高。', 'Lương rất cao.', '[{\"char\":\"\\u5de5\",\"strokes\":3,\"radical\":\"\\u5de5 (c\\u00f4ng)\"},{\"char\":\"\\u8d44\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(216, '同事', 'tóngshì', 'đồng nghiệp', 4, NULL, 6, '口 (khẩu)', '他是我的同事。', 'Anh ấy là đồng nghiệp của tôi.', '[{\"char\":\"\\u540c\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4e8b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(217, '加班', 'jiābān', 'tăng ca', 4, NULL, 5, '力 (lực)', '今晚要加班。', 'Tối nay phải tăng ca.', '[{\"char\":\"\\u52a0\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u73ed\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(218, '请假', 'qǐngjià', 'xin nghỉ', 4, NULL, 10, '讠 (ngôn)', '我请假一天。', 'Tôi xin nghỉ một ngày.', '[{\"char\":\"\\u8bf7\",\"strokes\":10,\"radical\":\"\\u8ba0 (ng\\u00f4n)\"},{\"char\":\"\\u5047\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(219, '出差', 'chūchāi', 'đi công tác', 4, NULL, 5, '凵 (khảm)', '下个月出差。', 'Tháng sau đi công tác.', '[{\"char\":\"\\u51fa\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5dee\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(220, '会议', 'huìyì', 'cuộc họp', 4, NULL, 6, '人 (nhân)', '下午有会议。', 'Chiều nay có cuộc họp.', '[{\"char\":\"\\u4f1a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bae\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(221, '健康', 'jiànkāng', 'sức khỏe', 4, NULL, 10, '亻 (nhân)', '祝您健康。', 'Chúc bạn sức khỏe.', '[{\"char\":\"\\u5065\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5eb7\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(222, '运动', 'yùndòng', 'vận động', 4, NULL, 6, '辶 (sước)', '每天运动。', 'Tập thể dục mỗi ngày.', '[{\"char\":\"\\u8fd0\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u52a8\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(223, '检查', 'jiǎnchá', 'kiểm tra', 4, NULL, 10, '木 (mộc)', '去医院检查。', 'Đi bệnh viện kiểm tra.', '[{\"char\":\"\\u68c0\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u67e5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(224, '感冒', 'gǎnmào', 'cảm cúm', 4, NULL, 13, '心 (tâm)', '我感冒了。', 'Tôi bị cảm rồi.', '[{\"char\":\"\\u611f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5192\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(225, '发烧', 'fāshāo', 'sốt', 4, NULL, 5, '乛 (chiết)', '孩子发烧了。', 'Đứa bé bị sốt.', '[{\"char\":\"\\u53d1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u70e7\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(226, '咳嗽', 'késòu', 'ho', 4, NULL, 9, '口 (khẩu)', '一直咳嗽。', 'Ho liên tục.', '[{\"char\":\"\\u54b3\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u55fd\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(227, '头疼', 'tóuténg', 'đau đầu', 4, NULL, 5, '大 (đại)', '有点头疼。', 'Hơi đau đầu.', '[{\"char\":\"\\u5934\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u75bc\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(228, '锻炼', 'duànliàn', 'rèn luyện', 4, NULL, 14, '金 (kim)', '每天锻炼。', 'Rèn luyện mỗi ngày.', '[{\"char\":\"\\u953b\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u70bc\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(229, '减肥', 'jiǎnféi', 'giảm cân', 4, NULL, 11, '冫 (băng)', '她在减肥。', 'Cô ấy đang giảm cân.', '[{\"char\":\"\\u51cf\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u80a5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(230, '牙医', 'yáyī', 'nha sĩ', 4, NULL, 4, '牙 (nha)', '去看牙医。', 'Đi khám nha sĩ.', '[{\"char\":\"\\u7259\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u533b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(231, '护照', 'hùzhào', 'hộ chiếu', 4, NULL, 7, '扌 (thủ)', '带护照。', 'Mang hộ chiếu.', '[{\"char\":\"\\u62a4\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7167\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(232, '签证', 'qiānzhèng', 'thị thực', 4, NULL, 13, '竹 (trúc)', '办签证。', 'Làm thị thực.', '[{\"char\":\"\\u7b7e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bc1\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(233, '行李', 'xíngli', 'hành lý', 4, NULL, 6, '彳 (sách)', '行李很重。', 'Hành lý rất nặng.', '[{\"char\":\"\\u884c\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u674e\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(234, '航班', 'hángbān', 'chuyến bay', 4, NULL, 10, '舟 (chu)', '航班延误。', 'Chuyến bay bị hoãn.', '[{\"char\":\"\\u822a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u73ed\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(235, '酒店', 'jiǔdiàn', 'khách sạn', 4, NULL, 10, '酉 (dậu)', '订酒店。', 'Đặt khách sạn.', '[{\"char\":\"\\u9152\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5e97\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(236, '景点', 'jǐngdiǎn', 'điểm tham quan', 4, NULL, 12, '日 (nhật)', '著名景点。', 'Điểm tham quan nổi tiếng.', '[{\"char\":\"\\u666f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u70b9\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(237, '导游', 'dǎoyóu', 'hướng dẫn viên', 4, NULL, 6, '寸 (thốn)', '导游很好。', 'Hướng dẫn viên tốt.', '[{\"char\":\"\\u5bfc\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6e38\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(238, '堵车', 'dǔchē', 'tắc đường', 4, NULL, 11, '土 (thổ)', '路上堵车。', 'Tắc đường trên đường.', '[{\"char\":\"\\u5835\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8f66\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(239, '地铁', 'dìtiě', 'tàu điện ngầm', 4, NULL, 6, '土 (thổ)', '坐地铁。', 'Đi tàu điện ngầm.', '[{\"char\":\"\\u5730\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u94c1\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(240, '出租车', 'chūzūchē', 'taxi', 4, NULL, 5, '凵 (khảm)', '打出租车。', 'Bắt taxi.', '[{\"char\":\"\\u51fa\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u79df\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8f66\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(241, '打折', 'dǎzhé', 'giảm giá', 4, NULL, 6, '扌 (thủ)', '现在打折。', 'Đang giảm giá.', '[{\"char\":\"\\u6253\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6298\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(242, '刷卡', 'shuākǎ', 'quẹt thẻ', 4, NULL, 8, '刂 (đao)', '可以刷卡吗？', 'Có thể quẹt thẻ không?', '[{\"char\":\"\\u5237\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5361\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(243, '现金', 'xiànjīn', 'tiền mặt', 4, NULL, 8, '王 (vương)', '用现金。', 'Dùng tiền mặt.', '[{\"char\":\"\\u73b0\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u91d1\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(244, '发票', 'fāpiào', 'hóa đơn', 4, NULL, 5, '乛 (chiết)', '开发票。', 'Xuất hóa đơn.', '[{\"char\":\"\\u53d1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7968\",\"strokes\":11,\"radical\":\"\\u793a\"}]', '2026-06-12 05:15:36'),
(245, '退货', 'tuìhuò', 'trả hàng', 4, NULL, 9, '辶 (sước)', '可以退货。', 'Có thể trả hàng.', '[{\"char\":\"\\u9000\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8d27\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(246, '质量', 'zhìliàng', 'chất lượng', 4, NULL, 8, '贝 (bối)', '质量很好。', 'Chất lượng rất tốt.', '[{\"char\":\"\\u8d28\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u91cf\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(247, '价格', 'jiàgé', 'giá cả', 4, NULL, 6, '亻 (nhân)', '价格合理。', 'Giá cả hợp lý.', '[{\"char\":\"\\u4ef7\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u683c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(248, '超市', 'chāoshì', 'siêu thị', 4, NULL, 12, '走 (tẩu)', '去超市。', 'Đi siêu thị.', '[{\"char\":\"\\u8d85\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5e02\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(249, '购物车', 'gòuwùchē', 'xe đẩy', 4, NULL, 8, '贝 (bối)', '推购物车。', 'Đẩy xe hàng.', '[{\"char\":\"\\u8d2d\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7269\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8f66\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(250, '收银台', 'shōuyíntái', 'quầy thanh toán', 4, NULL, 6, '攵 (phộc)', '在收银台付款。', 'Thanh toán tại quầy.', '[{\"char\":\"\\u6536\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u94f6\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u53f0\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(251, '课程', 'kèchéng', 'khóa học', 4, NULL, 10, '讠 (ngôn)', '课程很有趣。', 'Khóa học rất thú vị.', '[{\"char\":\"\\u8bfe\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7a0b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(252, '考试', 'kǎoshì', 'kỳ thi', 4, NULL, 6, '老 (lão)', '期末考试。', 'Thi cuối kỳ.', '[{\"char\":\"\\u8003\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bd5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(253, '成绩', 'chéngjì', 'thành tích', 4, NULL, 6, '戈 (qua)', '成绩很好。', 'Thành tích tốt.', '[{\"char\":\"\\u6210\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7ee9\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(254, '毕业', 'bìyè', 'tốt nghiệp', 4, NULL, 6, '比 (tỷ)', '明年毕业。', 'Tốt nghiệp năm sau.', '[{\"char\":\"\\u6bd5\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4e1a\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(255, '留学', 'liúxué', 'du học', 4, NULL, 10, '田 (điền)', '去中国留学。', 'Đi du học Trung Quốc.', '[{\"char\":\"\\u7559\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5b66\",\"strokes\":8,\"radical\":\"\\u5b50 (t\\u1eed)\"}]', '2026-06-12 05:15:36'),
(256, '图书馆', 'túshūguǎn', 'thư viện', 4, NULL, 8, '囗 (vi)', '去图书馆。', 'Đi thư viện.', '[{\"char\":\"\\u56fe\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4e66\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9986\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(257, '教授', 'jiàoshòu', 'giáo sư', 4, NULL, 11, '攵 (phộc)', '王教授。', 'Giáo sư Vương.', '[{\"char\":\"\\u6559\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6388\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(258, '论文', 'lùnwén', 'luận văn', 4, NULL, 6, '讠 (ngôn)', '写论文。', 'Viết luận văn.', '[{\"char\":\"\\u8bba\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6587\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(259, '奖学金', 'jiǎngxuéjīn', 'học bổng', 4, NULL, 9, '大 (đại)', '获得奖学金。', 'Nhận học bổng.', '[{\"char\":\"\\u5956\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5b66\",\"strokes\":8,\"radical\":\"\\u5b50 (t\\u1eed)\"},{\"char\":\"\\u91d1\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(260, '研究', 'yánjiū', 'nghiên cứu', 4, NULL, 9, '石 (thạch)', '做研究。', 'Làm nghiên cứu.', '[{\"char\":\"\\u7814\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7a76\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(261, '传统', 'chuántǒng', 'truyền thống', 4, NULL, 6, '亻 (nhân)', '传统文化。', 'Văn hóa truyền thống.', '[{\"char\":\"\\u4f20\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7edf\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(262, '节日', 'jiérì', 'ngày lễ', 4, NULL, 5, '艹 (thảo)', '春节是重要节日。', 'Tết là ngày lễ quan trọng.', '[{\"char\":\"\\u8282\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u65e5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(263, '婚礼', 'hūnlǐ', 'đám cưới', 4, NULL, 11, '女 (nữ)', '参加婚礼。', 'Tham dự đám cưới.', '[{\"char\":\"\\u5a5a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u793c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(264, '礼物', 'lǐwù', 'quà tặng', 4, NULL, 5, '礻 (thị)', '送礼物。', 'Tặng quà.', '[{\"char\":\"\\u793c\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7269\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(265, '风俗', 'fēngsú', 'phong tục', 4, NULL, 4, '风 (phong)', '地方风俗。', 'Phong tục địa phương.', '[{\"char\":\"\\u98ce\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4fd7\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(266, '社会', 'shèhuì', 'xã hội', 4, NULL, 7, '礻 (thị)', '现代社会。', 'Xã hội hiện đại.', '[{\"char\":\"\\u793e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4f1a\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(267, '关系', 'guānxi', 'quan hệ', 4, NULL, 6, '八 (bát)', '关系很好。', 'Quan hệ tốt.', '[{\"char\":\"\\u5173\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7cfb\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(268, '交流', 'jiāoliú', 'giao lưu', 4, NULL, 6, '亠 (đầu)', '文化交流。', 'Giao lưu văn hóa.', '[{\"char\":\"\\u4ea4\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6d41\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(269, '尊重', 'zūnzhòng', 'tôn trọng', 4, NULL, 12, '寸 (thốn)', '互相尊重。', 'Tôn trọng lẫn nhau.', '[{\"char\":\"\\u5c0a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u91cd\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(270, '习惯', 'xíguàn', 'thói quen', 4, NULL, 3, '乙 (ất)', '生活习惯。', 'Thói quen sinh hoạt.', '[{\"char\":\"\\u4e60\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u60ef\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(271, '高兴', 'gāoxìng', 'vui vẻ', 4, NULL, 10, '高 (cao)', '很高兴。', 'Rất vui vẻ.', '[{\"char\":\"\\u9ad8\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5174\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(272, '难过', 'nánguò', 'buồn', 4, NULL, 10, '隹 (chuy)', '别难过。', 'Đừng buồn.', '[{\"char\":\"\\u96be\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8fc7\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(273, '担心', 'dānxīn', 'lo lắng', 4, NULL, 8, '扌 (thủ)', '不用担心。', 'Đừng lo lắng.', '[{\"char\":\"\\u62c5\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5fc3\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(274, '紧张', 'jǐnzhāng', 'căng thẳng', 4, NULL, 10, '糸 (mịch)', '考试紧张。', 'Căng thẳng vì thi.', '[{\"char\":\"\\u7d27\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5f20\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(275, '感动', 'gǎndòng', 'cảm động', 4, NULL, 13, '心 (tâm)', '非常感动。', 'Rất cảm động.', '[{\"char\":\"\\u611f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u52a8\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(276, '生气', 'shēngqì', 'tức giận', 4, NULL, 5, '生 (sinh)', '不要生气。', 'Đừng tức giận.', '[{\"char\":\"\\u751f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6c14\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(277, '羡慕', 'xiànmù', 'ghen tị', 4, NULL, 12, '羊 (dương)', '真羡慕你。', 'Thật ghen tị với bạn.', '[{\"char\":\"\\u7fa1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6155\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(278, '失望', 'shīwàng', 'thất vọng', 4, NULL, 5, '大 (đại)', '有点失望。', 'Hơi thất vọng.', '[{\"char\":\"\\u5931\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u671b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(279, '信心', 'xìnxīn', 'tự tin', 4, NULL, 9, '亻 (nhân)', '有信心。', 'Có tự tin.', '[{\"char\":\"\\u4fe1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5fc3\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(280, '幸福', 'xìngfú', 'hạnh phúc', 4, NULL, 8, '土 (thổ)', '幸福生活。', 'Cuộc sống hạnh phúc.', '[{\"char\":\"\\u5e78\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u798f\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(281, '发明', 'fāmíng', 'phát minh', 4, NULL, 5, '乛 (chiết)', '伟大的发明。', 'Phát minh vĩ đại.', '[{\"char\":\"\\u53d1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u660e\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(282, '网络', 'wǎngluò', 'mạng', 4, NULL, 6, '网 (võng)', '网络时代。', 'Thời đại mạng.', '[{\"char\":\"\\u7f51\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7edc\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(283, '数据', 'shùjù', 'dữ liệu', 4, NULL, 13, '攵 (phộc)', '分析数据。', 'Phân tích dữ liệu.', '[{\"char\":\"\\u6570\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u636e\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(284, '下载', 'xiàzài', 'tải xuống', 4, NULL, 3, '一', '下载软件。', 'Tải phần mềm.', '[{\"char\":\"\\u4e0b\",\"strokes\":3,\"radical\":\"\\u4e00\"},{\"char\":\"\\u8f7d\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(285, '上传', 'shàngchuán', 'tải lên', 4, NULL, 3, '一', '上传照片。', 'Tải ảnh lên.', '[{\"char\":\"\\u4e0a\",\"strokes\":3,\"radical\":\"\\u4e00\"},{\"char\":\"\\u4f20\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(286, '密码', 'mìmǎ', 'mật khẩu', 4, NULL, 11, '宀 (miên)', '设置密码。', 'Đặt mật khẩu.', '[{\"char\":\"\\u5bc6\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7801\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(287, '连接', 'liánjiē', 'kết nối', 4, NULL, 7, '辶 (sước)', '连接网络。', 'Kết nối mạng.', '[{\"char\":\"\\u8fde\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u63a5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(288, '搜索', 'sōusuǒ', 'tìm kiếm', 4, NULL, 13, '扌 (thủ)', '搜索信息。', 'Tìm kiếm thông tin.', '[{\"char\":\"\\u641c\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7d22\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(289, '程序', 'chéngxù', 'chương trình', 4, NULL, 12, '禾 (hòa)', '安装程序。', 'Cài đặt chương trình.', '[{\"char\":\"\\u7a0b\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5e8f\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(290, '系统', 'xìtǒng', 'hệ thống', 4, NULL, 7, '糸 (mịch)', '更新系统。', 'Cập nhật hệ thống.', '[{\"char\":\"\\u7cfb\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7edf\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(291, '环境', 'huánjìng', 'môi trường', 4, NULL, 8, '王 (vương)', '保护环境。', 'Bảo vệ môi trường.', '[{\"char\":\"\\u73af\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5883\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(292, '污染', 'wūrǎn', 'ô nhiễm', 4, NULL, 6, '氵 (thủy)', '空气污染。', 'Ô nhiễm không khí.', '[{\"char\":\"\\u6c61\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u67d3\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(293, '季节', 'jìjié', 'mùa', 4, NULL, 8, '子 (tử)', '四个季节。', 'Bốn mùa.', '[{\"char\":\"\\u5b63\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8282\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(294, '温度', 'wēndù', 'nhiệt độ', 4, NULL, 12, '氵 (thủy)', '温度很高。', 'Nhiệt độ rất cao.', '[{\"char\":\"\\u6e29\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5ea6\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(295, '刮风', 'guāfēng', 'gió thổi', 4, NULL, 8, '刂 (đao)', '今天刮风。', 'Hôm nay có gió.', '[{\"char\":\"\\u522e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u98ce\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(296, '下雨', 'xiàyǔ', 'mưa', 4, NULL, 3, '一', '正在下雨。', 'Trời đang mưa.', '[{\"char\":\"\\u4e0b\",\"strokes\":3,\"radical\":\"\\u4e00\"},{\"char\":\"\\u96e8\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(297, '太阳', 'tàiyáng', 'mặt trời', 4, NULL, 4, '大 (đại)', '太阳很大。', 'Mặt trời rất to.', '[{\"char\":\"\\u592a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9633\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(298, '月亮', 'yuèliang', 'mặt trăng', 4, NULL, 4, '月 (nguyệt)', '月亮很圆。', 'Trăng rất tròn.', '[{\"char\":\"\\u6708\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4eae\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(299, '植物', 'zhíwù', 'thực vật', 4, NULL, 12, '木 (mộc)', '绿色植物。', 'Thực vật xanh.', '[{\"char\":\"\\u690d\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7269\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(300, '动物', 'dòngwù', 'động vật', 4, NULL, 6, '力 (lực)', '保护动物。', 'Bảo vệ động vật.', '[{\"char\":\"\\u52a8\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7269\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(301, '经济', 'jīngjì', 'kinh tế', 5, NULL, 8, '纟 (tơ)', '经济发展。', 'Phát triển kinh tế.', '[{\"char\":\"\\u7ecf\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6d4e\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(302, '市场', 'shìchǎng', 'thị trường', 5, NULL, 5, '巾 (cân)', '市场经济。', 'Kinh tế thị trường.', '[{\"char\":\"\\u5e02\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u573a\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(303, '投资', 'tóuzī', 'đầu tư', 5, NULL, 7, '扌 (thủ)', '投资未来。', 'Đầu tư tương lai.', '[{\"char\":\"\\u6295\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8d44\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(304, '股票', 'gǔpiào', 'cổ phiếu', 5, NULL, 8, '月 (nguyệt)', '买股票。', 'Mua cổ phiếu.', '[{\"char\":\"\\u80a1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7968\",\"strokes\":11,\"radical\":\"\\u793a\"}]', '2026-06-12 05:15:36'),
(305, '银行', 'yínháng', 'ngân hàng', 5, NULL, 14, '金 (kim)', '去银行。', 'Đi ngân hàng.', '[{\"char\":\"\\u94f6\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u884c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(306, '贷款', 'dàikuǎn', 'khoản vay', 5, NULL, 9, '贝 (bối)', '申请贷款。', 'Đăng ký khoản vay.', '[{\"char\":\"\\u8d37\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6b3e\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(307, '利息', 'lìxī', 'lãi suất', 5, NULL, 7, '刂 (đao)', '银行利息。', 'Lãi suất ngân hàng.', '[{\"char\":\"\\u5229\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u606f\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(308, '预算', 'yùsuàn', 'ngân sách', 5, NULL, 10, '页 (hiệt)', '做预算。', 'Làm ngân sách.', '[{\"char\":\"\\u9884\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7b97\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(309, '消费', 'xiāofèi', 'tiêu dùng', 5, NULL, 10, '氵 (thủy)', '合理消费。', 'Tiêu dùng hợp lý.', '[{\"char\":\"\\u6d88\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8d39\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(310, '收入', 'shōurù', 'thu nhập', 5, NULL, 6, '攵 (phộc)', '月收入。', 'Thu nhập tháng.', '[{\"char\":\"\\u6536\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5165\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(311, '艺术', 'yìshù', 'nghệ thuật', 5, NULL, 4, '艹 (thảo)', '现代艺术。', 'Nghệ thuật hiện đại.', '[{\"char\":\"\\u827a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u672f\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(312, '音乐', 'yīnyuè', 'âm nhạc', 5, NULL, 9, '音 (âm)', '听音乐。', 'Nghe nhạc.', '[{\"char\":\"\\u97f3\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4e50\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(313, '画家', 'huàjiā', 'họa sĩ', 5, NULL, 8, '田 (điền)', '著名画家。', 'Họa sĩ nổi tiếng.', '[{\"char\":\"\\u753b\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5bb6\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(314, '小说', 'xiǎoshuō', 'tiểu thuyết', 5, NULL, 3, '小 (tiểu)', '读小说。', 'Đọc tiểu thuyết.', '[{\"char\":\"\\u5c0f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bf4\",\"strokes\":9,\"radical\":\"\\u8a00 (ng\\u00f4n)\"}]', '2026-06-12 05:15:36'),
(315, '诗歌', 'shīgē', 'thơ ca', 5, NULL, 8, '讠 (ngôn)', '写诗歌。', 'Viết thơ.', '[{\"char\":\"\\u8bd7\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6b4c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(316, '舞蹈', 'wǔdǎo', 'khiêu vũ', 5, NULL, 14, '夕 (tịch)', '学舞蹈。', 'Học khiêu vũ.', '[{\"char\":\"\\u821e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8e48\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(317, '摄影', 'shèyǐng', 'nhiếp ảnh', 5, NULL, 13, '扌 (thủ)', '喜欢摄影。', 'Thích nhiếp ảnh.', '[{\"char\":\"\\u6444\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5f71\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(318, '展览', 'zhǎnlǎn', 'triển lãm', 5, NULL, 10, '尸 (thi)', '看展览。', 'Xem triển lãm.', '[{\"char\":\"\\u5c55\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u89c8\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(319, '创作', 'chuàngzuò', 'sáng tác', 5, NULL, 6, '刂 (đao)', '创作音乐。', 'Sáng tác âm nhạc.', '[{\"char\":\"\\u521b\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4f5c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(320, '欣赏', 'xīnshǎng', 'thưởng thức', 5, NULL, 8, '欠 (khiếm)', '欣赏艺术。', 'Thưởng thức nghệ thuật.', '[{\"char\":\"\\u6b23\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8d4f\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(321, '法律', 'fǎlǜ', 'pháp luật', 5, NULL, 8, '氵 (thủy)', '遵守法律。', 'Tuân thủ pháp luật.', '[{\"char\":\"\\u6cd5\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5f8b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(322, '权利', 'quánlì', 'quyền lợi', 5, NULL, 6, '木 (mộc)', '公民权利。', 'Quyền công dân.', '[{\"char\":\"\\u6743\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5229\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(323, '义务', 'yìwù', 'nghĩa vụ', 5, NULL, 3, '丶 (chủ)', '有义务。', 'Có nghĩa vụ.', '[{\"char\":\"\\u4e49\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u52a1\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(324, '选举', 'xuǎnjǔ', 'bầu cử', 5, NULL, 9, '辶 (sước)', '参加选举。', 'Tham gia bầu cử.', '[{\"char\":\"\\u9009\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4e3e\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(325, '政府', 'zhèngfǔ', 'chính phủ', 5, NULL, 9, '攵 (phộc)', '地方政府。', 'Chính phủ địa phương.', '[{\"char\":\"\\u653f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5e9c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(326, '政策', 'zhèngcè', 'chính sách', 5, NULL, 9, '攵 (phộc)', '新政策。', 'Chính sách mới.', '[{\"char\":\"\\u653f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7b56\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(327, '民主', 'mínzhǔ', 'dân chủ', 5, NULL, 5, '氏 (thị)', '社会主义。', 'Xã hội chủ nghĩa.', '[{\"char\":\"\\u6c11\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4e3b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(328, '改革', 'gǎigé', 'cải cách', 5, NULL, 7, '攵 (phộc)', '改革开放。', 'Cải cách mở cửa.', '[{\"char\":\"\\u6539\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9769\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(329, '制度', 'zhìdù', 'chế độ', 5, NULL, 8, '刂 (đao)', '社会制度。', 'Chế độ xã hội.', '[{\"char\":\"\\u5236\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5ea6\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(330, '平等', 'píngděng', 'bình đẳng', 5, NULL, 5, '干 (can)', '人人平等。', 'Mọi người bình đẳng.', '[{\"char\":\"\\u5e73\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7b49\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(331, '食谱', 'shípǔ', 'công thức nấu', 5, NULL, 9, '食 (thực)', '学食谱。', 'Học công thức nấu.', '[{\"char\":\"\\u98df\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8c31\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(332, '味道', 'wèidào', 'mùi vị', 5, NULL, 8, '口 (khẩu)', '味道很好。', 'Mùi vị rất ngon.', '[{\"char\":\"\\u5473\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9053\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(333, '新鲜', 'xīnxiān', 'tươi', 5, NULL, 13, '鱼 (ngư)', '新鲜蔬菜。', 'Rau tươi.', '[{\"char\":\"\\u65b0\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9c9c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(334, '烹饪', 'pēngrèn', 'nấu nướng', 5, NULL, 11, '灬 (hỏa)', '学烹饪。', 'Học nấu ăn.', '[{\"char\":\"\\u70f9\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u996a\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(335, '营养', 'yíngyǎng', 'dinh dưỡng', 5, NULL, 11, '艹 (thảo)', '有营养。', 'Có dinh dưỡng.', '[{\"char\":\"\\u8425\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u517b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(336, '材料', 'cáiliào', 'nguyên liệu', 5, NULL, 7, '木 (mộc)', '准备材料。', 'Chuẩn bị nguyên liệu.', '[{\"char\":\"\\u6750\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6599\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(337, '厨房', 'chúfáng', 'nhà bếp', 5, NULL, 12, '厂 (hán)', '在厨房。', 'Ở nhà bếp.', '[{\"char\":\"\\u53a8\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u623f\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(338, '煎', 'jiān', 'rán', 5, NULL, 13, '灬 (hỏa)', '煎鱼。', 'Rán cá.', '[{\"char\":\"\\u714e\",\"strokes\":13,\"radical\":\"\\u706c (h\\u1ecfa)\"}]', '2026-06-12 05:15:36'),
(339, '炒', 'chǎo', 'xào', 5, NULL, 8, '火 (hỏa)', '炒菜。', 'Xào rau.', '[{\"char\":\"\\u7092\",\"strokes\":8,\"radical\":\"\\u706b (h\\u1ecfa)\"}]', '2026-06-12 05:15:36'),
(340, '蒸', 'zhēng', 'hấp', 5, NULL, 13, '艹 (thảo)', '蒸鱼。', 'Hấp cá.', '[{\"char\":\"\\u84b8\",\"strokes\":13,\"radical\":\"\\u8279 (th\\u1ea3o)\"}]', '2026-06-12 05:15:36'),
(341, '哲学', 'zhéxué', 'triết học', 5, NULL, 10, '口 (khẩu)', '研究哲学。', 'Nghiên cứu triết học.', '[{\"char\":\"\\u54f2\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5b66\",\"strokes\":8,\"radical\":\"\\u5b50 (t\\u1eed)\"}]', '2026-06-12 05:15:36'),
(342, '思想', 'sīxiǎng', 'tư tưởng', 5, NULL, 9, '心 (tâm)', '伟大的思想。', 'Tư tưởng vĩ đại.', '[{\"char\":\"\\u601d\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u60f3\",\"strokes\":13,\"radical\":\"\\u5fc3 (t\\u00e2m)\"}]', '2026-06-12 05:15:36'),
(343, '理论', 'lǐlùn', 'lý thuyết', 5, NULL, 11, '王 (vương)', '科学理论。', 'Lý thuyết khoa học.', '[{\"char\":\"\\u7406\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bba\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(344, '概念', 'gàiniàn', 'khái niệm', 5, NULL, 13, '木 (mộc)', '基本概念。', 'Khái niệm cơ bản.', '[{\"char\":\"\\u6982\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5ff5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(345, '意识', 'yìshi', 'ý thức', 5, NULL, 13, '心 (tâm)', '有意识。', 'Có ý thức.', '[{\"char\":\"\\u610f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bc6\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(346, '逻辑', 'luóji', 'logic', 5, NULL, 11, '辶 (sước)', '逻辑思维。', 'Tư duy logic.', '[{\"char\":\"\\u903b\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8f91\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(347, '辩证法', 'biànzhèngfǎ', 'biện chứng pháp', 5, NULL, 16, '辛 (tân)', '唯物辩证法。', 'Phép biện chứng duy vật.', '[{\"char\":\"\\u8fa9\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8bc1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6cd5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(348, '本质', 'běnzhì', 'bản chất', 5, NULL, 5, '木 (mộc)', '问题的本质。', 'Bản chất của vấn đề.', '[{\"char\":\"\\u672c\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8d28\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(349, '现象', 'xiànxiàng', 'hiện tượng', 5, NULL, 8, '王 (vương)', '自然现象。', 'Hiện tượng tự nhiên.', '[{\"char\":\"\\u73b0\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8c61\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(350, '矛盾', 'máodùn', 'mâu thuẫn', 5, NULL, 5, '矛 (mâu)', '主要矛盾。', 'Mâu thuẫn chính.', '[{\"char\":\"\\u77db\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u76fe\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(351, '物理', 'wùlǐ', 'vật lý', 6, NULL, 8, '牛 (ngưu)', '学物理。', 'Học vật lý.', '[{\"char\":\"\\u7269\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7406\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(352, '化学', 'huàxué', 'hóa học', 6, NULL, 4, '亻 (nhân)', '化学实验。', 'Thí nghiệm hóa học.', '[{\"char\":\"\\u5316\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5b66\",\"strokes\":8,\"radical\":\"\\u5b50 (t\\u1eed)\"}]', '2026-06-12 05:15:36'),
(353, '生物', 'shēngwù', 'sinh vật', 6, NULL, 5, '生 (sinh)', '海洋生物。', 'Sinh vật biển.', '[{\"char\":\"\\u751f\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7269\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(354, '基因', 'jīyīn', 'gen', 6, NULL, 11, '土 (thổ)', '基因研究。', 'Nghiên cứu gen.', '[{\"char\":\"\\u57fa\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u56e0\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(355, '细胞', 'xìbāo', 'tế bào', 6, NULL, 8, '纟 (tơ)', '细胞结构。', 'Cấu trúc tế bào.', '[{\"char\":\"\\u7ec6\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u80de\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(356, '进化', 'jìnhuà', 'tiến hóa', 6, NULL, 7, '辶 (sước)', '进化论。', 'Thuyết tiến hóa.', '[{\"char\":\"\\u8fdb\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5316\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(357, '分子', 'fēnzǐ', 'phân tử', 6, NULL, 4, '刀 (đao)', '分子结构。', 'Cấu trúc phân tử.', '[{\"char\":\"\\u5206\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5b50\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(358, '能源', 'néngyuán', 'năng lượng', 6, NULL, 10, '月 (nguyệt)', '可再生能源。', 'Năng lượng tái tạo.', '[{\"char\":\"\\u80fd\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6e90\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(359, '实验', 'shíyàn', 'thí nghiệm', 6, NULL, 8, '宀 (miên)', '做实验。', 'Làm thí nghiệm.', '[{\"char\":\"\\u5b9e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9a8c\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(360, '分析', 'fēnxī', 'phân tích', 6, NULL, 4, '刀 (đao)', '分析数据。', 'Phân tích dữ liệu.', '[{\"char\":\"\\u5206\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6790\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(361, '人工智能', 'réngōng zhìnéng', 'trí tuệ nhân tạo', 6, NULL, 2, '人 (nhân)', '人工智能时代。', 'Kỷ nguyên AI.', '[{\"char\":\"\\u4eba\",\"strokes\":2,\"radical\":\"\\u4eba (nh\\u00e2n)\"},{\"char\":\"\\u5de5\",\"strokes\":3,\"radical\":\"\\u5de5 (c\\u00f4ng)\"},{\"char\":\"\\u667a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u80fd\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(362, '算法', 'suànfǎ', 'thuật toán', 6, NULL, 14, '竹 (trúc)', '设计算法。', 'Thiết kế thuật toán.', '[{\"char\":\"\\u7b97\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u6cd5\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(363, '数据库', 'shùjùkù', 'cơ sở dữ liệu', 6, NULL, 13, '攵 (phộc)', '管理数据库。', 'Quản lý cơ sở dữ liệu.', '[{\"char\":\"\\u6570\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u636e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5e93\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(364, '编程', 'biānchéng', 'lập trình', 6, NULL, 12, '纟 (tơ)', '学编程。', 'Học lập trình.', '[{\"char\":\"\\u7f16\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7a0b\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(365, '加密', 'jiāmì', 'mã hóa', 6, NULL, 5, '力 (lực)', '数据加密。', 'Mã hóa dữ liệu.', '[{\"char\":\"\\u52a0\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5bc6\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(366, '虚拟', 'xūnǐ', 'ảo', 6, NULL, 11, '虍 (hổ)', '虚拟现实。', 'Thực tế ảo.', '[{\"char\":\"\\u865a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u62df\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(367, '云计算', 'yún jìsuàn', 'điện toán đám mây', 6, NULL, 4, '二 (nhị)', '云计算服务。', 'Dịch vụ điện toán đám mây.', '[{\"char\":\"\\u4e91\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u8ba1\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u7b97\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(368, '网络安全', 'wǎngluò ānquán', 'an ninh mạng', 6, NULL, 6, '网 (võng)', '提高网络安全。', 'Nâng cao an ninh mạng.', NULL, '2026-06-12 05:15:36'),
(369, '机器人', 'jīqìrén', 'robot', 6, NULL, 6, '木 (mộc)', '智能机器人。', 'Robot thông minh.', '[{\"char\":\"\\u673a\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u5668\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u4eba\",\"strokes\":2,\"radical\":\"\\u4eba (nh\\u00e2n)\"}]', '2026-06-12 05:15:36'),
(370, '自动驾驶', 'zìdòng jiàshǐ', 'lái xe tự động', 6, NULL, 6, '自 (tự)', '自动驾驶汽车。', 'Xe tự lái.', '[{\"char\":\"\\u81ea\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u52a8\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9a7e\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"\\u9a76\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ai_image_history`
--
ALTER TABLE `ai_image_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `daily_streak`
--
ALTER TABLE `daily_streak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_streak` (`user_id`,`streak_date`);

--
-- Chỉ mục cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_lesson` (`level`,`lesson_num`);

--
-- Chỉ mục cho bảng `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_identifier` (`identifier`),
  ADD KEY `idx_ip` (`ip_address`);

--
-- Chỉ mục cho bảng `notebook`
--
ALTER TABLE `notebook`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_notebook` (`vocab_id`,`user_id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_vocab_progress` (`vocab_id`,`user_id`),
  ADD UNIQUE KEY `unique_lesson_progress` (`lesson_id`,`user_id`);

--
-- Chỉ mục cho bảng `pvp_rooms`
--
ALTER TABLE `pvp_rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_code` (`room_code`);

--
-- Chỉ mục cho bảng `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `radicals`
--
ALTER TABLE `radicals`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `vocab`
--
ALTER TABLE `vocab`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_hanzi_level` (`hanzi`,`level`),
  ADD KEY `idx_lesson` (`lesson_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ai_image_history`
--
ALTER TABLE `ai_image_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `daily_streak`
--
ALTER TABLE `daily_streak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `notebook`
--
ALTER TABLE `notebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `pvp_rooms`
--
ALTER TABLE `pvp_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `radicals`
--
ALTER TABLE `radicals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `vocab`
--
ALTER TABLE `vocab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ai_image_history`
--
ALTER TABLE `ai_image_history`
  ADD CONSTRAINT `ai_image_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notebook`
--
ALTER TABLE `notebook`
  ADD CONSTRAINT `notebook_ibfk_1` FOREIGN KEY (`vocab_id`) REFERENCES `vocab` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
