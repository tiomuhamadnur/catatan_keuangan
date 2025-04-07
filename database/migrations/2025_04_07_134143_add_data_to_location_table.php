<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('location', function (Blueprint $table) {
            $table->text('photo')->nullable()->after('description');
            $table->string('owner')->nullable()->after('description');
            $table->float('price')->nullable()->after('description');
            $table->date('start_date')->nullable()->after('description');
            $table->date('end_date')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('location', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('owner');
            $table->dropColumn('price');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
};
