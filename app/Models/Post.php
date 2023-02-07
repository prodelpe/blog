<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
    ];

    public $translatable = [
        'title',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

//    public function toSearchableArray(): array
//    {
//        return [
//            'id' => $this->getKey(),
//            'title' => $this->title,
//            'body' => $this->body,
//            'user_id' => (int)$this->user_id,
//            'category_id' => (int)$this->category_id,
//        ];
//    }

//    protected function makeAllSearchableUsing($query)
//    {
//        return $query->with(['user:id,name', 'category:id,name']);
//    }

    public function getTranslatedData(string $lang): array
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, $lang);
        }
        return $attributes;
    }
}
