<?php

namespace app\models;

use app\core\App;
use app\core\DbModel;

class InputModel extends DbModel
{
    public $item_id = null;
    public $in_item_id = null;
    public $ct_item_id = null;
    public string $in_item_value = '';
    public $ct_unit_id = null;
    public string $in_item_description = '';

    public function attributes(): array
    {
        return [
            'item_id',
            'ct_item_id',
            'in_item_value',
            'ct_unit_id',
            'in_item_description',
        ];
    }

    public function tableName(): string
    {
        return 'incoming_item';
    }

    public function rules(): array
    {
        if (App::$app->controller->action === "editSave") {
            return $this->validateUpdate();
        } else {
            return $this->validateCreate();
        }
    }

    public function primaryKey(): string
    {
        return 'in_item_id';
    }

    public function validateCreate()
    {
        return [
            'item_id' => [
                self::RULE_REQUIRED
            ],
            'ct_item_id' => [
                self::RULE_REQUIRED
            ],
            'in_item_value' => [
                self::RULE_REQUIRED
            ],
            'ct_unit_id' => [
                self::RULE_REQUIRED
            ]
        ];
    }

    public function validateUpdate()
    {
        return [
            'item_name' => [
                [self::RULE_UNIQUE, 'class' => self::class],
                [self::RULE_MIN, 'min' => '2'],
                [self::RULE_MAX, 'max' => '20']
            ]
        ];
    }


    public function insertData()
    {
        ItemModel::createStatic([
            'item_id' => rand(10000, 20000),
            'item_name' => $this->item_id
        ]);

        $name = $this->item_id;

        $item = ItemModel::readStatic(['item_name' => $name]);
        $this->item_id = $item->item_id;

        parent::create();
        return parent::readStatic(['item_id' => $this->item_id]);
    }

    public function edit()
    {
        $data = explode(',', $_GET['data'][0]);

        if (count($data) > 1) {
            $read = [];
            foreach ($data as $dt) {
                $i = parent::readEdit([
                    'in_item_id' => $dt,
                ]);

                array_push($read, $i);
            }
            return $read;
        } else {
            $data = $_GET['data'][0];

            $read = parent::readEdit([
                'in_item_id' => $data,
            ]);

            $this->in_item_id = $read['in_item_id'];
            $this->item_id = $read['item_id'];
            $this->item_name = $read['item_name'];
            $this->ct_item_id = $read['ct_item_id'];
            $this->ct_item_name = $read['ct_item_name'];
            $this->in_item_value = $read['in_item_value'];
            $this->ct_unit_id = $read['ct_unit_id'];
            $this->ct_unit_name = $read['ct_unit_name'];
            $this->in_item_description = $read['in_item_description'];
            return $this;
        }
    }

    public function updateSave()
    {
        for ($i = 0; $i < count($_POST['in_item_id']); $i++) {
            $this->item_id = $_POST['item_id'][$i];
            $this->in_item_id = $_POST['in_item_id'][$i];
            $this->item_name = $_POST['item_name'][$i];
            $this->in_item_value = $_POST['in_item_value'][$i];
            $this->in_item_description = $_POST['in_item_description'][$i];
            $this->ct_item_id = $_POST['ct_item_id'][$i];
            $this->ct_unit_id = $_POST['ct_unit_id'][$i];

            ItemModel::update(['item_id' => $this->item_id], ['item_id' => $this->item_id, 'item_name' => $this->item_name]);
            Category_item::update(['ct_item_id' => $this->ct_item_id], ['ct_item_id' => $this->ct_item_id]);
            Category_unit::update(['ct_unit_id' => $this->ct_unit_id], ['ct_unit_id' => $this->ct_unit_id]);
            InputModel::update(['in_item_id' => $this->in_item_id], [
                'in_item_id' => $this->in_item_id,
                'in_item_value' => $this->in_item_value,
                'in_item_description' => $this->in_item_description,
                'ct_item_id' => $this->ct_item_id,
                'ct_unit_id' => $this->ct_unit_id,
            ]);
        }

        return true;
    }

    public function deleteItem()
    {
        $data = explode(',', $_POST['data'][0]);

        if (count($data) > 1) {
            foreach ($data as $dt) {

                $dl = parent::readStatic([
                    'in_item_id' => $dt,
                ]);

                if ($dl) {

                    ItemModel::delete([
                        'item_id' => $dl->item_id
                    ]);

                    parent::delete(['in_item_id' => $dl->item_id]);
                } else {
                    return false;
                }
            }
        } else {
            $data = $_POST['data'][0];

            $dl = parent::readStatic([
                'in_item_id' => $data,
            ]);

            if ($dl) {
                parent::delete(['in_item_id' => $dl->item_id]);
                ItemModel::delete([
                    'item_id' => $dl->item_id
                ]);
            } else {
                return false;
            }
        }

        return true;
    }
}
