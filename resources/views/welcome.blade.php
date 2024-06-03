@extends('template.base')
@section('title', 'Home')

@section('content')

<h1 class="text-center mb-5">I&M</h1>
@auth
  <h2 class="text-center">Ciao <span class="fw-bold">{{Auth::user()->name}}</span> e bentornato sul nostro sito </h2>
@endauth
@guest
  <h2 class="text-center">Benvenuto sul nostro sito</h2>
  <h3 class="text-center">Per accedere come admin: enzo@enzo.com, Enzomerola</h3>
@endguest

<h2 class="text-center mt-3">Le nostre sedi</h2>
<div id="carouselExample" class="carousel slide mt-2">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://citynews-forlitoday.stgy.ovh/~media/horizontal-mid/22956047186411/palestra-aperta-h24-2.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://smartworkout.it/wp-content/uploads/2023/10/palestra.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://www.livornotoday.it/~media/horizontal-hi/39927882606343/senza-titolo-298.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="row my-5 div-img-home">
  <h2 class="mb-5">Cosa offriamo</h2>
    <div class="col-4">
        <div class="card">
            <img src="https://citynews-forlitoday.stgy.ovh/~media/horizontal-mid/22956047186411/palestra-aperta-h24-2.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Sala</h5>
              <p class="card-text">Una sala completa ricca di attrezzi e benefit di ogni genere</p>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfKuPqFag-d2JaueK2kPEbWPytkasHCnqo-A&s" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Calisthenics</h5>
              <p class="card-text">Allenati anche all'aperto con l'esercizio a corpo libero</p>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBtQgtJ4CQgPIyHLcHb9L-UdCFg4eA2NC8aw&s" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Bodybuilding</h5>
              <p class="card-text">Diventa un colosso, segui le nostre schede e la nostra alimentazione</p>
            </div>
        </div>
    </div>
</div>

@endsection