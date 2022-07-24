<?php
require_once dirname(__DIR__) . "/Model.php";

abstract class BaseField
{
    public Model $model;
    public string $attribute;

    abstract public function renderInput(): string;
    abstract public function renderIcon(): string;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->value = $this->model->{$this->attribute};
    }

    public function __toString()
    {
        return sprintf(
            '
            <div class="field %s">
                %s
                <label for="%s" class="form-label">%s</label>
                %s
                <div class="error">%s</div>
            </div>
            ',
            $this->model->hasError($this->attribute) ? "invalid" : '', // field 
            $this->renderInput(),
            $this->attribute, // label 
            $this->model->getLabel($this->attribute), // label innerHtml 
            $this->renderIcon(),
            $this->model->getError($this->attribute), // error innerHtml 
        );
    }
}
