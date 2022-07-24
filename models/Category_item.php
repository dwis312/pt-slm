<?php

namespace app\models;

use app\core\DbModel;

class Category_item extends DbModel
{
    public string $ct_item_id = '';
    public string $ct_item_name = '';

    public function attributes(): array
    {
        return [];
    }

    public function tableName(): string
    {
        return 'category_item';
    }

    public function rules(): array
    {
        return [];
    }

    public function primaryKey(): string
    {
        return 'ct_item_id';
    }

    public function getKategori()
    {
        return parent::readAll();
    }
}
