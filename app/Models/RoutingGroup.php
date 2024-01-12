<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoutingGroup extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at']; 
    protected $connection = "cred_db";

    public static function insertNewDataFromForm(Request $request){
        return RoutingGroup::insertNewData($request->name);
    }

    public static function insertNewData($name, $deleteable=false){
        $data = new RoutingGroup;
        $data->name = $name;
        if($deleteable != null)
        $data->deleteable = $deleteable;
        $data->save();
        return $data;
    }

    public function updateData(Request $request){
        $this->name = $request->name;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        $group = RoutingGroup::find($id);
        if (empty($group))
            return false;
        if( $group->deleteable){
            Route::deleteRelatedTo('routing_group_id', $id);
            $group->delete();
        }
        return true;
    }

    public function menus(){
        return $this->hasMany(\App\Models\Menu::class);
    }
}
