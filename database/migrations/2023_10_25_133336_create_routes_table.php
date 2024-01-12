<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\RoutingGroup;
use App\Models\Menu;
use App\Models\Route;
use App\Models\CredentialToRoute;
use App\Models\Credential;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(env('CRED_DB_CONNECTION'))->create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->text('name');
            $table->string('deleteable')->default(true);
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
        Schema::connection(env('CRED_DB_CONNECTION'))->dropIfExists('routes');
        RoutingGroup::whereNotNull('id')->delete();
        Menu::whereNotNull('id')->delete();
    }
};

