<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Sekolah;
use App\Models\MuridSekolah;
use App\Models\GuruSekolah;
use App\Traits\LoggingTrait;

class GraphPendidikanController extends Controller
{
	use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }
    
	public function cards(){
		$sekolah_tk = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'tk')->count();
		$sekolah_sd = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sd')->count();
		$sekolah_smp = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'smp')->count();
		$sekolah_sma = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sma')->count();
		
		$murid_tk = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'tk')->sum('murid_sekolahs.jumlah');
		$murid_sd = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sd')->sum('murid_sekolahs.jumlah');
		$murid_smp = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'smp')->sum('murid_sekolahs.jumlah');
		$murid_sma = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sma')->sum('murid_sekolahs.jumlah');

		$guru_tk = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'tk')->count();
		$guru_sd = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sd')->count();
		$guru_smp = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'smp')->count();
		$guru_sma = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sma')->count();
        return ['tk' => [$sekolah_tk, $murid_tk, $guru_tk], 'sd' => [$sekolah_sd, $murid_sd, $guru_sd], 'smp' => [$sekolah_smp, $murid_smp, $guru_smp], 'sma' => [$sekolah_sma, $murid_sma, $guru_sma]];
		
	}

	public function jumlahsiswaperkelas(){
		$query = "SELECT murid_sekolahs.kelas as kelas, sum(murid_sekolahs.jumlah) as sum_jumlah
            FROM murid_sekolahs
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

	public function guruvsmurid(){
		$murid_tk = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'tk')->sum('murid_sekolahs.jumlah');
		$murid_sd = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sd')->sum('murid_sekolahs.jumlah');
		$murid_smp = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'smp')->sum('murid_sekolahs.jumlah');
		$murid_sma = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sma')->sum('murid_sekolahs.jumlah');

		$guru_tk = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'tk')->count();
		$guru_sd = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sd')->count();
		$guru_smp = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'smp')->count();
		$guru_sma = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.jenjang', 'sma')->count();

		$perbandingan_tk = '';
		if ($murid_tk > $guru_tk){
			if ($guru_tk == 0){
				$perbandingan_tk = '~';
			} else {
				$perb = ceil($murid_tk / $guru_tk);
				$perbandingan_tk = '1:'.$perb;
			}
		} else {
			if ($guru_tk == 0){
				$perbandingan_tk = '~';
			} else {
				$perb = ceil($guru_tk / $murid_tk);
				$perbandingan_tk = '1:'.$perb;
			}
		}

		$perbandingan_sd = '';
		if ($murid_sd > $guru_sd){
			if ($guru_sd == 0){
				$perbandingan_sd = '~';
			} else {
				$perb = ceil($murid_sd / $guru_sd);
				$perbandingan_sd = '1:'.$perb;
			}
		} else {
			if ($guru_sd == 0){
				$perbandingan_sd = '~';
			} else {
				$perb = ceil($guru_sd / $murid_sd);
				$perbandingan_sd = '1:'.$perb;
			}
		}

		$perbandingan_smp = '';
		if ($murid_smp > $guru_smp){
			if ($guru_smp == 0){
				$perbandingan_smp = '~';
			} else {
				$perb = ceil($murid_smp / $guru_smp);
				$perbandingan_smp = '1:'.$perb;
			}
		} else {
			if ($guru_smp == 0){
				$perbandingan_smp = '~';
			} else {
				$perb = ceil($guru_smp / $murid_smp);
				$perbandingan_smp = '1:'.$perb;
			}
		}

		$perbandingan_sma = '';
		if ($murid_sma > $guru_sma){
			if ($guru_sma == 0){
				$perbandingan_sma = '~';
			} else {
				$perb = ceil($murid_sma / $guru_sma);
				$perbandingan_sma = '1:'.$perb;
			}
		} else {
			if ($guru_sma == 0){
				$perbandingan_sma = '~';
			} else {
				$perb = ceil($guru_sma / $murid_sma);
				$perbandingan_sma = '1:'.$perb;
			}
		}

		return [$perbandingan_tk, $perbandingan_sd, $perbandingan_smp, $perbandingan_sma];
	}

	public function negerivsswasta(){
		$sekolah_negeri = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.negeri', 1)->count();
		$sekolah_swasta = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.negeri', 0)->count();
		
		$murid_negeri = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.negeri', 1)->sum('murid_sekolahs.jumlah');
		$murid_swasta = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.negeri', 0)->sum('murid_sekolahs.jumlah');

		$guru_negeri = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.negeri', 1)->count();
		$guru_swasta = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
			->leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
			->where('jenis_sekolahs.negeri', 0)->count();
		
		return [[$sekolah_negeri, $sekolah_swasta], [$murid_negeri, $murid_swasta], [$guru_negeri, $guru_swasta]];
	}

	public function listsekolah(){

	}
}
