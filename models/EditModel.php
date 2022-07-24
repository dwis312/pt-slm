<?php

namespace app\models;

use app\core\App;
use app\core\DbModel;

class EditModel extends DbModel
{
    public int $in_item_id = 0;
    public int $item_id = 0;
    public string $item_name = '';
    public string $ct_item_name = '';
    public string $in_item_value = '';
    public string $ct_unit_name = '';
    public string $in_item_description = '';

    public function attributes(): array
    {
        return [
            'in_item_id',
            'item_id',
            'item_name',
            'ct_item_name',
            'in_item_value',
            'ct_unit_name',
            'in_item_description',
        ];
    }

    public function tableName(): string
    {
        return '';
    }

    public function rules(): array
    {
        return [
            'item_name' => [
                self::RULE_REQUIRED
            ],
            'ct_item_name' => [
                self::RULE_REQUIRED
            ],
            'in_item_value' => [
                self::RULE_REQUIRED
            ],
            'ct_unit_name' => [
                self::RULE_REQUIRED
            ],
        ];
    }

    public function primaryKey(): string
    {
        return 'item_id';
    }
}
