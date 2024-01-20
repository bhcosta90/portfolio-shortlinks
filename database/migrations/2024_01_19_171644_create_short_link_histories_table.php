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
        Schema::create('short_link_histories', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('short_link_id')->on('short_links');
            $table->ipAddress();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_link_histories');
    }
};
