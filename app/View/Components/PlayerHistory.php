<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PlayerHistory extends Component
{

    public Collection $history;

    public function __construct(Collection $history)
    {
        $this->history = $history;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.player-history');
    }
}
