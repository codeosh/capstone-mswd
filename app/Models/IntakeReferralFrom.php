<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeReferralFrom extends Model
{
    use HasFactory;

    protected $table = 'referrals_from';

    protected $fillable = [
        'intake_id',
        'referral_from',
        'referral_from_other',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
