<?php

namespace SeoMunk\SeoMunk\View\Components;

use Illuminate\View\Component;
use SeoMunk\SeoMunk\Facades\SeoMunk;

class MetaHead extends Component
{
    public function render()
    {
        return view('seomunk::components.meta-head', [
            'meta' => SeoMunk::meta()->data(),
        ]);
    }
}