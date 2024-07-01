<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Music extends Model
{
    use HasFactory;

    public $table = 'musics'; //relationship bala ma table ko name pathaune raixa, as laravel guesses the table name if we not send

    protected $fillable = [
        'singer_id',
        'title',
        'album_name',
        'genre',
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public function singer(): BelongsTo
    {
        return $this->belongsTo(Singer::class);
    }
}
