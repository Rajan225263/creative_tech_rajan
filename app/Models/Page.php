<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['page_number', 'content', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}

