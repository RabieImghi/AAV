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
        Schema::create('voiteurs', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('marque', 255)->nullable();
            $table->string('modele', 255)->nullable();
            $table->integer('annee')->nullable();
            $table->integer('kilometrage')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->integer('puissance')->nullable();
            $table->string('motorisation', 255)->nullable();
            $table->string('carburant', 255)->nullable();
            $table->text('options')->nullable();
            $table->engine = 'InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voiteurs');
    }
};
