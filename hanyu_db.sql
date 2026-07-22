-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 21, 2026 lúc 05:49 AM
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

--
-- Đang đổ dữ liệu cho bảng `ai_image_history`
--

INSERT INTO `ai_image_history` (`id`, `user_id`, `image_path`, `detected_text`, `created_at`) VALUES
(1, 4, 'uploads/ai/ai_6a2e425b0a617.jpeg', '', '2026-06-14 05:55:41'),
(2, 4, 'uploads/ai/ai_6a2e43bd39c6c.jpeg', '', '2026-06-14 06:01:36'),
(4, 4, 'uploads/ai/ai_6a2e4532a5dfa.jpeg', '', '2026-06-14 06:07:54'),
(5, 4, 'uploads/ai/ai_6a2e4564ec847.jpeg', '盘山公路摩托车山植被骑手', '2026-06-14 06:08:43'),
(6, 4, 'uploads/ai/ai_6a2e485138816.jpeg', '{\"objects\":[{\"name\":\"Ru\\u1ed9ng b\\u1eadc thang\",\"chinese\":\"\\u68af\\u7530\",\"pinyin\":\"t\\u012bti\\u00e1n\",\"meaning\":\"ru\\u1ed9ng b\\u1eadc thang\",\"confidence\":98},{\"name\":\"N\\u00fai\",\"chinese\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai\",\"confidence\":95},{\"name\":\"B\\u1ea7u tr\\u1eddi\",\"chinese\":\"\\u5929\\u7a7a\",\"pinyin\":\"ti\\u0101nk\\u014dng\",\"meaning\":\"b\\u1ea7u tr\\u1eddi\",\"confidence\":90},{\"name\":\"C\\u00e2y c\\u1ed1i\",\"chinese\":\"\\u6811\\u6728\",\"pinyin\":\"sh\\u00f9m\\u00f9\",\"meaning\":\"c\\u00e2y c\\u1ed1i\",\"confidence\":88},{\"name\":\"T\\u00fap l\\u1ec1u\",\"chinese\":\"\\u5c0f\\u5c4b\",\"pinyin\":\"xi\\u01ceow\\u016b\",\"meaning\":\"nh\\u00e0 nh\\u1ecf\\/t\\u00fap l\\u1ec1u\",\"confidence\":85}],\"results\":[{\"object\":\"Ru\\u1ed9ng b\\u1eadc thang\",\"char\":\"\\u68af\\u7530\",\"pinyin\":\"t\\u012bti\\u00e1n\",\"meaning\":\"ru\\u1ed9ng b\\u1eadc thang\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":98},{\"object\":\"N\\u00fai\",\"char\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":95},{\"object\":\"B\\u1ea7u tr\\u1eddi\",\"char\":\"\\u5929\\u7a7a\",\"pinyin\":\"ti\\u0101nk\\u014dng\",\"meaning\":\"b\\u1ea7u tr\\u1eddi\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":90},{\"object\":\"C\\u00e2y c\\u1ed1i\",\"char\":\"\\u6811\\u6728\",\"pinyin\":\"sh\\u00f9m\\u00f9\",\"meaning\":\"c\\u00e2y c\\u1ed1i\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":88},{\"object\":\"T\\u00fap l\\u1ec1u\",\"char\":\"\\u5c0f\\u5c4b\",\"pinyin\":\"xi\\u01ceow\\u016b\",\"meaning\":\"nh\\u00e0 nh\\u1ecf\\/t\\u00fap l\\u1ec1u\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":85}]}', '2026-06-14 06:21:12'),
(7, 4, 'uploads/ai/ai_6a2e49b9d7501.jpeg', '{\"objects\":[{\"name\":\"C\\u00f4 g\\u00e1i\",\"chinese\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01da h\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"confidence\":98},{\"name\":\"\\u00c1o thun\",\"chinese\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o thun, \\u00e1o ph\\u00f4ng\",\"confidence\":95},{\"name\":\"T\\u00f3c\",\"chinese\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3u fa\",\"meaning\":\"t\\u00f3c\",\"confidence\":95},{\"name\":\"Khu\\u00f4n m\\u1eb7t\",\"chinese\":\"\\u8138\",\"pinyin\":\"li\\u01cen\",\"meaning\":\"m\\u1eb7t, khu\\u00f4n m\\u1eb7t\",\"confidence\":90},{\"name\":\"M\\u1eaft\",\"chinese\":\"\\u773c\\u775b\",\"pinyin\":\"y\\u01cen jing\",\"meaning\":\"m\\u1eaft\",\"confidence\":90}],\"results\":[{\"object\":\"C\\u00f4 g\\u00e1i\",\"char\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01da h\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":98},{\"object\":\"\\u00c1o thun\",\"char\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o thun, \\u00e1o ph\\u00f4ng\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":95},{\"object\":\"T\\u00f3c\",\"char\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3u fa\",\"meaning\":\"t\\u00f3c\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":95},{\"object\":\"Khu\\u00f4n m\\u1eb7t\",\"char\":\"\\u8138\",\"pinyin\":\"li\\u01cen\",\"meaning\":\"m\\u1eb7t, khu\\u00f4n m\\u1eb7t\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":90},{\"object\":\"M\\u1eaft\",\"char\":\"\\u773c\\u775b\",\"pinyin\":\"y\\u01cen jing\",\"meaning\":\"m\\u1eaft\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":90}]}', '2026-06-14 06:27:12'),
(8, 4, 'uploads/ai/ai_6a2e49d46b9e8.jpeg', '{\"objects\":[{\"name\":\"C\\u00f4 g\\u00e1i\",\"chinese\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"confidence\":98},{\"name\":\"\\u00c1o thun tr\\u1eafng\",\"chinese\":\"\\u767dT\\u6064\",\"pinyin\":\"b\\u00e1i T-x\\u00f9\",\"meaning\":\"\\u00e1o ph\\u00f4ng tr\\u1eafng, \\u00e1o thun tr\\u1eafng\",\"confidence\":95},{\"name\":\"T\\u00f3c d\\u00e0i\",\"chinese\":\"\\u957f\\u53d1\",\"pinyin\":\"ch\\u00e1ngf\\u00e0\",\"meaning\":\"t\\u00f3c d\\u00e0i\",\"confidence\":95},{\"name\":\"Khu\\u00f4n m\\u1eb7t\",\"chinese\":\"\\u8138\",\"pinyin\":\"li\\u01cen\",\"meaning\":\"khu\\u00f4n m\\u1eb7t, m\\u1eb7t\",\"confidence\":90}],\"results\":[{\"object\":\"C\\u00f4 g\\u00e1i\",\"char\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":98},{\"object\":\"\\u00c1o thun tr\\u1eafng\",\"char\":\"\\u767dT\\u6064\",\"pinyin\":\"b\\u00e1i T-x\\u00f9\",\"meaning\":\"\\u00e1o ph\\u00f4ng tr\\u1eafng, \\u00e1o thun tr\\u1eafng\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":95},{\"object\":\"T\\u00f3c d\\u00e0i\",\"char\":\"\\u957f\\u53d1\",\"pinyin\":\"ch\\u00e1ngf\\u00e0\",\"meaning\":\"t\\u00f3c d\\u00e0i\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":95},{\"object\":\"Khu\\u00f4n m\\u1eb7t\",\"char\":\"\\u8138\",\"pinyin\":\"li\\u01cen\",\"meaning\":\"khu\\u00f4n m\\u1eb7t, m\\u1eb7t\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":90}]}', '2026-06-14 06:27:38'),
(9, 4, 'uploads/ai/ai_6a2e4a3fbc7cf.jpeg', '{\"objects\":[{\"name\":\"C\\u01a1m t\\u1ea5m\",\"chinese\":\"\\u788e\\u7c73\\u996d\",\"pinyin\":\"su\\u00ecm\\u01d0 f\\u00e0n\",\"meaning\":\"C\\u01a1m t\\u1ea5m\",\"confidence\":98},{\"name\":\"S\\u01b0\\u1eddn n\\u01b0\\u1edbng\",\"chinese\":\"\\u70e4\\u732a\\u6392\",\"pinyin\":\"k\\u01ceo zh\\u016bp\\u00e1i\",\"meaning\":\"S\\u01b0\\u1eddn heo n\\u01b0\\u1edbng\",\"confidence\":95},{\"name\":\"Tr\\u1ee9ng \\u1ed1p la\",\"chinese\":\"\\u714e\\u8377\\u5305\\u86cb\",\"pinyin\":\"ji\\u0101n h\\u00e9b\\u0101od\\u00e0n\",\"meaning\":\"Tr\\u1ee9ng \\u1ed1p la\",\"confidence\":98},{\"name\":\"Ch\\u1ea3 tr\\u1ee9ng\",\"chinese\":\"\\u84b8\\u86cb\\u8089\\u997c\",\"pinyin\":\"zh\\u0113ng d\\u00e0n r\\u00f2ub\\u01d0ng\",\"meaning\":\"Ch\\u1ea3 tr\\u1ee9ng th\\u1ecbt b\\u0103m h\\u1ea5p\",\"confidence\":92},{\"name\":\"N\\u01b0\\u1edbc m\\u1eafm\",\"chinese\":\"\\u9c7c\\u9732\",\"pinyin\":\"y\\u00fal\\u00f9\",\"meaning\":\"N\\u01b0\\u1edbc m\\u1eafm\",\"confidence\":95},{\"name\":\"\\u0110\\u0169a\",\"chinese\":\"\\u7b77\\u5b50\",\"pinyin\":\"ku\\u00e0izi\",\"meaning\":\"\\u0110\\u0169a\",\"confidence\":98},{\"name\":\"T\\u00f3p m\\u1ee1\",\"chinese\":\"\\u732a\\u6cb9\\u6e23\",\"pinyin\":\"zh\\u016by\\u00f3uzh\\u0101\",\"meaning\":\"T\\u00f3p m\\u1ee1\",\"confidence\":90}],\"results\":[{\"object\":\"C\\u01a1m t\\u1ea5m\",\"char\":\"\\u788e\\u7c73\\u996d\",\"pinyin\":\"su\\u00ecm\\u01d0 f\\u00e0n\",\"meaning\":\"C\\u01a1m t\\u1ea5m\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":98},{\"object\":\"S\\u01b0\\u1eddn n\\u01b0\\u1edbng\",\"char\":\"\\u70e4\\u732a\\u6392\",\"pinyin\":\"k\\u01ceo zh\\u016bp\\u00e1i\",\"meaning\":\"S\\u01b0\\u1eddn heo n\\u01b0\\u1edbng\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":95},{\"object\":\"Tr\\u1ee9ng \\u1ed1p la\",\"char\":\"\\u714e\\u8377\\u5305\\u86cb\",\"pinyin\":\"ji\\u0101n h\\u00e9b\\u0101od\\u00e0n\",\"meaning\":\"Tr\\u1ee9ng \\u1ed1p la\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":98},{\"object\":\"Ch\\u1ea3 tr\\u1ee9ng\",\"char\":\"\\u84b8\\u86cb\\u8089\\u997c\",\"pinyin\":\"zh\\u0113ng d\\u00e0n r\\u00f2ub\\u01d0ng\",\"meaning\":\"Ch\\u1ea3 tr\\u1ee9ng th\\u1ecbt b\\u0103m h\\u1ea5p\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":92},{\"object\":\"N\\u01b0\\u1edbc m\\u1eafm\",\"char\":\"\\u9c7c\\u9732\",\"pinyin\":\"y\\u00fal\\u00f9\",\"meaning\":\"N\\u01b0\\u1edbc m\\u1eafm\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":95},{\"object\":\"\\u0110\\u0169a\",\"char\":\"\\u7b77\\u5b50\",\"pinyin\":\"ku\\u00e0izi\",\"meaning\":\"\\u0110\\u0169a\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":98},{\"object\":\"T\\u00f3p m\\u1ee1\",\"char\":\"\\u732a\\u6cb9\\u6e23\",\"pinyin\":\"zh\\u016by\\u00f3uzh\\u0101\",\"meaning\":\"T\\u00f3p m\\u1ee1\",\"strokes\":0,\"radical\":\"\",\"example\":\"\",\"example_vi\":\"\",\"confidence\":90}]}', '2026-06-14 06:29:28'),
(10, 4, 'uploads/ai/ai_6a2e5e278b43e.jpeg', '{\"objects\":[{\"name\":\"Bi\\u1ec3n\",\"chinese\":\"\\u6d77\",\"pinyin\":\"h\\u01cei\",\"meaning\":\"bi\\u1ec3n\",\"stroke_count\":10,\"radical\":\"\\u6c35\",\"example\":\"\\u8fd9\\u91cc\\u7684\\u6d77\\u6c34\\u975e\\u5e38\\u84dd\\u3002\",\"example_vi\":\"N\\u01b0\\u1edbc bi\\u1ec3n \\u1edf \\u0111\\u00e2y c\\u1ef1c k\\u1ef3 xanh.\",\"confidence\":98},{\"name\":\"N\\u00fai\",\"chinese\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai\",\"stroke_count\":3,\"radical\":\"\\u5c71\",\"example\":\"\\u90a3\\u5ea7\\u5c71\\u770b\\u8d77\\u6765\\u5f88\\u9ad8\\u3002\",\"example_vi\":\"Ng\\u1ecdn n\\u00fai kia tr\\u00f4ng r\\u1ea5t cao.\",\"confidence\":95},{\"name\":\"\\u0110\\u00e1\",\"chinese\":\"\\u77f3\",\"pinyin\":\"sh\\u00ed\",\"meaning\":\"\\u0111\\u00e1\",\"stroke_count\":5,\"radical\":\"\\u77f3\",\"example\":\"\\u6d77\\u6ee9\\u4e0a\\u5230\\u5904\\u90fd\\u662f\\u77f3\\u5934\\u3002\",\"example_vi\":\"Tr\\u00ean b\\u00e3i bi\\u1ec3n \\u0111\\u00e2u \\u0111\\u00e2u c\\u0169ng l\\u00e0 \\u0111\\u00e1.\",\"confidence\":95},{\"name\":\"Ng\\u01b0\\u1eddi\",\"chinese\":\"\\u4eba\",\"pinyin\":\"r\\u00e9n\",\"meaning\":\"ng\\u01b0\\u1eddi\",\"stroke_count\":2,\"radical\":\"\\u4eba\",\"example\":\"\\u90a3\\u4e2a\\u4eba\\u6b63\\u5750\\u5728\\u6d77\\u8fb9\\u770b\\u98ce\\u666f\\u3002\",\"example_vi\":\"Ng\\u01b0\\u1eddi \\u0111\\u00f3 \\u0111ang ng\\u1ed3i b\\u00ean b\\u1edd bi\\u1ec3n ng\\u1eafm phong c\\u1ea3nh.\",\"confidence\":92}],\"results\":[{\"object\":\"Bi\\u1ec3n\",\"char\":\"\\u6d77\",\"pinyin\":\"h\\u01cei\",\"meaning\":\"bi\\u1ec3n\",\"strokes\":10,\"radical\":\"\\u6c35\",\"example\":\"\\u8fd9\\u91cc\\u7684\\u6d77\\u6c34\\u975e\\u5e38\\u84dd\\u3002\",\"example_vi\":\"N\\u01b0\\u1edbc bi\\u1ec3n \\u1edf \\u0111\\u00e2y c\\u1ef1c k\\u1ef3 xanh.\",\"confidence\":98},{\"object\":\"N\\u00fai\",\"char\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai\",\"strokes\":3,\"radical\":\"\\u5c71\",\"example\":\"\\u90a3\\u5ea7\\u5c71\\u770b\\u8d77\\u6765\\u5f88\\u9ad8\\u3002\",\"example_vi\":\"Ng\\u1ecdn n\\u00fai kia tr\\u00f4ng r\\u1ea5t cao.\",\"confidence\":95},{\"object\":\"\\u0110\\u00e1\",\"char\":\"\\u77f3\",\"pinyin\":\"sh\\u00ed\",\"meaning\":\"\\u0111\\u00e1\",\"strokes\":5,\"radical\":\"\\u77f3\",\"example\":\"\\u6d77\\u6ee9\\u4e0a\\u5230\\u5904\\u90fd\\u662f\\u77f3\\u5934\\u3002\",\"example_vi\":\"Tr\\u00ean b\\u00e3i bi\\u1ec3n \\u0111\\u00e2u \\u0111\\u00e2u c\\u0169ng l\\u00e0 \\u0111\\u00e1.\",\"confidence\":95},{\"object\":\"Ng\\u01b0\\u1eddi\",\"char\":\"\\u4eba\",\"pinyin\":\"r\\u00e9n\",\"meaning\":\"ng\\u01b0\\u1eddi\",\"strokes\":2,\"radical\":\"\\u4eba\",\"example\":\"\\u90a3\\u4e2a\\u4eba\\u6b63\\u5750\\u5728\\u6d77\\u8fb9\\u770b\\u98ce\\u666f\\u3002\",\"example_vi\":\"Ng\\u01b0\\u1eddi \\u0111\\u00f3 \\u0111ang ng\\u1ed3i b\\u00ean b\\u1edd bi\\u1ec3n ng\\u1eafm phong c\\u1ea3nh.\",\"confidence\":92}]}', '2026-06-14 07:54:25'),
(11, 4, 'uploads/ai/ai_6a2e628301644.jpeg', '{\"objects\":[{\"name\":\"B\\u00e1nh n\\u01b0\\u1edbng\",\"chinese\":\"\\u997c\",\"pinyin\":\"b\\u01d0ng\",\"meaning\":\"b\\u00e1nh, c\\u00e1c lo\\u1ea1i b\\u00e1nh h\\u00ecnh tr\\u00f2n\",\"stroke_count\":9,\"radical\":\"\\u9963\",\"example\":\"\\u6211\\u6bcf\\u5929\\u65e9\\u4e0a\\u90fd\\u5403\\u997c\\u3002\",\"example_vi\":\"T\\u00f4i \\u0103n b\\u00e1nh v\\u00e0o m\\u1ed7i bu\\u1ed5i s\\u00e1ng.\",\"confidence\":98}],\"results\":[{\"object\":\"B\\u00e1nh n\\u01b0\\u1edbng\",\"char\":\"\\u997c\",\"pinyin\":\"b\\u01d0ng\",\"meaning\":\"b\\u00e1nh, c\\u00e1c lo\\u1ea1i b\\u00e1nh h\\u00ecnh tr\\u00f2n\",\"strokes\":9,\"radical\":\"\\u9963\",\"example\":\"\\u6211\\u6bcf\\u5929\\u65e9\\u4e0a\\u90fd\\u5403\\u997c\\u3002\",\"example_vi\":\"T\\u00f4i \\u0103n b\\u00e1nh v\\u00e0o m\\u1ed7i bu\\u1ed5i s\\u00e1ng.\",\"confidence\":98}]}', '2026-06-14 08:12:53'),
(12, 4, 'uploads/ai/ai_6a2e629046afb.jpeg', '{\"objects\":[{\"name\":\"con \\u0111\\u01b0\\u1eddng\",\"chinese\":\"\\u9053\\u8def\",\"pinyin\":\"d\\u00e0ol\\u00f9\",\"meaning\":\"\\u0111\\u01b0\\u1eddng l\\u1ed9, con \\u0111\\u01b0\\u1eddng\",\"stroke_count\":12,\"radical\":\"\\u8fb6\",\"example\":\"\\u8fd9\\u6761\\u9053\\u8def\\u5f88\\u5f2f\\u66f2\\u3002\",\"example_vi\":\"Con \\u0111\\u01b0\\u1eddng n\\u00e0y r\\u1ea5t quanh co.\",\"confidence\":98},{\"name\":\"xe m\\u00e1y\",\"chinese\":\"\\u6469\\u6258\\u8f66\",\"pinyin\":\"m\\u00f3tu\\u014dch\\u0113\",\"meaning\":\"xe m\\u00f4 t\\u00f4, xe m\\u00e1y\",\"stroke_count\":28,\"radical\":\"\\u8f66\",\"example\":\"\\u4ed6\\u4eec\\u9a91\\u7740\\u6469\\u6258\\u8f66\\u53bb\\u65c5\\u884c\\u3002\",\"example_vi\":\"H\\u1ecd l\\u00e1i xe m\\u00e1y \\u0111i du l\\u1ecbch.\",\"confidence\":95},{\"name\":\"n\\u00fai\",\"chinese\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai, \\u0111\\u1ed3i n\\u00fai\",\"stroke_count\":3,\"radical\":\"\\u5c71\",\"example\":\"\\u8fd9\\u5c71\\u4e0a\\u98ce\\u666f\\u5f88\\u7f8e\\u3002\",\"example_vi\":\"Phong c\\u1ea3nh tr\\u00ean n\\u00fai n\\u00e0y r\\u1ea5t \\u0111\\u1eb9p.\",\"confidence\":92}],\"results\":[{\"object\":\"con \\u0111\\u01b0\\u1eddng\",\"char\":\"\\u9053\\u8def\",\"pinyin\":\"d\\u00e0ol\\u00f9\",\"meaning\":\"\\u0111\\u01b0\\u1eddng l\\u1ed9, con \\u0111\\u01b0\\u1eddng\",\"strokes\":12,\"radical\":\"\\u8fb6\",\"example\":\"\\u8fd9\\u6761\\u9053\\u8def\\u5f88\\u5f2f\\u66f2\\u3002\",\"example_vi\":\"Con \\u0111\\u01b0\\u1eddng n\\u00e0y r\\u1ea5t quanh co.\",\"confidence\":98},{\"object\":\"xe m\\u00e1y\",\"char\":\"\\u6469\\u6258\\u8f66\",\"pinyin\":\"m\\u00f3tu\\u014dch\\u0113\",\"meaning\":\"xe m\\u00f4 t\\u00f4, xe m\\u00e1y\",\"strokes\":28,\"radical\":\"\\u8f66\",\"example\":\"\\u4ed6\\u4eec\\u9a91\\u7740\\u6469\\u6258\\u8f66\\u53bb\\u65c5\\u884c\\u3002\",\"example_vi\":\"H\\u1ecd l\\u00e1i xe m\\u00e1y \\u0111i du l\\u1ecbch.\",\"confidence\":95},{\"object\":\"n\\u00fai\",\"char\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai, \\u0111\\u1ed3i n\\u00fai\",\"strokes\":3,\"radical\":\"\\u5c71\",\"example\":\"\\u8fd9\\u5c71\\u4e0a\\u98ce\\u666f\\u5f88\\u7f8e\\u3002\",\"example_vi\":\"Phong c\\u1ea3nh tr\\u00ean n\\u00fai n\\u00e0y r\\u1ea5t \\u0111\\u1eb9p.\",\"confidence\":92}]}', '2026-06-14 08:13:09'),
(13, 4, 'uploads/ai/ai_6a2e62a8dd893.jpeg', '{\"objects\":[{\"name\":\"ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef\",\"chinese\":\"\\u5973\\u4eba\",\"pinyin\":\"n\\u01dar\\u00e9n\",\"meaning\":\"ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef\",\"stroke_count\":5,\"radical\":\"\\u5973\",\"example\":\"\\u5979\\u662f\\u4e00\\u4e2a\\u6f02\\u4eae\\u7684\\u5973\\u4eba\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y l\\u00e0 m\\u1ed9t ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef xinh \\u0111\\u1eb9p.\",\"confidence\":99},{\"name\":\"\\u00e1o ph\\u00f4ng\",\"chinese\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o ph\\u00f4ng, \\u00e1o thun\",\"stroke_count\":6,\"radical\":\"\\u8863\",\"example\":\"\\u6211\\u4eca\\u5929\\u7a7f\\u4e86\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"H\\u00f4m nay t\\u00f4i m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o ph\\u00f4ng tr\\u1eafng.\",\"confidence\":98},{\"name\":\"t\\u00f3c\",\"chinese\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3uf\\u01ce\",\"meaning\":\"t\\u00f3c\",\"stroke_count\":14,\"radical\":\"\\u9adf\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u5f88\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y r\\u1ea5t d\\u00e0i.\",\"confidence\":97}],\"results\":[{\"object\":\"ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef\",\"char\":\"\\u5973\\u4eba\",\"pinyin\":\"n\\u01dar\\u00e9n\",\"meaning\":\"ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef\",\"strokes\":5,\"radical\":\"\\u5973\",\"example\":\"\\u5979\\u662f\\u4e00\\u4e2a\\u6f02\\u4eae\\u7684\\u5973\\u4eba\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y l\\u00e0 m\\u1ed9t ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef xinh \\u0111\\u1eb9p.\",\"confidence\":99},{\"object\":\"\\u00e1o ph\\u00f4ng\",\"char\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o ph\\u00f4ng, \\u00e1o thun\",\"strokes\":6,\"radical\":\"\\u8863\",\"example\":\"\\u6211\\u4eca\\u5929\\u7a7f\\u4e86\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"H\\u00f4m nay t\\u00f4i m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o ph\\u00f4ng tr\\u1eafng.\",\"confidence\":98},{\"object\":\"t\\u00f3c\",\"char\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3uf\\u01ce\",\"meaning\":\"t\\u00f3c\",\"strokes\":14,\"radical\":\"\\u9adf\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u5f88\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y r\\u1ea5t d\\u00e0i.\",\"confidence\":97}]}', '2026-06-14 08:13:32'),
(14, 4, 'uploads/ai/ai_6a2e6343ee3a4.jpeg', '{\"objects\":[{\"name\":\"C\\u00f4 g\\u00e1i\",\"chinese\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"stroke_count\":3,\"radical\":\"\\u5973\",\"example\":\"\\u90a3\\u4e2a\\u5973\\u5b69\\u6b63\\u5728\\u5fae\\u7b11\\u3002\",\"example_vi\":\"C\\u00f4 g\\u00e1i \\u0111\\u00f3 \\u0111ang m\\u1ec9m c\\u01b0\\u1eddi.\",\"confidence\":98},{\"name\":\"\\u00c1o thun\",\"chinese\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o thun, \\u00e1o ph\\u00f4ng\",\"stroke_count\":9,\"radical\":\"\\u5fc4\",\"example\":\"\\u5979\\u7a7f\\u7740\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o thun m\\u00e0u tr\\u1eafng.\",\"confidence\":95},{\"name\":\"T\\u00f3c\",\"chinese\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3ufa\",\"meaning\":\"t\\u00f3c\",\"stroke_count\":5,\"radical\":\"\\u53c8\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u53c8\\u9ed1\\u53c8\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y v\\u1eeba \\u0111en v\\u1eeba d\\u00e0i.\",\"confidence\":95}],\"results\":[{\"object\":\"C\\u00f4 g\\u00e1i\",\"char\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"strokes\":3,\"radical\":\"\\u5973\",\"example\":\"\\u90a3\\u4e2a\\u5973\\u5b69\\u6b63\\u5728\\u5fae\\u7b11\\u3002\",\"example_vi\":\"C\\u00f4 g\\u00e1i \\u0111\\u00f3 \\u0111ang m\\u1ec9m c\\u01b0\\u1eddi.\",\"confidence\":98},{\"object\":\"\\u00c1o thun\",\"char\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o thun, \\u00e1o ph\\u00f4ng\",\"strokes\":9,\"radical\":\"\\u5fc4\",\"example\":\"\\u5979\\u7a7f\\u7740\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o thun m\\u00e0u tr\\u1eafng.\",\"confidence\":95},{\"object\":\"T\\u00f3c\",\"char\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3ufa\",\"meaning\":\"t\\u00f3c\",\"strokes\":5,\"radical\":\"\\u53c8\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u53c8\\u9ed1\\u53c8\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y v\\u1eeba \\u0111en v\\u1eeba d\\u00e0i.\",\"confidence\":95}]}', '2026-06-14 08:16:11'),
(15, 4, 'uploads/ai/ai_6a2e6354c0f46.jpeg', '{\"objects\":[{\"name\":\"c\\u00f4 g\\u00e1i\",\"chinese\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"stroke_count\":12,\"radical\":\"\\u5973\",\"example\":\"\\u90a3\\u4e2a\\u5973\\u5b69\\u5728\\u5fae\\u7b11\\u3002\",\"example_vi\":\"C\\u00f4 g\\u00e1i \\u0111\\u00f3 \\u0111ang m\\u1ec9m c\\u01b0\\u1eddi.\",\"confidence\":95},{\"name\":\"\\u00e1o thun\",\"chinese\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o thun, \\u00e1o ph\\u00f4ng\",\"stroke_count\":9,\"radical\":\"\\u5fc4\",\"example\":\"\\u5979\\u7a7f\\u7740\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y \\u0111ang m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o thun m\\u00e0u tr\\u1eafng.\",\"confidence\":95},{\"name\":\"t\\u00f3c\",\"chinese\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3ufa\",\"meaning\":\"t\\u00f3c\",\"stroke_count\":10,\"radical\":\"\\u5927\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u5f88\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y r\\u1ea5t d\\u00e0i.\",\"confidence\":90}],\"results\":[{\"object\":\"c\\u00f4 g\\u00e1i\",\"char\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"strokes\":12,\"radical\":\"\\u5973\",\"example\":\"\\u90a3\\u4e2a\\u5973\\u5b69\\u5728\\u5fae\\u7b11\\u3002\",\"example_vi\":\"C\\u00f4 g\\u00e1i \\u0111\\u00f3 \\u0111ang m\\u1ec9m c\\u01b0\\u1eddi.\",\"confidence\":95},{\"object\":\"\\u00e1o thun\",\"char\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00e1o thun, \\u00e1o ph\\u00f4ng\",\"strokes\":9,\"radical\":\"\\u5fc4\",\"example\":\"\\u5979\\u7a7f\\u7740\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y \\u0111ang m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o thun m\\u00e0u tr\\u1eafng.\",\"confidence\":95},{\"object\":\"t\\u00f3c\",\"char\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3ufa\",\"meaning\":\"t\\u00f3c\",\"strokes\":10,\"radical\":\"\\u5927\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u5f88\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y r\\u1ea5t d\\u00e0i.\",\"confidence\":90}]}', '2026-06-14 08:16:29'),
(16, 4, 'uploads/ai/ai_6a2e640d26934.jpeg', '{\"objects\":[{\"name\":\"C\\u00f4 g\\u00e1i\",\"chinese\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"Con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"stroke_count\":3,\"radical\":\"\\u5973\",\"example\":\"\\u90a3\\u4e2a\\u5973\\u5b69\\u5f88\\u6f02\\u4eae\\u3002\",\"example_vi\":\"C\\u00f4 g\\u00e1i \\u0111\\u00f3 r\\u1ea5t xinh \\u0111\\u1eb9p\\u3002\",\"confidence\":95},{\"name\":\"T\\u00f3c\",\"chinese\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3ufa\",\"meaning\":\"T\\u00f3c\",\"stroke_count\":5,\"radical\":\"\\u5927\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u5f88\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y r\\u1ea5t d\\u00e0i\\u3002\",\"confidence\":90},{\"name\":\"\\u00c1o thun\",\"chinese\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00c1o thun, \\u00e1o ph\\u00f4ng\",\"stroke_count\":9,\"radical\":\"\\u5fc4\",\"example\":\"\\u5979\\u7a7f\\u7740\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y \\u0111ang m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o thun m\\u00e0u tr\\u1eafng\\u3002\",\"confidence\":92}],\"results\":[{\"object\":\"C\\u00f4 g\\u00e1i\",\"char\":\"\\u5973\\u5b69\",\"pinyin\":\"n\\u01dah\\u00e1i\",\"meaning\":\"Con g\\u00e1i, c\\u00f4 g\\u00e1i\",\"strokes\":3,\"radical\":\"\\u5973\",\"example\":\"\\u90a3\\u4e2a\\u5973\\u5b69\\u5f88\\u6f02\\u4eae\\u3002\",\"example_vi\":\"C\\u00f4 g\\u00e1i \\u0111\\u00f3 r\\u1ea5t xinh \\u0111\\u1eb9p\\u3002\",\"confidence\":95},{\"object\":\"T\\u00f3c\",\"char\":\"\\u5934\\u53d1\",\"pinyin\":\"t\\u00f3ufa\",\"meaning\":\"T\\u00f3c\",\"strokes\":5,\"radical\":\"\\u5927\",\"example\":\"\\u5979\\u7684\\u5934\\u53d1\\u5f88\\u957f\\u3002\",\"example_vi\":\"T\\u00f3c c\\u1ee7a c\\u00f4 \\u1ea5y r\\u1ea5t d\\u00e0i\\u3002\",\"confidence\":90},{\"object\":\"\\u00c1o thun\",\"char\":\"T\\u6064\",\"pinyin\":\"T-x\\u00f9\",\"meaning\":\"\\u00c1o thun, \\u00e1o ph\\u00f4ng\",\"strokes\":9,\"radical\":\"\\u5fc4\",\"example\":\"\\u5979\\u7a7f\\u7740\\u4e00\\u4ef6\\u767d\\u8272\\u7684T\\u6064\\u3002\",\"example_vi\":\"C\\u00f4 \\u1ea5y \\u0111ang m\\u1eb7c m\\u1ed9t chi\\u1ebfc \\u00e1o thun m\\u00e0u tr\\u1eafng\\u3002\",\"confidence\":92}]}', '2026-06-14 08:19:36'),
(17, 3, 'uploads/ai/ai_6a2ebb2ef32c2.jpeg', '{\"objects\":[{\"name\":\"Th\\u1ecbt b\\u00f2 kh\\u00f4\",\"chinese\":\"\\u725b\\u8089\\u5e72\",\"pinyin\":\"ni\\u00far\\u00f2ug\\u0101n\",\"meaning\":\"Th\\u1ecbt b\\u00f2 kh\\u00f4\",\"stroke_count\":13,\"radical\":\"\\u725b\",\"example\":\"\\u6211\\u559c\\u6b22\\u5403\\u725b\\u8089\\u5e72\\u3002\",\"example_vi\":\"T\\u00f4i th\\u00edch \\u0103n th\\u1ecbt b\\u00f2 kh\\u00f4.\",\"confidence\":95},{\"name\":\"Rau x\\u00e0 l\\u00e1ch\",\"chinese\":\"\\u751f\\u83dc\",\"pinyin\":\"sh\\u0113ngc\\u00e0i\",\"meaning\":\"Rau x\\u00e0 l\\u00e1ch\",\"stroke_count\":16,\"radical\":\"\\u8279\",\"example\":\"\\u8fd9\\u76d8\\u8089\\u4e0b\\u9762\\u57ab\\u4e86\\u751f\\u83dc\\u3002\",\"example_vi\":\"D\\u01b0\\u1edbi \\u0111\\u0129a th\\u1ecbt n\\u00e0y \\u0111\\u01b0\\u1ee3c l\\u00f3t rau x\\u00e0 l\\u00e1ch.\",\"confidence\":90},{\"name\":\"N\\u01b0\\u1edbc ch\\u1ea5m\",\"chinese\":\"\\u8638\\u6599\",\"pinyin\":\"zh\\u00e0nli\\u00e0o\",\"meaning\":\"Gia v\\u1ecb ch\\u1ea5m, n\\u01b0\\u1edbc ch\\u1ea5m\",\"stroke_count\":32,\"radical\":\"\\u8279\",\"example\":\"\\u8fd9\\u79cd\\u725b\\u8089\\u5e72\\u914d\\u4e0a\\u7279\\u5236\\u7684\\u8638\\u6599\\u975e\\u5e38\\u597d\\u5403\\u3002\",\"example_vi\":\"Lo\\u1ea1i th\\u1ecbt b\\u00f2 kh\\u00f4 n\\u00e0y k\\u00e8m v\\u1edbi n\\u01b0\\u1edbc ch\\u1ea5m \\u0111\\u1eb7c ch\\u1ebf r\\u1ea5t ngon.\",\"confidence\":85}],\"results\":[{\"object\":\"Th\\u1ecbt b\\u00f2 kh\\u00f4\",\"char\":\"\\u725b\\u8089\\u5e72\",\"pinyin\":\"ni\\u00far\\u00f2ug\\u0101n\",\"meaning\":\"Th\\u1ecbt b\\u00f2 kh\\u00f4\",\"strokes\":13,\"radical\":\"\\u725b\",\"example\":\"\\u6211\\u559c\\u6b22\\u5403\\u725b\\u8089\\u5e72\\u3002\",\"example_vi\":\"T\\u00f4i th\\u00edch \\u0103n th\\u1ecbt b\\u00f2 kh\\u00f4.\",\"confidence\":95},{\"object\":\"Rau x\\u00e0 l\\u00e1ch\",\"char\":\"\\u751f\\u83dc\",\"pinyin\":\"sh\\u0113ngc\\u00e0i\",\"meaning\":\"Rau x\\u00e0 l\\u00e1ch\",\"strokes\":16,\"radical\":\"\\u8279\",\"example\":\"\\u8fd9\\u76d8\\u8089\\u4e0b\\u9762\\u57ab\\u4e86\\u751f\\u83dc\\u3002\",\"example_vi\":\"D\\u01b0\\u1edbi \\u0111\\u0129a th\\u1ecbt n\\u00e0y \\u0111\\u01b0\\u1ee3c l\\u00f3t rau x\\u00e0 l\\u00e1ch.\",\"confidence\":90},{\"object\":\"N\\u01b0\\u1edbc ch\\u1ea5m\",\"char\":\"\\u8638\\u6599\",\"pinyin\":\"zh\\u00e0nli\\u00e0o\",\"meaning\":\"Gia v\\u1ecb ch\\u1ea5m, n\\u01b0\\u1edbc ch\\u1ea5m\",\"strokes\":32,\"radical\":\"\\u8279\",\"example\":\"\\u8fd9\\u79cd\\u725b\\u8089\\u5e72\\u914d\\u4e0a\\u7279\\u5236\\u7684\\u8638\\u6599\\u975e\\u5e38\\u597d\\u5403\\u3002\",\"example_vi\":\"Lo\\u1ea1i th\\u1ecbt b\\u00f2 kh\\u00f4 n\\u00e0y k\\u00e8m v\\u1edbi n\\u01b0\\u1edbc ch\\u1ea5m \\u0111\\u1eb7c ch\\u1ebf r\\u1ea5t ngon.\",\"confidence\":85}]}', '2026-06-14 14:31:19'),
(18, 3, 'uploads/ai/ai_6a2f9445d422c.jpeg', '{\"objects\":[{\"name\":\"Ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef\",\"chinese\":\"\\u5973\\u4eba\",\"pinyin\":\"n\\u01da r\\u00e9n\",\"meaning\":\"Ph\\u1ee5 n\\u1eef, \\u0111\\u00e0n b\\u00e0\",\"stroke_count\":3,\"radical\":\"\\u5973\",\"example\":\"\\u7167\\u7247\\u91cc\\u6709\\u4e00\\u4e2a\\u6f02\\u4eae\\u7684\\u5973\\u4eba\\u3002\",\"example_vi\":\"Trong \\u1ea3nh c\\u00f3 m\\u1ed9t ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef xinh \\u0111\\u1eb9p.\",\"confidence\":95},{\"name\":\"Bi\\u1ec3n\",\"chinese\":\"\\u5927\\u6d77\",\"pinyin\":\"d\\u00e0 h\\u01cei\",\"meaning\":\"Bi\\u1ec3n l\\u1edbn, \\u0111\\u1ea1i d\\u01b0\\u01a1ng\",\"stroke_count\":10,\"radical\":\"\\u6c35\",\"example\":\"\\u6d77\\u6c34\\u975e\\u5e38\\u84dd\\u3002\",\"example_vi\":\"N\\u01b0\\u1edbc bi\\u1ec3n c\\u1ef1c k\\u1ef3 xanh.\",\"confidence\":90},{\"name\":\"H\\u00f2n \\u0111\\u1ea3o\",\"chinese\":\"\\u5c9b\",\"pinyin\":\"d\\u01ceo\",\"meaning\":\"H\\u00f2n \\u0111\\u1ea3o\",\"stroke_count\":7,\"radical\":\"\\u5c71\",\"example\":\"\\u8fdc\\u5904\\u6709\\u4e00\\u5ea7\\u7f8e\\u4e3d\\u7684\\u5c0f\\u5c9b\\u3002\",\"example_vi\":\"Ph\\u00eda xa c\\u00f3 m\\u1ed9t h\\u00f2n \\u0111\\u1ea3o nh\\u1ecf xinh \\u0111\\u1eb9p.\",\"confidence\":85}],\"results\":[{\"object\":\"Ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef\",\"char\":\"\\u5973\\u4eba\",\"pinyin\":\"n\\u01da r\\u00e9n\",\"meaning\":\"Ph\\u1ee5 n\\u1eef, \\u0111\\u00e0n b\\u00e0\",\"strokes\":3,\"radical\":\"\\u5973\",\"example\":\"\\u7167\\u7247\\u91cc\\u6709\\u4e00\\u4e2a\\u6f02\\u4eae\\u7684\\u5973\\u4eba\\u3002\",\"example_vi\":\"Trong \\u1ea3nh c\\u00f3 m\\u1ed9t ng\\u01b0\\u1eddi ph\\u1ee5 n\\u1eef xinh \\u0111\\u1eb9p.\",\"confidence\":95},{\"object\":\"Bi\\u1ec3n\",\"char\":\"\\u5927\\u6d77\",\"pinyin\":\"d\\u00e0 h\\u01cei\",\"meaning\":\"Bi\\u1ec3n l\\u1edbn, \\u0111\\u1ea1i d\\u01b0\\u01a1ng\",\"strokes\":10,\"radical\":\"\\u6c35\",\"example\":\"\\u6d77\\u6c34\\u975e\\u5e38\\u84dd\\u3002\",\"example_vi\":\"N\\u01b0\\u1edbc bi\\u1ec3n c\\u1ef1c k\\u1ef3 xanh.\",\"confidence\":90},{\"object\":\"H\\u00f2n \\u0111\\u1ea3o\",\"char\":\"\\u5c9b\",\"pinyin\":\"d\\u01ceo\",\"meaning\":\"H\\u00f2n \\u0111\\u1ea3o\",\"strokes\":7,\"radical\":\"\\u5c71\",\"example\":\"\\u8fdc\\u5904\\u6709\\u4e00\\u5ea7\\u7f8e\\u4e3d\\u7684\\u5c0f\\u5c9b\\u3002\",\"example_vi\":\"Ph\\u00eda xa c\\u00f3 m\\u1ed9t h\\u00f2n \\u0111\\u1ea3o nh\\u1ecf xinh \\u0111\\u1eb9p.\",\"confidence\":85}]}', '2026-06-15 05:57:34'),
(19, 4, 'uploads/ai/ai_6a37992cc5cc2.jpeg', '{\"objects\":[{\"name\":\"Bi\\u1ec3n\",\"chinese\":\"\\u6d77\",\"pinyin\":\"h\\u01cei\",\"meaning\":\"bi\\u1ec3n\",\"stroke_count\":10,\"radical\":\"\\u6c35\",\"example\":\"\\u8fd9\\u91cc\\u7684\\u6d77\\u6c34\\u975e\\u5e38\\u84dd\\u3002\",\"example_vi\":\"N\\u01b0\\u1edbc bi\\u1ec3n \\u1edf \\u0111\\u00e2y r\\u1ea5t xanh.\",\"confidence\":95},{\"name\":\"\\u0110\\u00e1\",\"chinese\":\"\\u77f3\\u5934\",\"pinyin\":\"sh\\u00edtou\",\"meaning\":\"h\\u00f2n \\u0111\\u00e1\",\"stroke_count\":5,\"radical\":\"\\u77f3\",\"example\":\"\\u6d77\\u6ee9\\u4e0a\\u6709\\u5f88\\u591a\\u77f3\\u5934\\u3002\",\"example_vi\":\"Tr\\u00ean b\\u00e3i bi\\u1ec3n c\\u00f3 r\\u1ea5t nhi\\u1ec1u \\u0111\\u00e1.\",\"confidence\":90},{\"name\":\"N\\u00fai\",\"chinese\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai\",\"stroke_count\":3,\"radical\":\"\\u5c71\",\"example\":\"\\u8fdc\\u5904\\u6709\\u4e00\\u5ea7\\u9ad8\\u5c71\\u3002\",\"example_vi\":\"Ph\\u00eda xa c\\u00f3 m\\u1ed9t ng\\u1ecdn n\\u00fai cao.\",\"confidence\":95},{\"name\":\"Du kh\\u00e1ch\",\"chinese\":\"\\u6e38\\u5ba2\",\"pinyin\":\"y\\u00f3uk\\u00e8\",\"meaning\":\"du kh\\u00e1ch\",\"stroke_count\":12,\"radical\":\"\\u6c35\",\"example\":\"\\u6e38\\u5ba2\\u5750\\u5728\\u77f3\\u5934\\u4e0a\\u6b23\\u8d4f\\u98ce\\u666f\\u3002\",\"example_vi\":\"Du kh\\u00e1ch ng\\u1ed3i tr\\u00ean t\\u1ea3ng \\u0111\\u00e1 ng\\u1eafm phong c\\u1ea3nh.\",\"confidence\":85}],\"results\":[{\"object\":\"Bi\\u1ec3n\",\"char\":\"\\u6d77\",\"pinyin\":\"h\\u01cei\",\"meaning\":\"bi\\u1ec3n\",\"strokes\":10,\"radical\":\"\\u6c35\",\"example\":\"\\u8fd9\\u91cc\\u7684\\u6d77\\u6c34\\u975e\\u5e38\\u84dd\\u3002\",\"example_vi\":\"N\\u01b0\\u1edbc bi\\u1ec3n \\u1edf \\u0111\\u00e2y r\\u1ea5t xanh.\",\"confidence\":95},{\"object\":\"\\u0110\\u00e1\",\"char\":\"\\u77f3\\u5934\",\"pinyin\":\"sh\\u00edtou\",\"meaning\":\"h\\u00f2n \\u0111\\u00e1\",\"strokes\":5,\"radical\":\"\\u77f3\",\"example\":\"\\u6d77\\u6ee9\\u4e0a\\u6709\\u5f88\\u591a\\u77f3\\u5934\\u3002\",\"example_vi\":\"Tr\\u00ean b\\u00e3i bi\\u1ec3n c\\u00f3 r\\u1ea5t nhi\\u1ec1u \\u0111\\u00e1.\",\"confidence\":90},{\"object\":\"N\\u00fai\",\"char\":\"\\u5c71\",\"pinyin\":\"sh\\u0101n\",\"meaning\":\"n\\u00fai\",\"strokes\":3,\"radical\":\"\\u5c71\",\"example\":\"\\u8fdc\\u5904\\u6709\\u4e00\\u5ea7\\u9ad8\\u5c71\\u3002\",\"example_vi\":\"Ph\\u00eda xa c\\u00f3 m\\u1ed9t ng\\u1ecdn n\\u00fai cao.\",\"confidence\":95},{\"object\":\"Du kh\\u00e1ch\",\"char\":\"\\u6e38\\u5ba2\",\"pinyin\":\"y\\u00f3uk\\u00e8\",\"meaning\":\"du kh\\u00e1ch\",\"strokes\":12,\"radical\":\"\\u6c35\",\"example\":\"\\u6e38\\u5ba2\\u5750\\u5728\\u77f3\\u5934\\u4e0a\\u6b23\\u8d4f\\u98ce\\u666f\\u3002\",\"example_vi\":\"Du kh\\u00e1ch ng\\u1ed3i tr\\u00ean t\\u1ea3ng \\u0111\\u00e1 ng\\u1eafm phong c\\u1ea3nh.\",\"confidence\":85}]}', '2026-06-21 07:56:37'),
(20, 4, 'uploads/ai/ai_6a5e6d576c799.png', '{\"objects\":[{\"name\":\"g\\u1ea5u tr\\u00fac\",\"chinese\":\"\\u718a\\u732b\",\"pinyin\":\"xi\\u00f3ngm\\u0101o\",\"meaning\":\"g\\u1ea5u tr\\u00fac\",\"stroke_count\":14,\"radical\":\"\\u706c\",\"example\":\"\\u5927\\u718a\\u732b\\u662f\\u4e2d\\u56fd\\u7684\\u56fd\\u5b9d\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac l\\u1edbn l\\u00e0 qu\\u1ed1c b\\u1ea3o c\\u1ee7a Trung Qu\\u1ed1c.\",\"confidence\":98},{\"name\":\"quy\\u1ec3n s\\u00e1ch\",\"chinese\":\"\\u4e66\",\"pinyin\":\"sh\\u016b\",\"meaning\":\"s\\u00e1ch\",\"stroke_count\":4,\"radical\":\"\\u4e28\",\"example\":\"\\u718a\\u732b\\u6b63\\u5728\\u4e66\\u4e0a\\u5199\\u5b57\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac \\u0111ang vi\\u1ebft ch\\u1eef l\\u00ean s\\u00e1ch.\",\"confidence\":95},{\"name\":\"c\\u00e1i b\\u00e0n\",\"chinese\":\"\\u684c\\u5b50\",\"pinyin\":\"zhu\\u014dzi\",\"meaning\":\"c\\u00e1i b\\u00e0n\",\"stroke_count\":10,\"radical\":\"\\u6728\",\"example\":\"\\u8fd9\\u53ea\\u718a\\u732b\\u5750\\u5728\\u684c\\u5b50\\u524d\\u3002\",\"example_vi\":\"Ch\\u00fa g\\u1ea5u tr\\u00fac n\\u00e0y \\u0111ang ng\\u1ed3i tr\\u01b0\\u1edbc b\\u00e0n.\",\"confidence\":92},{\"name\":\"b\\u00fat\",\"chinese\":\"\\u7b14\",\"pinyin\":\"b\\u01d0\",\"meaning\":\"b\\u00fat\",\"stroke_count\":10,\"radical\":\"\\u2eae\",\"example\":\"\\u718a\\u732b\\u7528\\u624b\\u62ff\\u7740\\u4e00\\u652f\\u7b14\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac d\\u00f9ng tay c\\u1ea7m m\\u1ed9t c\\u00e2y b\\u00fat.\",\"confidence\":90}],\"results\":[{\"object\":\"g\\u1ea5u tr\\u00fac\",\"char\":\"\\u718a\\u732b\",\"pinyin\":\"xi\\u00f3ngm\\u0101o\",\"meaning\":\"g\\u1ea5u tr\\u00fac\",\"strokes\":14,\"radical\":\"\\u706c\",\"example\":\"\\u5927\\u718a\\u732b\\u662f\\u4e2d\\u56fd\\u7684\\u56fd\\u5b9d\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac l\\u1edbn l\\u00e0 qu\\u1ed1c b\\u1ea3o c\\u1ee7a Trung Qu\\u1ed1c.\",\"confidence\":98},{\"object\":\"quy\\u1ec3n s\\u00e1ch\",\"char\":\"\\u4e66\",\"pinyin\":\"sh\\u016b\",\"meaning\":\"s\\u00e1ch\",\"strokes\":4,\"radical\":\"\\u4e28\",\"example\":\"\\u718a\\u732b\\u6b63\\u5728\\u4e66\\u4e0a\\u5199\\u5b57\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac \\u0111ang vi\\u1ebft ch\\u1eef l\\u00ean s\\u00e1ch.\",\"confidence\":95},{\"object\":\"c\\u00e1i b\\u00e0n\",\"char\":\"\\u684c\\u5b50\",\"pinyin\":\"zhu\\u014dzi\",\"meaning\":\"c\\u00e1i b\\u00e0n\",\"strokes\":10,\"radical\":\"\\u6728\",\"example\":\"\\u8fd9\\u53ea\\u718a\\u732b\\u5750\\u5728\\u684c\\u5b50\\u524d\\u3002\",\"example_vi\":\"Ch\\u00fa g\\u1ea5u tr\\u00fac n\\u00e0y \\u0111ang ng\\u1ed3i tr\\u01b0\\u1edbc b\\u00e0n.\",\"confidence\":92},{\"object\":\"b\\u00fat\",\"char\":\"\\u7b14\",\"pinyin\":\"b\\u01d0\",\"meaning\":\"b\\u00fat\",\"strokes\":10,\"radical\":\"\\u2eae\",\"example\":\"\\u718a\\u732b\\u7528\\u624b\\u62ff\\u7740\\u4e00\\u652f\\u7b14\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac d\\u00f9ng tay c\\u1ea7m m\\u1ed9t c\\u00e2y b\\u00fat.\",\"confidence\":90}]}', '2026-07-20 18:48:15'),
(21, 4, 'uploads/ai/ai_6a5edec15bd92.png', '{\"objects\":[{\"name\":\"G\\u1ea5u tr\\u00fac\",\"chinese\":\"\\u718a\\u732b\",\"pinyin\":\"xi\\u00f3ngm\\u0101o\",\"meaning\":\"G\\u1ea5u tr\\u00fac\",\"stroke_count\":25,\"radical\":\"\\u72ad\",\"example\":\"\\u5927\\u718a\\u732b\\u662f\\u4e2d\\u56fd\\u56fd\\u5b9d\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac l\\u1edbn l\\u00e0 qu\\u1ed1c b\\u1ea3o c\\u1ee7a Trung Qu\\u1ed1c.\",\"confidence\":98},{\"name\":\"B\\u00e0n h\\u1ecdc\",\"chinese\":\"\\u4e66\\u684c\",\"pinyin\":\"sh\\u016bzhu\\u014d\",\"meaning\":\"B\\u00e0n h\\u1ecdc, b\\u00e0n l\\u00e0m vi\\u1ec7c\",\"stroke_count\":14,\"radical\":\"\\u6728\",\"example\":\"\\u718a\\u732b\\u5750\\u5728\\u4e66\\u684c\\u65c1\\u5199\\u5b57\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac ng\\u1ed3i b\\u00ean b\\u00e0n h\\u1ecdc vi\\u1ebft ch\\u1eef.\",\"confidence\":95},{\"name\":\"Quy\\u1ec3n s\\u00e1ch\",\"chinese\":\"\\u4e66\",\"pinyin\":\"sh\\u016b\",\"meaning\":\"S\\u00e1ch\",\"stroke_count\":4,\"radical\":\"\\u4e5b\",\"example\":\"\\u684c\\u5b50\\u4e0a\\u6709\\u4e00\\u672c\\u6253\\u5f00\\u7684\\u4e66\\u3002\",\"example_vi\":\"Tr\\u00ean b\\u00e0n c\\u00f3 m\\u1ed9t cu\\u1ed1n s\\u00e1ch \\u0111ang m\\u1edf.\",\"confidence\":95},{\"name\":\"B\\u00fat ch\\u00ec\",\"chinese\":\"\\u94c5\\u7b14\",\"pinyin\":\"qi\\u0101nb\\u01d0\",\"meaning\":\"B\\u00fat ch\\u00ec\",\"stroke_count\":20,\"radical\":\"\\u7af9\",\"example\":\"\\u718a\\u732b\\u624b\\u91cc\\u62ff\\u7740\\u4e00\\u652f\\u94c5\\u7b14\\u5728\\u5199\\u5b57\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac c\\u1ea7m m\\u1ed9t chi\\u1ebfc b\\u00fat ch\\u00ec \\u0111\\u1ec3 vi\\u1ebft ch\\u1eef.\",\"confidence\":90}],\"results\":[{\"object\":\"G\\u1ea5u tr\\u00fac\",\"char\":\"\\u718a\\u732b\",\"pinyin\":\"xi\\u00f3ngm\\u0101o\",\"meaning\":\"G\\u1ea5u tr\\u00fac\",\"strokes\":25,\"radical\":\"\\u72ad\",\"example\":\"\\u5927\\u718a\\u732b\\u662f\\u4e2d\\u56fd\\u56fd\\u5b9d\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac l\\u1edbn l\\u00e0 qu\\u1ed1c b\\u1ea3o c\\u1ee7a Trung Qu\\u1ed1c.\",\"confidence\":98},{\"object\":\"B\\u00e0n h\\u1ecdc\",\"char\":\"\\u4e66\\u684c\",\"pinyin\":\"sh\\u016bzhu\\u014d\",\"meaning\":\"B\\u00e0n h\\u1ecdc, b\\u00e0n l\\u00e0m vi\\u1ec7c\",\"strokes\":14,\"radical\":\"\\u6728\",\"example\":\"\\u718a\\u732b\\u5750\\u5728\\u4e66\\u684c\\u65c1\\u5199\\u5b57\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac ng\\u1ed3i b\\u00ean b\\u00e0n h\\u1ecdc vi\\u1ebft ch\\u1eef.\",\"confidence\":95},{\"object\":\"Quy\\u1ec3n s\\u00e1ch\",\"char\":\"\\u4e66\",\"pinyin\":\"sh\\u016b\",\"meaning\":\"S\\u00e1ch\",\"strokes\":4,\"radical\":\"\\u4e5b\",\"example\":\"\\u684c\\u5b50\\u4e0a\\u6709\\u4e00\\u672c\\u6253\\u5f00\\u7684\\u4e66\\u3002\",\"example_vi\":\"Tr\\u00ean b\\u00e0n c\\u00f3 m\\u1ed9t cu\\u1ed1n s\\u00e1ch \\u0111ang m\\u1edf.\",\"confidence\":95},{\"object\":\"B\\u00fat ch\\u00ec\",\"char\":\"\\u94c5\\u7b14\",\"pinyin\":\"qi\\u0101nb\\u01d0\",\"meaning\":\"B\\u00fat ch\\u00ec\",\"strokes\":20,\"radical\":\"\\u7af9\",\"example\":\"\\u718a\\u732b\\u624b\\u91cc\\u62ff\\u7740\\u4e00\\u652f\\u94c5\\u7b14\\u5728\\u5199\\u5b57\\u3002\",\"example_vi\":\"G\\u1ea5u tr\\u00fac c\\u1ea7m m\\u1ed9t chi\\u1ebfc b\\u00fat ch\\u00ec \\u0111\\u1ec3 vi\\u1ebft ch\\u1eef.\",\"confidence\":90}]}', '2026-07-21 02:52:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `author` varchar(100) DEFAULT 'Ẩn danh',
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `post_id`, `user_id`, `author`, `content`, `created_at`) VALUES
(1, NULL, 2, 'default_user', 'Administrator', 'alo', '2026-06-14 10:29:15'),
(2, NULL, 2, 'default_user', 'Administrator', 'alo', '2026-06-14 10:29:19'),
(3, NULL, 1, 'default_user', 'Hungmanhlp', 'alo', '2026-07-21 03:12:35'),
(4, 1, 2, 'user_4', 'Hungmanhlp', 'j', '2026-07-21 03:19:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,0) NOT NULL DEFAULT 0,
  `thumbnail` varchar(500) DEFAULT NULL,
  `hsk_level` tinyint(4) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `short_description`, `description`, `price`, `thumbnail`, `hsk_level`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'HSK 1 - Nen tang tieng Trung', 'hsk-1-nen-tang', 'Danh cho nguoi moi bat dau: Pinyin, tu vung va hoi thoai co ban.', NULL, 1490000, NULL, 1, 1, '2026-07-20 15:20:46', '2026-07-20 15:20:46'),
(2, 'HSK 2 - Giao tiep co ban', 'hsk-2-giao-tiep', 'Mo rong von tu va phan xa giao tiep tieng Trung hang ngay.', NULL, 1790000, NULL, 2, 1, '2026-07-20 15:20:46', '2026-07-20 15:20:46'),
(3, 'HSK 3 - So cap nang cao', 'hsk-3-so-cap', 'Cung co ngu phap, nghe doc va chuan bi thi HSK 3.', NULL, 2190000, NULL, 3, 1, '2026-07-20 15:20:46', '2026-07-20 15:20:46'),
(4, 'HSK 4 - Trung cap', 'hsk-4-trung-cap', 'Phat trien giao tiep, doc hieu va luyen thi HSK 4.', NULL, 2790000, NULL, 4, 1, '2026-07-20 15:20:46', '2026-07-20 15:20:46'),
(5, 'HSK 5 - Nang cao', 'hsk-5-nang-cao', 'Tang toc tu vung, ky nang doc viet va de thi chuyen sau.', NULL, 3490000, NULL, 5, 1, '2026-07-20 15:20:46', '2026-07-20 15:20:46'),
(6, 'HSK 6 - Chuyen sau', 'hsk-6-chuyen-sau', 'Lo trinh chinh phuc HSK 6 danh cho nguoi hoc trinh do cao.', NULL, 2000, NULL, 6, 1, '2026-07-20 15:20:46', '2026-07-20 15:53:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_lessons`
--

CREATE TABLE `course_lessons` (
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `course_lessons`
--

INSERT INTO `course_lessons` (`course_id`, `lesson_id`, `sort_order`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(1, 5, 5),
(1, 6, 6),
(1, 7, 7),
(1, 8, 8),
(2, 9, 9),
(2, 10, 10),
(2, 11, 11),
(2, 12, 12),
(2, 13, 13),
(2, 14, 14),
(2, 15, 15),
(3, 16, 16),
(3, 17, 17),
(3, 18, 18),
(3, 19, 19),
(3, 20, 20),
(4, 21, 1),
(4, 22, 2),
(4, 23, 3),
(4, 24, 4),
(4, 25, 5),
(4, 26, 6),
(4, 27, 7),
(4, 28, 8),
(4, 29, 9),
(4, 30, 10),
(5, 31, 1),
(5, 32, 2),
(5, 33, 3),
(5, 34, 4),
(5, 35, 5),
(5, 36, 6),
(5, 37, 7),
(5, 38, 8),
(5, 39, 9),
(5, 40, 10),
(6, 41, 1),
(6, 42, 2),
(6, 43, 3),
(6, 44, 4),
(6, 45, 5),
(6, 46, 6),
(6, 47, 7),
(6, 48, 8),
(6, 49, 9),
(6, 50, 10);

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
(1, 'user_3', '2026-06-12'),
(3, 'user_3', '2026-06-14'),
(5, 'user_3', '2026-06-24'),
(2, 'user_4', '2026-06-12'),
(4, 'user_4', '2026-06-14'),
(6, 'user_4', '2026-07-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(40) NOT NULL,
  `order_id` int(11) NOT NULL,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email_sent_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'test', '::1', '2026-06-12 09:12:48'),
(2, 'hungmanhlp', '::1', '2026-06-12 10:13:50'),
(6, 'hungmanhlp', '::1', '2026-06-21 07:23:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notebook`
--

CREATE TABLE `notebook` (
  `id` int(11) NOT NULL,
  `vocab_id` int(11) DEFAULT NULL,
  `custom_hanzi` varchar(20) DEFAULT NULL,
  `custom_pinyin` varchar(50) DEFAULT NULL,
  `custom_meaning` text DEFAULT NULL,
  `custom_strokes` int(11) DEFAULT NULL,
  `custom_radical` varchar(20) DEFAULT NULL,
  `custom_example` text DEFAULT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(50) DEFAULT 'default_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notebook`
--

INSERT INTO `notebook` (`id`, `vocab_id`, `custom_hanzi`, `custom_pinyin`, `custom_meaning`, `custom_strokes`, `custom_radical`, `custom_example`, `saved_at`, `user_id`) VALUES
(5, 77, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 12:16:38', 'default_user'),
(6, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-12 11:50:54', 'user_4'),
(7, NULL, '煎荷包蛋', 'jiān hébāodàn', 'Trứng ốp la', 0, '', '', '2026-06-14 07:53:55', 'user_4'),
(8, NULL, '海', 'hǎi', 'biển', 10, '氵', '这里的海水非常蓝。', '2026-06-14 07:54:38', 'user_4'),
(9, 341, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-14 09:37:49', 'user_4'),
(10, NULL, '生菜', 'shēngcài', 'Rau xà lách', 16, '艹', '这盘肉下面垫了生菜。', '2026-06-14 14:31:28', 'user_3'),
(11, NULL, '牛肉干', 'niúròugān', 'Thịt bò khô', 13, '牛', '我喜欢吃牛肉干。', '2026-06-15 05:56:59', 'user_3'),
(12, 115, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-20 03:38:55', 'user_3'),
(13, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-21 02:57:47', 'user_4'),
(15, 0, '书', 'shū', 'sách', 4, '丨', '熊猫正在书上写字。', '2026-07-21 03:42:25', 'user_4');

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
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `amount` decimal(12,0) NOT NULL,
  `status` enum('pending','paid','expired','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `expires_at` datetime DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `course_id`, `amount`, `status`, `expires_at`, `paid_at`, `created_at`) VALUES
(1, 'HD20260720172130AC6F101A', 4, 1, 1490000, 'pending', '2026-07-20 22:51:30', NULL, '2026-07-20 15:21:30'),
(2, 'HD2026072017260140917900', 4, 6, 2000, 'pending', '2026-07-20 22:56:01', NULL, '2026-07-20 15:26:01'),
(3, 'HD202607201808201E8D55C9', 4, 6, 2000, 'pending', '2026-07-20 23:38:20', NULL, '2026-07-20 16:08:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(64) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `otp`, `created_at`) VALUES
(1, 'hungmanhlp@gmail.com', 'a8f2b7a07e461246c627b24af503e572dc7dad97e7d02b897dd1d79c8727c094', NULL, '2026-07-20 18:00:51'),
(2, 'hungmanhlp@gmail.com', '9a85780e83c4aeb953142b06ef0c5d74ed6f7d06a55c71a24f237cdba30c07e2', NULL, '2026-07-20 18:00:57'),
(3, 'hungmanhlp@gmail.com', '772927ea6e643a904e52642925e6107525a295456b15ae6cbd99f6eff4a504db', NULL, '2026-07-20 18:01:05'),
(4, 'hungmanhlp@gmail.com', 'aa9ba6bc768b7d5d1e8677a7c31c2664a1bad4748c55e85773184d8ebece7ec7', NULL, '2026-07-21 02:35:03'),
(5, 'hungmanhlp@gmail.com', '10258b155871bb3b4806513bd41813c2ec263399a005fe800181525f65a2686d', NULL, '2026-07-21 02:35:29'),
(6, 'hungmanhlp@gmail.com', '5a77fc64bd722ed8619aec63da5402d7d4ae42c116abe81b586605b37f32731f', NULL, '2026-07-21 02:35:34'),
(7, 'hungmanhlp@gmail.com', '537eff17796a688e01d8228eb6485bf7a19a1ace32ab3599880370943bd525f6', NULL, '2026-07-21 02:36:07'),
(8, 'hungmanhlp@gmail.com', '249abc0155fa9b5af59d04fad1d94ed7083f5b0c1a3ef964d7fd2a0e9287dac0', '815174', '2026-07-21 02:39:52'),
(10, 'hungmanhlp@gmail.com', '30506c8518d7e600d18bcda74e90b016ea2f0ef8f91a6c3b151749d7b4f9ae8f', '563154', '2026-07-21 02:44:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL DEFAULT 'bank_qr',
  `provider_transaction_id` varchar(120) DEFAULT NULL,
  `amount` decimal(12,0) NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `raw_payload` longtext DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
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

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `tags`, `status`, `likes`, `created_at`) VALUES
(1, 'ghmhvb', 'jjjjjjjjjjjjjjjjjjjj', 'Hungmanhlp', '#HSK3', 'approved', 1, '2026-06-14 10:18:20'),
(2, 'kkkkkkkkkkkkkkk', 'hhhhhhhhhhhhhhhhhhh', 'Hungmanhlp', '#HSK4,#GiaoTiep', 'approved', 7, '2026-06-14 10:20:53'),
(3, 'Test', 'kl', 'Hungmanhlp', '', 'approved', 1, '2026-07-21 03:20:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `image_path`, `created_at`) VALUES
(1, 3, 'uploads/posts/3_1784604050_0.jpg', '2026-07-21 03:20:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(21, 2, 'user_3', '2026-06-24 03:15:49'),
(27, 3, 'user_4', '2026-07-21 03:30:24'),
(28, 2, 'user_4', '2026-07-21 03:30:28');

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
(42, 118, NULL, 'default_user', 1, 0, 0, NULL, '2026-06-09 12:19:59'),
(43, 147, NULL, 'user_4', 1, 0, 0, NULL, '2026-06-12 11:15:18'),
(44, 115, NULL, 'user_4', 1, 0, 0, NULL, '2026-06-12 11:16:52'),
(45, 1, NULL, 'user_4', 1, 0, 0, NULL, '2026-06-12 11:44:09'),
(46, 2, NULL, 'user_4', 1, 0, 0, NULL, '2026-06-12 11:44:09'),
(47, 3, NULL, 'user_4', 1, 0, 0, NULL, '2026-06-12 11:44:10'),
(48, NULL, 20, 'user_4', 1, 0, 0, '2026-06-12 12:37:36', '2026-06-12 12:37:36'),
(49, 77, NULL, 'user_4', 0, 1, 0, NULL, '2026-06-14 07:13:56'),
(50, NULL, 9, 'user_3', 1, 0, 0, '2026-07-20 03:39:18', '2026-07-20 03:39:18'),
(51, NULL, 50, 'user_4', 1, 0, 0, '2026-07-20 03:48:59', '2026-07-20 03:48:59');

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
(3, 'F9F422', 'default_user', 'default_user', NULL, '', 1, 'choice', 'waiting', 10, 2, 10, 0, 0, '2026-06-12 07:10:18', NULL),
(4, '3B949B', 'user_4', 'Hungmanhlp', NULL, '', 1, 'choice', 'waiting', 10, 0, 0, 0, 0, '2026-06-12 11:31:23', NULL),
(5, '77D5DA', 'user_4', 'Hungmanhlp', NULL, '', 1, 'choice', 'waiting', 10, 0, 0, 0, 0, '2026-06-21 07:27:04', NULL),
(6, 'CF6E34', 'user_4', 'Hungmanhlp', NULL, '', 1, 'choice', 'waiting', 10, 0, 0, 0, 0, '2026-07-20 03:44:22', NULL);

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

--
-- Đang đổ dữ liệu cho bảng `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `quiz_type`, `level`, `score`, `total_questions`, `completed_at`) VALUES
(2, 'user_4', 'lesson_13', 2, 1, 5, '2026-06-12 11:17:00'),
(3, 'user_4', 'lesson_10', 2, 0, 5, '2026-06-12 11:20:25'),
(4, 'user_4', 'lesson_20', 3, 0, 5, '2026-06-12 12:38:07'),
(5, 'admin', 'reading', 1, 5, 10, '2026-06-12 12:55:51'),
(6, 'user_4', 'timed', 2, 0, 2, '2026-06-12 13:02:41'),
(7, 'user_3', 'timed', 1, 0, 0, '2026-06-14 14:26:49'),
(8, 'user_4', 'lesson_50', 6, 0, 5, '2026-07-20 03:48:25'),
(9, 'user_4', 'lesson_50', 6, 0, 5, '2026-07-20 03:48:32'),
(10, 'user_4', 'lesson_50', 6, 0, 5, '2026-07-20 03:48:46'),
(11, 'user_4', 'lesson_1', 1, 0, 5, '2026-07-20 16:47:23'),
(12, 'user_4', 'lesson_1', 1, 0, 5, '2026-07-20 16:47:27'),
(13, 'user_4', 'lesson_1', 1, 0, 5, '2026-07-20 16:47:34'),
(14, 'user_4', 'lesson_1', 1, 0, 5, '2026-07-20 16:47:38'),
(15, 'user_4', 'lesson_1', 1, 0, 5, '2026-07-20 16:47:42'),
(16, 'user_4', 'lesson_1', 1, 2, 5, '2026-07-20 16:47:54'),
(17, 'user_4', 'lesson_1', 1, 0, 5, '2026-07-20 16:48:10'),
(18, 'user_4', 'lesson_1', 1, 2, 5, '2026-07-20 16:48:30'),
(19, 'user_4', 'lesson_1', 1, 2, 5, '2026-07-20 16:48:49'),
(20, 'user_4', 'lesson_1', 1, 0, 5, '2026-07-20 16:49:19'),
(21, 'user_4', 'lesson_8', 1, 2, 5, '2026-07-21 03:00:34'),
(22, 'user_4', 'lesson_8', 1, 5, 5, '2026-07-21 03:01:05'),
(23, 'user_4', 'choice', 1, 1, 10, '2026-07-21 03:43:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `error_reports`
--

CREATE TABLE `error_reports` (
  `id` int(11) NOT NULL,
  `vocab_id` int(11) NOT NULL,
  `hanzi` varchar(50) NOT NULL,
  `field` varchar(20) NOT NULL COMMENT 'pinyin|meaning',
  `old_value` text DEFAULT NULL,
  `new_value` text NOT NULL,
  `note` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending' COMMENT 'pending|fixed|dismissed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `error_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vocab_id` (`vocab_id`);

ALTER TABLE `error_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Cấu trúc bảng cho bảng `srs`
--

CREATE TABLE `srs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `vocab_id` int(11) NOT NULL,
  `ease_factor` decimal(4,2) DEFAULT 2.50,
  `interval_days` int(11) DEFAULT 1,
  `consecutive_correct` int(11) DEFAULT 0,
  `next_review` date DEFAULT NULL,
  `last_reviewed` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `srs`
--

INSERT INTO `srs` (`id`, `user_id`, `vocab_id`, `ease_factor`, `interval_days`, `consecutive_correct`, `next_review`, `last_reviewed`, `created_at`) VALUES
(1, 'admin', 1, 2.50, 1, 0, '2026-06-13', NULL, '2026-06-12 12:55:50'),
(2, 'user_3', 1, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:14'),
(3, 'user_3', 2, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:15'),
(4, 'user_3', 3, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:15'),
(5, 'user_3', 4, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:15'),
(6, 'user_3', 5, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:16'),
(7, 'user_3', 6, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:16'),
(8, 'user_3', 7, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:16'),
(9, 'user_3', 8, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:17'),
(10, 'user_3', 9, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:17'),
(11, 'user_3', 10, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:17'),
(12, 'user_3', 11, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:17'),
(13, 'user_3', 12, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:18'),
(14, 'user_3', 13, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:18'),
(15, 'user_3', 14, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:18'),
(16, 'user_3', 15, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:19'),
(17, 'user_3', 16, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:19'),
(18, 'user_3', 17, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:19'),
(19, 'user_3', 18, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:24'),
(20, 'user_3', 19, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:24'),
(21, 'user_3', 20, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:25'),
(22, 'user_3', 51, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:25'),
(23, 'user_3', 52, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:25'),
(24, 'user_3', 53, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:25'),
(25, 'user_3', 54, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:26'),
(26, 'user_3', 55, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:26'),
(27, 'user_3', 56, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:26'),
(28, 'user_3', 57, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:27'),
(29, 'user_3', 58, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:27'),
(30, 'user_3', 59, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:27'),
(31, 'user_3', 60, 2.50, 1, 1, '2026-06-25', NULL, '2026-06-24 03:25:28'),
(32, 'user_4', 1, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:04:57'),
(33, 'user_4', 2, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:04:58'),
(34, 'user_4', 3, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:04:59'),
(35, 'user_4', 4, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:04:59'),
(36, 'user_4', 5, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:04:59'),
(37, 'user_4', 6, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:04:59'),
(38, 'user_4', 7, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:00'),
(39, 'user_4', 8, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:00'),
(40, 'user_4', 9, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:00'),
(41, 'user_4', 10, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:06'),
(42, 'user_4', 11, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:06'),
(43, 'user_4', 12, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:06'),
(44, 'user_4', 13, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:06'),
(45, 'user_4', 14, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:07'),
(46, 'user_4', 15, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:07'),
(47, 'user_4', 16, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:07'),
(48, 'user_4', 17, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:08'),
(49, 'user_4', 18, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:08'),
(50, 'user_4', 19, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:08'),
(51, 'user_4', 20, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:09'),
(52, 'user_4', 51, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:09'),
(53, 'user_4', 52, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:09'),
(54, 'user_4', 53, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:09'),
(55, 'user_4', 54, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:10'),
(56, 'user_4', 55, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:10'),
(57, 'user_4', 56, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:10'),
(58, 'user_4', 57, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:11'),
(59, 'user_4', 58, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:11'),
(60, 'user_4', 59, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:12'),
(61, 'user_4', 60, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:05:12'),
(62, 'user_4', 61, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:12'),
(63, 'user_4', 62, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:13'),
(64, 'user_4', 63, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:13'),
(65, 'user_4', 64, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:13'),
(66, 'user_4', 65, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:14'),
(67, 'user_4', 66, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:14'),
(68, 'user_4', 67, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:14'),
(69, 'user_4', 68, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:14'),
(70, 'user_4', 69, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:15'),
(71, 'user_4', 70, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:15'),
(72, 'user_4', 71, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:15'),
(73, 'user_4', 72, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:16'),
(74, 'user_4', 73, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:16'),
(75, 'user_4', 74, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:16'),
(76, 'user_4', 75, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:17'),
(77, 'user_4', 76, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:17'),
(78, 'user_4', 185, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:17'),
(79, 'user_4', 186, 2.50, 1, 1, '2026-07-22', NULL, '2026-07-21 03:06:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `study_logs`
--

CREATE TABLE `study_logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `vocab_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `study_logs`
--

INSERT INTO `study_logs` (`id`, `user_id`, `vocab_id`, `lesson_id`, `action`, `score`, `created_at`) VALUES
(1, 'user_4', 211, NULL, 'view', NULL, '2026-06-12 12:35:41'),
(2, 'user_4', 215, NULL, 'view', NULL, '2026-06-12 12:36:33'),
(3, 'user_4', 211, NULL, 'view', NULL, '2026-06-12 12:36:35'),
(4, 'user_4', 212, NULL, 'view', NULL, '2026-06-12 12:36:37'),
(5, 'user_4', 213, NULL, 'view', NULL, '2026-06-12 12:36:38'),
(6, 'user_4', 214, NULL, 'view', NULL, '2026-06-12 12:36:39'),
(7, 'user_4', 215, NULL, 'view', NULL, '2026-06-12 12:36:39'),
(8, 'user_4', 216, NULL, 'view', NULL, '2026-06-12 12:36:40'),
(9, 'user_4', 217, NULL, 'view', NULL, '2026-06-12 12:36:40'),
(10, 'user_4', 218, NULL, 'view', NULL, '2026-06-12 12:36:41'),
(11, 'user_4', 219, NULL, 'view', NULL, '2026-06-12 12:36:41'),
(12, 'user_4', 220, NULL, 'view', NULL, '2026-06-12 12:36:41'),
(13, 'user_4', 171, NULL, 'view', NULL, '2026-06-12 12:36:49'),
(14, 'user_4', 172, NULL, 'view', NULL, '2026-06-12 12:36:52'),
(15, 'user_4', 173, NULL, 'view', NULL, '2026-06-12 12:36:53'),
(16, 'user_4', 174, NULL, 'view', NULL, '2026-06-12 12:36:54'),
(17, 'user_4', 175, NULL, 'view', NULL, '2026-06-12 12:36:54'),
(18, 'user_4', 176, NULL, 'view', NULL, '2026-06-12 12:36:54'),
(19, 'user_4', 177, NULL, 'view', NULL, '2026-06-12 12:36:54'),
(20, 'user_4', 178, NULL, 'view', NULL, '2026-06-12 12:36:55'),
(21, 'user_4', 171, NULL, 'view', NULL, '2026-06-12 12:37:46'),
(22, 'user_4', 178, NULL, 'view', NULL, '2026-06-12 12:37:55'),
(23, 'admin', 1, NULL, 'review', 0, '2026-06-12 12:55:50'),
(24, 'admin', 1, NULL, 'view', NULL, '2026-06-12 12:55:51'),
(25, 'user_4', 77, NULL, 'view', NULL, '2026-06-14 06:59:40'),
(26, 'user_4', 77, NULL, 'view', NULL, '2026-06-14 06:59:59'),
(27, 'user_4', 77, NULL, 'view', NULL, '2026-06-14 07:13:04'),
(28, 'user_4', 78, NULL, 'view', NULL, '2026-06-14 07:13:59'),
(29, 'user_4', 1, NULL, 'view', NULL, '2026-06-14 07:20:36'),
(30, 'default_user', 1, NULL, 'view', NULL, '2026-06-14 07:33:38'),
(31, 'user_4', 351, NULL, 'view', NULL, '2026-06-14 09:37:08'),
(32, 'user_4', 311, NULL, 'view', NULL, '2026-06-14 09:37:31'),
(33, 'user_4', 341, NULL, 'view', NULL, '2026-06-14 09:37:47'),
(34, 'user_3', 69, NULL, 'view', NULL, '2026-06-15 05:58:54'),
(35, 'user_3', 69, NULL, 'view', NULL, '2026-06-15 08:10:18'),
(36, 'user_3', 115, NULL, 'view', NULL, '2026-06-15 08:10:41'),
(37, 'user_4', 489, NULL, 'view', NULL, '2026-06-20 08:51:58'),
(38, 'user_4', 361, NULL, 'view', NULL, '2026-06-20 08:52:22'),
(39, 'user_4', 361, NULL, 'view', NULL, '2026-06-20 09:13:33'),
(40, 'user_4', 469, NULL, 'view', NULL, '2026-06-20 09:14:02'),
(41, 'user_4', 489, NULL, 'view', NULL, '2026-06-20 09:14:14'),
(42, 'user_4', 368, NULL, 'view', NULL, '2026-06-20 09:14:25'),
(43, 'user_4', 361, NULL, 'view', NULL, '2026-06-20 09:34:19'),
(44, 'user_4', 361, NULL, 'view', NULL, '2026-06-20 09:34:33'),
(45, 'user_4', 361, NULL, 'view', NULL, '2026-06-20 10:21:55'),
(46, 'default_user', 361, NULL, 'view', NULL, '2026-06-20 10:44:18'),
(47, 'user_4', 361, NULL, 'view', NULL, '2026-06-21 07:24:48'),
(48, 'user_4', 369, NULL, 'view', NULL, '2026-06-21 07:24:51'),
(49, 'user_4', 489, NULL, 'view', NULL, '2026-06-21 07:27:18'),
(50, 'user_4', 496, NULL, 'view', NULL, '2026-06-21 07:27:22'),
(51, 'user_4', 489, NULL, 'view', NULL, '2026-06-21 08:30:59'),
(52, 'user_4', 341, NULL, 'view', NULL, '2026-06-21 08:31:11'),
(53, 'user_3', 439, NULL, 'view', NULL, '2026-06-22 10:22:19'),
(54, 'user_3', 341, NULL, 'view', NULL, '2026-06-24 02:45:55'),
(55, 'user_3', 69, NULL, 'view', NULL, '2026-06-24 03:09:15'),
(56, 'user_3', 1, NULL, 'view', NULL, '2026-06-24 03:15:30'),
(57, 'user_3', 1, NULL, 'review', 1, '2026-06-24 03:25:14'),
(58, 'user_3', 2, NULL, 'review', 1, '2026-06-24 03:25:15'),
(59, 'user_3', 3, NULL, 'review', 1, '2026-06-24 03:25:15'),
(60, 'user_3', 4, NULL, 'review', 1, '2026-06-24 03:25:15'),
(61, 'user_3', 5, NULL, 'review', 1, '2026-06-24 03:25:16'),
(62, 'user_3', 6, NULL, 'review', 1, '2026-06-24 03:25:16'),
(63, 'user_3', 7, NULL, 'review', 1, '2026-06-24 03:25:16'),
(64, 'user_3', 8, NULL, 'review', 1, '2026-06-24 03:25:17'),
(65, 'user_3', 9, NULL, 'review', 1, '2026-06-24 03:25:17'),
(66, 'user_3', 10, NULL, 'review', 1, '2026-06-24 03:25:17'),
(67, 'user_3', 11, NULL, 'review', 1, '2026-06-24 03:25:17'),
(68, 'user_3', 12, NULL, 'review', 1, '2026-06-24 03:25:18'),
(69, 'user_3', 13, NULL, 'review', 1, '2026-06-24 03:25:18'),
(70, 'user_3', 14, NULL, 'review', 1, '2026-06-24 03:25:18'),
(71, 'user_3', 15, NULL, 'review', 1, '2026-06-24 03:25:19'),
(72, 'user_3', 16, NULL, 'review', 1, '2026-06-24 03:25:19'),
(73, 'user_3', 17, NULL, 'review', 1, '2026-06-24 03:25:19'),
(74, 'user_3', 18, NULL, 'review', 1, '2026-06-24 03:25:24'),
(75, 'user_3', 19, NULL, 'review', 1, '2026-06-24 03:25:24'),
(76, 'user_3', 20, NULL, 'review', 1, '2026-06-24 03:25:25'),
(77, 'user_3', 51, NULL, 'review', 1, '2026-06-24 03:25:25'),
(78, 'user_3', 52, NULL, 'review', 1, '2026-06-24 03:25:25'),
(79, 'user_3', 53, NULL, 'review', 1, '2026-06-24 03:25:25'),
(80, 'user_3', 54, NULL, 'review', 1, '2026-06-24 03:25:26'),
(81, 'user_3', 55, NULL, 'review', 1, '2026-06-24 03:25:26'),
(82, 'user_3', 56, NULL, 'review', 1, '2026-06-24 03:25:26'),
(83, 'user_3', 57, NULL, 'review', 1, '2026-06-24 03:25:27'),
(84, 'user_3', 58, NULL, 'review', 1, '2026-06-24 03:25:27'),
(85, 'user_3', 59, NULL, 'review', 1, '2026-06-24 03:25:27'),
(86, 'user_3', 60, NULL, 'review', 1, '2026-06-24 03:25:28'),
(87, 'user_3', 1, NULL, 'view', NULL, '2026-06-24 03:34:41'),
(88, 'user_3', 115, NULL, 'view', NULL, '2026-07-20 03:38:23'),
(89, 'user_3', 121, NULL, 'view', NULL, '2026-07-20 03:38:59'),
(90, 'user_3', 77, NULL, 'view', NULL, '2026-07-20 03:39:11'),
(91, 'user_3', 78, NULL, 'view', NULL, '2026-07-20 03:39:14'),
(92, 'user_3', 79, NULL, 'view', NULL, '2026-07-20 03:39:14'),
(93, 'user_3', 80, NULL, 'view', NULL, '2026-07-20 03:39:14'),
(94, 'user_3', 81, NULL, 'view', NULL, '2026-07-20 03:39:14'),
(95, 'user_3', 84, NULL, 'view', NULL, '2026-07-20 03:39:15'),
(96, 'user_3', 85, NULL, 'view', NULL, '2026-07-20 03:39:15'),
(97, 'user_3', 86, NULL, 'view', NULL, '2026-07-20 03:39:15'),
(98, 'user_3', 77, NULL, 'view', NULL, '2026-07-20 03:39:28'),
(99, 'user_4', 489, NULL, 'view', NULL, '2026-07-20 03:48:13'),
(100, 'user_4', 498, NULL, 'view', NULL, '2026-07-20 03:48:43'),
(101, 'user_4', 1, NULL, 'view', NULL, '2026-07-20 14:46:01'),
(102, 'user_3', 1, NULL, 'view', NULL, '2026-07-20 15:19:29'),
(103, 'user_3', 4, NULL, 'view', NULL, '2026-07-20 15:19:33'),
(104, 'user_4', 1, NULL, 'view', NULL, '2026-07-20 16:47:17'),
(105, 'user_4', 2, NULL, 'view', NULL, '2026-07-20 16:49:07'),
(106, 'user_4', 4, NULL, 'view', NULL, '2026-07-20 16:49:12'),
(107, 'user_4', 6, NULL, 'view', NULL, '2026-07-20 16:50:21'),
(108, 'default_user', 1, NULL, 'view', NULL, '2026-07-20 18:00:45'),
(109, 'user_4', 1, NULL, 'view', NULL, '2026-07-21 02:57:28'),
(110, 'user_4', 69, NULL, 'view', NULL, '2026-07-21 02:57:44'),
(111, 'user_4', 69, NULL, 'view', NULL, '2026-07-21 02:58:59'),
(112, 'user_4', 70, NULL, 'view', NULL, '2026-07-21 02:59:09'),
(113, 'user_4', 69, NULL, 'view', NULL, '2026-07-21 02:59:13'),
(114, 'user_4', 70, NULL, 'view', NULL, '2026-07-21 02:59:35'),
(115, 'user_4', 71, NULL, 'view', NULL, '2026-07-21 02:59:36'),
(116, 'user_4', 72, NULL, 'view', NULL, '2026-07-21 02:59:37'),
(117, 'user_4', 1, NULL, 'view', NULL, '2026-07-21 03:02:50'),
(118, 'user_4', 1, NULL, 'review', 1, '2026-07-21 03:04:57'),
(119, 'user_4', 2, NULL, 'review', 1, '2026-07-21 03:04:58'),
(120, 'user_4', 3, NULL, 'review', 1, '2026-07-21 03:04:59'),
(121, 'user_4', 4, NULL, 'review', 1, '2026-07-21 03:04:59'),
(122, 'user_4', 5, NULL, 'review', 1, '2026-07-21 03:04:59'),
(123, 'user_4', 6, NULL, 'review', 1, '2026-07-21 03:04:59'),
(124, 'user_4', 7, NULL, 'review', 1, '2026-07-21 03:05:00'),
(125, 'user_4', 8, NULL, 'review', 1, '2026-07-21 03:05:00'),
(126, 'user_4', 9, NULL, 'review', 1, '2026-07-21 03:05:00'),
(127, 'user_4', 10, NULL, 'review', 1, '2026-07-21 03:05:06'),
(128, 'user_4', 11, NULL, 'review', 1, '2026-07-21 03:05:06'),
(129, 'user_4', 12, NULL, 'review', 1, '2026-07-21 03:05:06'),
(130, 'user_4', 13, NULL, 'review', 1, '2026-07-21 03:05:06'),
(131, 'user_4', 14, NULL, 'review', 1, '2026-07-21 03:05:07'),
(132, 'user_4', 15, NULL, 'review', 1, '2026-07-21 03:05:07'),
(133, 'user_4', 16, NULL, 'review', 1, '2026-07-21 03:05:07'),
(134, 'user_4', 17, NULL, 'review', 1, '2026-07-21 03:05:08'),
(135, 'user_4', 18, NULL, 'review', 1, '2026-07-21 03:05:08'),
(136, 'user_4', 19, NULL, 'review', 1, '2026-07-21 03:05:08'),
(137, 'user_4', 20, NULL, 'review', 1, '2026-07-21 03:05:09'),
(138, 'user_4', 51, NULL, 'review', 1, '2026-07-21 03:05:09'),
(139, 'user_4', 52, NULL, 'review', 1, '2026-07-21 03:05:09'),
(140, 'user_4', 53, NULL, 'review', 1, '2026-07-21 03:05:09'),
(141, 'user_4', 54, NULL, 'review', 1, '2026-07-21 03:05:10'),
(142, 'user_4', 55, NULL, 'review', 1, '2026-07-21 03:05:10'),
(143, 'user_4', 56, NULL, 'review', 1, '2026-07-21 03:05:10'),
(144, 'user_4', 57, NULL, 'review', 1, '2026-07-21 03:05:11'),
(145, 'user_4', 58, NULL, 'review', 1, '2026-07-21 03:05:11'),
(146, 'user_4', 59, NULL, 'review', 1, '2026-07-21 03:05:12'),
(147, 'user_4', 60, NULL, 'review', 1, '2026-07-21 03:05:12'),
(148, 'user_4', 61, NULL, 'review', 1, '2026-07-21 03:06:12'),
(149, 'user_4', 62, NULL, 'review', 1, '2026-07-21 03:06:13'),
(150, 'user_4', 63, NULL, 'review', 1, '2026-07-21 03:06:13'),
(151, 'user_4', 64, NULL, 'review', 1, '2026-07-21 03:06:13'),
(152, 'user_4', 65, NULL, 'review', 1, '2026-07-21 03:06:14'),
(153, 'user_4', 66, NULL, 'review', 1, '2026-07-21 03:06:14'),
(154, 'user_4', 67, NULL, 'review', 1, '2026-07-21 03:06:14'),
(155, 'user_4', 68, NULL, 'review', 1, '2026-07-21 03:06:14'),
(156, 'user_4', 69, NULL, 'review', 1, '2026-07-21 03:06:15'),
(157, 'user_4', 70, NULL, 'review', 1, '2026-07-21 03:06:15'),
(158, 'user_4', 71, NULL, 'review', 1, '2026-07-21 03:06:15'),
(159, 'user_4', 72, NULL, 'review', 1, '2026-07-21 03:06:16'),
(160, 'user_4', 73, NULL, 'review', 1, '2026-07-21 03:06:16'),
(161, 'user_4', 74, NULL, 'review', 1, '2026-07-21 03:06:16'),
(162, 'user_4', 75, NULL, 'review', 1, '2026-07-21 03:06:17'),
(163, 'user_4', 76, NULL, 'review', 1, '2026-07-21 03:06:17'),
(164, 'user_4', 185, NULL, 'review', 1, '2026-07-21 03:06:17'),
(165, 'user_4', 186, NULL, 'review', 1, '2026-07-21 03:06:17');

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
(3, 'admin', '', '$2y$10$fxCTXAIgUHlyeFy570iR8uA16izO5zD/l/E645O1dphSgmhW6.2qi', 'Administrator', 'admin', '9537383ecd3cf69aadec1a40887e2d3eae1e887fbbbf4a975ca1844921a55c7a', 'uploads/avatar_3_1781445650.jpg', '2026-06-09 10:06:22'),
(4, 'Nguyễn Hùng Mạnh', 'hungmanhlp@gmail.com', '$2y$10$ZMLHWMLix3sx13aFWcBYI.FrPIASOUve9Rh2PuhvEry6OVG8kVgzO', 'Hungmanhlp', 'user', 'c7b2f5169713311bf13024d1c58020563136a16e6a065471b8be92f4bd7570f2', NULL, '2026-06-12 10:13:17');

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
(201, '起床', 'qǐchuáng', 'thức dậy', 4, 21, 10, '走 (tẩu)', '我每天六点起床。', 'Tôi thức dậy lúc 6 giờ mỗi ngày.', '[{\"char\":\"起\",\"strokes\":10,\"radical\":\"走 (tẩu)\"},{\"char\":\"床\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(202, '刷牙', 'shuāyá', 'đánh răng', 4, 21, 8, '刂 (đao)', '早上刷牙很重要。', 'Đánh răng buổi sáng rất quan trọng.', '[{\"char\":\"刷\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"牙\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(203, '洗脸', 'xǐliǎn', 'rửa mặt', 4, 21, 10, '氵 (thủy)', '起床后先洗脸。', 'Sau khi dậy hãy rửa mặt.', '[{\"char\":\"洗\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"脸\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(204, '早餐', 'zǎocān', 'bữa sáng', 4, 21, 6, '日 (nhật)', '早餐要吃好。', 'Bữa sáng phải ăn tốt.', '[{\"char\":\"早\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"餐\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(205, '上班', 'shàngbān', 'đi làm', 4, 21, 3, '一', '我八点上班。', 'Tôi đi làm lúc 8 giờ.', '[{\"char\":\"上\",\"strokes\":3,\"radical\":\"一\"},{\"char\":\"班\",\"strokes\":10,\"radical\":\"王 (vương)\"}]', '2026-06-12 05:15:36'),
(206, '下班', 'xiàbān', 'tan làm', 4, 21, 3, '一', '下午五点下班。', 'Tan làm lúc 5 giờ chiều.', '[{\"char\":\"下\",\"strokes\":3,\"radical\":\"一\"},{\"char\":\"班\",\"strokes\":10,\"radical\":\"王 (vương)\"}]', '2026-06-12 05:15:36'),
(207, '休息', 'xiūxi', 'nghỉ ngơi', 4, 21, 6, '亻 (nhân)', '周末我在家休息。', 'Cuối tuần tôi nghỉ ở nhà.', '[{\"char\":\"休\",\"strokes\":6,\"radical\":\"亻 (nhân)\"},{\"char\":\"息\",\"strokes\":10,\"radical\":\"心 (tâm)\"}]', '2026-06-12 05:15:36'),
(208, '看电视', 'kàn diànshì', 'xem tivi', 4, 21, 9, '目 (mục)', '晚上看电视。', 'Buổi tối xem tivi.', '[{\"char\":\"看\",\"strokes\":9,\"radical\":\"目 (mục)\"},{\"char\":\"电\",\"strokes\":5,\"radical\":\"田 (điền)\"},{\"char\":\"视\",\"strokes\":9,\"radical\":\"见 (kiến)\"}]', '2026-06-12 05:15:36'),
(209, '睡觉', 'shuìjiào', 'ngủ', 4, 21, 10, '冖 (mịch)', '十点睡觉。', 'Ngủ lúc 10 giờ.', '[{\"char\":\"睡\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"觉\",\"strokes\":9,\"radical\":\"见 (kiến)\"}]', '2026-06-12 05:15:36'),
(210, '散步', 'sànbù', 'đi dạo', 4, 21, 12, '攵 (phộc)', '饭后散步。', 'Đi dạo sau bữa ăn.', '[{\"char\":\"散\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"步\",\"strokes\":7,\"radical\":\"止 (chỉ)\"}]', '2026-06-12 05:15:36'),
(211, '面试', 'miànshì', 'phỏng vấn', 4, 22, 9, '面 (diện)', '明天有面试。', 'Ngày mai có phỏng vấn.', '[{\"char\":\"面\",\"strokes\":9,\"radical\":\"面 (diện)\"},{\"char\":\"试\",\"strokes\":8,\"radical\":\"讠 (ngôn)\"}]', '2026-06-12 05:15:36'),
(212, '简历', 'jiǎnlì', 'sơ yếu lý lịch', 4, 22, 13, '竹 (trúc)', '请发简历。', 'Hãy gửi sơ yếu lý lịch.', '[{\"char\":\"简\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"历\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(213, '升职', 'shēngzhí', 'thăng chức', 4, 22, 4, '十 (thập)', '他升职了。', 'Anh ấy được thăng chức.', '[{\"char\":\"升\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"职\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(214, '辞职', 'cízhí', 'từ chức', 4, 22, 13, '辛 (tân)', '她辞职了。', 'Cô ấy đã từ chức.', '[{\"char\":\"辞\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"职\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(215, '工资', 'gōngzī', 'lương', 4, 22, 3, '工 (công)', '工资很高。', 'Lương rất cao.', '[{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\"},{\"char\":\"资\",\"strokes\":10,\"radical\":\"贝 (bối)\"}]', '2026-06-12 05:15:36'),
(216, '同事', 'tóngshì', 'đồng nghiệp', 4, 22, 6, '口 (khẩu)', '他是我的同事。', 'Anh ấy là đồng nghiệp của tôi.', '[{\"char\":\"同\",\"strokes\":6,\"radical\":\"口 (khẩu)\"},{\"char\":\"事\",\"strokes\":8,\"radical\":\"亅 (quyết)\"}]', '2026-06-12 05:15:36'),
(217, '加班', 'jiābān', 'tăng ca', 4, 22, 5, '力 (lực)', '今晚要加班。', 'Tối nay phải tăng ca.', '[{\"char\":\"加\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"班\",\"strokes\":10,\"radical\":\"王 (vương)\"}]', '2026-06-12 05:15:36'),
(218, '请假', 'qǐngjià', 'xin nghỉ', 4, 22, 10, '讠 (ngôn)', '我请假一天。', 'Tôi xin nghỉ một ngày.', '[{\"char\":\"请\",\"strokes\":10,\"radical\":\"讠 (ngôn)\"},{\"char\":\"假\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(219, '出差', 'chūchāi', 'đi công tác', 4, 22, 5, '凵 (khảm)', '下个月出差。', 'Tháng sau đi công tác.', '[{\"char\":\"出\",\"strokes\":5,\"radical\":\"凵 (khảm)\"},{\"char\":\"差\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(220, '会议', 'huìyì', 'cuộc họp', 4, 22, 6, '人 (nhân)', '下午有会议。', 'Chiều nay có cuộc họp.', '[{\"char\":\"会\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"议\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(221, '健康', 'jiànkāng', 'sức khỏe', 4, 23, 10, '亻 (nhân)', '祝您健康。', 'Chúc bạn sức khỏe.', '[{\"char\":\"健\",\"strokes\":10,\"radical\":\"亻 (nhân)\"},{\"char\":\"康\",\"strokes\":11,\"radical\":\"广 (yểm)\"}]', '2026-06-12 05:15:36'),
(222, '运动', 'yùndòng', 'vận động', 4, 23, 6, '辶 (sước)', '每天运动。', 'Tập thể dục mỗi ngày.', '[{\"char\":\"运\",\"strokes\":7,\"radical\":\"辶 (sước)\"},{\"char\":\"动\",\"strokes\":6,\"radical\":\"力 (lực)\"}]', '2026-06-12 05:15:36'),
(223, '检查', 'jiǎnchá', 'kiểm tra', 4, 23, 10, '木 (mộc)', '去医院检查。', 'Đi bệnh viện kiểm tra.', '[{\"char\":\"检\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"查\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(224, '感冒', 'gǎnmào', 'cảm cúm', 4, 23, 13, '心 (tâm)', '我感冒了。', 'Tôi bị cảm rồi.', '[{\"char\":\"感\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"冒\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(225, '发烧', 'fāshāo', 'sốt', 4, 23, 5, '乛 (chiết)', '孩子发烧了。', 'Đứa bé bị sốt.', '[{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\"},{\"char\":\"烧\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(226, '咳嗽', 'késòu', 'ho', 4, 23, 9, '口 (khẩu)', '一直咳嗽。', 'Ho liên tục.', '[{\"char\":\"咳\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"嗽\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(227, '头疼', 'tóuténg', 'đau đầu', 4, 23, 5, '大 (đại)', '有点头疼。', 'Hơi đau đầu.', '[{\"char\":\"头\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"疼\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(228, '锻炼', 'duànliàn', 'rèn luyện', 4, 23, 14, '金 (kim)', '每天锻炼。', 'Rèn luyện mỗi ngày.', '[{\"char\":\"锻\",\"strokes\":14,\"radical\":\"金 (kim)\"},{\"char\":\"炼\",\"strokes\":9,\"radical\":\"火 (hỏa)\"}]', '2026-06-12 05:15:36'),
(229, '减肥', 'jiǎnféi', 'giảm cân', 4, 23, 11, '冫 (băng)', '她在减肥。', 'Cô ấy đang giảm cân.', '[{\"char\":\"减\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"肥\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(230, '牙医', 'yáyī', 'nha sĩ', 4, 23, 4, '牙 (nha)', '去看牙医。', 'Đi khám nha sĩ.', '[{\"char\":\"牙\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"医\",\"strokes\":7,\"radical\":\"匚 (phương)\"}]', '2026-06-12 05:15:36'),
(231, '护照', 'hùzhào', 'hộ chiếu', 4, 24, 7, '扌 (thủ)', '带护照。', 'Mang hộ chiếu.', '[{\"char\":\"护\",\"strokes\":7,\"radical\":\"扌 (thủ)\"},{\"char\":\"照\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(232, '签证', 'qiānzhèng', 'thị thực', 4, 24, 13, '竹 (trúc)', '办签证。', 'Làm thị thực.', '[{\"char\":\"签\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"证\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(233, '行李', 'xíngli', 'hành lý', 4, 24, 6, '彳 (sách)', '行李很重。', 'Hành lý rất nặng.', '[{\"char\":\"行\",\"strokes\":6,\"radical\":\"彳 (sách)\"},{\"char\":\"李\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(234, '航班', 'hángbān', 'chuyến bay', 4, 24, 10, '舟 (chu)', '航班延误。', 'Chuyến bay bị hoãn.', '[{\"char\":\"航\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"班\",\"strokes\":10,\"radical\":\"王 (vương)\"}]', '2026-06-12 05:15:36'),
(235, '酒店', 'jiǔdiàn', 'khách sạn', 4, 24, 10, '酉 (dậu)', '订酒店。', 'Đặt khách sạn.', '[{\"char\":\"酒\",\"strokes\":10,\"radical\":\"酉 (dậu)\"},{\"char\":\"店\",\"strokes\":8,\"radical\":\"广 (yểm)\"}]', '2026-06-12 05:15:36'),
(236, '景点', 'jǐngdiǎn', 'điểm tham quan', 4, 24, 12, '日 (nhật)', '著名景点。', 'Điểm tham quan nổi tiếng.', '[{\"char\":\"景\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"点\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(237, '导游', 'dǎoyóu', 'hướng dẫn viên', 4, 24, 6, '寸 (thốn)', '导游很好。', 'Hướng dẫn viên tốt.', '[{\"char\":\"导\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"游\",\"strokes\":12,\"radical\":\"氵 (thủy)\"}]', '2026-06-12 05:15:36'),
(238, '堵车', 'dǔchē', 'tắc đường', 4, 24, 11, '土 (thổ)', '路上堵车。', 'Tắc đường trên đường.', '[{\"char\":\"堵\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"车\",\"strokes\":4,\"radical\":\"车 (xa)\"}]', '2026-06-12 05:15:36'),
(239, '地铁', 'dìtiě', 'tàu điện ngầm', 4, 24, 6, '土 (thổ)', '坐地铁。', 'Đi tàu điện ngầm.', '[{\"char\":\"地\",\"strokes\":6,\"radical\":\"土 (thổ)\"},{\"char\":\"铁\",\"strokes\":10,\"radical\":\"金 (kim)\"}]', '2026-06-12 05:15:36'),
(240, '出租车', 'chūzūchē', 'taxi', 4, 24, 5, '凵 (khảm)', '打出租车。', 'Bắt taxi.', '[{\"char\":\"出\",\"strokes\":5,\"radical\":\"凵 (khảm)\"},{\"char\":\"租\",\"strokes\":10,\"radical\":\"禾 (hòa)\"},{\"char\":\"车\",\"strokes\":4,\"radical\":\"车 (xa)\"}]', '2026-06-12 05:15:36'),
(241, '打折', 'dǎzhé', 'giảm giá', 4, 25, 6, '扌 (thủ)', '现在打折。', 'Đang giảm giá.', '[{\"char\":\"打\",\"strokes\":5,\"radical\":\"扌 (thủ)\"},{\"char\":\"折\",\"strokes\":7,\"radical\":\"扌 (thủ)\"}]', '2026-06-12 05:15:36'),
(242, '刷卡', 'shuākǎ', 'quẹt thẻ', 4, 25, 8, '刂 (đao)', '可以刷卡吗？', 'Có thể quẹt thẻ không?', '[{\"char\":\"刷\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"卡\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(243, '现金', 'xiànjīn', 'tiền mặt', 4, 25, 8, '王 (vương)', '用现金。', 'Dùng tiền mặt.', '[{\"char\":\"现\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"金\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(244, '发票', 'fāpiào', 'hóa đơn', 4, 25, 5, '乛 (chiết)', '开发票。', 'Xuất hóa đơn.', '[{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\"},{\"char\":\"票\",\"strokes\":11,\"radical\":\"示\"}]', '2026-06-12 05:15:36'),
(245, '退货', 'tuìhuò', 'trả hàng', 4, 25, 9, '辶 (sước)', '可以退货。', 'Có thể trả hàng.', '[{\"char\":\"退\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"货\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(246, '质量', 'zhìliàng', 'chất lượng', 4, 25, 8, '贝 (bối)', '质量很好。', 'Chất lượng rất tốt.', '[{\"char\":\"质\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"量\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(247, '价格', 'jiàgé', 'giá cả', 4, 25, 6, '亻 (nhân)', '价格合理。', 'Giá cả hợp lý.', '[{\"char\":\"价\",\"strokes\":6,\"radical\":\"亻 (nhân)\"},{\"char\":\"格\",\"strokes\":10,\"radical\":\"木 (mộc)\"}]', '2026-06-12 05:15:36'),
(248, '超市', 'chāoshì', 'siêu thị', 4, 25, 12, '走 (tẩu)', '去超市。', 'Đi siêu thị.', '[{\"char\":\"超\",\"strokes\":12,\"radical\":\"走 (tẩu)\"},{\"char\":\"市\",\"strokes\":5,\"radical\":\"巾 (cân)\"}]', '2026-06-12 05:15:36'),
(249, '购物车', 'gòuwùchē', 'xe đẩy', 4, 25, 8, '贝 (bối)', '推购物车。', 'Đẩy xe hàng.', '[{\"char\":\"购\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\"},{\"char\":\"车\",\"strokes\":4,\"radical\":\"车 (xa)\"}]', '2026-06-12 05:15:36'),
(250, '收银台', 'shōuyíntái', 'quầy thanh toán', 4, 25, 6, '攵 (phộc)', '在收银台付款。', 'Thanh toán tại quầy.', '[{\"char\":\"收\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"银\",\"strokes\":14,\"radical\":\"金 (kim)\"},{\"char\":\"台\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(251, '课程', 'kèchéng', 'khóa học', 4, 26, 10, '讠 (ngôn)', '课程很有趣。', 'Khóa học rất thú vị.', '[{\"char\":\"课\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"程\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(252, '考试', 'kǎoshì', 'kỳ thi', 4, 26, 6, '老 (lão)', '期末考试。', 'Thi cuối kỳ.', '[{\"char\":\"考\",\"strokes\":6,\"radical\":\"老 (lão)\"},{\"char\":\"试\",\"strokes\":8,\"radical\":\"讠 (ngôn)\"}]', '2026-06-12 05:15:36'),
(253, '成绩', 'chéngjì', 'thành tích', 4, 26, 6, '戈 (qua)', '成绩很好。', 'Thành tích tốt.', '[{\"char\":\"成\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"绩\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(254, '毕业', 'bìyè', 'tốt nghiệp', 4, 26, 6, '比 (tỷ)', '明年毕业。', 'Tốt nghiệp năm sau.', '[{\"char\":\"毕\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"业\",\"strokes\":5,\"radical\":\"一 (nhất)\"}]', '2026-06-12 05:15:36'),
(255, '留学', 'liúxué', 'du học', 4, 26, 10, '田 (điền)', '去中国留学。', 'Đi du học Trung Quốc.', '[{\"char\":\"留\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\"}]', '2026-06-12 05:15:36'),
(256, '图书馆', 'túshūguǎn', 'thư viện', 4, 26, 8, '囗 (vi)', '去图书馆。', 'Đi thư viện.', '[{\"char\":\"图\",\"strokes\":8,\"radical\":\"囗 (vi)\"},{\"char\":\"书\",\"strokes\":4,\"radical\":\"乛 (chiết)\"},{\"char\":\"馆\",\"strokes\":11,\"radical\":\"饣 (thực)\"}]', '2026-06-12 05:15:36'),
(257, '教授', 'jiàoshòu', 'giáo sư', 4, 26, 11, '攵 (phộc)', '王教授。', 'Giáo sư Vương.', '[{\"char\":\"教\",\"strokes\":11,\"radical\":\"攵 (phộc)\"},{\"char\":\"授\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(258, '论文', 'lùnwén', 'luận văn', 4, 26, 6, '讠 (ngôn)', '写论文。', 'Viết luận văn.', '[{\"char\":\"论\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"文\",\"strokes\":4,\"radical\":\"文 (văn)\"}]', '2026-06-12 05:15:36'),
(259, '奖学金', 'jiǎngxuéjīn', 'học bổng', 4, 26, 9, '大 (đại)', '获得奖学金。', 'Nhận học bổng.', '[{\"char\":\"奖\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\"},{\"char\":\"金\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(260, '研究', 'yánjiū', 'nghiên cứu', 4, 26, 9, '石 (thạch)', '做研究。', 'Làm nghiên cứu.', '[{\"char\":\"研\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"究\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(261, '传统', 'chuántǒng', 'truyền thống', 4, 27, 6, '亻 (nhân)', '传统文化。', 'Văn hóa truyền thống.', '[{\"char\":\"传\",\"strokes\":6,\"radical\":\"亻 (nhân)\"},{\"char\":\"统\",\"strokes\":9,\"radical\":\"纟 (tơ)\"}]', '2026-06-12 05:15:36'),
(262, '节日', 'jiérì', 'ngày lễ', 4, 27, 5, '艹 (thảo)', '春节是重要节日。', 'Tết là ngày lễ quan trọng.', '[{\"char\":\"节\",\"strokes\":5,\"radical\":\"艹 (thảo)\"},{\"char\":\"日\",\"strokes\":4,\"radical\":\"Nhật (Mặt trời)\"}]', '2026-06-12 05:15:36'),
(263, '婚礼', 'hūnlǐ', 'đám cưới', 4, 27, 11, '女 (nữ)', '参加婚礼。', 'Tham dự đám cưới.', '[{\"char\":\"婚\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"礼\",\"strokes\":5,\"radical\":\"礻 (thị)\"}]', '2026-06-12 05:15:36'),
(264, '礼物', 'lǐwù', 'quà tặng', 4, 27, 5, '礻 (thị)', '送礼物。', 'Tặng quà.', '[{\"char\":\"礼\",\"strokes\":5,\"radical\":\"礻 (thị)\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\"}]', '2026-06-12 05:15:36'),
(265, '风俗', 'fēngsú', 'phong tục', 4, 27, 4, '风 (phong)', '地方风俗。', 'Phong tục địa phương.', '[{\"char\":\"风\",\"strokes\":4,\"radical\":\"风 (phong)\"},{\"char\":\"俗\",\"strokes\":9,\"radical\":\"亻 (nhân)\"}]', '2026-06-12 05:15:36'),
(266, '社会', 'shèhuì', 'xã hội', 4, 27, 7, '礻 (thị)', '现代社会。', 'Xã hội hiện đại.', '[{\"char\":\"社\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"会\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(267, '关系', 'guānxi', 'quan hệ', 4, 27, 6, '八 (bát)', '关系很好。', 'Quan hệ tốt.', '[{\"char\":\"关\",\"strokes\":6,\"radical\":\"八 (bát)\"},{\"char\":\"系\",\"strokes\":7,\"radical\":\"糸 (mịch)\"}]', '2026-06-12 05:15:36'),
(268, '交流', 'jiāoliú', 'giao lưu', 4, 27, 6, '亠 (đầu)', '文化交流。', 'Giao lưu văn hóa.', '[{\"char\":\"交\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"流\",\"strokes\":10,\"radical\":\"氵 (thủy)\"}]', '2026-06-12 05:15:36'),
(269, '尊重', 'zūnzhòng', 'tôn trọng', 4, 27, 12, '寸 (thốn)', '互相尊重。', 'Tôn trọng lẫn nhau.', '[{\"char\":\"尊\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"重\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(270, '习惯', 'xíguàn', 'thói quen', 4, 27, 3, '乙 (ất)', '生活习惯。', 'Thói quen sinh hoạt.', '[{\"char\":\"习\",\"strokes\":3,\"radical\":\"乙 (ất)\"},{\"char\":\"惯\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(271, '高兴', 'gāoxìng', 'vui vẻ', 4, 28, 10, '高 (cao)', '很高兴。', 'Rất vui vẻ.', '[{\"char\":\"高\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"兴\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(272, '难过', 'nánguò', 'buồn', 4, 28, 10, '隹 (chuy)', '别难过。', 'Đừng buồn.', '[{\"char\":\"难\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"过\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(273, '担心', 'dānxīn', 'lo lắng', 4, 28, 8, '扌 (thủ)', '不用担心。', 'Đừng lo lắng.', '[{\"char\":\"担\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"心\",\"strokes\":4,\"radical\":\"Tâm (Tim)\"}]', '2026-06-12 05:15:36'),
(274, '紧张', 'jǐnzhāng', 'căng thẳng', 4, 28, 10, '糸 (mịch)', '考试紧张。', 'Căng thẳng vì thi.', '[{\"char\":\"紧\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"张\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(275, '感动', 'gǎndòng', 'cảm động', 4, 28, 13, '心 (tâm)', '非常感动。', 'Rất cảm động.', '[{\"char\":\"感\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"动\",\"strokes\":6,\"radical\":\"力 (lực)\"}]', '2026-06-12 05:15:36'),
(276, '生气', 'shēngqì', 'tức giận', 4, 28, 5, '生 (sinh)', '不要生气。', 'Đừng tức giận.', '[{\"char\":\"生\",\"strokes\":5,\"radical\":\"生 (sinh)\"},{\"char\":\"气\",\"strokes\":4,\"radical\":\"气 (khí)\"}]', '2026-06-12 05:15:36'),
(277, '羡慕', 'xiànmù', 'ghen tị', 4, 28, 12, '羊 (dương)', '真羡慕你。', 'Thật ghen tị với bạn.', '[{\"char\":\"羡\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"慕\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(278, '失望', 'shīwàng', 'thất vọng', 4, 28, 5, '大 (đại)', '有点失望。', 'Hơi thất vọng.', '[{\"char\":\"失\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"望\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(279, '信心', 'xìnxīn', 'tự tin', 4, 28, 9, '亻 (nhân)', '有信心。', 'Có tự tin.', '[{\"char\":\"信\",\"strokes\":9,\"radical\":\"亻 (nhân)\"},{\"char\":\"心\",\"strokes\":4,\"radical\":\"Tâm (Tim)\"}]', '2026-06-12 05:15:36'),
(280, '幸福', 'xìngfú', 'hạnh phúc', 4, 28, 8, '土 (thổ)', '幸福生活。', 'Cuộc sống hạnh phúc.', '[{\"char\":\"幸\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"福\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(281, '发明', 'fāmíng', 'phát minh', 4, 29, 5, '乛 (chiết)', '伟大的发明。', 'Phát minh vĩ đại.', '[{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\"},{\"char\":\"明\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(282, '网络', 'wǎngluò', 'mạng', 4, 29, 6, '网 (võng)', '网络时代。', 'Thời đại mạng.', '[{\"char\":\"网\",\"strokes\":6,\"radical\":\"网 (võng)\"},{\"char\":\"络\",\"strokes\":9,\"radical\":\"纟 (tơ)\"}]', '2026-06-12 05:15:36'),
(283, '数据', 'shùjù', 'dữ liệu', 4, 29, 13, '攵 (phộc)', '分析数据。', 'Phân tích dữ liệu.', '[{\"char\":\"数\",\"strokes\":13,\"radical\":\"攵 (phộc)\"},{\"char\":\"据\",\"strokes\":11,\"radical\":\"扌 (thủ)\"}]', '2026-06-12 05:15:36'),
(284, '下载', 'xiàzài', 'tải xuống', 4, 29, 3, '一', '下载软件。', 'Tải phần mềm.', '[{\"char\":\"下\",\"strokes\":3,\"radical\":\"一\"},{\"char\":\"载\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(285, '上传', 'shàngchuán', 'tải lên', 4, 29, 3, '一', '上传照片。', 'Tải ảnh lên.', '[{\"char\":\"上\",\"strokes\":3,\"radical\":\"一\"},{\"char\":\"传\",\"strokes\":6,\"radical\":\"亻 (nhân)\"}]', '2026-06-12 05:15:36'),
(286, '密码', 'mìmǎ', 'mật khẩu', 4, 29, 11, '宀 (miên)', '设置密码。', 'Đặt mật khẩu.', '[{\"char\":\"密\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"码\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(287, '连接', 'liánjiē', 'kết nối', 4, 29, 7, '辶 (sước)', '连接网络。', 'Kết nối mạng.', '[{\"char\":\"连\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"接\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(288, '搜索', 'sōusuǒ', 'tìm kiếm', 4, 29, 13, '扌 (thủ)', '搜索信息。', 'Tìm kiếm thông tin.', '[{\"char\":\"搜\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"索\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(289, '程序', 'chéngxù', 'chương trình', 4, 29, 12, '禾 (hòa)', '安装程序。', 'Cài đặt chương trình.', '[{\"char\":\"程\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"序\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(290, '系统', 'xìtǒng', 'hệ thống', 4, 29, 7, '糸 (mịch)', '更新系统。', 'Cập nhật hệ thống.', '[{\"char\":\"系\",\"strokes\":7,\"radical\":\"糸 (mịch)\"},{\"char\":\"统\",\"strokes\":9,\"radical\":\"纟 (tơ)\"}]', '2026-06-12 05:15:36'),
(291, '环境', 'huánjìng', 'môi trường', 4, 30, 8, '王 (vương)', '保护环境。', 'Bảo vệ môi trường.', '[{\"char\":\"环\",\"strokes\":8,\"radical\":\"王 (vương)\"},{\"char\":\"境\",\"strokes\":14,\"radical\":\"土 (thổ)\"}]', '2026-06-12 05:15:36'),
(292, '污染', 'wūrǎn', 'ô nhiễm', 4, 30, 6, '氵 (thủy)', '空气污染。', 'Ô nhiễm không khí.', '[{\"char\":\"污\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"染\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(293, '季节', 'jìjié', 'mùa', 4, 30, 8, '子 (tử)', '四个季节。', 'Bốn mùa.', '[{\"char\":\"季\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"节\",\"strokes\":5,\"radical\":\"艹 (thảo)\"}]', '2026-06-12 05:15:36'),
(294, '温度', 'wēndù', 'nhiệt độ', 4, 30, 12, '氵 (thủy)', '温度很高。', 'Nhiệt độ rất cao.', '[{\"char\":\"温\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"度\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(295, '刮风', 'guāfēng', 'gió thổi', 4, 30, 8, '刂 (đao)', '今天刮风。', 'Hôm nay có gió.', '[{\"char\":\"刮\",\"strokes\":8,\"radical\":\"刂 (đao)\"},{\"char\":\"风\",\"strokes\":4,\"radical\":\"风 (phong)\"}]', '2026-06-12 05:15:36'),
(296, '下雨', 'xiàyǔ', 'mưa', 4, 30, 3, '一', '正在下雨。', 'Trời đang mưa.', '[{\"char\":\"下\",\"strokes\":3,\"radical\":\"一\"},{\"char\":\"雨\",\"strokes\":8,\"radical\":\"雨 (vũ)\"}]', '2026-06-12 05:15:36'),
(297, '太阳', 'tàiyáng', 'mặt trời', 4, 30, 4, '大 (đại)', '太阳很大。', 'Mặt trời rất to.', '[{\"char\":\"太\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"阳\",\"strokes\":6,\"radical\":\"阝 (phụ)\"}]', '2026-06-12 05:15:36'),
(298, '月亮', 'yuèliang', 'mặt trăng', 4, 30, 4, '月 (nguyệt)', '月亮很圆。', 'Trăng rất tròn.', '[{\"char\":\"月\",\"strokes\":4,\"radical\":\"Nguyệt (Trăng)\"},{\"char\":\"亮\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(299, '植物', 'zhíwù', 'thực vật', 4, 30, 12, '木 (mộc)', '绿色植物。', 'Thực vật xanh.', '[{\"char\":\"植\",\"strokes\":12,\"radical\":\"木 (mộc)\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\"}]', '2026-06-12 05:15:36'),
(300, '动物', 'dòngwù', 'động vật', 4, 30, 6, '力 (lực)', '保护动物。', 'Bảo vệ động vật.', '[{\"char\":\"动\",\"strokes\":6,\"radical\":\"力 (lực)\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\"}]', '2026-06-12 05:15:36'),
(301, '经济', 'jīngjì', 'kinh tế', 5, 31, 8, '纟 (tơ)', '经济发展。', 'Phát triển kinh tế.', '[{\"char\":\"经\",\"strokes\":8,\"radical\":\"纟 (tơ)\"},{\"char\":\"济\",\"strokes\":9,\"radical\":\"氵 (thủy)\"}]', '2026-06-12 05:15:36'),
(302, '市场', 'shìchǎng', 'thị trường', 5, 31, 5, '巾 (cân)', '市场经济。', 'Kinh tế thị trường.', '[{\"char\":\"市\",\"strokes\":5,\"radical\":\"巾 (cân)\"},{\"char\":\"场\",\"strokes\":6,\"radical\":\"土 (thổ)\"}]', '2026-06-12 05:15:36'),
(303, '投资', 'tóuzī', 'đầu tư', 5, 31, 7, '扌 (thủ)', '投资未来。', 'Đầu tư tương lai.', '[{\"char\":\"投\",\"strokes\":7,\"radical\":\"扌 (thủ)\"},{\"char\":\"资\",\"strokes\":10,\"radical\":\"贝 (bối)\"}]', '2026-06-12 05:15:36'),
(304, '股票', 'gǔpiào', 'cổ phiếu', 5, 31, 8, '月 (nguyệt)', '买股票。', 'Mua cổ phiếu.', '[{\"char\":\"股\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"票\",\"strokes\":11,\"radical\":\"示\"}]', '2026-06-12 05:15:36'),
(305, '银行', 'yínháng', 'ngân hàng', 5, 31, 14, '金 (kim)', '去银行。', 'Đi ngân hàng.', '[{\"char\":\"银\",\"strokes\":14,\"radical\":\"金 (kim)\"},{\"char\":\"行\",\"strokes\":6,\"radical\":\"彳 (sách)\"}]', '2026-06-12 05:15:36'),
(306, '贷款', 'dàikuǎn', 'khoản vay', 5, 31, 9, '贝 (bối)', '申请贷款。', 'Đăng ký khoản vay.', '[{\"char\":\"贷\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"款\",\"strokes\":12,\"radical\":\"欠 (khiếm)\"}]', '2026-06-12 05:15:36'),
(307, '利息', 'lìxī', 'lãi suất', 5, 31, 7, '刂 (đao)', '银行利息。', 'Lãi suất ngân hàng.', '[{\"char\":\"利\",\"strokes\":7,\"radical\":\"刂 (đao)\"},{\"char\":\"息\",\"strokes\":10,\"radical\":\"心 (tâm)\"}]', '2026-06-12 05:15:36'),
(308, '预算', 'yùsuàn', 'ngân sách', 5, 31, 10, '页 (hiệt)', '做预算。', 'Làm ngân sách.', '[{\"char\":\"预\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"算\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(309, '消费', 'xiāofèi', 'tiêu dùng', 5, 31, 10, '氵 (thủy)', '合理消费。', 'Tiêu dùng hợp lý.', '[{\"char\":\"消\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"费\",\"strokes\":9,\"radical\":\"贝 (bối)\"}]', '2026-06-12 05:15:36'),
(310, '收入', 'shōurù', 'thu nhập', 5, 31, 6, '攵 (phộc)', '月收入。', 'Thu nhập tháng.', '[{\"char\":\"收\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"入\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(311, '艺术', 'yìshù', 'nghệ thuật', 5, 32, 4, '艹 (thảo)', '现代艺术。', 'Nghệ thuật hiện đại.', '[{\"char\":\"艺\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"术\",\"strokes\":5,\"radical\":\"木 (mộc)\"}]', '2026-06-12 05:15:36'),
(312, '音乐', 'yīnyuè', 'âm nhạc', 5, 32, 9, '音 (âm)', '听音乐。', 'Nghe nhạc.', '[{\"char\":\"音\",\"strokes\":9,\"radical\":\"音 (âm)\"},{\"char\":\"乐\",\"strokes\":5,\"radical\":\"丿 (phiệt)\"}]', '2026-06-12 05:15:36'),
(313, '画家', 'huàjiā', 'họa sĩ', 5, 32, 8, '田 (điền)', '著名画家。', 'Họa sĩ nổi tiếng.', '[{\"char\":\"画\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"家\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(314, '小说', 'xiǎoshuō', 'tiểu thuyết', 5, 32, 3, '小 (tiểu)', '读小说。', 'Đọc tiểu thuyết.', '[{\"char\":\"小\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"说\",\"strokes\":9,\"radical\":\"言 (ngôn)\"}]', '2026-06-12 05:15:36'),
(315, '诗歌', 'shīgē', 'thơ ca', 5, 32, 8, '讠 (ngôn)', '写诗歌。', 'Viết thơ.', '[{\"char\":\"诗\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"歌\",\"strokes\":14,\"radical\":\"欠 (khiếm)\"}]', '2026-06-12 05:15:36'),
(316, '舞蹈', 'wǔdǎo', 'khiêu vũ', 5, 32, 14, '夕 (tịch)', '学舞蹈。', 'Học khiêu vũ.', '[{\"char\":\"舞\",\"strokes\":14,\"radical\":\"夕 (tịch)\"},{\"char\":\"蹈\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(317, '摄影', 'shèyǐng', 'nhiếp ảnh', 5, 32, 13, '扌 (thủ)', '喜欢摄影。', 'Thích nhiếp ảnh.', '[{\"char\":\"摄\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"影\",\"strokes\":15,\"radical\":\"彡 (sam)\"}]', '2026-06-12 05:15:36'),
(318, '展览', 'zhǎnlǎn', 'triển lãm', 5, 32, 10, '尸 (thi)', '看展览。', 'Xem triển lãm.', '[{\"char\":\"展\",\"strokes\":10,\"radical\":\"尸 (thi)\"},{\"char\":\"览\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(319, '创作', 'chuàngzuò', 'sáng tác', 5, 32, 6, '刂 (đao)', '创作音乐。', 'Sáng tác âm nhạc.', '[{\"char\":\"创\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"作\",\"strokes\":7,\"radical\":\"亻 (nhân)\"}]', '2026-06-12 05:15:36'),
(320, '欣赏', 'xīnshǎng', 'thưởng thức', 5, 32, 8, '欠 (khiếm)', '欣赏艺术。', 'Thưởng thức nghệ thuật.', '[{\"char\":\"欣\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"赏\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(321, '法律', 'fǎlǜ', 'pháp luật', 5, 33, 8, '氵 (thủy)', '遵守法律。', 'Tuân thủ pháp luật.', '[{\"char\":\"法\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"律\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(322, '权利', 'quánlì', 'quyền lợi', 5, 33, 6, '木 (mộc)', '公民权利。', 'Quyền công dân.', '[{\"char\":\"权\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"利\",\"strokes\":7,\"radical\":\"刂 (đao)\"}]', '2026-06-12 05:15:36'),
(323, '义务', 'yìwù', 'nghĩa vụ', 5, 33, 3, '丶 (chủ)', '有义务。', 'Có nghĩa vụ.', '[{\"char\":\"义\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"务\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(324, '选举', 'xuǎnjǔ', 'bầu cử', 5, 33, 9, '辶 (sước)', '参加选举。', 'Tham gia bầu cử.', '[{\"char\":\"选\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"举\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(325, '政府', 'zhèngfǔ', 'chính phủ', 5, 33, 9, '攵 (phộc)', '地方政府。', 'Chính phủ địa phương.', '[{\"char\":\"政\",\"strokes\":9,\"radical\":\"攵 (phộc)\"},{\"char\":\"府\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(326, '政策', 'zhèngcè', 'chính sách', 5, 33, 9, '攵 (phộc)', '新政策。', 'Chính sách mới.', '[{\"char\":\"政\",\"strokes\":9,\"radical\":\"攵 (phộc)\"},{\"char\":\"策\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(327, '民主', 'mínzhǔ', 'dân chủ', 5, 33, 5, '氏 (thị)', '社会主义。', 'Xã hội chủ nghĩa.', '[{\"char\":\"民\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"主\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(328, '改革', 'gǎigé', 'cải cách', 5, 33, 7, '攵 (phộc)', '改革开放。', 'Cải cách mở cửa.', '[{\"char\":\"改\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"革\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(329, '制度', 'zhìdù', 'chế độ', 5, 33, 8, '刂 (đao)', '社会制度。', 'Chế độ xã hội.', '[{\"char\":\"制\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"度\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(330, '平等', 'píngděng', 'bình đẳng', 5, 33, 5, '干 (can)', '人人平等。', 'Mọi người bình đẳng.', '[{\"char\":\"平\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"等\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(331, '食谱', 'shípǔ', 'công thức nấu', 5, 34, 9, '食 (thực)', '学食谱。', 'Học công thức nấu.', '[{\"char\":\"食\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"谱\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(332, '味道', 'wèidào', 'mùi vị', 5, 34, 8, '口 (khẩu)', '味道很好。', 'Mùi vị rất ngon.', '[{\"char\":\"味\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"道\",\"strokes\":12,\"radical\":\"辶 (sước)\"}]', '2026-06-12 05:15:36'),
(333, '新鲜', 'xīnxiān', 'tươi', 5, 34, 13, '鱼 (ngư)', '新鲜蔬菜。', 'Rau tươi.', '[{\"char\":\"新\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"鲜\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(334, '烹饪', 'pēngrèn', 'nấu nướng', 5, 34, 11, '灬 (hỏa)', '学烹饪。', 'Học nấu ăn.', '[{\"char\":\"烹\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"饪\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(335, '营养', 'yíngyǎng', 'dinh dưỡng', 5, 34, 11, '艹 (thảo)', '有营养。', 'Có dinh dưỡng.', '[{\"char\":\"营\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"养\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(336, '材料', 'cáiliào', 'nguyên liệu', 5, 34, 7, '木 (mộc)', '准备材料。', 'Chuẩn bị nguyên liệu.', '[{\"char\":\"材\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"料\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(337, '厨房', 'chúfáng', 'nhà bếp', 5, 34, 12, '厂 (hán)', '在厨房。', 'Ở nhà bếp.', '[{\"char\":\"厨\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"房\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(338, '煎', 'jiān', 'rán', 5, 34, 13, '灬 (hỏa)', '煎鱼。', 'Rán cá.', '[{\"char\":\"\\u714e\",\"strokes\":13,\"radical\":\"\\u706c (h\\u1ecfa)\"}]', '2026-06-12 05:15:36'),
(339, '炒', 'chǎo', 'xào', 5, 34, 8, '火 (hỏa)', '炒菜。', 'Xào rau.', '[{\"char\":\"\\u7092\",\"strokes\":8,\"radical\":\"\\u706b (h\\u1ecfa)\"}]', '2026-06-12 05:15:36'),
(340, '蒸', 'zhēng', 'hấp', 5, 34, 13, '艹 (thảo)', '蒸鱼。', 'Hấp cá.', '[{\"char\":\"\\u84b8\",\"strokes\":13,\"radical\":\"\\u8279 (th\\u1ea3o)\"}]', '2026-06-12 05:15:36'),
(341, '哲学', 'zhéxué', 'triết học', 5, 35, 10, '口 (khẩu)', '研究哲学。', 'Nghiên cứu triết học.', '[{\"char\":\"哲\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\"}]', '2026-06-12 05:15:36'),
(342, '思想', 'sīxiǎng', 'tư tưởng', 5, 35, 9, '心 (tâm)', '伟大的思想。', 'Tư tưởng vĩ đại.', '[{\"char\":\"思\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"想\",\"strokes\":13,\"radical\":\"心 (tâm)\"}]', '2026-06-12 05:15:36'),
(343, '理论', 'lǐlùn', 'lý thuyết', 5, 35, 11, '王 (vương)', '科学理论。', 'Lý thuyết khoa học.', '[{\"char\":\"理\",\"strokes\":11,\"radical\":\"王 (vương)\"},{\"char\":\"论\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(344, '概念', 'gàiniàn', 'khái niệm', 5, 35, 13, '木 (mộc)', '基本概念。', 'Khái niệm cơ bản.', '[{\"char\":\"概\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"念\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(345, '意识', 'yìshi', 'ý thức', 5, 35, 13, '心 (tâm)', '有意识。', 'Có ý thức.', '[{\"char\":\"意\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"识\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(346, '逻辑', 'luóji', 'logic', 5, 35, 11, '辶 (sước)', '逻辑思维。', 'Tư duy logic.', '[{\"char\":\"逻\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"辑\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(347, '辩证法', 'biànzhèngfǎ', 'biện chứng pháp', 5, 35, 16, '辛 (tân)', '唯物辩证法。', 'Phép biện chứng duy vật.', '[{\"char\":\"辩\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"证\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"法\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(348, '本质', 'běnzhì', 'bản chất', 5, 35, 5, '木 (mộc)', '问题的本质。', 'Bản chất của vấn đề.', '[{\"char\":\"本\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"质\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(349, '现象', 'xiànxiàng', 'hiện tượng', 5, 35, 8, '王 (vương)', '自然现象。', 'Hiện tượng tự nhiên.', '[{\"char\":\"现\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"象\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(350, '矛盾', 'máodùn', 'mâu thuẫn', 5, 35, 5, '矛 (mâu)', '主要矛盾。', 'Mâu thuẫn chính.', '[{\"char\":\"矛\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"盾\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(351, '物理', 'wùlǐ', 'vật lý', 6, 41, 8, '牛 (ngưu)', '学物理。', 'Học vật lý.', '[{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\"},{\"char\":\"理\",\"strokes\":11,\"radical\":\"王 (vương)\"}]', '2026-06-12 05:15:36'),
(352, '化学', 'huàxué', 'hóa học', 6, 41, 4, '亻 (nhân)', '化学实验。', 'Thí nghiệm hóa học.', '[{\"char\":\"化\",\"strokes\":4,\"radical\":\"亻 (nhân)\"},{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\"}]', '2026-06-12 05:15:36'),
(353, '生物', 'shēngwù', 'sinh vật', 6, 41, 5, '生 (sinh)', '海洋生物。', 'Sinh vật biển.', '[{\"char\":\"生\",\"strokes\":5,\"radical\":\"生 (sinh)\"},{\"char\":\"物\",\"strokes\":8,\"radical\":\"牛 (ngưu)\"}]', '2026-06-12 05:15:36'),
(354, '基因', 'jīyīn', 'gen', 6, 41, 11, '土 (thổ)', '基因研究。', 'Nghiên cứu gen.', '[{\"char\":\"基\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"因\",\"strokes\":6,\"radical\":\"囗 (vi)\"}]', '2026-06-12 05:15:36'),
(355, '细胞', 'xìbāo', 'tế bào', 6, 41, 8, '纟 (tơ)', '细胞结构。', 'Cấu trúc tế bào.', '[{\"char\":\"细\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"胞\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(356, '进化', 'jìnhuà', 'tiến hóa', 6, 41, 7, '辶 (sước)', '进化论。', 'Thuyết tiến hóa.', '[{\"char\":\"进\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"化\",\"strokes\":4,\"radical\":\"亻 (nhân)\"}]', '2026-06-12 05:15:36'),
(357, '分子', 'fēnzǐ', 'phân tử', 6, 41, 4, '刀 (đao)', '分子结构。', 'Cấu trúc phân tử.', '[{\"char\":\"分\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"子\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(358, '能源', 'néngyuán', 'năng lượng', 6, 41, 10, '月 (nguyệt)', '可再生能源。', 'Năng lượng tái tạo.', '[{\"char\":\"能\",\"strokes\":10,\"radical\":\"月 (nguyệt)\"},{\"char\":\"源\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(359, '实验', 'shíyàn', 'thí nghiệm', 6, 41, 8, '宀 (miên)', '做实验。', 'Làm thí nghiệm.', '[{\"char\":\"实\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"验\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(360, '分析', 'fēnxī', 'phân tích', 6, 41, 4, '刀 (đao)', '分析数据。', 'Phân tích dữ liệu.', '[{\"char\":\"分\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"析\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(361, '人工智能', 'réngōng zhìnéng', 'trí tuệ nhân tạo', 6, 42, 2, '人 (nhân)', '人工智能时代。', 'Kỷ nguyên AI.', '[{\"char\":\"人\",\"strokes\":2,\"radical\":\"人 (nhân)\"},{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\"},{\"char\":\"智\",\"strokes\":12,\"radical\":\"日 (nhật)\"},{\"char\":\"能\",\"strokes\":10,\"radical\":\"月 (nguyệt)\"}]', '2026-06-12 05:15:36'),
(362, '算法', 'suànfǎ', 'thuật toán', 6, 42, 14, '竹 (trúc)', '设计算法。', 'Thiết kế thuật toán.', '[{\"char\":\"算\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"法\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(363, '数据库', 'shùjùkù', 'cơ sở dữ liệu', 6, 42, 13, '攵 (phộc)', '管理数据库。', 'Quản lý cơ sở dữ liệu.', '[{\"char\":\"数\",\"strokes\":13,\"radical\":\"攵 (phộc)\"},{\"char\":\"据\",\"strokes\":11,\"radical\":\"扌 (thủ)\"},{\"char\":\"库\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(364, '编程', 'biānchéng', 'lập trình', 6, 42, 12, '纟 (tơ)', '学编程。', 'Học lập trình.', '[{\"char\":\"编\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"程\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(365, '加密', 'jiāmì', 'mã hóa', 6, 42, 5, '力 (lực)', '数据加密。', 'Mã hóa dữ liệu.', '[{\"char\":\"加\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"密\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(366, '虚拟', 'xūnǐ', 'ảo', 6, 42, 11, '虍 (hổ)', '虚拟现实。', 'Thực tế ảo.', '[{\"char\":\"虚\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"拟\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(367, '云计算', 'yún jìsuàn', 'điện toán đám mây', 6, 42, 4, '二 (nhị)', '云计算服务。', 'Dịch vụ điện toán đám mây.', '[{\"char\":\"云\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"计\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"算\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-12 05:15:36'),
(368, '网络安全', 'wǎngluò ānquán', 'an ninh mạng', 6, 42, 6, '网 (võng)', '提高网络安全。', 'Nâng cao an ninh mạng.', '[{\"char\":\"网\",\"strokes\":6,\"radical\":\"网 (võng)\"},{\"char\":\"络\",\"strokes\":9,\"radical\":\"纟 (tơ)\"},{\"char\":\"安\",\"strokes\":6,\"radical\":\"宀 (miên)\"},{\"char\":\"全\",\"strokes\":6,\"radical\":\"人 (nhân)\"}]', '2026-06-12 05:15:36'),
(369, '机器人', 'jīqìrén', 'robot', 6, 42, 6, '木 (mộc)', '智能机器人。', 'Robot thông minh.', '[{\"char\":\"机\",\"strokes\":6,\"radical\":\"木 (mộc)\"},{\"char\":\"器\",\"strokes\":16,\"radical\":\"口 (khẩu)\"},{\"char\":\"人\",\"strokes\":2,\"radical\":\"人 (nhân)\"}]', '2026-06-12 05:15:36'),
(370, '自动驾驶', 'zìdòng jiàshǐ', 'lái xe tự động', 6, 42, 6, '自 (tự)', '自动驾驶汽车。', 'Xe tự lái.', '[{\"char\":\"自\",\"strokes\":6,\"radical\":\"自 (tự)\"},{\"char\":\"动\",\"strokes\":6,\"radical\":\"力 (lực)\"},{\"char\":\"驾\",\"strokes\":8,\"radical\":\"马 (mã)\"},{\"char\":\"驶\",\"strokes\":8,\"radical\":\"马 (mã)\"}]', '2026-06-12 05:15:36'),
(371, '传媒', 'chuánméi', 'Truyền thông', 5, 36, 12, '亻 (nhân)', '现代传媒发展迅速。', 'Truyền thông hiện đại phát triển nhanh.', '[{\"char\":\"传\",\"strokes\":6,\"radical\":\"亻 (nhân)\"},{\"char\":\"媒\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(372, '日报', 'rìbào', 'Nhật báo', 5, 36, 6, '曰 (viết)', '人民日报是中国的日报。', 'Nhân dân nhật báo là báo hàng ngày của Trung Quốc.', '[{\"char\":\"日\",\"strokes\":4,\"radical\":\"Nhật (Mặt trời)\"},{\"char\":\"报\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(373, '记者', 'jìzhě', 'Phóng viên', 5, 36, 12, '讠 (ngôn)', '记者在现场报道。', 'Phóng viên đang đưa tin tại hiện trường.', '[{\"char\":\"记\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"者\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(374, '编辑', 'biānjí', 'Biên tập', 5, 36, 15, '纟 (tơ)', '编辑正在修改稿子。', 'Biên tập viên đang sửa bản thảo.', '[{\"char\":\"编\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"辑\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(375, '收视率', 'shōushìlǜ', 'Tỷ lệ người xem', 5, 36, 13, '攵 (phộc)', '这个节目收视率很高。', 'Chương trình này có tỷ lệ người xem cao.', '[{\"char\":\"收\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"视\",\"strokes\":9,\"radical\":\"见 (kiến)\"},{\"char\":\"率\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(376, '舆论', 'yúlùn', 'Dư luận', 5, 36, 13, '言 (ngôn)', '舆论有很大的影响力。', 'Dư luận có ảnh hưởng lớn.', '[{\"char\":\"舆\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"论\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(377, '传播', 'chuánbō', 'Lan truyền', 5, 36, 12, '亻 (nhân)', '消息很快传播开来。', 'Tin tức nhanh chóng lan truyền.', '[{\"char\":\"传\",\"strokes\":6,\"radical\":\"亻 (nhân)\"},{\"char\":\"播\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(378, '话题', 'huàtí', 'Chủ đề', 5, 36, 12, '讠 (ngôn)', '这个话题很热门。', 'Chủ đề này rất nóng.', '[{\"char\":\"话\",\"strokes\":8,\"radical\":\"讠 (ngôn)\"},{\"char\":\"题\",\"strokes\":15,\"radical\":\"页 (hiệt)\"}]', '2026-06-14 15:51:11'),
(379, '访谈', 'fǎngtán', 'Phỏng vấn / Đối thoại', 5, 36, 11, '讠 (ngôn)', '访谈节目很受欢迎。', 'Chương trình đối thoại rất được ưa chuộng.', '[{\"char\":\"访\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"谈\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:11'),
(380, '发行量', 'fāxíngliàng', 'Số lượng phát hành', 5, 36, 11, '又 (hựu)', '这份报纸发行量很大。', 'Tờ báo này có số lượng phát hành lớn.', '[{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\"},{\"char\":\"行\",\"strokes\":6,\"radical\":\"彳 (sách)\"},{\"char\":\"量\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(381, '结构', 'jiégòu', 'Kết cấu / Cấu trúc', 5, 37, 9, '纟 (tơ)', '这座桥结构很稳固。', 'Cây cầu này có kết cấu rất vững chắc.', '[{\"char\":\"结\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"构\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(382, '装修工', 'zhuāngxiūgōng', 'Thợ sửa chữa', 5, 37, 13, '衣 (y)', '装修工正在工作。', 'Thợ sửa chữa đang làm việc.', '[{\"char\":\"装\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"修\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\"}]', '2026-06-14 15:51:12'),
(383, '房屋', 'fángwū', 'Nhà ở', 5, 37, 8, '户 (hộ)', '这座房屋很漂亮。', 'Ngôi nhà này rất đẹp.', '[{\"char\":\"房\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"屋\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(384, '仓库', 'cāngkù', 'Kho hàng', 5, 37, 8, '人 (nhân)', '货物存放在仓库里。', 'Hàng hóa được lưu trữ trong kho.', '[{\"char\":\"仓\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"库\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(385, '天花板', 'tiānhuābǎn', 'Trần nhà', 5, 37, 8, '一', '天花板需要修理。', 'Trần nhà cần sửa chữa.', '[{\"char\":\"天\",\"strokes\":4,\"radical\":\"大 (đại)\"},{\"char\":\"花\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"板\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(386, '墙壁', 'qiángbì', 'Tường', 5, 37, 14, '土 (thổ)', '墙壁刷成了白色。', 'Tường được sơn màu trắng.', '[{\"char\":\"墙\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"壁\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(387, '地板', 'dìbǎn', 'Sàn nhà', 5, 37, 11, '土 (thổ)', '地板是木制的。', 'Sàn nhà làm bằng gỗ.', '[{\"char\":\"地\",\"strokes\":6,\"radical\":\"土 (thổ)\"},{\"char\":\"板\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(388, '窗户', 'chuānghù', 'Cửa sổ', 5, 37, 10, '穴 (huyệt)', '窗户开着通风。', 'Cửa sổ mở để thông gió.', '[{\"char\":\"窗\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"户\",\"strokes\":4,\"radical\":\"户 (hộ)\"}]', '2026-06-14 15:51:12'),
(389, '管道', 'guǎndào', 'Ống dẫn / Đường ống', 5, 37, 14, '竹 (trúc)', '水管管道需要维修。', 'Đường ống nước cần sửa chữa.', '[{\"char\":\"管\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"道\",\"strokes\":12,\"radical\":\"辶 (sước)\"}]', '2026-06-14 15:51:12');
INSERT INTO `vocab` (`id`, `hanzi`, `pinyin`, `meaning`, `level`, `lesson_id`, `strokes`, `radical`, `example`, `example_vi`, `char_data`, `created_at`) VALUES
(390, '肉类', 'ròulèi', 'Thịt (loại)', 5, 38, 12, '肉 (nhục)', '超市有各种肉类。', 'Siêu thị có các loại thịt.', '[{\"char\":\"肉\",\"strokes\":6,\"radical\":\"肉 (nhục)\"},{\"char\":\"类\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(391, '蔬菜', 'shūcài', 'Rau củ', 5, 38, 15, '艹 (thảo)', '多吃蔬菜对身体好。', 'Ăn nhiều rau củ tốt cho sức khỏe.', '[{\"char\":\"蔬\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"菜\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(392, '水果', 'shuǐguǒ', 'Trái cây', 5, 38, 8, '木 (mộc)', '水果很新鲜。', 'Trái cây rất tươi.', '[{\"char\":\"水\",\"strokes\":4,\"radical\":\"水 (thủy)\"},{\"char\":\"果\",\"strokes\":8,\"radical\":\"木 (mộc)\"}]', '2026-06-14 15:51:12'),
(393, '刀工', 'dāogōng', 'Kỹ thuật cắt thái', 5, 38, 8, '刀 (đao)', '他的刀工很好。', 'Kỹ thuật cắt thái của anh ấy rất tốt.', '[{\"char\":\"刀\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\"}]', '2026-06-14 15:51:12'),
(394, '火候', 'huǒhòu', 'Lửa / Mức lửa', 5, 38, 12, '火 (hỏa)', '火候掌握得很好。', 'Kiểm soát lửa rất tốt.', '[{\"char\":\"火\",\"strokes\":4,\"radical\":\"火 (hỏa)\"},{\"char\":\"候\",\"strokes\":10,\"radical\":\"亻 (nhân)\"}]', '2026-06-14 15:51:12'),
(395, '口感', 'kǒugǎn', 'Cảm giác khi ăn', 5, 38, 9, '口 (khẩu)', '这道菜口感很好。', 'Món này có cảm giác ăn rất ngon.', '[{\"char\":\"口\",\"strokes\":3,\"radical\":\"Khẩu (Miệng)\"},{\"char\":\"感\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(396, '调味', 'tiáowèi', 'Nêm nếm / Gia vị', 5, 38, 11, '辛', '调味要适中。', 'Nêm nếm phải vừa phải.', '[{\"char\":\"调\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"味\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(397, '清淡', 'qīngdàn', 'Thanh đạm / Nhẹ', 5, 38, 14, '氵 (thủy)', '我喜欢清淡的食物。', 'Tôi thích đồ ăn thanh đạm.', '[{\"char\":\"清\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"淡\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(398, '油腻', 'yóunì', 'Dầu mỡ / Ngấy', 5, 38, 12, '氵 (thủy)', '太油腻的食物不健康。', 'Đồ ăn quá dầu mỡ không tốt cho sức khỏe.', '[{\"char\":\"油\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"腻\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(399, '锦标赛', 'jǐnbiāosài', 'Giải vô địch', 5, 39, 14, '金 (kim)', '锦标赛每年举行一次。', 'Giải vô địch tổ chức mỗi năm một lần.', '[{\"char\":\"锦\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"标\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"赛\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(400, '田径', 'tiánjìng', 'Điền kinh', 5, 39, 11, '田 (điền)', '田径运动很受欢迎。', 'Điền kinh rất được ưa chuộng.', '[{\"char\":\"田\",\"strokes\":5,\"radical\":\"Điền (Ruộng)\"},{\"char\":\"径\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(401, '游泳', 'yóuyǒng', 'Bơi lội', 5, 39, 12, '氵 (thủy)', '他喜欢游泳。', 'Anh ấy thích bơi lội.', '[{\"char\":\"游\",\"strokes\":12,\"radical\":\"氵 (thủy)\"},{\"char\":\"泳\",\"strokes\":8,\"radical\":\"氵 (thủy)\"}]', '2026-06-14 15:51:12'),
(402, '体操', 'tǐcāo', 'Thể dục dụng cụ', 5, 39, 11, '亻 (nhân)', '体操运动员动作很优美。', 'Vận động viên thể dục có động tác rất đẹp.', '[{\"char\":\"体\",\"strokes\":7,\"radical\":\"亻 (nhân)\"},{\"char\":\"操\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(403, '犯规', 'fànguī', 'Phạm lỗi', 5, 39, 8, '犬 (khuyển)', '他犯规了。', 'Anh ấy phạm lỗi.', '[{\"char\":\"犯\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"规\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(404, '得分', 'défēn', 'Ghi điểm', 5, 39, 7, '彳 (xích)', '他得了最高分。', 'Anh ấy đạt điểm cao nhất.', '[{\"char\":\"得\",\"strokes\":11,\"radical\":\"彳 (sách)\"},{\"char\":\"分\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(405, '胜负', 'shèngfù', 'Thắng thua', 5, 39, 9, '力 (lực)', '胜负已经不重要了。', 'Thắng thua không còn quan trọng nữa.', '[{\"char\":\"胜\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"负\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(406, '训练', 'xùnliàn', 'Huấn luyện', 5, 39, 10, '讠 (ngôn)', '队员们正在训练。', 'Các đội viên đang huấn luyện.', '[{\"char\":\"训\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"练\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(407, '奖牌', 'jiǎngpái', 'Huy chương', 5, 39, 13, '大 (đại)', '他获得了金牌。', 'Anh ấy đã giành huy chương vàng.', '[{\"char\":\"奖\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"牌\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(408, '联赛', 'liánsài', 'Giải đấu liên đoàn', 5, 39, 14, '耳 (nhĩ)', '足球联赛开始了。', 'Giải bóng đá liên đoàn đã bắt đầu.', '[{\"char\":\"联\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"赛\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(409, '文明', 'wénmíng', 'Văn minh', 5, 40, 9, '文 (văn)', '古代文明很辉煌。', 'Văn minh cổ đại rất rực rỡ.', '[{\"char\":\"文\",\"strokes\":4,\"radical\":\"文 (văn)\"},{\"char\":\"明\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(410, '传统', 'chuántǒng', 'Truyền thống', 5, 40, 13, '亻 (nhân)', '传统文化需要传承。', 'Văn hóa truyền thống cần được kế thừa.', '[{\"char\":\"传\",\"strokes\":6,\"radical\":\"亻 (nhân)\"},{\"char\":\"统\",\"strokes\":9,\"radical\":\"纟 (tơ)\"}]', '2026-06-14 15:51:12'),
(411, '发展', 'fāzhǎn', 'Phát triển', 5, 40, 12, '又 (hựu)', '经济在快速发展。', 'Kinh tế đang phát triển nhanh.', '[{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\"},{\"char\":\"展\",\"strokes\":10,\"radical\":\"尸 (thi)\"}]', '2026-06-14 15:51:12'),
(412, '关系', 'guānxì', 'Quan hệ', 5, 40, 10, '丷 (bát)', '两国的关系很好。', 'Quan hệ hai nước rất tốt.', '[{\"char\":\"关\",\"strokes\":6,\"radical\":\"八 (bát)\"},{\"char\":\"系\",\"strokes\":7,\"radical\":\"糸 (mịch)\"}]', '2026-06-14 15:51:12'),
(413, '影响', 'yǐngxiǎng', 'Ảnh hưởng', 5, 40, 14, '彡 (sam)', '这件事影响很大。', 'Sự việc này ảnh hưởng rất lớn.', '[{\"char\":\"影\",\"strokes\":15,\"radical\":\"彡 (sam)\"},{\"char\":\"响\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(414, '教育', 'jiàoyù', 'Giáo dục', 5, 40, 11, '攵 (phộc)', '教育是国家的基础。', 'Giáo dục là nền tảng của đất nước.', '[{\"char\":\"教\",\"strokes\":11,\"radical\":\"攵 (phộc)\"},{\"char\":\"育\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(415, '研究', 'yánjiū', 'Nghiên cứu', 5, 40, 9, '石 (thạch)', '他从事科学研究。', 'Anh ấy làm nghiên cứu khoa học.', '[{\"char\":\"研\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"究\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(416, '数据', 'shùjù', 'Dữ liệu', 5, 40, 11, '攵 (phộc)', '这些数据很重要。', 'Những dữ liệu này rất quan trọng.', '[{\"char\":\"数\",\"strokes\":13,\"radical\":\"攵 (phộc)\"},{\"char\":\"据\",\"strokes\":11,\"radical\":\"扌 (thủ)\"}]', '2026-06-14 15:51:12'),
(417, '报告', 'bàogào', 'Báo cáo', 5, 40, 10, '扌 (thủ)', '报告已经写好了。', 'Báo cáo đã viết xong.', '[{\"char\":\"报\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"告\",\"strokes\":7,\"radical\":\"口 (khẩu)\"}]', '2026-06-14 15:51:12'),
(418, '统计', 'tǒngjì', 'Thống kê', 5, 40, 12, '纟 (tơ)', '统计结果出来了。', 'Kết quả thống kê đã ra.', '[{\"char\":\"统\",\"strokes\":9,\"radical\":\"纟 (tơ)\"},{\"char\":\"计\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(419, '文明史', 'wénmíngshǐ', 'Lịch sử văn minh', 6, 43, 13, '文 (văn)', '文明史研究人类发展。', 'Lịch sử văn minh nghiên cứu sự phát triển của nhân loại.', '[{\"char\":\"文\",\"strokes\":4,\"radical\":\"文 (văn)\"},{\"char\":\"明\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"史\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(420, '发掘', 'fājué', 'Khai quật', 6, 43, 12, '又 (hựu)', '考古学家正在发掘遗址。', 'Nhà khảo cổ đang khai quật di chỉ.', '[{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\"},{\"char\":\"掘\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(421, '青铜器', 'qīngtóngqì', 'Đồ đồng thau', 6, 43, 15, '金 (kim)', '青铜器是古代文物。', 'Đồ đồng thau là cổ vật thời cổ đại.', '[{\"char\":\"青\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"铜\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"器\",\"strokes\":16,\"radical\":\"口 (khẩu)\"}]', '2026-06-14 15:51:12'),
(422, '石器', 'shíqì', 'Đồ đá', 6, 43, 9, '石 (thạch)', '石器时代是人类早期阶段。', 'Thời đại đồ đá là giai đoạn đầu của loài người.', '[{\"char\":\"石\",\"strokes\":5,\"radical\":\"Thạch (Đá)\"},{\"char\":\"器\",\"strokes\":16,\"radical\":\"口 (khẩu)\"}]', '2026-06-14 15:51:12'),
(423, '古籍', 'gǔjí', 'Sách cổ', 6, 43, 9, '又 (hựu)', '这些古籍很有价值。', 'Những cuốn sách cổ này rất có giá trị.', '[{\"char\":\"古\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"籍\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(424, '考古学家', 'kǎogǔxuéjiā', 'Nhà khảo cổ học', 6, 43, 10, '耂 (lão)', '考古学家发现了古墓。', 'Nhà khảo cổ đã phát hiện ngôi mộ cổ.', '[{\"char\":\"考\",\"strokes\":6,\"radical\":\"老 (lão)\"},{\"char\":\"古\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"学\",\"strokes\":8,\"radical\":\"子 (tử)\"},{\"char\":\"家\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(425, '城堡', 'chéngbǎo', 'Lâu đài', 6, 43, 9, '土 (thổ)', '这座城堡建于中世纪。', 'Lâu đài này được xây từ trung cổ.', '[{\"char\":\"城\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"堡\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(426, '王陵', 'wánglíng', 'Lăng vua / Hoàng lăng', 6, 43, 11, '王 (vương)', '王陵保存完好。', 'Hoàng lăng được bảo tồn tốt.', '[{\"char\":\"王\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"陵\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(427, '遗迹', 'yíjì', 'Di tích', 6, 43, 12, '辶 (sước)', '这些遗迹非常珍贵。', 'Những di tích này rất quý giá.', '[{\"char\":\"遗\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"迹\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(428, '化石', 'huàshí', 'Hóa thạch', 6, 43, 10, '匕 (chủy)', '化石记录了生物进化。', 'Hóa thạch ghi lại sự tiến hóa của sinh vật.', '[{\"char\":\"化\",\"strokes\":4,\"radical\":\"亻 (nhân)\"},{\"char\":\"石\",\"strokes\":5,\"radical\":\"Thạch (Đá)\"}]', '2026-06-14 15:51:12'),
(429, '企业', 'qǐyè', 'Doanh nghiệp', 6, 44, 11, '亻 (nhân)', '这家企业很有实力。', 'Doanh nghiệp này rất có thực lực.', '[{\"char\":\"企\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"业\",\"strokes\":5,\"radical\":\"一 (nhất)\"}]', '2026-06-14 15:51:12'),
(430, '董事会', 'dǒngshìhuì', 'Hội đồng quản trị', 6, 44, 12, '艹 (thảo)', '董事会决定公司方向。', 'Hội đồng quản trị quyết định hướng đi của công ty.', '[{\"char\":\"董\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"事\",\"strokes\":8,\"radical\":\"亅 (quyết)\"},{\"char\":\"会\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(431, '产值', 'chǎnzhí', 'Giá trị sản xuất', 6, 44, 12, '亻 (nhân)', '今年产值增长很快。', 'Giá trị sản xuất năm nay tăng trưởng nhanh.', '[{\"char\":\"产\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"值\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(432, '效率', 'xiàolǜ', 'Hiệu suất', 6, 44, 13, '攵 (phộc)', '工作效率提高了。', 'Hiệu suất công việc đã tăng lên.', '[{\"char\":\"效\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"率\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(433, '预算表', 'yùsuànbiǎo', 'Bảng dự toán', 6, 44, 14, '页 (hiệt)', '预算表已经做好了。', 'Bảng dự toán đã được lập xong.', '[{\"char\":\"预\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"算\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"表\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(434, '市场', 'shìchǎng', 'Thị trường', 6, 44, 8, '巾 (cân)', '市场需求很大。', 'Nhu cầu thị trường rất lớn.', '[{\"char\":\"市\",\"strokes\":5,\"radical\":\"巾 (cân)\"},{\"char\":\"场\",\"strokes\":6,\"radical\":\"土 (thổ)\"}]', '2026-06-14 15:51:12'),
(435, '营销', 'yíngxiāo', 'Tiếp thị', 6, 44, 11, '艹 (thảo)', '网络营销效果很好。', 'Tiếp thị trực tuyến hiệu quả rất tốt.', '[{\"char\":\"营\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"销\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(436, '融资', 'róngzī', 'Huy động vốn', 6, 44, 10, '贝 (bối)', '公司正在融资。', 'Công ty đang huy động vốn.', '[{\"char\":\"融\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"资\",\"strokes\":10,\"radical\":\"贝 (bối)\"}]', '2026-06-14 15:51:12'),
(437, '上市', 'shàngshì', 'Lên sàn / Niêm yết', 6, 44, 8, '一', '这家公司准备上市。', 'Công ty này chuẩn bị niêm yết.', '[{\"char\":\"上\",\"strokes\":3,\"radical\":\"一\"},{\"char\":\"市\",\"strokes\":5,\"radical\":\"巾 (cân)\"}]', '2026-06-14 15:51:12'),
(438, '并购', 'bìnggòu', 'Sáp nhập và mua lại', 6, 44, 11, '并 (tịnh)', '两家公司正在并购。', 'Hai công ty đang sáp nhập.', '[{\"char\":\"并\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"购\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(439, '海军', 'hǎijūn', 'Hải quân', 6, 45, 10, '氵 (thủy)', '海军在海上巡逻。', 'Hải quân tuần tra trên biển.', '[{\"char\":\"海\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"军\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(440, '陆军', 'lùjūn', 'Lục quân', 6, 45, 7, '阝 (phụ)', '陆军参加了演习。', 'Lục quân đã tham gia diễn tập.', '[{\"char\":\"陆\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"军\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(441, '空军', 'kōngjūn', 'Không quân', 6, 45, 9, '穴 (huyệt)', '空军在空中作战。', 'Không quân chiến đấu trên không.', '[{\"char\":\"空\",\"strokes\":8,\"radical\":\"穴 (huyệt)\"},{\"char\":\"军\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(442, '导弹', 'dǎodàn', 'Tên lửa', 6, 45, 9, '寸 (thốn)', '导弹是现代武器。', 'Tên lửa là vũ khí hiện đại.', '[{\"char\":\"导\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"弹\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(443, '阵地', 'zhèndì', 'Trận địa', 6, 45, 12, '阝 (phụ)', '战士们坚守阵地。', 'Các chiến sĩ giữ vững trận địa.', '[{\"char\":\"阵\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"地\",\"strokes\":6,\"radical\":\"土 (thổ)\"}]', '2026-06-14 15:51:12'),
(444, '指挥', 'zhǐhuī', 'Chỉ huy', 6, 45, 9, '扌 (thủ)', '将军指挥作战。', 'Tướng quân chỉ huy tác chiến.', '[{\"char\":\"指\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"挥\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(445, '演习', 'yǎnxí', 'Diễn tập', 6, 45, 12, '氵 (thủy)', '军事演习正在进行。', 'Diễn tập quân sự đang diễn ra.', '[{\"char\":\"演\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"习\",\"strokes\":3,\"radical\":\"乙 (ất)\"}]', '2026-06-14 15:51:12'),
(446, '防御工事', 'fángyùgōngshì', 'Công sự phòng thủ', 6, 45, 15, '阝 (phụ)', '防御工事很坚固。', 'Công sự phòng thủ rất kiên cố.', '[{\"char\":\"防\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"御\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"工\",\"strokes\":3,\"radical\":\"工 (công)\"},{\"char\":\"事\",\"strokes\":8,\"radical\":\"亅 (quyết)\"}]', '2026-06-14 15:51:12'),
(447, '前线', 'qiánxiàn', 'Tiền tuyến', 6, 45, 9, '刂 (đao)', '他去了前线。', 'Anh ấy đã ra tiền tuyến.', '[{\"char\":\"前\",\"strokes\":9,\"radical\":\"丷\"},{\"char\":\"线\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(448, '投降', 'tóuxiáng', 'Đầu hàng', 6, 45, 10, '扌 (thủ)', '敌人投降了。', 'Kẻ thù đã đầu hàng.', '[{\"char\":\"投\",\"strokes\":7,\"radical\":\"扌 (thủ)\"},{\"char\":\"降\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(449, '信徒', 'xìntú', 'Tín đồ', 6, 46, 13, '亻 (nhân)', '信徒们在祈祷。', 'Các tín đồ đang cầu nguyện.', '[{\"char\":\"信\",\"strokes\":9,\"radical\":\"亻 (nhân)\"},{\"char\":\"徒\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(450, '教堂', 'jiàotáng', 'Nhà thờ', 6, 46, 14, '土 (thổ)', '教堂的钟声很美。', 'Tiếng chuông nhà thờ rất đẹp.', '[{\"char\":\"教\",\"strokes\":11,\"radical\":\"攵 (phộc)\"},{\"char\":\"堂\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(451, '朝圣', 'cháoshèng', 'Hành hương', 6, 46, 12, '月 (nguyệt)', '许多人去朝圣。', 'Nhiều người đi hành hương.', '[{\"char\":\"朝\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"圣\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(452, '宽容', 'kuānróng', 'Khoan dung', 6, 46, 10, '宀 (miên)', '宗教提倡宽容。', 'Tôn giáo đề cao sự khoan dung.', '[{\"char\":\"宽\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"容\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(453, '慈悲', 'cíbēi', 'Từ bi', 6, 46, 13, '心 (tâm)', '佛教讲究慈悲为怀。', 'Phật giáo coi trọng lòng từ bi.', '[{\"char\":\"慈\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"悲\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(454, '天堂', 'tiāntáng', 'Thiên đường', 6, 46, 9, '大 (đại)', '天堂是美好的地方。', 'Thiên đường là nơi tốt đẹp.', '[{\"char\":\"天\",\"strokes\":4,\"radical\":\"大 (đại)\"},{\"char\":\"堂\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(455, '地狱', 'dìyù', 'Địa ngục', 6, 46, 14, '土 (thổ)', '地狱是受苦的地方。', 'Địa ngục là nơi chịu khổ.', '[{\"char\":\"地\",\"strokes\":6,\"radical\":\"土 (thổ)\"},{\"char\":\"狱\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(456, '道德', 'dàodé', 'Đạo đức', 6, 46, 14, '辶 (sước)', '道德规范很重要。', 'Quy phạm đạo đức rất quan trọng.', '[{\"char\":\"道\",\"strokes\":12,\"radical\":\"辶 (sước)\"},{\"char\":\"德\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(457, '修行', 'xiūxíng', 'Tu hành', 6, 46, 12, '亻 (nhân)', '他在山里修行。', 'Anh ấy tu hành trong núi.', '[{\"char\":\"修\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"行\",\"strokes\":6,\"radical\":\"彳 (sách)\"}]', '2026-06-14 15:51:12'),
(458, '禅', 'chán', 'Thiền', 6, 46, 8, '礻 (kỳ)', '禅修可以静心。', 'Thiền tu có thể tĩnh tâm.', '[{\"char\":\"禅\",\"strokes\":8,\"radical\":\"礻 (kỳ)\"}]', '2026-06-14 15:51:12'),
(459, '水墨画', 'shuǐmòhuà', 'Tranh thủy mặc', 6, 47, 14, '水 (thủy)', '水墨画是中国传统艺术。', 'Tranh thủy mặc là nghệ thuật truyền thống Trung Hoa.', '[{\"char\":\"水\",\"strokes\":4,\"radical\":\"水 (thủy)\"},{\"char\":\"墨\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"画\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(460, '油画', 'yóuhuà', 'Tranh sơn dầu', 6, 47, 14, '氵 (thủy)', '这幅油画很珍贵。', 'Bức tranh sơn dầu này rất quý giá.', '[{\"char\":\"油\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"画\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(461, '素描', 'sùmiáo', 'Phác họa', 6, 47, 12, '纟 (tơ)', '素描是绘画的基础。', 'Phác họa là nền tảng của hội họa.', '[{\"char\":\"素\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"描\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(462, '构图', 'gòutú', 'Bố cục', 6, 47, 8, '木 (mộc)', '这幅画的构图很巧妙。', 'Bố cục của bức tranh này rất tinh tế.', '[{\"char\":\"构\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"图\",\"strokes\":8,\"radical\":\"囗 (vi)\"}]', '2026-06-14 15:51:12'),
(463, '色调', 'sèdiào', 'Tông màu', 6, 47, 10, '色 (sắc)', '暖色调让人感到温暖。', 'Tông màu ấm làm người ta cảm thấy ấm áp.', '[{\"char\":\"色\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"调\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(464, '艺术品', 'yìshùpǐn', 'Tác phẩm nghệ thuật', 6, 47, 15, '艹 (thảo)', '这件艺术品价值连城。', 'Tác phẩm nghệ thuật này giá trị vô giá.', '[{\"char\":\"艺\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"术\",\"strokes\":5,\"radical\":\"木 (mộc)\"},{\"char\":\"品\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(465, '装饰', 'zhuāngshì', 'Trang trí', 6, 47, 14, '衣 (y)', '房间装饰得很漂亮。', 'Căn phòng được trang trí rất đẹp.', '[{\"char\":\"装\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"饰\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(466, '灵感', 'línggǎn', 'Cảm hứng', 6, 47, 13, '雨 (vũ)', '画家从大自然中获得灵感。', 'Họa sĩ lấy cảm hứng từ thiên nhiên.', '[{\"char\":\"灵\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"感\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(467, '流派', 'liúpài', 'Trường phái', 6, 47, 10, '氵 (thủy)', '印象派是一个艺术流派。', 'Trường phái ấn tượng là một trường phái nghệ thuật.', '[{\"char\":\"流\",\"strokes\":10,\"radical\":\"氵 (thủy)\"},{\"char\":\"派\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(468, '画廊', 'huàláng', 'Phòng triển lãm tranh', 6, 47, 14, '广 (yểm)', '画廊正在举办新展览。', 'Phòng triển lãm đang tổ chức triển lãm mới.', '[{\"char\":\"画\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"廊\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(469, '像素', 'xiàngsù', 'Điểm ảnh', 6, 48, 14, '亻 (nhân)', '这个相机像素很高。', 'Máy ảnh này có điểm ảnh rất cao.', '[{\"char\":\"像\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"素\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(470, '宽带', 'kuāndài', 'Băng thông rộng', 6, 48, 15, '宀 (miên)', '宽带速度很快。', 'Tốc độ băng thông rộng rất nhanh.', '[{\"char\":\"宽\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"带\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(471, '防火墙', 'fánghuǒqiáng', 'Tường lửa', 6, 48, 16, '阝 (phụ)', '防火墙保护网络安全。', 'Tường lửa bảo vệ an ninh mạng.', '[{\"char\":\"防\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"火\",\"strokes\":4,\"radical\":\"火 (hỏa)\"},{\"char\":\"墙\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(472, '芯片', 'xīnpiàn', 'Chip / Vi mạch', 6, 48, 12, '艹 (thảo)', '芯片是电脑的核心。', 'Chip là lõi của máy tính.', '[{\"char\":\"芯\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"片\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(473, '传感器', 'chuángǎnqì', 'Cảm biến', 6, 48, 15, '亻 (nhân)', '传感器能检测温度。', 'Cảm biến có thể phát hiện nhiệt độ.', '[{\"char\":\"传\",\"strokes\":6,\"radical\":\"亻 (nhân)\"},{\"char\":\"感\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"器\",\"strokes\":16,\"radical\":\"口 (khẩu)\"}]', '2026-06-14 15:51:12'),
(474, '操作系统', 'cāozuòxìtǒng', 'Hệ điều hành', 6, 48, 15, '扌 (thủ)', '操作系统是软件的基础。', 'Hệ điều hành là nền tảng của phần mềm.', '[{\"char\":\"操\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"作\",\"strokes\":7,\"radical\":\"亻 (nhân)\"},{\"char\":\"系\",\"strokes\":7,\"radical\":\"糸 (mịch)\"},{\"char\":\"统\",\"strokes\":9,\"radical\":\"纟 (tơ)\"}]', '2026-06-14 15:51:12'),
(475, '接口', 'jiēkǒu', 'Giao diện / Cổng kết nối', 6, 48, 14, '扌 (thủ)', 'USB接口很方便。', 'Cổng kết nối USB rất tiện lợi.', '[{\"char\":\"接\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"口\",\"strokes\":3,\"radical\":\"Khẩu (Miệng)\"}]', '2026-06-14 15:51:12'),
(476, '协议', 'xiéyì', 'Giao thức', 6, 48, 12, '十 (thập)', '网络协议很重要。', 'Giao thức mạng rất quan trọng.', '[{\"char\":\"协\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"议\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(477, '开源', 'kāiyuán', 'Mã nguồn mở', 6, 48, 8, '廾 (thập)', '开源软件很受欢迎。', 'Phần mềm mã nguồn mở rất được ưa chuộng.', '[{\"char\":\"开\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"源\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(478, '编程语言', 'biānchéngyǔyán', 'Ngôn ngữ lập trình', 6, 48, 14, '纟 (tơ)', 'Python是一种编程语言。', 'Python là một ngôn ngữ lập trình.', '[{\"char\":\"编\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"程\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"语\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"言\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(479, '体检', 'tǐjiǎn', 'Kiểm tra sức khỏe', 6, 49, 13, '亻 (nhân)', '每年要做一次体检。', 'Mỗi năm nên kiểm tra sức khỏe một lần.', '[{\"char\":\"体\",\"strokes\":7,\"radical\":\"亻 (nhân)\"},{\"char\":\"检\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(480, '内科', 'nèikē', 'Nội khoa', 6, 49, 9, '冂 (quynh)', '内科医生检查内脏。', 'Bác sĩ nội khoa kiểm tra nội tạng.', '[{\"char\":\"内\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"科\",\"strokes\":9,\"radical\":\"禾 (hòa)\"}]', '2026-06-14 15:51:12'),
(481, '外科', 'wàikē', 'Ngoại khoa', 6, 49, 9, '夕 (tịch)', '外科医生做手术。', 'Bác sĩ ngoại khoa làm phẫu thuật.', '[{\"char\":\"外\",\"strokes\":5,\"radical\":\"夕\"},{\"char\":\"科\",\"strokes\":9,\"radical\":\"禾 (hòa)\"}]', '2026-06-14 15:51:12'),
(482, '处方', 'chǔfāng', 'Đơn thuốc', 6, 49, 10, '夂 (truy)', '医生开了处方。', 'Bác sĩ đã kê đơn thuốc.', '[{\"char\":\"处\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"方\",\"strokes\":4,\"radical\":\"方 (phương)\"}]', '2026-06-14 15:51:12'),
(483, '药品', 'yàopǐn', 'Dược phẩm', 6, 49, 12, '艹 (thảo)', '药品要按说明服用。', 'Dược phẩm phải uống theo hướng dẫn.', '[{\"char\":\"药\",\"strokes\":9,\"radical\":\"艹\"},{\"char\":\"品\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(484, '麻醉', 'mázuì', 'Gây mê', 6, 49, 14, '麻 (ma)', '手术前需要麻醉。', 'Trước phẫu thuật cần gây mê.', '[{\"char\":\"麻\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"醉\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(485, '输血', 'shūxuè', 'Truyền máu', 6, 49, 12, '车 (xa)', '病人需要输血。', 'Bệnh nhân cần truyền máu.', '[{\"char\":\"输\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"血\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(486, '康复', 'kāngfù', 'Bình phục / Hồi phục', 6, 49, 12, '广 (yểm)', '他正在康复中。', 'Anh ấy đang trong quá trình bình phục.', '[{\"char\":\"康\",\"strokes\":11,\"radical\":\"广 (yểm)\"},{\"char\":\"复\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(487, '预防', 'yùfáng', 'Phòng ngừa', 6, 49, 12, '页 (hiệt)', '预防胜于治疗。', 'Phòng ngừa hơn chữa trị.', '[{\"char\":\"预\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"防\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(488, '慢性病', 'mànxìngbìng', 'Bệnh mãn tính', 6, 49, 15, '心 (tâm)', '慢性病需要长期治疗。', 'Bệnh mãn tính cần điều trị lâu dài.', '[{\"char\":\"慢\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"性\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"病\",\"strokes\":10,\"radical\":\"疒 (nạch)\"}]', '2026-06-14 15:51:12'),
(489, '多边', 'duōbiān', 'Đa phương', 6, 50, 11, '夕 (tịch)', '多边合作很重要。', 'Hợp tác đa phương rất quan trọng.', '[{\"char\":\"多\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"边\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(490, '一体化', 'yītǐhuà', 'Nhất thể hóa', 6, 50, 14, '一', '区域一体化在推进。', 'Nhất thể hóa khu vực đang được đẩy mạnh.', '[{\"char\":\"一\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"体\",\"strokes\":7,\"radical\":\"亻 (nhân)\"},{\"char\":\"化\",\"strokes\":4,\"radical\":\"亻 (nhân)\"}]', '2026-06-14 15:51:12'),
(491, '世贸', 'shìmào', 'Thương mại thế giới', 6, 50, 12, '一', '世贸组织推动自由贸易。', 'WTO thúc đẩy thương mại tự do.', '[{\"char\":\"世\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"贸\",\"strokes\":9,\"radical\":\"贝 (bối)\"}]', '2026-06-14 15:51:12'),
(492, '资源', 'zīyuán', 'Tài nguyên', 6, 50, 13, '贝 (bối)', '全球资源有限。', 'Tài nguyên toàn cầu có hạn.', '[{\"char\":\"资\",\"strokes\":10,\"radical\":\"贝 (bối)\"},{\"char\":\"源\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(493, '可持续发展', 'kěchíxùfāzhǎn', 'Phát triển bền vững', 6, 50, 14, '口 (khẩu)', '可持续发展是目标。', 'Phát triển bền vững là mục tiêu.', '[{\"char\":\"可\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"持\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"续\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"发\",\"strokes\":5,\"radical\":\"乛 (chiết)\"},{\"char\":\"展\",\"strokes\":10,\"radical\":\"尸 (thi)\"}]', '2026-06-14 15:51:12'),
(494, '供应链', 'gōngyìngliàn', 'Chuỗi cung ứng', 6, 50, 12, '亻 (nhân)', '全球供应链受到影响。', 'Chuỗi cung ứng toàn cầu bị ảnh hưởng.', '[{\"char\":\"供\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"应\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"链\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(495, '文化', 'wénhuà', 'Văn hóa', 6, 50, 8, '文 (văn)', '文化交流促进理解。', 'Giao lưu văn hóa thúc đẩy sự hiểu biết.', '[{\"char\":\"文\",\"strokes\":4,\"radical\":\"文 (văn)\"},{\"char\":\"化\",\"strokes\":4,\"radical\":\"亻 (nhân)\"}]', '2026-06-14 15:51:12'),
(496, '碳排放', 'tànpáifàng', 'Khí thải carbon', 6, 50, 15, '石 (thạch)', '碳排放要减少。', 'Khí thải carbon cần được giảm.', '[{\"char\":\"碳\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"排\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"放\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(497, '难民', 'nànmín', 'Người tị nạn', 6, 50, 10, '氵 (thủy)', '难民需要国际援助。', 'Người tị nạn cần viện trợ quốc tế.', '[{\"char\":\"难\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"民\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(498, '论坛', 'lùntán', 'Diễn đàn', 6, 50, 10, '讠 (ngôn)', '经济论坛在北京举行。', 'Diễn đàn kinh tế được tổ chức tại Bắc Kinh.', '[{\"char\":\"论\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"坛\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:12'),
(499, '梁', 'liáng', 'Dầm / Xà nhà', 5, 37, 11, '木 (mộc)', '这根梁很结实。', 'Cây xà này rất chắc chắn.', '[{\"char\":\"梁\",\"strokes\":11,\"radical\":\"木 (mộc)\"}]', '2026-06-14 15:51:24'),
(500, '酱油', 'jiàngyóu', 'Xì dầu', 5, 38, 9, '酉 (dậu)', '菜里放了酱油。', 'Trong món ăn có cho xì dầu.', '[{\"char\":\"酱\",\"strokes\":0,\"radical\":\"\"},{\"char\":\"油\",\"strokes\":0,\"radical\":\"\"}]', '2026-06-14 15:51:24');

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
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD PRIMARY KEY (`course_id`,`lesson_id`),
  ADD KEY `fk_course_lessons_lesson` (`lesson_id`);

--
-- Chỉ mục cho bảng `daily_streak`
--
ALTER TABLE `daily_streak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_streak` (`user_id`,`streak_date`);

--
-- Chỉ mục cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_enrollment` (`user_id`,`course_id`),
  ADD KEY `fk_enrollments_course` (`course_id`),
  ADD KEY `fk_enrollments_order` (`order_id`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD UNIQUE KEY `order_id` (`order_id`);

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
  ADD UNIQUE KEY `unique_notebook` (`user_id`,`vocab_id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `fk_orders_user` (`user_id`),
  ADD KEY `fk_orders_course` (`course_id`),
  ADD KEY `idx_orders_status_created` (`status`,`created_at`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provider_transaction_id` (`provider_transaction_id`),
  ADD KEY `fk_payments_order` (`order_id`),
  ADD KEY `fk_payments_admin` (`confirmed_by`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`post_id`,`user_id`);

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
-- Chỉ mục cho bảng `srs`
--
ALTER TABLE `srs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_srs` (`user_id`,`vocab_id`);

--
-- Chỉ mục cho bảng `study_logs`
--
ALTER TABLE `study_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_date` (`user_id`,`created_at`),
  ADD KEY `idx_user_action` (`user_id`,`action`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `daily_streak`
--
ALTER TABLE `daily_streak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `notebook`
--
ALTER TABLE `notebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `pvp_rooms`
--
ALTER TABLE `pvp_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `radicals`
--
ALTER TABLE `radicals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `srs`
--
ALTER TABLE `srs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `study_logs`
--
ALTER TABLE `study_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `vocab`
--
ALTER TABLE `vocab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

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
-- Các ràng buộc cho bảng `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD CONSTRAINT `fk_course_lessons_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_course_lessons_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `fk_enrollments_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_enrollments_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_enrollments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoices_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_admin` FOREIGN KEY (`confirmed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_payments_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
