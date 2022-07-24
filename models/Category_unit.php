<?php

namespace app\models;

use app\core\DbModel;

class Category_unit extends DbModel
{
    public $ct_unit_id = '';
    public string $ct_unit_name = '';

    public function attributes(): array
    {
        return [
            'ct_unit_id',
            'ct_unit_name'
        ];
    }

    public function tableName(): string
    {
        return 'category_unit';
    }

    public function rules(): array
    {
        return [];
    }

    public function primaryKey(): string
    {
        return 'ct_unit_id';
    }

    public function getKategori()
    {
        return parent::readAll();
    }
}
