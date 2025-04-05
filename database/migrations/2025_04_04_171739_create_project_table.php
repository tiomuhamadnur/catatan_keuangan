<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('location_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('modal')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('remark')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('location_id')->on('location')->references('id');
            $table->foreign('status_id')->on('status')->references('id');
            $table->foreign('category_id')->on('category')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
