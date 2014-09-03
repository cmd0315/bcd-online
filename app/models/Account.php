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

    /* link acount to employee*/
	public function employee()
    {
        return $this->hasOne('Employee', 'username', 'username');
    }

    public function getPosition() {
    	$account = Account::find(1); 

    	echo $account->employee->position;
    }

    /**
    *
    * Cascade delete to child classes
    */
    public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($account)
        {
            $account->employee()->delete();
        });
    }

    /**
    * Convert the format of the date the account was last updated into a readable form
    * 
    */
    public function getLastProfileUpdateAttribute() {
        $year = date('Y', strtotime($this->updated_at));
        $month = date('m', strtotime($this->updated_at));
        $day = date('j', strtotime($this->updated_at));
        $hr = date('g', strtotime($this->updated_at));
        $min = date('i', strtotime($this->updated_at));
        $sec = date('s', strtotime($this->updated_at));
        return Carbon::create($year, $month, $day, $hr, $min, $sec)->diffForHumans();
    }

}
