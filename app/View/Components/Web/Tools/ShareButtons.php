<?php

namespace App\View\Components\Web\Tools;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShareButtons extends Component
{
    /**
     * Create a new component instance.
     */

     public $url;
     public $text;
    public function __construct($url, $text)
    {
        $this->url = $url;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web.tools.share-buttons');
    }
}
