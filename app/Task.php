<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	protected $table = 'tasks';

    protected $fillable = ['owner_id', 'title', 'description', 'deadline', 'state', 'created_at', 'updated_at'];

}
