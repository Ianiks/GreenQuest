<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'points')) {
            $table->integer('points')->default(0);
        }
        if (!Schema::hasColumn('users', 'carbon_saved')) {
            $table->integer('carbon_saved')->default(0);
        }
        if (!Schema::hasColumn('users', 'is_admin')) {
            $table->boolean('is_admin')->default(false);
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
