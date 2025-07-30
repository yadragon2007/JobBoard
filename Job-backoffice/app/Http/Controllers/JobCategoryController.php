<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use \App\Http\Requests\JobCategoryCreateRequest;
use \App\Http\Requests\JobCategoryUpdateRequest;
class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $query = JobCategory::latest();


        if ($request->input("archived") == "true") {
            $query->onlyTrashed();
        }

        $categories = $query->paginate(8)->onEachSide(1);
        return view("jobCategory.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("jobCategory.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCategoryCreateRequest $request)
    {
        $validatedData = $request->validated();
        JobCategory::create($validatedData);
        return redirect()->route('job-category.index')->with('success', 'Job Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = JobCategory::findOrFail($id);

        return view("jobCategory.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCategoryUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->update($validatedData);   
        return redirect()->route('job-category.index')->with('success', 'Job Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->delete();
        return redirect()->route('job-category.index')->with('success', 'Job Category archived successfully.');
    }
      public function restore(Request $request, $id)
    {
        $jobCategory = JobCategory::withTrashed()->findOrFail($id);
        $jobCategory->restore();
        return redirect()->route('job-category.index',["archived" => "true"])->with('success', 'Job Category restored successfully.');
    }
}
