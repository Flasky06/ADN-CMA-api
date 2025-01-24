<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parish_members', function (Blueprint $table) {
            $table->id('Regno');
            $table->string('Name')->nullable();
            $table->string('IdNo')->nullable();
            $table->string('DOB')->nullable();
            $table->string('ParishCode')->nullable();
            $table->string('StationCode')->nullable();
            $table->string('Commissioned')->nullable();
            $table->string('CommissionNo')->nullable();
            $table->string('Status')->nullable();
            $table->string('photo')->nullable();
            $table->string('LithurgyStatus')->nullable();
            $table->string('DeanCode')->nullable();
            $table->string('Rpt')->nullable();
            $table->string('CellNo')->nullable();
            $table->string('Bapt')->nullable();
            $table->string('Conf')->nullable();
            $table->string('Euc')->nullable();
            $table->string('Marr')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('parish_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parish_members');
    }
};