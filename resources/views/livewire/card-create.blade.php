<div class="max-w-md mx-auto mt-10 space-y-4">
    <h2 class="text-xl font-bold">Nuevo Pokémon</h2>

    {{-- Nombre / color --}}
    <input wire:model="name"  placeholder="Nombre" class="w-full border p-2 rounded">
    <input wire:model="color" placeholder="Color"  class="w-full border p-2 rounded">

    {{-- Categoría --}}
    <select wire:model="category_id" class="w-full border p-2 rounded">
        <option value="">Categoría…</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
        @endforeach
    </select>

    {{-- Atributos dinámicos --}}
    <div class="border p-3 rounded bg-gray-50">
        <h3 class="font-semibold mb-2">Atributos</h3>

        @foreach ($attrs as $i => $attr)
            <div class="flex gap-2 mb-2">
                <input type="text"
                       wire:model="attrs.{{ $i }}.key"
                       placeholder="clave"
                       class="flex-1 border p-1 rounded">
                <input type="text"
                       wire:model="attrs.{{ $i }}.value"
                       placeholder="valor"
                       class="flex-1 border p-1 rounded">
                <button type="button"
                        wire:click="removeAttr({{ $i }})"
                        class="text-red-600 font-bold px-2">×</button>
            </div>
        @endforeach

        <button type="button"
                wire:click="addAttr"
                class="text-blue-600 text-sm">+ Añadir atributo</button>
    </div>

    {{-- Imagen --}}
    <input type="file"
       wire:model="image"          {{-- ← sin .defer --}}
       class="border p-2 rounded" />

    {{-- Errores API --}}
    @error('api') <div class="text-red-600">{{ $message }}</div> @enderror

    {{-- Guardar --}}
    <button
        type="button"
        wire:click="save"
        wire:loading.attr="disabled"
        wire:target="save"          {{-- ← quitamos “,image” --}}
        class="bg-green-600 text-white px-4 py-2 rounded w-full flex items-center justify-center gap-2">

        <span wire:loading.remove wire:target="save">Guardar</span>

        <span wire:loading wire:target="save">
            <svg class="animate-spin h-5 w-5 mx-auto" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
            </svg>
        </span>
    </button>
</div>