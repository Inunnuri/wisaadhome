<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>

  @if ($errors->any())
  <div class="font-sm px-8 text-red-700 py-6">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<section class="bg-primary-50 rounded-lg shadow-lg dark:bg-gray-900 m-4">
  <div class="pt-8 pb-16 px-6 md:px-16 lg:px-24">
      <div class="mb-4">
        <div class="mb-10">
            @if ($profile->profile_photo)
              <img src="{{ asset('storage/' . $profile->profile_photo) }}" alt="Profile Photo" class="w-48 h-48 object-cover rounded-full">
            @else
              <img src="{{ asset('storage/default.jpg') }}" alt="Profile Photo" class="w-48 h-48 object-cover rounded-full">
            @endif
        </div>
        <div class="mb-5">
          <h2 class="text-xl font-bold tracking-tight text-gray-900">Profile {{Auth::User()->name}}</h2>
        </div>
        <hr class="border line"/>
        <div class="mt-4 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            <dt class="text-sm lg:text-m font-bold text-gray-900">Full Name:</dt>
            <dd class="text-sm text-gray-700">{{$profile->name}}</dd>
        </div>
        <div class="mt-4 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            <dt class="text-sm lg:text-m font-bold text-gray-900">Email Address:</dt>
            <dd class="text-sm text-gray-700">{{$profile->email}}</dd>
        </div>
        <div class="mt-4 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            <dt class="text-sm lg:text-m font-bold text-gray-900">Country:</dt>
            <dd class="text-sm text-gray-700">{{$profile->country}}</dd>
        </div>
        <div class="mt-4 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            <dt class="text-sm lg:text-m font-bold text-gray-900">Street Address:</dt>
            <dd class="text-sm text-gray-700"> {!! $profile->street_address . ', ' . $profile->city . ', ' . $profile->region . ', ' . $profile->postal_code !!}</dd>
        </div>
        <div class="mt-4 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            <dt class="text-sm lg:text-m font-bold text-gray-900">About:</dt>
            <dd class="text-sm text-gray-700">{{$profile->about}}</dd>
        </div>
      </div>
          {{-- Button toggle edit --}}
      <div>
          <button id="editProfileBtn" class="rounded-md bg-primary-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Edit Profile</button>
          {{-- form --}}
          <div id="editProfileForm" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 overflow-auto hidden py-5">
             <div class="w-full h-full max-w-lg">
              <div class="p-6 bg-white rounded-lg">
                <h2 class="text-xl text-gray-900 font-bold mb-2">Edit Profile</h2>
                   <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                           <div class="space-y-4">
                              <div class="w-full">
                                <label for="name" class="block text-sm text-gray-900 font-semibold">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $profile->name ?? Auth::user()->name) }}"  autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                              </div>
                              <div class="w-full">
                                <label for="email" class="block text-sm font-semibold text-gray-900 ">Email</label>
                                <input type="text" name="email" id="email" value="{{ old('name', $profile->email ?? Auth::user()->email) }}"  autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                              </div>
                              <div class="w-full">
                                <label for="country" class="block text-sm font-semibold text-gray-900 ">Country</label>
                                <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                    <option>Indonesia</option>
                                </select>
                              </div>
                              <div class="w-full">
                                <label for="street_address" class="block text-sm font-semibold text-gray-900 ">Street address</label>
                                <input type="text" name="street_address" id="street_address" value="{{ old('street_address', $profile->street_address ?? '') }}" autocomplete="street_address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                              </div>
                              <div class="w-full">
                                <label for="city" class="block text-sm font-semibold text-gray-900 ">City</label>
                                <input type="text" name="city" id="city" value="{{ old('city', $profile->city ?? '') }}" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                              </div>
                              <div class="w-full">
                                <label for="region" class="block text-sm font-semibold text-gray-900 ">State / Province</label>
                                <input type="text" name="region" id="region" value="{{old('region', $profile->region ?? '')}}" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                              </div>
                              <div class="w-full">
                                <label for="postal_code" class="block text-sm font-semibold text-gray-900">ZIP / Postal code</label>
                                <input type="text" name="postal_code" id="postal_code" value="{{old('postal_code', $profile->postal_code ?? '')}}" autocomplete="postal_code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                              </div>
                              <div class="w-full">
                                <label for="about" class="block text-sm font-semibold text-gray-900">About</label>
                                <textarea id="about" name="about" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset bg-gray-100 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600" placeholder="write a few sentences about yourself."></textarea>
                              </div>
                                {{-- photo profile --}}
                              <div>
                                  <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                                  </svg>
                                  <input type="file" name="profile_photo" id="profile_photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                              </div>
                                {{-- button --}}
                              <div class="inline-flex space-x-4 pb-10">
                                  <button type="button" id="profileCancelBtn" class="rounded-md bg-primary-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Cancel</button>
                                  <button type="submit" class="rounded-md bg-primary-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Save</button>
                              </div>
                           </div>
                   </form>
              </div>
             </div>
          </div>
      </div>
  </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("editProfileForm");
        const editProfileBtn = document.getElementById("editProfileBtn");
        const profileCancelBtn = document.getElementById("profileCancelBtn");

        editProfileBtn.addEventListener("click", function () {
            modal.classList.toggle("hidden");
            if (!modal.classList.contains("hidden")) {
            modal.classList.add("flex");
        } else {
            modal.classList.remove("flex");
        }
        });

        profileCancelBtn.addEventListener("click", function () {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        });

        // Close the modal when the user clicks anywhere outside of the modal
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });
    });
</script>
</x-layout>
{{-- done --}}