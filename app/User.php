<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'email', 'password','slug','prenoms','function','contact','abréviation','service','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }
    public function leservice(){

        return $this->belongsTo('App\Services','service');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }



    public function projets()
    {
        return $this->belongsToMany('App\Projet', 'user_projet', 'id_user', 'id_projet');
    }
    public function validation_flow(){
        return $this->hasMany('App\Validation_flow','id_valideur');  
    }
    public function hasAnyProjets($projets)
    {
        if (is_array($projets)) {
            foreach ($projets as $projet) {
                if ($this->hasRole($projets)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($projets)) {
                return true;
            }
        }
        return false;
    }

    public function hasProjet($projet)
    {
        if ($this->projets()->where('libelle', $projet)->first()) {
            return true;
        }
        return false;
    }
}
