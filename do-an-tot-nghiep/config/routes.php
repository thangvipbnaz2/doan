<?php
use App\Router;

return function (Router $router) {
    // ============================================================
    // Frontend Routes
    // ============================================================
    $router->get('/', ['App\Controllers\Frontend\HomeController', 'index'])->name('home');
    $router->get('/dashboard', ['App\Controllers\Frontend\DashboardController', 'index'])->name('dashboard');
    $router->get('/lessons', ['App\Controllers\Frontend\LessonController', 'index'])->name('lessons.index');
    $router->get('/lesson/{id}', ['App\Controllers\Frontend\LessonController', 'show'])->name('lessons.show');
    $router->get('/notifications', ['App\Controllers\Frontend\NotificationController', 'index'])->name('notifications.index');
    $router->get('/notifications/mark-read/{id}', ['App\Controllers\Frontend\NotificationController', 'markRead'])->name('notifications.markRead');
    $router->get('/notifications/mark-all-read', ['App\Controllers\Frontend\NotificationController', 'markAllRead'])->name('notifications.markAllRead');
    $router->get('/favorites', ['App\Controllers\Frontend\FavoriteController', 'index'])->name('favorites.index');
    $router->post('/favorites/toggle', ['App\Controllers\Frontend\FavoriteController', 'toggle'])->name('favorites.toggle');
    $router->get('/goals', ['App\Controllers\Frontend\GoalController', 'index'])->name('goals.index');
    $router->post('/goals/save', ['App\Controllers\Frontend\GoalController', 'save'])->name('goals.save');
    $router->get('/profile', ['App\Controllers\Frontend\ProfileController', 'show'])->name('profile.show');
    $router->post('/profile/update', ['App\Controllers\Frontend\ProfileController', 'update'])->name('profile.update');
    $router->post('/profile/update-password', ['App\Controllers\Frontend\ProfileController', 'updatePassword'])->name('profile.password');
    $router->get('/study-stats', ['App\Controllers\Frontend\StudyStatsController', 'index'])->name('study-stats');

    // ============================================================
    // API Routes
    // ============================================================
    $router->group('api', function (Router $router) {
        $router->get('/vocab', ['App\Controllers\Api\VocabApiController', 'list'])->name('api.vocab.list');
        $router->get('/vocab/search', ['App\Controllers\Api\VocabApiController', 'search'])->name('api.vocab.search');
        $router->get('/vocab/level/{level}', ['App\Controllers\Api\VocabApiController', 'byLevel'])->name('api.vocab.byLevel');
        $router->get('/vocab/lesson/{id}', ['App\Controllers\Api\VocabApiController', 'byLesson'])->name('api.vocab.byLesson');

        $router->post('/auth/login', ['App\Controllers\Api\AuthApiController', 'login'])->name('api.auth.login');
        $router->post('/auth/register', ['App\Controllers\Api\AuthApiController', 'register'])->name('api.auth.register');
        $router->post('/auth/logout', ['App\Controllers\Api\AuthApiController', 'logout'])->name('api.auth.logout');
        $router->get('/auth/me', ['App\Controllers\Api\AuthApiController', 'me'])->name('api.auth.me');

        $router->get('/flashcard/due', ['App\Controllers\Api\FlashcardApiController', 'due'])->name('api.flashcard.due');
        $router->post('/flashcard/review', ['App\Controllers\Api\FlashcardApiController', 'review'])->name('api.flashcard.review');

        $router->get('/progress', ['App\Controllers\Api\ProgressApiController', 'get'])->name('api.progress.get');
        $router->post('/progress/sync', ['App\Controllers\Api\ProgressApiController', 'sync'])->name('api.progress.sync');
    });

    // ============================================================
    // Admin Routes
    // ============================================================
    $router->group('admin', function (Router $router) {
        $router->get('/', ['App\Controllers\Admin\DashboardController', 'index'])->name('admin.dashboard');

        $router->get('/lessons', ['App\Controllers\Admin\LessonController', 'index'])->name('admin.lessons.index');
        $router->get('/lessons/create', ['App\Controllers\Admin\LessonController', 'create'])->name('admin.lessons.create');
        $router->post('/lessons/store', ['App\Controllers\Admin\LessonController', 'store'])->name('admin.lessons.store');
        $router->get('/lessons/edit/{id}', ['App\Controllers\Admin\LessonController', 'edit'])->name('admin.lessons.edit');
        $router->post('/lessons/update/{id}', ['App\Controllers\Admin\LessonController', 'update'])->name('admin.lessons.update');
        $router->post('/lessons/delete/{id}', ['App\Controllers\Admin\LessonController', 'delete'])->name('admin.lessons.delete');
        $router->get('/lessons/{id}/sections', ['App\Controllers\Admin\LessonController', 'manageSections'])->name('admin.lessons.sections');

        $router->get('/vocab', ['App\Controllers\Admin\VocabController', 'index'])->name('admin.vocab.index');
        $router->get('/vocab/create', ['App\Controllers\Admin\VocabController', 'create'])->name('admin.vocab.create');
        $router->post('/vocab/store', ['App\Controllers\Admin\VocabController', 'store'])->name('admin.vocab.store');
        $router->get('/vocab/edit/{id}', ['App\Controllers\Admin\VocabController', 'edit'])->name('admin.vocab.edit');
        $router->post('/vocab/update/{id}', ['App\Controllers\Admin\VocabController', 'update'])->name('admin.vocab.update');
        $router->post('/vocab/delete/{id}', ['App\Controllers\Admin\VocabController', 'delete'])->name('admin.vocab.delete');
        $router->post('/vocab/import', ['App\Controllers\Admin\VocabController', 'import'])->name('admin.vocab.import');
        $router->get('/vocab/export', ['App\Controllers\Admin\VocabController', 'export'])->name('admin.vocab.export');

        $router->get('/grammar', ['App\Controllers\Admin\GrammarController', 'index'])->name('admin.grammar.index');
        $router->get('/grammar/create', ['App\Controllers\Admin\GrammarController', 'create'])->name('admin.grammar.create');
        $router->post('/grammar/store', ['App\Controllers\Admin\GrammarController', 'store'])->name('admin.grammar.store');
        $router->get('/grammar/edit/{id}', ['App\Controllers\Admin\GrammarController', 'edit'])->name('admin.grammar.edit');
        $router->post('/grammar/update/{id}', ['App\Controllers\Admin\GrammarController', 'update'])->name('admin.grammar.update');
        $router->post('/grammar/delete/{id}', ['App\Controllers\Admin\GrammarController', 'delete'])->name('admin.grammar.delete');

        $router->get('/dialogues', ['App\Controllers\Admin\DialogueController', 'index'])->name('admin.dialogues.index');
        $router->get('/dialogues/create', ['App\Controllers\Admin\DialogueController', 'create'])->name('admin.dialogues.create');
        $router->post('/dialogues/store', ['App\Controllers\Admin\DialogueController', 'store'])->name('admin.dialogues.store');
        $router->get('/dialogues/edit/{id}', ['App\Controllers\Admin\DialogueController', 'edit'])->name('admin.dialogues.edit');
        $router->post('/dialogues/update/{id}', ['App\Controllers\Admin\DialogueController', 'update'])->name('admin.dialogues.update');
        $router->post('/dialogues/delete/{id}', ['App\Controllers\Admin\DialogueController', 'delete'])->name('admin.dialogues.delete');

        $router->get('/reading', ['App\Controllers\Admin\ReadingController', 'index'])->name('admin.reading.index');
        $router->get('/reading/create', ['App\Controllers\Admin\ReadingController', 'create'])->name('admin.reading.create');
        $router->post('/reading/store', ['App\Controllers\Admin\ReadingController', 'store'])->name('admin.reading.store');
        $router->get('/reading/edit/{id}', ['App\Controllers\Admin\ReadingController', 'edit'])->name('admin.reading.edit');
        $router->post('/reading/update/{id}', ['App\Controllers\Admin\ReadingController', 'update'])->name('admin.reading.update');
        $router->post('/reading/delete/{id}', ['App\Controllers\Admin\ReadingController', 'delete'])->name('admin.reading.delete');

        $router->get('/listening', ['App\Controllers\Admin\ListeningController', 'index'])->name('admin.listening.index');
        $router->get('/listening/create', ['App\Controllers\Admin\ListeningController', 'create'])->name('admin.listening.create');
        $router->post('/listening/store', ['App\Controllers\Admin\ListeningController', 'store'])->name('admin.listening.store');
        $router->get('/listening/edit/{id}', ['App\Controllers\Admin\ListeningController', 'edit'])->name('admin.listening.edit');
        $router->post('/listening/update/{id}', ['App\Controllers\Admin\ListeningController', 'update'])->name('admin.listening.update');
        $router->post('/listening/delete/{id}', ['App\Controllers\Admin\ListeningController', 'delete'])->name('admin.listening.delete');

        $router->get('/speaking', ['App\Controllers\Admin\SpeakingController', 'index'])->name('admin.speaking.index');
        $router->get('/speaking/create', ['App\Controllers\Admin\SpeakingController', 'create'])->name('admin.speaking.create');
        $router->post('/speaking/store', ['App\Controllers\Admin\SpeakingController', 'store'])->name('admin.speaking.store');
        $router->get('/speaking/edit/{id}', ['App\Controllers\Admin\SpeakingController', 'edit'])->name('admin.speaking.edit');
        $router->post('/speaking/update/{id}', ['App\Controllers\Admin\SpeakingController', 'update'])->name('admin.speaking.update');
        $router->post('/speaking/delete/{id}', ['App\Controllers\Admin\SpeakingController', 'delete'])->name('admin.speaking.delete');

        $router->get('/writing', ['App\Controllers\Admin\WritingController', 'index'])->name('admin.writing.index');
        $router->get('/writing/create', ['App\Controllers\Admin\WritingController', 'create'])->name('admin.writing.create');
        $router->post('/writing/store', ['App\Controllers\Admin\WritingController', 'store'])->name('admin.writing.store');
        $router->get('/writing/edit/{id}', ['App\Controllers\Admin\WritingController', 'edit'])->name('admin.writing.edit');
        $router->post('/writing/update/{id}', ['App\Controllers\Admin\WritingController', 'update'])->name('admin.writing.update');
        $router->post('/writing/delete/{id}', ['App\Controllers\Admin\WritingController', 'delete'])->name('admin.writing.delete');

        $router->get('/exam', ['App\Controllers\Admin\ExamController', 'index'])->name('admin.exam.index');
        $router->get('/exam/create', ['App\Controllers\Admin\ExamController', 'create'])->name('admin.exam.create');
        $router->post('/exam/store', ['App\Controllers\Admin\ExamController', 'store'])->name('admin.exam.store');
        $router->get('/exam/edit/{id}', ['App\Controllers\Admin\ExamController', 'edit'])->name('admin.exam.edit');
        $router->post('/exam/update/{id}', ['App\Controllers\Admin\ExamController', 'update'])->name('admin.exam.update');
        $router->post('/exam/delete/{id}', ['App\Controllers\Admin\ExamController', 'delete'])->name('admin.exam.delete');
        $router->get('/exam/questions/{id}', ['App\Controllers\Admin\ExamController', 'questions'])->name('admin.exam.questions');
        $router->post('/exam/question/add', ['App\Controllers\Admin\ExamController', 'questionAdd'])->name('admin.exam.question.add');
        $router->post('/exam/question/delete/{id}', ['App\Controllers\Admin\ExamController', 'questionDelete'])->name('admin.exam.question.delete');

        $router->get('/users', ['App\Controllers\Admin\UserController', 'index'])->name('admin.users.index');
        $router->post('/users/edit-role/{id}', ['App\Controllers\Admin\UserController', 'editRole'])->name('admin.users.editRole');
        $router->post('/users/delete/{id}', ['App\Controllers\Admin\UserController', 'delete'])->name('admin.users.delete');

        $router->get('/orders', ['App\Controllers\Admin\OrderController', 'index'])->name('admin.orders.index');
        $router->post('/orders/confirm/{id}', ['App\Controllers\Admin\OrderController', 'confirmPayment'])->name('admin.orders.confirm');
        $router->post('/orders/cancel/{id}', ['App\Controllers\Admin\OrderController', 'cancel'])->name('admin.orders.cancel');
        $router->get('/orders/invoice/{id}', ['App\Controllers\Admin\OrderController', 'invoice'])->name('admin.orders.invoice');

        $router->get('/notifications', ['App\Controllers\Admin\NotificationController', 'index'])->name('admin.notifications.index');
        $router->post('/notifications/mark-read/{id}', ['App\Controllers\Admin\NotificationController', 'markRead'])->name('admin.notifications.markRead');
        $router->post('/notifications/delete/{id}', ['App\Controllers\Admin\NotificationController', 'delete'])->name('admin.notifications.delete');
    });
};
