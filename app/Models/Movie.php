<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'image',
        'release_date',
        'rating',
        'award_winning',
    ];

    public function genres()
    {
        return $this->hasMany(EntityGenres::class, 'entity_id', 'id');
    }

    public function actors()
    {
        return $this->hasMany(MovieActors::class, 'movie_id', 'id');
    }
}
