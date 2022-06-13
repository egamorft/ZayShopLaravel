<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'account_email', 'account_password', 'account_name', 'account_phone'
    ];
    protected $primaryKey = 'account_id';
    protected $table = 'tbl_account';
}
