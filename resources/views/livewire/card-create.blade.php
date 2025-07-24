<div class="max-w-md mx-auto mt-10 space-y-4">
    <h2 class="text-xl font-bold">Nueva tarjeta</h2>

    <input wire:model="name" placeholder="Nombre" class="w-full border p-2 rounded">
    <input wire:model="color" placeholder="Color" class="w-full border p-2 rounded">

    <select wire:model="category_id" class="w-full border p-2 rounded">
        <option value="">Categoría…</option>
        @foreach($categories as $cat)
            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
        @endforeach
    </select>

    <input type="file" wire:model="image">

    <button wire:click="save" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
</div>
