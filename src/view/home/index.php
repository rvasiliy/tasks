<?php

use widget\DataGrid;
use widget\DoneAction;
use widget\EditAction;
?>

<div class="mb-2">
    <a class="btn btn-primary" href="/task/add">Add task</a>
</div>

<?php

(new DataGrid([
    'data' => $data,
    'columns' => [
        'author' => [
            'label' => 'Username'
        ],
        'author_email' => [
            'label' => 'Email'
        ],
        'description' => [
            'label' => 'Description'
        ],
        'status' => [
            'label' => 'Status'
        ],
    ],
    'actions' => [
        'edit' => [
            'class' => EditAction::class,
            'url' => '/task/edit'
        ],
        'done' => [
            'class' => DoneAction::class,
            'url' => '/task/done',
            'hiddenCallback' => function($data) use ($isAdmin) {
                return !$isAdmin || 'done' === $data['status'];
            }
        ],
    ],
]))->render();
