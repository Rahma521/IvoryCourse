<?php

namespace App\Models\Courses;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseStudent extends Model
{
    use SoftDeletes;

    protected $table = 'course_students';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['course_id', 'student_id'];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'student_id');
    }
}
