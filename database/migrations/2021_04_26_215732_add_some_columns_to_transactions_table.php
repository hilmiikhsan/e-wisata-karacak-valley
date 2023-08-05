<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('status')->nullable()->default(0)->after('grand_total');
            $table->integer('star_score')->nullable()->default(0)->after('status');
            $table->text('testimoni')->after('star_score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('star_score');
            $table->dropColumn('testimoni');
        });
    }
}
