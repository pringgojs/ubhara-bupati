<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credential;
use App\Models\RoutingGroup;
use App\Models\CredentialToRoute;
use App\Models\Route;
use App\Models\Menu;
use App\Traits\LoggingTrait;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index(){
        if (Auth::check())
            return redirect('dashboard');
        return view('login.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        if(Auth::attempt($credentials)){                        
            $selectedRoutes = CredentialToRoute::where('credential_id', Auth::user()->credential_id)->select('route_id')->get();
            $menu_ids = Route::whereIn('id', $selectedRoutes)->select('menu_id')->distinct()->get();
            $rg_ids = Menu::whereIn('id', $menu_ids)->select('routing_group_id')->distinct()->get();
            $routing_groups = RoutingGroup::whereIn('id', $rg_ids)->with('menus')->get();

            session(['menu_groups' => $routing_groups]);
            if($this->isActiveLog) $this->saveLog('Login');
            return redirect('dashboard');
        }
        return redirect()->back()->with('error_message', 'Username dan Password tidak cocok, silahkan coba lagi');
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
