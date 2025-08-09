<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconsaxBulRefresh2 extends IconComponent
{
    public function render()
    {
        $attributes = $this->getAttributes();
        
        return view('components.icons/refresh-2', $attributes);
    }
}
