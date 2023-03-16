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
    <h1 class="my-5 border-bottom">Modification mots de passe Admin</h1>

    <form method="post">
        <div>
            <legend for="mdpactuel">Ancien mots de passe</legend>
            <input type="password" class="form-control" name="mdpactuel">
        </div>
        <div>
            <legend for="Nouveaumdp">Nouveau mots de passe</legend>
            <input type="password" class="form-control" name="Nouveaumdp">
        </div>

        <div>
         <label for="Nouveaumdp_confirmation">Confirmez le nouveau mot de passe</label>
    <input type="password" class="form-control" id="Nouveaumdp_confirmation" name="Nouveaumdp_confirmation">
        </div>

        <input type="submit" class="btn btn-outline-dark" value="Envoyer">
        @csrf
    </form>
@endsection