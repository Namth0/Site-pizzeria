@extends('template/base')

@section('title')
Accueil
@endsection

@section('content')
    
    <h1 class="my-5 border-bottom">Bienvenue sur Pizzaravel !</h1>

    <p class="my-5">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>


    <div id="carouselExampleSlidesOnly" class="carousel slide my-5" data-bs-ride="carousel" style="margin-inline:auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="{{ asset('img/pizza.png' ) }}" alt="pizza" class="d-block w-100 mx-auto">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('img/pizza2.png' ) }}" alt="pizza" class="d-block w-100  mx-auto">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('img/pizza3.png' ) }}" alt="pizza" class="d-block w-100  mx-auto">
            </div>
        </div>
    </div>

@endsection
