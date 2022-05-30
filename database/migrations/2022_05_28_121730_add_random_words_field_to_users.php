<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRandomWordsFieldToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users', 'random_words')){
            Schema::table('users', function (Blueprint $table) {
                $table->text('random_words')->nullable();
            });
        }

        if(!Schema::hasColumn('users', 'quantity')){
            Schema::table('users', function (Blueprint $table) {
                $table->BigInteger('quantity')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('random_words');
            $table->dropColumn('quantity');
        });
    }
}
