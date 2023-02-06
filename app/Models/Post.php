<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory;
    use Searchable;
    use HasTranslations;

    protected $fillable = [
        'title',
        'content',
    ];

    public $translatable = [
        'title',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getKey(),
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => (int)$this->user_id,
            'category_id' => (int)$this->category_id,
        ];
    }

    protected function makeAllSearchableUsing($query)
    {
        return $query->with(['user:id,name', 'category:id,name']);
    }
}
