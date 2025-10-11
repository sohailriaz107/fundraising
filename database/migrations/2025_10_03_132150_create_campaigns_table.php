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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');                
            $table->decimal('goal_amount', 12, 2);         
            $table->decimal('raised_amount', 12, 2)->default(0); // start with 0
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'completed', 'pending', 'cancelled'])->default('pending'); 
            $table->string('image')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
