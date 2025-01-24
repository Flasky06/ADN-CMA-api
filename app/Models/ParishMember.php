<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParishMember extends Model
{
    use HasFactory;

    // Set the primary key to 'Regno' instead of the default 'id'
    protected $primaryKey = 'Regno';

    // Leave $incrementing as true since Regno will auto-increment
    public $incrementing = true;

    // Define the fillable fields
    protected $fillable = [
        'Regno', 'Name', 'Commissioned', 'CommissionNo', 'DateJoin', 'photo', 'IdNo',
        'CellNo', 'email', 'Status', 'parish_id', 'DOB', 'ParishCode', 'StationCode',
        'LithurgyStatus', 'DeanCode', 'Rpt', 'Bapt', 'Conf', 'Euc', 'Marr'
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