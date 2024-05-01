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
        Schema::create('b_c_externe_b_livraison', function (Blueprint $table) {
            $table->unsignedBigInteger('b_livraison_id');
            $table->unsignedBigInteger('b_c_externe_id');
            // Ajoutez d'autres colonnes au besoin
    
            // Clés étrangères
            $table->foreign('b_livraison_id')->references('id')->on('b_livraisons')->onDelete('cascade');
            $table->foreign('b_c_externe_id')->references('id')->on('b_c_externes')->onDelete('cascade');
    
            // Index unique pour empêcher les doublons
            $table->unique(['b_livraison_id', 'b_c_externe_id']);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_c_externe_b_livraison');
    }
};
