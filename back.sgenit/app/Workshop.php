<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use App\Inscription;

class Workshop extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function inscriptions()
    {
        return $this->belongsToMany(Inscription::class);
    }
}
