<?php

use App\Enums\RoleEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add the column as nullable (temp)
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('restrict');
        });

        // Step 2: Backfill with default role
        $defaultRoleId = DB::table('roles')
            ->where('name', RoleEnum::VIEWER->value)
            ->value('id');

        if (!$defaultRoleId) {
            $defaultRoleId = DB::table('roles')->insertGetId([
                'name' => RoleEnum::VIEWER->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('users')->whereNull('role_id')->update([
            'role_id' => $defaultRoleId
        ]);

        // Step 3: Make the column NOT NULL
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
