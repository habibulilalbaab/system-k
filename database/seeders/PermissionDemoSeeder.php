<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ApprovedUser;
use App\Models\System;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view dashboard']);
                
        // gets all permissions via Gate::before rule
        $superadminRole = Role::create(['name' => 'super-admin']);

        //create roles and assign existing permissions
        $karyawanRole = Role::create(['name' => 'karyawan']);
        $karyawanRole->givePermissionTo('view dashboard');

        //assign first user as superadmin
        // create demo users
        $userAsSuperadmin = User::factory()->create([
            'name' => 'Development',
            'email' => 'dev@computing.id',
            'password' => bcrypt('12345678')
        ]);
        $userAsSuperadmin->assignRole($superadminRole);
        ApprovedUser::create([
            'user_id' => 1,
            'approved' => 1
        ]);
        System::create([
            'nama_koperasi' => 'Koperasi Karyawan\nBank Jatim Cabang Mojokerto',
            'ketua_koperasi' => 1,
            'finance_koperasi' => 1,
            'minimum_pinjaman' => 3000000,
            'bunga_pinjaman' => 1.5,
            'alamat_koperasi' => 'Jl. A. YANI No.20\nMOJOKERTO',
        ]);

        $userKaryawan = User::factory()->create([
            'name' => 'Karyawan',
            'email' => 'karyawan@computing.id',
            'password' => bcrypt('12345678')
        ]);
        $userKaryawan->assignRole($karyawanRole);
    }
}
