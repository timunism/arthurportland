<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $table = 'student_profile';
    
    protected $fillable = [
        'id',
        'firstname',
        'surname',
        'date_of_birth',
        'gender',
        'email_address',
        'phone',
        'passport_number',
        'address',
        'nok_phone',
        'application_date'
    ];

    public function scopeSearch($query, $value) {
        $query
        ->where('fullname', 'like', "%{$value}%")
        ->orWhere('surname', 'like', "%{$value}%")
        ->orWhere('course_code', 'like', "%{$value}%");
    }
}
