<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterFaculty extends Model
{
    use HasFactory;

    protected $table = 'register_faculty';

    protected $fillable = [
        'id',
        'firstname',
        'surname',
        'title',
        'gender',
        'national_id',
        'date_of_birth',
        'email',
        'phone',
        'address',
        'image',
        'role',
        'department',
        'qualification',
        'created_at',
        'updated_at'
    ];

    // Helps prevent mass assignment errors
    protected $guarded = [];
    
}
