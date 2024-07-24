<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>

 {{-- post start --}}
 <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
   <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
       <article class="mx-auto w-full max-w-4xl">
           <header class="mb-4 lg:mb-6">
               <address class="flex items-center mb-6 not-italic">
                   <div class="inline-flex">
                       <div>
                           <a href="/authors/{{$post->author->name}}" rel="author" class="hover:underline text-xl font-bold text-gray-900 dark:text-white">{{$post->author->name}}</a>
                           <p class="text-sm text-gray-500 dark:text-gray-400">{{$post->created_at->diffForHumans()}}</p>
                           <a href="/categories/{{$post->category->slug}}">
                             <span class="bg-{{$post->category->color}}-100 text-primary-800 text-xs font-medium items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 hover:underline">
                                 {{$post->category->name}}
                             </span>
                           </a>
                       </div>
                   </div>
               </address>
               <h1 class="mb-2 text-xl md:text-2xl lg:text-3xl font-extrabold leading-tight text-gray-900 dark:text-white">{{$post ['title']}}</h1>
           </header>
           <p class="lead mb-2">{{$post ['body']}}</p>
           <a href="/posts" class="font-medium text-primary-600">Back &laquo;</a>
       </article>
   </div>
 </main>
 {{-- post end --}}

 {{-- related start --}}
 <div class="flex justify-between bg-primary-50 rounded-xl shadow-md px-4 mx-auto max-w-screen-xl">
    <section class="mx-auto mt-4 mb-10 w-full max-w-4xl">
        <h2 class="text-xl md:text-2xl lg:text-2xl font-bold text-gray-900 dark:text-white p-4">Related Articles</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($relatedPosts as $relatedPost)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                    <a href="{{ route('posts.show', $relatedPost->slug) }}" class="block">
                        <h3 class="text-xl font-semibold leading-tight tracking-tight mb-2 text-gray-900 dark:text-white">{{ $relatedPost->title }}</h3>
                        <p class="text-gray-700 leading-tight mb-2 dark:text-gray-400">{{ Str::limit($relatedPost->body, 100) }}</p>
                    </a>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $relatedPost->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    </section>
</div>
{{-- related end --}}
</x-layout>
{{-- done --}}