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
            $table->string('Prenom');
            $table->string('CIN');
            $table->string('Date_naissance');
            $table->string('Adresse');
            $table->string('Ville');
            $table->string('CNSS');
            $table->string('Solde');
            $table->string('Solde_Global');
            $table->string('Salire');
            $table->string('Date_contrat');
            $table->string('Projet');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
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
