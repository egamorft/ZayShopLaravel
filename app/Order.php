<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'account_id','shipping_id', 'order_status', 'order_code', 'created_at'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

    public function orderdetails()
    {
        return $this->hasMany('App\OrderDetails', 'order_code');
    }
    public function shipping()
    {
        return $this->belongsTo('App\Shipping', 'shipping_id');
    }
    public function account(){
        return $this->belongsTo('App\Account', 'account_id');
    }
}
