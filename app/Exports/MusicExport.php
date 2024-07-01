<?php

namespace App\Exports;

use App\Models\Music;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MusicExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Music::select('singer_id', 'title', 'album_name', 'genre')->get();
    }

    public function headings(): array
    {
        return [
            'singer_id',
            'title',
            'album_name',
            'genre'
        ];
    }
}
