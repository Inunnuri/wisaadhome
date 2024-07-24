<x-layout>
  <x-slot:title>Detail Produk</x-slot:title>

  <section>
    <div class="py-10 px-8 lg:grid lg:grid-cols-2 md:grid md:grid-cols-2">
        <img src="{{ asset('storage/' . $product->post_photo) }}" alt="{{ $product->jenis}}" class="max-auto object-cover rounded-lg">
        <div class="p-6 bg-white max-auto dark:bg-gray-900 rounded-lg border border-gray-200 shadow-md  dark:border-gray-700 ">
            <div class="mt-6">
              <h1 class="text-2xl tracking-tight font-bold text-gray-900 ">"{{ $product->nama}}"</h1>
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
              @auth
                @if ($product->user_id !== Auth::id())
                  @if (!in_array($product->id, $favoriteProductIds))
                    <form action="{{ route('favorite.add', $product->id) }}" method="POST">
                      @csrf
                       <button type="submit" class="py-2 px-2 text-sm font-medium text-gray-900 focus:outline-none bg-gray-100 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" role="button">Add to Favorites</button>
                    </form>
                  @else
                    <button class="text-sm px-1 py-2 font-medium text-gray-500 bg-gray-200 rounded-lg border border-gray-200 cursor-not-allowed" disabled>Already in Favorites</button>
                  @endif
      
                  <a href="{{ route('conversations.create', $product->id) }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" /></svg>Chat Penjual
                  </a>
                @endif
              @else
                 <div class="mt-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 inline-flex">chat penjual ?</p>
                <a href="/register" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Buat Akun</a>
                 </div>
              @endauth
          </div>
          </div>

          <hr class="my-6 md:my-4 border-gray-200 dark:border-gray-800" />
          <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $product->description }}</p>
        </div>
    </div>
  </section>
</x-layout>

{{-- done --}}
