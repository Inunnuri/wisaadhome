<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
<div class="py-2">
  <h2 class="text-xl font-light mb-2 italic">Hasil Pencarian untuk: "{{ $query }}"</h2>
  {{-- my product start --}}
  <div class="p-4 bg-primary-50">
    @if(isset($products) && $products->count() > 0)
      <h3 class="text-2xl font-semibold pt-6 px-8">Produk {{ $query }} saya:</h3>
          @foreach($products as $product)
          <section class=" bg-primary-50 rounded-lg dark:bg-gray-900 mt-6 md:mt-8 lg:mt-10">
            <div class="px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
              @foreach ($products as $product)
                  <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
                    <div class="flex justify-center items-center mt-2">
                      <img src="{{ asset('storage/' . $product->post_photo) }}" alt="{{ $product->jenis}}" class="w-48 h-48 object-cover">
                    </div>
                    
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
                          <a href="{{route('register')}}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Buat Akun</a>
                           </div>
                        @endauth
                      </div>
                    </div>
          
                    <hr class="my-6 md:my-4 border-gray-200 dark:border-gray-800" />
                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $product->description }}</p>
                  
                    <hr class="my-2 md:my-4 border-gray-200 dark:border-gray-800" />
                    <div class="inline-flex">
                      <button data-product-id="{{ $product->id }}" role="button" class="deleteBtn m-2 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-2.5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center">Hapus Product
                      </button>
        
                      <!-- edit product start -->
                      <button data-product-id="{{ $product->id }}"
                      class="editProductBtn m-2 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-2.5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                      role="button">Edit Product
                      </button>
                       {{-- form --}}
                      <div data-product-id="{{ $product->id }}" class="editProductForm fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                         <div class="bg-white rounded-lg p-6 w-full max-w-md">
                           <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Product</h3>
                           <form method="POST" action="{{ route('edit.product', $product->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('PUT')
                               <div class="py-2">
                                 <div>
                                    <label for="nama" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                    <input name="nama" id="nama" value="{{ old('nama', $product->nama ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2 p-2.5" required=""></input>
                                 </div>
                                 <div>
                                    <label for="jenis_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Jenis</label>
                                    <select name="jenis_id" id="jenis_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" required>
                                       @foreach ($jenis as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div>
                                    <label for="category_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                    <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" required>
                                       @foreach ($categories as $category)
                                         <option value="{{ $category->id }}">{{ $category->name }}</option>
                                       @endforeach
                                     </select>
                                 </div>
                                 <div>
                                    <label for="price" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                    <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" required>
                                 </div>
                                 <div>
                                    <label for="alamat" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
                                    <input  name="alamat" id="alamat" value="{{ old('alamat', $product->alamat ?? '') }}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2">
                                 </div>
                                 <div>
                                     <label for="description" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                     <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" placeholder="Tulis deskripsi produkmu disini"></textarea>
                                 </div>
                                 <div>
                                    <input type="file" id="post_photo" name="post_photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" required>
                                 </div>
                               </div>
                               <div class="inline-flex space-x-4">
                                   <button type="button" class="productCancelBtn rounded-lg bg-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400" data-product-id="{{ $product->id }}">Cancel</button>
        
                                   <button type="submit" class=" text-white flex justify-center items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-3 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                      <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>Update Product
                                   </button>
                               </div>
                           </form>
                         </div>
                      </div>
                       {{-- edit product end --}}
                    </div>
                  </div>
              @endforeach
            </div>
            </div>
          </section>
          @endforeach
    @else
      <p class="text-sm text-red-500">Tidak ada produk saya yang ditemukan.</p>
    @endif
  </div>
  {{-- my product end --}}

  {{-- favorite start --}}
  <div class="py-4 px-5">
    @if(isset($favorites) && $favorites->count() > 0)
        <section class=" bg-white dark:bg-gray-900 mt-2">
          <h3  class="text-2xl font-semibold pt-6 px-8">Produk {{ $query }} Favorit:</h3>
          <div class="py-4 px-8">
          <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          @foreach($favorites as $favorite)
                  <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
                    <div class="flex justify-center items-center mt-2">
                      <img src="{{ asset('storage/' . $favorite->post_photo) }}" alt="{{ $favorite->jenis}}" class="w-48 h-48 object-cover">
                    </div>
                    
                    <div class="mt-6">
                      <h1 class="text-2xl tracking-tight font-bold text-gray-900 ">"{{ $favorite->nama}}"</h1>
                      <div class="mt-2">
                        <a href="{{ route('item.jenis',$favorite->jenis->name) }}"><h2
                        class=" text-white bg-gray-500 text-xs font-medium inline-flex px-2.5 py-0.5 mt-2 rounded hover:underline dark:bg-white dark:text-gray-700">{{$favorite->jenis->name}}</h2></a>
                        <a href="{{ route('item.category', $favorite->category->name) }}" class="bg-{{$favorite->category->color}}-100 text-primary-800 text-xs font-medium inline-flex px-2.5 py-0.5 rounded dark:bg-white dark:text-gray-700 hover:underline">{{ $favorite->category->name }}</a>
                      </div>
                      <p class="text-2xl mt-4 font-extrabold tracking-tight text-gray-900 dark:text-white">Rp {{ number_format($favorite->price, 0, ',', '.') }}</p>
                      @if (!auth()->check() || auth()->user()->id !== $favorite->user_id)
                      <div class="flex items-center gap-2 md:gap-1 mt-2">
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">diposting oleh</p>
                          <a href="{{ route('item.index', $favorite->user->name) }}" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{ $favorite->user->name }}</a>
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$favorite->created_at->diffForHumans()}}</p>
                      </div>
                      @endif
                    </div>
          
                    <div class="mt-4">
                      <div class="inline-flex justify-center items-center space-x-4">
                        <form action="{{ route('favorite.remove', $favorite->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="py-2 px-1 text-sm font-medium text-gray-900 focus:outline-none bg-gray-100 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" role="button">Remove from Favorites</button>
                        </form>
                        <a href="{{ route('conversations.create', $favorite->id) }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center" role="button">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" /></svg>Chat Penjual
                        </a>
                      </div>
                    </div>
                    <hr class="my-6 md:my-4 border-gray-200 dark:border-gray-800" />
                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $favorite->description }}</p>
                  </div>
                  @endforeach
          </div>
          </div>
        </section>
    @else
      <p class="text-sm text-red-500">Tidak ada produk favorit yang ditemukan.</p>
    @endif
  </div>
  {{-- favorite end --}}

  {{-- product start --}}
  <div class="py-4 bg-primary-50 px-5">
    @if(isset($items) && $items->count() > 0)
      <section class=" bg-primary-50 rounded-lg dark:bg-gray-900 mt-6 md:mt-8 lg:mt-10">
        <h3 class="text-2xl font-semibold px-8">Produk {{ $query }}:</h3>
        <div class="py-4 px-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          @foreach($items as $item)
          <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
            <div class="flex justify-center items-center mt-2">
              <img src="{{ asset('storage/' .$item->post_photo) }}" alt="{{ $item->jenis}}" class="w-48 h-48 object-cover">
            </div>
            
            <div class="mt-6">
              <h1 class="text-2xl tracking-tight font-bold text-gray-900 ">"{{ $item->nama}}"</h1>
              <div class="mt-2">
                <a href="{{ route('item.jenis', $item->jenis->name) }}"><h2
                class=" text-white bg-gray-500 text-xs font-medium inline-flex px-2.5 py-0.5 mt-2 rounded hover:underline dark:bg-white dark:text-gray-700">{{ $item->jenis->name}}</h2></a>
                <a href="{{ route('item.category', $item->category->name) }}" class="bg-{{$item->category->color}}-100 text-primary-800 text-xs font-medium inline-flex px-2.5 py-0.5 rounded dark:bg-white dark:text-gray-700 hover:underline">{{ $item->category->name }}</a>
              </div>
              <p class="text-2xl mt-4 font-extrabold tracking-tight text-gray-900 dark:text-white">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
              @if (!auth()->check() || auth()->user()->id !== $item->user_id)
              <div class="flex items-center gap-2 md:gap-1 mt-2">
                  <p class="text-sm font-medium text-gray-500 dark:text-gray-400">diposting oleh</p>
                  <a href="{{ route('item.index', $item->user->name) }}" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{ $item->user->name }}</a>
                  <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$item->created_at->diffForHumans()}}</p>
              </div>
              @endif
            </div>
          
            <div class="mt-4">
              <div class="inline-flex justify-center items-center space-x-4">
                @auth
                  @if ($item->user_id !== Auth::id())
                    @if (!in_array($item->id, $favoriteProductIds))
                      <form action="{{ route('favorite.add', $item->id) }}" method="POST">
                        @csrf
                         <button type="submit" class="py-2 px-2 text-sm font-medium text-gray-900 focus:outline-none bg-gray-100 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" role="button">Add to Favorites</button>
                      </form>
                    @else
                      <button class="text-sm px-1 py-2 font-medium text-gray-500 bg-gray-200 rounded-lg border border-gray-200 cursor-not-allowed" disabled>Already in Favorites</button>
                    @endif
        
                    <a href="{{ route('conversations.create', $item->id) }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center" role="button">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" /></svg>Chat Penjual
                    </a>
                  @endif
                @else
                   <div class="mt-4">
                  <p class="text-sm font-medium text-gray-500 dark:text-gray-400 inline-flex">chat penjual ?</p>
                  <a href="{{route('register')}}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Buat Akun</a>
                   </div>
                @endauth
              </div>
            </div>
  
            <hr class="my-6 md:my-4 border-gray-200 dark:border-gray-800" />
            <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $item->description }}</p>
          </div>
          @endforeach
        </div>
        </div>
      </section>
    @else
      <p class="text-sm text-red-500">Tidak ada produk yang ditemukan.</p>
    @endif
  </div>
  {{-- product end --}}

  {{-- post start --}}
  <div class="py-4">
    @if(isset($posts) && $posts->count() > 0)
      <section class="bg-primary-50 shadow-lg mt-5 lg:mt-10 dark:bg-gray-900">
        <h3 class="text-2xl font-semibold pt-6 px-5">Articles {{ $query }}</h3>
        <div class="lg:py-15">
          <div class="py-4 px-4 mx-auto max-w-screen-xl">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                  <div class="flex justify-between items-center mb-5">
                    <a href="{{route('category.posts', $post->category->name )}}">
                    <span class="bg-{{$post->category->color}}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                        {{$post->category->name}}
                    </span>
                    </a>
                    <span class="text-sm text-gray-400">{{$post->created_at->diffForHumans()}}</span>
                  </div>
                  <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                  <a href="{{ route('posts.show', $post->slug) }}" class="hover:underline">{{$post ['title']}}</a>
                  </h2>
                  <p class="mb-4 font-light text-gray-500 dark:text-gray-400">{{Str::limit($post ['body'], 200)}}</p>
                  <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <a href="{{route('author.posts', $post->author->name )}}" class="hover:underline">
                        <span class="font-medium text-sm dark:text-white">
                          {{$post->author->name}}
                        </span>
                        </a>
                    </div>
                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                        Read more
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                  </div>
                </article> 
                @endforeach
            </div>
          </div>
        </div>
      </section>
    @else
      <p class="text-sm text-red-500">Tidak ada article yang ditemukan.</p>
    @endif
  </div>
  {{-- post end --}}
</div>
</x-layout>