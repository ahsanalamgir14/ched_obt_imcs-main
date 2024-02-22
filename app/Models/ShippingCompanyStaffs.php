<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class ShippingCompanyStaffs extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'user_id',
        'shipping_company_id',
        'birthdate',
        'position',
        'gender',
        'contact_number',
        'created_by',
        'updated_by',
        'top_level_access'
    ];

    /**
     * Model Relationship
     */
    public function shipping_company()
    {
        return $this->belongsTo(ShippingCompany::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
