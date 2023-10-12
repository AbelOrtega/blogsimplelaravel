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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('comentario',250);

            $table->unsignedBigInteger ('users_id') ->nullable();
            $table->unsignedBigInteger ('posteos_id') ->nullable();
    
            $table->foreign('users_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('posteos_id')->references('id')->on('posteos')->onDelete('set null');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
