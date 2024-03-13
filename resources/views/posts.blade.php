<x-layout>


@section('content')
@foreach ($posts as $post)
<article class="{{ $loop ->even ? 'foobar' : '' }}">
    <h1>
        
       <a href="posts/{{  $post->slug;  }}">
        {{  $post->Title}}
       </a>
    </h1>
    <div>
        {!! $post->body !!}
    </div>
</article>
@endforeach


</x-layout>