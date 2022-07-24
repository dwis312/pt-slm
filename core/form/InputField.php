<?php
require_once dirname(__DIR__) . "/Model.php";

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_DATE = 'date';
    public const TYPE_NUMBER = 'number';
    public const TYPE_FILE = 'file';
    public const ICON_SHOW = '<span><i class="bx bx-show"></i></span>';
    public const FIELD_HIDDEN = 'hidden';

    public string $type;
    public string $value;
    public string $showIcon;
    public string $fieldClass;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->showIcon = '';
        $this->fieldClass = '';
        parent::__construct($model, $attribute);
        $this->value = $this->model->{$this->attribute};
    }

    public function renderInput(): string
    {
        return sprintf(
            '
            <input type="%s" name="%s" id="%s" class="form-input %s" placeholder=" " value="%s">
            ',
            $this->type, // input type
            $this->attribute, // input name
            $this->attribute, // input id
            $this->fieldClass, // input class
            $this->value, // input value
        );
    }

    public function renderIcon(): string
    {
        return sprintf($this->showIcon);
    }

    public function password()
    {
        $this->type = self::TYPE_PASSWORD;
        $this->showIcon = self::ICON_SHOW;
        $this->fieldClass = self::FIELD_HIDDEN;
        return $this;
    }

    public function email()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function date()
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }
}
