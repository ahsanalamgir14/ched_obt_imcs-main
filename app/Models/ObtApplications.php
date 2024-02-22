<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class ObtApplications extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'student_id',
        'applicable_id',
        'applicable_type',
        'status',
        'remarks'
    ];

    /**
     * Model Relationship
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function applicable()
    {
        return $this->morphTo();
    }
}
