<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToEtudiantsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('etudiants', 'user_id')) {
            Schema::table('etudiants', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
            });
        }
        
        
    }

    public function down()
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}


