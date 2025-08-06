<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = User::latest();


        if ($request->input("archived") == "true") {
            $query->onlyTrashed();
        }

        $users = $query->paginate(8)->onEachSide(1);
        return view("user.index", compact("users"));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = User::findOrFail($id);
        $query->delete();
        return redirect()->route('user.index')->with('success', 'The User archived successfully.');
    }
    /**
     * Restore the specified resource from storage.
     */
    public function restore(Request $request, $id)
    {
        $query = User::withTrashed()->findOrFail($id);
        $query->restore();
        return redirect()->route('user.index', ["archived" => "true"])->with('success', 'The User restored successfully.');
    }
}
