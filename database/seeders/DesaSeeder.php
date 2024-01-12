<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desas = [
            'babadan' => ['BABADAN', 'BARENG','CEKOK','GUPOLO','JAPAN','KADIPATEN','KERTOSARI','LEMBAH','NGUNUT','PATIHAN WETAN','POLOREJO','PONDOK','PURWOSARI','SUKOSARI','TRISONO' ],
            'badegan' => ['BADEGAN','BANDARALIM','BITING','DAYAKAN','KAPURAN','KARANGAN','KARANGJOHO','TANJUNGGUNUNG','TANJUNGREJO','WATUBONANG'], 
            'balong' => ['BAJANG','BALONG','BULAK','BULU KIDUL','DADAPAN','JALEN','KARANGAN','KARANGMOJO','KARANGPATIHAN','MUNENG','NGAMPEL','NGENDUT','NGRAKET','NGUMPUL','PANDAK','PURWOREJO','SEDARAT','SINGKIL','SUMBEREJO','TATUNG'], 
            'bungkal' => ['BANCAR','BEDIKULON','BEDIWETAN','BEKARE','BELANG','BUNGKAL','BUNGU','KALISAT','KETONGGO','KORIPAN','KUNTI','KUPUK','KWAJON','MUNGGU','NAMBAK','PADAS','PAGER','PELEM','SAMBILAWANG'], 
            'jambon' => ['BLEMBEM','BRINGINAN','BULU LOR','JAMBON','JONGGOL','KARANGLO  KIDUL','KREBET','MENANG','POKO','PULOSARI','SENDANG','SIDOHARJO','SRANDIL'], 
            'jenangan' => ['JENANGAN','JIMBE','KEMIRI','MRICAN','NGLAYANG','NGRUPIT','PANJENG','PARINGAN','PINTU','PLALANGAN','SEDAH','SEMANDING','SETONO','SINGOSAREN','SRATEN','TANJUNGSARI','WATES'], 
            'jetis' => ['COPER','JETIS','JOSARI','KARANGGEBANG','KRADENAN','KUTU KULON','KUTU WETAN','MOJOMATI','MOJOREJO','NGASINAN','TEGALSARI','TURI','WINONG','WONOKETRO'], 
            'kauman' => [
                'BRINGIN','CARAT','CILUK','GABEL','KAUMAN','MARON','NGLARANGAN','NGRANDU','NONGKODONO','PENGKOL','PLOSOJENAR','SEMANDING','SOMOROTO','SUKOSARI','TEGALOMBO','TOSANAN',
            ], 
            'mlarak' => [
                'BAJANG','CANDI','GANDU','GONTOR','JABUNG','JORESAN','KAPONAN','MLARAK','NGLUMPANG','NGRUKEM','SERANGAN','SIWALAN','SUREN','TOTOKAN','TUGU',
            ], 
            'ngebel' => [
                'GONDOWIDO','NGEBEL','NGROGUNG','PUPUS','SAHANG','SEMPU','TALUN','WAGIR LOR',
            ], 
            'ngrayun' => [
                'BAOSAN KIDUL','BAOSAN LOR','BINADE','CEPOKO','GEDANGAN','MRAYAN','NGRAYUN','SELUR','SENDANG','TEMON','WONODADI'], 
            'ponorogo' => [
                'BANGUNSARI','BANYUDONO','BEDURI','BROTONEGARAN','COKROMENGGALAN','JINGGLONG','KAUMAN','KENITEN','KEPATIHAN','MANGKUJAYAN','NOLOGATEN','PAJU','PAKUNDEN','PINGGIRSARI','PURBOSUMAN','SURODIKRAMAN','TAMANARUM','TAMBAKBAYAN','TONATAN',
            ], 
            'pudak' => ['BANJAREJO','BARENG','KRISIK','PUDAK KULON','PUDAK WETAN','TAMBANG'], 
            'pulung' => [
                'BANARAN','BEDRUG','BEKIRING','KARANGPATIHAN','KESUGIHAN','MUNGGUNG','PATIK','PLUNTURAN','POMAHAN','PULUNG','PULUNG MERDIKO','SERAG','SIDOHARJO','SINGGAHAN','TEGALREJO','WAGIR KIDUL','WAYANG','WOTAN'    
            ], 
            'sambit' => [
                'BANCANGAN','BANGSALAN','BEDINGIN','BESUKI','BULU','CAMPUREJO','CAMPURSARI','GAJAH','JRAKAH','KEMUNING','MAGUWAN','NGADISANAN','NGLEWAN','SAMBIT','WILANGAN','WRINGINANOM'
            ],
            'sampung' => [
                'CARANGREJO','GELANGKULON','GLINGGANG','JENANGAN','KARANGWALUH','KUNTI','NGLURUP','PAGERUKIR','POHIJO','RINGINPUTIH','SAMPUNG','TULUNG'
            ],
            'sawoo' => [
                'BONDRANG','BRAHU','GROGOL','KETRO','KORI','NGINDENG','PANGKAL','PRAYUNGAN','SAWOO','SRITI','TEMON','TEMPURAN','TUMPAK PELEM','TUMPUK'
            ], 
            'siman' => [
                'BETON','BRAHU','DEMANGAN','JARAK','KEPUHRUBUH','MADUSARI','MANGUNSUMAN','MANUK','NGABAR','PATIHAN KIDUL','PIJERAN','RONOSENTANAN','RONOWIJAYAN','SAWUH','SEKARAN','SIMAN','TAJUG','TRANJANG'
            ],
            'slahung' => [
                'BROTO','CALUK','CRABAK','DURI','GALAK','GOMBANG','GUNDIK','JANTI','JEBENG','KAMBENG','MENGGARE','MOJOPITU','NAILAN','NGILO-ILO','NGLONING','PLANCUNGAN','SENEPO','SIMO','SLAHUNG','TRUNENG','TUGUREJO','WATES'
            ], 
            'sooko' => [
                'BEDOHO','JURUG','KLEPU','NGADIROJO','SOOKO','SURU'
            ],
            'sukorejo' => [
                'BANGUNREJO','GANDUKEPUH','GEGERAN','GELANG LOR','GOLAN','KALIMALANG','KARANGLO  LOR','KEDUNGBANTENG','KRANGGAN','LENGKONG','MOROSARI','NAMBANGREJO','NAMPAN','PRAJEGAN','SERANGAN','SIDOREJO','SRAGI','SUKOREJO'
                ]
        ];

        foreach ($desas as $kecamatan => $desaDiKecamatan) {
            $kecamatan = DB::table('kecamatans')->where('name', $kecamatan)->first();
            if (!empty($kecamatan)){
                foreach($desaDiKecamatan as $desa){
                    DB::table('desas')->insert(['name' => $desa, 'kecamatan_id' => $kecamatan->id]);
                }
            }
        }
    }
}
