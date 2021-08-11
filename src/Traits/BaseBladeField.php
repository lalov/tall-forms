<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\View\Component;

abstract class BaseBladeField extends Component
{
    protected array $baseField = [
        'class' => '',
        'appendClass' => null,
        'errorClass' => '',
        'appendErrorClass' => 'tf-field-error',
    ];

    abstract public function defaults(): array;

    public function __construct(public array|object $field = [], public array $attr = [])
    {
        //merge, base, defaults, custom to Object
        $this->field = Helpers::mergeFilledToObject(array_merge($this->baseField, $this->defaults()), $field);
        $this->field->class = $this->class();
        $this->field->errorClass = $this->error();
        $this->attr = array_merge(data_get($field, 'attributes.input', []), $attr);
    }

    protected function class(): string
    {
        return $this->field->appendClass
            ? Helpers::unique_words("{$this->field->class} {$this->field->appendClass}")
            : $this->field->class;
    }

    protected function error(): string
    {
        return $this->field->appendErrorClass
            ? Helpers::unique_words("{$this->field->class} {$this->field->appendErrorClass}")
            : $this->field->errorClass;
    }

}
