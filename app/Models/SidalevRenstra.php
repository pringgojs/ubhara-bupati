<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidalevRenstra extends Model
{
    use HasFactory;

    protected $connection = 'sidalev_db';

    protected $table = 'renstra';
    
}
