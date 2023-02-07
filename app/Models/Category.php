<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
        'description'
    ];

    public $translatable = [
        'name',
        'description'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
