<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->integer('rules')->default(config('settings.rules.is_user'));
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('gender')->default(config('settings.gender.male'));
            $table->string('avatar')->nullable();
            $table->boolean('is_ban')->default(config('settings.is_ban.false'));
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
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('rules');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('gender');
            $table->dropColumn('avatar');
            $table->dropColumn('is_ban');
        });
    }
}
