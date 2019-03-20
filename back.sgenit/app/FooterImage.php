<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Template;
use App\User;
use Illuminate\Support\Facades\Storage;

class FooterImage extends Model
{
    protected $fillable = [
        'hash_name', 'original_name', 'file_extension'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function getPublicUrlAttribute () {
        return Storage::disk('footers')->url($this->template->user->id . '/' . $this->hash_name . '.' . $this->file_extension);
    }

    public static function getByTemplateId($id)
    {
        return FooterImage::where('template_id', '=', $id)->first();
    }
}
