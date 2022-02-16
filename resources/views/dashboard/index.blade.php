@extends('layouts/site')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($user->events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

    <tbody>
        @foreach ($user->events as $event)
        <tr>
            <td scope="row">{{ $loop->index+1 }}</td>
            <td><a href="{{ route('site.show', ['event' => $event]) }}">{{ $event->title }}</a></td>
            <td>{{ count($event->users) }}</td>
            <td><a href="{{ route('site.update', ['event' => $event]) }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a> 
                
                <form action="{{ route('site.delete', ['event' => $event]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    @else
    <p>Você ainda não tem eventos, <a href="{{ route('site.create') }}">criar evento</a></p>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou participando</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
@if (count($eventsAsParticipant)==0)
<p>Você ainda não está participando de nenhum evento <a href="{{ route('site.home') }}">Veja todos os eventos</a></p>
@else
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Participantes</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>

<tbody>
    @foreach ($eventsAsParticipant as $event)
    <tr>
        <td scope="row">{{ $loop->index+1 }}</td>
        <td><a href="{{ route('site.show', ['event' => $event]) }}">{{ $event->title }}</a></td>
        <td>{{ count($event->users) }}</td>
        <td>
            <form action="{{ route('site.leave.event', ['event' => $event]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Sair do evento</button>
            </form>
            
        </td>
    </tr>
    @endforeach
</tbody>
</table>
@endif


</div>

@endsection