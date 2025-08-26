<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MentorSkill extends Pivot
{
    // Agar sizga oddiy model kerak bo‘lsa, Model o‘rniga Pivot ishlatish yaxshiroq
    protected $table = 'mentor_skills';

    protected $fillable = [
        'mentor_id',
        'skill_id',
    ];

    public $timestamps = false; // Agar jadvalda created_at/updated_at bo‘lmasa
}
