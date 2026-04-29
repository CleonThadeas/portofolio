<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('file_type');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('documentation');
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
