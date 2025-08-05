<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacancyCreateRequest;
use App\Http\Requests\JobVacancyUpdateRequest;
use App\Models\Company;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use \App\Http\Requests\JobCategoryCreateRequest;
use \App\Http\Requests\JobCategoryUpdateRequest;
class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = JobVacancy::latest();


        if ($request->input("archived") == "true") {
            $query->onlyTrashed();
        }

        $jobVacancies = $query->paginate(8)->onEachSide(1);
        return view("jobVacancy.index", compact("jobVacancies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $categories = JobCategory::all();
        return view("jobVacancy.create", compact(["companies" ,"categories"]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancyCreateRequest $request)
    {
        $validatedData = $request->validated();
        JobVacancy::create($validatedData);
        return redirect()->route('job-vacancy.index')->with('success', 'Job Vacancy created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobVacancy = JobVacancy::find($id);
        return view("jobVacancy.show", compact("jobVacancy"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $companies = Company::all();
        $categories = JobCategory::all();
        return view("jobVacancy.edit", compact("jobVacancy", "companies", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobVacancyUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $jobVacancy = JobVacancy::findOrFail($id);
        $jobVacancy->update($validatedData);
        return redirect()->route('job-vacancy.show', $id)->with('success', 'Job Vacancy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobCategory = JobVacancy::findOrFail($id);
        $jobCategory->delete();
        return redirect()->route('job-vacancy.index')->with('success', 'Job Vacancy archived successfully.');
    }
    public function restore(Request $request, $id)
    {
        $jobCategory = JobVacancy::withTrashed()->findOrFail($id);
        $jobCategory->restore();
        return redirect()->route('job-vacancy.index', ["archived" => "true"])->with('success', 'Job Vacancy restored successfully.');
    }
}
