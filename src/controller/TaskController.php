<?php


namespace controller;


use Application;
use Controller;
use helper\CsrfHelper;
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

            }
        }

        return $this->render('task/add', [
            'model' => $model,
            'errors' => $model->getErrors()
        ]);
    }

    public function edit(array $data)
    {
        $this->canAdminOnly();

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

            }
        }

        return $this->render('task/edit', [
            'model' => $model,
            'errors' => $model->getErrors()
        ]);
    }

    public function done(array $data)
    {
        $this->canAdminOnly();

        if (
            'post' === Application::$router->getMethod()
            && CsrfHelper::validateToken($data['csrfToken'])
        ) {
            $taskId = intval($data['id']);
            $taskTable = new TaskTable();

            if ($taskTable->setDone($taskId)) {
                FlashHelper::add('Task done', FlashHelper::WARNING_TYPE);

                $url = '/';

                if (array_key_exists('HTTP_REFERER', $_SERVER)) {
                    $url = $_SERVER['HTTP_REFERER'];
                }

                $this->redirect($url);
            } else {
                FlashHelper::add('Unknown error', FlashHelper::WARNING_TYPE);
            }
        }
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

    private function canAdminOnly()
    {
        $user = Application::$user;

        if (is_null($user) || !$user->isAdmin()) {
            FlashHelper::add('Permission denied', FlashHelper::WARNING_TYPE);
            $this->redirect('/auth/login');
        }
    }
}
