<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DonationStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId') ;
            $table->float('amount') ;
            $table->string('donorName', 255) ;
            $table->string('cause', 255) ;
            $table->enum('status', array_column(DonationStatus::cases(), 'value'))->default(DonationStatus::PENDING->value);
            $table->unsignedBigInteger('campaign_id');
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
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeign(['campaign_id']);
            $table->dropColumn('campaign_id');
        }); 
    }
};
