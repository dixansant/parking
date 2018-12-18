<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('family',50);
            $table->string('title',50);
            $table->string('description',160)->nullable();
            $table->string('linkref',20)->nullable();
            $table->string('href',200)->nullable();
            $table->string('grant_name',200)->nullable();
            $table->integer('parent')->unsigned()->default(0);
            $table->integer('position')->unsigned()->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('menus');
    }
}
