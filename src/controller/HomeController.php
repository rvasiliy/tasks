<?php


namespace controller;


use Application;
use Controller;
use model\TaskTable;
use View;

class HomeController extends Controller
{
    public function index(): View
    {
        $taskTable = new TaskTable();

        return $this->render('home/index', [
            'data' => $taskTable->getList(),
            'isAdmin' => Application::$user && Application::$user->isAdmin()
        ]);
    }
}
