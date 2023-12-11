<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image_title',
        'content',
        'content_title',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include active Post.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_date');
    }

    protected function getUpdatedAtAttribute($value) {
        if(! isset($value)) {
            return $value;
        }

        return \Carbon\Carbon::parse($value)->format('F, d Y');
    }

    protected function getContentAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value);
        }

        return $value;
    }
}
