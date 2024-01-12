<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileSekolahContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_sekolah_content';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    protected $guarded = [];

    public static function migrateSekolah($file_id){
        $file = FileSekolah::find($file_id);
        if (empty($file))
            return;
        $contents = FileSekolahContent::where('file_sekolah_id', $file_id)->get();
        foreach($contents as $content){
            Sekolah::insertFromContent($content);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }
}
