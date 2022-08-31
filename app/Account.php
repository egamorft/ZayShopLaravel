<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'account_name', 'account_email', 'account_password', 'account_phone', 'account_confirmation', 'address_id'
    ];
    protected $primaryKey = 'account_id';
    protected $table = 'tbl_account';
}
