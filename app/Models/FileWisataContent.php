<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileWisataContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_wisata_content';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    protected $guarded = [];

    public static function migrateGuru($file_id)
    {
        $file = FileWisata::find($file_id);
        if (empty($file))
            return;
        $contents = FileWisataContent::where('file_jalan_id', $file_id)->get();
        foreach($contents as $content){
            StatusWisata::addStatusWisata($content, $file->tanggal_data);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }
}
