<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  @if ($errors->any())
  <div class="font-sm px-6 text-red-700 py-6">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

{{-- create product start--}}
<section class="py-4 px-2">
   <button type="button" id="addProductBtn" class="inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs md:text-s lg:text-m px-3 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"><svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg> Add New Product</button>
     {{-- form --}}
    <div id="addProductForm" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 hidden">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Add Product
        </h3>
        <form method="POST" action="{{route ('add.product')}}" enctype="multipart/form-data">
            @csrf
            <div class="py-4">
                <div>
                    <label for="nama" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                    <input name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" placeholder="Beri judul" required="">
                    </input>
                </div>
                <div>
                    <label for="jenis_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Jenis</label>
                    <select name="jenis_id" id="jenis_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" placeholder="Jenis Properti" required="">
                        @foreach ($jenis as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="category_id" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                    <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" required="">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="price" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" placeholder="1000000" required="">
                </div>
                <div>
                    <label for="alamat" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input  name="alamat" id="alamat"rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"></input>
                </div>
                <div>
                    <label for="description" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2" placeholder="Tulis deskripsi produkmu disini"></textarea>
                </div>
                <div class="py-2">
                    <input type="file" id="post_photo" name="post_photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" required>
                </div>
            </div>
            <div class="inline-flex space-x-3">
              <button type="button" id="cancelBtn" class="rounded-md bg-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400">Cancel</button>

              <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Add new product</button>
            </div>
        </form>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("addProductForm");
        const addProductBtn = document.getElementById("addProductBtn");
        const cancelBtn = document.getElementById("cancelBtn");

        addProductBtn.addEventListener("click", function () {
            modal.classList.toggle("hidden");
            if (!modal.classList.contains("hidden")) {
                 modal.classList.add("flex");
               } else {
                 modal.classList.remove("flex");
               }
        });

        cancelBtn.addEventListener("click", function () {
            modal.classList.add("hidden");
        });

        // Close the modal when the user clicks anywhere outside of the modal
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });
    });
  </script>
</section>
{{-- create product end --}}


  {{-- view product user start --}}
  <section  class="bg-primary-50 rounded-lg dark:bg-gray-900 mt-6 md:mt-8 lg:mt-10">
    <div class="py-10 px-8">
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($products as $product)
          <div data-product-id="{{ $product->id }}" class="post p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mb-4">
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
  {{-- view product user end --}}
</x-layout>

{{-- done --}}