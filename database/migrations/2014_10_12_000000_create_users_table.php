<?php

use App\Enums\Civility;
use App\Enums\Gender;
use App\Enums\Status;
use App\Enums\YesNo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->nullable()->unique();
            $table->string('password')->nullable();

            $table->boolean('is_password_dirty')
                ->default(false)
                ->comment('for first connection');

            $table->timestamp('password_initialized_at')
                ->comment('admin has option to reinitialize password to default format ')
                ->nullable();

            $table->timestamp('password_updated_at')
                ->comment('admin has option to reinitialize password to default format ')
                ->nullable();

            $table->timestamp('last_seen')->nullable();

            $table->boolean('is_admin')->default(YesNo::NO->value);
            $table->boolean('is_manager*')->default(YesNo::NO->value);
            $table->boolean('is_candidat')->default(YesNo::YES->value);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained()
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained()
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

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
