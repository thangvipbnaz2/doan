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
DROP TABLE IF EXISTS `lesson_history`;
DROP TABLE IF EXISTS `user_notes`;
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
  `topic` VARCHAR(200) DEFAULT NULL,
  `duration_minutes` INT DEFAULT 45,
  `difficulty` ENUM('easy','medium','hard') DEFAULT 'easy',
  `objectives` JSON DEFAULT NULL,
  `banner_url` VARCHAR(500) DEFAULT NULL,
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
-- user_notes (depends on: users, lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `user_notes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `lesson_id` INT NOT NULL,
  `content` TEXT,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_lesson_note` (`user_id`, `lesson_id`),
  CONSTRAINT `fk_user_notes_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_user_notes_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- lesson_history (depends on: users, lessons)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lesson_history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `lesson_id` INT NOT NULL,
  `action` VARCHAR(50) NOT NULL DEFAULT 'view',
  `duration_seconds` INT DEFAULT 0,
  `score` INT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_lesson_history_user` (`user_id`),
  KEY `idx_lesson_history_lesson` (`lesson_id`),
  KEY `idx_lesson_history_date` (`created_at`),
  CONSTRAINT `fk_lesson_history_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_lesson_history_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
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

-- --------------------------------------------------------
-- post_likes (depends on: posts)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `post_likes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_id` INT NOT NULL,
  `user_id` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_post_like` (`post_id`, `user_id`),
  CONSTRAINT `fk_post_likes_post` FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- srs (Spaced Repetition System - depends on: vocab)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `srs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` VARCHAR(50) NOT NULL DEFAULT 'default_user',
  `vocab_id` INT NOT NULL,
  `ease_factor` DECIMAL(3,2) NOT NULL DEFAULT 2.50,
  `interval_days` INT NOT NULL DEFAULT 0,
  `consecutive_correct` INT NOT NULL DEFAULT 0,
  `next_review` DATE DEFAULT NULL,
  `last_reviewed` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_vocab` (`user_id`, `vocab_id`),
  CONSTRAINT `fk_srs_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocab`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- user_achievements (alias for achievements, for backward compat)
-- --------------------------------------------------------
CREATE VIEW IF NOT EXISTS `user_achievements` AS SELECT * FROM `achievements`;

-- --------------------------------------------------------
-- vocab_progress (view for backward compat)
-- --------------------------------------------------------
CREATE VIEW IF NOT EXISTS `vocab_progress` AS
SELECT p.id, p.vocab_id, p.user_id,
       CASE WHEN p.write_completed = 1 OR p.speech_completed = 1 THEN 1 ELSE 0 END as learned,
       p.write_completed, p.speech_completed, p.created_at
FROM progress p WHERE p.vocab_id IS NOT NULL;

-- --------------------------------------------------------
-- user_progress (view for backward compat)
-- --------------------------------------------------------
CREATE VIEW IF NOT EXISTS `user_progress` AS
SELECT u.id as user_id,
       COALESCE(q.total_score, 0) as total_xp,
       COALESCE(l.max_level, 1) as level
FROM users u
LEFT JOIN (SELECT user_id, SUM(score) as total_score FROM quiz_results GROUP BY user_id) q ON q.user_id = CONCAT('user_', u.id)
LEFT JOIN (SELECT lp.user_id, MAX(l.level) as max_level FROM lesson_progress lp JOIN lessons l ON lp.lesson_id = l.id WHERE lp.is_completed = 1 GROUP BY lp.user_id) l ON l.user_id = u.id;

-- --------------------------------------------------------
-- user_streaks (view for backward compat)
-- --------------------------------------------------------
CREATE VIEW IF NOT EXISTS `user_streaks` AS
SELECT ds.user_id,
       COUNT(*) as streak_days,
       MAX(ds.streak_date) as last_activity_date
FROM daily_streak ds
GROUP BY ds.user_id;

-- --------------------------------------------------------
-- exercise_results (view for backward compat)
-- --------------------------------------------------------
CREATE VIEW IF NOT EXISTS `exercise_results` AS
SELECT qr.id, qr.user_id, qr.quiz_type as exercise_type, qr.score, qr.total_questions,
       (qr.score * 100.0 / qr.total_questions) as percentage,
       qr.completed_at, qr.created_at
FROM quiz_results qr WHERE qr.total_questions > 0;

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
('Khóa học HSK 1', 'hsk-1-nen-tang', 'Nền tảng tiếng Trung từ con số 0', 0, 1, 1),
('Khóa học HSK 2', 'hsk-2-giao-tiep', 'Giao tiếp cơ bản hàng ngày', 0, 2, 1),
('Khóa học HSK 3', 'hsk-3-so-cap', 'Sơ cấp nâng cao', 0, 3, 1),
('Khóa học HSK 4', 'hsk-4-trung-cap', 'Trung cấp toàn diện', 0, 4, 1),
('Khóa học HSK 5', 'hsk-5-nang-cao', 'Nâng cao đọc viết', 0, 5, 1),
('Khóa học HSK 6', 'hsk-6-chuyen-sau', 'Chuyên sâu & toàn diện', 0, 6, 1);

-- Link courses to lessons
INSERT INTO `course_lessons` (`course_id`, `lesson_id`, `sort_order`) VALUES
(1, 1, 1), (1, 2, 2), (1, 3, 3), (1, 4, 4), (1, 5, 5), (1, 6, 6), (1, 7, 7), (1, 8, 8), (1, 9, 9), (1, 10, 10), (1, 11, 11), (1, 12, 12), (1, 13, 13), (1, 14, 14), (1, 15, 15),
(2, 16, 1), (2, 17, 2), (2, 18, 3), (2, 19, 4), (2, 20, 5), (2, 21, 6), (2, 22, 7), (2, 23, 8), (2, 24, 9), (2, 25, 10), (2, 26, 11), (2, 27, 12), (2, 28, 13), (2, 29, 14), (2, 30, 15),
(3, 31, 1), (3, 32, 2), (3, 33, 3), (3, 34, 4), (3, 35, 5), (3, 36, 6), (3, 37, 7), (3, 38, 8), (3, 39, 9), (3, 40, 10), (3, 41, 11), (3, 42, 12), (3, 43, 13), (3, 44, 14), (3, 45, 15), (3, 46, 16), (3, 47, 17), (3, 48, 18), (3, 49, 19), (3, 50, 20),
(4, 51, 1), (4, 52, 2), (4, 53, 3), (4, 54, 4), (4, 55, 5), (4, 56, 6), (4, 57, 7), (4, 58, 8), (4, 59, 9), (4, 60, 10), (4, 61, 11), (4, 62, 12), (4, 63, 13), (4, 64, 14), (4, 65, 15), (4, 66, 16), (4, 67, 17), (4, 68, 18), (4, 69, 19), (4, 70, 20),
(5, 71, 1), (5, 72, 2), (5, 73, 3), (5, 74, 4), (5, 75, 5), (5, 76, 6), (5, 77, 7), (5, 78, 8), (5, 79, 9), (5, 80, 10), (5, 81, 11), (5, 82, 12), (5, 83, 13), (5, 84, 14), (5, 85, 15), (5, 86, 16), (5, 87, 17), (5, 88, 18), (5, 89, 19), (5, 90, 20), (5, 91, 21), (5, 92, 22), (5, 93, 23), (5, 94, 24), (5, 95, 25), (5, 96, 26), (5, 97, 27), (5, 98, 28), (5, 99, 29), (5, 100, 30), (5, 101, 31), (5, 102, 32), (5, 103, 33), (5, 104, 34), (5, 105, 35), (5, 106, 36),
(6, 107, 1), (6, 108, 2), (6, 109, 3), (6, 110, 4), (6, 111, 5), (6, 112, 6), (6, 113, 7), (6, 114, 8), (6, 115, 9), (6, 116, 10), (6, 117, 11), (6, 118, 12), (6, 119, 13), (6, 120, 14), (6, 121, 15), (6, 122, 16), (6, 123, 17), (6, 124, 18), (6, 125, 19), (6, 126, 20), (6, 127, 21), (6, 128, 22), (6, 129, 23), (6, 130, 24), (6, 131, 25), (6, 132, 26), (6, 133, 27), (6, 134, 28), (6, 135, 29), (6, 136, 30), (6, 137, 31), (6, 138, 32), (6, 139, 33), (6, 140, 34), (6, 141, 35), (6, 142, 36), (6, 143, 37), (6, 144, 38), (6, 145, 39), (6, 146, 40);

-- --------------------------------------------------------
-- Seed 146 Lessons (HSK1-6)
-- --------------------------------------------------------
INSERT INTO `lessons` (`level`, `lesson_num`, `title`, `description`, `topic`, `duration_minutes`, `difficulty`, `objectives`) VALUES
-- HSK 1: 15 bài (cơ bản về phát âm, chào hỏi, số đếm, gia đình)
(1, 1, 'Chào hỏi cơ bản', 'Học cách chào hỏi và giới thiệu bản thân bằng tiếng Trung.', 'Chào hỏi', 30, 'easy', '["Biết chào hỏi cơ bản: 你好, 您好","Giới thiệu tên: 我叫...","Hỏi thăm sức khỏe: 你好吗？","Nói tạm biệt: 再见"]'),
(1, 2, 'Số đếm và ngày tháng', 'Làm quen với số đếm tiếng Trung từ 1-100 và cách nói ngày tháng.', 'Số đếm', 30, 'easy', '["Đếm số từ 1-100","Nói số điện thoại","Hỏi và trả lời về tuổi","Nói ngày tháng năm"]'),
(1, 3, 'Gia đình và người thân', 'Học từ vựng về gia đình và cách giới thiệu các thành viên.', 'Gia đình', 30, 'easy', '["Gọi tên các thành viên trong gia đình","Giới thiệu về gia đình","Hỏi về số lượng người trong nhà","Sử dụng từ chỉ số nhiều: 们"]'),
(1, 4, 'Màu sắc và đồ vật', 'Nhận biết và gọi tên các màu sắc cơ bản cùng đồ vật quen thuộc.', 'Màu sắc', 30, 'easy', '["Gọi tên 8 màu sắc cơ bản","Miêu tả đồ vật bằng màu sắc","Hỏi về màu sắc yêu thích","Sử dụng tính từ cơ bản"]'),
(1, 5, 'Động vật và thiên nhiên', 'Học từ vựng về động vật và các hiện tượng thiên nhiên đơn giản.', 'Động vật', 30, 'easy', '["Gọi tên 10 loài động vật phổ biến","Miêu tả thời tiết đơn giản","Nói về sở thích nuôi thú cưng","Sử dụng câu trần thuật cơ bản"]'),
(1, 6, 'Đồ ăn và thức uống', 'Tìm hiểu tên gọi các món ăn và đồ uống thông dụng.', 'Ẩm thực', 30, 'easy', '["Gọi tên 10 món ăn phổ biến","Gọi món trong nhà hàng","Nói về khẩu vị","Sử dụng động từ 吃, 喝"]'),
(1, 7, 'Trường học và lớp học', 'Học từ vựng về trường học, lớp học và các vật dụng học tập.', 'Giáo dục', 30, 'easy', '["Gọi tên đồ dùng học tập","Giới thiệu về trường lớp","Hỏi và trả lời về môn học","Sử dụng 有 để chỉ sở hữu"]'),
(1, 8, 'Nghề nghiệp cơ bản', 'Tìm hiểu tên gọi các nghề nghiệp thông dụng.', 'Nghề nghiệp', 30, 'easy', '["Gọi tên 12 nghề nghiệp phổ biến","Hỏi về nghề nghiệp của người khác","Giới thiệu nghề nghiệp bản thân","Sử dụng 是 trong câu giới thiệu"]'),
(1, 9, 'Phương hướng và vị trí', 'Học cách chỉ phương hướng và vị trí đồ vật trong không gian.', 'Phương hướng', 35, 'easy', '["Chỉ 4 hướng cơ bản: 前, 后, 左, 右","Hỏi đường đi đơn giản","Miêu tả vị trí đồ vật","Sử dụng 在 để chỉ vị trí"]'),
(1, 10, 'Thời gian trong ngày', 'Học cách nói giờ giấc và các khoảng thời gian trong ngày.', 'Thời gian', 35, 'easy', '["Nói giờ: 几点","Phân biệt sáng trưa chiều tối","Hỏi và trả lời về thời gian","Sử dụng 点, 分, 半"]'),
(1, 11, 'Mua sắm cơ bản', 'Tình huống mua sắm đơn giản với giá cả và số lượng.', 'Mua sắm', 35, 'easy', '["Hỏi giá: 多少钱","Nói về số lượng","Chọn đồ mua","Sử dụng 要 và 想"]'),
(1, 12, 'Giao thông đơn giản', 'Học từ vựng về các phương tiện di chuyển cơ bản.', 'Giao thông', 35, 'easy', '["Gọi tên phương tiện giao thông","Hỏi về cách đi lại","Nói về lộ trình đơn giản","Sử dụng 坐 và 开"]'),
(1, 13, 'Thời tiết và mùa', 'Tìm hiểu từ vựng về thời tiết và bốn mùa trong năm.', 'Thời tiết', 35, 'easy', '["Gọi tên 4 mùa","Miêu tả thời tiết cơ bản","Nói về nhiệt độ","Sử dụng 冷, 热, 好"]'),
(1, 14, 'Sở thích cá nhân', 'Học cách nói về sở thích và hoạt động giải trí.', 'Sở thích', 35, 'easy', '["Nói về sở thích cá nhân","Hỏi người khác về sở thích","Sử dụng động từ 喜欢","Liệt kê hoạt động hàng ngày"]'),
(1, 15, 'Ôn tập và tổng kết HSK 1', 'Ôn tập toàn bộ kiến thức HSK 1 và luyện tập giao tiếp tổng hợp.', 'Tổng kết', 45, 'easy', '["Ôn tập 150 từ vựng HSK 1","Thực hành hội thoại tổng hợp","Làm bài kiểm tra cuối cấp","Đánh giá tiến độ học tập"]'),

-- HSK 2: 15 bài (giao tiếp hàng ngày)
(2, 1, 'Sinh hoạt hàng ngày', 'Học cách miêu tả thói quen và hoạt động hàng ngày.', 'Sinh hoạt', 40, 'easy', '["Miêu tả thói quen hàng ngày","Sử dụng động từ năng nguyện","Nói về lịch trình cá nhân","Hỏi về thói quen người khác"]'),
(2, 2, 'Nhà cửa và nội thất', 'Từ vựng về nhà cửa, phòng ốc và đồ nội thất.', 'Nhà cửa', 40, 'easy', '["Gọi tên các phòng trong nhà","Miêu tả nội thất","Nói về vị trí đồ đạc","Sử dụng lượng từ"]'),
(2, 3, 'Bạn bè và quan hệ xã hội', 'Học từ vựng và mẫu câu về bạn bè và các mối quan hệ.', 'Quan hệ', 40, 'easy', '["Giới thiệu bạn bè","Nói về tính cách","Mời và nhận lời","Sử dụng 一起"]'),
(2, 4, 'Mua sắm và thương lượng', 'Kỹ năng mua sắm nâng cao với thương lượng giá cả.', 'Mua sắm', 40, 'easy', '["Thương lượng giá","So sánh sản phẩm","Nói về kích cỡ","Sử dụng 比 để so sánh"]'),
(2, 5, 'Nhà hàng và ẩm thực', 'Tình huống gọi món và giao tiếp trong nhà hàng.', 'Ẩm thực', 40, 'easy', '["Gọi món chi tiết","Hỏi về nguyên liệu","Nhận xét món ăn","Yêu cầu phục vụ"]'),
(2, 6, 'Sức khỏe và cơ thể', 'Từ vựng về cơ thể và các vấn đề sức khỏe thông thường.', 'Sức khỏe', 40, 'medium', '["Gọi tên bộ phận cơ thể","Nói về triệu chứng bệnh","Hỏi thăm sức khỏe","Sử dụng 了 chỉ biến đổi"]'),
(2, 7, 'Du lịch và khách sạn', 'Kỹ năng du lịch cơ bản: đặt phòng, check-in khách sạn.', 'Du lịch', 45, 'medium', '["Đặt phòng khách sạn","Check-in và check-out","Hỏi về dịch vụ","Xử lý tình huống phát sinh"]'),
(2, 8, 'Thể thao và vận động', 'Từ vựng về các môn thể thao và hoạt động thể chất.', 'Thể thao', 40, 'medium', '["Gọi tên môn thể thao","Nói về tần suất tập luyện","Mời bạn cùng chơi thể thao","Sử dụng 会 chỉ khả năng"]'),
(2, 9, 'Âm nhạc và giải trí', 'Học từ vựng về âm nhạc, phim ảnh và các hoạt động giải trí.', 'Giải trí', 40, 'medium', '["Nói về thể loại nhạc yêu thích","Bình luận về phim ảnh","Mời đi xem phim","Sử dụng 觉得 để đưa ra ý kiến"]'),
(2, 10, 'Lễ hội và văn hóa Trung Hoa', 'Tìm hiểu về các lễ hội truyền thống Trung Quốc.', 'Văn hóa', 45, 'medium', '["Kể tên lễ hội Trung Quốc","Nói về phong tục ngày Tết","Miêu tả hoạt động lễ hội","Sử dụng 过 để chỉ trải nghiệm"]'),
(2, 11, 'Công viên và thiên nhiên', 'Từ vựng về thiên nhiên và các hoạt động ngoài trời.', 'Thiên nhiên', 40, 'medium', '["Gọi tên cây cối và hoa","Miêu tả cảnh quan","Nói về hoạt động dã ngoại","Sử dụng 正在 cho hành động đang diễn ra"]'),
(2, 12, 'Thư viện và đọc sách', 'Kỹ năng trong thư viện và nói về sách yêu thích.', 'Học tập', 40, 'medium', '["Mượn sách trong thư viện","Nói về thể loại sách","Giới thiệu cuốn sách yêu thích","Sử dụng 过 để nói về kinh nghiệm"]'),
(2, 13, 'Bưu điện và ngân hàng', 'Giao dịch cơ bản tại bưu điện và ngân hàng.', 'Dịch vụ', 45, 'medium', '["Gửi thư và bưu kiện","Mở tài khoản ngân hàng","Đổi tiền","Sử dụng số đếm lớn"]'),
(2, 14, 'Sự kiện và tiệc tùng', 'Từ vựng và mẫu câu về tổ chức và tham gia sự kiện.', 'Sự kiện', 40, 'medium', '["Mời tham dự tiệc","Chúc mừng sinh nhật","Nói về quà tặng","Sử dụng 把 trong câu"]'),
(2, 15, 'Ôn tập và tổng kết HSK 2', 'Ôn tập toàn bộ kiến thức HSK 2, thực hành giao tiếp.', 'Tổng kết', 50, 'medium', '["Ôn tập 150 từ vựng mới","Thực hành hội thoại nâng cao","Kiểm tra đánh giá cuối cấp","Định hướng lên HSK 3"]'),

-- HSK 3: 20 bài (sơ cấp nâng cao)
(3, 1, 'Công việc và văn phòng', 'Từ vựng về môi trường làm việc và giao tiếp công sở.', 'Công việc', 45, 'medium', '["Miêu tả công việc hàng ngày","Giao tiếp với đồng nghiệp","Nói về dự án công việc","Sử dụng 正在 cho hành động tiếp diễn"]'),
(3, 2, 'Giáo dục và học tập', 'Học từ vựng về hệ thống giáo dục và phương pháp học tập.', 'Giáo dục', 45, 'medium', '["Nói về trường học và lớp học","Thảo luận phương pháp học","So sánh các nền giáo dục","Sử dụng 从...到..."]'),
(3, 3, 'Môi trường và bảo vệ thiên nhiên', 'Từ vựng về môi trường và các vấn đề sinh thái.', 'Môi trường', 45, 'medium', '["Nói về ô nhiễm môi trường","Thảo luận giải pháp bảo vệ môi trường","Phân loại rác thải","Sử dụng 越来越"]'),
(3, 4, 'Công nghệ và Internet', 'Từ vựng về công nghệ thông tin và sử dụng Internet.', 'Công nghệ', 45, 'medium', '["Sử dụng máy tính và điện thoại","Nói về mạng xã hội","Thảo luận về công nghệ","Sử dụng 除了...以外"]'),
(3, 5, 'Sức khỏe và y tế', 'Từ vựng nâng cao về sức khỏe và dịch vụ y tế.', 'Sức khỏe', 45, 'medium', '["Đặt lịch hẹn khám bệnh","Miêu tả triệu chứng","Mua thuốc tại nhà thuốc","Sử dụng 得 bổ ngữ chỉ mức độ"]'),
(3, 6, 'Kinh tế và tiền tệ', 'Từ vựng cơ bản về kinh tế và quản lý tài chính cá nhân.', 'Kinh tế', 45, 'medium', '["Nói về tiết kiệm và chi tiêu","Thảo luận về giá cả","Mua bán trực tuyến","Sử dụng 贵 và 便宜"]'),
(3, 7, 'Văn hóa và nghệ thuật', 'Khám phá văn hóa truyền thống và nghệ thuật Trung Quốc.', 'Văn hóa', 50, 'medium', '["Nói về thư pháp Trung Quốc","Giới thiệu hội họa","Thảo luận về âm nhạc truyền thống","Sử dụng 又...又..."]'),
(3, 8, 'Giao thông đô thị', 'Từ vựng về giao thông trong thành phố và các vấn đề liên quan.', 'Giao thông', 45, 'medium', '["Sử dụng tàu điện ngầm","Bắt taxi và xe bus","Nói về tắc đường","Sử dụng 先...然后..."]'),
(3, 9, 'Ẩm thực Trung Hoa', 'Khám phá ẩm thực Trung Hoa và cách chế biến món ăn.', 'Ẩm thực', 50, 'medium', '["Gọi tên món ăn Trung Hoa","Nói về cách chế biến","Miêu tả hương vị","Sử dụng 又...又..."]'),
(3, 10, 'Du lịch khám phá', 'Kỹ năng du lịch nâng cao: lên kế hoạch và khám phá địa điểm mới.', 'Du lịch', 50, 'medium', '["Lên kế hoạch du lịch","Đặt vé máy bay và khách sạn","Hỏi thông tin du lịch","Sử dụng 一边...一边..."]'),
(3, 11, 'Thời trang và phong cách', 'Từ vựng về thời trang, quần áo và phong cách cá nhân.', 'Thời trang', 45, 'medium', '["Miêu tả trang phục","Nói về phong cách thời trang","Mua quần áo và phụ kiện","Sử dụng 着 để miêu tả trạng thái"]'),
(3, 12, 'Cảm xúc và tâm trạng', 'Học cách diễn đạt cảm xúc và tâm trạng bằng tiếng Trung.', 'Cảm xúc', 45, 'medium', '["Diễn đạt cảm xúc cơ bản","Nói về tâm trạng","An ủi và động viên","Sử dụng 有点 và 非常"]'),
(3, 13, 'Lịch sử Trung Quốc', 'Tìm hiểu các sự kiện lịch sử quan trọng của Trung Quốc.', 'Lịch sử', 50, 'hard', '["Kể tên triều đại Trung Quốc","Nói về sự kiện lịch sử","Thảo luận về nhân vật lịch sử","Sử dụng 从...到... chỉ thời gian"]'),
(3, 14, 'Địa lý và danh lam thắng cảnh', 'Từ vựng về địa lý và các địa danh nổi tiếng Trung Quốc.', 'Địa lý', 50, 'hard', '["Gọi tên các thành phố lớn","Miêu tả danh lam thắng cảnh","Nói về đặc điểm địa lý","Sử dụng tính từ so sánh"]'),
(3, 15, 'Báo chí và truyền thông', 'Từ vựng về báo chí, tin tức và các phương tiện truyền thông.', 'Truyền thông', 45, 'hard', '["Đọc tiêu đề báo","Hiểu tin tức cơ bản","Phân biệt các loại báo chí","Sử dụng 被 trong câu bị động"]'),
(3, 16, 'Giải trí và truyền hình', 'Từ vựng về chương trình truyền hình và các hình thức giải trí.', 'Giải trí', 45, 'medium', '["Nói về chương trình TV","Bình luận phim ảnh","Thảo luận về người nổi tiếng","Sử dụng 不但...而且..."]'),
(3, 17, 'Kỳ nghỉ và ngày lễ', 'Học về các kỳ nghỉ và cách lên kế hoạch cho kỳ nghỉ.', 'Kỳ nghỉ', 45, 'medium', '["Lên kế hoạch kỳ nghỉ","Nói về hoạt động trong kỳ nghỉ","Chia sẻ trải nghiệm du lịch","Sử dụng 如果...就..."]'),
(3, 18, 'Mạng xã hội và bạn bè trực tuyến', 'Từ vựng về mạng xã hội và kết bạn trực tuyến.', 'Công nghệ', 45, 'medium', '["Sử dụng WeChat và QQ","Kết bạn trực tuyến","Chia sẻ khoảnh khắc","Sử dụng 为了 để chỉ mục đích"]'),
(3, 19, 'Tình nguyện và cộng đồng', 'Từ vựng về hoạt động tình nguyện và trách nhiệm cộng đồng.', 'Xã hội', 45, 'medium', '["Nói về hoạt động tình nguyện","Thảo luận về trách nhiệm xã hội","Tham gia sự kiện cộng đồng","Sử dụng 应该 và 可以"]'),
(3, 20, 'Ôn tập và tổng kết HSK 3', 'Ôn tập toàn bộ kiến thức HSK 3 và định hướng HSK 4.', 'Tổng kết', 55, 'hard', '["Ôn tập 300 từ vựng mới","Thực hành hội thoại nâng cao","Luyện đọc hiểu","Kiểm tra đánh giá cuối cấp"]'),

-- HSK 4: 20 bài (trung cấp)
(4, 1, 'Kinh doanh và thương mại', 'Từ vựng về môi trường kinh doanh và giao dịch thương mại.', 'Kinh doanh', 50, 'hard', '["Hiểu về hợp đồng thương mại","Giao tiếp trong đàm phán","Thảo luận về thị trường","Sử dụng 对于 và 关于"]'),
(4, 2, 'Khoa học và nghiên cứu', 'Từ vựng khoa học và phương pháp nghiên cứu cơ bản.', 'Khoa học', 50, 'hard', '["Nói về các ngành khoa học","Thảo luận phương pháp nghiên cứu","Đọc tài liệu khoa học","Sử dụng 通过 để chỉ phương thức"]'),
(4, 3, 'Văn học và thơ ca', 'Khám phá văn học Trung Quốc qua các tác phẩm tiêu biểu.', 'Văn học', 55, 'hard', '["Đọc thơ Đường","Hiểu về tiểu thuyết cổ điển","Phân tích tác phẩm văn học","Sử dụng 却 để chỉ sự tương phản"]'),
(4, 4, 'Chính trị và xã hội', 'Từ vựng về hệ thống chính trị và các vấn đề xã hội.', 'Xã hội', 55, 'hard', '["Hiểu về hệ thống chính trị","Thảo luận vấn đề xã hội","Đọc báo chính trị","Sử dụng 对于 và 来说"]'),
(4, 5, 'Giáo dục đại học', 'Từ vựng về môi trường đại học và học thuật.', 'Giáo dục', 50, 'hard', '["Nói về ngành học đại học","Thảo luận về học bổng","Viết email học thuật","Sử dụng 只有...才..."]'),
(4, 6, 'Y học và sức khỏe cộng đồng', 'Từ vựng nâng cao về y tế và sức khỏe cộng đồng.', 'Y tế', 50, 'hard', '["Thảo luận về y học cổ truyền","Nói về tiêm chủng","Đọc chỉ dẫn thuốc","Sử dụng 不仅...而且..."]'),
(4, 7, 'Kiến trúc và đô thị', 'Từ vựng về kiến trúc và phát triển đô thị.', 'Kiến trúc', 50, 'hard', '["Miêu tả phong cách kiến trúc","Nói về quy hoạch đô thị","Thảo luận về nhà ở","Sử dụng 随着"]'),
(4, 8, 'Nông nghiệp và phát triển nông thôn', 'Từ vựng về nông nghiệp và phát triển nông thôn Trung Quốc.', 'Nông nghiệp', 50, 'hard', '["Hiểu về nông nghiệp Trung Quốc","Nói về phát triển nông thôn","Thảo luận về an ninh lương thực","Sử dụng 于 trong văn viết"]'),
(4, 9, 'Kỹ thuật và sản xuất', 'Từ vựng về kỹ thuật, sản xuất và công nghiệp.', 'Kỹ thuật', 50, 'hard', '["Nói về dây chuyền sản xuất","Thảo luận về tự động hóa","Đọc báo cáo kỹ thuật","Sử dụng 由 để chỉ nguồn gốc"]'),
(4, 10, 'Luật pháp và quyền công dân', 'Từ vựng cơ bản về luật pháp và quyền và nghĩa vụ công dân.', 'Luật pháp', 55, 'hard', '["Hiểu về quyền công dân","Nói về luật giao thông","Thảo luận về bảo vệ người tiêu dùng","Sử dụng 根据"]'),
(4, 11, 'Tài chính và đầu tư', 'Từ vựng và khái niệm cơ bản về tài chính và đầu tư.', 'Tài chính', 55, 'hard', '["Hiểu về cổ phiếu và trái phiếu","Nói về gửi tiết kiệm","Thảo luận về đầu tư","Sử dụng 除了...以外...还"]'),
(4, 12, 'Tâm lý học và phát triển bản thân', 'Từ vựng về tâm lý học và phát triển cá nhân.', 'Tâm lý', 50, 'hard', '["Hiểu khái niệm tâm lý cơ bản","Nói về phát triển bản thân","Thảo luận về thói quen tốt","Sử dụng 既...又..."]'),
(4, 13, 'Quan hệ quốc tế', 'Từ vựng về ngoại giao và quan hệ giữa các quốc gia.', 'Quốc tế', 55, 'hard', '["Hiểu về tổ chức quốc tế","Nói về ngoại giao","Thảo luận về toàn cầu hóa","Sử dụng 以 trong văn viết"]'),
(4, 14, 'Triết học và tư tưởng', 'Giới thiệu các trường phái triết học Trung Quốc.', 'Triết học', 55, 'hard', '["Hiểu về Nho giáo","Nói về Đạo giáo","Thảo luận về triết học sống","Sử dụng 之 trong văn viết"]'),
(4, 15, 'Nghệ thuật biểu diễn', 'Từ vựng về sân khấu, điện ảnh và nghệ thuật biểu diễn.', 'Nghệ thuật', 50, 'hard', '["Nói về kinh kịch Trung Quốc","Thảo luận về điện ảnh","Đánh giá buổi biểu diễn","Sử dụng 以...为..."]'),
(4, 16, 'Thể thao chuyên nghiệp', 'Từ vựng nâng cao về thể thao và các giải đấu.', 'Thể thao', 50, 'hard', '["Thảo luận về thể thao chuyên nghiệp","Nói về Olympic","Phân tích trận đấu","Sử dụng 在于"]'),
(4, 17, 'Bảo hiểm và an sinh xã hội', 'Từ vựng về bảo hiểm và hệ thống an sinh xã hội.', 'An sinh', 50, 'hard', '["Hiểu về bảo hiểm xã hội","Nói về bảo hiểm y tế","Thảo luận về hưu trí","Sử dụng 为...所..."]'),
(4, 18, 'Hàng không và vũ trụ', 'Từ vựng về hàng không và khám phá vũ trụ.', 'Hàng không', 50, 'hard', '["Nói về ngành hàng không","Thảo luận về chinh phục vũ trụ","Đọc tin tức về tên lửa","Sử dụng 随着...的发展"]'),
(4, 19, 'Di sản và bảo tồn văn hóa', 'Từ vựng về bảo tồn di sản văn hóa và phát huy giá trị truyền thống.', 'Di sản', 50, 'hard', '["Hiểu về di sản thế giới","Nói về bảo tồn văn hóa","Thảo luận về lễ hội truyền thống","Sử dụng 在...方面"]'),
(4, 20, 'Ôn tập và tổng kết HSK 4', 'Ôn tập toàn bộ kiến thức HSK 4 và chuẩn bị lên HSK 5.', 'Tổng kết', 60, 'hard', '["Ôn tập 600 từ vựng","Luyện đọc báo và tạp chí","Thực hành viết đoạn văn","Kiểm tra tổng hợp cuối cấp"]'),

-- HSK 5: 36 bài (nâng cao)
(5, 1, 'Báo chí và dư luận xã hội', 'Đọc và phân tích tin tức báo chí về các vấn đề xã hội.', 'Báo chí', 55, 'hard', '["Đọc hiểu bài báo dài","Phân tích dư luận xã hội","Viết bình luận","Mở rộng vốn từ báo chí"]'),
(5, 2, 'Kinh tế vĩ mô', 'Từ vựng và khái niệm về kinh tế vĩ mô và chính sách kinh tế.', 'Kinh tế', 55, 'hard', '["Hiểu GDP và tăng trưởng","Nói về lạm phát","Thảo luận về chính sách tiền tệ","Đọc báo cáo kinh tế"]'),
(5, 3, 'Công nghệ thông tin và AI', 'Từ vựng về công nghệ thông tin hiện đại và trí tuệ nhân tạo.', 'Công nghệ', 55, 'hard', '["Thảo luận về AI và Machine Learning","Nói về Big Data","Đọc tin tức công nghệ","Viết về tác động của công nghệ"]'),
(5, 4, 'Biến đổi khí hậu', 'Từ vựng và thảo luận về biến đổi khí hậu và tác động toàn cầu.', 'Môi trường', 55, 'hard', '["Hiểu về hiệu ứng nhà kính","Thảo luận về nước biển dâng","Đọc báo cáo IPCC","Đề xuất giải pháp môi trường"]'),
(5, 5, 'Marketing và quảng cáo', 'Từ vựng về marketing, quảng cáo và xây dựng thương hiệu.', 'Marketing', 55, 'hard', '["Hiểu về chiến lược marketing","Phân tích quảng cáo","Nói về xây dựng thương hiệu","Viết kế hoạch marketing"]'),
(5, 6, 'Quản trị nhân sự', 'Từ vựng về quản lý nhân sự và phát triển tổ chức.', 'Quản trị', 55, 'hard', '["Hiểu về tuyển dụng","Nói về đào tạo nhân viên","Thảo luận về văn hóa doanh nghiệp","Đọc hợp đồng lao động"]'),
(5, 7, 'Bất động sản và nhà ở', 'Từ vựng về thị trường bất động sản và các vấn đề nhà ở.', 'Bất động sản', 55, 'hard', '["Hiểu về thị trường nhà đất","Nói về mua nhà trả góp","Thảo luận về tăng giá nhà","Đọc tin tức bất động sản"]'),
(5, 8, 'Chăm sóc sức khỏe hiện đại', 'Từ vựng về y học hiện đại và các phương pháp chăm sóc sức khỏe.', 'Y tế', 55, 'hard', '["Thảo luận về y học hiện đại","Nói về dinh dưỡng","Hiểu về bệnh mãn tính","Đọc tài liệu y khoa cơ bản"]'),
(5, 9, 'Năng lượng tái tạo', 'Từ vựng về các nguồn năng lượng tái tạo và phát triển bền vững.', 'Năng lượng', 55, 'hard', '["Hiểu về năng lượng mặt trời","Nói về điện gió","Thảo luận về năng lượng hạt nhân","Đọc báo cáo năng lượng"]'),
(5, 10, 'Xã hội số và chuyển đổi số', 'Từ vựng về xã hội số, chính phủ điện tử và chuyển đổi số.', 'Công nghệ', 55, 'hard', '["Hiểu về chuyển đổi số","Nói về thương mại điện tử","Thảo luận về thanh toán số","Viết về tác động của số hóa"]'),
(5, 11, 'Văn hóa doanh nghiệp', 'Từ vựng về văn hóa tổ chức và môi trường làm việc chuyên nghiệp.', 'Kinh doanh', 55, 'hard', '["Hiểu về văn hóa doanh nghiệp Trung Quốc","Nói về đạo đức kinh doanh","Thảo luận về trách nhiệm xã hội","Viết báo cáo doanh nghiệp"]'),
(5, 12, 'Dân số và lao động', 'Từ vựng về dân số học và thị trường lao động.', 'Xã hội', 55, 'hard', '["Hiểu về già hóa dân số","Nói về thị trường lao động","Thảo luận về di cư","Đọc báo cáo dân số"]'),
(5, 13, 'Bản quyền và sở hữu trí tuệ', 'Từ vựng pháp lý về bản quyền và sở hữu trí tuệ.', 'Pháp lý', 55, 'hard', '["Hiểu về luật bản quyền","Nói về vi phạm bản quyền","Bảo vệ sở hữu trí tuệ","Đọc điều luật cơ bản"]'),
(5, 14, 'Ngân hàng và hệ thống tài chính', 'Từ vựng nâng cao về ngân hàng và hệ thống tài chính.', 'Tài chính', 60, 'hard', '["Hiểu về hệ thống ngân hàng","Nói về lãi suất","Thảo luận về rủi ro tài chính","Đọc báo cáo tài chính"]'),
(5, 15, 'Hội nhập quốc tế', 'Từ vựng về toàn cầu hóa và hội nhập quốc tế.', 'Quốc tế', 55, 'hard', '["Hiểu về WTO và FTA","Nói về đầu tư nước ngoài","Thảo luận về hợp tác quốc tế","Đọc tin tức kinh tế quốc tế"]'),
(5, 16, 'Phát triển bền vững', 'Từ vựng về phát triển bền vững và các mục tiêu SDG.', 'Phát triển', 55, 'hard', '["Hiểu về 17 mục tiêu SDG","Nói về phát triển bền vững","Thảo luận về ESG","Viết báo cáo phát triển bền vững"]'),
(5, 17, 'Truyền thông đa phương tiện', 'Từ vựng về truyền thông số và sản xuất nội dung đa phương tiện.', 'Truyền thông', 55, 'hard', '["Hiểu về content marketing","Nói về sản xuất video","Thảo luận về podcast","Đọc kế hoạch truyền thông"]'),
(5, 18, 'Giáo dục trực tuyến', 'Từ vựng về e-learning và phương pháp giáo dục trực tuyến.', 'Giáo dục', 55, 'hard', '["Hiểu về MOOC","Nói về học trực tuyến","Thảo luận về EdTech","Viết review khóa học"]'),
(5, 19, 'Du lịch sinh thái', 'Từ vựng về du lịch bền vững và bảo vệ môi trường du lịch.', 'Du lịch', 55, 'hard', '["Hiểu về du lịch sinh thái","Nói về bảo tồn thiên nhiên","Thảo luận về du lịch cộng đồng","Viết bài giới thiệu điểm đến"]'),
(5, 20, 'Tâm lý học ứng dụng', 'Từ vựng và ứng dụng tâm lý học trong cuộc sống.', 'Tâm lý', 55, 'hard', '["Hiểu về tâm lý học tích cực","Nói về quản lý stress","Thảo luận về EQ","Đọc sách tâm lý"]'),
(5, 21, 'Kiến trúc cảnh quan', 'Từ vựng về thiết kế cảnh quan và kiến trúc xanh.', 'Kiến trúc', 55, 'hard', '["Hiểu về kiến trúc xanh","Nói về quy hoạch đô thị","Thảo luận về không gian xanh","Đọc tạp chí kiến trúc"]'),
(5, 22, 'Nghệ thuật đương đại', 'Từ vựng về nghệ thuật hiện đại và trào lưu nghệ thuật đương đại.', 'Nghệ thuật', 55, 'hard', '["Hiểu về trào lưu nghệ thuật","Nói về triển lãm","Thảo luận về thẩm mỹ","Viết review triển lãm"]'),
(5, 23, 'Robot và tự động hóa', 'Từ vựng về robot, tự động hóa và tương lai việc làm.', 'Công nghệ', 55, 'hard', '["Hiểu về robot công nghiệp","Nói về tự động hóa","Thảo luận về tác động đến việc làm","Đọc tin tức về robot"]'),
(5, 24, 'Thiên tai và ứng phó', 'Từ vựng về thiên tai và các biện pháp ứng phó.', 'Thiên tai', 55, 'hard', '["Hiểu về động đất và sóng thần","Nói về ứng phó thiên tai","Thảo luận về cứu trợ","Đọc tin tức thiên tai"]'),
(5, 25, 'Điện ảnh và kịch bản', 'Từ vựng chuyên ngành điện ảnh và viết kịch bản.', 'Điện ảnh', 55, 'hard', '["Hiểu về quy trình làm phim","Nói về kỹ thuật điện ảnh","Thảo luận về kịch bản","Viết review phim"]'),
(5, 26, 'Ẩm thực phân tử', 'Từ vựng về ẩm thực hiện đại và khoa học ẩm thực.', 'Ẩm thực', 55, 'hard', '["Hiểu về ẩm thực phân tử","Nói về kỹ thuật nấu ăn hiện đại","Thảo luận về xu hướng ẩm thực","Đọc tạp chí ẩm thực"]'),
(5, 27, 'Khiêu vũ và vũ đạo', 'Từ vựng về múa và nghệ thuật vũ đạo.', 'Nghệ thuật', 55, 'hard', '["Hiểu về các loại hình múa","Nói về vũ đạo","Thảo luận về múa đương đại","Đọc phê bình múa"]'),
(5, 28, 'Kỹ năng lãnh đạo', 'Từ vựng về lãnh đạo và quản lý đội nhóm.', 'Quản trị', 55, 'hard', '["Hiểu về phong cách lãnh đạo","Nói về quản lý đội nhóm","Thảo luận về tầm nhìn","Viết bài về lãnh đạo"]'),
(5, 29, 'Kinh tế chia sẻ', 'Từ vựng về kinh tế chia sẻ và các mô hình kinh doanh mới.', 'Kinh tế', 55, 'hard', '["Hiểu về sharing economy","Nói về Uber và Airbnb","Thảo luận về tác động kinh tế","Đọc phân tích kinh tế"]'),
(5, 30, 'Blockchain và tiền số', 'Từ vựng về blockchain, cryptocurrency và ứng dụng.', 'Công nghệ', 60, 'hard', '["Hiểu về blockchain","Nói về Bitcoin và Ethereum","Thảo luận về DeFi","Đọc tin tức crypto"]'),
(5, 31, 'Kỹ năng thuyết trình', 'Từ vựng và kỹ thuật thuyết trình chuyên nghiệp.', 'Kỹ năng', 55, 'hard', '["Hiểu về cấu trúc thuyết trình","Nói về kỹ thuật thuyết phục","Thảo luận về slide design","Thực hành thuyết trình"]'),
(5, 32, 'Ngoại giao văn hóa', 'Từ vựng về ngoại giao văn hóa và sức mạnh mềm.', 'Văn hóa', 55, 'hard', '["Hiểu về sức mạnh mềm","Nói về giao lưu văn hóa","Thảo luận về Viện Khổng Tử","Đọc về ngoại giao văn hóa"]'),
(5, 33, 'Công ích và thiện nguyện', 'Từ vựng về hoạt động từ thiện và trách nhiệm xã hội.', 'Xã hội', 55, 'hard', '["Hiểu về tổ chức phi lợi nhuận","Nói về gây quỹ","Thảo luận về tác động xã hội","Viết kế hoạch thiện nguyện"]'),
(5, 34, 'Thời trang bền vững', 'Từ vựng về thời trang bền vững và tiêu dùng có trách nhiệm.', 'Thời trang', 55, 'hard', '["Hiểu về fast fashion","Nói về thời trang bền vững","Thảo luận về tiêu dùng xanh","Đọc báo cáo ngành thời trang"]'),
(5, 35, 'Hợp tác quốc tế trong giáo dục', 'Từ vựng về hợp tác giáo dục quốc tế và du học.', 'Giáo dục', 60, 'hard', '["Hiểu về du học Trung Quốc","Nói về học bổng CSC","Thảo luận về trao đổi sinh viên","Viết đơn xin học bổng"]'),
(5, 36, 'Ôn tập và tổng kết HSK 5', 'Ôn tập toàn diện kiến thức HSK 5 và định hướng HSK 6.', 'Tổng kết', 65, 'hard', '["Ôn tập 1300 từ vựng","Luyện đọc báo dài","Thực hành viết luận","Kiểm tra đánh giá cuối cấp"]'),

-- HSK 6: 40 bài (chuyên sâu)
(6, 1, 'Văn hóa ứng xử Trung Quốc', 'Từ vựng chuyên sâu về văn hóa ứng xử và giao tiếp xã hội.', 'Văn hóa', 60, 'hard', '["Hiểu về mặt và xã hội","Nói về nghi thức xã giao","Thảo luận về phong tục tập quán","Đọc sách văn hóa"]'),
(6, 2, 'Thành ngữ và tục ngữ Trung Hoa', 'Học 30 thành ngữ Trung Quốc thông dụng và cách sử dụng.', 'Ngôn ngữ', 60, 'hard', '["Hiểu về thành ngữ","Sử dụng 30 thành ngữ thông dụng","Phân biệt thành ngữ và tục ngữ","Viết câu với thành ngữ"]'),
(6, 3, 'Kinh tế Trung Quốc đương đại', 'Phân tích kinh tế Trung Quốc và vai trò toàn cầu.', 'Kinh tế', 60, 'hard', '["Hiểu về mô hình kinh tế Trung Quốc","Nói về cải cách kinh tế","Thảo luận về một vành đai một con đường","Đọc báo cáo kinh tế Trung Quốc"]'),
(6, 4, 'Triết học chính trị Trung Hoa', 'Nghiên cứu tư tưởng chính trị và triết học Trung Hoa.', 'Triết học', 65, 'hard', '["Hiểu về tư tưởng Khổng Tử","Nói về pháp gia","Thảo luận về triết học Mác Trung Quốc","Đọc tác phẩm triết học"]'),
(6, 5, 'Nghệ thuật trà đạo', 'Từ vựng và văn hóa trà đạo Trung Quốc.', 'Văn hóa', 60, 'hard', '["Hiểu về các loại trà","Nói về nghi thức trà đạo","Thảo luận về văn hóa trà","Đọc sách về trà"]'),
(6, 6, 'Y học cổ truyền Trung Quốc', 'Từ vựng chuyên sâu về y học cổ truyền và châm cứu.', 'Y học', 60, 'hard', '["Hiểu về đông y","Nói về châm cứu và bấm huyệt","Thảo luận về dược liệu","Đọc tài liệu y học cổ truyền"]'),
(6, 7, 'Võ thuật Trung Hoa', 'Từ vựng về võ thuật và triết lý võ học.', 'Võ thuật', 60, 'hard', '["Hiểu về các môn phái võ","Nói về Thái Cực Quyền","Thảo luận về võ đạo","Đọc sách võ học"]'),
(6, 8, 'Hội họa và thư pháp', 'Khám phá hội họa và thư pháp truyền thống Trung Hoa.', 'Nghệ thuật', 60, 'hard', '["Hiểu về hội họa thủy mặc","Nói về thư pháp","Thảo luận về mỹ thuật Trung Hoa","Đọc phê bình nghệ thuật"]'),
(6, 9, 'Kiến trúc cổ Trung Hoa', 'Từ vựng về kiến trúc cổ và vườn cảnh Trung Quốc.', 'Kiến trúc', 60, 'hard', '["Hiểu về kiến trúc cung đình","Nói về vườn Tô Châu","Thảo luận về phong thủy","Đọc sách kiến trúc"]'),
(6, 10, 'Văn minh sông Dương Tử', 'Khám phá văn minh lưu vực sông Dương Tử và sông Hoàng Hà.', 'Lịch sử', 65, 'hard', '["Hiểu về văn minh sông Hoàng Hà","Nói về di chỉ khảo cổ","Thảo luận về nguồn gốc văn minh","Đọc tài liệu khảo cổ"]'),
(6, 11, 'Khoa học và công nghệ Trung Quốc', 'Từ vựng về khoa học công nghệ Trung Quốc hiện đại.', 'Khoa học', 60, 'hard', '["Hiểu về thành tựu khoa học Trung Quốc","Nói về Tần Giang Hà","Thảo luận về công nghệ 5G","Đọc tin tức khoa học"]'),
(6, 12, 'Văn hóa ẩm thực Trung Hoa', 'Khám phá văn hóa ẩm thực qua các vùng miền Trung Quốc.', 'Ẩm thực', 60, 'hard', '["Hiểu về ẩm thực Tứ Xuyên","Nói về ẩm thực Quảng Đông","Thảo luận về món ăn Bắc Kinh","Đọc tạp chí ẩm thực"]'),
(6, 13, 'Phong tục hôn nhân Trung Hoa', 'Từ vựng về phong tục hôn nhân và lễ cưới truyền thống.', 'Văn hóa', 60, 'hard', '["Hiểu về nghi lễ cưới hỏi","Nói về tục lệ cưới xin","Thảo luận về hôn nhân hiện đại","Đọc về phong tục cưới"]'),
(6, 14, 'Tôn giáo và tín ngưỡng Trung Hoa', 'Từ vựng về tôn giáo và tín ngưỡng dân gian Trung Quốc.', 'Tôn giáo', 65, 'hard', '["Hiểu về Phật giáo Trung Quốc","Nói về Đạo giáo","Thảo luận về tín ngưỡng dân gian","Đọc kinh sách"]'),
(6, 15, 'Lịch sử hiện đại Trung Quốc', 'Nghiên cứu lịch sử Trung Quốc từ 1840 đến nay.', 'Lịch sử', 65, 'hard', '["Hiểu về chiến tranh Nha phiến","Nói về cách mạng Tân Hợi","Thảo luận về cải cách mở cửa","Đọc sách lịch sử hiện đại"]'),
(6, 16, 'Địa chính trị và an ninh', 'Từ vựng về địa chính trị và các vấn đề an ninh khu vực.', 'Chính trị', 65, 'hard', '["Hiểu về Biển Đông","Nói về quan hệ Trung-Mỹ","Thảo luận về an ninh khu vực","Đọc phân tích địa chính trị"]'),
(6, 17, 'Luật pháp và tư pháp', 'Từ vựng chuyên sâu về hệ thống luật pháp và tư pháp Trung Quốc.', 'Luật pháp', 60, 'hard', '["Hiểu về hệ thống tòa án","Nói về luật dân sự","Thảo luận về cải cách tư pháp","Đọc bản án mẫu"]'),
(6, 18, 'Báo chí Trung Quốc', 'Phân tích hệ thống báo chí và truyền thông Trung Quốc.', 'Truyền thông', 60, 'hard', '["Hiểu về báo chí Trung Quốc","Nói về vai trò của truyền thông","Thảo luận về kiểm duyệt","Đọc báo Nhân Dân"]'),
(6, 19, 'Di cư và đô thị hóa', 'Từ vựng về di cư nông thôn-thành thị và quá trình đô thị hóa.', 'Xã hội', 60, 'hard', '["Hiểu về hộ khẩu","Nói về đô thị hóa Trung Quốc","Thảo luận về di cư lao động","Đọc báo cáo đô thị hóa"]'),
(6, 20, 'Giáo dục Trung Quốc', 'Phân tích hệ thống giáo dục Trung Quốc và kỳ thi Cao khảo.', 'Giáo dục', 60, 'hard', '["Hiểu về hệ thống giáo dục","Nói về kỳ thi đại học","Thảo luận về áp lực học tập","Đọc sách về giáo dục"]'),
(6, 21, 'Văn hóa dân gian Trung Hoa', 'Khám phá văn hóa dân gian và truyền thuyết Trung Hoa.', 'Văn hóa', 60, 'hard', '["Hiểu về thần thoại Trung Hoa","Nói về Tết Trung thu","Thảo luận về Tết Nguyên đán","Đọc truyện dân gian"]'),
(6, 22, 'Ngoại giao và chiến lược', 'Từ vựng về chính sách đối ngoại và chiến lược toàn cầu.', 'Ngoại giao', 65, 'hard', '["Hiểu về chính sách đối ngoại","Nói về chiến lược toàn cầu","Thảo luận về BRICS","Đọc phân tích ngoại giao"]'),
(6, 23, 'Môi trường và sinh thái', 'Từ vựng nâng cao về môi trường và bảo tồn sinh thái.', 'Môi trường', 60, 'hard', '["Hiểu về đa dạng sinh học","Nói về bảo vệ động vật hoang dã","Thảo luận về trung hòa carbon","Đọc báo cáo môi trường"]'),
(6, 24, 'Khoa học vũ trụ', 'Từ vựng về chương trình không gian và thám hiểm vũ trụ.', 'Khoa học', 60, 'hard', '["Hiểu về chương trình Thần Châu","Nói về trạm không gian Thiên Cung","Thảo luận về thám hiểm sao Hỏa","Đọc tin tức vũ trụ"]'),
(6, 25, 'Văn hóa Internet Trung Quốc', 'Phân tích văn hóa Internet và cộng đồng mạng Trung Quốc.', 'Công nghệ', 60, 'hard', '["Hiểu về văn hóa mạng Trung Quốc","Nói về ngôn ngữ mạng","Thảo luận về ảnh hưởng của mạng xã hội","Đọc bài viết trên mạng"]'),
(6, 26, 'Kinh doanh và khởi nghiệp', 'Từ vựng về khởi nghiệp và kinh doanh tại Trung Quốc.', 'Kinh doanh', 60, 'hard', '["Hiểu về hệ sinh thái khởi nghiệp","Nói về đầu tư mạo hiểm","Thảo luận về unicorn Trung Quốc","Viết kế hoạch kinh doanh"]'),
(6, 27, 'Tâm lý học xã hội', 'Từ vựng nâng cao về tâm lý học xã hội và hành vi con người.', 'Tâm lý', 60, 'hard', '["Hiểu về tâm lý đám đông","Nói về định kiến xã hội","Thảo luận về ảnh hưởng xã hội","Đọc nghiên cứu tâm lý"]'),
(6, 28, 'Quản lý chuỗi cung ứng', 'Từ vựng về logistics và quản lý chuỗi cung ứng toàn cầu.', 'Quản trị', 60, 'hard', '["Hiểu về chuỗi cung ứng","Nói về logistics Trung Quốc","Thảo luận về thương mại quốc tế","Đọc báo cáo logistics"]'),
(6, 29, 'Bảo hiểm và quản lý rủi ro', 'Từ vựng nâng cao về bảo hiểm và quản lý rủi ro doanh nghiệp.', 'Tài chính', 60, 'hard', '["Hiểu về các loại bảo hiểm","Nói về quản lý rủi ro","Thảo luận về bảo hiểm nhân thọ","Đọc hợp đồng bảo hiểm"]'),
(6, 30, 'Quy hoạch đô thị thông minh', 'Từ vựng về đô thị thông minh và quy hoạch đô thị bền vững.', 'Kiến trúc', 60, 'hard', '["Hiểu về smart city","Nói về IoT trong đô thị","Thảo luận về giao thông thông minh","Đọc quy hoạch đô thị"]'),
(6, 31, 'Di sản văn hóa phi vật thể', 'Từ vựng về bảo tồn di sản văn hóa phi vật thể Trung Quốc.', 'Di sản', 60, 'hard', '["Hiểu về UNESCO di sản","Nói về nghề thủ công truyền thống","Thảo luận về bảo tồn văn hóa","Đọc tài liệu di sản"]'),
(6, 32, 'Kinh tế biển và hàng hải', 'Từ vựng về kinh tế biển và chiến lược hàng hải.', 'Kinh tế', 60, 'hard', '["Hiểu về kinh tế biển","Nói về cảng biển Trung Quốc","Thảo luận về chiến lược hàng hải","Đọc báo cáo hàng hải"]'),
(6, 33, 'Trí tuệ nhân tạo đạo đức', 'Thảo luận về các vấn đề đạo đức trong phát triển AI.', 'Công nghệ', 60, 'hard', '["Hiểu về AI ethics","Nói về quyền riêng tư","Thảo luận về tương lai việc làm","Viết bài về đạo đức AI"]'),
(6, 34, 'Văn hóa doanh nhân Trung Hoa', 'Phân tích văn hóa kinh doanh và phong cách doanh nhân Trung Hoa.', 'Kinh doanh', 60, 'hard', '["Hiểu về guanxi trong kinh doanh","Nói về phong cách đàm phán","Thảo luận về doanh nhân thành công","Đọc tiểu sử doanh nhân"]'),
(6, 35, 'Biến đổi xã hội', 'Từ vựng về biến đổi xã hội Trung Quốc dưới tác động toàn cầu hóa.', 'Xã hội', 60, 'hard', '["Hiểu về thay đổi xã hội","Nói về tầng lớp trung lưu","Thảo luận về tiêu dùng","Đọc phân tích xã hội"]'),
(6, 36, 'Chính sách xã hội', 'Từ vựng về chính sách phúc lợi và an sinh xã hội Trung Quốc.', 'Xã hội', 60, 'hard', '["Hiểu về chính sách xóa đói giảm nghèo","Nói về bảo hiểm xã hội","Thảo luận về chính sách dân số","Đọc sách chính sách"]'),
(6, 37, 'Ngoại giao nhân dân', 'Từ vựng về ngoại giao nhân dân và giao lưu văn hóa.', 'Ngoại giao', 60, 'hard', '["Hiểu về ngoại giao nhân dân","Nói về giao lưu văn hóa","Thảo luận về thành phố kết nghĩa","Đọc về ngoại giao văn hóa"]'),
(6, 38, 'Kinh tế số Trung Quốc', 'Phân tích nền kinh tế số và các tập đoàn công nghệ Trung Quốc.', 'Kinh tế', 60, 'hard', '["Hiểu về BATX","Nói về Alibaba và Tencent","Thảo luận về kinh tế nền tảng","Đọc báo cáo kinh tế số"]'),
(6, 39, 'Tương lai quan hệ Việt-Trung', 'Thảo luận về triển vọng quan hệ Việt Nam - Trung Quốc.', 'Quốc tế', 65, 'hard', '["Hiểu về quan hệ Việt-Trung","Nói về hợp tác kinh tế","Thảo luận về giao lưu văn hóa","Viết phân tích quan hệ"]'),
(6, 40, 'Ôn tập và tổng kết HSK 6', 'Ôn tập toàn diện kiến thức HSK 6 và tốt nghiệp khóa học.', 'Tổng kết', 70, 'hard', '["Ôn tập 2500 từ vựng","Luyện thi HSK 6","Thực hành viết luận dài","Kiểm tra tổng kết toàn khóa"]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
