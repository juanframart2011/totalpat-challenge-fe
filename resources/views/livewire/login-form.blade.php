<div class="max-w-sm mx-auto mt-20">
    <h1 class="text-2xl mb-4 font-bold">Login</h1>

    <form wire:submit.prevent="login" class="space-y-4">
        <input type="email" wire:model.defer="email" placeholder="Email" class="w-full border p-2 rounded" required>
        <input type="password" wire:model.defer="password" placeholder="Password" class="w-full border p-2 rounded" required>

        @if($error)
            <div class="text-red-600 text-sm">{{ $error }}</div>
        @endif

        <button
            class="bg-blue-600 text-white px-4 py-2 rounded w-full"
            wire:click="login"
            wire:loading.attr="disabled">
            <span wire:loading.remove>Entrar</span>

            {{-- Spinner simple; se muestra solo cuando wire:loading --}}
            <span wire:loading>
                <svg class="animate-spin h-5 w-5 mx-auto" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                </svg>
            </span>
        </button>
    </form>
</div>