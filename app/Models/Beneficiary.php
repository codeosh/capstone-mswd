<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_num',
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'sex',
        'status',
        'birthdate',
        'category',
        'remarks',
    ];

    // Relationships
    public function intakeForms()
    {
        return $this->hasMany(IntakeForm::class);
    }
    public function interviewForms()
    {
        return $this->hasMany(InterviewForm::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function childcases()
    {
        return $this->hasMany(ChildCase::class, 'beneficiary_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
