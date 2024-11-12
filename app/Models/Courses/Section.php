<?php

namespace App\Models\Courses;

//use App\Traits\FilterableTrait;
//use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Section extends Model
{
   // use FilterableTrait;
   // use HasAttachmentTrait;
    use SoftDeletes;

    protected $table = 'sections';

    public $timestamps = true;

    protected $with = ['sections', 'attachments'];

    protected $fillable = ['parent_id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'is_active'];

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

    protected array $dates = ['deleted_at'];

    protected $appends = ['name', 'description'];

    protected $hidden = ['create_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'is_active' => ActiveEnum::class,
    ];

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

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'parent_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'parent_id');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'main_section_id');
    }

    public function scopeActiveMainSection(Builder $query): Builder
    {
        return $query->whereParentId(null)
            ->whereIsActive(ActiveEnum::active->value);
    }
}
