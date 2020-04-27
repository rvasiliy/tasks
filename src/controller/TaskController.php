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

    public function edit(array $data)
    {
        $taskId = intval($data['id']);

        $taskTable = new TaskTable();
        $dbData = $taskTable->find($taskId);

        $model = new TaskForm([
            'id' => $dbData['id'],
            'name' => $dbData['author'],
            'email' => $dbData['author_email'],
            'description' => $dbData['description'],
        ]);

        if ('post' === Application::$router->getMethod()) {
            $model = new TaskForm($data);

            if ($model->isValid()) {
                if ($this->saveTask($model)) {
                    FlashHelper::add('Task was saved', FlashHelper::INFO_TYPE);
                } else {
                    FlashHelper::add('Error in saving process', FlashHelper::ERROR_TYPE);
                }

            } else {
                FlashHelper::add('Form data is invalid', FlashHelper::WARNING_TYPE);
            }
        }

        return $this->render('task/edit', [
            'model' => $model
        ]);
    }

    private function saveTask(TaskForm $model): bool
    {
        $taskTable = new TaskTable();

        if ($model->id) {
            return $taskTable->updateTask($model);
        } else {
            return $taskTable->addTask($model);
        }
    }
}
