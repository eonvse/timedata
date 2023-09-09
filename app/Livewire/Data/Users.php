<?php

namespace App\Livewire\Data;

use Livewire\Component;

use App\Repositories\UserData;

class Users extends Component
{
    public function render()
    {
        return view('livewire.data.users');
    }
}
