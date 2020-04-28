<?php


namespace model;


use DB;
use Paginator;
use Sort;

class TaskTable
{
    /**
     * @param int $page
     * @return array ['data' => [], 'total' => 5, 'page' => 1, 'perPage' => 3, 'pages' => 2]
     */
    public function getList(int $page = 1): array
    {
        $total = intval(DB::queryFirstField("select count(id) from task"));
        $paginator = new Paginator($page, 3, $total);

        $page = $paginator->getPage();
        $perPage = $paginator->getPerPage();
        $pages = $paginator->getPages();
        $offset = $paginator->getOffset();

        $sort = new Sort();
        $sortDirection = $sort->getDirection() ? $sort->getDirection() : 'asc';
        $sortBy = $sort->getBy() ? $sort->getBy() : 'id';

        $sql = "select * from task order by %b {$sortDirection} limit %d offset %d";

        return [
            'data' => DB::query($sql, $sortBy, $perPage, $offset),
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'pages' => $pages
        ];
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

    public function setDone(int $id): bool
    {
        Db::query("update task set status = %s where id = %d", 'done', $id);

        return boolval(DB::affectedRows());
    }
}
