<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->string('category')->default('0')->nullable();
            $table->string('settings')->default('0')->nullable();
            $table->string('offers')->default('0')->nullable();
            $table->string('product')->default('0')->nullable();
            $table->string('orders')->default('0')->nullable();
            $table->string('tickets')->default('0')->nullable();
            $table->string('blogs')->default('0')->nullable();
            $table->string('reports')->default('0')->nullable();
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
        Schema::dropIfExists('user_role');
    }
};
