<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Eliminar usuarios con rol 'manager' antes de modificar el enum
        DB::table('users')->where('role', 'manager')->delete();
        // Cambiar el enum del campo 'role' para eliminar 'manager'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'sales', 'customer') NOT NULL DEFAULT 'customer'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restaurar el enum anterior si se revierte la migración
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'manager', 'sales', 'customer') NOT NULL DEFAULT 'customer'");
    }
}; 