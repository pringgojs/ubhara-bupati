<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CredentialToRoute;
use App\Models\User;

class Credential extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    protected $connection = "cred_db";

    public static function insertNewData(Request $request){
        $data = new Credential;
        $data->nama = $request->nama;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->satker = $request->satker;
        $data->save();

        $user = User::insertNewData($data);
        return $data;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->username = $request->username;
        $this->password = $request->password;
        $this->satker = $request->satker;

        $user = User::updateData($this);
        $this->save();
    }

    public function updateRoutes($route_ids){
        CredentialToRoute::deleteRelatedTo('credential_id', $this->id);
        CredentialToRoute::insertNewDatas($this, $route_ids);
    }

    public static function deleteRelatedToId($id){
        CredentialToRoute::deleteRelatedTo('credential_id', $id);
        User::deleteRelatedTo('credential_id', $id);
        Credential::where('id', $id)->delete();
    }
}
