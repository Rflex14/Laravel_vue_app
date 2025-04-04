<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Unidad_Productiva extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $table = 'unidades_productivas';

  public function persona()
  {
    return $this->belongsTo(Persona::class);
  }
  public function empresa()
  {
    return $this->belongsTo(Empresa::class);
  }
  public function productos()
  {
    return $this->belongsToMany(Producto::class, UnidadProductivaProducto::class, 'unidadProductiva_id', 'producto_id');
  }
}
