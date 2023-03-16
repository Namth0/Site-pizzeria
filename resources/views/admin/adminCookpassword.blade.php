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
    <h1 class="my-5 border-bottom">Modification mots de passe</h1>

    <form method="post" action ="/modifyCookpsd" >
        
        <div>
            <legend for="new_password">Nouveau mot de passe</legend>
            <input type="password" class="form-control" name="new_password">
        </div>

        <div>
            <legend for="new_password_confirmation">Confirmer le nouveau mot de passe</legend>
            <input type="password" class="form-control" name="new_password_confirmation">
        </div>

        <input type="hidden" name="cook_id" value="{{ $cook->id }}">

        <input type="submit" class="btn btn-outline-dark" value="Envoyer">
        @csrf
    </form>
@endsection
