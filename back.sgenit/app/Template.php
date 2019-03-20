<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\FooterImage;

class Template extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function footerImage()
    {
        return $this->hasOne(FooterImage::class);
    }

    public function createFooterImage(FooterImage $footerImage)
    {
        return $this->footerImage()->save($footerImage);
    }
}
