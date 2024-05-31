<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
			 $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('funcionario_id');
            $table->string('name');
            $table->string('cpf');
            $table->string('registration')->nullable();
            $table->string('telephone')->nullable();
             $table->string('function')->nullable();
            $table->string('capacity');
            $table->string('interlocutor')->nullable();
            $table->dateTime('date_time');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
