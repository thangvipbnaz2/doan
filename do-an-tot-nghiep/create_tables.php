<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=hanyu_db', 'root', '');

// Create user_notes table
$pdo->exec("CREATE TABLE IF NOT EXISTS user_notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    lesson_id INT NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_note (user_id, lesson_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
echo "user_notes table created/verified.\n";

// Create lesson_history table for tracking study history
$pdo->exec("CREATE TABLE IF NOT EXISTS lesson_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    lesson_id INT NOT NULL,
    action VARCHAR(50) NOT NULL DEFAULT 'view',
    duration_seconds INT DEFAULT 0,
    score INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
echo "lesson_history table created/verified.\n";

// Add audio_url column to vocab if not exists
try {
    $pdo->exec("ALTER TABLE vocab ADD COLUMN audio_url VARCHAR(255) DEFAULT NULL AFTER example_vi");
    echo "Added audio_url to vocab.\n";
} catch (PDOException $e) {
    echo "audio_url column in vocab: " . $e->getMessage() . "\n";
}

// Add part_of_speech column to vocab if not exists
try {
    $pdo->exec("ALTER TABLE vocab ADD COLUMN part_of_speech VARCHAR(50) DEFAULT NULL AFTER meaning");
    echo "Added part_of_speech to vocab.\n";
} catch (PDOException $e) {
    echo "part_of_speech column in vocab: " . $e->getMessage() . "\n";
}

echo "Done.\n";
