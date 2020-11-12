<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAttributeTableColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atributes', function (Blueprint $table) {
            $table->string('description', 100)->nullable()->change();
            $table->string('vendor', 50)->nullable()->change();
            $table->string('other_conditions', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atributes', function (Blueprint $table) {
            //
        });
    }
}
