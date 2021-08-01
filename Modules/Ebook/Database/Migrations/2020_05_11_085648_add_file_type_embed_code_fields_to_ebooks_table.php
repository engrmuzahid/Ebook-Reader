<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileTypeEmbedCodeFieldsToEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->text('file_type')->nullable()->after('slug');
            $table->text('embed_code')->nullable()->after('file_url');
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
            $table->dropColumn('file_type');
            $table->dropColumn('embed_code');
        });
    }
}
