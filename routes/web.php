<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\LoginForm;
use App\Livewire\CardList;
use App\Livewire\CardCreate;

Route::middleware('guest')->get('/login', LoginForm::class)->name('login');

Route::middleware('auth.front')->group(function () {
    Route::get('/', CardList::class)->name('cards.list');
    Route::get('/cards/create', CardCreate::class)->name('cards.create');
});

