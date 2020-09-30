<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlates', function (Blueprint $table) {
            $table->id();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('local_area')->nullable();
            $table->string('shop_name')->nullable();
            $table->text('address')->nullable();
            $table->string('contact')->nullable();
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
        Schema::dropIfExists('outlates');
    }
}
