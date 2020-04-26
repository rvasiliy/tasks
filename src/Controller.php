<?php


class Controller
{
    public function render(string $view, array $data = []): View
    {
        return new View($view, $data);
    }
}
