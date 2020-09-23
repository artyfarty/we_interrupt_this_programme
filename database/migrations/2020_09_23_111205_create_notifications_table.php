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

            $table->string("headline");
            $table->string("caption");
            $table->text("text");
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
            $table->integer("displayed_times");
            $table->dateTime("display_from");
            $table->dateTime("display_till");

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
        Schema::dropIfExists('notifications');
    }
}
