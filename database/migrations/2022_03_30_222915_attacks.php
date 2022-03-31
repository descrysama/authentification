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
        Schema::create('attacks', function (Blueprint $table){
            $table->id();
            $table->string('ip');
            $table->integer('port');
            $table->string('method');
            $table->integer('length');
            $table->integer('launcher_id');
            $table->timestamp('launched_at');
            $table->timestamp('finished_at');
            $table->integer('state')->default('1');
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
        //
    }
};
