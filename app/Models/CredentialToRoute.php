<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Route;

class CredentialToRoute extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    protected $connection = 'cred_db';

    public static function insertNewDatas($credential, $route_ids){
        $ctrs = [];
        if (isset($route_ids)){
            foreach($route_ids as $route_id){
                $route = Route::find($route_id);
                if (!empty($route)){
                    $ctr = new CredentialToRoute;
                    $ctr->credential_id = $credential->id;
                    $ctr->route_id = $route->id;
                    $ctr->save();
                    array_push($ctrs, $ctr);
                }
            }
        }
        return $ctrs;
    }

    public static function insertNewData($credential, $route){
        $ctr = new CredentialToRoute;
        $ctr->credential_id = $credential->id;
        $ctr->route_id = $route->id;
        $ctr->save();
    }

    public static function deleteRelatedTo($where, $to){
        CredentialToRoute::where($where, $to)->delete();
    }
}
