<?php

namespace app\models;

use app\core\App;
use app\core\DbModel;

class ProsesModel extends DbModel
{
    public $pr_item_id = '';
    public $em_id = '';
    public $st_item_id = '';
    public $ct_process_id = '';
    public string $pr_item_name = '';
    public $pr_item_value = '';
    public $ct_prUnit_id = '';
    public string $ct_prUnit_name = '';
    public $pr_item_description = '';
    public $item_name = '';
    public $ct_item_name = '';

    public function attributes(): array
    {
        return [
            'pr_item_id',
            'em_id',
            'st_item_id',
            'ct_process_id',
            'pr_item_name',
            'pr_item_value',
            'ct_prUnit_id',
            'pr_item_description',
        ];
    }

    public function tableName(): string
    {
        return 'process_item';
    }

    public function rules(): array
    {
        return [
            'em_id' => [
                self::RULE_REQUIRED
            ],
            'st_item_id' => [
                self::RULE_REQUIRED
            ],
            'pr_item_name' => [
                self::RULE_REQUIRED
            ],
            'pr_item_value' => [
                self::RULE_REQUIRED
            ],
            'ct_process_id' => [
                self::RULE_REQUIRED
            ],
            'ct_prUnit_id' => [
                self::RULE_REQUIRED
            ],
        ];
    }

    public function primaryKey(): string
    {
        return 'pr_item_id';
    }

    public function startProses()
    {
        $this->ct_prUnit_name = $this->itemName();

        $stok = $this->readTable(Stock_itemModel::class, ['st_item_id' => $this->st_item_id]);
        $item = $this->readTable(InputModel::class, ['in_item_id' => $stok->in_item_id]);
        $itemModel = $this->readTable(ItemModel::class, ['item_id' => $item->item_id]);
        $itemCt = $this->readTable(Category_item::class, ['ct_item_id' => $item->ct_item_id]);

        $this->item_name = $itemModel->item_name;
        $this->ct_item_name = $itemCt->ct_item_name;

        if (!$stok) {
            $this->addError('st_item_id', 'Record data pada barang ini belum ada');
            return false;
        }

        if ($stok->st_item_value <= $this->pr_item_value) {
            $this->addError('pr_item_value', 'Proses barang gagal stok saat ini ' . $stok->st_item_value  . " " . $this->ct_prUnit_id);
            return false;
        }
    }

    public function readTable($table, $key)
    {
        $data = $table::read($key);
        return $data;
    }

    public function itemName()
    {
        $ct_unit = $this->readTable(Category_unit::class, ['ct_unit_id' => $this->ct_prUnit_id]);

        $this->ct_prUnit_name = $ct_unit->ct_unit_name;
        return $this;
    }
}
