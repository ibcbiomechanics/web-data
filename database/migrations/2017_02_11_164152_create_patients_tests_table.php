<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_tests', function (Blueprint $table) {
            // Fields
            $table->bigInteger('patient_id')->unsigned();
            $table->integer('id')->comment('Test number');
            $table->string('test')->comment('Test name (study name)');
            $table->string('extension',4)->comment('Extension of the report file');
            $table->binary('report')->comment('File containing the report');
            $table->timestamps();
            $table->softDeletes();

            // Foreigns
            $table->foreign('patient_id')->references('id')->on('patients')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Index
            $table->primary(['patient_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients_tests');
    }
}
