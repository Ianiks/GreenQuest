<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Rename username to id_number
            $table->renameColumn('username', 'id_number');
            
            // 2. Add nullable email column
            $table->string('email')->nullable()->after('id_number');
        });

        // 3. Set emails only for existing admin users (optional)
        if (Schema::hasColumn('users', 'is_admin')) {
            DB::table('users')
                ->where('is_admin', true)
                ->update([
                    'email' => DB::raw('CONCAT(id_number, "@mcc.edu.ph")')
                ]);
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id_number', 'username');
            $table->dropColumn('email');
        });
    }
}