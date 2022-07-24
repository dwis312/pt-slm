<?php

namespace app\core;

use app\db\Database;

class App
{

    public Router $router;
    public Request $request;
    public Response $response;
    public Views $view;
    public Session $session;
    public Database $db;

    public string $layout = 'main';
    public ?Controller $controller = null;
    public ?DbModel $user;

    public static App $app;
    public string $userClass;

    public function __construct(array $config)
    {
        self::$app = $this;

        $this->view = new Views();
        $this->session = new Session();
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);

        $this->userClass = $config['userClass'];
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');

        if (!empty($primaryValue)) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::read([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->getStatus($e->getCode());
            echo $this->view->render('_error', ['e' => $e]);
        }
    }
}
