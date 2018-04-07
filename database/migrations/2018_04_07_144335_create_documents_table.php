<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('category_id');
            $table->string('file_name');
            $table->text('description');
            $table->float('file_size');
            $table->string('file_type');
            $table->string('thumbnail');
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->integer('is_illegal')->default(config('settings.is_illegal.false'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
