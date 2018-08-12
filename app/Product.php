<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $table = 'products';
    
    protected $primaryKey = 'code';

    protected $fillable = [
        'name','price','image','code'
    ];
    public $incrementing=false;
}
