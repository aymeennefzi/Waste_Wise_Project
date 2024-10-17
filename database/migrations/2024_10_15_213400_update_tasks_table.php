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
            $table->id(); // Primary key for Task
            $table->unsignedBigInteger('event_id'); // Foreign key for Event
            $table->string('task_type');
            $table->text('description');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('estimated_duration')->nullable(); // in minutes
            $table->decimal('cost_estimate', 10, 2)->nullable(); // Estimated cost in dollars or another currency
            $table->timestamps(); // created_at and updated_at
            // Foreign key constraint
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }

};
