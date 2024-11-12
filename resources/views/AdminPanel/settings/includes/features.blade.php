<div class="row mt-1">
    <div class="row">

        <div class="divider">
            <div class="divider-text">
                <h4>{{trans('common.features')}}</h4>
            </div>
        </div>

        @php
        $number = 1;
        @endphp

        @for ($i = 1; $i <= $number; $i++)
        @if (getSettingImageValue('features' . $i .'img') !='' ) @php $number++;
        @endphp
        <div class="col-12 col-md-6 mb-2">

        <h3 class="text-bold mt-2">{{trans('common.features'). ' #' . $i}}</h3>

        {!! getSettingImageValue('features'.$i.'img') !!}
        <div class="file-loading text-center">
            <input class="files" name="features{{$i}}img" type="file">
        </div>

        <label class="form-label mt-1 " for="features{{$i}}title_ar">{{trans('common.title_ar')}}</label>
        {{Form::text('features'.$i.'title_ar',getSettingValue('features'.$i.'title_ar'),['id'=>'features'.$i.'title_ar','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="features{{$i}}title_en">{{trans('common.title_en')}}</label>
        {{Form::text('features'.$i.'title_en',getSettingValue('features'.$i.'title_en'),['id'=>'features'.$i.'title_en','class'=>'form-control'])}}


        <label class="form-label mt-1 " for="features{{$i}}des_ar">{{trans('common.des_ar')}}</label>
        {{Form::text('features'.$i.'des_ar',getSettingValue('features'.$i.'des_ar'),['id'=>'features'.$i.'des_ar','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="features{{$i}}des_en">{{trans('common.des_en')}}
        </label>
        {{Form::text('features'.$i.'des_en',getSettingValue('features'.$i.'des_en'),['id'=>'features'.$i.'des_en','class'=>'form-control'])}}


        <label class="form-label mt-1 " for="features{{$i}}number">{{trans('common.number')}}
        </label>
        {{Form::number('features'.$i.'number',getSettingValue('features'.$i.'number'),['id'=>'features'.$i.'number','class'=>'form-control'])}}
        </div>
            @endif
        @endfor
    </div>

    <div class="row">
        <div class="col-12 mt-2 repeatFeatures">
            <span class="addMoreFeatures btn btn-sm btn-info">
                {{ trans('common.add more') }}
            </span>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        var maxFields = 20;
        var x = {{ $number - 1 }};
        $('.addMoreFeatures').click(function() {
            if (x < maxFields) {
                x++;
                console.log(x);
                var newElement =
                    `
        <div class="col-12 col-md-6 mb-2">
            <h3 class="text-bold mt-2">{{trans('common.features')}} # ${x}</h3>

        {!! getSettingImageValue('features${x}img') !!}
        <div class="file text-center">
            <input class="files" name="features${x}img" type="file">
        </div>

        <label class="form-label mt-1 " for="features${x}title_ar">{{trans('common.title_ar')}}</label>
        {{Form::text('features${x}title_ar',getSettingValue('features${x}title_ar'),['id'=>'features${x}title_ar','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="features${x}title_en">{{trans('common.title_en')}}</label>
        {{Form::text('features${x}title_en',getSettingValue('features${x}title_en'),['id'=>'features${x}title_en','class'=>'form-control'])}}


        <label class="form-label mt-1 " for="features${x}des_ar">{{trans('common.des_ar')}}</label>
        {{Form::text('features${x}des_ar',getSettingValue('features${x}des_ar'),['id'=>'features${x}des_ar','class'=>'form-control'])}}

        <label class="form-label mt-1 " for="features${x}des_en">{{trans('common.des_en')}}
        </label>
        {{Form::text('features'.$i.'des_en',getSettingValue('features${x}des_en'),['id'=>'features${x}des_en','class'=>'form-control'])}}


        <label class="form-label mt-1 " for="features{{$i}}number">{{trans('common.number')}}
        </label>
        {{Form::number('features${x}number',getSettingValue('features${x}number'),['id'=>'features${x}number','class'=>'form-control'])}}
        </div>
       `

                $(newElement).insertBefore(
                '.repeatFeatures'); // Insert the new element before the "add more" span
            }
        });
    });
</script>
