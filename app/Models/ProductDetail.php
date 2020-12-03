<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'hpchs_product_detail';

    protected $fillable = ['id', 'name', 'picture', 'descript', 'flag', 'user_id', 'product_id'];

    public function getUser()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function getHeader()
	{
		return $this->belongsTo('App\Models\Product', 'product_id');
	}


	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
