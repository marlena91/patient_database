<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_patient', function (Blueprint $table) {
            $table->integer('patient_id')->unsigned(); 
            $table->integer('disease_id')->unsigned(); 
            $table->foreign('patient_id') 
                ->references('id') 
                ->on('patients') 
                ->onDelete('cascade'); 
            $table->foreign('disease_id') 
                ->references('id') 
                ->on('diseases') 
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_patient');
    }
}
