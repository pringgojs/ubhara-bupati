<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoutingGroup;
use App\Traits\LoggingTrait;

class CredentialRoutingGroupController extends Controller
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
        $groups = RoutingGroup::all();
        if($this->isActiveLog) $this->saveLog('Akses Routing Group');
        return view('credential.routing-group.index', compact('groups'));
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
        $group = RoutingGroup::insertNewDataFromForm($request);
        if($this->isActiveLog) $this->saveLog('Add Routing Group with id : '.$group->id);
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
        $group = RoutingGroup::find($id);
        if (empty($group))
            return;
        return ['title' => 'Ubah Routing Group', 'body' => view('credential.routing-group.form', compact('group'))->render()];
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
        $group = RoutingGroup::find($id);
        if (!empty($group)){
            $group->updateData($request);
        }
        if($this->isActiveLog) $this->saveLog('Update Routing Group with id : '.$id);
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
        RoutingGroup::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Routing Group with id : '.$id);
        return redirect()->back();
    }
}
