<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Commande;
use App\Models\Commande_pizza;
use Illuminate\Support\Facades\Auth;

use DB;

class CommandeController extends Controller
{

  // Cette fonction retourne une commande "panier":
  // - Si l'utilisateur possède un panier alors la fonction charge le panier en mémoire
  // - Sinon elle créée un nouveau panier
  


public function ajouterAuPanier(Request $request, $id_pizza)
{
  
    $validated = $request->validate([
        "qte" => "required|min:0"
    ]);

    $pizza = Pizza::find($id_pizza);
  

    $panier = session()->get('panier');
    
        $pizza_details = [
            'id' => $id_pizza,
            'nom' => $pizza->nom,
            'prix' => $pizza->prix,
            'qte' => $request->qte
        ];
    

    $panier[$id_pizza] = $pizza_details;
    session()->put('panier', $panier);

    $request->session()->flash('etat', 'pizza ajouté au panier');
    return back();
}


public function show()
{
  $pizza = Pizza::orderBy('nom')->simplePaginate(5);
  return view('account.userCommande', ["pizza"=>$pizza]);
}


public function panierForm()
{

  $panier = session()->get('panier');
  $total = session()->get('total');
  return view('account.modifyQte',["panier" => $panier, "total" => $total]);
}





public function updateQuantite(Request $request)
{

    $validated = $request->validate([
        "qte" => "required|int|min:0",
        "id_pizza" => "required|min:0"
    ]);

    $panier = session()->get('panier');
    //dd($request->id_pizza);
    $panier[$request->id_pizza]['qte'] = $request->qte;
    session()->put('panier', $panier);
    $total = $this-> totalQuantite();
    session()->put('total',$total);
    $request->session()->flash('etat', 'quantite pizza a jour');
    return back();
}

//fonction qui mets a jour la le nombre total de pizza
public function totalQuantite(){
  $panier = session()->get('panier');
  $total =0;
  foreach($panier as $pizza){
    $total +=  $pizza['qte']*$pizza['prix'];
  }
 
  return $total;
}

//fonction qui permet de supprimer des pizzas du panier
public function supprimerDuPanier(Request $request) {
  $validated = $request->validate([
      "id_pizza" => "required|min:0"
  ]);

  $panier = session()->get('panier');
  unset($panier[$request->id_pizza]);
  session()->put('panier', $panier);
  $total = $this->totalQuantite();
  session()->put('total', $total);

  $request->session()->flash('etat', 'pizza supprimer du panier');
  return back();
}
//fonction pour passé une commande
public function Commander(Request $request){
  $panier = session()->get('panier');
  // dd($panier);
  if(empty($panier)){
   $request->session()->flash('error', 'commande inexistante');
   return back();
  }

  $c = new Commande();
  $c->user_id = $request->user()->id;
  $c ->statut = 'envoye';
  $c ->save();

  foreach($panier as $p){
    $pizza = Pizza::find($p['id']);
    $c -> pizzas()->attach($pizza,['qte' => $p['qte']]);
  }

  session()->forget('panier');
  session()->forget('total');
  // dd($panier);
  $request->session()->flash('etat', 'Vous avez passé commande de votre panier !');
  return back();

}




    
}
