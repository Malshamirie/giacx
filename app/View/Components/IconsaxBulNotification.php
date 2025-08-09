<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconsaxBulNotification extends IconComponent
{
    public function render()
    {
        $attributes = $this->getAttributes();
        
        return view('components.icons.notification', $attributes);
    }
}
