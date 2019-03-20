<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserDetail;
use App\Inscription;

class Bond extends Model
{
    public function inscription()
    {
        return $this->belongsToMany(Inscription::class);
    }
}
