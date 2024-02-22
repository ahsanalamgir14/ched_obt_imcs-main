<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class MarinaStaffs extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'user_id',
        'birthdate',
        'gender',
        'contact_number',
        'position',
        'created_by',
        'updated_by',
        'top_level_access'
    ];

    /**
     * Model Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
