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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function mentors()
    {
        return $this->hasMany(Mentor::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
