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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('title');
            $table->string('sub_title')->nullable();

            $table->date('start_date_event')->nullable();
            $table->date('expired_date_event')->nullable();
            
            $table->date('start_date_application')->nullable();
            $table->date('end_date_application')->nullable();

            $table->string('first_contact')->nullable();
            $table->string('first_phone')->nullable();

            $table->string('second_contact')->nullable();
            $table->string('second_phone')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
