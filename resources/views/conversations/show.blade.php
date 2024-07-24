<x-layout>
  <x-slot:title>Chat</x-slot:title>
<div class="px-6">
  <div class="container py-8 px-10 mb-5 mt-5 bg-primary-50 border border-gray-200 rounded-lg max-w-lg mx-auto">
   <a href="{{route ('detail' , $conversation->product->id)}}">
    <div class="flex justify-center items-center">
      <img src="{{ asset('storage/' . $conversation->product->post_photo) }}" alt="Product Photo" class="w-48 h-48 object-cover">
    </div>
    <h1 class="text-xl font-semibold tracking-tight leading-tight py-4 mx-auto max-w-lg">Conversation about - {{ $conversation->product->nama }}</h1>
   </a>
    <div class=" bg-white border border-gray-300 rounded-lg p-4 max-w-lg mx-auto mb-4">
         <div class="message-container">
           @foreach($conversation->messages as $message)
             <div class="message {{ $message->user_id == Auth::id() ? 'user-message' : 'other-message' }}">
               <strong>{{ $message->user->name }}:</strong>
               <p class="mb-2">{{ $message->message }}</p>
            </div>
           @endforeach
         </div>
    </div>
      <form action="{{ route('messages.store', $conversation->id) }}" method="POST">
        @csrf
            <textarea name="message" class=" bg-gray-50 border border-gray-400 rounded-lg mb-2 w-full" required></textarea>
        <button type="submit" class="bg-primary-700 rounded-lg px-4 py-2 text-white">Send</button>
      </form>
  </div>
</div>
</x-layout>
{{-- done --}}