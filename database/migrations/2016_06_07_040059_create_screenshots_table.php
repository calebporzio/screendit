<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenshotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenshots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->string('viewport')->nullable();
            $table->string('crop')->nullable();
            $table->boolean('hide_lightboxes')->nullable();
            $table->boolean('cached')->nullable();
            $table->string('format')->nullable();
            $table->string('filename')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->integer('user_id')->nullable();
            $table->softDeletes();
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
        Schema::drop('screenshots');
    }
}
