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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->mediumText('description');
            $table->string('location');
            $table->string('salary');
            $table->enum('employment_type', ['Full-time', 'Part-time', 'Contract', 'Remote', "Hybrid"])->default("Full-time");
            $table->timestamps();
            $table->softDeletes();

            $table->foreignUuid("company_id")->references("id")->on("companies")->onDelete("restrict");
            $table->foreignUuid("job_category_id")->references("id")->on("job_categories")->onDelete("restrict");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');

    }
};
