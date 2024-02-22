<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class MaritimeProgram extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'mhei_id',
        'course',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Model Relationship
     */
    public function mhei()
    {
        return $this->belongsTo(Mhei::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
