<?php


namespace controller;


use Application;
use Controller;
use Kilte\Pagination\Pagination;
use model\TaskTable;
use Sort;
use View;

class HomeController extends Controller
{
    public function index(): View
    {
        $taskTable = new TaskTable();
        $page = Application::$router->getParam('page');

        if (isset($page)) {
            $page = intval($page);
        } else {
            $page = 1;
        }

        $query = $taskTable->getList($page);

        $pagination = new Pagination($query['total'], $query['page'], $query['perPage'], 3);

        return $this->render('home/index', [
            'data' => $query['data'],
            'isAdmin' => Application::$user && Application::$user->isAdmin(),
            'pagination' => $pagination,
            'sort' => new Sort()
        ]);
    }
}
