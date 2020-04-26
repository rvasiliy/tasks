<?php


class Router
{
    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $params;


    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->controller = '';
        $this->action = '';
        $this->method = '';
        $this->params = [];

        $this->prepare();
    }


    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    private function prepare()
    {
        $url = $_SERVER['REQUEST_URI'];
        $paramsPosition = strpos($url, '?');

        if (false !== $paramsPosition) {
            $url = substr($url, 0, $paramsPosition);
        }

        $parts = explode('/', $url);
        array_shift($parts);

        $this->controller = $parts[0] ? $parts[0] : 'home';
        $this->action = $parts[1] ? $parts[1] : 'index';
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->params = array_merge($_GET, $_POST);
    }
}
