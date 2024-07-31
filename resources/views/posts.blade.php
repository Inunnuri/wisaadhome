<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>

 <section class="bg-primary-50 shadow-lg mt-5 lg:mt-10 dark:bg-gray-900">
  <div class=" py-10 lg:py-15">
    <div class="py-4 px-4 mx-auto max-w-screen-xl">
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($posts as $post)
          <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-5">
              <a href="{{route('category.posts', $post->category->name )}}">
              <span class="bg-{{$post->category->color}}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 hover:underline">
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
</x-layout>
{{-- done --}}