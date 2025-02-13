<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Friends extends Component
{
    public $friends;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->friends = User::where('id', '<>', Auth::id())
            ->orderBy('name')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messenger.friends');
    }
}
