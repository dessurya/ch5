<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'hpchs_banner';

    protected $fillable = ['id', 'text_one', 'text_two', 'picture', 'flag', 'user_id'];

    public function getUser()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
