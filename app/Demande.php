<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable = ['titre', 'description', 'budjetmax','user_id','tel'];

}
