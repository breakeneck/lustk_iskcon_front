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
class Chapter extends Model
{
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
//    public function page(): BelongsTo
//    {
//        return $this->hasOne(Page::class, 'chapter_id');
//    }
    public function scopeContent($query, $bookId)
    {
        return $query
            ->where('book_id', $bookId)
            ->where('level', 1);
    }
    public function scopeSubchapters($query, Chapter $chapter)
    {
        return $query
            ->where('book_id', $chapter->book->id)
            ->where('level', $chapter->level + 1)
            ->where('path', 'LIKE', $chapter->path . '/%');
    }


}
