<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
        public function up()
        {
            Schema::create('materials', function (Blueprint $table) {
                $table->id();
                $table->string('material_name');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('recycling_center_id'); // Ajout de la clé étrangère
                $table->foreign('recycling_center_id')->references('id')->on('recycling_centers')->onDelete('cascade'); // Définir la relation
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('materials');
        }
    
    
        
       

  
};
