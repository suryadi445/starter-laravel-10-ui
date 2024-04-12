<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navigation_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('navigation_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            // Menetapkan alias untuk kolom 'id' di tabel 'navigations' dan 'roles'
            $table->foreign('navigation_id')->references('id')->on('navigations')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_role');
    }
};
