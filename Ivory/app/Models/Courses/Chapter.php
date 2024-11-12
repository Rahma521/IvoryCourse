<?php

namespace App\Models\Courses;

//use App\Enums\Options\ActiveEnum;
//use App\Models\Exams\Exam;
//use App\Traits\FilterableTrait;
//use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
   // use FilterableTrait;
   // use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'chapters';

    protected $fillable = ['name_ar', 'name_en', 'is_active', 'course_id'];

    protected array $filterableColumns = [
        [
            'columns' => ['name_ar', 'name_en'],
            'type' => 'like',
            'search_key' => 'search',
        ],
        [
            'columns' => 'is_active',
            'type' => 'equals',
        ],
    ];

    protected $appends = ['name'];

    protected array $dates = ['deleted_at'];

    public $timestamps = true;

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $with = ['attachments'];

    protected $casts = [
        'is_active' => ActiveEnum::class,
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'name_'.app()->getLocale()}
        );
    }

    // relations phase 1

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'chapter_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }


    public function courseChapters(): HasMany
    {
        return $this->hasMany(CourseChapter::class, 'chapter_id');
    }
}
