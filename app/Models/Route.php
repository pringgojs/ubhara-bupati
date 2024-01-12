<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at']; 
    protected $connection = "cred_db";

    public static function insertNewData($menu_id, $name, $deleteable){
        $data = new Route;
        if($menu_id > 0)
            $data->menu_id = $menu_id;
        $data->name = $name;
        if ($deleteable != null)
            $data->deleteable = $deleteable;
        $data->save();
        return $data;
    }

    public function updateData($menu_id, $name, $deleteable){
        if($menu_id > 0)
            $this->menu_id = $menu_id;
        $this->name = $name;
        if ($deleteable != null)
            $this->deleteable = $deleteable;
        $this->save();
    }

    public static function deleteRelatedTo($where, $to){
        
    }

    public static function deleteRelatedToId($id){
        $r = Route::find($id);
        if (empty($r))
            return;
        if($r->deleteable == 1)
            $r->delete();
        return;
    }
}
