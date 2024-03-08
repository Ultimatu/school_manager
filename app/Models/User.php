<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_auth',
        'phone',
        'permissions',
        'annee_scolaire',
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
        'password' => 'hashed',
    ];


   
    /**
     * Get the user's administration.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administrations()
    {
        return $this->hasMany(Administration::class);
    }

    public function administration()
    {
        return $this->hasOne(Administration::class);
    }


    /**
     * Get the user's professeur.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function professeurs()
    {
        return $this->hasMany(Professeur::class);
    }
    public function professeur()
    {
        return $this->hasOne(Professeur::class);
    }

    /**
     * Get the user's etudiant.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function etudiant()
    {
        return $this->hasOne(Etudiant::class);
    }


    /**
     * Get the user's parents.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parents()
    {
        return $this->hasMany(Parents::class);
    }

    /**
     * Get the user's parent.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Parents::class);
    }

     /**
     * Check if the user is a super admin.
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role_auth === 'admin';
    }
    /**
     * Check if the user is an admin.
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role_auth === 'admin' || $this->role_auth === 'directeur' || $this->role_auth === 'secretaire';
    }

    /**
     * Check if the user is a director.
     * @return bool
     */
    public function isDirector()
    {
        return $this->role_auth === 'directeur';
    }

    /**
     * Check if the user is a comptable.
     * @return bool
     */
    public function isComptable()
    {
        return $this->role_auth === 'comptable';
    }

    /**
     * Check if the user is a secreteur.
     * @return bool
     */
    public function isSecretaire()
    {
        return $this->role_auth === 'secreteur';

    }

    /**
     * Check if the user is a consellor.
     * @return bool
     */
    public function isConsellor()
    {
        return $this->role_auth === 'consellor';
    }

    /**
     * Check if the user is a professeur.
     * @return bool
     */
    public function isProfesseur()
    {
        return $this->role_auth === 'professeur';
    }

    /**
     * Check if the user is a parent.
     * @return bool
     */
    public function isParent()
    {
        return $this->role_auth === 'parent';
    }

    /**
     * Check if the user is a etudiant.
     * @return bool
     */
    public function isEtudiant()
    {
        return $this->role_auth === 'etudiant';
    }

    public function isCreator(){
        return $this->isAdmin() || $this->isConsellor() || $this->isDirector();
    }

    public  static function generatePassword($type = 'ADMIN'): string
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, 8);
        //password =  3 premiere lettre de type + 5 premier lettre de password
        return strtoupper(substr($type, 0, 3)).'-' . $password;
    }

}
