<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Singer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'address',
        'gender',
        'first_release_year',
        'no_of_albums_released',
    ];

    protected $hidden = ['created_at', 'updated_at']; //response ma na dekhaune haru hidden ma haldine

    public function music(): HasMany
    {
        return $this->hasMany(Music::class);
    }
}
