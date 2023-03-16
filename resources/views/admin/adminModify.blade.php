@extends('template/base')

@section('content')

    <form method="post" action="">

        @csrf
        <h1>Modifier un élément</h1>

        <label for="nom">Nom</label>
        <input type="text" placeholder="Nom" name="nom" id="nom" value="{{$pizza->nom}}"  autofocus>
        
        <label for="description">Description</label>
        <input type="text" placeholder="Description" name="description" id="description" value="{{$pizza->description}}" >
        
        <button type="submit">Envoyer</button>

    </form>

@endsection