<?php

namespace App\Http\Controllers;

use App\Exports\MusicExport;
use App\Imports\MusicImport;
use App\Models\Music;
use App\Models\Singer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class MusicController extends Controller
{
    // index
    public function index()
    {
        $musics = Music::with('singer')->latest()->simplePaginate(5); //will give songs with detials of singer
        return response()->json($musics, 200);
    }

    //create
    public function create(Request $request)
    {
        $validatedAttr = request()->validate([
            'singer_id' => 'required',
            'title' => 'required|unique:musics,title|min:3',
            'album_name' => 'required',
            'genre' => 'required|in:pop,rock,classic,jazz,rnb',
        ]);

        if (!Singer::find($validatedAttr['singer_id'])) {
            return response()->json(['message' => 'Singer does not exist'], 404);
        }

        $musics = Music::create($validatedAttr);
        return response()->json([
            "message" => "Music created successfully",
            'music' => $musics
        ]);
    }


    //show
    public function show($id)
    {
        $music = Music::find($id);
        if (is_null($music)) {
            return response()->json([
                "message" => "Music not found"
            ]);
        }
        return response($music, 200);
    }

    //update
    public function update(Request $request, $id)
    {
        $music = Music::find($id);
        if (!$music) {
            return response()->json(['message' => 'Music not found'], 404);
        }
        $music->update($request->all());
        return response()->json(['message' => 'Music updated', 'music' => $music], 200);
    }

    //delete
    public function destroy($id)
    {
        $music = Music::find($id);
        if (!$music) {
            return response()->json(['message' => 'Music not found'], 404);
        }
        $music->delete();
        return response()->json(['message' => 'Music deleted']);
    }

    //export
    public function export()
    {
        return Excel::download(new MusicExport, 'music.xlsx', \Maatwebsite\Excel\Excel::CSV);
    }

    //import
    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
        Excel::import(new MusicImport, $request->file('file'));
        return response()->json(['message' => 'File imported successfully'], 200);
    }
}
