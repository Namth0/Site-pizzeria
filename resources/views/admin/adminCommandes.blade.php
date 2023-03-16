@extends('template/base')

@section('content')
    <h1>Historique des commandes triées par date</h1>

    <div class="mb-3">
    <form action="{{ route('commandeOndate') }}" method="get">
    @csrf
        <label for="date">Date :</label>
        <input type="date" name="date" id="date" class="form-control">
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </form>
</div>


    <table class ="table table-striped table-dark">
        <thead>
            <tr>
                <th>Date</th>
                <th>Statut</th>
                <th>ID Commande Utilisateur</th>
                <th>Voir toute les commandes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->created_at }}</td>
                <td>{{ $commande->statut }}</td>
                <td>{{ $commande->id }}</td>
                {{-- <td><a href="/commandeOndate"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
            </svg></a></td> --}}
                <td><a href="/details/{{ $commande->id }}/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    

    {{ $commandes->links() }}
@endsection