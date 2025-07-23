<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentoSkill extends Model
{
    protected $table = 'mentor_skills';

    protected $fillable = ['mentor_id', 'skill_id'];
}
