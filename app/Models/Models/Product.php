<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['id_location', 'name', 'description', 'price'];

    public function relLocation()
    {
      return $this->hasOne('App\Models\Models\Location', 'id', 'id_location');
    }
}
