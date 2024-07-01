<?php

namespace App\Http\Controllers;

use App\Models\Singer;
use Illuminate\Http\Request;


class SingerController extends Controller
{

    //create
    public function create(Request $request)
    {
        $validatedAttr = request()->validate([
            'name' => 'required|unique:singers,name|min:3',
            'dob' => 'required',
            'gender' => 'required|in:male,female,others',
            'address' => 'required',
            'first_release_year' => 'required',
            'no_of_albums_released' => 'required',

        ]);

        $singer = Singer::create($validatedAttr);

        return response()->json([
            "message" => "Singer created successfully",
            'singer' => $singer

        ]);
    }

    //index
    public function index()
    {
        $singer = Singer::Paginate(5);
        if (count($singer) == 0) {
            return response()->json([
                "message" => "No singers found"
            ]);
        }
        return response($singer, 200);
    }

    //show
    public function show($id)
    {
        $singer = Singer::find($id);
        if (!$singer) {
            return response()->json(['message' => 'Singer not found'], 404);
        }
        return response($singer, 200);
    }

    //update
    public function update(Request $request, $id)
    {
        $singer = Singer::find($id);
        if (!$singer) {
            return response()->json(['message' => 'Singer not found'], 404);
        }
        $singer->update($request->all());
        return response()->json(['message' => 'Singer updated', 'singer' => $singer], 200);
    }
    //delete
    public function destroy($id)
    {
        $singer = Singer::find($id);
        if (!$singer) {
            return response()->json(['message' => 'singer not found'], 404);
        }
        $singer->delete();

        return response()->json(['message' => 'singer deleted']);
    }
}
