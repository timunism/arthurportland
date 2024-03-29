<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegister extends Model
{
    use HasFactory;

    protected $table = 'student_register';

    protected $fillable = [
        'student_profile_id',
        'student_id',
        'tr_number',
        'program_code',
        'program_description',
        'year_of_study',
        'start_date',
        'end_date',
        'date_of_registration',
        'subjects_enrolled',
        'credit_enrolled',
        'number_of_modules',
        'passed',
        'failed',
        'student_status',
        'sponsorship_status',
        'sponsor',
        'accomodation_status',
        'campus'
    ];

    public function scopeSearch($query, $value) {
        $query->where('sponsor', 'dtef')
        ->where('fullname', 'like', "%{$value}%")
        ->orWhere('surname', 'like', "%{$value}%")
        ->orWhere('program_code', 'like', "%{$value}%");
    }
}
