<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FileNakes;
use App\Models\TenagaKesehatan;

class FileNakesContent extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    protected $connection = 'file_db';

    protected $fillable = ['nama','kepegawaian','jabatan','penempatan','fasyankes','alamat_nakes','alamat_fasyankes','jenis_fasyankes', 'status', 'file_nakes_id'];

    public static function migrateNakes($file_id){
        $file = FileNakes::find($file_id);
        if (empty($file))
            return;
        $contents = FileNakesContent::where('file_nakes_id', $file_id)->get();
        foreach($contents as $content){
            TenagaKesehatan::insertFromContent($content);
            $content->status ='migrated';
            $content->save();
        }
        $file->status = 'migrated';
        $file->save();
    }
}
