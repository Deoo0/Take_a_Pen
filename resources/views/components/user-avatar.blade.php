@props(['user','size' => 'w-12 h-12'])

{{-- User Avatar Component --}}
{{-- Usage: <x-user-avatar :user="$user" /> --}}

@if ($user->image)
    <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="{{ $size }} rounded-full">
@else
    <img src="https://imgs.search.brave.com/OllZffbUyLNuYblHbIwO4LsXS82tkRuMkMP7jKMihmI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdG9y/YWdlLm5lZWRwaXgu/Y29tL3JzeW5jZWRf/aW1hZ2VzL2hlYWQt/NjU5NjUxXzEyODAu/cG5n"
        alt="avatar" class="{{ $size }} rounded-full">
@endif
