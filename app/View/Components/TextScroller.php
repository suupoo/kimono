<?php

namespace Kimono\Core\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextScroller extends Component
{
    public function render(): View
    {
        return view('kimono::components.text-scroller.text-scroller');
    }
}
