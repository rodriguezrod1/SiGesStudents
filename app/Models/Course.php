<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'schedule', 'start_date', 'end_date'];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
