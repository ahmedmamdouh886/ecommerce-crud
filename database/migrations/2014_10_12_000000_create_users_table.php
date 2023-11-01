<?php

use App\Enum\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('username', 20)->unique();
            $table->string('avatar', 25)->default('avatar.png');
            // Assuming that the business requirements state that the user type must be normal by default when created.
            $table->enum('type', UserType::values());
            // Assuming that the business requirements state that the user must be active by default when created.
            $table->boolean('is_active')->default(true);
            $table->string('password', 100);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
