<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileJembatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $connection = 'file_db';
    
    public static function upload($file, $tanggal_data){
        $path = $file->store('jembatan');
        $fj = new FileJembatan();
        $fj->name = $file->getClientOriginalName();
        $fj->tanggal_data = $tanggal_data;
        $fj->file_location = $path;
        $fj->status = 'uploaded';
        $fj->save();

        return $fj;
    }
}
