<?php

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../src/config/main.php';

(new Application())->run($config);
