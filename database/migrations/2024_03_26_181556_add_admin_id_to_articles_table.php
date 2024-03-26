<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminIdToArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Assure-toi que tu as une colonne 'id' dans ta table 'users'
            $table->unsignedBigInteger('admin_id')->nullable()->after('etudiant_id');
            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
}
