<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tehsil extends Model
{
    use HasFactory;
    protected $table="tehsils";
    protected $fillable = [
       'teh_name',
       'state_id',
       'dist_id',
       'slug',
       'status'

   ];
   public $timestamps = false;
}
