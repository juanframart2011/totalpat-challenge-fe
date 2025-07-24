<div class="max-w-3xl mx-auto mt-8">
    <div class="grid md:grid-cols-3 gap-4">
        @foreach($cards as $c)
            <div class="border rounded p-4 shadow">
                <img src="{{ $c['image_path'] ? $base_url.'/storage/'.substr($c['image_path'],7) : 'https://via.placeholder.com/150' }}" class="mb-2 rounded">
                <h3 class="font-semibold">{{ $c['name'] }}</h3>
                <span class="text-sm text-gray-500">{{ $c['category']['name'] ?? '' }}</span>
            </div>
        @endforeach
    </div>

    <div class="flex justify-between mt-4">
        <button wire:click="prev" class="px-3 py-1 border rounded" @disabled($page==1)>Prev</button>
        <span>Página {{ $page }}</span>
        <button wire:click="next" class="px-3 py-1 border rounded">Next</button>
    </div>
</div>
