@extends('template/base')

@section('content')
    
    <h1>Historique des commandes non traitée</h1>

    <table class ="table table-striped table-dark">
        <thead>
            <tr>
                <th>Date</th>
                <th>Statut</th>
                <th>ID Commande Utilisateur</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->created_at }}</td>
                <td>{{ $commande->statut }}</td>
                <td>{{ $commande->id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
