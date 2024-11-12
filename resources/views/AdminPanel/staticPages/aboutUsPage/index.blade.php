@extends('AdminPanel.layouts.master')
@section('content')
{{Form::open(['url'=>route('admin.staticPages.update'), 'files'=>'true'])}}
<div class="row">

    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="aboutUsHeaderTitle_ar">{{trans('common.headerTitle_ar')}}</label>
        {{Form::text('aboutUsHeaderTitle_ar',
        getPagesValue('aboutUsHeaderTitle_ar'),['id'=>'aboutUsHeaderTitle_ar','class'=>'form-control '])}}
    </div>
    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="aboutUsHeaderTitle_en">{{trans('common.headerTitle_en')}}</label>
        {{Form::text('aboutUsHeaderTitle_en',
        getPagesValue('aboutUsHeaderTitle_en'),['id'=>'aboutUsHeaderTitle_en','class'=>'form-control '])}}
    </div>

    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="headerImage">{{trans('common.headerImage')}}</label>
        {!! getPagesImageValue('headerImage') !!}
        <div class="file-loading">
            <input class="files" name="headerImage" type="file">
        </div>
    </div>

    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="aboutUsHeaderDes_ar">{{trans('common.headerDes_ar')}}</label>
        {{Form::textarea('aboutUsHeaderDes_ar',
        getPagesValue('aboutUsHeaderDes_ar'),['id'=>'aboutUsHeaderDes_ar','class'=>'form-control editor_ar'])}}
    </div>

    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="aboutUsHeaderDes_en">{{trans('common.headerDes_en')}}</label>
        {{Form::textarea('aboutUsHeaderDes_en',
        getPagesValue('aboutUsHeaderDes_en'),['id'=>'aboutUsHeaderDes_en','class'=>'form-control editor_en'])}}
    </div>

    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="aboutUsImage">{{trans('common.aboutUsimage')}}</label>
        {!! getPagesImageValue('aboutUsImage') !!}
        <div class="file-loading">
            <input class="files" name="aboutUsImage" type="file">
        </div>
    </div>

@for($i = 1; $i <= 3; $i++)

<h4 class="text-bold mt-1">{{trans('common.section'). ' #' . $i}}</h4>

    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="aboutUsTitle{{$i}}_ar">{{trans('common.title_ar')}}</label>
        {{Form::text('aboutUsTitle'.$i. 'ar',
        getPagesValue('aboutUsTitle'.$i. 'ar'),['id'=>'aboutUsTitle'.$i. 'ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="aboutUsTitle{{$i}}_en">{{trans('common.title_en')}}</label>
        {{Form::text('aboutUsTitle'.$i. 'en',
        getPagesValue('aboutUsTitle'.$i. 'en'),['id'=>'aboutUsTitle'.$i. 'en','class'=>'form-control'])}}
    </div>


    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="aboutUsDes{{$i}}_ar">{{trans('common.Des_ar')}}</label>
        {{Form::textarea('aboutUsDes'.$i. 'ar',
        getPagesValue('aboutUsDes'.$i. 'ar'),['id'=>'aboutUsDes'.$i. 'ar','class'=>'form-control','rows'=>'3'])}}
    </div>
    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="aboutUsDes{{$i}}_en">{{trans('common.Des_en')}}</label>
        {{Form::textarea('aboutUsDes'.$i. 'en',
        getPagesValue('aboutUsDes'.$i. 'en'),['id'=>'aboutUsDes'.$i. 'en','class'=>'form-control','rows'=>'3'])}}
    </div>

    @endfor




    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="teamWorkDes_ar">{{trans('common.teamWorkDes_ar')}}</label>
        {{Form::textarea('teamWorkDes_ar',
        getPagesValue('teamWorkDes_ar'),['id'=>'teamWorkDes_ar','class'=>'form-control '])}}
    </div>

    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="teamWorkDes_en">{{trans('common.teamWorkDes_en')}}</label>
        {{Form::textarea('teamWorkDes_en',
        getPagesValue('teamWorkDes_en'),['id'=>'teamWorkDes_en','class'=>'form-control '])}}
    </div>


    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="secondSecMedia">{{trans('common.media')}}</label>
        {{ Form::select('secondSecMedia',
        [
        '0' =>trans('common.image'),
        '1' => trans('common.video')
        ]
        ,getPagesValue('secondSecMedia') ?? '',
        ['id'=>'secondSecMedia','placeholder' => 'types','class'=>'form-control' ,
        'onchange'=>'showElemet(this.value)']) }}
    </div>

    <div class="col-12 col-md-12 d-none" id="image_id">
        <label class="form-label" for="secondSecImage">{{trans('common.image')}}</label>
        {!! getPagesImageValue('secondSecImage') !!}
        <div class="file-loading">
            <input class="files" name="secondSecImage" type="file">
        </div>
    </div>

    <div class="col-12 col-md-12 mb-1  d-none" id="link">
        <label class="form-label" for="secondSecLink">{{trans('common.Link')}}</label>
        {{Form::text('secondSecLink',getPagesValue('secondSecLink'),['id'=>'secondSecLink','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="section2Title_ar">{{trans('common.section2Title_ar')}}</label>
        {{Form::text('section2Title_ar',
        getPagesValue('section2Title_ar'),['id'=>'section2Title_ar','class'=>'form-control '])}}
    </div>

    <div class="col-12 col-md-6 mb-1">
        <label class="form-label" for="section2Title_en">{{trans('common.section2Title_en')}}</label>
        {{Form::text('section2Title_en',
        getPagesValue('section2Title_en'),['id'=>'section2Title_en','class'=>'form-control '])}}
    </div>

    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="section2Des_ar">{{trans('common.section2Des_ar')}}</label>
        {{Form::textarea('section2Des_ar',
        getPagesValue('section2Des_ar'),['id'=>'section2Des_ar','class'=>'form-control editor_ar'])}}
    </div>

    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="section2Des_en">{{trans('common.section2Des_en')}}</label>
        {{Form::textarea('section2Des_en',
        getPagesValue('section2Des_en'),['id'=>'section2Des_en','class'=>'form-control editor_en'])}}
    </div>


    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="ending_ar">{{trans('common.ending_ar')}}</label>
        {{Form::textarea('ending_ar',
        getPagesValue('ending_ar'),['id'=>'ending_ar','class'=>'form-control editor_en'])}}
    </div>

    <div class="col-12 col-md-12 mb-1">
        <label class="form-label" for="ending_en">{{trans('common.ending_en')}}</label>
        {{Form::textarea('ending_en',
        getPagesValue('ending_en'),['id'=>'ending_en','class'=>'form-control editor_en'])}}
    </div>


    <div class="card-footer">
        <input type="submit" value="{{trans('common.Save changes')}}" class="btn btn-primary">
    </div>






</div>
{{Form::close()}}


@stop

<script>
    function showElemet(val)
    {
    if (val == "0")
    {
      $('#image_id').show();
      $('#image_id').removeClass("d-none");
      $('#link').hide();
    }
    else if
    (val == "1")
    {
    $('#image_id').hide();
    $('#link').show();
    $('#link').removeClass("d-none");
    }
}
</script>
