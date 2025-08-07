<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'heading',
        'description',
        'duration_month',
        'image_url',
        'cost',
    ];

    // Accessor for full image URL
    public function getImageUrlAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mentors()
    {
        return $this->hasMany(Mentor::class); // change to belongsToMany if it's many-to-many
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
