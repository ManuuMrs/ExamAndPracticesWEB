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
        Schema::create('namevg', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('producer')->unique();
            $table->string('owner')->unique();
            $table->timestamp('releasedata')->nullable();
            $table->boolean('digital');
            $table->string('weight');
            $table->rememberToken();
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};