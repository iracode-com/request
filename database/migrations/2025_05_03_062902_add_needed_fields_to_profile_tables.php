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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('national_code')->after('mobile')->nullable();
            $table->date('birthdate')->after('national_code')->nullable();
            $table->string('fathername')->after('birthdate')->nullable();
        });
        Schema::table('corporation_profiles', function (Blueprint $table) {
            $table->string('company_owner_name')->after('company_name')->nullable();
            $table->date('company_owner_birthdate')->after('company_owner_name')->nullable();
            $table->string('company_owner_mobile')->after('company_owner_birthdate')->nullable();
            $table->string('company_owner_national_code')->after('company_owner_mobile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('national_code');
            $table->dropColumn('birthdate');
            $table->dropColumn('fathername');
        });
        Schema::table('corporation_profiles', function (Blueprint $table) {
            $table->dropColumn('company_owner_name');
            $table->dropColumn('company_owner_birthdate');
            $table->dropColumn('company_owner_mobile');
            $table->dropColumn('company_owner_national_code');
        });
    }
};
