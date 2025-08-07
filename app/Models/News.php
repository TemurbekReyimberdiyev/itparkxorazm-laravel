<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    // Fillable ustunlar
    protected $fillable = ['heading', 'description', 'image_url'];

    // JSON response ga avtomatik qo‘shiladigan custom atribut
    protected $appends = ['full_image_url'];

    /**
     * image_url ustuni uchun to‘liq URL (frontendga yuborish uchun)
     */
    public function getFullImageUrlAttribute()
    {
        return $this->image_url ? asset('storage/' . $this->image_url) : null;
    }
}
