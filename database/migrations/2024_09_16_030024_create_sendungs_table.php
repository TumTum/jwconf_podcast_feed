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
        Schema::create('sendungs', function (Blueprint $table) {
            $table->id();
            $table->string('checksum', 32)->unique();
            $table->date('pubdate');
            $table->text('thema');
            $table->text('sender');
            $table->text('url');
            $table->string('type', 15);
            $table->integer('length');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sendungs');
    }
};
