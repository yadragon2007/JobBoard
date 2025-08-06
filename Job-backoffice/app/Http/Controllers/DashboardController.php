<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        // last 30 days active users 
        $activeUsers = User::where("last_login_at", ">=", now()->subdays(30))->where("role", "job-seeker")->count();
        // total jobs
        $totalJobs = JobVacancy::whereNull("deleted_at")->count();
        // total applications
        $totalApplications = JobApplication::whereNull("deleted_at")->count();

        $analytics = [
            "activeUsers" => $activeUsers,
            "totalJobs" => $totalJobs,
            "totalApplications" => $totalApplications,
        ];

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
                    $job->convertionRate = round(($job->applicationsCount / $job->viewCount) * 100,2);

                } else {
                    $job->convertionRate = 0;
                }
                return $job;
            });

        return view("dashboard.index", compact("analytics", "mostAppliedJobs", "convertionRates"));
    }
}
