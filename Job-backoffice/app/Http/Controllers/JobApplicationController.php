<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationUpdateRequest;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobApplication::latest();


        if ($request->input("archived") == "true") {
            $query->onlyTrashed();
        }

        $applications = $query->paginate(8)->onEachSide(1);
        return view("jobApplication.index", compact("applications"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = JobApplication::findOrFail($id);
        return view("jobApplication.show", compact("application"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, string $id)
    {
        $application = JobApplication::findOrFail($id);
        $application->update([
            "status" => $request->input("status"),
        ]);
        return redirect()->route("job-application.show", $id)->with("success", "status updated to " . $application->status . " sccessfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->delete();
        return redirect()->route('job-application.index')->with('success', 'Application archived successfully.');
    }
    /**
     * Restore the specified resource from storage.
     */
    public function restore(Request $request, $id)
    {
        $jobApplication = JobApplication::withTrashed()->findOrFail($id);
        $jobApplication->restore();
        return redirect()->route('job-application.index', ["archived" => "true"])->with('success', 'Application restored successfully.');
    }
}
