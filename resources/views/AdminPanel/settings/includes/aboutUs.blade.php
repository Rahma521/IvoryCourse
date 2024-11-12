<!-- form -->

<div class="row mt-2 mb-2">

    <div class="col-12 col-md-6">
        <label class="form-label" for="aboutUs_title_ar">{{trans('common.title_ar')}}</label>
        {{Form::text('aboutUs_title_ar',getSettingValue('aboutUs_title_ar'),['id'=>'aboutUs_title_ar','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="aboutUs_title_en">{{trans('common.title_en')}}</label>
        {{Form::text('aboutUs_title_en',getSettingValue('aboutUs_title_en'),['id'=>'aboutUs_title_en','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="aboutUs_des_ar">{{trans('common.des_ar')}}</label>
        {{Form::textarea('aboutUs_des_ar',getSettingValue('aboutUs_des_ar'),['rows'=>'3','id'=>'aboutUs_des_ar','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="aboutUs_des_en">{{trans('common.des_en')}}</label>
        {{Form::textarea('aboutUs_des_en',getSettingValue('aboutUs_des_en'),['rows'=>'3','id'=>'aboutUs_des_en','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-6 text-center mb-3">
        <label class="form-label" for="aboutUs_img">
            {{trans('common.image')}}
        </label>
        {!! getSettingImageValue('aboutUs_img') !!}
        <div class="file-loading">
            <input class="files" name="aboutUs_img" type="file">
        </div>
    </div>

</div>

<!--/ form -->
