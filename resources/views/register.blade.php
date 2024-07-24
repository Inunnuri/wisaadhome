<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <section class="bg-gray-50 rounded-lg dark:bg-gray-900 m-4 p-4 md:p-6 lg:p-6">
    <div class="flex flex-col items-center justify-center px-6 mx-auto">
      <span class="text-primary-800 px-3 py-2 rounded-lg self-center text-2xl font-bold tracking-tight dark:text-white">WisaadHome</span>
        <div class="w-full bg-white rounded-lg shadow-lg m-2 dark:border max-w-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6">
                <h1 class="text-xl font-bold tracking-tight text-gray-900 md:text-2xl lg:text-2xl dark:text-white">
                    Create an account
                </h1>
                <form class="space-y-4" method="POST" action="{{ url('/register') }}">
                    @csrf
                    <div>
                        <label for="username" class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username ?? '') }}" class="form-control @error('username') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        </span>
                       @enderror   
                    </div>
                    <div>
                        <label for="name" class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" class="form-control @error('name') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="your Name" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        </span>
                       @enderror   
                    </div>
                    <div>
                        <label for="email" class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" class="form-control @error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        </span>
                       @enderror    
                    </div>
                    <div>
                        <label for="password" class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="min 8 characters" class="form-control @error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        </span>
                       @enderror   
                    </div>
                    <div>
                        <label for="password_confirmation" class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="min 8 characters" class="form-control @error('password_confirmation') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        </span>
                       @enderror 
                    </div>
                    {{-- <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" >
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                        </div>
                    </div> --}}
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
  </section>
</x-layout>
{{-- done --}}