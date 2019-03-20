<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bond;

class UserDetail extends Model
{
    public function bond()
    {
        return $this->belongsTo(Bond::class);
    }
}
