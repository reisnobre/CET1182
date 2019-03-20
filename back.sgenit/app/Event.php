<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\User;
use App\Banner;
use App\Template;
use App\Theme;
use App\Inscription;
use App\Workshop;

class Event extends Model
{
    protected $fillable = [
        'title', 'siteUrl', 'template_id', 'description', 'subscriptions_start', 'subscriptions_end', 'event_start', 'event_end'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function banner()
    {
        return $this->hasOne(Banner::class);
    }

    public function template()
    {
        return $this->hasOne(Template::class);
    }

    public function theme()
    {
        return $this->hasOne(Theme::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }

    // Creation

    public function createTheme(Theme $theme)
    {
        return $this->theme()->save($theme);
    }

    public function createBanner(Banner $banner)
    {
        return $this->banner()->save($banner);
    }

    public function createInscription(Inscription $inscription)
    {
        return $this->inscriptions()->save($inscription);
    }

    public function createWorkshop(Workshop $workshop)
    {
      return $this->inscriptions()->save($workshop);
    }

    // Utility
}
