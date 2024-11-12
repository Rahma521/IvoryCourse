<?php

namespace App\Models\Courses;

//use App\Enums\Courses\CourseDomainEnum;
//use App\Enums\Courses\CourseFreeEnum;
//use App\Enums\Courses\CourseLanguageEnum;
//use App\Enums\Courses\CourseLevelEnum;
//use App\Enums\Courses\CourseLiveTypeEnum;
//use App\Enums\Courses\CoursePurchaseEnum;
//use App\Enums\Courses\CourseScheduleStatusEnum;
//use App\Enums\Courses\CourseStatusEnum;
//use App\Enums\Courses\CourseTypeEnum;
//use App\Enums\Courses\VideoHostingEnum;
//use App\Enums\Options\ActiveEnum;
//use App\Enums\Options\FavoriteStatusEnum;
//use App\Enums\Options\MedicalType;
use App\Models\Exams\Exam;
use App\Models\User;
//use App\Models\Web\Favorite;
use App\Models\Web\Review;
//use App\Traits\FilterableTrait;
//use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
   // use FilterableTrait;
  //  use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'main_section_id',
        'sub_section_id',
        'instructor_id',
        'coordinator_id',
        'name_ar',
        'name_en',
        'video_hosting',
        'intro_video_url',
        'intro_video_file',
        'description_ar',
        'description_en',
        'requirements_ar',
        'requirements_en',
        'type',
        'language',
        'location',
        'is_free',
        'price',
        'is_purchase',
        'discount_price',
        'level',
        'duration_mints',
        'duration_hours',
        'keywords',
        'meta_description',
        'status',
        'expire_date',
        'domain',
        'course_live_type',
        'student_numbers',
        'lesson_numbers',
        'result_en',
        'result_ar',
        'max_student',
        'is_special',
        'is_active',
        'meta_tags',
        'medical_type',
        'is_discount',
    ];

    protected array $filterableColumns = [

        [
            'columns' => ['name_ar', 'name_en', 'instructor.name'],
            'type' => 'like',
            'search_key' => 'search',
        ],
        [
            'columns' => 'main_section_id',
            'type' => 'equals',
            'multiple' => true,
        ],
        [
            'columns' => 'instructor_id',
            'type' => 'equals',
            'multiple' => true,
        ],
        [
            'columns' => 'sub_section_id',
            'type' => 'equals',
            'multiple' => true,

        ],

        [
            'columns' => 'is_free',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'status',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'level',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'type',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'is_active',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'price',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'language',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'is_purchase',
            'type' => 'equals',
            'multiple' => true,

        ],
        [
            'columns' => 'reviews.stars',
            'type' => 'average_stars',
        ],

    ];

    protected $with = ['attachments'];

    protected $appends = ['name', 'description', 'requirements'];

    public $timestamps = true;

    protected array $dates = [
        'deleted_at',
        'start_date',
        'end_date',
    ];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

//    protected $casts = [
//        'type' => CourseTypeEnum::class,
//        'status' => CourseStatusEnum::class,
//        'schedule_status' => CourseScheduleStatusEnum::class,
//        'level' => CourseLevelEnum::class,
//        'language' => CourseLanguageEnum::class,
//        'video_hosting' => VideoHostingEnum::class,
//        'domain' => CourseDomainEnum::class,
//        'course_live_type' => CourseLiveTypeEnum::class,
//        //        'is_active' => ActiveEnum::class,
//        'is_free' => CourseFreeEnum::class,
//        'is_purchase' => CoursePurchaseEnum::class,
//        'medical_type' => MedicalType::class,
//    ];

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
    public function scopeByReviewStar($query, $star)
    {
        $avg = round($this->reviews()?->avg('stars'));
        return $query->where('stars', $star);
    }
    public function scopeReviewRate($query, Request $request): void
    {
        $query->when($request->has('star'), function ($query) use ($request) {
            $query->byReviewStar($request->input('star'));
        });
    }

    public function requirements(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'requirements_'.app()->getLocale()}
        );
    }

    public function result(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'result_'.app()->getLocale()}
        );
    }

    public function instructor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function coordinator(): HasOne
    {
        return $this->hasOne(Admin::class, 'id', 'coordinator_id');
    }

    public function mainSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'main_section_id');
    }

    public function subSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'sub_section_id');
    }

    public function exams(): HasManyThrough
    {
        return $this->hasManyThrough(Exam::class, Chapter::class, 'course_id', 'chapter_id', 'id', 'id');
    }

    public function examsCount(): int
    {
        return $this->chapters()->whereHas('exam')->count();
    }

    public function chapters(): BelongsToMany
    {
        return $this->belongsToMany(Chapter::class, 'course_chapters', 'course_id', 'chapter_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function favorites(): MorphMany
    {
        return $this->MorphMany(Favorite::class, 'favoriteable');
    }

    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            CourseStudent::class,
            'course_id',
            'id',
            'id',
            'student_id'
        );
    }

    public function chapterCounts(): int
    {
        return $this->belongsToMany(Chapter::class, 'course_chapters')->whereIsActive(ActiveEnum::active->value)->count();
    }

    public function studentCounts(): int
    {
        return $this->hasMany(CourseStudent::class, 'course_id', 'id')->count();
    }

    public function averageRate(): int
    {
        return round($this->reviews()?->avg('stars'));
    }

    public function calculateStarPercentages(?int $totalReviews): array
    {
        return collect(range(1, 5))
            ->mapWithKeys(function ($i) use ($totalReviews) {
                $count = $this->reviews()?->whereStars($i)->count() ?? 0;
                $percentage = $totalReviews ? ($count / $totalReviews) * 100 : 0;

                return ["{$i}_star" => (int) round($percentage)];
            })
            ->toArray();
    }

    public function favorite(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    public function IsFavorite(): int
    {
        if (!auth('api')->check()) {
            return  FavoriteStatusEnum::not_favorite->value;
        }

        $favorite = $this->favorite()?->whereUserId(auth('api')->id())->exists();

        return $favorite ? FavoriteStatusEnum::favorite->value : FavoriteStatusEnum::not_favorite->value;
    }

    public function scopeHighestRated(Builder $query): Builder
    {
        return $query->withAvg('reviews', 'stars')
            ->orderBy('reviews_avg_stars', 'desc');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }








}
