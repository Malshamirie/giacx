<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconsaxBulCalculator extends IconComponent
{
    public function render()
    {
        $attributes = $this->getAttributes();
        
        return view('components.icons.calculator', $attributes);
    }
}
