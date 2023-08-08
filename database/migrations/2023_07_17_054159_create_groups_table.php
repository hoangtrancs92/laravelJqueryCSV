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
        Schema::create('group', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->text('note')->nullable();
            $table->bigInteger('group_leader_id');
            // $table->foreign('group_leader_id')->references('id')->on('user');
            $table->integer('group_floor_number');
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
        Schema::dropIfExists('group');
    }
};
