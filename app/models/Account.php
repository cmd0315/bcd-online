<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Account extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	protected $fillable = array('username', 'password', 'status');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'accounts';

    protected $dates = ['deleted_at'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function employee()
    {
        return $this->hasOne('Employee', 'username', 'username');
    }

    public function getPosition() {
    	$account = Account::find(1); 

    	echo $account->employee->position;
    }

    public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($account)
        {
            $account->employee()->delete();
        });
    }    
}
