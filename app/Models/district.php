<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    use HasFactory;

    protected $table="districts";
    protected $fillable = [
       'dist_name',
       'state_id',
       'slug',
      
   ];
   public $timestamps = false;

}
