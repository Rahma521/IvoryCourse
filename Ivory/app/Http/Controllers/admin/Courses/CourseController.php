<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Enums\Courses\CourseTypeEnum;
use App\Exports\Courses\CourseExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\CourseTypeRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Requests\Users\StoreCoordinatorUsersToCourseRequest;
use App\Http\Requests\Users\StoreEmployeeToCourseRequest;
use App\Http\Requests\Users\StoreStudentToCourseRequest;
use App\Http\Requests\Users\UpdateEmployeeToCourseRequest;
use App\Http\Resources\Courses\CourseDetailsResource;
use App\Http\Resources\Courses\CourseResource;
use App\Http\Resources\Settings\ExportResource;
use App\Http\Resources\Settings\HomeResource;
use App\Http\Resources\Users\AdminResource;
use App\Http\Resources\Users\UserResource;
use App\Mail\AddNewCourseToManager;
use App\Mail\CancelCourseToEmployee;
use App\Mail\ExternalTrainings\ExternalAcceptedHrRequestToManager;
use App\Models\Courses\Course;
use App\Models\Courses\CourseEmployee;
use App\Models\Courses\CourseSchedule;
use App\Models\Courses\CourseStudent;
use App\Models\Settings\Branch;
use App\Models\Training\MandatoryTraining\Attendance;
use App\Models\Users\Admin;
use App\Models\Users\User;
use App\Services\CourseService;
use App\Services\Settings\ExportService;
use App\Services\Settings\FcmNotificationsService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    use ResponseTrait;

    private CourseService $courseService;

    private ExportService $exportService;
    private FcmNotificationsService $notificationsService;


    public function __construct(CourseService $courseService, ExportService $exportService,FcmNotificationsService $notificationsService,
    )
    {
        $this->courseService = $courseService;
        $this->exportService = $exportService;
        $this->notificationsService = $notificationsService;

    }
    public function getHumanResources()
    {
        return Admin::whereHas('roles', function ($query) {
            $query->where('name', '=', 'human_resource');
        })->get();

    }

    //TODO: list of courses with filter

    /**
     * @return JsonResponse
     */
    public function index(Request $request, Course $course, PageRequest $pageRequest)
    {
        $courses = Course::filter($request, (array)$course->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseResource::collection($courses)->response()->getData(true));
    }

    public function export(Request $request, Course $course)
    {
        $courses = Course::filter($request, (array)$course->filterableColumns)->get();
        $file_path = $this->exportService->export(new CourseExport($courses), 'courses');

        return self::successResponse(data: ExportResource::make($file_path));
    }

    //TODO: list of course with details wit-h filter

    /**
     * @return JsonResponse
     */
    public function coursesWithDetails(Request $request, Course $course, PageRequest $pageRequest)
    {
        $courses = Course::filter($request, (array)$course->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(
            data: CourseDetailsResource::collection($courses)->response()->getData(true)
        );
    }

    //TODO: show specific course with details

    /**
     * @return JsonResponse
     */
    public function courseWithDetails(Course $course)
    {
        return self::successResponse(data: CourseDetailsResource::make($course));
    }

    //TODO: create new Course

    public function store(StoreCourseRequest $request): JsonResponse
    {
        $courseData = $request->safe()->except('attachments', 'start_date', 'end_date', 'start_time', 'end_time');
        $courseScheduleData = $request->safe()->only('start_date', 'end_date', 'start_time', 'end_time');
        $course = Course::create($courseData);

        if ($request->type !== CourseTypeEnum::online->value) {
            $courseScheduleData['course_id'] = $course->id;
            CourseSchedule::create($courseScheduleData);
        }

        if ($request->attachments) {
            $course->assignAttachment($request->attachments);
        }

        Mail::to($this->getHumanResources()->pluck('email')->toArray())->send(new AddNewCourseToManager());

        return self::successResponse(message: __('application.added'), data: CourseResource::make($course));
    }

    // TODO: show specific course

    /**
     * @return JsonResponse
     */
    public function show(Course $course)
    {
        return self::successResponse(data: CourseResource::make($course));
    }

    // TODO: show specific course by instructor

    public function coursesByInstructor(
        User        $instructor,
        Request     $request,
        Course      $course,
        PageRequest $pageRequest
    ): JsonResponse
    {
        $courses = Course::whereInstructorId($instructor->id)
            ->filter($request, (array)$course->filterableColumns)
            ->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseResource::collection($courses)->response()->getData(true));
    }


    public function coursesByCoordinator(
        Admin       $coordinator,
        Request     $request,
        Course      $course,
        PageRequest $pageRequest
    ): JsonResponse
    {
        $courses = Course::whereCoordinatorId($coordinator->id)->filter(
            $request,
            (array)$course->filterableColumns
        )->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseResource::collection($courses)->response()->getData(true));
    }

    //TODO: update specific course

    public function update(UpdateCourseRequest $request, Course $course): JsonResponse
    {
        $courseData = $request->safe()->except('attachments', 'start_date', 'end_date', 'start_time', 'end_time');
        $courseScheduleData = $request->safe()->only('start_date', 'end_date', 'start_time', 'end_time');
        $course->update($courseData);
        if ((int)$request->type == CourseTypeEnum::zoom->value || (int)$request->type == CourseTypeEnum::offline->value) {
            $courseSchedule = CourseSchedule::whereCourseId($course->id)->first();
            $courseSchedule->update($courseScheduleData);
        }

        if ($request->attachments) {
            $course->assignAttachment($request->attachments);
        }
            $this->notificationsService->sendToUsers($course->instructor()->pluck('email')->toArray(), __('application.updateCourse'), 'App\Notifications\Courses\ChangeToCoursesInstructor',__('application.UpdateCoursePleaseReview'));

        return self::successResponse(__('application.updated'), CourseResource::make($course));
    }

    //TODO: delete specific course

    /**
     * @return JsonResponse
     */
    public function destroy(Course $course)
    {
        foreach ($course->mandatoryLectures as $lecture) {
            $lecture->mandatorySubscriptions()->forceDelete();
            $lecture->times()->forceDelete();
        }
        $course->mandatoryLectures()->forceDelete();
        $course->delete();

        return self::successResponse(message: __('application.deleted'));
    }

    public function coursesByType(CourseTypeRequest $request, Course $course, PageRequest $pageRequest)
    {
        $courses = Course::whereType($request->type)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseResource::collection($courses)->response()->getData(true));
    }

    public function studentsByCourse(Course $course, PageRequest $pageRequest): JsonResponse
    {
        //hold
        $trainings = $course->load('students')->students;

        return self::successResponse(data: UserResource::collection($trainings)->response()->getData(true));
    }

    //todo: assignStudentToCourse
    public function assignStudentToCourse(StoreStudentToCourseRequest $request)
    {
        CourseStudent::create($request->safe()->all());

        return self::successResponse(__('application.added'));
    }

    //todo: assignEmployeeToCourse
    public function assignEmployeeToCourse(StoreEmployeeToCourseRequest $request)
    {
        CourseEmployee::create($request->safe()->all());

        return self::successResponse(__('application.added'));
    }

    public function deleteUserFromCourse(UpdateEmployeeToCourseRequest $request)
    {
        if ($request->employee_id) {
            CourseEmployee::whereEmployeeId($request->employee_id)
                ->whereCourseId($request->course_id)
                ->delete();

            return self::successResponse(__('application.delete_employee_successful'));
        }

        if ($request->student_id) {
            CourseStudent::whereStudentId($request->student_id)
                ->whereCourseId($request->course_id)
                ->delete();

            return self::successResponse(__('application.delete_student_successful'));
        }
    }

    //todo : getUsersEnrolledCourses


    public function attendUsersToCourse(StoreCoordinatorUsersToCourseRequest $request, Course $course)
    {
        $validatedData = $request->validated();
        $users = $validatedData['users'] ?? [];
        $admins = $validatedData['admins'] ?? [];

        foreach ($users as $userId) {
            Attendance::create([
                'course_id' => $course->id,
                'user_id' => $userId,
                'admin_id' => null,
                'day' => $validatedData['day'],
                'time' => $validatedData['time'],
            ]);
        }

        foreach ($admins as $adminId) {
            Attendance::create([
                'course_id' => $course->id,
                'user_id' => null,
                'admin_id' => $adminId,
                'day' => $validatedData['day'],
                'time' => $validatedData['time'],
            ]);
        }

        return self::successResponse(__('application.added'));
    }

    public function getCoordinatorCourses(Request $request, Branch $branch, PageRequest $pageRequest): JsonResponse
    {
        $courses = Course::where('coordinator_id', auth('admin')->id())->filter($request, (array)$branch->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponse(data: CourseDetailsResource::collection($courses));
    }
}
