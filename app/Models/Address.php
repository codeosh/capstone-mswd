<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'streetname',
        'barangay',
        'municipality',
        'province',

    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
