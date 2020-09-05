<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\User;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function StoreUser($data)
    {
        $data['visible_password'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $data['is_admin'] = 0;
        $data['email_verified_at'] = NOW();
        return User::create($data);
    }

    public function AllUser()
    {
        return User::orderBy('created_at', 'DESC')->paginate(5);
    }

    public function GetUser($id)
    {
        return User::find($id);
    }

    public function UpdateUser($id, $data)
    {
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->email_verified_at = NOW();
        $user->visible_password = $data['password'];
        $user->password = bcrypt($data['password']);
        $user->occupation = $data['occupation'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->save();
        return $user;
    }

    public function DeleteUser($id)
    {
        return User::find($id)->delete();
    }
}
