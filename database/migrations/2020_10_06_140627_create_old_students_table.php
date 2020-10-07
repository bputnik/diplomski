<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('name');
            $table->string('surname');
            $table->text('avatar')->nullable();
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('course');
            $table->string('contract_number')->unique();
            $table->string('trustee_name')->nullable();
            $table->string('trustee_surname')->nullable();
            $table->string('trustee_email')->nullable();
            $table->string('trustee_address')->nullable();
            $table->string('trustee_phone')->nullable();
            $table->date('deleted_at');
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
        Schema::dropIfExists('old_students');
    }
}
