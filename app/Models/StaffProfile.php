<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffProfile extends Model
{
    use HasFactory;

    protected $table = "staff_profile";
    
    protected $fillable = [
        'fullname',
        'surname',
        'title',
        'gender',
        'omang',
        'date_of_birth',
        'email',
        'phone',
        'address',
        'role',
        'department'
    ];
    public function scopeSearch($query, $value) {
        $query
        ->where('fullname', 'like', "%{$value}%")
        ->orWhere('surname', 'like', "%{$value}%")
        ->orWhere('course_code', 'like', "%{$value}%");
    }
}
