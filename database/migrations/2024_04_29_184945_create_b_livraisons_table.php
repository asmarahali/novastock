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
        Schema::create('b_livraisons', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->unsignedBigInteger('b_c_externe_id');

            $table->foreign('b_c_externe_id')->references('id')->on('b_c_externes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_livraisons');
    }
};
