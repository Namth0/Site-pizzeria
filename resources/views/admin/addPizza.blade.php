@extends('template/base')

@section('content')

    <style>
        form
        {
            width: 500px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-inline: auto;
            margin-block: 4rem;
        }

        form > div
        {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        form > div > legend
        {
            width: 5rem;
            margin-right: 1rem;
        }
        
    </style>

    <h1 class="my-5 border-bottom">Ajouter une pizza</h1>
<form method="post">
      <label for="nom">Nom</label>
        <input type="text" placeholder="Nom" name="nom" id="nom" required autofocus>
        
        <label for="description">Description</label>
        <input type="text" placeholder="Description" name="description" id="description" required>
        
        <label for="age">Prix</label>
        <input type="number" placeholder="Prix" min="0" max="130" name="prix" id="prix" required>
        <input type="submit" class="btn btn-outline-dark" value="Envoyer">
        @csrf 
</form>
@endsection