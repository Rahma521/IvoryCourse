<?php

namespace App\Models\Courses;

//use App\Models\Users\User;
//use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseReview extends Model
{
  //  use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'course_reviews';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = ['rate', 'comment', 'course_id', 'user_id'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
