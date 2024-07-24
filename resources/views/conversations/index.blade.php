<x-layout>
  <x-slot:title>Inbox</x-slot:title>
<div class="container py-8 px-10">
  <div class="bg-primary-50 border border-gray-300 rounded-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-xl lg:text-2xl font-bold tracking-tight py-5">Your Conversations</h1>
    <hr class="border" />
    <ul>
      @foreach($conversations as $conversation)
      <li class="py-4">
          <a href="{{ route('conversations.show', $conversation->id) }}" class="text-md font-medium hover:underline">
            <img src="{{ asset('storage/' . $conversation->product->post_photo) }}" alt="Product Photo" class="w-20 h-20 object-cover rounded-full lg:inline-flex md:inline-flex">
              {{ $conversation->product->nama }} - Chat with {{ $conversation->seller_id == Auth::id() ? $conversation->buyer->name : $conversation->seller->name }}
          </a>
          @if ($conversation->unreadMessagesCount() > 0)
          <span class="relative text-sm text-white bg-red-600 p-1 rounded-full">
            {{ $conversation->unreadMessagesCount() }}
          </span>
          @endif
      </li>
      @endforeach
    </ul>
  </div>
</div>
</x-layout>
{{-- done --}}