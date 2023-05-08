<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntityGenres extends Model
{
    use HasFactory;
    protected $table = 'entity_genres';

    protected $fillable = [
        'entity_type_id',
        'entity_id',
        'genre_id',
    ];

    public function movie(): BelongsTo
   {
       return $this->belongsTo(Movie::class);
   }
}
