<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pizza extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'pizzas';

    protected $fillable = ['nom', 'description', 'prix'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
