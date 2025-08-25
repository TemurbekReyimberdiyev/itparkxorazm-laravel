<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_path'];

    protected $appends = ['full_image_url'];

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class, 'mentor_skills');
    }

    // 🔽 Full image URL accessor
    public function getFullImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }
}
