<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppSetupSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear rol super_admin si no existe
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        // 2. Crear usuario Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@cfvtechnology.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make(env('SUPER_ADMIN_PASSWORD', 'admin123')),
            ]
        );

        // 3. Asignar rol super_admin al usuario
        if (!$superAdmin->hasRole('super_admin')) {
            $superAdmin->assignRole($superAdminRole);
        }

        // 4. Crear datos por defecto en settings (si el helper existe)
        $settings = [
            'app_name'        => 'CFV Technology Panel',
            'support_email'   => 'support@cfvtechnology.com',
            'support_phone_1' => '+504 9800-2758',
            'support_phone_2' => null,
            'app_logo'        => 'assets/site_logo.png',
            'app_dark_logo'   => 'assets/site_dark_logo.png',
            'app_favicon'     => 'assets/site_favicon.ico',
        ];

        // 5. Insertar o actualizar en la tabla con un solo loop
        foreach ($settings as $key => $value) {
            DB::table('app_settings')->updateOrInsert(
                ['key' => $key],
                [
                    'id'         => Str::uuid()->toString(),
                    'tab'        => 'app',
                    'default'    => null,
                    'value'      => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 5. Mensajes en consola
        $this->command->info('Usuario Super Admin creado/actualizado con éxito.');
        $this->command->info('Configuración de aplicación cargada correctamente.');
    }
}
