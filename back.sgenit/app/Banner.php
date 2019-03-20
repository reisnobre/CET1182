<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

use App\Event;

class Banner extends Model
{
    protected $fillable = [
        'hash_name', 'original_name', 'file_extension', 'title'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getPublicUrlAttribute()
    {
        return Storage::disk('banners')->url($this->event->user->id . '/' . $this->hash_name . '.' . $this->file_extension);
    }

    public static function getByEventId($id)
    {
        return Banner::where('event_id', '=', $id)->first();
    }
}
