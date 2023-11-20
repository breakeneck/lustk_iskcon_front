<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Leaf\Model;

/**
 * @property $id
 * @property $path
 * @property $sanskrit
 * @property $search_sanskrit
 * @property $wordly
 * @property $txt
 * @property $comment
 * @property $chapter_id
 * @property $book_id
 */
class Page extends Model
{
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function scopeByChapter($query, $chapterId)
    {
        return $query
            ->where('chapter_id', $chapterId);
    }
}
