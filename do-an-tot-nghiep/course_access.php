<?php
/**
 * Server-side access helpers for paid courses.
 *
 * The rest of the learning site predates paid courses and has public lesson
 * pages.  These helpers are deliberately used by the paid-course portal and
 * its lesson wrapper so that an enrolment is always checked on the server,
 * rather than trusting a value supplied by JavaScript.
 */

function courseAccessCurrentUserId(): int
{
    if (empty($_SESSION['user_id'])) {
        throw new RuntimeException('Vui lòng đăng nhập để vào khóa học.', 401);
    }

    return (int) $_SESSION['user_id'];
}

function courseAccessIsAdmin(PDO $conn, int $userId): bool
{
    $statement = $conn->prepare('SELECT role FROM users WHERE id = ? LIMIT 1');
    $statement->execute([$userId]);

    return $statement->fetchColumn() === 'admin';
}

function courseAccessProgressUserIds(int $userId): array
{
    // The pre-existing progress table stores front-end users as "user_12".
    // Also accept the numeric representation for data created by older pages.
    return ['user_' . $userId, (string) $userId];
}

/**
 * Return an accessible course and its enrolment metadata.
 * Administrators may preview a course without purchasing it; all other users
 * must have a row in enrollments.
 */
function courseAccessRequireEnrollment(PDO $conn, string $slug): array
{
    $slug = trim($slug);
    if ($slug === '') {
        throw new RuntimeException('Thiếu thông tin khóa học.', 404);
    }

    $userId = courseAccessCurrentUserId();
    $courseStatement = $conn->prepare('SELECT * FROM courses WHERE slug = ? LIMIT 1');
    $courseStatement->execute([$slug]);
    $course = $courseStatement->fetch();

    if (!$course) {
        throw new RuntimeException('Không tìm thấy khóa học.', 404);
    }

    $isAdmin = courseAccessIsAdmin($conn, $userId);
    $enrollmentStatement = $conn->prepare(
        'SELECT id, enrolled_at FROM enrollments WHERE user_id = ? AND course_id = ? LIMIT 1'
    );
    $enrollmentStatement->execute([$userId, $course['id']]);
    $enrollment = $enrollmentStatement->fetch();

    if (!$enrollment && !$isAdmin) {
        throw new RuntimeException('Bạn chưa sở hữu khóa học này.', 403);
    }

    $course['enrollment_id'] = $enrollment['id'] ?? null;
    $course['enrolled_at'] = $enrollment['enrolled_at'] ?? null;
    $course['admin_preview'] = $isAdmin && !$enrollment;
    $course['access_user_id'] = $userId;

    return $course;
}

/**
 * Load the curriculum and the current user's completion status for every
 * lesson. The progress lookup uses only server-derived user IDs.
 */
function courseAccessCurriculum(PDO $conn, int $courseId, int $userId): array
{
    [$legacyProgressUserId, $numericProgressUserId] = courseAccessProgressUserIds($userId);

    $statement = $conn->prepare(
        'SELECT
            l.id,
            l.level,
            l.lesson_num,
            l.title,
            l.description,
            COALESCE(l.vocab_count, 0) AS vocab_count,
            l.grammar,
            l.type,
            cl.sort_order,
            CASE WHEN EXISTS (
                SELECT 1
                FROM progress p
                WHERE p.lesson_id = l.id
                  AND p.user_id IN (?, ?)
                  AND (COALESCE(p.write_completed, 0) = 1
                       OR COALESCE(p.speech_completed, 0) = 1
                       OR p.completed_at IS NOT NULL)
            ) THEN 1 ELSE 0 END AS completed,
            (
                SELECT p.completed_at
                FROM progress p
                WHERE p.lesson_id = l.id
                  AND p.user_id IN (?, ?)
                ORDER BY p.completed_at DESC, p.id DESC
                LIMIT 1
            ) AS completed_at
        FROM course_lessons cl
        INNER JOIN lessons l ON l.id = cl.lesson_id
        WHERE cl.course_id = ?
        ORDER BY cl.sort_order ASC, l.lesson_num ASC, l.id ASC'
    );
    $statement->execute([
        $legacyProgressUserId,
        $numericProgressUserId,
        $legacyProgressUserId,
        $numericProgressUserId,
        $courseId,
    ]);

    return $statement->fetchAll();
}

/**
 * Ensure a lesson is actually part of the purchased course. This prevents a
 * user who owns HSK 1 from opening an arbitrary lesson through a crafted URL.
 */
function courseAccessRequireCourseLesson(PDO $conn, int $courseId, int $lessonId): array
{
    if ($lessonId <= 0) {
        throw new RuntimeException('Bài học không hợp lệ.', 404);
    }

    $statement = $conn->prepare(
        'SELECT l.id, l.level, l.lesson_num, l.title, cl.sort_order
         FROM course_lessons cl
         INNER JOIN lessons l ON l.id = cl.lesson_id
         WHERE cl.course_id = ? AND cl.lesson_id = ?
         LIMIT 1'
    );
    $statement->execute([$courseId, $lessonId]);
    $lesson = $statement->fetch();

    if (!$lesson) {
        throw new RuntimeException('Bài học không thuộc khóa học này.', 403);
    }

    return $lesson;
}

