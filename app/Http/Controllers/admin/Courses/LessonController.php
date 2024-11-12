<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreLessonRequest;
use App\Http\Requests\Courses\UpdateLessonRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\Courses\LessonResource;
use App\Models\Courses\Chapter;
use App\Models\Courses\Course;
use App\Models\Courses\Lesson;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    use ResponseTrait;

    //TODO: list of lessons

    /**
     * @return JsonResponse
     */
    public function index(Request $request, Lesson $lesson, PageRequest $pageRequest)
    {
        $lessons = Lesson::filter($request, (array) $lesson->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: LessonResource::collection($lessons)->response()->getData(true));
    }

    //TODO : store lesson

    public function store(StoreLessonRequest $request): JsonResponse
    {
        $lesson = Lesson::create($request->safe()->except('attachments'));

        if ($request->attachments) {
            $lesson->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.added'), data: LessonResource::make($lesson));
    }

    //TODO : show specific lesson

    /**
     * @return JsonResponse
     */
    public function show(Lesson $lesson)
    {
        return self::successResponse(data: LessonResource::make($lesson));
    }

    //TODO: list of lesson by chapter

    public function lessonsByChapterId(Request $request, Chapter $chapter): jsonResponse
    {
        $lessons = lesson::whereChapterId($chapter->id)->get();

        return self::successResponse(data: LessonResource::collection($lessons));
    }

    //TODO : update specific lesson

    public function update(UpdateLessonRequest $request, Lesson $lesson): JsonResponse
    {
        $lesson->update($request->safe()->except('attachments'));

        if ($request->has('attachments')) {
            $lesson->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.updated'));
    }

    // TODO : delete specific lesson

    /**
     * @return JsonResponse
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return self::successResponse(message: __('application.deleted'));
    }

    public function lessonsByCourse(Request $request, Course $course, PageRequest $pageRequest): JsonResponse
    {
        $lessons = $course->lessons()
            ->filter($request, (array) $course->filterableColumns)
            ->paginate($pageRequest->page_count);

        return self::successResponse(data: LessonResource::collection($lessons)->response()->getData(true));
    }
}
