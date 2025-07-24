<div class="max-w-3xl mx-auto mt-8">

    <div class="flex justify-end mb-4">
        <a href="{{ route('cards.create') }}"
           class="bg-green-600 text-white px-3 py-2 rounded shadow">
            + Nueva tarjeta
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        @forelse ($cards as $c)
            <div class="border rounded p-4 shadow">
                @php
                    $url = $c['image_path']
                           ? 'http://localhost:9000/storage/'.$c['image_path']
                           : 'https://via.placeholder.com/150';
                @endphp

                <img src="{{ $url }}" class="mb-2 rounded">

                <h3 class="font-semibold">{{ $c['name'] }}</h3>
                <span class="text-sm text-gray-500">
                    {{ $c['category']['name'] ?? '' }}
                </span>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">Sin tarjetas.</p>
        @endforelse
    </div>

    @if( count( $cards ) > 0 )
        <div class="flex justify-between mt-4">
            <button wire:click="prev" class="px-3 py-1 border rounded"
                    @disabled($page==1)>Prev</button>

            <span>Página {{ $page }}</span>

            <button wire:click="next" class="px-3 py-1 border rounded">Next</button>
        </div>
    @endif
</div>