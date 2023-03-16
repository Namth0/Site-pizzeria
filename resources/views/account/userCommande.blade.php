@extends('template.base')

@section('content')

<style>
table {
  border-collapse: collapse;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #f5f5f5;
}

form {
  display: inline-block;
  margin: 0;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="number"] {
  width: 50px;
  margin-right: 5px;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 8px 12px;
  text-align: center;
  display: inline-block;
  margin: 0;
  cursor: pointer;
  border-radius: 4px;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

.pagination {
  display: flex;
  justify-content: center;
  margin: 20px 0;
}

.pagination li {
  list-style: none;
  margin: 0 5px;
}

.pagination li a, .pagination li span {
  color: #333;
  background-color: #fff;
  border: 1px solid #ddd;
  padding: 5px 10px;
  display: inline-block;
}

.pagination li.active span {
  background-color: #4CAF50;
  color: #fff;
  border-color: #4CAF50;
}

.pagination li a:hover {
  background-color: #f2f2f2;
}
</style>

  <table>
    <thead>
      <tr>
        <th>ID</th>
          <th>Nom</th>
          <th>Description</th>
          <th>Quantité</th>
          <th>Commander</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pizza as $pizzas)
        <tr>
          <td>{{ $pizzas->id }}</td>
          <td>{{ $pizzas->nom }}</td>
          <td>{{ $pizzas->description }}</td>
          <td>{{ $pizzas->prix }} €</td>
          <td>
            <form method="post" action="{{ route('ajoutPanier', ['pizza_id' => $pizzas->id]) }}">
              @csrf
              <input type="hidden" name="pizza_id" value="{{ $pizzas->id }}">
              <label for="qte">Quantité</label>
              <input type="number" name="qte" id="qte" value="1">
              <button type="submit">Ajouter au panier</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $pizza->links() }}
@endsection





