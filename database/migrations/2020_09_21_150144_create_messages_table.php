<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->string('sender_name');
            $table->string('sender_mail');
            $table->text('message');
            // $table->boolean('read');

            // FK Apartment
            //   --> Relazione 1-to-many Apartment-Messages
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')
                  ->references('id')
                  ->on('apartments');

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
        Schema::dropIfExists('messages');
    }
}
