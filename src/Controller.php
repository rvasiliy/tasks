<?php


class Controller
{
    public function render(string $view, array $data = [])
    {
        return (new View())->render($view, $data);
    }
}
