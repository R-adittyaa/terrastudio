<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}