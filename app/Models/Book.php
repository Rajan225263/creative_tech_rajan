<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'published_year', 'bookshelf_id'];

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}

