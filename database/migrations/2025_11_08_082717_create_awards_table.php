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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();

            $table->foreignId('year_id')->constrained()->onDelete('cascade');

            $table->string('name'); //giải đặc biệt
            $table->string('title'); //Xe máy....
            $table->string('description'); //Sang trọng, thanh lịch và tiết kiệm nhiên liệu, là người bạn đồng hành lý tưởng trên mọi nẻo đường.

            $table->string('image')->nullable(); //Xe máy....
            $table->string('number_award')->nullable();
            $table->boolean('is_award')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards');
    }
};
