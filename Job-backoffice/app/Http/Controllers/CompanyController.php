<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use \App\Http\Requests\JobCategoryCreateRequest;
use \App\Http\Requests\JobCategoryUpdateRequest;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Company::latest();


        if ($request->input("archived") == "true") {
            $query->onlyTrashed();
        }

        $companies = $query->paginate(8)->onEachSide(1);
        return view("company.index", compact("companies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("company.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $validatedData = $request->validated();
        // create owner
        $owner = User::create([
            "name" => $validatedData["ownerName"],
            "email" => $validatedData["email"],
            "password" => Hash::make($validatedData["password"]),
            "role" => "company-owner"
        ]);
        // return error If owner creation fials
        if (!$owner) {
            return redirect()->route("company.create")->with("error", "Failed to create owner!");
        }
        // create company
        Company::create([
            'name' => $validatedData["name"],
            "location" => $validatedData["location"],
            "industry" => $validatedData["industry"],
            "website" => $validatedData["website"],
            "owner_id" => $owner->id
        ]);

        return redirect()->route('company.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $query = Company::latest();


        if ($request->input("archived") == "true") {
            $query->onlyTrashed();
        }

        $company = $query->findOrFail($id);
        return view("company.show", compact("company"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);

        return view("company.edit", compact("company"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $company = Company::findOrFail($id);
        $company->update([
            'name' => $validatedData["name"],
            'location' => $validatedData["location"],
            'industry' => $validatedData["industry"],
            'website' => $validatedData["website"],
        ]);
        $company->owner->update([
            "name" => $validatedData["ownerName"]
        ]);

        return redirect()->route('company.show', $id)->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobCategory = Company::findOrFail($id);
        // $owner = User::findOrFail($jobCategory->owner_id);
        $jobCategory->delete();
        // $owner->delete();
        return redirect()->route('company.index')->with('success', 'Company archived successfully.');
    }

    /**
     * Restore the specified resource from trashe.
     */

    public function restore(Request $request, $id)
    {
        $jobCategory = Company::withTrashed()->findOrFail($id);
        $jobCategory->restore();
        // $owner = User::withTrashed()->findOrFail($jobCategory->owner_id);
        // $owner->restore();

        return redirect()->route('company.index', ["archived" => "true"])->with('success', 'Company restored successfully.');
    }
}
