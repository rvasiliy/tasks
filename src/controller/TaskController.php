<?php


namespace controller;


use Application;
use Controller;
use helper\FlashHelper;
use model\TaskForm;
use model\TaskTable;

class TaskController extends Controller
{
    public function add(array $data)
    {
        $model = new TaskForm($data);

        if ('post' === Application::$router->getMethod()) {
            if ($model->isValid()) {
                if ($this->saveTask($model)) {
                    FlashHelper::add('Task was added', FlashHelper::INFO_TYPE);
                    $model->clear();
                } else {
                    FlashHelper::add('Error in saving process', FlashHelper::ERROR_TYPE);
                }

            } else {
                FlashHelper::add('Form data is invalid', FlashHelper::WARNING_TYPE);
            }
        }

        return $this->render('task/add', [
            'model' => $model
        ]);
    }

    private function saveTask(TaskForm $model): bool
    {
        $taskTable = new TaskTable();

        return $taskTable->addTask($model);
    }
}
