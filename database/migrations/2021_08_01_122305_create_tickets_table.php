<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_name');
            $table->string('student_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('issue')->nullable();
            $table->string('resp_emp')->nullable();
            $table->string('notes')->nullable();

            $table->string('status')->nullable();
            $table->string('notes2')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
