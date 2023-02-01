<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
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

    /* Ja és així per defecte, només apuntat com a referència */
//    public function searchableAs()
//    {
//        return 'posts';
//    }

    /* En principi això es fa ja per defecte */
    public function toSearchableArray(): array
    {
        return [
            'id' => (int)$this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => (int)$this->user_id,
            'category_id' => (int)$this->category_id,
        ];
    }
}
