<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->integer('num_rooms');
            $table->integer('num_beds');
            $table->integer('num_baths');
            $table->integer('mq');
            $table->string('address');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->longText('description');
            $table->text('main_img')->nullable();
            $table->decimal('price', 6, 2);

            // FK User
            //   --> Relazione 1-to-many User-Apartments
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');

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
        Schema::dropIfExists('apartments');
    }
}
