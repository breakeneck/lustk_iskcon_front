<?php

namespace App\Models;


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
    public function scopeContent($query, $bookId)
    {
        return $query
            ->where('book_id', $bookId)
            ->where('level', 1);
    }
}
