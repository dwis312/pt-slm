<?php

namespace app\models;

use app\core\App;
use app\core\Model;

class Data_item extends Model
{
    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }

    public function getItems()
    {
        $statement = self::prepare("SELECT
                                     item.item_id, item.item_name,
                                     category_item.ct_item_name,
                                     stock_item.st_item_value,
                                     incoming_item.in_item_value,
                                     process_item.pr_item_value
                                    FROM 
                                     item, category_item, stock_item, incoming_item, process_item
                                    ");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }


    public function rules(): array
    {
        return [];
    }
}
