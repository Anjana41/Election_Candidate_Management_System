<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class panchayat extends Model
{
    use HasFactory;
    protected $table="panchayats";
    protected $fillable = [
        'panchayat_name',
        'samiti_id',
       'teh_id',
       'state_id',
       'dist_id',
       'slug',
       'status'

   ];
   public $timestamps = false;
}
