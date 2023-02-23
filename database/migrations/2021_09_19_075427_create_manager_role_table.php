<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_role', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('manager_id');
            // $table->unsignedBigInteger('role_id');
            // $table->foreign('manager_id')->references('id')->on('managers');
            // $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_role');
    }
}
