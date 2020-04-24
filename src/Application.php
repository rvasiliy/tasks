<?php


class Application
{
    /**
     * @var Config
     */
    public static $config;

    /**
     * @var Router
     */
    public static $router;

    public function run(array $config = [])
    {
        self::$config = new Config($config);
        self::$router = new Router();

        $controller = $this->createController();
        $action = $this->getAction();

        $content = $controller->$action(self::$router->getParams());

        require self::$config->get('view_dir') . '/layout/main.php';
    }

    private function createController(): Controller
    {
        $controllerName = self::$router->getController();
        $controllerClass = 'controller\\' . ucfirst($controllerName) . 'Controller';

        return new $controllerClass();
    }

    private function getAction(): string
    {
        return strtolower(self::$router->getAction());
    }
}
