<headerhome class="bg-header bg-cover bg-center w-full min-h-[250px] flex items-center justify-center">
  <div class="container px-12 md:px-4 lg:px-10">
    <div class="flex mt-4 md:py-2 lg:py-4">
      <h1 class="font-semibold text-3xl md:text-3xl lg:text-4xl text-center text-primary-800 font-body
      tracking-tight
      ">{{$slot}}</h1>
    </div>
      {{-- search --}}
      <form action="{{ route('search') }}" method="GET" class="flex mt-2 md:mt-0 lg:mt-0">
       <div>
       <input type="text" name="query" class="bg-transparent border border-gray-600 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
       </div>
      </form>
  </div>
</headerhome>
{{-- done --}}