<?php


class Controller
{
    public function render(string $view, array $data = []): View
    {
        return new View($view, $data);
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
        exit();
    }
}
