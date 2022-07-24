<?php

namespace app\models;

use app\core\DbModel;

class Stock_itemModel extends DbModel
{
    public $in_item_id = '';
    public string $st_item_value = '';
    public $ct_stUnit_id = '';

    public function attributes(): array
    {
        return [
            'in_item_id',
            'st_item_value',
            'ct_stUnit_id',
        ];
    }

    public function tableName(): string
    {
        return 'stock_item';
    }

    public function rules(): array
    {
        return [
            'st_item_value' => [
                self::RULE_REQUIRED
            ]
        ];
    }

    public function primaryKey(): string
    {
        return 'st_item_id';
    }

    public function stock()
    {
        return parent::readAll();
    }
}
