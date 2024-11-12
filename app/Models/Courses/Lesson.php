<?php

namespace App\Models\Courses;

//use App\Traits\FilterableTrait;
//use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
  //  use FilterableTrait;
 //   use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'lessons';

    public $timestamps = true;

    protected array $dates = ['deleted_at'];

    protected $fillable = [
        'course_id',
        'chapter_id',
        'name_ar',
        'name_en',
        'duration',
        'video_hosting',
        'video_url',
        'video_file',
        'description_ar',
        'description_en',
        'is_active',
    ];

    protected array $filterableColumns = [
        [
            'columns' => ['name_ar', 'name_en'],
            'type' => 'like',
            'search_key' => 'search',
        ],
        [
            'columns' => 'chapter_id',
            'type' => 'equals',
        ],
        [
            'columns' => 'course_id',
            'type' => 'equals',
        ],
    ];

    protected $with = ['course', 'chapter', 'attachments'];

    protected $appends = ['name', 'description'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];


    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'name_'.app()->getLocale()}
        );
    }

    public function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'description_'.app()->getLocale()}
        );
    }

    // relations

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }
}
