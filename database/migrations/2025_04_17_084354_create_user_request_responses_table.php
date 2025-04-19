<?php

use App\Models\UserRequest;
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
        Schema::create('user_request_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserRequest::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('message');
            $table->string('attachment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_request_responses');
    }
};
