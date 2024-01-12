<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusJembatan;
use App\Traits\LoggingTrait;

class MasterStatusJembatanController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $statuses = StatusJembatan::all();
        return view('operator.status-jembatan.index', compact('statuses'));
    }

    public function edit($id)
    {
        $status = StatusJembatan::find($id);
        if (empty($status)){
            return ['title' => 'Data Tidak Ditemukan', 'body' => ''];
        }
        return ['title' => 'Edit Status '. "Jembatan", 'body'=> view('operator.status-jembatan.form', compact('status'))->render()];
    }

    public function update(Request $request, $id)
    {
        $status = StatusJembatan::find($id);
        if (empty($status))
            return redirect('operator/status-jembatan');
        $status->updateData($request);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }
}
