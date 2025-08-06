<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        if (auth()->user()->role == "admin") {
            $analytics = $this->adminDashbordAnalytics();
        } elseif (auth()->user()->role == "company-owner") {
            $analytics = $this->CompanyOwnerDashbordAnalytics();
        }

        return view("dashboard.index", compact("analytics"));
    }


    private function adminDashbordAnalytics()
    {
        // last 30 days active users 
        $activeUsers = User::where("last_login_at", ">=", now()->subdays(30))->where("role", "job-seeker")->count();
        // total jobs
        $totalJobs = JobVacancy::whereNull("deleted_at")->count();
        // total applications
        $totalApplications = JobApplication::whereNull("deleted_at")->count();

        // Most Applied jobs
        $mostAppliedJobs = JobVacancy::whereNull("deleted_at")->withCount("applications as applicationsCount")->orderByDesc("applicationsCount")->limit("5")->get();
        // convertion Rate
        $convertionRates = JobVacancy::whereNull("deleted_at")
            ->withCount("applications as applicationsCount")
            ->having("applicationsCount", ">", 0)
            ->orderByDesc("applicationsCount")
            ->limit("5")
            ->get()
            ->map(function ($job) {
                if ($job->viewCount > 0) {
                    $job->convertionRate = round(($job->applicationsCount / $job->viewCount) * 100, 2);

                } else {
                    $job->convertionRate = 0;
                }
                return $job;
            });
        $analytics = [
            "activeUsers" => $activeUsers,
            "totalJobs" => $totalJobs,
            "totalApplications" => $totalApplications,
            "mostAppliedJobs" => $mostAppliedJobs,
            "convertionRates" => $convertionRates
        ];
        return $analytics;
    }
    private function CompanyOwnerDashbordAnalytics()
    {
        $company = auth()->user()->company;

        // last 30 days active users that they applied to this company
        $activeUsers = User::where("last_login_at", ">=", now()->subdays(30))
            ->where("role", "job-seeker")
            ->whereHas("jobApplications", function ($query) use ($company) {
                $query->whereIn("job_vacancy_id", $company->jobVacancies->pluck("id"));
            })
            ->count();


        // total jobs
        $totalJobs = JobVacancy::whereNull("deleted_at")->where("company_id", $company->id)->count();


        // total applications
        $totalApplications = JobApplication::whereNull("deleted_at")->whereHas("jobVacancy", function ($query) use ($company) {
            $query->whereIn("job_vacancy_id", $company->jobVacancies->pluck("id"));
        })->count();

        // Most Applied jobs
        $mostAppliedJobs = JobVacancy::whereNull("deleted_at")->where("company_id", $company->id)->withCount("applications as applicationsCount")->orderByDesc("applicationsCount")->limit("5")->get();
        // convertion Rate
        $convertionRates = JobVacancy::whereNull("deleted_at")
            ->withCount("applications as applicationsCount")
            ->where("company_id", $company->id)
            ->having("applicationsCount", ">", 0)
            ->orderByDesc("applicationsCount")
            ->limit("5")
            ->get()
            ->map(function ($job) {
                if ($job->viewCount > 0) {
                    $job->convertionRate = round(($job->applicationsCount / $job->viewCount) * 100, 2);

                } else {
                    $job->convertionRate = 0;
                }
                return $job;
            });
        $analytics = [
            "activeUsers" => $activeUsers,
            "totalJobs" => $totalJobs,
            "totalApplications" => $totalApplications,
            "mostAppliedJobs" => $mostAppliedJobs,
            "convertionRates" => $convertionRates
        ];
        return $analytics;
    }
}
