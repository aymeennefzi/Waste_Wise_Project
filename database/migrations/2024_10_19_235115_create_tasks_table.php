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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_id')->constrained()->onDelete('cascade'); // Relie à la communauté
            $table->string('title'); // Titre de la tâche
            $table->text('description')->nullable(); // Description facultative
            $table->dateTime('due_date')->nullable(); // Date d'échéance
            $table->enum('status', ['pending', 'completed'])->default('pending'); // État de la tâche
            
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
        Schema::dropIfExists('tasks');
    }
};
