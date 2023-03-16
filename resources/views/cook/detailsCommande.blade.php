@extends('template/base')

@section('content')
<h1>Détails de la commande #{{ $commande->id }}</h1>


<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prix unitaire</th>
      <th>Quantité</th>
      <th>Prix total</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($commande_pizza as $c)
    <tr>
      <td>{{ $c["pizza_nom"] }}</td>
      <td>{{ $c["pizza_prix"] }} €</td>
      <td>{{ $c["qte"] }}</td>
      <td>{{ $c["pizza_prix"] * $c["qte"] }} €</td>
   </tr>
    @endforeach
  </tbody>
</table>

<p>Prix total de la commande : {{ $prix_total }} €</p>
@endsection

