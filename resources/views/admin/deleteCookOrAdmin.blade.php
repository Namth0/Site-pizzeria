@extends('template/base')

@section('content')


<form method="post" action="">
    @csrf
    <p>Êtes-vous sûr de vouloir supprimer cette donnée ? </p>
    <div>        
        <button type="submit">Confirmer</button>
    </div>
</form>
@endsection