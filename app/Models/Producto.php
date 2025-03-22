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
    return $this->BelongsToMany(Almacen::class);
  }
  public function unidadesProductivas()
  {
    return $this->belongsToMany(Unidad_Productiva::class);
  }
}
