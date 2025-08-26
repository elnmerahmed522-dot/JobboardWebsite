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
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('company_id');
        $table->string('title');
        $table->text('description');
        $table->string('location');
        $table->string('type'); // full-time, part-time, remote
        $table->decimal('salary', 10, 2)->nullable();
        $table->string('status')->default('pending'); // pending, approved, rejected
        $table->timestamps();

        $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
