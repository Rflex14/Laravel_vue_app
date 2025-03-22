<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Empresa extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function vehiculos()
  {
    return $this->hasMany(Vehiculo::class);
  }
  public function unidadesProductivas()
  {
    return $this->hasMany(Unidad_Productiva::class);
  }
  public function almacenes()
  {
    return $this->hasMany(Almacen::class);
  }//
}
