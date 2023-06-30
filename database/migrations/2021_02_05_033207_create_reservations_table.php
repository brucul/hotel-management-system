<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guests')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guest_in_house')->constrained('guests')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->bigInteger('bed');
            $table->date('check_in');
            $table->date('check_out');
            $table->bigInteger('adult');
            $table->bigInteger('children');
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
        Schema::dropIfExists('reservations');
    }
}
