<?php

namespace app\core;

class Views
{
    public function isContent($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once dirname(__DIR__) . "/views/$view.php";
        return ob_get_clean();
    }

    public function isLayout()
    {
        $layout = App::$app->layout;
        if (App::$app->controller) {
            $layout = App::$app->controller->layout;
        }

        ob_start();
        include_once dirname(__DIR__) . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function render($view, $params = [])
    {
        $layout = $this->isLayout();
        $content = $this->isContent($view, $params);
        return str_replace('{{ content }}', $content, $layout);
    }
}
