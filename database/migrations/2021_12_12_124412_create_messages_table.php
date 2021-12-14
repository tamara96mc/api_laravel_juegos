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
            $table->increments('id');
            $table->string('message', 100);
            $table->string('date', 100);
            $table->unsignedInteger('fromPlayer');
            $table->foreign('fromPlayer')->references('id')->on('players')->unsigned()->constrained('players')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('partyId');
            $table->foreign('partyId')->references('id')->on('parties')->unsigned()->constrained('parties')->onUpdate('cascade')->onDelete('cascade');
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