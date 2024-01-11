<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $url;
    public $pageTitle;
    public function __construct($pageTitle)
    {
        $this->url = request()->segment(1);
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->url == 'admin'){
            return view('components.admin.header');
        }else{
            return view('components.frontend.header');
        }
    }
}
