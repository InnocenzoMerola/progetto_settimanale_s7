@extends('template.base')

@section('title', 'I&M - Homepage')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1 class="text-center">Area di creazione</h1>
<div class="row justify-content-center">
  <div class="col-5">
    <form method="POST" action="{{route('courses.store')}}">
        @csrf
        <div class="row row-gap-2">
            <div class="col-12">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control"  required><br>
            </div>

            <div class="col-12">
                <label for="description">Descrizione</label>
                <input type="text" name="description" id="description" class="form-control" required><br>
            </div>
            
            <div class="col-12">
                <label for="day">Giorno</label>
                <select class="form-select" name="day" id="day" aria-label="Default select example">
                <option value="" disabled selected>Seleziona un giorno</option>
                <option value="Lunedì">Lunedì</option>
                <option value="Martedì">Martedì</option>
                <option value="Mercoledì">Mercoledì</option>
                <option value="Giovedì">Giovedì</option>
                <option value="Venerdì">Venerdì</option>
                <option value="6Sabato">Sabato</option>
                <option value="Domenica">Domenica</option>
              </select>
            </div>

            <div class="col-12">
                <label for="start">Start</label>
                <input type="time" name="start" id="start" class="form-control" required><br>
            </div>
            <div class="col-12">
                <label for="end">End</label>
                <input type="time" name="end" id="end" class="form-control" required><br>
            </div>

            <div class="col-12">
                <label for="location">Sala</label>
                <input type="text" name="location" id="location" class="form-control"><br>
            </div>

            <div class="col-12 mt-3">
                <input type="submit" value="Aggiungi progetto" class="btn btn-primary">
            </div>
        </div>

    </form>
  </div>
</div>

@endsection