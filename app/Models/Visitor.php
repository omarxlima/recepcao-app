<?php

namespace App\Models;

use App\Traits\UserTrait\Multilocatario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory, Multilocatario;

    protected $fillable = [
        'user_id',
        'funcionario_id',
        'name',
        'cpf',
        'registration',
        'telephone',
        'function',
        'capacity',
        'interlocutor',
        'date_time'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function funcionario(){
        return $this->belongsTo(Funcionario::class);
    }

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->user_id = auth()->id();
            }
        });
    }

}
