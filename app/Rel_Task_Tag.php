<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rel_Task_Tag extends Model {

	protected $table = 'rel_tasks_tags'; 
    
    protected $fillable = ['task_id', 'tag_id', 'created_at', 'updated_at'];

    public function getTag()
    {
        return $this->belongsTo('App\Tag', 'id');
    }

}
