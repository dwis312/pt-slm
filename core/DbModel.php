<?php

namespace app\core;

use PDO;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }

    // ======= Create =======
    public function create()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn ($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;
    }

    public function createStatic($data)
    {
        $tableName = static::tableName();
        $attributes = array_keys($data);

        $params = array_map(fn ($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");

        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return true;
    }

    public function addItem($data)
    {
        $tableName = static::tableName();
        $attributes = array_keys($data);

        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");

        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return true;
    }


    // ======= Read =======
    public function read($data)
    {
        $tableName = static::tableName();
        $attributes = array_keys($data);

        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public function readItems($activePage, $limit)
    {
        $tableName = static::tableName();
        $item = 'item';
        $category = 'category_item';
        $category_unit = 'category_unit';

        $statement = self::prepare("SELECT 
                                     $tableName.*,
                                     $item.item_name,
                                     $category.ct_item_name,
                                     $category_unit.ct_unit_name
                                    FROM $tableName, $item, $category, $category_unit
                                    WHERE $tableName.item_id = $item.item_id AND $tableName.ct_item_id = $category.ct_item_id AND $tableName.ct_unit_id = $category_unit.ct_unit_id
                                    ORDER BY in_item_date DESC
                                    LIMIT $activePage, $limit
                                    ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readProduct($activePage, $limit)
    {
        $tableName = static::tableName();
        $category_unit = 'category_unit';



        $statement = self::prepare("SELECT 
                                     $tableName.*,
                                     $category_unit.ct_unit_name
                                    FROM $tableName, $category_unit
                                    WHERE $tableName.ct_prUnit_id = $category_unit.ct_unit_id
                                    ORDER BY pr_item_date DESC
                                    LIMIT $activePage, $limit
                                    ");

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readPage()
    {
        $tableName = static::tableName();
        $item = 'item';
        $category = 'category_item';

        $statement = self::prepare("SELECT
                                     $tableName.*,
                                     $item.item_name,
                                     $category.ct_item_name
                                    FROM $tableName, $item, $category
                                    WHERE $tableName.item_id = $item.item_id AND $tableName.ct_item_id = $category.ct_item_id
                                    ORDER BY in_item_date DESC
                                    ");

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readStatic($data)
    {
        $tableName = static::tableName();
        $attributes = array_keys($data);

        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public function readAll()
    {
        $tableName = static::tableName();

        $statement = self::prepare("SELECT * FROM $tableName");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAllItem($data)
    {
        $tableName = static::tableName();
        $attributes = array_keys($data);

        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", (int)$item);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function readEdit($data)
    {
        $item = 'item';
        $ct_item = 'category_item';
        $in = 'incoming_item';
        $ct_unit = 'category_unit';

        $attributes = array_keys($data);
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT *
                                    FROM 
                                     $in
                                    INNER JOIN
                                     $item
                                    ON $in.item_id = $item.item_id
                                    INNER JOIN
                                     $ct_item
                                    ON $in.ct_item_id = $ct_item.ct_item_id
                                    INNER JOIN
                                     $ct_unit
                                    ON $in.ct_unit_id = $ct_unit.ct_unit_id
                                    WHERE $in.$sql
                                    ");

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    // ======= Update =======
    public function update(array $keyID, array $data)
    {
        $tableName = static::tableName();
        $primaryKey = array_keys($keyID);
        $attributes = array_keys($data);

        $key = implode(" , ", array_map(fn ($attr) => "$attr = :$attr", $primaryKey));
        $sql = implode(" , ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("UPDATE $tableName SET $sql WHERE $key");

        foreach ($data as $att => $item) {
            $statement->bindValue(":$att", $item);
        }

        foreach ($keyID as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
    }

    // ======= Delete =======
    public function delete($data)
    {
        $tableName = static::tableName();
        $attributes = array_keys($data);
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("DELETE FROM $tableName WHERE $tableName.$sql");
        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        return $statement->execute();
    }
}
