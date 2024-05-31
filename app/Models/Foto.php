<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['foto', 'visita_id'];
    public $timestamps = false;

    public function visita()
    {
        return $this->belongsTo(visitor::class);
    }
}
