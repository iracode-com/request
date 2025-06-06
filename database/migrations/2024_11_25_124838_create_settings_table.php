<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->text('site_description')->nullable();
            $table->string('copyright')->nullable();
            $table->text('address')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('support_email')->nullable();
            $table->string('support_phone')->nullable();
            $table->json('phone')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->string('posthog_html_snippet')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->json('seo_metadata')->nullable();
            $table->json('email_settings')->nullable();
            $table->string('email_from_address')->nullable();
            $table->string('email_from_name')->nullable();
            $table->json('social_network')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
