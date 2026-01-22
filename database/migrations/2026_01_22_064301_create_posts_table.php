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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            #foreign key to users table (author)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            #foreign key to categories table
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            
            $table->string('title');
            $table->string('slug')->unique();
            #large text field for content
            $table->text('content');
            #status: draft or published
            $table->enum('status', ['draft', 'published'])->default('draft');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
