<x-app-layout>


    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <h1 class="text-4xl mb-4">{{ $post->title }}</h1>
                {{-- User Avatar --}}
                <div class="flex gap-4">
                    @if ($post->user->image)
                        <img src="{{ $post->user->imageUrl() }}" alt="{{ $post->user->name }}"
                            class="w-12 h-12 rounded-full">
                    @else
                        <img src="https://imgs.search.brave.com/OllZffbUyLNuYblHbIwO4LsXS82tkRuMkMP7jKMihmI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdG9y/YWdlLm5lZWRwaXgu/Y29tL3JzeW5jZWRf/aW1hZ2VzL2hlYWQt/NjU5NjUxXzEyODAu/cG5n"
                            alt="avatar" class="w-12 h-12 rounded-full">
                    @endif
                    <div>
                        <div class="flex gap-2">
                            <h3>{{ $post->user->name }}</h3>
                            &middot;
                            <a href="" class="text-emerald-500">Follow</a>
                        </div>
                        <div class="flex gap-2 text-gray-600">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}

                        </div>
                    </div>
                </div>
                {{-- Clap Section --}}
                <x-clap-button></x-clap-button>
                {{-- Content --}}
                <div class="mt-8">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full">

                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </div>

                <div class="mt-8 ">
                    <span class="px-4 py-2 bg-gray-200 rounded-2xl">
                        {{$post->category->name}}
                    </span>
                </div>
                <x-clap-button></x-clap-button>
            </div>
        </div>
    </div>
</x-app-layout>
