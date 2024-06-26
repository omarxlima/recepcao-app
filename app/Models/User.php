<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable  implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'grupo_id'
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
        'is_active' => 'boolean',
    ];

    public function visitors(){
        return $this->hasMany(Visitor::class);
    }

    public function funcionarios(){
        return $this->hasMany(Funcionario::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return $this->hasRole('Admin');
    // }

    //     public function canAccessPanel(Panel $panel): bool
    // {
    //     return $this->hasPermissionTo('access-admin');
    // }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

}
