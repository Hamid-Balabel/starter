<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $table='offers';
    protected $fillable=['name_en','name_ar','price','details_en','details_ar','photo','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

}
