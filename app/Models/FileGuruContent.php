<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileGuruContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_guru_content';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    protected $guarded = [];

    public static function migrateGuru($file_id){
        $file = FileGuru::find($file_id);
        if (empty($file))
            return;
        $contents = FileGuruContent::where('file_guru_id', $file_id)->get();
        foreach($contents as $content){
            GuruSekolah::insertFromContent($content);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }
}
