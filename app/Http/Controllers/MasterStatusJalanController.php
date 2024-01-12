<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusJalan;
use App\Traits\LoggingTrait;

class MasterStatusJalanController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $statuses = StatusJalan::all();
        return view('operator.status-jalan.index', compact('statuses'));
    }

    public function edit($id)
    {
        $status = StatusJalan::find($id);
        if (empty($status)){
            return ['title' => 'Data Tidak Ditemukan', 'body' => ''];
        }
        return ['title' => 'Edit Status '. "Jalan", 'body'=> view('operator.status-jalan.form', compact('status'))->render()];

    }

    public function update(Request $request, $id)
    {
        $status = StatusJalan::find($id);
        if (empty($status))
            return redirect('operator/status-jalan');
        $status->updateData($request);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }
}
