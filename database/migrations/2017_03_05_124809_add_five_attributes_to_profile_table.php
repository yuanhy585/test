<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiveAttributesToProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('attribute1_id')->nullable()->after('notes');
            $table->integer('attribute2_id')->nullable();
            $table->integer('attribute3_id')->nullable();
            $table->integer('attribute4_id')->nullable();
            $table->integer('attribute5_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
        });
    }
}
