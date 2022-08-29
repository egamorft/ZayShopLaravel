<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'account_id', 'city', 'province', 'ward', 'specific_address', 'address_type', 'is_default'
    ];
    protected $primaryKey = 'address_id';
    protected $table = 'tbl_address';

    public function city_address()
    {
        return $this->hasOne('App\City', 'matp', 'city');
    }

    public function province_address()
    {
        return $this->hasOne('App\Province', 'maqh', 'province');
    }

    public function ward_address()
    {
        return $this->hasOne('App\Wards', 'xaid', 'ward');
    }
}
