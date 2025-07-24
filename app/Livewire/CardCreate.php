<?php

namespace App\Livewire;

use Livewire\Component;

class CardCreate extends Component
{
    public $name, $color, $category_id, $cardAttributes = [], $image;
    public $categories = [];

    public function mount()
    {
        $this->categories = ApiClient::client()->get('/categories')->json();
    }

    public function save()
    {
        $this->validate([
            'name'        => 'required|string|max:255',
            'color'       => 'required|string|max:30',
            'category_id' => 'required',
            'image'       => 'nullable|image|max:1024', // KB
        ]);

        $response = ApiClient::client()
            ->attach('image', $this->image?->getRealPath(), $this->image?->getClientOriginalName())
            ->post('/cards', [
                'name'        => $this->name,
                'color'       => $this->color,
                'category_id' => $this->category_id,
                'attributes'  => $this->cardAttributes,
            ]);

        if ($response->failed()) {
            $this->addError('api', 'Error al guardar');
            return;
        }

        return redirect()->route('cards.list');
    }

    public function render()
    {
        return view('livewire.card-create');
    }
}
