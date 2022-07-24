<?php

namespace app\models;

use app\core\DbModel;

class EmployeeModel extends DbModel
{
    public $user_id = '';
    public string $em_name = '';
    public string $em_level = '';
    public string $em_address = '';
    public string $em_phone = '';
    public string $em_photo = '';
    public string $em_description = '';

    public function primaryKey(): string
    {
        return 'employee_id';
    }

    public function tableName(): string
    {
        return "user";
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'em_name',
            'em_level',
            'em_address',
            'em_phone',
            'em_photo',
            'em_description',
        ];
    }

    public function rules(): array
    {
        return [
            'em_name' => [
                self::RULE_REQUIRED
            ],
            'em_level' => [
                self::RULE_REQUIRED
            ],
            'em_address' => [
                self::RULE_REQUIRED
            ],
            'em_phone' => [
                self::RULE_REQUIRED
            ],
            'em_photo' => [
                self::RULE_REQUIRED
            ],
        ];
    }

    public function labels(): array
    {
        return [];
    }
}
