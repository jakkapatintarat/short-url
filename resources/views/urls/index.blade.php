<x-user-layout>
    @section('header')
        Short URL
    @endsection
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Form ส่งข้อมูลไปที่ urls.store --}}
        <form method="POST" action="{{ route('urls.store') }}">
            @csrf
            <input type="text" name="original_url" required maxlength="255" placeholder="Original Url"
                class="block w-full border-gray-300 mt-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{ old('original_url') }}" />
            <x-input-error :messages="$errors->store->get('original_url')" class="mt-2" />
            <x-primary-button class="mt-4">Save</x-primary-button>
        </form>

        <div class="mt-6 bg-white rounded-lg divide-y">
            @foreach ($urls as $item)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <small
                                    class="ml-2 text-sm text-gray-600">{{ $item->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                            @if ($item->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <form method="POST" action="{{ route('urls.destroy', $item) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('urls.destroy', $item)"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                Delete
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">Original Url: {{ $item->original_url }}
                        </p>
                        <p class="mt-4 text-lg text-gray-900">Short Url:</p>
                        <span class="text-sky-600">
                            <a href="{{ route('short-url', $item->shorten_url) }}" target="_blank">
                                {{ route('short-url', $item->shorten_url) }}
                            </a>
                        </span>
                        <p class="text-center">
                            <span class="text-sm text-gray-600">Engagements: {{ $item->engagements }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-user-layout>
