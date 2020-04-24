<?php


class View
{
    public function render(string $view, array $data = []): string
    {
        $viewPath = $this->getViewDirectory() . '/' . $view . '.php';

        if (file_exists($viewPath)) {
            ob_start();
            ob_implicit_flush(false);

            extract($data);
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
