<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    use HasFactory;

     protected $fillable = [
        'title', 'content', 'image','admin_id',
    ];

     protected $appends = ['image_url'];

     public function getImageUrlAttribute()
    {
        // Combine values from database columns, e.g., 'title' and 'content'
        return 'http://localhost:8000/storage/'. $this->attributes['image'];
    }

    public function comments() {
        return $this->hasMany(Comments::class);
    }

     public function admin() {
        return $this->belongsTo(User::class);
    }
}
