<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEbookTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebook_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ebook_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('publisher')->nullable();
            
            $table->unique(['ebook_id', 'locale']);
            $table->foreign('ebook_id')->references('id')->on('ebooks')->onDelete('cascade');
        });
        
        DB::statement('ALTER TABLE ebook_translations ADD FULLTEXT(title)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebook_translations');
    }
}
