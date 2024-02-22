<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class Vessel extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'shipping_company_id',
        'imo_number',
        'registry_number',
        'vessel_name',
        'vessel_type',
        'grt',
        'kw',
        'flag',
        'route',
        'created_by',
        'updated_by',
    ];

    /**
     * Model Relationship
     */
    public function shipping_company()
    {
        return $this->belongsTo(ShippingCompany::class);
    }

    public function vessel_staffs()
    {
        return $this->hasMany(VesselStaffs::class);
    }

    public function applications()
    {
        return $this->morphMany(ObtApplications::class, 'applicable');
    }
}
