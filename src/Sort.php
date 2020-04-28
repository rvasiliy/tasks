<?php


class Sort
{
    private $direction;
    private $by;

    public function __construct()
    {
        $this->direction = Application::$router->getParam('sort');
        $this->by = Application::$router->getParam('by');
    }

    public function getParams()
    {
        return [
            'sort' => $this->getDirection(),
            'by' => $this->getBy(),
        ];
    }

    public function getDirection()
    {
        if (is_null($this->direction)) {
            return '';
        }

        if (!in_array($this->direction, ['asc', 'desc'])) {
            return '';
        }

        return $this->direction;
    }

    public function getBy()
    {
        if (is_null($this->by)) {
            return '';
        }

        return $this->by;
    }
}
