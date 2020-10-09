<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function assets()
    {
        return $this->hasMany('App\Models\Asset');
    }
    /**
     * Determine if the user is admin in current team.
     *
     *
     * @return bool
     */
    public function isAdmin(){
        $currentTeamName = Auth::user()->currentTeam;
        if(Auth::User()->TeamRole($currentTeamName)->name == 'administrator'){
            return true;
        }else{ return false; }
    }

    /**
     * Determine if the user is Owner in current team.
     *
     *
     * @return bool
     */
    public function isOwner(){
        $currentTeamName = Auth::user()->currentTeam;
        if(Auth::User()->TeamRole($currentTeamName)->name == 'Owner'){
            return true;
        }else{ return false; }
    }

    /**
     * Determine if the user is editor in current team.
     *
     *
     * @return bool
     */
    public function isEditor()
    {
        $currentTeamName = Auth::user()->currentTeam;
        if (Auth::User()->TeamRole($currentTeamName)->name == 'Editor') {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Get current team name.
     *
     *
     * @return string
     */
    public function currentTeamName(){
        return Auth::user()->currentTeam->name;
    }
    /**
     * Get current team Id.
     *
     *
     * @return integer
     */
    public function currentTeamId(){
        return Auth::user()->currentTeam->id;
    }
    /**
     * Get the user role in current Team.
     *
     *
     * @return string
     */
    public function userRoleInCurrentTeam(){
        $currentTeamName = Auth::user()->currentTeam;
        return Auth::User()->TeamRole($currentTeamName)->name;
    }
}
