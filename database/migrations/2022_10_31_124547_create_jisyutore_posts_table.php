<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jisyutore_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('thumbnail', 200)->nullable();
            $table->datetime('start_datetime');
            $table->datetime('end_datetime');
            $table->char('nearest_station', 4);
            $table->char('menu_category', 4);
            $table->string('address', 200);
            $table->string('latitude', 200)->nullable();
            $table->string('longitude', 200)->nullable();
            $table->string('comment', 1000)->nullable();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('jisyutore_posts');
    }
};
