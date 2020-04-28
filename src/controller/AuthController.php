<?php


namespace controller;


use Application;
use auth\User;
use Controller;
use DB;
use helper\CsrfHelper;
use helper\FlashHelper;
use helper\SessionHelper;
use model\LoginForm;

class AuthController extends Controller
{
    public function index()
    {
        return $this->redirect('/auth/login');
    }

    public function login($data)
    {
        $model = new LoginForm($data);

        if ('post' === Application::$router->getMethod()) {
            if ($model->isValid()) {
                $result = DB::queryOneRow('select * from user where name = %s and password = %s', $model->username, sha1($model->password));

                if (empty($result)) {
                    FlashHelper::add('Incorrect username or password', FlashHelper::ERROR_TYPE);
                } else {
                    $user = new User(
                        intval($result['id']),
                        $result['name'],
                        $result['email'],
                        boolval($result['is_admin'])
                    );

                    SessionHelper::set('user', $user);

                    $this->redirect('/');
                }
            }
        }

        return $this->render('/auth/login', [
            'model' => $model,
            'errors' => $model->getErrors()
        ]);
    }

    public function logout(array $data)
    {
        if ('post' === Application::$router->getMethod()) {
            $token = Application::$router->getParam(CsrfHelper::TOKEN_KEY);

            if (CsrfHelper::validateToken($token)) {
                SessionHelper::delete('user');
            }

            $this->redirect('/');
        }
    }
}
