<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiClient;
use Illuminate\Support\Arr;

class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';
    public string $error = '';

    public function login()
    {
        $this->error = '';

        $response = ApiClient::client()->post('/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->failed()) {
            $this->error = $response->json('message', 'Credenciales inválidas');
            return;
        }

        $data = $response->json();

        // seguridad: confirma que vienen token y user
        if (!isset($data['token'], $data['user'])) {
            $this->error = 'Formato de respuesta inesperado';
            return;
        }

        session([
            'api_token' => $data['token'],
            'user'      => $data['user']
        ]);

        return redirect()->route('cards.list');
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
