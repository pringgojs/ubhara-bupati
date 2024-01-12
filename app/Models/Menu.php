<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $connection = "cred_db";

    public static function insertNewData($routing_group_id, $name, $index, $deleteable, $viewonmenu){
        $data = new Menu;
        $data->routing_group_id = $routing_group_id;
        $data->name = $name;
        $data->index = $index;
        if ($deleteable != null)
            $data->deleteable = $deleteable;
        if ($viewonmenu != null)
            $data->viewonmenu = $viewonmenu;
        $data->save();
        return $data;
    }
}
