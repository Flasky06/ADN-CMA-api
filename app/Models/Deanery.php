<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deanery extends Model
{
    protected $fillable = ['name', 'code', 'diocese_id'];

    public function parish()
    {
        return $this->hasMany(Parish::class);
    }
}