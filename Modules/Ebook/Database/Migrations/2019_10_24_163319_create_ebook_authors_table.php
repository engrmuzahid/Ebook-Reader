<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbookAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebook_authors', function (Blueprint $table) {
            
            $table->integer('ebook_id')->unsigned();
            $table->integer('author_id')->unsigned();

            $table->primary(['ebook_id', 'author_id']);
            $table->foreign('ebook_id')->references('id')->on('ebooks')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebook_authors');
    }
}
