<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class Student extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'user_id',
        'maritime_program_id',
        'file_id',
        'student_number',
        'sirb_number',
        'sid_number',
        'gender',
        'birthdate',
        'address',
        'civil_status',
        'citizenship',
        'religion',
        'height',
        'weight',
        'contact_number',
        'created_by',
        'updated_by',
        'resume_id'
    ];

    /**
     * Model Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maritime_program()
    {
        return $this->belongsTo(MaritimeProgram::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function applications()
    {
        return $this->hasMany(ObtApplications::class);
    }
}
