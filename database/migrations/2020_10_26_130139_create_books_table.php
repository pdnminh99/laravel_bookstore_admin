<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->string('description')->nullable();
            $table->integer('year_of_publishing')->nullable();
            $table->integer('price')->nullable();
            $table->integer('pages')->nullable();
            $table->integer('in_stock')->default(0)->nullable(false);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
