@extends('template.baseDash')
@section('dash_content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (!auth()->user()->isAdmin())    
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Ciao {{Auth::user()->name}}</h3>
                    <p>Benvenuto nella nostra Dashboard, qui potrai gestire le risorse e migliorare la tua esperienza e il tuo account</p>
                </div>
            </div>
            <div class="alert alert-info mt-4" role="alert">
               Il sito al momento è in fase di sviluppo, potrai usufruire della Dashboard una volta terminate le ultime ottimizzazioni.
               <p>Non spaventarti per la scarsità dello stile</p>
               <p>Il Team I&M</p>
            </div>
            @endif
            @if (auth()->user()->isAdmin())    
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Ciao {{Auth::user()->name}}</h3>
                    <p>Benvenuto nella nostra Dashboard, qui potrai gestire le risorse e migliorare la tua esperienza e il tuo account</p>
                </div>
            </div>
            <div class="alert alert-info mt-4" role="alert">
               Come ben saprai, visto che sei tu a programmarlo, il sito è ancora in fase di sviluppo.
               <p>Il Team I&M</p>
            </div>
            @endif
            <div class="text-center">
                <a href="{{route('home')}}" class="btn btn-lg btn-info">Torna alla homepage</a>
            </div>
    
            @if (!auth()->user()->isAdmin())
            <div class="mt-5">
                <h1 class="text-center fs-1">I tuoi corsi</h1>
            </div>
    @if ($courses->count())
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Luogo</th>
                <th scope="col">Giorno</th>
                <th scope="col">Inizio</th>
                <th scope="col">Fine</th>
                <th scope="col">Stato</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach ( $courses as $course )
                @foreach ( $course->users as  $user)  
                <tr>
                    <th scope="row">{{$course->id}}</th>
                    <td>{{$course->activity->name}}</td>
                    <td>{{$course->activity->description}}</td>
                    <td>{{$course->location}}</td>
                    <td>{{$course->slot->day}}</td>
                    <td>{{$course->slot->start}}</td>
                    <td>{{$course->slot->end}}</td>
                    
                                @if($user->pivot->status === 'pending')
                                    <td>
                                        <p>In fase di accettazione</p>
                                    </td>
                                @elseif($user->pivot->status === 'accepted')
                                    <td>
                                        <p>Accettato</p>
                                    </td>
                                @elseif($user->pivot->status === 'rejected')
                                    <td>
                                        <p>Rifiutato</p>
                                    </td>
                                @endif
                </tr>
                @endforeach

            @endforeach
        </tbody>
    </table>
    {{$courses->links()}}
    @else
    <h2 class="text-center">Non hai preso parte a nessun corso</h2>
    @endif
    @endif

@if (auth()->user()->isAdmin())
<div class="mt-5">
    <h1 class="text-center fs-1">Corsi prenotati</h1>
</div>

        @if ($courses->count())
            <table  class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Utente</th>
                        <th scope="col">Corso</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Giorno</th>
                        <th scope="col">Inizio</th>
                        <th scope="col">Fine</th>
                        <th scope="col">Stato</th>
                       
                    </tr>
                </thead>
                <tbody>
                    {{-- TODO: Sistemare per mostrare tutti e non solo quelli in fase di pending --}}
                    @foreach ( $courses as $course )
                        @foreach ( $course->users as  $user)  
                        <tr>
                            <th scope="row">{{$course->id}}</th>
                            <td>{{$user->name}}</td>
                            <td><a href="{{route('courses.show', ['id' => $course->id])}}">{{$course->activity->name}}</a></td>
                            <td>{{$course->activity->description}}</td>
                            <td>{{$course->slot->day}}</td>
                            <td>{{$course->slot->start}}</td>
                            <td>{{$course->slot->end}}</td>
                                    {{-- @foreach ( $course->users as  $user)   --}}
                                        @if($user->pivot->status === 'pending')
                                            <td class="d-flex gap-1">
                                                <form action="{{route('courses.accepted', ['id'=> $course->id, 'user_id' => $user->id])}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary">Accetta</button>
                                                </form>
                                                <form action="{{route('courses.rejected', ['id'=> $course->id, 'user_id' => $user->id])}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary">Rifiuta</button>
                                                </form>
                                            </td>
                                        @elseif($user->pivot->status === 'accepted')
                                            <td>
                                                <p>Accettato</p>
                                            </td>
                                        @elseif($user->pivot->status === 'rejected')
                                            <td>
                                                <p>Rifiutato</p>
                                            </td>
                                        @else
                                            <td>
                                                <p>Nessuna prenotazione</p>
                                            </td>
                                        @endif
                                        {{-- @endforeach --}}
                        </tr>
                        @endforeach

                    @endforeach
                </tbody>
            </table>
            {{$courses->links()}}
        @else
            <h2 class="text-center">Nessun corso Prenotato</h2>
        @endif
@endif
</div>
</div>

</x-app-layout>
@endsection