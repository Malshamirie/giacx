<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconsaxBulBucket extends IconComponent
{
    public function render()
    {
        $attributes = $this->getAttributes();
        
        return view('components.icons.bucket', $attributes);
    }
}
