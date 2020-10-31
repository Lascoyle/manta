<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chapter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Course extends Model
{
    use HasFactory;
    use Authorizable;

    protected $fillable = ['title', 'description', 'user_id'];

    protected $appends = ['update'];

    protected static function booted()
    {
        static::creating(function ($course) {
            $course->user_id = auth()->id();
        });
    }

    public function getUpdateAttribute()
    {
        return $this->can('update-course', $this);
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
