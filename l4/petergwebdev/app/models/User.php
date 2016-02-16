<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
//use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    protected $fillable = [
                            'email',
                            'native_language_id',
                            'password',
                            'password_confirmation',
                            'firstname',
                            'lastname',
                            'remember_token',
                          ];

    public static $rules = [
        'email'=>'required|email|unique:users',
        'password'=>'required|min:8',
        'native_language_id'=>'required|integer',
        'firstname'=>'alpha_dash_space',
        'lastname'=>'alpha_dash_space',
    ];

    public static function getUser($userId=null)
    {
        if ( !empty($userId) ) {
            $user = \User::select('id','name','email')->find($userId);
        } else if ( \Auth::guest()) {
            $user = null;
        } else {
            $user = new stdClass();
            $user->id = \Auth::user()->id;
            $user->name = \Auth::user()->name;
            $user->email = \Auth::user()->email;
        }
        return $user;
    }

    public static function getValidationRules($isLogin=1) 
    {
        $rules = self::$rules;
        if ($isLogin) {
            unset($rules['password_confirmation']);
            $rules['password'] = 'required|min:8';
        }
        return $rules;
    }

    // === relations ===

    public function roles()
    {
        return $this->belongsToMany('Role', 'assigned_roles');
    }

}
