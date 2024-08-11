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
        Schema::create('sa_seo', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('title')->nullable();
            $table->string('h1')->nullable();
            $table->text('description')->nullable();
            $table->text('subdomains')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id')->references('id')->on('sa_entities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sa_seo');
    }
};
