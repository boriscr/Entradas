<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear el rol "Admin"
        $role = Role::create(['name' => 'Admin']);

        // Verificar si la tabla `users` está vacía
        if (User::count() === 0) {
            // Crear un usuario administrador por defecto
            $user = User::create([
                'name' => 'Admin',
                'surname' => 'Kredensir',
                'dni' => '99999999',
                'email' => 'boris@admin.com',
                'password' => Hash::make('borisadminB@1'), // Cambia 'password' por una contraseña segura
            ]);

            // Asignar el rol "Admin" al usuario creado
            $user->assignRole($role);
        } else {
            // Si ya existe algún usuario, buscar al usuario con el correo "boris@admin.com"
            $user = User::where('email', 'boris@admin.com')->first();

            // Si el usuario existe, asignarle el rol "Admin"
            if ($user) {
                $user->assignRole($role);
            }
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
