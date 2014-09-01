<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Department extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;
	
	protected $table = 'departments';

    protected $dates = ['deleted_at'];

	protected $fillable = array('department_id', 'department', 'status');

	public function employee()
    {
        return $this->hasOne('Employee', 'department_id', 'department_id');
    }

}
