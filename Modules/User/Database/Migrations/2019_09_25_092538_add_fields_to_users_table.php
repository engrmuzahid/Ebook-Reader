<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('last_name');
            $table->text('about')->nullable()->after('last_login');
            $table->string('facebook')->nullable()->after('about');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('google')->nullable()->after('twitter');
            $table->string('instagram')->nullable()->after('google');
            $table->string('linkedin')->nullable()->after('instagram');
            $table->string('youtube')->nullable()->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('about');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('google');
            $table->dropColumn('instagram');
            $table->dropColumn('linkedin');
            $table->dropColumn('youtube');
            
        });
    }
}
