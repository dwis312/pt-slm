<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;


class Controller
{
    public array $middlewares = [];
    public string $layout = 'main';
    public string $action = '';


    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return App::$app->view->render($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
