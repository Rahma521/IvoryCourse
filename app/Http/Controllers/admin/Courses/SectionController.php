<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Exports\Courses\SectionExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreSectionRequest;
use App\Http\Requests\Courses\UpdateSectionRequest;
use App\Http\Requests\Settings\PageRequest;
use App\Http\Resources\Courses\mainSectionResource;
use App\Http\Resources\Courses\SectionResource;
use App\Http\Resources\Courses\SubSectionResource;
use App\Http\Resources\Settings\ExportResource;
use App\Models\Courses\Section;
use App\Services\Settings\ExportService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use ResponseTrait;

    private ExportService $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    //TODO: list of MainSections and it's SubSections with pagination

    public function index(Request $request, Section $section, PageRequest $pageRequest): JsonResponse
    {
        $sections = Section::filter($request, (array) $section->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: SectionResource::collection($sections)->response()->getData(true));
    }

    public function export(Request $request, Section $section)
    {
        $sections = Section::filter($request, (array) $section->filterableColumns)->get();
        $file_path = $this->exportService->export(new SectionExport($sections), 'sections');

        return self::successResponse(data: ExportResource::make($file_path));
    }

    // TODO: list of MainSections
    public function mainSections(Request $request, Section $section): JsonResponse
    {
        $sections = Section::whereParentId(null)->filter($request, (array) $section->filterableColumns)->get();

        return self::successResponse(data: mainSectionResource::collection($sections));
    }

    public function mainSectionsWithParent(Request $request, Section $section): JsonResponse
    {
        $sections = Section::where('parent_id', '!=', 'null')->filter($request, (array) $section->filterableColumns)->get();

        return self::successResponse(data: mainSectionResource::collection($sections));
    }

    // TODO: list of SubSections
    public function subSectionsList(Section $section): JsonResponse
    {
        $sections = Section::whereParentId($section->id)->get();

        return self::successResponse(data: SubSectionResource::collection($sections));
    }

    // TODO: list of SubSections for specific MainSection

    public function subSections(Request $request, Section $section): JsonResponse
    {
        $sections = $section->sections()->filter($request, (array) $section->filterableColumns)->paginate(10);

        return self::successResponsePaginate(data: SectionResource::collection($sections)->response()->getData(true));
    }

    // TODO: create new section

    public function store(StoreSectionRequest $request): JsonResponse
    {
        $section = Section::create($request->validated());

        if ($request->attachments) {
            $section->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.added'), data: SectionResource::make($section));
    }

    //TODO: show specific section

    public function show(Section $section): JsonResponse
    {
        return self::successResponse(data: SectionResource::make($section));
    }

    // TODO: update specific section

    public function update(UpdateSectionRequest $request, Section $section): JsonResponse
    {
        $section->update($request->validated());

        if ($request->attachments) {
            $section->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.updated'), data: SectionResource::make($section));
    }

    // TODO: delete specific section

    public function destroy(Section $section): JsonResponse
    {
        if ($section->courses()->count() > 0) {
            return self::failResponse(400, message: __('application.cannot_delete'));
        }
        $section->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}
