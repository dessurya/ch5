<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'hpchs_project';

    protected $fillable = ['id', 'picture', 'flag', 'user_id'];

    public function getUser()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
