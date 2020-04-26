<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
    <base href="/">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
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
        <span class="ml-2">
            <?php if (Application::$user) { echo htmlspecialchars(Application::$user->getName()); } ?>
        </span>
    </header>

    <main class="container-fluid">
        <?= $content; ?>
    </main>

    <footer class="p-3 text-muted">
        <div class="text-center"><span>&copy; <?= date('Y') ?> г.</span></div>
    </footer>
</div>

</body>
</html>
