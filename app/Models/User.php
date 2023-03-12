<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'lname', 'cin', 'date_birth', 'cnss', 'contrat_date', /*'contrat_id', */'position_id','projet_id', 'email', 'password', /*'manager_id'*/
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

   /* public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }*/

    /*public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }*/
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }
}
