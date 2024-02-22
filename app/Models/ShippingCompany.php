<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class ShippingCompany extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'company_name',
        'address',
        'contact_number',
        'created_by',
        'updated_by',
    ];

    /**
     * Model Relationship
     */
    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }

    public function shipping_company_staffs()
    {
        return $this->hasMany(ShippingCompanyStaffs::class);
    }

    public function vessel_staffs()
    {
        return $this->hasManyThrough(VesselStaffs::class, Vessel::class);
    }

    public function applications()
    {
        return $this->morphMany(ObtApplications::class, 'applicable');
    }

    public function vessel_applications()
    {
        return $this->hasManyThrough(ObtApplications::class, Vessel::class, 'id', 'applicable_id')->where('applicable_type', Vessel::class);
    }
}
