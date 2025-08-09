<?php

namespace App\View\Components;

use Illuminate\View\Component;

abstract class IconComponent extends Component
{
    public $width;
    public $height;
    public $class;

    public function __construct($width = '24px', $height = '24px', $class = '')
    {
        $this->width = $width;
        $this->height = $height;
        $this->class = $class;
    }

    abstract public function render();

    protected function getAttributes()
    {
        $attributes = [
            'width' => $this->width,
            'height' => $this->height,
        ];

        if (!empty($this->class)) {
            $attributes['class'] = $this->class;
        }

        return $attributes;
    }
}
