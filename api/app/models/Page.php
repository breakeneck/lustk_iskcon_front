<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Leaf\Model;

/**
 * @property $id
 * @property $title
 * @property $level
 * @property $path
 * @property $book_id
 */
class Page extends Model
{
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
    public function scopeByChapter($query, $chapterId)
    {
        return $query
            ->where('chapter_id', $chapterId);
    }
}
