<?php

namespace App\Traits;

use App\Models\Logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait LoggingTrait
{
    public function saveLog($action)
	{
		$logging = new Logging();
		$logging->user_id = Auth::user()->id;
		$logging->description = $action;
		$logging->log_time = DB::raw('CURRENT_TIMESTAMP');
		$logging->from = 'Backend';
		$logging->save();
	}
}
