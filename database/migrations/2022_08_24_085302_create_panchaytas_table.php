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
        Schema::create('panchayats', function (Blueprint $table) {
            $table->id();
            $table->string('panchayat_name',50);
            $table->string('samiti_id',50);
            $table->string('slug',50);
            $table->enum('status',["1","0"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panchaytas');
    }
};
