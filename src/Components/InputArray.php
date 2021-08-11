<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class InputArray extends BaseBladeField
{
    public function __construct(
        public array|object $field,
        public array        $attr = [])
    {
        parent::__construct((array)$field, $attr);
        $this->attr = array_merge($this->inputAttributes(), $attr);
    }

    public function defaults(): array
    {
        return [
            'id' => 'inputArray', //unique, fieldset id + label for =,
            'defer' => true,
            'type' => 'text',
            'wrapperClass' => null,
            'class' => "form-input my-1 w-full", //applied to each input
            'errorClass' => 'border rounded border-red-500 p-2 md:p-4 mb-2', //applied to the outer div surrounding the inputs
            'appendErrorClass' => '', //override baseField
            'placeholder' => null,
            'errorMsg' => null,
            'maxItems' => 0, //0 = unlimited
            'minItems' => 0, //0 = unlimited
        ];
    }

    public function inputAttributes(): array
    {
        return [
            'type' => $this->field->input_type,
            'placeholder' => $this->field->placeholder,
            'class' => $this->field->class,
        ];
    }


    public function render(): View
    {
        return view('tall-forms::components.input-array');
    }
}
