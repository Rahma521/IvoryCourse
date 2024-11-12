<!-- form -->
<div class="row mt-1">
    <div class="col-12 col-md-6 text-center mb-3">
        <label class="form-label" for="logo">
            {{trans('common.logo')}}
        </label>
        {!! getSettingImageValue('logo') !!}
        <div class="file-loading">
            <input class="files" name="logo" type="file">
        </div>
    </div>
    <div class="col-12 col-md-6 text-center mb-3">
        <label class="form-label" for="fav">
            {{trans('common.fav')}}
        </label>
        {!! getSettingImageValue('fav') !!}
        <div class="file-loading">
            <input class="files" name="fav" type="file">
        </div>
    </div>
    <div class="divider mt-3 mb-3">
        <div class="divider-text">{{trans('common.homeSlider')}}</div>
    </div>

    @php
    $number = 1;
    @endphp

    @for($i = 1; $i <= $number; $i++) @if (getSettingImageValue('home_slide' . $i .'img') !='' ) @php $number++; @endphp
    <div class="col-12 col-md-6 mb-2">
        <h3>{{trans('common.photo')}} #{{$i}}</h3>

        {!! getSettingImageValue('home_slide'.$i.'img') !!}
        <div class="file-loading text-center">
            <input class="files" name="home_slide{{$i}}img" type="file">
        </div>

        <label class="form-label mt-1 " for="slide{{$i}}title_ar">{{trans('common.title_ar')}}</label>
        {{Form::text('home_slide'.$i.'title_ar',getSettingValue('home_slide'.$i.'title_ar'),['id'=>'home_slide'.$i.'title_ar','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="slide{{$i}}title_en">{{trans('common.title_en')}}</label>
        {{Form::text('home_slide'.$i.'title_en',getSettingValue('home_slide'.$i.'title_en'),['id'=>'home_slide'.$i.'title_en','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="slide{{$i}}des_ar">{{trans('common.des_ar')}}</label>
        {{Form::text('home_slide'.$i.'des_ar',getSettingValue('home_slide'.$i.'des_ar'),['id'=>'home_slide'.$i.'des_ar','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="slide{{$i}}des_en">{{trans('common.title_en')}}
        </label>
        {{Form::text('home_slide'.$i.'des_en',getSettingValue('home_slide'.$i.'des_en'),['id'=>'home_slide'.$i.'des_en','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="slide{{$i}}btn_ar">{{trans('common.btn_ar')}}</label>
        {{Form::text('home_slide'.$i.'btn_ar',getSettingValue('home_slide'.$i.'btn_ar'),['id'=>'home_slide'.$i.'btn_ar','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="slide{{$i}}btn_en">{{trans('common.btn_ar')}}
        </label>
        {{Form::text('home_slide'.$i.'btn_en',getSettingValue('home_slide'.$i.'btn_en'),['id'=>'home_slide'.$i.'btn_en','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="slide{{$i}}link">{{trans('common.link')}}
        </label>
        {{Form::text('home_slide'.$i.'link',getSettingValue('home_slide'.$i.'link'),['id'=>'home_slide'.$i.'link','class'=>'form-control'])}}
    </div>
@endif
@endfor
</div>


<div class="row">
    <div class="col-12 mt-2 repeatSlider">
        <span class="addMoreSlider btn btn-sm btn-info">
            {{ trans('common.add more') }}
        </span>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        var maxFields = 20;
        var x = {{ $number - 1 }};
        $('.addMoreSlider').click(function() {
            if (x < maxFields) {
                x++;
                console.log(x);
                var newElement =
                    `
            <div class="col-12 col-md-6 mb-2">
                <h3>{{trans('common.photo')}} # ${x}</h3>

                <div class="file text-center">
                    <input class="files" name="home_slide${x}img" type="file">
                </div>

                <label class="form-label mt-1 " for="slide${x}title_ar">{{trans('common.title_ar')}}</label>

                {{Form::text('home_slide${x}title_ar',getSettingValue('home_slide${x}title_ar'),['id'=>'home_slide${x}title_ar','class'=>'form-control'])}}

                <label class="form-label mt-1 " for="slide${x}title_en">{{trans('common.title_en')}}</label>

                {{Form::text('home_slide${x}title_en',getSettingValue('home_slide${x}title_en'),['id'=>'home_slide${x}title_en','class'=>'form-control'])}}

                <label class="form-label mt-1 " for="slide${x}des_ar">{{trans('common.des_ar')}}</label>
                {{Form::text('home_slide${x}des_ar',getSettingValue('home_slide${x}des_ar'),['id'=>'home_slide${x}des_ar','class'=>'form-control'])}}

                <label class="form-label mt-1 " for="slide${x}des_en">{{trans('common.des_en')}}
                </label>
                {{Form::text('home_slide${x}des_en',getSettingValue('home_slide${x}des_en'),['id'=>'home_slide${x}des_en','class'=>'form-control'])}}

                <label class="form-label mt-1 " for="slide${x}btn_ar">{{trans('common.btn_ar')}}</label>
                {{Form::text('home_slide${x}btn_ar',getSettingValue('home_slide${x}btn_ar'),['id'=>'home_slide'.$i.'btn_ar','class'=>'form-control'])}}

                <label class="form-label mt-1 " for="slide${x}btn_en">{{trans('common.btn_en')}}
                </label>
                {{Form::text('home_slide${x}btn_en',getSettingValue('home_slide${x}btn_en'),['id'=>'home_slide${x}btn_en','class'=>'form-control'])}}

                <label class="form-label mt-1 " for="slide${x}link">{{trans('common.link')}}
                </label>
                {{Form::text('home_slide${x}link',getSettingValue('home_slide${x}link'),['id'=>'home_slide${x}link','class'=>'form-control'])}}

            </div>
       `

                $(newElement).insertBefore(
                '.repeatSlider'); // Insert the new element before the "add more" span
            }
        });
    });
</script>
