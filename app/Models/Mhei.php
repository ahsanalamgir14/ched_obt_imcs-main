<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class Mhei extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'school_name',
        'school_type',
        'region',
        'address',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Model Relationship
     */
    public function mhei_staffs()
    {
        return $this->hasMany(MheiStaffs::class);
    }

    /**
     * Model Relationship
     */
    public function maritime_programs()
    {
        return $this->hasMany(MaritimeProgram::class);
    }

    /**
     * Model Relationship
     */
    public function students()
    {
        return $this->hasManyThrough(Student::class, MaritimeProgram::class);
    }
}
