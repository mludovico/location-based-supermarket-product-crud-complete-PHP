<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = ['aisle', 'shelf', 'side'];

    public function relProduct()
    {
      return $this->hasMany('App\Models\Models\Product', 'id_location');
    }
}
