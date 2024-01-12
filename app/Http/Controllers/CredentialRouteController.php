<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\RoutingGroup;
use App\Models\Menu;
use App\Traits\LoggingTrait;

class CredentialRouteController extends Controller
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
        $menus = Menu::leftJoin('routing_groups', 'menus.routing_group_id', 'routing_groups.id')
            ->select('menus.*', 'routing_groups.name as routing_group')
            ->get();
        $routes = Route::leftJoin('menus', 'routes.menu_id', 'menus.id')
            ->leftJoin('routing_groups', 'menus.routing_group_id', 'routing_groups.id')
            ->select('routes.*', 'menus.name as menu', 'routing_groups.name as routing_group')
            ->orderBy('routing_group', 'asc')
            ->get();
            if($this->isActiveLog) $this->saveLog('Akses Route');
        return view('credential.route.index', compact('routes', 'menus'));
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
        $route = Route::insertNewData($request->menu_id, $request->name, true);
        if($this->isActiveLog) $this->saveLog('Add Route with id : '.$route->id);
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
        $route = Route::find($id);
        $menus = Menu::leftJoin('routing_groups', 'menus.routing_group_id', 'routing_groups.id')
            ->select('menus.*', 'routing_groups.name as routing_group')
            ->get();
        return ['title' => 'Edit Data', 'body' => view('credential.route.form', compact('route', 'menus'))->render()];
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
        $route = Route::find($id);
        if(empty($route))
            return redirect()->back();
        $route->updateData($request->menu_id, $request->name, true);
        if($this->isActiveLog) $this->saveLog('Update Route with id : '.$id);
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
        Route::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Route with id : '.$id);
        return redirect()->back();
    }
}
