<?php

namespace app\models;

use app\core\DbModel;

class ItemModel extends DbModel
{
    public int $item_id = 0;
    public string $item_name = '';

    public function attributes(): array
    {
        return [
            'item_id',
            'item_name'
        ];
    }

    public function tableName(): string
    {
        return 'item';
    }

    public function rules(): array
    {
        return [
            'item_name' => [
                self::RULE_REQUIRED
            ]
        ];
    }

    public function primaryKey(): string
    {
        return 'item_id';
    }
}
