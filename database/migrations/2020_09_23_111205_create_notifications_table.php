<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->integer("program_event_id")->nullable();
            $table->integer("donation_id")->nullable();

            $table->string("caption");
            $table->string("headline");
            $table->text("text");
            $table->json("lines");
            $table->enum("type", [
                "default",
                "urgent",
                "schedule",
                "donation",
                "list"
            ]);
            $table->json("meta");
            $table->integer("priority");
            $table->integer("display_limit");
            $table->dateTime("display_from");
            $table->dateTime("display_till");

            $table->timestamps();

            $table->index(["program_event_id"]);
            $table->index(["donation_id"]);
            $table->index(["display_from", "display_till"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
