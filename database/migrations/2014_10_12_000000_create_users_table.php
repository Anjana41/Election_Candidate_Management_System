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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('phone',10);
            $table->enum('status',["1","0"]);
            $table->enum('Gender',["Male","Female","Other"])->nullable();
            $table->date('DOB')->nullable();
            $table->String('usertype',["admin","user"]);
            $table->string('email')->unique();
            $table->string('Address',100)->nullable();
            $table->string('Role',300)->nullable();
            $table->string('State',100)->nullable();
            $table->string('district',100)->nullable();
            $table->string('tehsil',100)->nullable();
            $table->string('samiti',100)->nullable();
            $table->string('panchayat',100)->nullable();
            $table->string('village',100)->nullable();
            $table->string('Country')->nullable();
            $table->timestamp('email_verified_at')->nullable();
        //    $table-> string('password' => 'min:6|required_with:password_confirmation|same:password_confirmation'); 
        //    $table->('password_confirmation' => 'min:6');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
