<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absorption', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('project_id')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('qty')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->date('date')->nullable();
            $table->text('photo')->nullable();
            $table->text('remark')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('project_id')->on('project')->references('id');
            $table->foreign('unit_id')->on('unit')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absorption');
    }
};
