<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chapter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    protected static function booted()
    {
        static::creating(function ($course) {
            $course->user_id = auth()->id();
        });
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
