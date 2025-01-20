<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diocese extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'code'];

    public function deaneries()
    {
        return $this->hasMany(Deanery::class);
    }

    
}