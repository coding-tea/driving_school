<?php

use App\Enums\YesNo;
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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('name_ar', 100);
            $table->string('cin', 10);
            $table->string('adress', 100);
            $table->date('birthday');
            $table->string('birth_city', 40);
            $table->string('reference');
            $table->date('signin_date');
            $table->string('cinimage');
            $table->string('image_id');
            $table->foreignId('office_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
