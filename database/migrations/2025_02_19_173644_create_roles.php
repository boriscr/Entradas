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
        $role = Role::create(['name' => 'Admin']);
        $user=User::find(1);
        $user->assignRole($role);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
