<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KecamatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    // public function message()
    // {
    //     return [
    //         'lampiran1.max' => 'Surat tugas tidak boleh lebih dari 5MB.',
    //         'lampiran2.max' => 'SPMT tidak boleh lebih dari 5MB.',
    //         'lampiran3.max' => 'Dokumen / Bukti fisik tidak boleh lebih dari 5MB.',
    //         'uraian.required' => 'Uraian tidak boleh kosong.',
	// 		'satuan_hasil.required' => 'Satuan tidak boleh kosong.',
    //     ];
    // }
}
