@extends('AdminPanel.layouts.master')
@section('content')

    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
                <!--/ Line Chart -->
                <div class="col-lg-12 col-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <h4 class="card-title">{{trans('common.Statistics')}}</h4>
                            <div class="d-flex align-items-center">
                                <p class="card-text me-25 mb-0">{{trans('common.thisMonthStatistics')}}</p>
                            </div>
                        </div>
                        <div class="card-body statistics-body">
                            <div class="row justify-content-center">
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">
                                               0
                                            </h4>
                                            <p class="card-text font-small-3 mb-0">عملاء اليوم</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">0</h4>
                                            <p class="card-text font-small-3 mb-0">{{trans('common.newClients')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-warning me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">0</h4>
                                            <p class="card-text font-small-3 mb-0">غير مؤهل</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-danger me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">0</h4>
                                            <p class="card-text font-small-3 mb-0">تم خسارته</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">0</h4>
                                            <p class="card-text font-small-3 mb-0">عميل حالي</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- Dashboard Analytics end -->
@stop
