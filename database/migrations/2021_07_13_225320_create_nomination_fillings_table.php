<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominationFillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomination_fillings', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('programme_id');
            $table->integer('department_id');
            $table->integer('portfolio_id');
            $table->string('dob', 50);
            $table->string('image');
            $table->string('father_name');
            $table->string('mother_name');
            $table->text('address');
            $table->string('hall_name');
            $table->string('denomination');
            $table->string('position_occupied');
            $table->text('working_experience');
            $table->softDeletes();
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
        Schema::dropIfExists('nomination_fillings');
    }
}
