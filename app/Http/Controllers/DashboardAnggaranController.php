<?php

namespace App\Http\Controllers;

use App\Traits\LoggingTrait;
use Illuminate\Http\Request;

class DashboardAnggaranController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }
}
