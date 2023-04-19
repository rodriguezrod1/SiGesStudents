<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'last_name', 'age', 'email'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
