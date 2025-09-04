<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Intervention\Image\Facades\Image;

class Twibbonizer extends Component
{

    public $slug;

    public $twibbon;

    protected $listeners = ['saveCropped' => 'saveCropped'];

    public function mount($slug)
    {
        $this->slug = $slug;
        $findTwibbon = \App\Models\Twibbon::where('slug', $slug)->firstOrFail();
        // check if twibbon is active
        if (!$findTwibbon->is_active) {
            return abort(404);
        }
        $this->twibbon = $findTwibbon;
    }

    public function saveCropped($imageData)
    {
        // $imageData base64 dari Alpine/Canvas
        $image = Image::make($imageData);

        $filename = 'twibbon_' . $this->slug . '_' . time() . '.png';
        $path = 'twibbon-results/' . $filename;

        Storage::disk('public')->put($path, (string) $image->encode('png', 90));

        // bisa redirect download atau share link
        $url = Storage::url($path);
        $this->dispatchBrowserEvent('twibbon-saved', ['url' => $url]);
    }
    public function render()
    {
        return view('livewire.twibbonizer')
            ->title($this->twibbon->nama . ' - Twibbonizer');
    }
}
