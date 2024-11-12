@extends('AdminPanel.layouts.master')
@section('content')


<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered mb-2">
                    <thead>
                        <tr>
                            <th>{{trans('common.title')}}</th>
                            <th>{{trans('common.description')}}</th>
                            <th class="text-center">{{trans('common.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr id="row_{{$service->id}}">
                            <td>
                                {{$service['service_title_ar']}}<br>
                                {{$service['service_title_en']}}<br>
                            </td>
                            <td>
                                {{$service['service_des_ar']}}<br>
                                {{$service['service_des_en']}}<br>
                            </td>
                            <td class="text-center">
                                <a href="javascript:;" data-bs-target="#editfaq{{$service->id}}" data-bs-toggle="modal"
                                    class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>
                                <?php $delete = route('admin.services.delete',['id'=>$service->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger"
                                    onclick="confirmDelete('{{$delete}}','{{$service->id}}')" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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
            @foreach($services as $service)
            <div class="modal fade text-md-start" id="editfaq{{$service->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">{{trans('common.edit')}}</h1>
                            </div>
                            {{Form::open(['url'=>route('admin.services.update',['id'=>$service->id]), 'id'=>'editfaqForm',
                            'class'=>'row gy-1 pt-75','files'=>'true'])}}
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="service_title_ar">{{trans('common.title_ar')}}</label>
                                {{Form::text('service_title_ar',$service->service_title_ar,['id'=>'service_title_ar', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="service_title_en">{{trans('common.title_en')}}</label>
                                {{Form::text('service_title_en',$service->service_title_ar,['id'=>'service_title_en', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="service_des_ar">{{trans('common.des_ar')}}</label>
                                {{Form::text('service_des_ar',$service->service_des_ar,['id'=>'service_des_ar', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-6 ">
                                <label class="form-label" for="service_des_en">{{trans('common.des_en')}}</label>
                                {{Form::text('service_des_en',$service->service_des_en,['id'=>'service_des_en', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-md-12 text-start">
                                <label class="form-label" for="photo">{{trans('common.photo')}}</label>
                                <div class="file-loading">
                                    <input class="files" name="photo" type="file" accept="image/png, image/gif, image/jpeg ,image/gif">
                                </div>
                                <h3>{{ trans('common.photo') }} </h3>
                                @if ($service->photo !='')
                                <span class="avatar mb-2">
                                    <img class="round" src="{{ $service->photolink() }}" alt="avatar" height="150" width="150">
                                </span>
                                @endif

                                @if ($service->photo)
                                    <div class="col-12">
                                        <a href="{{ route('admin.services.deletePhoto', ['key' => $service->photo]) }}" class="btn btn-danger btn-sm">
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

<a href="{{ route('admin.faqs.createForm') }}" data-bs-target="#createModalService" data-bs-toggle="modal"
    class="btn btn-primary">
    {{trans('common.CreateNew')}}
</a>

<div class="modal fade text-md-start" id="createModalService" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                </div>
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                                    @if ($errors->any())
                                    console.log('ho');
                                        $('#createModalService').addClass('show');
                                    @endif
                            </script>
                        </ul>
                    </div>
                @endif --}}

                {{Form::open(['url'=>route('admin.services.store'), 'id'=>'createfaqForm', 'class'=>'row gy-1
                pt-75','files'=>'true'])}}
                <div class="col-12 col-md-6">
                    <label class="form-label" for="service_title_ar">{{trans('common.title_ar')}}<span style="color:red">*</span></label>
                    {{Form::text('service_title_ar','',['id'=>'service_title_ar', 'class'=>'form-control','required'])}}
                    @if($errors->has('service_title_ar'))
                    <span class="text-danger" role="alert">
                        <b>{{ $errors->first('service_title_ar') }}</b>
                    </span>
                    @endif
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="service_title_en">{{trans('common.title_en')}}<span style="color:red">*</span></label>
                    {{Form::text('service_title_en','',['id'=>'service_title_en', 'class'=>'form-control','required'])}}
                    @if($errors->has('service_title_en'))
                    <span class="text-danger" role="alert">
                        <b>{{ $errors->first('service_title_en') }}</b>
                    </span>
                    @endif
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="service_des_ar">{{trans('common.des_ar')}}
                   <span style="color:red">*</span></label>
                    {{Form::text('service_des_ar','',['id'=>'service_des_ar', 'class'=>'form-control','required'])}}
                    @if($errors->has('service_des_ar'))
                    <span class="text-danger" role="alert">
                        <b>{{ $errors->first('service_des_ar') }}</b>
                    </span>
                    @endif
                </div>
                <div class="col-12 col-md-6 ">
                    <label class="form-label" for="service_des_en">{{trans('common.des_en')}}<span style="color:red">*</span></label>
                    {{Form::text('service_des_en','',['id'=>'service_des_en', 'class'=>'form-control','required'])}}
                    @if($errors->has('service_des_en'))
                    <span class="text-danger" role="alert">
                        <b>{{ $errors->first('service_des_en') }}</b>
                    </span>
                    @endif
                </div>
                <div class="col-md-12 text-start">
                    <label class="form-label" for="photo">{{trans('common.photo')}}</label>
                    <div class="file-loading">
                        <input class="files" name="photo" type="file" accept="image/png, image/gif, image/jpeg ,image/gif">
                    </div>
                    @if($errors->has('photo'))
                    <span class="text-danger" role="alert">
                        <b>{{ $errors->first('photo') }}</b>
                    </span>
                    @endif

                    <h3>{{ trans('common.photo') }} </h3>

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


