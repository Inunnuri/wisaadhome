<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>

  {{-- article start --}}
  <section class="bg-white dark:bg-gray-900">
    <div class="items-center py-4 md:py-6 lg:py-8 px-2 mx-auto max-w-screen-xl md:grid md:grid-cols-2 lg:grid lg:grid-cols-2">
        <div class="font-light text-gray-500 dark:text-gray-400">
            <h2 class="text-2xl md:text-3xl lg:text-4xl mb-2 tracking-tight font-extrabold text-gray-900 dark:text-white">We didn't reinvent the wheel</h2>
            <p class="lg:mt-4 lg:text-lg">We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.</p>
            <p  class="lg:mt-4 lg:text-lg">We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.</p>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-8">
            <img class="w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="office content 1">
            <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png" alt="office content 2">
        </div>
    </div>
</section>
{{-- article end --}}

{{-- sign up --}}
<section class="bg-white dark:bg-gray-900">
  <div class="py-8">
      <div class="mx-auto max-w-screen-sm text-center">
          <h2 class="mb-4 text-2xl md:text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Mulai cari rumah impianmu!</h2>
          <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg lg:text-lg">Gak perlu ribet panas-panasan buat nyari rumah, cukup dari rumah.</p>
          @auth
          <a href="/item" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm md:text-m lg:text-lg px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Mulai</a>
          @else
          <a href="/register" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm md:text-m lg:text-lg px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Buat Akun</a>
          @endauth
      </div>
  </div>
</section>
{{-- sign up end --}}

{{-- blog start --}}
<section class="bg-primary-100 rounded-lg shadow-lg mt-5 lg:mt-10 dark:bg-gray-900">
            <div class=" py-10 lg:py-15">
              <div class=" px-6 lg:px-8">
                  <div class="text-center">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Artikel Terbaru</h2>
                    <p class="mt-4 mb-4 font-light text-gray-500 dark:text-gray-400 md:text-lg lg:text-lg">Learn how to grow your business with our expert advice.</p>
              </div>
                  {{-- artikel --}}
              <div class="py-4 px-4 mx-auto max-w-screen-xl">
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                    <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                      <div class="flex justify-between items-center mb-5">
                        <a href="/categories/{{$post->category->slug}}">
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
                            <a href="/authors/{{$post->author->name}}" class="hover:underline">
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
                  {{-- link lihat artikel lainnya--}}
              <div class="flex justify-center">
                    <a href="/posts" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                    Lihat Artikel Lainnya</a>
              </div>
            </div>
</section>
{{-- blog end --}}

{{-- product start --}}
<section class=" bg-primary-50 rounded-lg dark:bg-gray-900 mt-6 md:mt-8 lg:mt-10">
  <div class="py-10 px-8">
  <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($products as $product)
        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
          <div class="flex justify-center items-center mt-2">
            <a href="{{route('detail', $product->id)}}">
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
              @auth
                @if ($product->user_id !== Auth::id())
                  @if (!in_array($product->id, $favoriteProductIds))
                    <form action="{{ route('favorite.add', $product->id) }}" method="POST">
                      @csrf
                       <button type="submit" class="favorite-form py-2 px-2 text-sm font-medium text-gray-900 focus:outline-none bg-gray-100 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" role="button">Add to Favorites</button>
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
        </div>
        @endforeach
  </div>
  </div>
</section>
{{-- product end --}}
</x-layout>
{{-- done --}}