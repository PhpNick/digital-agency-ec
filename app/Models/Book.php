<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Nicolaslopezj\Searchable\SearchableTrait;

class Book extends Model
{
    use HasFactory;
    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'books.author' => 10,
            'books.co_author' => 10,
            'books.title' => 10,
            'books.description' => 10,
            'books.created_at' => 10,
        ],
    ];    

    protected $fillable = [
        'author', 
        'co_author',
        'title',
        'description'
    ];

    public function scopeSortByAuthor($query)
    {
        return $query->orderBy('author', 'desc');
    }

    public function scopeSortByTitle($query)
    {
        return $query->orderBy('title', 'desc');
    }

    public function scopeSortByDescription($query)
    {
        return $query->orderBy('description', 'desc');
    } 

    public function scopeSortByDate($query)
    {
        return $query->orderBy('created_at', 'desc');
    }                      
}
