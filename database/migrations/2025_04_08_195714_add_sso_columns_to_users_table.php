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
        Schema::table('users', function (Blueprint $table) {
            $table->string('sso_id')->unique()->nullable();
            $table->json('sso_data')->nullable();
            $table->timestamp('sso_synced_at')->nullable();
        });
    }
};
