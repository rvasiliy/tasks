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

        $view = $this->createView();

        if (is_null($view)) {
            header('Location: /error/error404');
            exit();
        }

        $content = $view->render();
        $layout = self::$config->get('view_dir') . '/layout/' . $view->layout . '.php';

        if (file_exists($layout)) {
            require $layout;
        } else {
            echo $content;
        }
    }

    private function createView(): ?View
    {
        $controller = $this->createController();
        $action = $this->getAction();

        if (is_null($controller) || !method_exists($controller, $action)) {
            return null;
        }

        return $controller->$action(self::$router->getParams());
    }

    private function createController(): ?Controller
    {
        $controllerName = self::$router->getController();
        $controllerClass = 'controller\\' . ucfirst($controllerName) . 'Controller';

        if (class_exists($controllerClass)) {
            return new $controllerClass();
        }

        return null;
    }

    private function getAction(): string
    {
        return strtolower(self::$router->getAction());
    }
}
