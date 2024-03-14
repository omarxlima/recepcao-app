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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf');
            $table->string('cargo')->nullable();
            $table->string('matricula')->nullable();
            $table->string('instituicao')->nullable();
             $table->string('telefone')->nullable();
            $table->string('email_funcional');
            $table->string('email_pessoal');
            $table->string('pis_pasep')->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('conta')->nullable();
            $table->enum('tipo_conta', ['CORRENTE', 'POUPANÇA'])->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('ativo')->default(true);
			 $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
