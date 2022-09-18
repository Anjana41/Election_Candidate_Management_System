<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class samiti extends Model
{
    use HasFactory;
    protected $table="samitis";
    protected $fillable = [
        'samiti_name',
       'teh_id',
       'state_id',
       'dist_id',
       'slug',
       'status'

   ];
   public $timestamps = false;
}
