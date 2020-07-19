<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = ['adresse', 'description','titre','capacite','superficie','image','prix',
    'latitude','longitude','tel'];

    public function getImagesAttribute() {
        return asset('storage/' . $this->attributes['images']);
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }


}
