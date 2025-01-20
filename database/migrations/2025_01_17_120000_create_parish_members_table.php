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
        Schema::create('parish_members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('Commissioned')->nullable();
            $table->string('CommissionNo')->nullable();
            $table->timestamp('DateJoin')->nullable();
            $table->string('photo')->nullable();
            $table->string('IdNo')->nullable();
            $table->string('CellNo')->nullable();
            $table->string('email')->nullable();
            $table->string('Status')->nullable();
            $table->foreignId('parish_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parish_members');
    }
};