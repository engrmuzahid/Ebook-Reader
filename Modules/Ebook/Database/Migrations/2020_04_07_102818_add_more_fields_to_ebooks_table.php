<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->text('file_url')->nullable()->after('slug');
            $table->text('isbn')->nullable()->after('file_url');
            $table->text('price')->nullable()->after('isbn');
            $table->text('buy_url')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropColumn('file_url');
            $table->dropColumn('isbn');
            $table->dropColumn('price');
            $table->dropColumn('buy_url');
        });
    }
}
