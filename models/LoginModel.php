<?php

namespace app\models;

use app\core\App;
use app\core\DbModel;

class LoginModel extends DbModel
{
    public string $username = '';
    public string $password = '';
    public string $status = '';

    public function primaryKey(): string
    {
        return 'id';
    }

    public function tableName(): string
    {
        return "user";
    }

    public function attributes(): array
    {
        return [
            'username',
            'password',
            'status'
        ];
    }

    public function rules(): array
    {
        return [
            'username' => [
                self::RULE_REQUIRED
            ],
            'password' => [
                self::RULE_REQUIRED
            ]
        ];
    }

    public function labels(): array
    {
        return [
            'username' => "Username",
            'password' => "Password"
        ];
    }

    public function userLogin()
    {
        $user = parent::read(['username' => $this->username]);
        if (!$user) {
            $this->addError('username', 'Username belum terdaftar');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password salah');
            return false;
        }

        if ($user->status === '1') {
            App::$app->session->setFlash('success', "Anda sedang online diperangkat lain");
            return false;
            exit;
        }

        return App::$app->login($user);
    }
}
