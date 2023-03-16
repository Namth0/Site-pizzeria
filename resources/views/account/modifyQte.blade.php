@extends('template/base')

@section('content')


<style>
    h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    thead tr {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: center;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    form {
        display: inline-block;
        margin-right: 0.5rem;
    }

    input[type="number"] {
        width: 4rem;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    button[type="submit"]:hover {
        background-color: #3e8e41;
    }

    tfoot td {
        text-align: right;
        font-weight: bold;
    }

    tfoot button[type="submit"] {
        margin-top: 1rem;
    }

</style>



<h1>Votre panier</h1>
@if(empty($panier))
<p>Aucun produit</p>
@else
<table>
    <thead>
        <tr style="text-align: center;">
            <td>ID PIZZA</td>
            <td>Quantité</td>
        </tr>
    </thead>
    @foreach($panier as $pizza)
    <tr>
        <td>{{ $pizza['id'] }}</td>
        <td>{{ $pizza['nom'] }}</td>
        <td>
            <form method="post" action="{{route('modifier')}}">
                @csrf
                <input type="hidden" id="id_pizza" name="id_pizza" value="{{ $pizza['id'] }}">
                <label for="qte">Quantité</label>
                <input type="number" id="qte" name="qte" value="{{ $pizza['qte'] }}">
                <button type="submit">Modifier</button>
            </form>
             <form method="post" action="{{route('supprimer', ['id_pizza' => $pizza['id']])}}">
                @csrf
                <button type="submit">Supprimer</button>
            </form>
           
        </td>
    </tr>
    @endforeach

<form method="post" action="{{route('commande')}}">
    @csrf
    <tr>
        <td><button type="submit">Commander</button></td>
    </tr>
</form>

<tfoot>
    <form >
        <tr colspan="2" style="text-align: center;">
            <td>Total :{{$total}} </td>
        </tr>
        </form>
</tfoot>

</table>
@endif
     
@endsection