<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomoditasLahan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $d = new KomoditasLahan;
        $d->nama = $request->nama;
        $d->save();
        return $d;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->save();
    }

    public static function findOrInsert($nama){
        $data = KomoditasLahan::where('nama', $nama)->first();
        if (empty($data)){
            $data = new KomoditasLahan;
            $data->nama = $nama;
            $data->save();
        }
        return $data;
    }

    public static function deleteRelatedToId($id){
        KomoditasLahan::where('id', $id)->delete();
    }
}
