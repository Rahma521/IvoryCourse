@extends('AdminPanel.layouts.master')
@section('content')


    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            {{Form::open(['url'=>route('admin.settings.update'), 'files'=>'true'])}}
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" aria-controls="home" role="tab"
                                aria-selected="true">
                                <i data-feather="home"></i> {{trans('common.generalSettings')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="header-tab" data-bs-toggle="tab" href="#header" aria-controls="home" role="tab"
                                aria-selected="true">
                                <i data-feather="home"></i> {{trans('common.header')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" aria-controls="home" role="tab"
                                aria-selected="true">
                                <i data-feather="layout"></i> {{trans('common.images')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aboutUs-tab" data-bs-toggle="tab" href="#aboutUs" aria-controls="home" role="tab"
                                aria-selected="true">
                                <i data-feather="layout"></i> {{trans('common.aboutUs')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="features-tab" data-bs-toggle="tab" href="#features" aria-controls="home" role="tab" aria-selected="true">
                            <i data-feather="layout"></i> {{trans('common.features')}}
                            </a>
                        </li>


                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.general')
                        </div>

                        <div class="tab-pane" id="images" aria-labelledby="images-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.images')
                        </div>

                        <div class="tab-pane" id="aboutUs" aria-labelledby="aboutUs-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.aboutUs')
                        </div>

                        <div class="tab-pane" id="features" aria-labelledby="features-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.features')
                        </div>

                        <div class="tab-pane" id="header" aria-labelledby="header-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.header')
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{trans('common.Save changes')}}" class="btn btn-primary">
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
    <!-- Bordered table end -->
@stop
