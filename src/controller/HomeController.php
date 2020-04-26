<?php


namespace controller;


use Controller;
use View;

class HomeController extends Controller
{
    public function index(): View
    {
        return $this->render('home/index');
    }
}
