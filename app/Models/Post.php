<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'category_id',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the post
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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

    protected function getUpdatedAtAttribute($value)
    {
        if (!isset($value)) {
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
    /**
     * Scope a query by content
     *
     * @param String $content
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByContentTitle($query, string $content): Builder
    {
        return $query->orWhere('content_title', 'like', "%$content%");
    }

     /**
     * Scope a query by content
     *
     * @param String $content
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByTitle($query, string $title): Builder
    {
        return $query->orWhere('title', 'like', "%$title%");
    }

    /**
     * Scope a query by name
     *
     * @param String $content
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByUserName($query, string $name): Builder
    {
        return $query->whereHas('user', function ($subquery) use ($name) {
            $subquery->where('name', 'like', '%' . $name . '%');
        });
    }


    /**
     * Scope a query by category name
     *
     * @param String $categoryName
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategoryName($query, string $categoryName): Builder
    {
        return $query->whereHas('category', function ($subquery) use ($categoryName) {
            $subquery->where('name', 'like', '%' . $categoryName . '%');
        });
    }
}
