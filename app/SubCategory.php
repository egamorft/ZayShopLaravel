<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'subcategory_name', 'subcategory_desc', 'subcategory_status', 'category_id'
    ];
    protected $primaryKey = 'subcategory_id';
    protected $table = 'tbl_subcategory';

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
