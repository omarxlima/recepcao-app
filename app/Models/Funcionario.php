<?php

namespace App\Models;

use App\Traits\UserTrait\Multilocatario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory, Multilocatario;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function visitors(){
        return $this->hasMany(Visitor::class);
    }
}
