<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    use HasFactory;

  

    protected $fillable = ['name', 'code', 'deanery_id'];


    // Define the relationship to Deanery
    public function deanery()
    {
        return $this->belongsTo(Deanery::class);
     
    }
}