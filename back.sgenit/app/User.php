<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Patent;
use App\Event;
use App\Role;
use App\Template;
use App\FooterImage;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'cpf', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationships

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    public function footerImages()
    {
      return $this->hasMany(FooterImage::class);
    }

    // Creation methods

    public function createTemplate(Template $template)
    {
        return $this->templates()->save($template);
    }

    public function createFooterImage(FooterImage $footerImage)
    {
        return $this->footerImages()->save($footerImage);
    }

    public function createEvent(Event $event)
    {
        return $this->events()->save($event);
    }
}
