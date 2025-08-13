<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_bulk::action","view_any_bulk::action","create_bulk::action","update_bulk::action","restore_bulk::action","restore_any_bulk::action","replicate_bulk::action","reorder_bulk::action","delete_bulk::action","delete_any_bulk::action","force_delete_bulk::action","force_delete_any_bulk::action","view_dokumen::sertifikat","view_any_dokumen::sertifikat","create_dokumen::sertifikat","update_dokumen::sertifikat","restore_dokumen::sertifikat","restore_any_dokumen::sertifikat","replicate_dokumen::sertifikat","reorder_dokumen::sertifikat","delete_dokumen::sertifikat","delete_any_dokumen::sertifikat","force_delete_dokumen::sertifikat","force_delete_any_dokumen::sertifikat","view_mahasiswa","view_any_mahasiswa","create_mahasiswa","update_mahasiswa","restore_mahasiswa","restore_any_mahasiswa","replicate_mahasiswa","reorder_mahasiswa","delete_mahasiswa","delete_any_mahasiswa","force_delete_mahasiswa","force_delete_any_mahasiswa","view_module::kegiatan::kegiatan::acara","view_any_module::kegiatan::kegiatan::acara","create_module::kegiatan::kegiatan::acara","update_module::kegiatan::kegiatan::acara","restore_module::kegiatan::kegiatan::acara","restore_any_module::kegiatan::kegiatan::acara","replicate_module::kegiatan::kegiatan::acara","reorder_module::kegiatan::kegiatan::acara","delete_module::kegiatan::kegiatan::acara","delete_any_module::kegiatan::kegiatan::acara","force_delete_module::kegiatan::kegiatan::acara","force_delete_any_module::kegiatan::kegiatan::acara","view_module::kegiatan::kehadiran::kegiatan","view_any_module::kegiatan::kehadiran::kegiatan","create_module::kegiatan::kehadiran::kegiatan","update_module::kegiatan::kehadiran::kegiatan","restore_module::kegiatan::kehadiran::kegiatan","restore_any_module::kegiatan::kehadiran::kegiatan","replicate_module::kegiatan::kehadiran::kegiatan","reorder_module::kegiatan::kehadiran::kegiatan","delete_module::kegiatan::kehadiran::kegiatan","delete_any_module::kegiatan::kehadiran::kegiatan","force_delete_module::kegiatan::kehadiran::kegiatan","force_delete_any_module::kegiatan::kehadiran::kegiatan","view_module::kegiatan::pembayaran::kegiatan","view_any_module::kegiatan::pembayaran::kegiatan","create_module::kegiatan::pembayaran::kegiatan","update_module::kegiatan::pembayaran::kegiatan","restore_module::kegiatan::pembayaran::kegiatan","restore_any_module::kegiatan::pembayaran::kegiatan","replicate_module::kegiatan::pembayaran::kegiatan","reorder_module::kegiatan::pembayaran::kegiatan","delete_module::kegiatan::pembayaran::kegiatan","delete_any_module::kegiatan::pembayaran::kegiatan","force_delete_module::kegiatan::pembayaran::kegiatan","force_delete_any_module::kegiatan::pembayaran::kegiatan","view_module::mabim::kategori::mabim","view_any_module::mabim::kategori::mabim","create_module::mabim::kategori::mabim","update_module::mabim::kategori::mabim","restore_module::mabim::kategori::mabim","restore_any_module::mabim::kategori::mabim","replicate_module::mabim::kategori::mabim","reorder_module::mabim::kategori::mabim","delete_module::mabim::kategori::mabim","delete_any_module::mabim::kategori::mabim","force_delete_module::mabim::kategori::mabim","force_delete_any_module::mabim::kategori::mabim","view_module::mabim::kehadiran::mabim","view_any_module::mabim::kehadiran::mabim","create_module::mabim::kehadiran::mabim","update_module::mabim::kehadiran::mabim","restore_module::mabim::kehadiran::mabim","restore_any_module::mabim::kehadiran::mabim","replicate_module::mabim::kehadiran::mabim","reorder_module::mabim::kehadiran::mabim","delete_module::mabim::kehadiran::mabim","delete_any_module::mabim::kehadiran::mabim","force_delete_module::mabim::kehadiran::mabim","force_delete_any_module::mabim::kehadiran::mabim","view_module::mabim::mabim","view_any_module::mabim::mabim","create_module::mabim::mabim","update_module::mabim::mabim","restore_module::mabim::mabim","restore_any_module::mabim::mabim","replicate_module::mabim::mabim","reorder_module::mabim::mabim","delete_module::mabim::mabim","delete_any_module::mabim::mabim","force_delete_module::mabim::mabim","force_delete_any_module::mabim::mabim","view_module::mabim::peserta::mabim","view_any_module::mabim::peserta::mabim","create_module::mabim::peserta::mabim","update_module::mabim::peserta::mabim","restore_module::mabim::peserta::mabim","restore_any_module::mabim::peserta::mabim","replicate_module::mabim::peserta::mabim","reorder_module::mabim::peserta::mabim","delete_module::mabim::peserta::mabim","delete_any_module::mabim::peserta::mabim","force_delete_module::mabim::peserta::mabim","force_delete_any_module::mabim::peserta::mabim","view_module::makrab::kehadiran::makrab","view_any_module::makrab::kehadiran::makrab","create_module::makrab::kehadiran::makrab","update_module::makrab::kehadiran::makrab","restore_module::makrab::kehadiran::makrab","restore_any_module::makrab::kehadiran::makrab","replicate_module::makrab::kehadiran::makrab","reorder_module::makrab::kehadiran::makrab","delete_module::makrab::kehadiran::makrab","delete_any_module::makrab::kehadiran::makrab","force_delete_module::makrab::kehadiran::makrab","force_delete_any_module::makrab::kehadiran::makrab","view_module::makrab::makrab","view_any_module::makrab::makrab","create_module::makrab::makrab","update_module::makrab::makrab","restore_module::makrab::makrab","restore_any_module::makrab::makrab","replicate_module::makrab::makrab","reorder_module::makrab::makrab","delete_module::makrab::makrab","delete_any_module::makrab::makrab","force_delete_module::makrab::makrab","force_delete_any_module::makrab::makrab","view_module::makrab::pembayaran::makrab","view_any_module::makrab::pembayaran::makrab","create_module::makrab::pembayaran::makrab","update_module::makrab::pembayaran::makrab","restore_module::makrab::pembayaran::makrab","restore_any_module::makrab::pembayaran::makrab","replicate_module::makrab::pembayaran::makrab","reorder_module::makrab::pembayaran::makrab","delete_module::makrab::pembayaran::makrab","delete_any_module::makrab::pembayaran::makrab","force_delete_module::makrab::pembayaran::makrab","force_delete_any_module::makrab::pembayaran::makrab","view_module::makrab::peserta::makrab","view_any_module::makrab::peserta::makrab","create_module::makrab::peserta::makrab","update_module::makrab::peserta::makrab","restore_module::makrab::peserta::makrab","restore_any_module::makrab::peserta::makrab","replicate_module::makrab::peserta::makrab","reorder_module::makrab::peserta::makrab","delete_module::makrab::peserta::makrab","delete_any_module::makrab::peserta::makrab","force_delete_module::makrab::peserta::makrab","force_delete_any_module::makrab::peserta::makrab","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
