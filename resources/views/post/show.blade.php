<x-app-layout>


    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <h1 class="text-4xl mb-4">{{ $post->title }}</h1>
                {{-- User Avatar --}}
                <x-follow-ctr :user="$post->user" class="flex gap-4">
                    <x-user-avatar :user="$post->user" />
                    <div>
                        <div class="flex gap-2">
                            <a href="{{ route('profile.show', $post->user) }}" class="hover:underline">
                                {{ $post->user->name }}
                            </a>
                            &middot;
                            <button x-text="following ? 'Unfollow' : 'Follow'"
                                :class="following ? 'text-red-600 hover:text-red-700' :
                                    'text-emerald-600 hover:text-emerald-700'"
                                    @click="follow()">
                            </button>
                        </div>
                        <div class="flex gap-2 text-gray-600">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}

                        </div>
                    </div>
                </x-follow-ctr>
                {{-- Clap Section --}}
                <x-clap-button :post="$post"></x-clap-button>
                {{-- Content --}}
                <div class="mt-8">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full">

                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </div>

                <div class="mt-8 ">
                    <span class="px-4 py-2 bg-gray-200 rounded-2xl">
                        {{ $post->category->name }}
                    </span>
                </div>
                <x-clap-button :post="$post"></x-clap-button>
            </div>
        </div>
    </div>
</x-app-layout>
