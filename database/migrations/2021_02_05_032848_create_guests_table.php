<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('nik');
            $table->string('name');
            $table->string('slug_name');
            $table->string('email');
            $table->string('phone');
            $table->longText('address');
            $table->string('city');
            $table->string('country');
            $table->longText('additional_info')->nullable();
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
        Schema::dropIfExists('guests');
    }
}
