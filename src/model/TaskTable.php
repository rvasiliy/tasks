<?php


namespace model;


use DB;

class TaskTable
{
    public function getList(int $page = 1, int $perPage = 3): array
    {
        DB::query("select count(id) from task");
        $pages = ceil(DB::count() / $perPage);

        if ($page < 1) {
            $page = 1;
        }

        if ($pages < $page) {
            $page = $pages;
        }

        $offset = ($page - 1) * $perPage;

        return DB::query("select * from task limit %d offset %d", $perPage, $offset);
    }

    public function find(int $id): array
    {
        return DB::queryFirstRow("select * from task where id = %d", $id);
    }

    public function addTask(TaskForm $task): bool
    {
        DB::insert('task', [
            'description' => $task->description,
            'status' => 'new',
            'author' => $task->name,
            'author_email' => $task->email,
        ]);

        return boolval(DB::affectedRows());
    }

    public function updateTask(TaskForm $task): bool
    {
        Db::query(
            "update task set update_at = %s, description = %s, author = %s, author_email = %s where id = %d",
            date('Y-m-d H:i:s'),
            $task->description,
            $task->name,
            $task->email,
            $task->getId()
        );

        return boolval(DB::affectedRows());
    }
}
