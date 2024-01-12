<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileKomoditasContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_komoditas_content';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    protected $guarded = [];

    public static function migrateGuru($file_id){
        $file = FileKomoditas::find($file_id);
        if (empty($file))
            return;
        $contents = FileKomoditasContent::where('file_jalan_id', $file_id)->get();
        foreach($contents as $content){
            StatusKomoditas::addStatusKomoditas($content, $file->tanggal_data);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }
}
