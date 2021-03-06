<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function getDepartmentName($id)
    {
    	$department = Department::where('id', $id)->first();
    	return ($department) ? $department->name : '';
    }
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function reports()
    {
        return $this->belongsToMany('App\Report')->withPivot(['value', 'value_data']);
    }
    
}
