<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credential;
use App\Models\Route;
use App\Models\CredentialToRoute;
use App\Traits\LoggingTrait;

class CredentialUserController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        //
        $credentials = Credential::orderBy('id', 'desc')->get();
        $routes = Route::leftJoin('menus', 'routes.menu_id', 'menus.id')
            ->select('routes.*', 'menus.name as menu')
            ->get();
        if($this->isActiveLog) $this->saveLog('Akses Credential');
        return view('credential.user.index', compact('credentials', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $existing = Credential::where('username', $request->username)->first();
        if (!empty($existing))
            return redirect()->back();
        $credential = Credential::insertNewData($request);
        $routes = CredentialToRoute::insertNewDatas($credential, $request->route_ids);
        if($this->isActiveLog) $this->saveLog('Add Credential with id : '.$credential->id);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $credential = Credential::find($id);
        if (empty($credential))
            return;
        $selectedRoutes = CredentialToRoute::leftJoin('routes', 'credential_to_routes.route_id', 'routes.id')
            ->leftJoin('menus', 'routes.menu_id', 'menus.id')
            ->where('credential_to_routes.credential_id', $credential->id)
            ->select('routes.*', 'menus.name as menu')
            ->get();
        $sr_ids = [];
        foreach($selectedRoutes as $sr){
            array_push($sr_ids, $sr->id);
        }

        $routes = Route::leftJoin('menus', 'routes.menu_id', 'menus.id')
            ->whereNotIn('routes.id', $sr_ids)
            ->select("menus.name as menu", 'routes.*')
            ->get();
        
        return ['title' => 'Edit Credential', 'body' => view('credential.user.form', compact('credential', 'selectedRoutes', 'routes'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $credential = Credential::find($id);
        if (empty($credential))
            return redirect()->back();

        $credential->updateData($request);
        $credential->updateRoutes($request->route_ids);
        if($this->isActiveLog) $this->saveLog('Update Credential with id : '.$id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Credential::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Credential with id : '.$id);
        return redirect()->back();
    }
}
