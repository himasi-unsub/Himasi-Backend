<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Twibbonizer extends Component
{
    #[Title('Twibbonizer')]
    public function render()
    {
        return view('livewire.twibbonizer');
    }
}
