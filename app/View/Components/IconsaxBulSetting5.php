<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconsaxBulSetting5 extends IconComponent
{
    public function render()
    {
        $attributes = $this->getAttributes();
        
        return view('components.icons.setting-5', $attributes);
    }
}
