<?php


class View
{
    /**
     * @var string Шаблон
     */
    public $layout = 'main';

    /**
     * @var string
     * @example home/index
     */
    private $view = '';

    private $data = [];


    public function __construct(string $view, array $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function render(): string
    {
        $viewPath = $this->getViewDirectory() . '/' . $this->view . '.php';

        if (file_exists($viewPath)) {
            ob_start();
            ob_implicit_flush(false);

            extract($this->data);
            require $viewPath;

            return ob_get_clean();
        }

        return '';
    }

    private function getViewDirectory(): string
    {
        return Application::$config->get('view_dir');
    }
}
