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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('status')->default(true);

            // $table->unsignedBigInteger('id')->index();
            // $table->string('title');
            // $table->string('code')->nullable();
            // $table->tinyInteger('ip')->nullable()->comment('استفاده جهت مرتبسازی');
            // $table->string('area_code')->nullable();
            // $table->string('hf_address')->nullable()->comment('کد خطاب HF');
            // $table->string('server_ip')->nullable()->comment('ip سرور 112 استان');
            // $table->tinyInteger('serial')->nullable();
            // $table->boolean('state')->nullable()->default(false);
            // $table->boolean('status')->nullable()->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
