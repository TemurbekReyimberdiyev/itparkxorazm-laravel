<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'mail',
        'course_id',
        'message',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
