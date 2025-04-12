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
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('contact')->nullable();
            $table->string('picture')->nullable();
            $table->enum('utype', ['Super', 'Designing', 'Production', 'Installation'])->default('Designing');
            $table->enum('status', ['0', '1'])->default('1');
            $table->enum('authorization_location', ['0', '1'])->nullable()->default('0');
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
        Schema::dropIfExists('admins');
    }
};
