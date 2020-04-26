<?php


namespace controller;


use Controller;

class ErrorController extends Controller
{
    public function error404()
    {
        header('HTTP/1.0 404 Not Found');
        return $this->render('error/error404');
    }
}
