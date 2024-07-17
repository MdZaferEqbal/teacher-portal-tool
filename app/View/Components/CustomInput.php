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
    public $info;
    public $labelInfo;
    public $value;
    public $icon;
    public $type;
    public $required;
    public $disabled;
    public $apiAddStudent;
    public $min; 
    public $max;

    /**
     * Create a new component instance.
     */
    public function __construct($label = null, $id = null, $name = null, $placeholder = null, $info = null, $labelInfo = null, $value = null, $icon = null, $type = null, $required = FALSE, $disabled = FALSE, $apiAddStudent = FALSE, $min = "0", $max = "0")
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
        if(isset($info)) {
            $this->info = $info;
        }
        if(isset($labelInfo)) {
            $this->labelInfo = $labelInfo;
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
        if($min) {
            $this->min = $min;
        }
        if($max) {
            $this->max = $max;
        }
        if($required) {
            $this->required = TRUE;
        }
        if($disabled) {
            $this->disabled = TRUE;
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
