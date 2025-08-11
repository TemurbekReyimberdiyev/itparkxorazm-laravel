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
        // Agar value 'storage/' bilan boshlanmasa, uni qo'shib yuboramiz
        if ($value && !str_starts_with($value, 'http')) {
            return asset('storage/' . ltrim($value, '/'));
        }
        return $value;
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
