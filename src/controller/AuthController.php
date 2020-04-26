<?php


namespace controller;


use Controller;
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
            $this->redirect('/');
        }

        $this->redirect('/auth');
    }
}
