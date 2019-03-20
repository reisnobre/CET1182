<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inscription;

class Genre extends Model
{
    public function inscription()
    {
        return $this->belongsToMany(Inscription::class);
    }
}
