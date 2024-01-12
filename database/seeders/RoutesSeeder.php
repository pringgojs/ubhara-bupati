<?php

namespace Database\Seeders;

use App\Models\Credential;
use App\Models\CredentialToRoute;
use App\Models\Menu;
use App\Models\Route;
use App\Models\RoutingGroup;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['name' => 'EDM: Perencanaan dan Penganggaran', 'menus' => 
                [['name' => 'Indikator Kinerja Utama', 'routes' => 
                    ['edm.renc-ang.iku','edm.renc-ang.kondisi','edm.renc-ang.kecamatan','edm.renc-ang.desa']
                ],
                ['name' => 'Penganggaran', 'routes' => 
                    ['edm.renc-ang.anggaran','edm.renc-ang.kondisi','edm.renc-ang.kecamatan','edm.renc-ang.desa']
                ]]
            ],
            ['name' => 'EDM: Infrastruktur', 'menus' => 
                [['name' => 'Dashboard Jalan', 'routes' => 
                    ['edm.infrastruktur-jalan.index','edm.infrastruktur-jalan.kondisi','edm.infrastruktur-jalan.kecamatan','edm.infrastruktur-jalan.desa']
                ],
                ['name' => 'Dashboard Jembatan', 'routes' => 
                    ['edm.infrastruktur-jembatan.index','edm.infrastruktur-jembatan.kondisi','edm.infrastruktur-jembatan.kecamatan','edm.infrastruktur-jembatan.desa']
                ]]
            ],
            ['name' => 'EDM: Pariwisata', 'menus' => 
                [['name' => 'Wisata', 'routes' => 
                    ['edm.wisata.index','edm.wisata.detail']
                ]]
            ],
            ['name' => 'EDM: Pendidikan', 'menus' => 
                [['name' => 'Pendidikan', 'routes' => 
                    ['edm.pendidikan.index']
                ]]
            ],
            ['name' => 'EDM: Pasar', 'menus' => 
                [['name' => 'Pasar', 'routes' => 
                    ['edm.pasar.index']
                ]]
            ],
            ['name' => 'EDM: Pertanian', 'menus' => 
                [['name' => 'Pertanian', 'routes' => 
                    ['edm.pertanian.index']
                ]]
            ],
            ['name' => 'EDM: Kesehatan', 'menus' => 
                [['name' => 'Kesehatan', 'routes' => 
                    ['edm.kesehatan.index']
                ]]
            ],
            ['name' => 'Master Data Kewilayahan', 'menus' => 
                [['name' => 'Kecamatan', 'routes' => 
                    ['operator.kecamatan.index','operator.kecamatan.store','operator.kecamatan.edit','operator.kecamatan.update','operator.kecamatan.destroy']
                ],
                ['name' => 'Desa', 'routes' => 
                    ['operator.desa.index','operator.desa.store','operator.desa.edit','operator.desa.update','operator.desa.destroy']
                ]]
            ],
            ['name' => 'Master Data Infrastruktur', 'menus' => 
                [['name' => 'Infrastruktur Jalan' , 'routes' => 
                    ['operator.infrastruktur-jalan.index','operator.infrastruktur-jalan.store','operator.infrastruktur-jalan.edit','operator.infrastruktur-jalan.update','operator.infrastruktur-jalan.destroy']
                ],
                ['name' => 'Infrastruktur Jembatan' , 'routes' => 
                    ['operator.infrastruktur-jembatan.index','operator.infrastruktur-jembatan.store','operator.infrastruktur-jembatan.edit','operator.infrastruktur-jembatan.update','operator.infrastruktur-jembatan.destroy']
                ],
                ['name' => 'Update Status Jalan', 'routes' => 
                    ['operator.status-jalan.index','operator.status-jalan.store','operator.status-jalan.edit','operator.status-jalan.update','operator.status-jalan.destroy'],
                ],
                ['name' => 'Update Status Jembatan', 'routes' => 
                    ['operator.status-jembatan.index','operator.status-jembatan.store','operator.status-jembatan.edit','operator.status-jembatan.update','operator.status-jembatan.destroy'],
                ],
                ['name' => 'Bulk Insert Jalan', 'routes' => 
                    ['operator.infrastruktur-jalan.bulkpage','operator.infrastruktur-jalan.bulkinsert', 'operator.infrastruktur-jalan.bulkvalidate', 'operator.infrastruktur-jalan.rollback']
                ], 
                ['name' => 'Bulk Insert Jembatan', 'routes' => 
                    ['operator.infrastruktur-jembatan.bulkpage','operator.infrastruktur-jembatan.bulkinsert', 'operator.infrastruktur-jembatan.bulkvalidate', 'operator.infrastruktur-jembatan.rollback']
                ]
                ]
            ],
            ['name' => 'Master Data Pariwisata', 'menus' => 
                [['name' => 'Pariwisata', 'routes' => 
                    ['operator.wisata.index','operator.wisata.store','operator.wisata.edit','operator.wisata.update','operator.wisata.destroy']
                ],
                ['name' => 'Pengunjung Wisata', 'routes' => 
                    ['operator.pengunjung-wisata.index','operator.pengunjung-wisata.store','operator.pengunjung-wisata.edit','operator.pengunjung-wisata.update','operator.pengunjung-wisata.destroy']
                ]
                ]
            ],
            ['name' => 'Master Data Pendidikan', 'menus' => 
                [['name' => 'Sekolah', 'routes' => 
                    ['operator.sekolah.index','operator.sekolah.store','operator.sekolah.edit','operator.sekolah.update','operator.sekolah.destroy']
                ],
                ['name' => 'Guru', 'routes' => 
                    ['operator.guru.index','operator.guru.store','operator.guru.edit','operator.guru.update','operator.guru.destroy']
                ],
                ['name' => 'Murid', 'routes' => 
                    ['operator.murid.index','operator.murid.store','operator.murid.edit','operator.murid.update','operator.murid.destroy'],
                ],
                ['name' => 'Bulk Insert Sekolah', 'routes' => 
                    ['operator.sekolah.bulkpage','operator.sekolah.bulkinsert', 'operator.sekolah.bulkvalidate']
                ], 
                ['name' => 'Bulk Insert Guru', 'routes' => 
                    ['operator.guru.bulkpage','operator.guru.bulkinsert', 'operator.guru.bulkvalidate']
                ],
                ['name' => 'Bulk Insert Murid', 'routes' => 
                    ['operator.murid.bulkpage','operator.murid.bulkinsert', 'operator.murid.bulkvalidate']
                ]],
            ],
            ['name' => 'Master Data Anggaran', 'menus' => 
                [['name' => 'Anggaran', 'routes' => 
                    ['operator.anggaran.index']
                ]]
            ],
            ['name' => 'Master Data Pasar', 'menus' => 
                [['name' => 'Pasar', 'routes' => 
                    ['operator.pasar.index','operator.pasar.store','operator.pasar.edit','operator.pasar.update','operator.pasar.destroy']
                ],
                ['name' => 'Komoditas Pasar', 'routes' => 
                    ['operator.komoditas-pasar.index','operator.komoditas-pasar.store','operator.komoditas-pasar.edit','operator.komoditas-pasar.update','operator.komoditas-pasar.destroy']
                ]]
            ],
            ['name' => 'Master Data Pertanian', 'menus' => 
                [['name' => 'Kelompok Tani', 'routes' => 
                    ['operator.kelompok-masyarakat-tani.index','operator.kelompok-masyarakat-tani.store','operator.kelompok-masyarakat-tani.edit','operator.kelompok-masyarakat-tani.update','operator.kelompok-masyarakat-tani.destroy']
                ],
                ['name' => 'Komoditas', 'routes' => 
                    ['operator.komoditas.index','operator.komoditas.store','operator.komoditas.edit','operator.komoditas.update','operator.komoditas.destroy']
                ],
                ['name' => 'Bulk Insert Kelompok Tani', 'routes' => 
                    ['operator.kelompok-masyarakat-tani.bulkpage','operator.kelompok-masyarakat-tani.bulkinsert','operator.kelompok-masyarakat-tani.bulkvalidate']
                ]]
            ],
            ['name' => 'Master Data Kesehatan', 'menus' => 
                [['name' => 'Fasyankes', 'routes' => 
                    ['operator.kesehatan-fasyankes.index','operator.kesehatan-fasyankes.store','operator.kesehatan-fasyankes.edit','operator.kesehatan-fasyankes.update','operator.kesehatan-fasyankes.destroy']
                ],
                ['name' => 'Poli', 'routes' => 
                    ['operator.kesehatan-poli.index','operator.kesehatan-poli.store','operator.kesehatan-poli.edit','operator.kesehatan-poli.update','operator.kesehatan-poli.destroy']
                ],
                ['name' => 'Kunjungan Poli', 'routes' => 
                    ['operator.kunjungan-poli.index','operator.kunjungan-poli.store','operator.kunjungan-poli.edit','operator.kunjungan-poli.update','operator.kunjungan-poli.destroy']
                ],
                ['name' => 'Tenaga Kesehatan', 'routes' => 
                    ['operator.kesehatan-tenaga.index','operator.kesehatan-tenaga.store','operator.kesehatan-tenaga.edit','operator.kesehatan-tenaga.update','operator.kesehatan-tenaga.destroy']
                ],
                ['name' => 'Bulk Insert Nakes', 'routes' => 
                    ['operator.kesehatan-tenaga.bulkpage','operator.kesehatan-tenaga.bulkinsert','operator.kesehatan-tenaga.bulkvalidate']
                ],]
            ],
            ['name' => 'Master Indikator Kinerja', 'menus' => 
               [['name' => 'Indikator Kinerja', 'routes' => 
                    ['operator.iku.index','operator.iku.store','operator.iku.edit','operator.iku.update','operator.iku.destroy']
                ]]
            ],
            ['name' => 'Konfigurasi Credentials', 'menus' => 
               [['name' => 'Credentials', 'routes' => 
                    ['credential.user.index','credential.user.store','credential.user.edit','credential.user.update','credential.user.destroy']
                ], 
                ['name' => 'Route Management', 'routes' => 
                    ['credential.route.index','credential.route.store','credential.route.edit','credential.route.update','credential.route.destroy']
                ],
                ['name' => 'Route Management', 'routes' => 
                    ['credential.routing-group.index','credential.routing-group.store','credential.routing-group.edit','credential.routing-group.update','credential.routing-group.destroy']
                ],
                ['name' => 'Logging Management', 'routes' => 
                    ['credential.logging.index','credential.logging.store','credential.logging.edit','credential.logging.update','credential.logging.destroy']
                ]]
            ],
        ];
        $noGroups = ['edm.kecamatan.index', 'edm.desa.index','operator.anggota-pokmas.index','operator.anggota-pokmas.store','operator.anggota-pokmas.edit','operator.anggota-pokmas.update','operator.anggota-pokmas.destroy'];
        
        foreach($groups as $group){
            $rg = RoutingGroup::insertNewData($group['name'], 0);
            foreach($group['menus'] as $menu){
                $m = Menu::insertNewData($rg->id, $menu['name'], null, 0, 0);
                $first = true;
                foreach($menu['routes'] as $route){
                    $r = Route::insertNewData($m->id, $route, 0);
                    if ($first){
                        $m->index = $route;
                        $m->save();
                        $first = false;
                    }
                }
            }
        }

        foreach($noGroups as $ng){
            $r = Route::insertNewData(null, $ng, false);
        }

        RoutingGroup::whereNotNull('id')->update(['deleteable' => false]);
        Menu::whereNotNull('id')->update(['deleteable' => false]);
        Route::whereNotNull('id')->update(['deleteable' => false]);


        $credential = Credential::first();
        $routes = Route::all();
        foreach($routes as $route){
            CredentialToRoute::insertNewData($credential, $route);
        }

        $credentials = Credential::all();
        foreach($credentials as $cred){
            User::insertNewData($cred);
        }
    }
}
