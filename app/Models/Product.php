<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'hpchs_product';

    protected $fillable = ['id', 'name', 'picture', 'flag', 'user_id'];

    public function getUser()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function detailPublish()
	{
		return $this->hasMany('App\Models\ProductDetail', 'product_id', 'id')->where('flag', 'Y');
	}

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
