<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AlmacenProducto extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected $table = 'almacen_productos';
}

