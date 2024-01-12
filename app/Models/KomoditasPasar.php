<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomoditasPasar extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $d = new KomoditasPasar;
        $d->nama = $request->nama;
        $d->save();
        return $d;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        KomoditasPasar::where('id', $id)->delete();
    }
}
