<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('gerencias', function (Blueprint $table) {
            $table->id();
            $table->integer('id_empresa')->default(1);
            $table->string('description')->nullable();
            $table->string('name');
            $table->boolean('is_active')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('gerencias');
    }
};
