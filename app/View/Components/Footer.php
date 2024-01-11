<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $url;
    public function __construct()
    {
        $this->url = request()->segment(1);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->url == 'admin'){
            return view('components.admin.footer');
        }else{
            return view('components.frontend.footer');
        }
    }
}
