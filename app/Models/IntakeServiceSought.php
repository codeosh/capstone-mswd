<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeServiceSought extends Model
{
    use HasFactory;

    protected $table = 'service_soughts';

    protected $fillable = [
        'intake_id',
        'service_sought',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
