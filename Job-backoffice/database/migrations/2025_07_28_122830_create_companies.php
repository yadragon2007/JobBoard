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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('location');
            $table->string('industry');
            $table->string('website')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // Relations
            // $table->uuid('owner_id');
            $table->foreignUuid("owner_id")->references("id")->on("users")->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            Schema::dropIfExists('companies');
        });
    }
};
