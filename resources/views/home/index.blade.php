@extends('layouts.site')

@section('title', 'Debian - Produtos')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="">
    <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">    
    </form>

</div>
<div id="events-container" class="col-md-12">
    <h2>Próximos eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    <div id="cards-container" class="row">
        @foreach ($events as $event)
            <div class="card col-md-3">
                <img src="{{ asset('img/events/'.$event->image) }}" alt="{{ $event->title }}">
                <p class="card-date">{{  date('d/m/Y', strtotime($event->date ))}}</p>
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-participants">X participantes</p>
                <a href="{{ route('site.show', ['event' => $event]) }}" class="btn btn-primary">Saber mais</a>
            </div>
        @endforeach
    </div>
    @if(count($events)==0)
        <p>Não há eventos cadastrados</p>
    @endif
</div>

@endsection