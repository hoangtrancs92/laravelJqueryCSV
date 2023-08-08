<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('name', 100);
            $table->bigInteger('group_id');
            $table->date('started_date');
            $table->tinyInteger('position_id');
            $table->date('created_date');
            $table->date('updated_date');
            $table->date('deleted_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
