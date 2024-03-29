<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationResult extends Model
{
    use HasFactory;
    protected $table = 'examination_results';

    protected $fillable = [
        'student_id',
        'subjects_enrolled',
        'result',
        'pending',
        'to_write',
        'outcome'
    ];
}
