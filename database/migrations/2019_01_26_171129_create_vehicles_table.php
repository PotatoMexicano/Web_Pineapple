<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('license', 8)->unique();
            $table->string('brand', 30);
            $table->string('model', 50);
            $table->enum('type', ['suv','van','sedan','pickup-truck','jeep','hatch','esportivo','crossover','cupê']);
            $table->string('tags', 200);
            $table->integer('year');
            $table->enum('color', ['cinza','branco','preto','vermelho','azul','marrom','verde','outros']);
            $table->enum('doors', ['2','3','4']);
            $table->string('image',100)->nullable();
            $table->integer('id_user');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
