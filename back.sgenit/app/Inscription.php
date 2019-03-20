<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bond;
use App\Event;
use App\Genre;

class Inscription extends Model
{
    public function bond()
    {
        return $this->belongsTo(Bond::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function event()
    {
      return $this->belongsTo(Event::class);
    }
}
