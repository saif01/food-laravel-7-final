<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('header')->nullable();
            $table->string('image')->nullable();
            $table->string('image_small')->nullable();
            $table->string('price_old')->nullable();
            $table->string('price_new')->nullable();
            $table->text('details')->nullable();
            $table->string('status')->nullable();
            $table->string('published_by')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('promotions');
    }
}
