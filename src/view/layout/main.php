<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
    <base href="/">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<div class="main">
    <header class="navbar flex-row">
        <a href="/" class="navbar-brand">Home</a>
        <div class="ml-auto">
            <?php if (!Application::$user): ?>
                <a href="/auth" class="btn btn-primary ">Sign in</a>
            <?php else: ?>
                <form action="/auth/logout" method="post">
                    <?php helper\CsrfHelper::createFormField(); ?>
                    <button class="btn btn-primary" type="submit">Sign out</button>
                </form>
            <?php endif ?>
        </div>
        <span class="ml-2 font-weight-bold">
            <?php if (Application::$user) {
                echo htmlspecialchars(Application::$user->getName());
            } ?>
        </span>
    </header>

    <div class="container-fluid">
        <?php foreach (helper\FlashHelper::get() as $message): ?>
            <div class="alert alert-<?= $message['type']; ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message['message']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endforeach; ?>

        <main>
            <?= $content; ?>
        </main>
    </div>

    <footer class="p-3 text-muted">
        <div class="text-center"><span>&copy; <?= date('Y') ?> г.</span></div>
    </footer>
</div>

<script src="vendor/jquery/jquery-3.5.0.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
