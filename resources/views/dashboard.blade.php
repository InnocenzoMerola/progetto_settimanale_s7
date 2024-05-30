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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Ciao {{Auth::user()->name}}</h3>
                    <p>Benvenuto nella nostra Dashboard, qui potrai gestire le risorse e migliorare la tua esperienza e il tuo account</p>
                </div>
            </div>
            <div class="alert alert-info mt-4" role="alert">
               Il sito al momento è in fase di sviluppo, potrai usufruire della Dashboard una volta terminate le ultime ottimizzazioni.
               <p>Grazie per la disponibilità</p>
               <p>Il Team I&M</p>
            </div>
            <div class="text-center">
                <a href="{{route('home')}}" class="btn btn-lg btn-info">Torna alla homepage</a>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection