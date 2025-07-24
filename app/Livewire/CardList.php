<?php

namespace App\Livewire;

use Livewire\Component;

class CardList extends Component
{
    public $page = 1;
    public $cards = [];

    public function load()
    {
        $resp = ApiClient::client()->get('/cards', ['page' => $this->page]);
        $this->cards = $resp->json('data');
    }

    public function mount() { $this->load(); }

    public function next() { $this->page++; $this->load(); }
    public function prev() { if($this->page>1) $this->page--; $this->load(); }

    public function render()
    {
        return view('livewire.card-list');
    }
}
