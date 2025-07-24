<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiClient;

class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';
    public string $error = '';

    public function login()
    {
        $response = ApiClient::client()->post('/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->failed()) {
            $this->error = 'Credenciales inválidas';
            return;
        }

        session([
            'api_token' => $response['token'],
            'user'      => $response['user'],
        ]);

        return redirect()->route('cards.list');
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
