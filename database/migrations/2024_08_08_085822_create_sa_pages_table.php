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
        Schema::create('sa_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('h1');
            $table->string('title');
            $table->text('description');
            $table->text('content');
            $table->boolean('active')->default(true);
            $table->string('url')->unique();
            $table->text('subdomains');
            $table->integer('parent_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sa_pages');
    }
};
