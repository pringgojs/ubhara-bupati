<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileKelompokTani extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_kelompok_tani';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';

    public static function upload($file, $tanggal_data, $desa_id){
        $path = $file->store('kelompok_tani');
        $fj = new FileKelompokTani();
        $fj->name = $file->getClientOriginalName();
        $fj->desa_id = $desa_id;
        $fj->tanggal_data = $tanggal_data;
        $fj->file_location = $path;
        $fj->desa_id = $desa_id;
        $fj->save();
        return $fj;
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }
}
