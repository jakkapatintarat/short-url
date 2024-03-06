<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p class="mb-4 text-center font-semibold text-xl text-gray-800 leading-tight underline">All shorten link</p>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mt-6 bg-white rounded-lg divide-y">
                            @foreach ($data as $item)
                                <div class="p-6 flex space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                    </svg>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <small
                                                    class="ml-2 text-sm text-gray-600">{{ $item->created_at->format('j M Y, g:i a') }}</small>
                                            </div>
                                            <div>
                                                Create by:
                                                <small class="ml-2 text-sm text-gray-600">
                                                    {{ $item->user->email}}
                                                </small>
                                            </div>
                                        </div>
                                        <p class="mt-4 text-lg text-gray-900">Original Url: </p>
                                        <span>
                                            {{ $item->original_url }}
                                        </span>
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
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
