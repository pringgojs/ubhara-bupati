<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Credential;
use App\Models\Route;
use App\Models\CredentialToRoute;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('CRED_DB_CONNECTION'))->create('credential_to_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credential_id');
            $table->foreign('credential_id')
                ->references('id')
                ->on('credentials');
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id')
                ->references('id')
                ->on('routes');
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
        Schema::connection(env('CRED_DB_CONNECTION'))->dropIfExists('credential_to_routes');
    }
};
