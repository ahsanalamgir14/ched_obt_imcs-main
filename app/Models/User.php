<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * Attributes that are assignable
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'default_password',
        'role_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * Automatically Hash password on create & update
     */
    public function setPasswordAttribute($value) {
        if($value != null && $value != '') {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Model Relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function mhei_staff()
    {
        return $this->hasOne(MheiStaffs::class);
    }

    public function shipping_company_staff()
    {
        return $this->hasOne(ShippingCompanyStaffs::class);
    }

    public function ched_staff()
    {
        return $this->hasOne(ChedStaffs::class);
    }

    public function vessel_staff()
    {
        return $this->hasOne(VesselStaffs::class);
    }

    public function pcg_staff()
    {
        return $this->hasOne(PcgStaffs::class);
    }

    public function marina_staff()
    {
        return $this->hasOne(MarinaStaffs::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    // Add all classes with user_id
}
