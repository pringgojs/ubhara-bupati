<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::connection(env('CRED_DB_CONNECTION'))->create('credentials', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->text('password');
            $table->string('nama');
            $table->string('satker');
            $table->boolean('deleteable')->default(true);
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
        Schema::connection(env('CRED_DB_CONNECTION'))->dropIfExists('credentials');
    }
};
