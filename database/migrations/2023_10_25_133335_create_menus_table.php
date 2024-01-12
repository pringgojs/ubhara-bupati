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
        Schema::connection(env('CRED_DB_CONNECTION'))->create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('routing_group_id')->nullable();
            $table->string('name');
            $table->string('index')->nullable();
            $table->boolean('deleteable')->default(true);
            $table->boolean('viewonmenu')->default(true);
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
        Schema::connection(env('CRED_DB_CONNECTION'))->dropIfExists('menus');
    }
};
