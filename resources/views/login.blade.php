<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <section class="bg-gray-50 rounded-lg dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center p-6">
      <span class=" text-primary-800 pb-2 rounded-lg self-center text-2xl font-bold tracking-tight dark:text-white">WisaadHome</span>
        <div class="mx-auto p-4 bg-white rounded-lg shadow-lg dark:border dark:bg-gray-800 dark:border-gray-700">
            <div class="space-y-4">
                <h1 class="text-lg md:text-xl lg:text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Sign in to your account
                </h1>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        </span>
                       @enderror 
                    </div>
                    <div class="mt-4">
                        <label for="password" class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="your password" class="form-control @error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        </span>
                       @enderror 
                    </div>
                    <div>
                        <div class="flex mt-4 mb-4">
                            <div class="flex items-center h-5">
                              <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm">
                              <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                            </div>
                        </div>
                        {{-- <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a> --}}
                    </div>
                        <!-- Form input fields for email and password -->
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-4">
                        Don’t have an account yet? <a href="{{route('register')}}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>
</x-layout>
{{-- done --}}