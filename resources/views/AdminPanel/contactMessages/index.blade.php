@extends('AdminPanel.layouts.master')
@section('content')


    <!-- Bordered table start -->
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
                                <th>{{trans('common.subject')}}</th>
                                <th>{{trans('common.status')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                            <tr id="row_{{$message->id}}">
                                <td>
                                    <a href="{{route('admin.contactmessages.details',['id'=>$message->id])}}">
                                        {{$message['subject'] != '' ? $message['subject'] : '-'}}<br>
                                        <b>{{$message->userData()['name']}}</b>
                                        | {{$message->fromTime()}}
                                    </a>
                                </td>
                                <td>{!!$message->messageStatus()!!}</td>
                                <td class="text-center">
                                    <?php $delete = route('admin.contactmessages.delete',['id'=>$message->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$message->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop