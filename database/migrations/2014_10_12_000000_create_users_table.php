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
            $table->string('lname')->nullable();
            $table->string('cin')->nullable();
            $table->date('date_birth')->nullable();//$table->string('adresse');//$table->string('ville');
            $table->string('cnss')->nullable();//$table->string('salire');
            $table->date('contrat_date')->nullable();
            $table->unsignedBigInteger('contrat_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();//$table->string('Projet');
            $table->unsignedBigInteger('projet_id')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            //$table->unsignedBigInteger("manager_id")->nullable();
            //$table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
            
        });
        Schema::table('projets', function (Blueprint $table) {
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
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
