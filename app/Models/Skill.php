<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_url'];

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class, 'mentor_skills');
    }
}
