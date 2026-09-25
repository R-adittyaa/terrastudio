<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('chapter_number', 'asc');
    }
}