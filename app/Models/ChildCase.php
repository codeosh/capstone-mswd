<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCase extends Model
{
    use HasFactory;
    protected $table = 'childcases';

    protected $fillable = [
        'beneficiary_id',
        'pantawid_beneficiary',
        'offense_committed',
        'status',
        'remarks',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
