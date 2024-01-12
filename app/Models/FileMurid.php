<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileMurid extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_murid';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';

    public static function upload($file, $tanggal_data, $jenjang){
        $path = $file->store('murid');
        $fj = new FileMurid();
        $fj->name = $file->getClientOriginalName();
        $fj->tanggal_data = $tanggal_data;
        $fj->file_location = $path;
        $fj->jenjang = $jenjang;
        $fj->save();
        return $fj;
    }
}
