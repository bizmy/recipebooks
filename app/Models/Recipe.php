<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'link',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    protected $with = ['categories']; 
}

