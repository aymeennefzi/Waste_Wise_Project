<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id'); // ID of the user who owns the item
            $table->unsignedBigInteger('buyer_id'); // ID of the user buying the item
            $table->dateTime('meeting_time'); // Time of the meeting
            $table->string('status'); // Status of the meeting (e.g., scheduled, completed, canceled)
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
