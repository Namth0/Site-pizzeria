<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Commande;
use App\Models\Commande_pizza;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class cookController extends Controller
{
    public function index()
    {
        // Récupérer toutes les commandes non traitées (état = 'envoyé') triées par date de création
        $commandes = Commande::where('statut', 'envoye')->orderBy('created_at')->get();
        
        return view('cook.gestionCommande', ['commandes' => $commandes]);
    }
  
public function statutForm(Request $request, $id) {
    // Affiche le formulaire de changement de status
    $user = Auth::user();
    if ($user->type == "user") {
        return redirect("/");
    }
    $target = Commande::find($id);
    if ($target == null) {
        $request->session()->flash("error", "Impossible de cibler la commande");
        return redirect("/gestion");
    }
    return view("cook.modifyStatut", ["commande" => $target]);
}

// fonction qui permet de modifier le statut d'une commande
public function modifyStatut(Request $request, $id) {
    // Change le statut de la commande
    $user = Auth::user();
    if ($user->type == "user") {
        return redirect("/");
    }
    $target = Commande::find($id);
    if ($target == null) {
        $request->session()->flash("error", 'Impossible de cibler la commande ');
        return redirect("/gestion");
    }
    $request->validate([
        'statut' => 'required|in:traitement,pret,recupere'
    ]);
    $target->statut = $request->statut;
    $target->save();
    $request->session()->flash("etat", "Modification effectuée.");
    return redirect("/home");
}

    public function showdetails($id)
    {
        $user_id = Auth::id();
        $commande = DB::table("commandes")->find($id);
        $commande_pizza = DB::table("commande_pizza")->where("commande_id", $commande->id)->get();
        
        $prix_total = 0;
        $commandes_pizza = array();
        foreach($commande_pizza as $c)
        {
            $p = DB::table("pizzas")->find($c->pizza_id);
            $prix_total += $p->prix * $c->qte;
            array_push(
                $commandes_pizza,
                array( "pizza_nom" => $p->nom, "pizza_prix" => $p->prix , "qte" => $c->qte )
            );
        }

        return view('cook.detailsCommande', [
            'commande' => $commande,
            'commande_pizza' => $commandes_pizza,
            'prix_total' => $prix_total,
        ]); 
    }

    public function PasswordCookForm(){
        return view('cook.cookModifyPassword');
    }

    public function UpdatePasswordCook(Request $request){

        $cook = Auth::user();
        $currentPassword = $request->input('mdpactuel');
        $newPassword = $request->input('Nouveaumdp');

    if (Hash::check($currentPassword, $cook->mdp)) {
        $this->validate($request, [
            'Nouveaumdp' => 'required|string|confirmed|min:4',
        ]);

        $cook->mdp = Hash::make($newPassword);
        $cook->save();

        session()->flash('etat', 'Votre mot de passe a été modifié avec succès !');
        return redirect()->route('home');
    } else {
        session()->flash('error', 'Le mot de passe actuel est incorrect.');
        return redirect()->route('accountCook');
    }
}
        
    }


?>