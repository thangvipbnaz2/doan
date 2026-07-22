-- ============================================================================
-- HànNgữ Chinese Learning Platform - Complete Database Migration
-- Full MySQL Schema with all tables for MVC architecture
-- Engine: InnoDB, Charset: utf8mb4, Collation: utf8mb4_unicode_ci
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";

DROP TABLE IF EXISTS `admin_logs`;
DROP TABLE IF EXISTS `review_vocabulary`;
DROP TABLE IF EXISTS `flashcard_reviews`;
DROP TABLE IF EXISTS `flashcards`;
DROP TABLE IF EXISTS `exercise_answers`;
DROP TABLE IF EXISTS `exercise_options`;
DROP TABLE IF EXISTS `exercises`;
DROP TABLE IF EXISTS `listening_questions`;
DROP TABLE IF EXISTS `listening_exercises`;
DROP TABLE IF EXISTS `reading`;
DROP TABLE IF EXISTS `dialogue_sentences`;
DROP TABLE IF EXISTS `dialogues`;
DROP TABLE IF EXISTS `grammar_examples`;
DROP TABLE IF EXISTS `grammar`;
DROP TABLE IF EXISTS `vocabulary`;
DROP TABLE IF EXISTS `exam_results`;
DROP TABLE IF EXISTS `exam_questions`;
DROP TABLE IF EXISTS `exams`;
DROP TABLE IF EXISTS `srs_reviews`;
DROP TABLE IF EXISTS `study_logs`;
DROP TABLE IF EXISTS `progress`;
DROP TABLE IF EXISTS `notes`;
DROP TABLE IF EXISTS `favorites`;
DROP TABLE IF EXISTS `lesson_progress`;
DROP TABLE IF EXISTS `user_goals`;
DROP TABLE IF EXISTS `notifications`;
DROP TABLE IF EXISTS `achievements`;
DROP TABLE IF EXISTS `invoices`;
DROP TABLE IF EXISTS `payments`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `course_lessons`;
DROP TABLE IF EXISTS `enrollments`;
DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `lessons`;
DROP TABLE IF EXISTS `hsk_levels`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `password_resets`;
DROP TABLE IF EXISTS `login_attempts`;
DROP TABLE IF EXISTS `users`;

-- ============================================================================
-- USERS & AUTHENTICATION
-- ============================================================================

CREATE TABLE `roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `slug` VARCHAR(50) NOT NULL UNIQUE,
  `description` VARCHAR(255) DEFAULT NULL,
  `permissions` JSON DEFAULT NULL,
  `is_system` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`name`, `slug`, `description`, `is_system`) VALUES
('Admin', 'admin', 'Quản trị viên hệ thống', 1),
('Giáo viên', 'teacher', 'Giáo viên giảng dạy', 1),
('Học viên', 'student', 'Học viên', 1);

CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` INT UNSIGNED DEFAULT 3,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(100) DEFAULT NULL,
  `avatar` VARCHAR(255) DEFAULT NULL,
  `bio` TEXT DEFAULT NULL,
  `phone` VARCHAR(20) DEFAULT NULL,
  `birthdate` DATE DEFAULT NULL,
  `gender` ENUM('male','female','other') DEFAULT NULL,
  `hsk_level` TINYINT UNSIGNED DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `last_login_at` TIMESTAMP NULL DEFAULT NULL,
  `last_login_ip` VARCHAR(45) DEFAULT NULL,
  `settings` JSON DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_username` (`username`),
  UNIQUE KEY `uk_email` (`email`),
  KEY `fk_users_role` (`role_id`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `is_used` TINYINT(1) NOT NULL DEFAULT 0,
  `expires_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_token` (`token`),
  KEY `idx_email` (`email`),
  CONSTRAINT `fk_password_resets_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `login_attempts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `user_agent` VARCHAR(500) DEFAULT NULL,
  `success` TINYINT(1) NOT NULL DEFAULT 0,
  `attempted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_ip` (`ip_address`),
  KEY `idx_user` (`user_id`),
  CONSTRAINT `fk_login_attempts_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- HSK LEVELS
-- ============================================================================

CREATE TABLE `hsk_levels` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `level` TINYINT UNSIGNED NOT NULL UNIQUE,
  `name` VARCHAR(100) NOT NULL,
  `name_vi` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `total_vocab` INT UNSIGNED NOT NULL DEFAULT 0,
  `total_lessons` INT UNSIGNED NOT NULL DEFAULT 0,
  `icon` VARCHAR(50) DEFAULT NULL,
  `sort_order` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- COURSES
-- ============================================================================

CREATE TABLE `courses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `short_description` VARCHAR(500) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `price` DECIMAL(12,0) NOT NULL DEFAULT 0,
  `sale_price` DECIMAL(12,0) DEFAULT NULL,
  `thumbnail` VARCHAR(500) DEFAULT NULL,
  `hsk_level_id` TINYINT UNSIGNED DEFAULT NULL,
  `duration_hours` INT UNSIGNED DEFAULT NULL,
  `difficulty` ENUM('beginner','elementary','intermediate','upper_intermediate','advanced','master') DEFAULT 'beginner',
  `is_published` TINYINT(1) NOT NULL DEFAULT 0,
  `is_free` TINYINT(1) NOT NULL DEFAULT 0,
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `total_lessons` INT UNSIGNED NOT NULL DEFAULT 0,
  `total_vocab` INT UNSIGNED NOT NULL DEFAULT 0,
  `total_students` INT UNSIGNED NOT NULL DEFAULT 0,
  `average_rating` DECIMAL(3,2) DEFAULT 0.00,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `meta_title` VARCHAR(255) DEFAULT NULL,
  `meta_description` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_courses_hsk_level` (`hsk_level_id`),
  CONSTRAINT `fk_courses_hsk_level` FOREIGN KEY (`hsk_level_id`) REFERENCES `hsk_levels`(`level`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- LESSONS
-- ============================================================================

CREATE TABLE `lessons` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` INT UNSIGNED DEFAULT NULL,
  `hsk_level` TINYINT UNSIGNED DEFAULT NULL,
  `lesson_num` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `objectives` JSON DEFAULT NULL,
  `topic` VARCHAR(200) DEFAULT NULL,
  `duration_minutes` INT UNSIGNED DEFAULT 45,
  `difficulty` ENUM('easy','medium','hard') DEFAULT 'easy',
  `thumbnail` VARCHAR(500) DEFAULT NULL,
  `is_free` TINYINT(1) NOT NULL DEFAULT 0,
  `status` ENUM('draft','published','archived') NOT NULL DEFAULT 'draft',
  `summary` TEXT DEFAULT NULL COMMENT 'Tóm tắt bài học',
  `review_notes` TEXT DEFAULT NULL COMMENT 'Ghi chú ôn tập',
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_lesson_order` (`hsk_level`, `lesson_num`),
  KEY `fk_lessons_course` (`course_id`),
  KEY `fk_lessons_hsk_level` (`hsk_level`),
  CONSTRAINT `fk_lessons_course` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_lessons_hsk_level` FOREIGN KEY (`hsk_level`) REFERENCES `hsk_levels`(`level`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `course_lessons` (
  `course_id` INT UNSIGNED NOT NULL,
  `lesson_id` INT UNSIGNED NOT NULL,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`course_id`, `lesson_id`),
  CONSTRAINT `fk_cl_course` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cl_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- VOCABULARY
-- ============================================================================

CREATE TABLE `vocabulary` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED DEFAULT NULL,
  `hsk_level` TINYINT UNSIGNED DEFAULT NULL,
  `hanzi` VARCHAR(50) NOT NULL,
  `pinyin` VARCHAR(100) NOT NULL,
  `meaning` VARCHAR(500) NOT NULL,
  `meaning_vi` VARCHAR(500) DEFAULT NULL,
  `example` TEXT DEFAULT NULL,
  `example_pinyin` VARCHAR(500) DEFAULT NULL,
  `example_vi` TEXT DEFAULT NULL,
  `radical` VARCHAR(50) DEFAULT NULL,
  `stroke_count` INT UNSIGNED DEFAULT NULL,
  `word_type` VARCHAR(50) DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `mnemonic` TEXT DEFAULT NULL,
  `frequency` INT UNSIGNED DEFAULT 0,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_hanzi_level` (`hanzi`, `hsk_level`),
  KEY `idx_lesson` (`lesson_id`),
  KEY `idx_hsk_level` (`hsk_level`),
  CONSTRAINT `fk_vocab_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_vocab_hsk_level` FOREIGN KEY (`hsk_level`) REFERENCES `hsk_levels`(`level`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- GRAMMAR
-- ============================================================================

CREATE TABLE `grammar` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `formula` VARCHAR(500) DEFAULT NULL,
  `meaning` TEXT DEFAULT NULL,
  `meaning_vi` TEXT DEFAULT NULL,
  `usage` TEXT DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_grammar_lesson` (`lesson_id`),
  CONSTRAINT `fk_grammar_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `grammar_examples` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `grammar_id` INT UNSIGNED NOT NULL,
  `example_cn` VARCHAR(500) NOT NULL,
  `example_pinyin` VARCHAR(500) DEFAULT NULL,
  `example_vi` VARCHAR(500) DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_ge_grammar` (`grammar_id`),
  CONSTRAINT `fk_ge_grammar` FOREIGN KEY (`grammar_id`) REFERENCES `grammar`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- DIALOGUES
-- ============================================================================

CREATE TABLE `dialogues` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `context` TEXT DEFAULT NULL,
  `context_vi` TEXT DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_dialogues_lesson` (`lesson_id`),
  CONSTRAINT `fk_dialogues_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `dialogue_sentences` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `dialogue_id` INT UNSIGNED NOT NULL,
  `speaker` VARCHAR(50) NOT NULL,
  `speaker_avatar` VARCHAR(255) DEFAULT NULL,
  `chinese` VARCHAR(500) NOT NULL,
  `pinyin` VARCHAR(500) DEFAULT NULL,
  `vietnamese` VARCHAR(500) DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_ds_dialogue` (`dialogue_id`),
  CONSTRAINT `fk_ds_dialogue` FOREIGN KEY (`dialogue_id`) REFERENCES `dialogues`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- READING
-- ============================================================================

CREATE TABLE `reading` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `pinyin` TEXT DEFAULT NULL,
  `translation` TEXT DEFAULT NULL,
  `vocabulary_notes` TEXT DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `difficulty` ENUM('easy','medium','hard') DEFAULT 'easy',
  `word_count` INT UNSIGNED DEFAULT NULL,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_reading_lesson` (`lesson_id`),
  CONSTRAINT `fk_reading_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- LISTENING
-- ============================================================================

CREATE TABLE `listening_exercises` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `audio_url` VARCHAR(255) NOT NULL,
  `transcript` TEXT DEFAULT NULL,
  `transcript_pinyin` TEXT DEFAULT NULL,
  `transcript_vi` TEXT DEFAULT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `duration_seconds` INT UNSIGNED DEFAULT NULL,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_listening_lesson` (`lesson_id`),
  CONSTRAINT `fk_listening_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `listening_questions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `listening_id` INT UNSIGNED NOT NULL,
  `question` TEXT NOT NULL,
  `options` JSON DEFAULT NULL,
  `correct_answer` VARCHAR(500) NOT NULL,
  `explanation` TEXT DEFAULT NULL,
  `type` ENUM('multiple_choice','fill_blank','true_false') NOT NULL DEFAULT 'multiple_choice',
  `points` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_lq_listening` (`listening_id`),
  CONSTRAINT `fk_lq_listening` FOREIGN KEY (`listening_id`) REFERENCES `listening_exercises`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- EXERCISES
-- ============================================================================

CREATE TABLE `exercises` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED DEFAULT NULL,
  `grammar_id` INT UNSIGNED DEFAULT NULL,
  `vocab_id` INT UNSIGNED DEFAULT NULL,
  `title` VARCHAR(255) DEFAULT NULL,
  `instruction` TEXT DEFAULT NULL,
  `type` ENUM('multiple_choice','fill_blank','true_false','matching','sentence_order','translation','listening','writing','speaking') NOT NULL DEFAULT 'multiple_choice',
  `difficulty` ENUM('easy','medium','hard') DEFAULT 'easy',
  `points` TINYINT UNSIGNED NOT NULL DEFAULT 1,
  `correct_answer` TEXT DEFAULT NULL COMMENT 'Đáp án đúng cho dạng bài không có options',
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_exercises_lesson` (`lesson_id`),
  KEY `fk_exercises_grammar` (`grammar_id`),
  KEY `fk_exercises_vocab` (`vocab_id`),
  CONSTRAINT `fk_exercises_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_exercises_grammar` FOREIGN KEY (`grammar_id`) REFERENCES `grammar`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_exercises_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocabulary`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `exercise_options` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `exercise_id` INT UNSIGNED NOT NULL,
  `option_text` TEXT NOT NULL,
  `option_label` VARCHAR(10) DEFAULT NULL,
  `is_correct` TINYINT(1) NOT NULL DEFAULT 0,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_eo_exercise` (`exercise_id`),
  CONSTRAINT `fk_eo_exercise` FOREIGN KEY (`exercise_id`) REFERENCES `exercises`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `exercise_answers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `exercise_id` INT UNSIGNED NOT NULL,
  `selected_option_id` INT UNSIGNED DEFAULT NULL,
  `answer_text` TEXT DEFAULT NULL,
  `is_correct` TINYINT(1) NOT NULL DEFAULT 0,
  `score` DECIMAL(5,2) DEFAULT NULL,
  `time_spent_seconds` INT UNSIGNED DEFAULT NULL,
  `attempted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_ea_user` (`user_id`),
  KEY `fk_ea_exercise` (`exercise_id`),
  KEY `fk_ea_option` (`selected_option_id`),
  CONSTRAINT `fk_ea_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ea_exercise` FOREIGN KEY (`exercise_id`) REFERENCES `exercises`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ea_option` FOREIGN KEY (`selected_option_id`) REFERENCES `exercise_options`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- REVIEW VOCABULARY (Ôn tập từ vựng cuối bài)
-- ============================================================================

CREATE TABLE IF NOT EXISTS `review_vocabulary` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED NOT NULL,
  `vocab_id` INT UNSIGNED NOT NULL,
  `review_type` ENUM('core','supplement','challenge') NOT NULL DEFAULT 'core' COMMENT 'Loại ôn tập: cốt lõi, bổ sung, thử thách',
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_lesson_vocab` (`lesson_id`, `vocab_id`),
  KEY `fk_rv_vocab` (`vocab_id`),
  CONSTRAINT `fk_rv_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rv_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocabulary`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- FLASHCARDS & SRS
-- ============================================================================

CREATE TABLE `flashcards` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `vocab_id` INT UNSIGNED NOT NULL,
  `lesson_id` INT UNSIGNED DEFAULT NULL,
  `ease_factor` DECIMAL(4,2) NOT NULL DEFAULT 2.50,
  `interval_days` INT UNSIGNED NOT NULL DEFAULT 0,
  `interval_step` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `consecutive_correct` INT UNSIGNED NOT NULL DEFAULT 0,
  `next_review_at` DATE DEFAULT NULL,
  `review_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `lapse_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `last_reviewed_at` TIMESTAMP NULL DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_vocab` (`user_id`, `vocab_id`),
  KEY `fk_flashcards_vocab` (`vocab_id`),
  CONSTRAINT `fk_flashcards_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_flashcards_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocabulary`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `flashcard_reviews` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `flashcard_id` INT UNSIGNED NOT NULL,
  `quality` TINYINT UNSIGNED NOT NULL COMMENT '0-5 SM-2 quality score',
  `response_time_ms` INT UNSIGNED DEFAULT NULL,
  `reviewed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_fr_flashcard` (`flashcard_id`),
  CONSTRAINT `fk_fr_flashcard` FOREIGN KEY (`flashcard_id`) REFERENCES `flashcards`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `srs_reviews` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `vocab_id` INT UNSIGNED NOT NULL,
  `review_type` ENUM('new','learning','review','relearning') NOT NULL DEFAULT 'new',
  `quality` TINYINT UNSIGNED NOT NULL,
  `ease_factor` DECIMAL(4,2) NOT NULL,
  `interval_days` INT UNSIGNED NOT NULL,
  `response_time_ms` INT UNSIGNED DEFAULT NULL,
  `reviewed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_srs_user` (`user_id`),
  KEY `fk_srs_vocab` (`vocab_id`),
  CONSTRAINT `fk_srs_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_srs_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocabulary`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- STUDY LOGS
-- ============================================================================

CREATE TABLE `study_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `activity_type` ENUM('lesson','vocab','grammar','dialogue','reading','listening','speaking','writing','flashcard','exercise','exam','review') NOT NULL DEFAULT 'lesson',
  `reference_id` INT UNSIGNED DEFAULT NULL,
  `reference_type` VARCHAR(50) DEFAULT NULL,
  `duration_seconds` INT UNSIGNED DEFAULT NULL,
  `score` DECIMAL(5,2) DEFAULT NULL,
  `details` JSON DEFAULT NULL,
  `logged_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_date` (`user_id`, `logged_at`),
  CONSTRAINT `fk_study_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- PROGRESS
-- ============================================================================

CREATE TABLE `progress` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `lesson_id` INT UNSIGNED DEFAULT NULL,
  `vocab_id` INT UNSIGNED DEFAULT NULL,
  `exercise_id` INT UNSIGNED DEFAULT NULL,
  `is_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `score` DECIMAL(5,2) DEFAULT NULL,
  `time_spent_seconds` INT UNSIGNED DEFAULT NULL,
  `attempts` INT UNSIGNED NOT NULL DEFAULT 0,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_lesson_vocab` (`user_id`, `lesson_id`, `vocab_id`),
  KEY `fk_progress_lesson` (`lesson_id`),
  KEY `fk_progress_vocab` (`vocab_id`),
  CONSTRAINT `fk_progress_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_progress_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_progress_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocabulary`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- FAVORITES
-- ============================================================================

CREATE TABLE `favorites` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `favorable_type` ENUM('vocab','lesson','grammar','dialogue','reading') NOT NULL,
  `favorable_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_favorite` (`user_id`, `favorable_type`, `favorable_id`),
  CONSTRAINT `fk_favorites_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- NOTES
-- ============================================================================

CREATE TABLE `notes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `lesson_id` INT UNSIGNED DEFAULT NULL,
  `vocab_id` INT UNSIGNED DEFAULT NULL,
  `title` VARCHAR(255) DEFAULT NULL,
  `content` TEXT NOT NULL,
  `color` VARCHAR(20) DEFAULT '#fff',
  `is_public` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_lesson` (`user_id`, `lesson_id`),
  CONSTRAINT `fk_notes_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_notes_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_notes_vocab` FOREIGN KEY (`vocab_id`) REFERENCES `vocabulary`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- NOTIFICATIONS
-- ============================================================================

CREATE TABLE `notifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `type` ENUM('system','achievement','reminder','payment','course','lesson','streak','exam') NOT NULL DEFAULT 'system',
  `title` VARCHAR(200) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `link` VARCHAR(500) DEFAULT NULL,
  `icon` VARCHAR(50) DEFAULT NULL,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `read_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_read` (`user_id`, `is_read`),
  CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- ACHIEVEMENTS
-- ============================================================================

CREATE TABLE `achievements` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `icon` VARCHAR(50) DEFAULT NULL,
  `icon_color` VARCHAR(20) DEFAULT NULL,
  `xp_reward` INT UNSIGNED NOT NULL DEFAULT 0,
  `unlocked_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_achievement` (`user_id`, `type`),
  CONSTRAINT `fk_achievements_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- LESSON PROGRESS
-- ============================================================================

CREATE TABLE `lesson_progress` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `lesson_id` INT UNSIGNED NOT NULL,
  `vocab_completed` INT UNSIGNED NOT NULL DEFAULT 0,
  `vocab_total` INT UNSIGNED NOT NULL DEFAULT 0,
  `grammar_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `dialogue_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `reading_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `listening_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `exercise_score` DECIMAL(5,2) DEFAULT NULL,
  `is_completed` TINYINT(1) NOT NULL DEFAULT 0,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_lesson` (`user_id`, `lesson_id`),
  CONSTRAINT `fk_lp_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_lp_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- USER GOALS
-- ============================================================================

CREATE TABLE `user_goals` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `target_hsk_level` TINYINT UNSIGNED DEFAULT NULL,
  `daily_goal_minutes` INT UNSIGNED NOT NULL DEFAULT 30,
  `daily_vocab_goal` INT UNSIGNED NOT NULL DEFAULT 10,
  `daily_exercise_goal` INT UNSIGNED NOT NULL DEFAULT 5,
  `start_date` DATE DEFAULT NULL,
  `target_date` DATE DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_goal` (`user_id`),
  CONSTRAINT `fk_ug_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- EXAMS
-- ============================================================================

CREATE TABLE `exams` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `hsk_level` TINYINT UNSIGNED DEFAULT NULL,
  `lesson_id` INT UNSIGNED DEFAULT NULL,
  `duration_minutes` INT UNSIGNED NOT NULL DEFAULT 60,
  `total_questions` INT UNSIGNED NOT NULL DEFAULT 0,
  `total_points` INT UNSIGNED NOT NULL DEFAULT 0,
  `passing_score` DECIMAL(5,2) NOT NULL DEFAULT 60.00,
  `type` ENUM('hsk_mock','lesson_test','level_test','practice') NOT NULL DEFAULT 'lesson_test',
  `is_random` TINYINT(1) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `attempts_allowed` INT UNSIGNED NOT NULL DEFAULT 0,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_exams_hsk_level` (`hsk_level`),
  KEY `fk_exams_lesson` (`lesson_id`),
  CONSTRAINT `fk_exams_hsk_level` FOREIGN KEY (`hsk_level`) REFERENCES `hsk_levels`(`level`) ON DELETE SET NULL,
  CONSTRAINT `fk_exams_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `exam_questions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `exam_id` INT UNSIGNED NOT NULL,
  `section` ENUM('listening','reading','grammar','vocabulary','writing') NOT NULL DEFAULT 'reading',
  `question_number` INT UNSIGNED DEFAULT NULL,
  `question` TEXT NOT NULL,
  `question_type` ENUM('multiple_choice','fill_blank','true_false','matching','essay') NOT NULL DEFAULT 'multiple_choice',
  `options` JSON DEFAULT NULL,
  `correct_answer` VARCHAR(500) NOT NULL,
  `explanation` TEXT DEFAULT NULL,
  `audio_url` VARCHAR(255) DEFAULT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `points` DECIMAL(5,2) NOT NULL DEFAULT 1.00,
  `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_eq_exam` (`exam_id`),
  CONSTRAINT `fk_eq_exam` FOREIGN KEY (`exam_id`) REFERENCES `exams`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- EXAM RESULTS
-- ============================================================================

CREATE TABLE `exam_results` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `exam_id` INT UNSIGNED NOT NULL,
  `score` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `total_points` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `percentage` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `is_passed` TINYINT(1) NOT NULL DEFAULT 0,
  `answers` JSON DEFAULT NULL,
  `section_scores` JSON DEFAULT NULL,
  `time_spent_seconds` INT UNSIGNED DEFAULT NULL,
  `attempt_number` INT UNSIGNED NOT NULL DEFAULT 1,
  `started_at` TIMESTAMP NULL DEFAULT NULL,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_er_user` (`user_id`),
  KEY `fk_er_exam` (`exam_id`),
  CONSTRAINT `fk_er_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_er_exam` FOREIGN KEY (`exam_id`) REFERENCES `exams`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- PAYMENTS & ORDERS
-- ============================================================================

CREATE TABLE `orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_code` VARCHAR(40) NOT NULL UNIQUE,
  `user_id` INT UNSIGNED NOT NULL,
  `course_id` INT UNSIGNED DEFAULT NULL,
  `amount` DECIMAL(12,0) NOT NULL,
  `discount` DECIMAL(12,0) NOT NULL DEFAULT 0,
  `total` DECIMAL(12,0) NOT NULL,
  `status` ENUM('pending','paid','expired','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `payment_method` VARCHAR(50) DEFAULT NULL,
  `transaction_id` VARCHAR(120) DEFAULT NULL,
  `fullname` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `phone` VARCHAR(20) DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `expires_at` DATETIME DEFAULT NULL,
  `paid_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_orders_user` (`user_id`),
  KEY `fk_orders_course` (`course_id`),
  KEY `idx_status_created` (`status`, `created_at`),
  CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_orders_course` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `payments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` INT UNSIGNED NOT NULL,
  `provider` VARCHAR(50) NOT NULL DEFAULT 'bank_transfer',
  `provider_transaction_id` VARCHAR(120) DEFAULT NULL UNIQUE,
  `amount` DECIMAL(12,0) NOT NULL,
  `fee` DECIMAL(12,0) NOT NULL DEFAULT 0,
  `status` ENUM('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `payment_details` JSON DEFAULT NULL,
  `confirmed_by` INT UNSIGNED DEFAULT NULL,
  `confirmed_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_payments_order` (`order_id`),
  CONSTRAINT `fk_payments_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_payments_admin` FOREIGN KEY (`confirmed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `invoices` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_number` VARCHAR(40) NOT NULL UNIQUE,
  `order_id` INT UNSIGNED NOT NULL UNIQUE,
  `company_name` VARCHAR(255) DEFAULT NULL,
  `tax_code` VARCHAR(50) DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `issued_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_sent_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_invoices_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- ENROLLMENTS
-- ============================================================================

CREATE TABLE `enrollments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `course_id` INT UNSIGNED NOT NULL,
  `order_id` INT UNSIGNED DEFAULT NULL,
  `progress` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `enrolled_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_course` (`user_id`, `course_id`),
  CONSTRAINT `fk_enrollments_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_enrollments_course` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_enrollments_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- ADMIN LOGS
-- ============================================================================

CREATE TABLE `admin_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` INT UNSIGNED NOT NULL,
  `action` VARCHAR(100) NOT NULL,
  `entity_type` VARCHAR(50) DEFAULT NULL,
  `entity_id` INT UNSIGNED DEFAULT NULL,
  `old_values` JSON DEFAULT NULL,
  `new_values` JSON DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` VARCHAR(500) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_admin_action` (`admin_id`, `created_at`),
  CONSTRAINT `fk_admin_logs_user` FOREIGN KEY (`admin_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
