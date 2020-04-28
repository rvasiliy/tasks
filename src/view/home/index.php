<?php

use widget\DataGrid;
use widget\DoneAction;
use widget\EditAction;
use widget\Pager;

?>

<div class="mb-2">
    <a class="btn btn-primary" href="/task/add">Add task</a>
</div>

<?php (new DataGrid([
    'data' => $data,
    'columns' => [
        'author' => [
            'label' => 'Username',
            'sort' => $sort,
        ],
        'author_email' => [
            'label' => 'Email',
            'sort' => $sort,
        ],
        'description' => [
            'label' => 'Description'
        ],
        'status' => [
            'label' => 'Status',
            'sort' => $sort,
            'value' => function($data) {
                $changes = [$data['status']];

                if ($data['create_at'] !== $data['update_at']) {
                    array_push($changes, 'edited by admin');
                }

                return implode(', ', $changes);
            }
        ],
    ],
    'actions' => [
        'edit' => [
            'class' => EditAction::class,
            'url' => '/task/edit',
            'hiddenCallback' => function() use ($isAdmin) {
                return !$isAdmin;
            }
        ],
        'done' => [
            'class' => DoneAction::class,
            'url' => '/task/done',
            'hiddenCallback' => function($data) use ($isAdmin) {
                return !$isAdmin || 'done' === $data['status'];
            }
        ],
    ],
]))->render(); ?>

<div class="d-flex">
    <div class="ml-auto">
        <?php (new Pager($pagination))->render(); ?>
    </div>
</div>
