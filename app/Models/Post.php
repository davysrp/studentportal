<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'slug',
        'status',
        'description',
        'images',
        'parent_id',
    ];
}
