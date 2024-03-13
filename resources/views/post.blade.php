<x-layout>
@section('content')
<h1>{{ $post-> Title }} </h1> 
<div>
 {!! $post -> body !!}
</div>
 <a href="/">Go back</a>
</x-layout>