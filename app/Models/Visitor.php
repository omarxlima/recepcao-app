<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

}
