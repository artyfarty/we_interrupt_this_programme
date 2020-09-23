<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_events', function (Blueprint $table) {
            $table->id();

            $table->dateTime("begin_at");
            $table->string("headline");
            $table->text("text");
            $table->enum("status", ["deleted", "disabled", "enabled"]);

            $table->timestamps();

            $table->index(["begin_at", "status"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_events');
    }
}
