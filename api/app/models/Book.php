<?php

namespace App\Models;

use Leaf\Model;

/**
 * @property $id
 * @property $title
 * @property $abbr
 * @property $lang
 * @property $url
 * @property $engine
 * @property $levels
 * @property $alias
 */
class Book extends Model
{

    public function scopeLanguage($query, $lang)
    {
        return $query
            ->where('lang', $lang);
    }
}
