<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    public string $username = '';
    public string $nip = '';
    public string $email = '';
    public string $password = '';

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
        return [];
    }

    public function labels(): array
    {
        return [];
    }
}
