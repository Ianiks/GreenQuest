<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('points')->default(0);
            $table->integer('trees_planted')->default(0);
            $table->decimal('carbon_saved', 10, 2)->default(0);
            $table->integer('games_completed')->default(0);
            $table->integer('trivia_progress')->default(0);
            $table->integer('waste_sorting_progress')->default(0);
            $table->integer('eco_plan_progress')->default(0);
            $table->boolean('is_admin')->default(false);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'points',
                'trees_planted',
                'carbon_saved',
                'games_completed',
                'trivia_progress',
                'waste_sorting_progress',
                'eco_plan_progress',
                'is_admin'
            ]);
        });
    }
};