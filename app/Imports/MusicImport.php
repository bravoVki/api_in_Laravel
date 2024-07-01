<?php

namespace App\Imports;

use App\Models\Music;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MusicImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Music([
            //
            'singer_id' => $row['singer_id'],
            'title' => $row['title'],
            'album_name' => $row['album_name'],
            'genre' => $row['genre'],
        ]);
    }
    public function rules(): array
    {
        return
            [
                'singer_id' => 'required',
                'title' => 'required|unique:musics,title|min:3',
                'album_name' => 'required',
                'genre' => 'required|in:pop,rock,classic,jazz,rnb'
            ];
    }
}
