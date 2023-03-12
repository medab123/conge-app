<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;


    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function demandeur()
    {
        return $this->belongsTo(User::class,"demandeur_id");
    }
}
