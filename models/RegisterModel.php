<?php

namespace app\models;

use app\core\DbModel;

class RegisterModel extends DbModel
{
    public const STATUS = '0';

    public string $username = '';
    public string $nip = '';
    public string $email = '';
    public string $password = '';
    public string $cpassword = '';
    public $status = self::STATUS;

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
            'nip',
            'email',
            'password',
            'status',
        ];
    }

    public function rules(): array
    {
        return [
            'username' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => '2'],
                [self::RULE_MAX, 'max' => '16'],
            ],
            'nip' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => '8'],
                [self::RULE_MAX, 'max' => '24'],
            ],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => '6'],
                [self::RULE_MAX, 'max' => '24'],
            ],
            'cpassword' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']
            ]
        ];
    }

    public function labels(): array
    {
        return [
            'username' => "Username",
            'nip' => "NIP",
            'email' => "Email",
            'password' => "Password",
            'cpassword' => "Konfirmasi Password"
        ];
    }

    public function newUser()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::create();
    }
}
