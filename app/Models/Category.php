<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe; // Import Recipe model

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Define the relationship with recipes here...
    public function recipes()
{
    return $this->hasMany(Recipe::class);
}

}

