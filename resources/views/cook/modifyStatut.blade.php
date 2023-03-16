@extends('template/base')

@section('content')
    <form method="post" action="{{ route('statut', [ 'commande_id' => $commande->id]) }}">

        @csrf
        <h1>Modifier le statut</h1>

        <label for="statut">Statut</label>
        <input type="text" placeholder="Statut" name="statut" id="statut" value="{{ $commande->statut }}" autofocus>
        
        <button type="submit">Envoyer</button>

    </form>
@endsection

