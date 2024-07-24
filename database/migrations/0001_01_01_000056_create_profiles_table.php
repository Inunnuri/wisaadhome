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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('country')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('about')->nullable();
            //profile_photo
            $table->string('profile_photo')->default('default.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
