<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiClient;
use Livewire\WithFileUploads;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;

class CardCreate extends Component
{
    use WithFileUploads;
    public $name, $color, $category_id;
    public array $attrs = [['key' => '', 'value' => '']];   // ⬅️ atributos
    public $image;
    public array $categories = [];

    public function mount()
    {
        $this->categories = ApiClient::client()->get('/categories')->json();
    }

    public function addAttr(): void   { $this->attrs[] = ['key'=>'','value'=>'']; }
    public function removeAttr($index): void { unset($this->attrs[$index]); }

    public function save()
    {
        $data = $this->validate([
            'name'        => 'required|string|max:255',
            'color'       => 'required|string|max:30',
            'category_id' => 'required',
            'attrs'       => 'array',
            'attrs.*.key'   => 'required_with:attrs.*.value',
            'attrs.*.value' => 'required_with:attrs.*.key',
            'image'       => 'nullable|image|max:1024',
        ]);

        $attributes = collect($this->attrs)
        ->filter(fn ($a) => $a['key'] && $a['value'])    // descarta vacíos
        ->pluck('value', 'key')                          // key => value
        ->toArray();

        $client = ApiClient::client()->asMultipart();

        if ($this->image) {
            // Abre el archivo en binario y pasa también el nombre original
            $client = $client->attach(
                'image',
                fopen($this->image->getRealPath(), 'r'),
                $this->image->getClientOriginalName()
            );
        }

        $resp = $client->post('/cards', [
            'name'        => $this->name,
            'color'       => $this->color,
            'category_id' => $this->category_id,
            'attributes'  => $attributes,
        ]);

        if ($resp->failed()) {
            // Registra código y cuerpo para depurar
            logger()->debug('Card create failed', [
                'status' => $resp->status(),
                'body'   => $resp->json(),
            ]);

            // Muestra los mensajes que traiga la API (si existen)
            $this->error = $resp->json('message', 'Error al guardar');
            $this->addError('api', $this->error);
            return;
        }

        redirect()->route('cards.list');
    }

    public function render()
    {
        return view('livewire.card-create')
               ->with('baseUrl', config('services.backend.url'));
    }
}
