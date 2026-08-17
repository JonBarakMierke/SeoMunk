<?php

namespace SeoMunk\SeoMunk\View\Components;

use Illuminate\View\Component;
use SeoMunk\SeoMunk\Facades\SeoMunk;

class JsonHead extends Component
{
    public function render()
    {
        return view('seomunk::components.json-head', [
            'schemas' => SeoMunk::schema()->render(),
        ]);
    }
}
