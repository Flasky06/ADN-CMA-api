<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParishMember extends Model
{

    use  HasFactory;

    protected $fillable = [
        'name', 'Commissioned', 'CommissionNo', 'DateJoin', 'photo', 'IdNo',
        'CellNo', 'email', 'Status', 'parish_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }
}