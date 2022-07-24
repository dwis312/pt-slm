<?php
require_once dirname(__DIR__) . "/Model.php";

class Form
{
    public static function begin($class, $action, $method)
    {
        echo sprintf('<form class="%s" action="%s" method="%s" autocomplete="off">', $class, $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}
