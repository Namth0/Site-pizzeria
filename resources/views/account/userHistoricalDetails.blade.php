@extends('template/base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Détails de la commande') }}</div>

                <div class="card-body">
                    <h3>{{ __('Commande n°') }}{{ $commande->id }}</h3>
                    <p>{{ __('Passée le') }} {{ $commande->created_at->format('d/m/Y à H:i:s') }}</p>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Pizza') }}</th>
                                <th>{{ __('Quantité') }}</th>
                                <th>{{ __('Prix unitaire') }}</th>
                                <th>{{ __('Prix total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($content as $pizza)
                            <tr>
                                <td>{{ $pizza['nom'] }}</td>
                                <td>{{ $pizza['qte'] }}</td>
                                <td>{{ $pizza['prix'] / $pizza['qte'] }} €</td>
                                <td>{{ $pizza['prix'] }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">{{ __('Total') }}</th>
                                <th>{{ $total }} €</th>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __('Quantité totale') }}</th>
                                <th>{{ $total_amount }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
