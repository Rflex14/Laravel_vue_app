<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Vehiculo extends Model
{

    use HasFactory;
    protected $guarded = [];
    public function persona()
    {
      return $this->belongsTo(Persona::class);
    }

    public function empresa()
    {
      return $this->belongsTo(Empresa::class);
    }
}
