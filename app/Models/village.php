<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class village extends Model
{
    use HasFactory;
    protected $table="villages";
    protected $fillable = [
        'village_name',
        'panch_id',
        'samiti_id',
        'teh_id',
       'state_id',
       'dist_id',
       'slug',
       'status'

   ];
   public $timestamps = false;
}
