<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('body');
            $table->string('priorytet')->default('low'); // to trzeba zmienić na angielski,
            // poza tym to powinny być inty reprezentujące np. High - 1, Medium - 2, Low -3,
            // łatwiej jest operować na intach niż stringach,
            // dodać je jako consty do modelu Ticket
            $table->string('status')->default('open');
            $table->unsignedBigInteger('user_id')->default('1');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
