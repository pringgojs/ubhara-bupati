<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\LoggingTrait;

use App\Models\DesaToSekolah;
use App\Models\MuridSekolah;
use App\Models\GuruSekolah;
use App\Models\Sekolah;
use DB;

class GraphKecamatanPendidikanController extends Controller
{
    //
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }
    
	public function cards($kecamatan_id){
		$tipe_sekolah = ['tk', 'sd', 'smp', 'sma'];
		$gurus = [];
		$murids = [];
		$sekolahs = [];
		foreach($tipe_sekolah as $ts){
			$sekolah = DesaToSekolah::leftJoin('sekolahs', 'desa_to_sekolahs.sekolah_id', 'sekolahs.id')
				->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
				->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
				->where('desas.kecamatan_id', $kecamatan_id)
				->where('jenis_sekolahs.jenjang', $ts)->count();
			$murid = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
				->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
				->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
				->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
				->where('desas.kecamatan_id', $kecamatan_id)
				->where('murid_sekolahs.tahun_ajaran', date('Y'))
				->where('jenis_sekolahs.jenjang', $ts)->sum('murid_sekolahs.jumlah');
			$guru = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
				->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
				->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
				->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
				->where('desas.kecamatan_id', $kecamatan_id)
				->where('jenis_sekolahs.jenjang', $ts)->count();
			array_push($sekolahs, [$ts => $sekolah]);
			array_push($murids, [$ts => $murid]);
			array_push($gurus, [$ts => $guru]);
		}
		return ['gurus' => $gurus, 'murids' => $murids, 'sekolahs' => $sekolahs];
	}

	public function jumlahsiswaperkelas(){
		$query = "SELECT murid_sekolahs.kelas as kelas, sum(murid_sekolahs.jumlah) as sum_jumlah
            FROM murid_sekolahs
            LEFT JOIN sekolahs ON murid_sekolahs.sekolah_id = sekolahs.id
            LEFT JOIN desa_to_sekolahs ON sekolahs.id = desa_to_sekolahs.sekolah_id
            LEFT JOIN desas ON desa_to_sekolahs.desa_id = desas.id
            WHERE murid_sekolahs.tahun_ajaran = ".date('Y')." 
            GROUP BY murid_sekolahs.kelas";
        $select = DB::select($query);
		$colnames = [];
		$values = [];
		foreach($select as $s){
			array_push($colnames, $s->kelas);
			array_push($values, $s->sum_jumlah);
		}
		return ['colnames' => $colnames, 'values' => $values];
	}

	public function guruvsmurid($kecamatan_id){
		$tipe_sekolah = ['tk', 'sd', 'smp', 'sma'];
		$murids = [];
		$gurus = [];
		$perbandingans = [];
		foreach($tipe_sekolah as $ts){
			$murid = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
				->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
				->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
				->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
				->where('desas.kecamatan_id', $kecamatan_id)
				->where('jenis_sekolahs.jenjang', $ts)->sum('murid_sekolahs.jumlah');
			$guru = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
				->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
				->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
				->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
				->where('desas.kecamatan_id', $kecamatan_id)
				->where('jenis_sekolahs.jenjang', $ts)->count();
			array_push($murids, $murid);
			array_push($gurus, $guru);
			$perbandingan = '';
			if ($murid > $guru){
				if ($guru == 0){
					$perbandingan = '~';
				} else {
					$perb = ceil($murid / $guru);
					$perbandingan = '1:'.$perb;
				}
			} else {
				if ($guru == 0){
					$perbandingan = '~';
				} else {
					$perb = ceil($guru / $murid);
					$perbandingan = '1:'.$perb;
				}
			}
			array_push($perbandingans, $perbandingan);
		}
		return $perbandingans;
	}

	public function negerivsswasta($kecamatan_id){
		$sekolah_negeri = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
			->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
			->where('desas.kecamatan_id',$kecamatan_id)
			->where('jenis_sekolahs.negeri', 1)->count();
		$sekolah_swasta = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
			->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
			->where('desas.kecamatan_id',$kecamatan_id)
			->where('jenis_sekolahs.negeri', 0)->count();
		
		$murid_negeri = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
			->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
			->where('desas.kecamatan_id',$kecamatan_id)
			->where('jenis_sekolahs.negeri', 1)->sum('murid_sekolahs.jumlah');
		$murid_swasta = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
			->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
			->where('desas.kecamatan_id',$kecamatan_id)
			->where('jenis_sekolahs.negeri', 0)->sum('murid_sekolahs.jumlah');

		$guru_negeri = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
			->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
			->where('desas.kecamatan_id',$kecamatan_id)
			->where('jenis_sekolahs.negeri', 1)->count();
		$guru_swasta = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
			->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
			->where('desas.kecamatan_id',$kecamatan_id)
			->where('jenis_sekolahs.negeri', 0)->count();
		
		return [[$sekolah_negeri, $sekolah_swasta], [$murid_negeri, $murid_swasta], [$guru_negeri, $guru_swasta]];
	}

	public function listsekolah($kecamatan_id){
		$jenjang = ['sd', 'smp', 'sma', 'tk'];
		$sekolahs = [];
		foreach($jenjang as $j){
			$listSekolah = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
				->leftJoin('desa_to_sekolahs', 'sekolahs.id', 'desa_to_sekolahs.sekolah_id')
				->leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
				->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
				->where('desas.kecamatan_id', $kecamatan_id)
				->where('jenis_sekolahs.jenjang', $j)
				->select('sekolahs.nama', 'desas.name as desa', 'kecamatans.name as kecamatan','jenis_sekolahs.nama as jenis_sekolah')
				->get();
			$sekolah = [];
			foreach($listSekolah as $ls){
				array_push($sekolah, [$ls->nama, $ls->desa, $ls->kecamatan, $ls->jenis_sekolah]);
			}
			$sekolahs[$j] = $sekolah;
		}
		return $sekolahs;
	}
}
