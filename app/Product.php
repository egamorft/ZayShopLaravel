<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
	    'category_id',
	    'subcategory_id',
	    'product_name',
	    'product_quantity',
	    'product_sold',
	    'product_desc',
            'product_content',
	    'product_price',
	    'product_image',
	    'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
}
