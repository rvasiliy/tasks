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
}
