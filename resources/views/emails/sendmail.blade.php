@if (!empty($post))
    <x-mail::message>
        # {{ $post->title }}

        {{ $post->content_title }}

        <x-mail::button :url="route('blog.show', ['id' => $post->id])">
            Show post
        </x-mail::button>

        Thanks,<br>
        {{ config('app.name') }}
    </x-mail::message>
@else
    <x-mail::message>
        #Post not found

        <x-mail::button :url="route('home')">
            Show posts
        </x-mail::button>

        Thanks,<br>
        {{ config('app.name') }}
    </x-mail::message>
@endif
