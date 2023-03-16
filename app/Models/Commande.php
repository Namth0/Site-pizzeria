<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Commande extends Model
{
    use HasFactory;
   

    protected $table = 'commandes';
    protected $fillable = ['id','user_id', 'statut'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class)->withPivot('qte');
    }

    public function commande_pizzas()
    {
        return $this->hasMany(Commande_pizza::class);
    }

public function total()
    {
        $total = 0;
        foreach ($this->commande_pizzas as $commande_pizza) {
            $total += $commande_pizza->qte * $commande_pizza->pizza->prix;
        }
        return $total;
    }

// public function total()
// {
//     return $this->hasMany(Commande_pizza::class)
//                 ->selectRaw('SUM(qte * prix) as total')
//                 ->leftJoin('pizzas', 'commande_pizza.pizza_id', '=', 'pizzas.id')
//                 ->groupBy('commande_pizza.commande_id');
// }



}
