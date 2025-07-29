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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum("status",["pending","rejected","accepted"])->default("pending");
            $table->float("AiScore",2)->default(0);
            $table->longText("AiFeedback")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignUuid("user_id")->references("id")->on("users")->onDelete("restrict");
            $table->foreignUuid("job_vacancy_id")->references("id")->on("job_vacancies")->onDelete("restrict");
            $table->foreignUuid("resume_id")->references("id")->on("resumes")->onDelete("restrict");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');

    }
};
