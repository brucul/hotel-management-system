<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('apk_name');
            $table->longText('address');
            $table->string('regency');
            $table->string('province');
            $table->string('phone');
            $table->string('number_fax');
            $table->string('email');
            $table->string('website');
            $table->longText('pict');
            $table->string('bed');
            $table->string('breakfast');
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
        Schema::dropIfExists('setting_hotels');
    }
}
