<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear el rol "Admin"
        $role = Role::create(['name' => 'Admin']);
    
        // Buscar al usuario por su correo electrónico
        $user = User::where('email', 'boris@admin.com')->first();
    
        // Si el usuario existe, asignarle el rol "Admin"
        if ($user) {
            $user->assignRole($role);
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
