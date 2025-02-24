<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::create('friend_requests', function (Blueprint $table){
            $table->id();
            $table->foreignId('receiver_id')->constrained('users');
            $table->foreignId('sender_id')->constrained('users');
            $table->timestamp('created_at');
            $table->enum('status', ['accepted' , 'refused' , 'pending'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
