<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'service_name',
        'service_availed',
        'due_date',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function childcases()
    {
        return $this->hasMany(ChildCase::class);
    }
}
