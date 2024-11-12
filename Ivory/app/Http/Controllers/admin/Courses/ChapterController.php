<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreChapterExamRequest;
use App\Http\Requests\Courses\StoreChapterRequest;
use App\Http\Requests\Courses\UpdateChapterExamRequest;
use App\Http\Requests\Courses\UpdateChapterRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\Courses\ChapterListResource;
use App\Http\Resources\Courses\ChapterResource;
use App\Http\Resources\Exams\ExamResource;
use App\Models\Courses\Chapter;
use App\Models\Courses\Course;
use App\Models\Courses\CourseChapter;
use App\Models\Exams\Exam;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChapterController extends Controller
{
    use ResponseTrait;

    //TODO: list of chapters with filter

    public function index(Request $request, Chapter $chapter, PageRequest $pageRequest): JsonResponse
    {
        $chapters = Chapter::filter($request, (array) $chapter->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: ChapterResource::collection($chapters)->response()->getData(true));
    }

    //TODO: create new chapter


    public function store(StoreChapterRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $chapter = Chapter::create($request->safe()->except('attachments'));
            CourseChapter::create([
                'chapter_id' => $chapter->id,
                'course_id' => $request->safe()->only('course_id')['course_id']
            ]);

            if ($request->attachments) {
                $chapter->assignAttachment($request->attachments);
            }
            DB::commit();
            return self::successResponse(message: __('application.added'), data: ChapterResource::make($chapter));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('chapter creation failed: ' . $e->getMessage(), ['exception' => $e]);
            return self::failResponse(500, message: __('application.error'));
        }
    }

    //TODO: show chapter

    public function show(Chapter $chapter): JsonResponse
    {
        return self::successResponse(data: ChapterResource::make($chapter));
    }

    //TODO: update chapter

    public function update(UpdateChapterRequest $request, Chapter $chapter): JsonResponse
    {
        $chapter->update($request->safe()->except('attachments'));

        if ($request->has('attachments')) {
            $chapter->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.updated'), data: ChapterResource::make($chapter));
    }

    public function chaptersByCourse(Course $course): JsonResponse
    {
        $chaptersByCourse = Chapter::whereCourseId($course->id)->get();

        return self::successResponse(data: ChapterResource::collection($chaptersByCourse));
    }

    public function chaptersList(Course $course): JsonResponse
    {
        $chaptersByCourse = Chapter::whereCourseId($course->id)->get();

        return self::successResponse(data: ChapterListResource::collection($chaptersByCourse));
    }

    public function storeChapterToExam(StoreChapterExamRequest $request, Exam $exam): JsonResponse
    {
        $exam->update(['chapter_id' => $request->chapter_id]);

        return self::successResponse(message: __('application.added'), data: ExamResource::make($exam));
    }

    public function updateChapterExam(UpdateChapterExamRequest $request, Exam $exam): JsonResponse
    {
        $newExam = Exam::find($request->new_exam_id);
        $newExam->update(['chapter_id' => $exam->chapter_id]);
        $exam->update(['chapter_id' => null]);

        return self::successResponse(message: __('application.added'));
    }

    public function deleteChapterExam(StoreChapterExamRequest $request, Exam $exam): JsonResponse
    {
        $exam->update(['chapter_id' => null]);

        return self::successResponse(message: __('application.deleted'));
    }

    //TODO: delete chapter

    public function destroy(Chapter $chapter): JsonResponse
    {
        if ($chapter->lessons()->count() > 0) {
            return self::failResponse(400, message: __('application.chapter_has_lessons'));
        }
        DB::beginTransaction();
        try {
            $chapter->attachments()->delete();
            $chapter->courseChapters()->delete();
            $chapter->delete();
            DB::commit();
            return self::successResponse(message: __('application.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('chapter cant deleted: ' . $e->getMessage(), ['exception' => $e]);
            return self::failResponse(500, message: __('application.error'));
        }
    }
}
