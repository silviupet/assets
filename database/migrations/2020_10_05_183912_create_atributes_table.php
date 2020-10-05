<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAtributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description', 100);
            $table->date('from_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('currency', 5)->nullable();
            $table->string('vendor', 50);
            $table->string('other_conditions', 100);
//            $table->foreignId('document_id')->constrained('documents');
//            $table->foreignId('asset_id')->constrained("assets");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atributes');
        Schema::table('atributes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
