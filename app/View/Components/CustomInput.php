<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomInput extends Component
{

    public $label;
    public $id;
    public $name;
    public $placeholder;
    public $value;
    public $icon;
    public $type;
    public $required;
    public $apiAddStudent;

    /**
     * Create a new component instance.
     */
    public function __construct($label = null, $id = null, $name = null, $placeholder = null, $value = null, $icon = null, $type = null, $required = FALSE, $apiAddStudent = FALSE)
    {
        if(isset($label)) {
            $this->label = $label;
        }
        if(isset($id)) {
            $this->id = $id;
        }
        if(isset($name)) {
            $this->name = $name;
        }
        if(isset($placeholder)) {
            $this->placeholder = $placeholder;
        }
        if(isset($value)) {
            $this->value = $value;
        }
        if(isset($icon)) {
            $this->icon = $icon;
        }
        if(isset($type)) {
            $this->type = $type;
        }
        if($required) {
            $this->required = TRUE;
        }
        if($apiAddStudent) {
            $this->apiAddStudent = TRUE;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-input');
    }
}
