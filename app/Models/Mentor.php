<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'course_id',
        'education',
        'experience_years',
        'students',
        'image_url',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'mentor_skills');
    }

    public function getImageUrlAttribute($value)
    {
        if ($value && !str_starts_with($value, 'http')) {
            return asset('storage/' . ltrim($value, '/'));
        }
        return $value;
    }
}
