<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ip_address', 'visitors_date'
    ];
    protected $primaryKey = 'visitors_id';
    protected $table = 'tbl_visitors';
}
