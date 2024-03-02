<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $table = 'student_profile';
    
    protected $fillable = [
        'fullname',
        'surname',
        'country_of_origin',
        'date_of_birth',
        'gender',
        'email',
        'phone',
        'omang',
        'passport_number',
        'address',
        'next_of_kin_phone',
        'application_date',
        'imported'
    ];

    public function scopeSearch($query, $value) {
        $query
        ->where('fullname', 'like', "%{$value}%")
        ->orWhere('surname', 'like', "%{$value}%")
        ->orWhere('course_code', 'like', "%{$value}%")
        ->orWhere('email', 'like', "%{$value}%")
        ->orWhere('passport_number', 'like', "%{$value}%")
        ->orWhere('country_of_origin', 'like', "%{$value}%")
        ->orWhere('omang', 'like', "%{$value}%");
    }
}
