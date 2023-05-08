<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieActors extends Model
{
    use HasFactory;
    protected $table = 'movie_actors';

    protected $fillable = [
        'movie_id',
        'actor_id',
    ];

    public function movie(): BelongsTo
   {
       return $this->belongsTo(Movie::class);
   }
}
