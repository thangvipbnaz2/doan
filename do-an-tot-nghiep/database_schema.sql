-- ============================================================================
-- HànNgữ Chinese Learning Platform - Complete Database Schema
-- Graduation Project - DO AN TOT NGHIEP
-- Engine: InnoDB, Charset: utf8mb4, Collation: utf8mb4_unicode_ci
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- ============================================================================
-- DROP ALL TABLES (child tables first, then parents)
-- ============================================================================

DROP TABLE IF EXISTS `flashcard_reviews`;
DROP TABLE IF EXISTS `flashcards`;
DROP TABLE IF EXISTS `grammar_exercises`;
DROP TABLE IF EXISTS `grammar_examples`;
DROP TABLE IF EXISTS `dialogue_sentences`;
DROP TABLE IF EXISTS `listening_questions`;
DROP TABLE IF EXISTS `exam_questions`;
DROP TABLE IF EXISTS `exam_results`;
DROP TABLE IF EXISTS `lesson_progress`;
DROP TABLE IF EXISTS `lesson_sections`;
DROP TABLE IF EXISTS `grammar`;
DROP TABLE IF EXISTS `dialogues`;
DROP TABLE IF EXISTS `readings`;
DROP TABLE IF EXISTS `listening_exercises`;
DROP TABLE IF EXISTS `speaking_exercises`;
DROP TABLE IF EXISTS `writing_exercises`;
DROP TABLE IF EXISTS `study_logs`;
DROP TABLE IF EXISTS `user_goals`;
DROP TABLE IF EXISTS `favorite_words`;
DROP TABLE IF EXISTS `favorite_lessons`;
DROP TABLE IF EXISTS `achievements`;
DROP TABLE IF EXISTS `dictionary_lookup_history`;
DROP TABLE IF EXISTS `progress`;
DROP TABLE IF EXISTS `notebook`;
DROP TABLE IF EXISTS `vocab`;
DROP TABLE IF EXISTS `ai_image_history`;
DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `daily_streak`;
DROP TABLE IF EXISTS `quiz_results`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `course_lessons`;
DROP TABLE IF EXISTS `enrollments`;
DROP TABLE IF EXISTS `invoices`;
DROP TABLE IF EXISTS `payments`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `pvp_rooms`;
DROP TABLE IF EXISTS `lessons`;
DROP TABLE IF EXISTS `levels`;
DROP TABLE IF EXISTS `exam_templates`;
DROP TABLE IF EXISTS `notifications`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `login_attempts`;
DROP TABLE IF EXISTS `password_resets`;
DROP TABLE IF EXISTS `radicals`;

-- ============================================================================
-- CREATE TABLES (parent tables first, then children)
-- ============================================================================

-- --------------------------------------------------------
-- radicals (no dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `radicals` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `char` VARCHAR(10) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `name_vietnamese` VARCHAR(50) NOT NULL,
  `strokes` INT NOT NULL,
  `category` VARCHAR(50) DEFAULT NULL,
  `examples` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- password_resets (no dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- login_attempts (no dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `identifier` VARCHAR(100) NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `attempted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_identifier` (`identifier`),
  INDEX `idx_ip` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- users (no dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(100) DEFAULT NULL,
  `role` VARCHAR(20) DEFAULT 'user',
  `remember_token` VARCHAR(64) DEFAULT NULL,
  `avatar` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- notifications (depends on: users)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `type` ENUM('streak','achievement','reminder','payment','course','system') NOT NULL DEFAULT 'system',
  `title` VARCHAR(200) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `link` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_user_read` (`user_id`, `is_read`),
  CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- exam_templates (no dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `exam_templates` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `level` TINYINT NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `duration_minutes` INT NOT NULL DEFAULT 0,
  `total_questions` INT NOT NULL DEFAULT 0,
  `passing_score` INT NOT NULL DEFAULT 60,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- levels (no dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `levels` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `level` TINYINT NOT NULL UNIQUE,
  `name` VARCHAR(100) NOT NULL,
  `total_lessons` INT NOT NULL DEFAULT 0,
  `total_vocab` INT NOT NULL DEFAULT 0,
  `description` TEXT DEFAULT NULL,
  `icon` VARCHAR(50) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- lessons (depends on: levels - note: lessons.level is just TINYINT, no FK)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `level` INT NOT NULL,
  `lesson_num` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `vocab_count` INT DEFAULT 10,
  `grammar` VARCHAR(255) DEFAULT NULL,
  `type` VARCHAR(50) DEFAULT 'vocab',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_lesson` (`level`, `lesson_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- pvp_rooms (no FK dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pvp_rooms` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `room_code` VARCHAR(6) NOT NULL,
  `player1_id` VARCHAR(50) NOT NULL,
  `player1_name` VARCHAR(100) DEFAULT '',
  `player2_id` VARCHAR(50) DEFAULT NULL,
  `player2_name` VARCHAR(100) DEFAULT '',
  `level` INT DEFAULT 1,
  `quiz_type` VARCHAR(20) DEFAULT 'choice',
  `status` VARCHAR(20) DEFAULT 'waiting',
  `total_questions` INT DEFAULT 10,
  `player1_score` INT DEFAULT 0,
  `player1_total` INT DEFAULT 0,
  `player2_score` INT DEFAULT 0,
  `player2_total` INT DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_code` (`room_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- courses (no FK dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `courses` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `short_description` VARCHAR(500) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `price` DECIMAL(12,0) NOT NULL DEFAULT 0,
  `thumbnail` VARCHAR(500) DEFAULT NULL,
  `hsk_level` TINYINT DEFAULT NULL,
  `is_published` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- orders (depends on: users, courses)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order_code` VARCHAR(40) NOT NULL UNIQUE,
  `user_id` INT NOT NULL,
  `course_id` INT NOT NULL,
  `amount` DECIMAL(12,0) NOT NULL,
  `status` ENUM('pending','paid','expired','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `expires_at` DATETIME DEFAULT NULL,
  `paid_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_orders_course` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE RESTRICT,
  KEY `idx_orders_status_created` (`status`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- payments (depends on: orders, users)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `payments` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `provider` VARCHAR(50) NOT NULL DEFAULT 'bank_qr',
  `provider_transaction_id` VARCHAR(120) DEFAULT NULL UNIQUE,
  `amount` DECIMAL(12,0) NOT NULL,
  `status` ENUM('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `raw_payload` LONGTEXT DEFAULT NULL,
  `confirmed_by` INT DEFAULT NULL,
  `confirmed_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_payments_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_payments_admin` FOREIGN KEY (`confirmed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- invoices (depends on: orders)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `invoice_number` VARCHAR(40) NOT NULL UNIQUE,
  `order_id` INT NOT NULL UNIQUE,
  `issued_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_sent_at` DATETIME DEFAULT NULL,
  CONSTRAINT `fk_invoices_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- enrollments (depends on: users, courses, orders)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `enrollments` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `course_id` INT NOT NULL,
  `order_id` INT NOT NULL,
  `enrolled_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `uq_enrollment` (`user_id`, `course_id`),
  CONSTRAINT `fk_enrollments_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_enrollments_course` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_enrollments_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- course_lessons (depends on: courses, lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_lessons` (
  `course_id` INT NOT NULL,
  `lesson_id` INT NOT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`course_id`, `lesson_id`),
  CONSTRAINT `fk_course_lessons_course` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_course_lessons_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- posts (no FK dependencies)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `author` VARCHAR(100) DEFAULT 'Ẩn danh',
  `tags` VARCHAR(255) DEFAULT NULL,
  `status` VARCHAR(20) DEFAULT 'pending',
  `likes` INT DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- quiz_results (no FK dependencies - user_id is VARCHAR)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `quiz_results` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` VARCHAR(50) DEFAULT 'default_user',
  `quiz_type` VARCHAR(50) NOT NULL,
  `level` INT DEFAULT NULL,
  `score` INT NOT NULL,
  `total_questions` INT NOT NULL,
  `completed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- daily_streak (no FK dependencies - user_id is VARCHAR)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `daily_streak` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` VARCHAR(50) NOT NULL,
  `streak_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_streak` (`user_id`, `streak_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- comments (depends on: posts; self-ref parent_id)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_id` INT NOT NULL,
  `user_id` VARCHAR(50) NOT NULL,
  `author` VARCHAR(100) DEFAULT 'Ẩn danh',
  `content` TEXT NOT NULL,
  `parent_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_post_id` (`post_id`),
  CONSTRAINT `fk_comments_post` FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- ai_image_history (depends on: users)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ai_image_history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `image_path` VARCHAR(500) NOT NULL,
  `detected_text` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_user_id` (`user_id`),
  CONSTRAINT `fk_ai_image_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- vocab (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `vocab` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hanzi` VARCHAR(50) NOT NULL,
  `pinyin` VARCHAR(100) NOT NULL,
  `meaning` VARCHAR(255) NOT NULL,
  `level` INT NOT NULL DEFAULT 1,
  `lesson_id` INT DEFAULT NULL,
  `strokes` INT DEFAULT 0,
  `radical` VARCHAR(100) DEFAULT NULL,
  `example` TEXT DEFAULT NULL,
  `example_vi` TEXT DEFAULT NULL,
  `char_data` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_hanzi_level` (`hanzi`, `level`),
  INDEX `idx_lesson` (`lesson_id`),
  CONSTRAINT `fk_vocab_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- notebook (depends on: vocab)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `notebook` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vocab_id` INT NOT NULL,
  `saved_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` VARCHAR(50) DEFAULT 'default_user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_notebook` (`vocab_id`, `user_id`),
  CONSTRAINT `fk_notebook_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocab`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- progress (depends on: vocab, lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `progress` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vocab_id` INT DEFAULT NULL,
  `lesson_id` INT DEFAULT NULL,
  `user_id` VARCHAR(50) DEFAULT 'default_user',
  `write_completed` TINYINT(1) DEFAULT 0,
  `speech_completed` TINYINT(1) DEFAULT 0,
  `quiz_score` INT DEFAULT 0,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_vocab_progress` (`vocab_id`, `user_id`),
  UNIQUE KEY `unique_lesson_progress` (`lesson_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- grammar (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `grammar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lesson_id` INT NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `formula` VARCHAR(255) DEFAULT NULL,
  `meaning` TEXT DEFAULT NULL,
  `usage` TEXT DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_grammar_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- grammar_examples (depends on: grammar)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `grammar_examples` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grammar_id` INT NOT NULL,
  `example_cn` VARCHAR(500) DEFAULT NULL,
  `example_pinyin` VARCHAR(500) DEFAULT NULL,
  `example_vi` VARCHAR(500) DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_grammar_examples_grammar` FOREIGN KEY (`grammar_id`) REFERENCES `grammar`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- grammar_exercises (depends on: grammar)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `grammar_exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grammar_id` INT NOT NULL,
  `type` ENUM('fill_blank','multiple_choice','transform','sentence_order') NOT NULL DEFAULT 'fill_blank',
  `question` TEXT DEFAULT NULL,
  `options` JSON DEFAULT NULL,
  `answer` VARCHAR(500) DEFAULT NULL,
  `explanation` TEXT DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_grammar_exercises_grammar` FOREIGN KEY (`grammar_id`) REFERENCES `grammar`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- dialogues (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dialogues` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lesson_id` INT NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `context` TEXT DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_dialogues_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- dialogue_sentences (depends on: dialogues)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dialogue_sentences` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dialogue_id` INT NOT NULL,
  `speaker` VARCHAR(50) DEFAULT NULL,
  `speaker_avatar` VARCHAR(255) DEFAULT NULL,
  `chinese` VARCHAR(500) DEFAULT NULL,
  `pinyin` VARCHAR(500) DEFAULT NULL,
  `vietnamese` VARCHAR(500) DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_dialogue_sentences_dialogue` FOREIGN KEY (`dialogue_id`) REFERENCES `dialogues`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- readings (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `readings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lesson_id` INT NOT NULL,
  `title` VARCHAR(255) DEFAULT NULL,
  `content` TEXT DEFAULT NULL,
  `pinyin` TEXT DEFAULT NULL,
  `translation` TEXT DEFAULT NULL,
  `vocabulary_notes` TEXT DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_readings_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- listening_exercises (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `listening_exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lesson_id` INT NOT NULL,
  `title` VARCHAR(255) DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `transcript` TEXT DEFAULT NULL,
  `transcript_pinyin` TEXT DEFAULT NULL,
  `transcript_vi` TEXT DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_listening_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- listening_questions (depends on: listening_exercises)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `listening_questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `listening_id` INT NOT NULL,
  `question` TEXT DEFAULT NULL,
  `options` JSON DEFAULT NULL,
  `answer` VARCHAR(500) DEFAULT NULL,
  `explanation` TEXT DEFAULT NULL,
  `type` ENUM('multiple_choice','fill_blank','true_false') NOT NULL DEFAULT 'multiple_choice',
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_listening_questions_exercise` FOREIGN KEY (`listening_id`) REFERENCES `listening_exercises`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- speaking_exercises (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `speaking_exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lesson_id` INT NOT NULL,
  `instruction` TEXT DEFAULT NULL,
  `target_text` VARCHAR(500) DEFAULT NULL,
  `target_pinyin` VARCHAR(500) DEFAULT NULL,
  `audio_reference` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_speaking_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- writing_exercises (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `writing_exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lesson_id` INT NOT NULL,
  `character_char` VARCHAR(10) DEFAULT NULL,
  `stroke_count` INT DEFAULT NULL,
  `radical` VARCHAR(10) DEFAULT NULL,
  `stroke_animation_svg` TEXT DEFAULT NULL,
  `stroke_order_image` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_writing_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- lesson_sections (depends on: lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lesson_sections` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lesson_id` INT NOT NULL,
  `section_type` ENUM('vocabulary','grammar','dialogue','reading','listening','speaking','writing','flashcard','exercise','summary') NOT NULL DEFAULT 'vocabulary',
  `sort_order` INT NOT NULL DEFAULT 0,
  `title` VARCHAR(255) DEFAULT NULL,
  `content` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lesson_sections_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- lesson_progress (depends on: users, lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lesson_progress` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `lesson_id` INT NOT NULL,
  `vocab_completed` INT NOT NULL DEFAULT 0,
  `grammar_completed` INT NOT NULL DEFAULT 0,
  `dialogue_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `reading_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `listening_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `speaking_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `writing_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `exercise_score` DECIMAL(5,2) DEFAULT NULL,
  `quiz_score` DECIMAL(5,2) DEFAULT NULL,
  `is_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_lesson_progress` (`user_id`, `lesson_id`),
  CONSTRAINT `fk_lesson_progress_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_lesson_progress_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- exam_questions (depends on: exam_templates)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `exam_questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `exam_id` INT NOT NULL,
  `section` ENUM('listening','reading','grammar','writing') NOT NULL DEFAULT 'reading',
  `question_number` INT DEFAULT NULL,
  `question` TEXT DEFAULT NULL,
  `options` JSON DEFAULT NULL,
  `answer` VARCHAR(500) DEFAULT NULL,
  `explanation` TEXT DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `points` INT NOT NULL DEFAULT 1,
  `sort_order` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_exam_questions_template` FOREIGN KEY (`exam_id`) REFERENCES `exam_templates`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- exam_results (depends on: users, exam_templates)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `exam_results` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `exam_id` INT NOT NULL,
  `score` INT NOT NULL DEFAULT 0,
  `total_points` INT NOT NULL DEFAULT 0,
  `answers` JSON DEFAULT NULL,
  `started_at` TIMESTAMP NULL DEFAULT NULL,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_exam_results_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_exam_results_template` FOREIGN KEY (`exam_id`) REFERENCES `exam_templates`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- user_goals (depends on: users)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `user_goals` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `target_hsk_level` TINYINT DEFAULT NULL,
  `daily_goal_minutes` INT NOT NULL DEFAULT 30,
  `daily_vocab_goal` INT NOT NULL DEFAULT 10,
  `start_date` DATE DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_goals_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- study_logs (depends on: users)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `study_logs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `activity_type` ENUM('lesson','vocab','grammar','dialogue','reading','listening','speaking','writing','flashcard','quiz','exam') NOT NULL DEFAULT 'lesson',
  `reference_id` INT DEFAULT NULL,
  `duration_seconds` INT DEFAULT NULL,
  `score` DECIMAL(5,2) DEFAULT NULL,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_user_created` (`user_id`, `created_at`),
  CONSTRAINT `fk_study_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- favorite_words (depends on: users, vocab)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `favorite_words` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `vocab_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_fav_word` (`user_id`, `vocab_id`),
  CONSTRAINT `fk_fav_words_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_fav_words_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocab`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- favorite_lessons (depends on: users, lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `favorite_lessons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `lesson_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_fav_lesson` (`user_id`, `lesson_id`),
  CONSTRAINT `fk_fav_lessons_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_fav_lessons_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- achievements (depends on: users)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `achievements` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `title` VARCHAR(200) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `icon` VARCHAR(50) DEFAULT NULL,
  `unlocked_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_achievements_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- dictionary_lookup_history (depends on: users)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dictionary_lookup_history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `query` VARCHAR(100) NOT NULL,
  `result_type` ENUM('hanzi','pinyin','vietnamese') NOT NULL DEFAULT 'hanzi',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_user_created` (`user_id`, `created_at`),
  CONSTRAINT `fk_dict_lookup_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- flashcards (depends on: users, vocab)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `flashcards` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `vocab_id` INT NOT NULL,
  `ease_factor` DECIMAL(3,2) NOT NULL DEFAULT 2.50,
  `interval_days` INT NOT NULL DEFAULT 0,
  `next_review_date` DATE DEFAULT NULL,
  `review_count` INT NOT NULL DEFAULT 0,
  `last_reviewed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_flashcards_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_flashcards_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocab`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- flashcard_reviews (depends on: flashcards)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `flashcard_reviews` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `flashcard_id` INT NOT NULL,
  `quality` TINYINT DEFAULT NULL,
  `reviewed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_flashcard_reviews_card` FOREIGN KEY (`flashcard_id`) REFERENCES `flashcards`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- SEED DATA
-- ============================================================================

-- --------------------------------------------------------
-- Default HSK Levels
-- --------------------------------------------------------
INSERT INTO `levels` (`level`, `name`, `total_lessons`, `total_vocab`, `description`) VALUES
(1, 'HSK 1 · Nền tảng tiếng Trung từ số 0', 15, 150, 'Dành cho người mới bắt đầu. Làm quen với phát âm, chữ Hán cơ bản và các mẫu câu giao tiếp hàng ngày.'),
(2, 'HSK 2 · Giao tiếp cơ bản', 15, 150, 'Mở rộng vốn từ và cấu trúc ngữ pháp, có thể giao tiếp trong các tình huống quen thuộc hằng ngày.'),
(3, 'HSK 3 · Sơ cấp nâng cao', 20, 300, 'Có thể giao tiếp trong các tình huống học tập, công việc và du lịch ở mức độ cơ bản.'),
(4, 'HSK 4 · Trung cấp toàn diện', 20, 600, 'Có thể thảo luận về các chủ đề xã hội, văn hóa và sử dụng tiếng Trung trôi chảy hơn.'),
(5, 'HSK 5 · Nâng cao đọc viết', 36, 1300, 'Có thể đọc báo chí, xem phim và viết bài luận bằng tiếng Trung.'),
(6, 'HSK 6 · Chuyên sâu & toàn diện', 40, 2500, 'Thông thạo tiếng Trung ở mức độ cao, có thể sử dụng như ngôn ngữ thứ hai.');

-- --------------------------------------------------------
-- Default Courses
-- --------------------------------------------------------
INSERT INTO `courses` (`title`, `slug`, `short_description`, `price`, `hsk_level`, `is_published`) VALUES
('Khóa học HSK 1', 'hsk-1', 'Nền tảng tiếng Trung từ con số 0', 0, 1, 1),
('Khóa học HSK 2', 'hsk-2', 'Giao tiếp cơ bản hàng ngày', 499000, 2, 1),
('Khóa học HSK 3', 'hsk-3', 'Sơ cấp nâng cao', 599000, 3, 1),
('Khóa học HSK 4', 'hsk-4', 'Trung cấp toàn diện', 799000, 4, 1),
('Khóa học HSK 5', 'hsk-5', 'Nâng cao đọc viết', 999000, 5, 1),
('Khóa học HSK 6', 'hsk-6', 'Chuyên sâu & toàn diện', 1299000, 6, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
