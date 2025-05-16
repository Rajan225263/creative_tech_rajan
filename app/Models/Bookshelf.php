<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookshelf extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

