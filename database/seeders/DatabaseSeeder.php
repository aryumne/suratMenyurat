<?php

namespace Database\Seeders;

use App\Models\Disposition;
use App\Models\Inbox;
use App\Models\Jabatan;
use App\Models\JenisSurat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Aryum N. Erlinadi',
            'email' => 'aryumsf@gmail.com',
            'password' => bcrypt('qweasdzxc'),
            'nip' => '123456789123456781',
            'role_id' => 1,
            'jabatan_id' => 1,
            'path_foto' => '',
        ]);
        User::create([
            'name' => 'Ippang',
            'email' => 'ippang@gmail.com',
            'password' => bcrypt('qweasdzxc'),
            'nip' => '123456789123456782',
            'role_id' => 2,
            'jabatan_id' => 2,
            'path_foto' => '',
        ]);
        User::create([
            'name' => 'Fendi',
            'email' => 'fendi@gmail.com',
            'password' => bcrypt('qweasdzxc'),
            'nip' => '123456789123456783',
            'role_id' => 3,
            'jabatan_id' => 3,
            'path_foto' => '',
        ]);
        User::create([
            'name' => 'Sitti',
            'email' => 'sitti@gmail.com',
            'password' => bcrypt('qweasdzxc'),
            'nip' => '123456789123456784',
            'role_id' => 4,
            'jabatan_id' => 4,
            'path_foto' => '',
        ]);
        User::create([
            'name' => 'Raihan',
            'email' => 'raihan@gmail.com',
            'password' => bcrypt('qweasdzxc'),
            'nip' => '123456789123456785',
            'role_id' => 5,
            'jabatan_id' => 5,
            'path_foto' => '',
        ]);

        Role::create([
            'role_name' => 'Super Admin',
        ]);
        Role::create([
            'role_name' => 'Admin',
        ]);
        Role::create([
            'role_name' => 'Pengelola',
        ]);
        Role::create([
            'role_name' => 'Kepala Kantor',
        ]);
        Role::create([
            'role_name' => 'Pegawai',
        ]);

        Jabatan::create([
            'jabatan_name' => 'Super Admin',
        ]);
        Jabatan::create([
            'jabatan_name' => 'Pengelola Administrasi',
        ]);
        Jabatan::create([
            'jabatan_name' => 'Kepala Administrasi',
        ]);
        Jabatan::create([
            'jabatan_name' => 'Kepala Kantor',
        ]);
        Jabatan::create([
            'jabatan_name' => 'Pegawai kantor',
        ]);

        JenisSurat::create([
            'jenis_surat_name' => 'Surat Permohonan',
        ]);
        JenisSurat::create([
            'jenis_surat_name' => 'Surat Keputusan',
        ]);
        JenisSurat::create([
            'jenis_surat_name' => 'Surat Undangan',
        ]);
        JenisSurat::create([
            'jenis_surat_name' => 'Surat Perintah',
        ]);
        JenisSurat::create([
            'jenis_surat_name' => 'Surat Pengantar',
        ]);
        JenisSurat::create([
            'jenis_surat_name' => 'Surat Permohonan',
        ]);
        JenisSurat::create([
            'jenis_surat_name' => 'Surat Permohonan',
        ]);
        JenisSurat::create([
            'jenis_surat_name' => 'Surat Edaran',
        ]);

        Inbox::create([
            'nomor_surat' => '01/SP/ABCD/I/2021',
            'perihal' => 'Surat permohonan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '01/SU/ABCD/IV/2021',
            'perihal' => 'Surat Undangan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '02/SP/ABCD/I/2021',
            'perihal' => 'Surat permohonan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '03/SP/ABCD/I/2021',
            'perihal' => 'Surat permohonan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '01/SK/ABCD/I/2021',
            'perihal' => 'Surat Keputusan',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '01/SP/ABCD/X/2021',
            'perihal' => 'Surat permohonan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '02/SU/ABCD/II/2021',
            'perihal' => 'Surat Undangan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '03/SP/ABCD/C/2021',
            'perihal' => 'Surat permohonan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '04/SP/ABCD/VII/2021',
            'perihal' => 'Surat permohonan untuk',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Inbox::create([
            'nomor_surat' => '01/SK/ABCD/V/2021',
            'perihal' => 'Surat Keputusan',
            'tipe_surat' => 1,
            'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit',
            'tanggal_masuk' => date('y-m-d'),
            'edit_status' => 1,
            'jenis_surat_id' => 1,
            'user_id' => 1,
        ]);
        Disposition::create([
            'inbox_id' => 1,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 2,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 3,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 4,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 5,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 6,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 7,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 8,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 9,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
        Disposition::create([
            'inbox_id' => 10,
            'pesan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elitn',
            'user_id_from' => 1,
            'user_id_to' => 2,
        ]);
    }
}
