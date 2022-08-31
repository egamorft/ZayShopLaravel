<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'shipping_name', 'shipping_specific_address', 'shipping_city' , 'shipping_ward' , 'shipping_province' ,'shipping_phone', 'shipping_email', 'shipping_notes', 'shipping_method'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
}
