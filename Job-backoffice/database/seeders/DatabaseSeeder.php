<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\jobCategory;
use App\Models\JobVacancy;
use App\Models\Resume;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'admin',
            'password' => Hash::make('123123123'),
            "role" => "admin",
            // "email_verifaied_at" => now(),
        ]);


        // seed data to test with
        $jobData = json_decode(file_get_contents(database_path("data/job_data.json")), true);
        $jobApplications = json_decode(file_get_contents(database_path("data/job_applications.json")), true);

        // ---------------------------//
        //   create job_categories    //
        // ---------------------------//

        foreach ($jobData["jobCategories"] as $catiegory) {
            JobCategory::firstOrCreate([
                "name" => $catiegory,
            ]);
        }

        // ---------------------------//
        //   create job_categories    //
        // ---------------------------//

        foreach ($jobData["companies"] as $company) {
            // create company owner
            $companyOwner = User::firstOrCreate([
                "email" => fake()->unique()->safeEmail(),
            ], [
                "name" => fake()->name(),
                "password" => Hash::make("123123123"),
                "role" => "company-owner",
                // "email_verifaied_at" => now(),
            ]);

            Company::firstOrCreate([
                "name" => $company["name"]
            ], [
                "location" => $company["address"],
                "industry" => $company["industry"],
                "website" => $company["website"],
                "owner_id" => $companyOwner->id
            ]);
        }


        // ---------------------------//
        //   create job_vacancies    //
        // ---------------------------//

        foreach ($jobData["jobVacancies"] as $jobVacancy) {
            // get crated company
            $company = Company::where("name", $jobVacancy["company"])->firstOrFail();
            // get job category
            $catiegory = JobCategory::where("name", $jobVacancy["category"])->firstOrFail();
            // create JobVacancy
            JobVacancy::firstOrCreate([
                "title" => $jobVacancy["title"],
                "company_id" => $company->id,
            ], [
                "description" => $jobVacancy["description"],
                "location" => $jobVacancy["location"],
                "employment_type" => $jobVacancy["type"],
                "salary" => $jobVacancy["salary"],
                "job_category_id" => $catiegory->id,
            ]);
        }



        // ---------------------------//
        //    create applications     //
        // ---------------------------//

        foreach ($jobApplications["jobApplications"] as $application) {
            // get random job vacancy
            $jobVacancy = JobVacancy::inRandomOrder()->first();

            // create job seeker
            $applicant = User::firstOrCreate([
                "email" => fake()->unique()->safeEmail(),
            ], [
                "name" => fake()->name(),
                'password' => Hash::make('123123123'),
                "role" => "job-seeker",
            ]);

            $resume = Resume::create([
                "fileName" => $application["resume"]["filename"],
                "fileUri" => $application["resume"]["fileUri"],
                "contactDetails" => $application["resume"]["contactDetails"],
                "education" => $application["resume"]["education"],
                "summary" => $application["resume"]["summary"],
                "skills" => $application["resume"]["skills"],
                "experience" => $application["resume"]["experience"],
                "user_id" => $applicant->id,
            ]);

            JobApplication::Create([
                "status" => $application["status"],
                "AiScore" => $application["aiGeneratedScore"],
                "AiFeedback" => $application["aiGeneratedFeedback"],
                "user_id" => $applicant->id,
                "job_vacancy_id" => $jobVacancy->id,
                "resume_id" => $resume->id,
            ]);
        }

    }
}
