@extends('AdminPanel.layouts.master')
@section('content')

<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-link">{{$title}}</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-2">
                    <thead>
                        <tr>
                            <th>{{trans('common.photo')}}</th>
                            {{-- <th>{{trans('common.description')}}</th> --}}
                            <th class="text-center">{{trans('common.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                        <tr id="row_{{$partner->id}}">
                            <td>
                                <span class="avatar mb-2">
                                    <img class="round" src="{{ $partner->photolink() }}" alt="avatar" height="150" width="150">
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="javascript:;" data-bs-target="#editfaq{{$partner->id}}" data-bs-toggle="modal"
                                    class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-link="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>
                                <?php $delete = route('admin.partners.delete',['id'=>$partner->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger"
                                    onclick="confirmDelete('{{$delete}}','{{$partner->id}}')" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-link="{{trans('common.delete')}}">
                                    <i data-feather='trash-2'></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center ">
                                <h2>{{trans('common.nothingToView')}}</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @foreach($partners as $partner)
            <div class="modal fade text-md-start" id="editfaq{{$partner->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">{{trans('common.edit')}}</h1>
                            </div>
                            {{Form::open(['url'=>route('admin.partners.update',['id'=>$partner->id]),
                            'id'=>'editfaqForm',
                            'class'=>'row gy-1 pt-75','files'=>'true'])}}
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="link_ar">{{trans('common.link_ar')}}</label>
                                {{Form::text('link_ar',$partner->link_ar,['id'=>'link_ar', 'class'=>'form-control'])}}
                            </div>

                            <div class="col-12 col-md-12">
                                <label class="form-label" for="link_en">{{trans('common.link_en')}}</label>
                                {{Form::text('link_en',$partner->link_en,['id'=>'link_en', 'class'=>'form-control'])}}
                            </div>

                            <div class="col-md-12 text-start">
                                <label class="form-label" for="photo">{{trans('common.photo')}}</label>
                                <div class="file-loading">
                                    <input class="files" name="photo" type="file" accept="image/png, image/gif, image/jpeg ,image/gif">
                                </div>
                                <h3>{{ trans('common.photo') }} </h3>
                               <span class="avatar mb-2">
                                <img class="round" src="{{ $partner->photolink() }}" alt="avatar" height="150" width="150">
                            </span>
                            @if ($partner->photo)
                            <div class="col-12">
                                <a href="{{ route('admin.services.deletePhoto', ['key' => $partner->photo]) }}" class="btn btn-danger btn-sm">
                                    {{trans("common.delete") }} </a>
                            </div>
                            @endif
                            </div>
                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{trans('common.Cancel')}}
                                </button>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- {{ $services->links('vendor.pagination.default') }} --}}
        </div>
    </div>
</div>
@stop
@section('page_buttons')

<a href="{{ route('admin.faqs.createForm') }}" data-bs-target="#createfaq" data-bs-toggle="modal"
    class="btn btn-primary">
    {{trans('common.CreateNew')}}
</a>

<div class="modal fade text-md-start" id="createfaq" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                </div>
                {{Form::open(['url'=>route('admin.partners.store'), 'id'=>'createfaqForm', 'class'=>'row gy-1
                pt-75','files'=>'true'])}}

                <div class="col-12 col-md-12">
                    <label class="form-label" for="link_ar">{{trans('common.link_ar')}}</label>
                    {{Form::text('link_ar','',['id'=>'link_ar', 'class'=>'form-control'])}}
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label" for="link_en">{{trans('common.link_en')}}</label>
                    {{Form::text('link_en','',['id'=>'link_en', 'class'=>'form-control'])}}
                </div>

                <div class="col-md-12 text-start">
                    <label class="form-label" for="photo">{{trans('common.photo')}}</label>
                    <div class="file-loading">
                        <input class="files" name="photo" type="file"
                            accept="image/png, image/gif, image/jpeg ,image/gif">
                    </div>
                    <h3>{{ trans('common.photo') }} </h3>
                    {{-- {!! getFAQImageValue($partner->photo) !!} --}}
                </div>
                <div class="col-12 text-center mt-2 pt-50">
                    <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        {{trans('common.Cancel')}}
                    </button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
