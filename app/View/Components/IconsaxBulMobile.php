<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconsaxBulMobile extends IconComponent
{
    public function render()
    {
        $attributes = $this->getAttributes();
        
        return view('components.icons.mobile', $attributes);
    }
}
