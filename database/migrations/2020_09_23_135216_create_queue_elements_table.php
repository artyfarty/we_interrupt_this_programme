<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_elements', function (Blueprint $table) {
            $table->id();
            $table->integer("notification_id");
            $table->dateTime("display_at");
            $table->binary("was_displayed");

            $table->timestamps();

            $table->index(["notification_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queue_elements');
    }
}
