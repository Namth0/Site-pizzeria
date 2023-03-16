<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pizza;
use App\Models\Commande;
use App\Models\Commande_pizza;

use DB;


class UserController extends Controller
{
    //

    public function index(){
        $p = User::all();
        return view('home') -> with('user',$p);
        }

    public function PasswordForm(Request $request){
        return view('account.accountModifyPassword');
    }

    public function updatepassword(Request $request)
{
    $user = Auth::user();
    $currentPassword = $request->input('mdpactuel');
    $newPassword = $request->input('Nouveaumdp');

    if (Hash::check($currentPassword, $user->mdp)) {
        $this->validate($request, [
            'Nouveaumdp' => 'required|string|confirmed|min:4',
        ]);

        $user->mdp = Hash::make($newPassword);
        $user->save();

        session()->flash('etat', 'Votre mot de passe a été modifié avec succès !');
        return redirect()->route('home');
    } else {
        session()->flash('error', 'Le mot de passe actuel est incorrect.');
        return redirect()->route('account');
    }
}


public function CommandeUser(Request $request){
    $user_id = Auth::user()->id;
    $commandes = Commande::where("user_id", $user_id)->where('statut', 'recupere')->orderby("created_at")->paginate(5);
    return view("account.userHistorical", ["commandes" => $commandes]);
}


public function CommandeUserUntreated(Request $request){
    $user_id = Auth::user()->id;
    $commandes = Commande::where("user_id",$user_id)->where('statut', 'envoye')->orwhere('statut', 'traitement')->orwhere('statut', 'pret')->orderby("created_at")->paginate(5);
    return view("account.userCommandesUntreated",["commandes" => $commandes]);
}

public function CommandeUserDetails(Request $request, $id) {
    $user = Auth::user();
    $commande = Commande::find($id);
    if ($commande == null) {
        $request->session()->flash("error", "Impossible d'accéder à la commande");
        return redirect("/historical");
    }
    if ($user->id != $commande->user_id) {
        return redirect("/historical");
    }
    $total = 0;
    $total_amount = 0;
    $content = array();
    $commandes_pizza = DB::table("commande_pizza")->where("commande_id", $commande->id)->get();
    foreach($commandes_pizza as $c) {
        $pizza = Pizza::withTrashed()->where('id',$c->pizza_id)->first();
        $data = [
            "nom" => $pizza->nom,
            "qte" => $c->qte,
            "prix" => $pizza->prix * $c->qte
        ];
        $total += $pizza->prix * $c->qte;
        $total_amount += $c->qte;
        array_push($content, $data);
    }
    if ($total < 0 || $total_amount < 0) {
        $request->session()->flash("error", " une erreur est survenue");
        return redirect("/historical");
    }
    return view("account.userHistoricalDetails", ["commande" => $commande, "content" => $content, "total" => $total, "total_amount" => $total_amount]);
}

// Affiche la liste des commandes triées par date et statut
public function CommandeAdminStatutDate(Request $request) {
    
    $commandes = Commande::orderby("created_at", "desc")->orderby("statut")->paginate(10);
    return view("admin.adminCommandes", ["commandes" => $commandes]);
}

//Affiche la liste des commandes par date voulue

public function CommandeAdminOnDate(Request $request) {
    
   $date= $request->input('date');
   if($date != null){
    session()->put('date',$date);
   }else{
    $date = session()->get('date');
   }
    
    $commandes = Commande::whereDate('created_at', $date)->orderBy('created_at', 'DESC')->paginate(10);

    $total = 0;
    $total_amount = 0;
    $content = array();

    foreach($commandes as $commande){
        $commandes_pizza = DB::table("commande_pizza")->where("commande_id", $commande->id)->get();
        foreach($commandes_pizza as $c) {
            $pizza = Pizza::withTrashed()->where('id',$c->pizza_id)->first();
            $data = [
                "nom" => $pizza->nom,
                "qte" => $c->qte,
                "prix" => $pizza->prix * $c->qte
            ];
            $total += $pizza->prix * $c->qte;
            $total_amount += $c->qte;
            array_push($content, $data);
        }
    }
    if ($total < 0 || $total_amount < 0) {
        $request->session()->flash("error", " une erreur est survenue");
        return redirect("/commandes");
    }
    return view("admin.adminCommandeDate", ["commandes" => $commandes, "date" => $date,"total"=> $total]);
}

public function AllCommandesAdmin(Request $request){
    $commandes = Commande::orderby("statut")->paginate(10);
    return view("admin.adminAllcommandes",["commandes"=> $commandes]);
}

public function updatepasswordAdmin(Request $request)
{
    $user = Auth::user();
    $currentPassword = $request->input('mdpactuel');
    $newPassword = $request->input('Nouveaumdp');

    if (Hash::check($currentPassword, $user->mdp)) {
        $this->validate($request, [
            'Nouveaumdp' => 'required|string|confirmed|min:4',
        ]);

        $user->mdp = Hash::make($newPassword);
        $user->save();

        session()->flash('etat', 'Votre mot de passe a été modifié avec succès !');
        return redirect()->route('home');
    } else {
        session()->flash('error', 'Le mot de passe actuel est incorrect.');
        return redirect()->route('home');
    }
}

public function updatepasswordAdminForm(Request $request){
    return view("admin.adminModifyPassword");
}

public function changecookpasswordForm(Request $request,$cook_id){
    $cook = User::find($cook_id);
    return view("admin.adminCookpassword",["cook" => $cook]);
}

public function listeCookForm(Request $request){
    $cooks = DB::table("users")->where("type", "cook")->get();
    return view("admin.adminListeCook",["cooks" => $cooks]);
}

public function changecookpassword(Request $request)
{
    $request->validate([
        'new_password' => 'required|confirmed'
        
    ]);

    $cook_id = $request->input('cook_id');
 
    $new_password = $request->input('new_password');

    $cook = User::find($cook_id);

    $cook->mdp = Hash::make($new_password);
    $cook->save();

    

    session()->flash('etat', 'Le mot de passe a été modifié avec succès.');

     return redirect()->route('home');
}



public function deleteAdminOrCook(Request $request, $id)
{
    $user = User::find($id);

    if (!$user || !in_array($user->type, ['admin', 'cook'])) {
        $request->session()->flash('error', 'Utilisateur inexistant ou non autorisé');
        return redirect()->route('home');
    }

    $user->delete();
    $request->session()->flash('etat', 'Utilisateur supprimé avec succès');
    return redirect()->route('deleteAdminOrCook');
}

public function deleteAdminOrCookForm($id){
    $u = User::find($id);
    return view('admin.deleteCookOrAdmin') -> with('user',$u);
}

public function ListeDeleteForm(){
    $cooks = DB::table("users")->where("type", "admin")->orwhere("type", "cook")->get();
    return view ('admin.adminSuppCookOrAdmin',["cooks" => $cooks]);
}


    
    
}
