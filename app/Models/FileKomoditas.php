<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileKomoditas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_komoditas';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';

    public static function upload($file, $tanggal_data){
        $path = $file->store('komoditas');
        $fj = new FileKomoditas();
        $fj->name = $file->getClientOriginalName();
        $fj->tanggal_data = $tanggal_data;
        $fj->file_location = $path;
        $fj->save();
        return $fj;
    }
}
