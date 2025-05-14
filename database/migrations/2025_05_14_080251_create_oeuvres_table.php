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
        Schema::create('oeuvres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('artiste');
            $table->integer('année');
            $table->decimal('prix_estime', 10, 2);
            $table->date('date_acquisition');
            $table->text('description');
            $table->string('image_path');
            $table->foreignId('categorie_id')->constrained();
            $table->timestamps();
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oeuvres');
    }
};
