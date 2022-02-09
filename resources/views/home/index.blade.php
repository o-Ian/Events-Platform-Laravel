@extends('layouts.site')

@section('title', 'Debian - Produtos')

@section('content')

<h1>Index</h1>
@foreach ($events as $event)
    <p>{{ $event->title }} -- {{ $event->description }}</p>
@endforeach
@endsection