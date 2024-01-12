<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $table = 'users';
    protected $connection = "mysql";
    protected $dates = ['deleted_at']; 

    public static function insertNewData($data){
        $user = new User;
        $user->username = $data->username;
        $user->password = bcrypt($data->password);
        $user->satker = $data->satker;
        $user->credential_id = $data->id;
        $user->save();
    }

    public static function updateData($data){
        $user = User::where('credential_id', $data->id)->first();
        if(!empty($user)){
            $user->username = $data->username;
            $user->password = bcrypt($data->password);
            $user->satker = $data->satker;
            $user->credential_id = $data->id;
            $user->save();
        } else {
            User::insertNewData($data);
        }
    }

    public static function deleteRelatedTo($where, $to){
        User::where($where, $to)->delete();
    }
}
