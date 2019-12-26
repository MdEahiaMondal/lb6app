@component('mail::message')
# Welcome to our Website..

Thakns for registration with us <br>
If you are interested our latest 5 Posts <br>
Please view all post  Here...
@foreach($posts as $post)
## <a href="{{ route('posts.index') }}">{{ $post->title }}</a>
@endforeach

@component('mail::button', ['url' => route('posts.index')])
View All
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
