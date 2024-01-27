<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('province_code')->constrained('indonesia_provinces', 'code')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('city_code')->constrained('indonesia_cities', 'code')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('district_code')->constrained('indonesia_districts', 'code')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('village_code')->constrained('indonesia_villages', 'code')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('photo')->nullable();
            $table->string('gender', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
