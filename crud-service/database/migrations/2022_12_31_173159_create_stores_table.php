<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address");
            $table->string("location");
            $table->string("latitude");
            $table->string("longitude");
            $table->string("icon");
            $table->string("banner");
            $table->time('start_time');
            $table->time('end_time');
            $table->double("score", 2, 1);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('stores');
    }
}
