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
    Schema::create('chapters', function (Blueprint $table) {
        $table->id();
        $table->foreignId('work_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->string('slug');
        $table->integer('chapter_number');
        $table->longText('content'); // Isi tulisan/bab
        $table->integer('reading_time_minutes')->default(3);
        $table->unsignedBigInteger('likes')->default(0);
        $table->timestamps();
    });
}
};
