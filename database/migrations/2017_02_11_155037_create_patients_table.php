<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            // Fields
            $table->bigIncrements('id')->comment('National ID Card number, without letter');
            $table->string('name')->comment('Given name, middle name and second names if any');
            $table->string('surname')->comment('All surnames');
            $table->boolean('gender')->comment('False for Men, True for Women');
            $table->date('birth')->comment('Birth date');
            $table->smallInteger('height')->unsigned()->nullable()->comment('Height in centimeters');
            $table->smallInteger('weight')->unsigned()->nullable()->comment('Weight in kilograms');
            $table->string('profession')->nullable()->comment('Profession');
            $table->string('country')->nullable()->comment('Country written in the country language');
            $table->string('region')->nullable()->comment('Region of the country (state in US, province in Spain,...)');
            $table->string('city')->nullable()->comment('City or town where patient lives');
            $table->smallInteger('zip')->unsigned()->nullable()->comment('ZIP code of the city or town');
            $table->string('address_main')->nullable()->comment('Main address line');
            $table->string('address_secondary')->nullable()->comment('Optional second address line');
            $table->string('phone_prefix',4)->nullable()->comment('Country code of the phone number, if any');
            $table->bigInteger('phone')->unsigned()->nullable()->comment('Phone number, without country codes');
            $table->string('email')->nullable()->comment('Main email address');
            $table->string('referrer')->nullable()->comment('Business or person who referred the patient');
            $table->string('pathology')->nullable()->comment('Patient main pathologies');
            $table->text('notes')->nullable()->comment('Extra information field');
            $table->timestamps();
            $table->softDeletes();

            // Index
            // $table->primary('id'); # Automatic
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
