<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Leaf\Model;

/**
 * @property $id
 * @property $pages Page[]
 * @property $user_id
 * @property $date
 * @property $custom_title
 */
class Broadcast extends Model
{
    function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class);
    }

    protected $fillable = ['user_id', 'date', 'custom_title'];
}
