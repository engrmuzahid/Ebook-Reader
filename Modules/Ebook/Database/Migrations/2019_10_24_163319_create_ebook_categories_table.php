<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbookCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebook_categories', function (Blueprint $table) {
            
            $table->integer('ebook_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->primary(['ebook_id', 'category_id']);
            $table->foreign('ebook_id')->references('id')->on('ebooks')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebook_categories');
    }
}
