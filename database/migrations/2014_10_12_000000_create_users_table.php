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
            $table->string('name');
            $table->string('lname');
            $table->string('cin');
            $table->date('date_birth');//$table->string('adresse');//$table->string('ville');
            $table->string('cnss');//$table->string('salire');
            $table->date('contrat_date');
            $table->unsignedBigInteger('contrat_type');
            $table->unsignedBigInteger('position_id');//$table->string('Projet');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger("manager_id")->nullable();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contrat_type')->references('id')->on('contrats')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
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
