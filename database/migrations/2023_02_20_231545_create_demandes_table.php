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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("demandeur_id");
            $table->date("date_debut");
            $table->string("date_debut_type");
            $table->date("date_fin");
            $table->string("date_fin_type");
            $table->text("raison")->nullable();
            $table->float("duration");
            $table->integer("status")->nullable();
            $table->foreign('demandeur_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('demandes');
    }
};
