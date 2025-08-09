<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IconsaxBulGlobalSearch extends IconComponent
{
    public function render()
    {
        $attributes = $this->getAttributes();
        
        return view('components.icons.global-search', $attributes);
    }
}
