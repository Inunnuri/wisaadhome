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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users');
            //nyambung ke category
            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->onDelete('set null');
            $table->foreignId('jenis_id')
            ->nullable()
            ->constrained('jenis')
            ->onDelete('set null');
            $table->string('nama'); 
            $table->string('price')->nullable();
            $table->string('alamat');
            $table->text('description');
            $table->string('post_photo')->default('default.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
