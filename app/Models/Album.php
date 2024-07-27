<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'year', 
        'image', 
        'label', 
        'producer'
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
