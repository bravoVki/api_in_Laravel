<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UserImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // protected $middleware = ['auth:api',]; //middleware to check if user is authenticated

    //index
    public function index()
    {
        $user = User::paginate(3);
        return response()->json($user, 200);
    }

    //show
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    //update
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        // $user->update($request->all());
        // Exclude email from the update
        $user->fill($request->except('email'))->save();
        return response()->json(['message' => 'User updated', 'user' => $user], 200);
    }

    //delete
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }


    //
    public function export()
    {
        return Excel::download(new UsersExport, 'users', \Maatwebsite\Excel\Excel::CSV);
    }


    //import
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new UserImport, $request->file('file'));

        return response()->json(['message' => 'File imported successfully'], 200);
    }


    // public function import(Request $request)
    // {
    //     // Validate incoming request data
    //     $request->validate([
    //         'file' => 'required|max:2048',
    //     ]);

    //     Excel::import(new UserImport, $request->file('file'));

    //     return back()->with('success', 'Users imported successfully.');
    // }
}
