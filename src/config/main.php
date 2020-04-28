<?php

return array_merge([
        'view_dir' => realpath(__DIR__ . '/../view'),
    ],
    require __DIR__ . '/db.php',
    require __DIR__ . '/params.php'
);
