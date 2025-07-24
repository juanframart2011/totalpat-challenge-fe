<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiClient;
use Illuminate\Support\Arr;

class CardList extends Component
{
    public $page = 1;
    public $cards = [];

    public function load()
    {
        $resp = ApiClient::client()->get('/cards', ['page' => $this->page]);
        
        // Si la petición falló, deja el array vacío
        if ($resp->failed()) {
            $this->cards = [];
            return;
        }

        // Toma 'data' o, si viene null, devuelve []
        $this->cards = $resp->json('data', []);
    }

    public function mount() {
        $this->load();
    }

    public function next() {
        $this->page++; $this->load();
    }
    public function prev() {
        if($this->page>1) $this->page--; $this->load();
    }

    public function render()
    {
        return view('livewire.card-list', [
            'baseUrl' => config('services.backend.url'),
        ]);
    }
}
