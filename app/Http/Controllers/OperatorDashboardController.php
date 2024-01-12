<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Credential;
use App\Traits\LoggingTrait;
use Auth;
class OperatorDashboardController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index(){
        $credential = Credential::find(Auth::user()->credential_id);
        return view('dashboard.index', compact('credential'));
    }
}
