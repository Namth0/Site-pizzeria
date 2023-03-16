<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use DB;

class PizzaController extends Controller
{
    
    public function index(){
        $p = Pizza::all();
        return view('home') -> with('pizza',$p);
        }

         // Affiche la vue pour ajouter une pizza
    public function addPizzaForm() {
        return view('admin.addPizza');
    }

    // Ajoute une personne à la base de données
    public function addPizza(Request $request) {

        $validated = $request->validate([
            'nom'=>'required|alpha|max:50',
            'description'=>'required|alpha|max:50',
            'prix'=>'bail|required|integer|gte:0|lte:120'
        ]);

        $p = new Pizza();
        $p->nom = $validated['nom'];
        $p->description = $validated['description'];
        $p->prix = $validated['prix'];
        $p->save();

        $request->session()->flash('etat', 'Pizza ajoutée !');
        return redirect()->route('home');
    }

    // Affiche la vue pour voir la liste des pizzas
    public function ListePizzaForm(){
        $p = Pizza::all();
        return view ('admin.adminListePizza') -> with('pizza',$p);
    }

    // modifie le descriptif ou le nom d'une pizza a la base de données
    public function updatePizza(Request $request, $id)
{
    $validated = $request->validate([
        'nom'=>'required|alpha|max:50',
        'description'=>'required|alpha|max:50',
    ]);

    $pizza = Pizza::find($id);
    
    if ($pizza === null) {
        $request->session()->flash('error', 'Impossible de modifier l\'élément ciblé');
        return redirect()->route('home');
    }
    
    $pizza->nom = $validated["nom"];
    $pizza->description = $validated["description"];
    $pizza->save();

    $request->session()->flash('etat', 'Element modifié');
    return redirect()->route('index');
}


//affiche la vue pour modifier une personne
public function PizzaModifyForm(Request $request, $id) {
    $pizza = Pizza::find($id);

    if ($pizza === null) {
        $request->session()->flash('error', 'Impossible de trouver l\'élément ciblé');
        return redirect()->route('index');
    }

    return view('admin/adminModify', ["pizza"=>$pizza]);
}

//function de pagination
public function PizzaListSimplePaginate()
{
    $pizza = Pizza::orderBy('nom')->simplePaginate(5);
    // return view('account.userCommande', compact('pizza'));
    return view('account.userCommande', ["pizza"=>$pizza]);
}

// Supprime une pizza de la base de données en utilisant le mecanisme de Softdeletes
public function deletePizza(Request $request, $id) {

    $pizza = Pizza::find($id);

    if ($pizza === null) {
        $request->session()->flash('error', 'Oops, Une erreur est survenue.');
        error_log("Erreur");
        return redirect()->route('home');
    }
    
    $pizza->delete();
    $request->session()->flash('etat', 'Pizza supprimé.');
    return redirect()->route('liste');
}


// Affiche la vue de suppression d'une personne

public function suppForm($id){
    $p = Pizza::find($id);
    return view('admin.deletePizza') -> with('pizza',$p);
}

    
}
