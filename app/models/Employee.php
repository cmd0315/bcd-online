<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Employee extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;
	
	public $timestamps = false;

	protected $fillable = array('username', 'first_name', 'middle_name', 'last_name', 'email', 'mobile', 'department_id', 'position');

	protected $touches = array('account');

	protected $table = 'employees';

    protected $dates = ['deleted_at'];

	public function account() {
        return $this->belongsTo('Account', 'username', 'username')->withTrashed();
    }

    public function department() {
        return $this->belongsTo('Department', 'department_id', 'department_id');
    }

    public function scopeDepartmentID($query, $department_id) {
        return $query->where('department_id', '=', $department_id);
    }

    public function scopeHead($query) {
    	return $query->where('position', '1');
    }

    public function getFullNameAttribute() {
    	return ucfirst($this->first_name) . ' ' . ucfirst($this->middle_name) . ' ' . ucfirst($this->last_name);
    }

}
