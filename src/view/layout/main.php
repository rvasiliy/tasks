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
        <a href="/auth" class="btn btn-primary ml-auto">Sign in</a>
        <span class="ml-2">User</span>
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
