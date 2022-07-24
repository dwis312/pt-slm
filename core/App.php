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

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public static function isUser()
    {
        return self::$app->user;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public function timeAgo($data)
    {
        $time = time() - strtotime($data);

        if ($time < 60)
            return ($time >= 1) ? $time . ' dtk yg lalu' : 'Detik';
        elseif ($time < 3600) {
            $tmp = floor($time / 60);
            return ($tmp >= 1) ? $tmp . ' Mnt yg lalu' : ' Menit';
        } elseif ($time < 86400) {
            $tmp = floor($time / 3600);
            return ($tmp >= 1) ? $tmp . ' Jam yg lalu' : ' Jam';
        } elseif ($time < 2592000) {
            $tmp = floor($time / 86400);
            return ($tmp > 1) ? $tmp . ' Hr yg lalu' : ' Kemaren';
        } elseif ($time < 946080000) {
            $tmp = floor($time / 2592000);
            return ($tmp >= 1) ? $tmp . ' Bln yg lalu' : ' Bulan';
        } else {
            $tmp = floor($time / 946080000);
            return ($tmp >= 1) ? $tmp . ' Thn yg lalu' : ' Tahun';
        }
    }

    public function title($string)
    {
        $title = explode('_', $string);
        return implode(" ", $title);
    }
}
