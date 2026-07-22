<?php
namespace App\Models;

use App\Helpers\Database;

class Achievement extends Model
{
    protected static string $table = 'achievements';
    protected array $fillable = ['user_id', 'type', 'title', 'description', 'icon', 'icon_color', 'xp_reward'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public static function unlock(int $userId, string $type): bool
    {
        $existing = Database::fetch(
            "SELECT id FROM achievements WHERE user_id = ? AND type = ?",
            [$userId, $type]
        );
        if ($existing) return false;

        $definitions = [
            'first_lesson' => ['title' => 'Bước đầu tiên', 'description' => 'Hoàn thành bài học đầu tiên', 'icon' => '🚀'],
            'five_lessons' => ['title' => 'Học sinh chăm chỉ', 'description' => 'Hoàn thành 5 bài học', 'icon' => '📚'],
            'ten_lessons' => ['title' => 'Người học kiên trì', 'description' => 'Hoàn thành 10 bài học', 'icon' => '🎯'],
            'twenty_lessons' => ['title' => 'Chiến binh Hán ngữ', 'description' => 'Hoàn thành 20 bài học', 'icon' => '⚔️'],
            'fifty_vocab' => ['title' => 'Nhà từ vựng', 'description' => 'Học 50 từ vựng', 'icon' => '📖'],
            'hundred_vocab' => ['title' => 'Bách từ', 'description' => 'Học 100 từ vựng', 'icon' => '💯'],
            'three_hundred_vocab' => ['title' => 'Tam bách', 'description' => 'Học 300 từ vựng', 'icon' => '🏛️'],
            'seven_day_streak' => ['title' => 'Tuần không nghỉ', 'description' => '7 ngày liên tiếp', 'icon' => '🔥'],
            'thirty_day_streak' => ['title' => 'Tháng rực lửa', 'description' => '30 ngày liên tiếp', 'icon' => '🌋'],
            'hundred_day_streak' => ['title' => 'Bách nhật', 'description' => '100 ngày liên tiếp', 'icon' => '💎'],
            'first_exam' => ['title' => 'Khởi động', 'description' => 'Hoàn thành bài thi đầu tiên', 'icon' => '📝'],
            'perfect_exam' => ['title' => 'Toàn tài', 'description' => 'Đạt 100% bài thi', 'icon' => '🏆'],
            'first_flashcard' => ['title' => 'Ôn tập đầu tiên', 'description' => 'Ôn tập flashcard lần đầu', 'icon' => '🃏'],
            'hundred_flashcards' => ['title' => 'Cao thủ flashcard', 'description' => 'Ôn tập 100 flashcard', 'icon' => '👑'],
        ];

        $def = $definitions[$type] ?? null;
        if (!$def) return false;

        $model = new static();
        $model->create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $def['title'],
            'description' => $def['description'],
            'icon' => $def['icon'],
        ]);

        Notification::create($userId, 'achievement', $def['title'], $def['description'], null);
        return true;
    }

    public static function checkLessonAchievements(int $userId): void
    {
        $count = Database::fetch(
            "SELECT COUNT(*) as cnt FROM lesson_progress WHERE user_id = ? AND is_completed = 1",
            [$userId]
        )['cnt'] ?? 0;

        if ($count >= 1) self::unlock($userId, 'first_lesson');
        if ($count >= 5) self::unlock($userId, 'five_lessons');
        if ($count >= 10) self::unlock($userId, 'ten_lessons');
        if ($count >= 20) self::unlock($userId, 'twenty_lessons');
    }

    public static function checkVocabAchievements(int $userId): void
    {
        $count = Database::fetch(
            "SELECT COUNT(DISTINCT vocab_id) as cnt FROM progress WHERE user_id = ? AND is_completed = 1 AND vocab_id IS NOT NULL",
            [$userId]
        )['cnt'] ?? 0;

        if ($count >= 50) self::unlock($userId, 'fifty_vocab');
        if ($count >= 100) self::unlock($userId, 'hundred_vocab');
        if ($count >= 300) self::unlock($userId, 'three_hundred_vocab');
    }

    public static function checkStreakAchievements(int $userId): void
    {
        $data = Database::fetch(
            "SELECT streak_days FROM user_streaks WHERE user_id = ?",
            [$userId]
        );
        $streak = (int) ($data['streak_days'] ?? 0);

        if ($streak >= 7) self::unlock($userId, 'seven_day_streak');
        if ($streak >= 30) self::unlock($userId, 'thirty_day_streak');
        if ($streak >= 100) self::unlock($userId, 'hundred_day_streak');
    }

    public static function checkExamAchievements(int $userId): void
    {
        $total = Database::fetch(
            "SELECT COUNT(*) as cnt FROM exam_results WHERE user_id = ?",
            [$userId]
        )['cnt'] ?? 0;

        if ($total >= 1) self::unlock($userId, 'first_exam');

        $perfect = Database::fetch(
            "SELECT COUNT(*) as cnt FROM exam_results WHERE user_id = ? AND percentage >= 100",
            [$userId]
        )['cnt'] ?? 0;

        if ($perfect >= 1) self::unlock($userId, 'perfect_exam');
    }
}
