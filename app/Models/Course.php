<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $guarded = [
        'id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions(){
        return $this->hasMany(CourseQuestion::class, 'course_id','id');

    }

    function students()
    {
        return $this->belongsToMany(User::class, 'course_students', 'course_id', 'user_id');
    }
}
