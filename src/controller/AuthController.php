<?php


namespace controller;


use Application;
use auth\User;
use Controller;
use DB;
use helper\CsrfHelper;
use helper\SessionHelper;
use model\LoginForm;

class AuthController extends Controller
{
    public function index()
    {
        return $this->render('auth/index');
    }

    public function login($data)
    {
        $model = new LoginForm($data);

        if ($model->isValid()) {
            $result = DB::queryOneRow('select * from user where name = %s and password = %s', $model->username, sha1($model->password));

            if (empty($result)) {
                $this->redirect('/auth');
            }

            $user = new User(
                intval($result['id']),
                $result['name'],
                $result['email'],
                boolval($result['is_admin'])
            );

            SessionHelper::set('user', $user);

            $this->redirect('/');
        }

        $this->redirect('/auth');
    }

    public function logout()
    {
        if ('post' === Application::$router->getMethod()) {
            $token = SessionHelper::get(CsrfHelper::TOKEN_KEY);

            if (CsrfHelper::validateToken($token)) {
                SessionHelper::delete('user');
            }

            $this->redirect('/');
        }
    }
}
