<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_date', 'sale', 'profit', 'quantity', 'total_order'
    ];
    protected $primaryKey = 'statistic_id';
    protected $table = 'tbl_statistic';
}
