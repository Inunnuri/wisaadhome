<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>

{{-- add new favorite start --}}
<div class="px-8 mt-4">
 <a href="{{route('item')}}">
  <button type="button" class="inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs md:text-s lg:text-m px-3 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"><svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg> Add New Favorite</button>
 </a>
</div>
{{-- add new favorite end --}}

{{-- view product favorite start --}}
<section class=" bg-white dark:bg-gray-900 mt-2">
  <div class="py-10 px-8">
  <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($products as $product)
        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
            <a href="{{route('detail', $product->id)}}">
          <div class="flex justify-center items-center mt-2">
            <img src="{{ asset('storage/' . $product->post_photo) }}" alt="{{ $product->jenis}}" class="w-48 h-48 object-cover">
          </div>
          
          <div class="mt-6">
              <h1 class="text-2xl tracking-tight font-bold text-gray-900 hover:underline ">"{{ $product->nama}}"</h1>
              </a>
            <div class="mt-2">
              <a href="{{ route('item.jenis', $product->jenis->name) }}"><h2
              class=" text-white bg-gray-500 text-xs font-medium inline-flex px-2.5 py-0.5 mt-2 rounded hover:underline dark:bg-white dark:text-gray-700">{{ $product->jenis->name}}</h2></a>
              <a href="{{ route('item.category', $product->category->name) }}" class="bg-{{$product->category->color}}-100 text-primary-800 text-xs font-medium inline-flex px-2.5 py-0.5 rounded dark:bg-white dark:text-gray-700 hover:underline">{{ $product->category->name }}</a>
            </div>
            <p class="text-2xl mt-4 font-extrabold tracking-tight text-gray-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            @if (!auth()->check() || auth()->user()->id !== $product->user_id)
            <div class="flex items-center gap-2 md:gap-1 mt-2">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">diposting oleh</p>
                <a href="{{ route('item.index', $product->user->name) }}" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{ $product->user->name }}</a>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$product->created_at->diffForHumans()}}</p>
            </div>
            @endif
          </div>

          <div class="mt-4">
            <div class="inline-flex justify-center items-center space-x-4">
              <form action="{{ route('favorite.remove', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="py-2 px-1 text-sm font-medium text-gray-900 focus:outline-none bg-gray-100 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" role="button">Remove from Favorites</button>
              </form>
              <a href="{{ route('conversations.create', $product->id) }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" /></svg>Chat Penjual
              </a>
            </div>
          </div>
        </div>
        @endforeach
  </div>
  </div>
</section>
{{-- view product favorite end --}}
</x-layout>

{{-- done --}}