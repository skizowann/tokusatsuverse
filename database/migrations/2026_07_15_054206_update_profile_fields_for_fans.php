<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProfileFieldsForFans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus NPM hanya jika kolom tersebut ada
            if (Schema::hasColumn('users', 'npm')) {
                $table->dropColumn('npm');
            }
            
            // Tambahkan kolom avatar HANYA JIKA belum ada di database
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email');
            }

            // Tambahkan favorite_rider HANYA JIKA belum ada
            if (!Schema::hasColumn('users', 'favorite_rider')) {
                $table->string('favorite_rider')->default('Kamen Rider Ichigo')->after('bio');
            }

            // Tambahkan watched_count HANYA JIKA belum ada
            if (!Schema::hasColumn('users', 'watched_count')) {
                $table->integer('watched_count')->default(0)->after('favorite_rider');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'npm')) {
                $table->string('npm')->nullable();
            }
            
            $columnsToDrop = [];
            if (Schema::hasColumn('users', 'avatar')) $columnsToDrop[] = 'avatar';
            if (Schema::hasColumn('users', 'favorite_rider')) $columnsToDrop[] = 'favorite_rider';
            if (Schema::hasColumn('users', 'watched_count')) $columnsToDrop[] = 'watched_count';
            
            if (count($columnsToDrop) > 0) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
}