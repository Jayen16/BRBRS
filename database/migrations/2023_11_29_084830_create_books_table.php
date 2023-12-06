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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('location_rack')->nullable();
            $table->string('status')->nullable();
            $table->string('isbn')->nullable();
            $table->string('category')->nullable();
            $table->string('condition')->nullable();
            $table->string('book_image')->nullable();
            $table->string('edition')->nullable();
            $table->string('publisher')->nullable();
            $table->string('copyright_year')->nullable();
            $table->string('accession_number')->nullable();
            $table->string('description')->nullable();
           
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
