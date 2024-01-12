<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileMuridContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'file_murid_content';
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    protected $guarded = [];

    public static function migrateMurid($file_id){
        $file = FileMurid::find($file_id);
        if (empty($file))
            return;
        $contents = FileMuridContent::where('file_murid_id', $file_id)->get();
        foreach($contents as $content){
            MuridSekolah::insertFromContent($content, $file->jenjang);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }
}
