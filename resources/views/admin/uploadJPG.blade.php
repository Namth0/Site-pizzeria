@extends('template/base')

@section('content')
<form action="/uploads/{{ $u->id }}" method="post" enctype="multipart/form-data">
<input type="file" name="fichier">
<input type="submit" value="Téléverser">
@csrf
</form>
@endsection