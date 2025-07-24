<div class="max-w-sm mx-auto mt-20">
    <h1 class="text-2xl mb-4 font-bold">Login</h1>

    <form wire:submit.prevent="login" class="space-y-4">
        <input type="email" wire:model.defer="email" placeholder="Email" class="w-full border p-2 rounded" required>
        <input type="password" wire:model.defer="password" placeholder="Password" class="w-full border p-2 rounded" required>

        @if($error)
            <div class="text-red-600 text-sm">{{ $error }}</div>
        @endif

        <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Entrar</button>
    </form>
</div>