<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Producto extends Model
{
  use HasFactory;
  protected $guarded = [];
  public function almacenes()
  {
    return $this->belongsToMany(Almacen::class, AlmacenProducto::class, 'producto_id', 'almacen_id');
  }
  public function unidadesProductivas()
  {
    return $this->belongsToMany(Unidad_Productiva::class, UnidadProductivaProducto::class,'producto_id', 'unidadProductiva_id');
  }
}
