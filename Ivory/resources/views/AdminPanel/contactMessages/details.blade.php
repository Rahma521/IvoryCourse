@extends('AdminPanel.layouts.master')
@section('content')


    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('common.userDetails')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <b>{{trans('common.name')}}:</b>
                            {{$message->userData()['name']}}
                        </div>

                        <div class="col-4">
                            <b>{{trans('common.email')}}:</b>
                            {{$message->userData()['email']}}
                        </div>
                        <div class="col-2">
                            <b>{{trans('common.country')}}:</b>
                            {{$message->userData()['country']}}
                        </div>
                        <div class="col-4">
                            <b>{{trans('common.phone')}}:</b>
                            <span dir="ltr">
                                {{$message->userData()['countryCode']}}
                                {{$message->userData()['phone']}}
                            </span>
                        </div>
                    </div>
                
                </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('common.messageDetails')}} <small>(<b class="text-danger">{{$message->subjectText()}}</b>)</small></h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-12">
                            {{$message->content}}
                        </div>
                    </div>
                
                </div>

            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop
