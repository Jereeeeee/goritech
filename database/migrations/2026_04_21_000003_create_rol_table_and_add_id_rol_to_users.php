<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_rol')->primary();
            $table->string('nombre', 50)->unique();
            $table->timestamps();
        });

        DB::table('rol')->insert([
            [
                'id_rol' => 1,
                'nombre' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_rol' => 2,
                'nombre' => 'usuario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_rol')->default(2)->after('id');
            $table->foreign('id_rol')->references('id_rol')->on('rol');
        });

        DB::table('users')->whereNull('id_rol')->update(['id_rol' => 2]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_rol']);
            $table->dropColumn('id_rol');
        });

        Schema::dropIfExists('rol');
    }
};
