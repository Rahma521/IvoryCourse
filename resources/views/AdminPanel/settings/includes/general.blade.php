<!-- form -->
<div class="row mt-1">
    <div class="divider">
        <div class="divider-text">
            <h4>{{trans('common.siteMainSEO')}}</h4>
        </div>
    </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="siteTitle_ar">{{trans('common.siteTitle_ar')}}</label>
            {{Form::text('siteTitle_ar',getSettingValue('siteTitle_ar'),['id'=>'siteTitle_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="siteTitle_en">{{trans('common.siteTitle_en')}}</label>
            {{Form::text('siteTitle_en',getSettingValue('siteTitle_en'),['id'=>'siteTitle_en','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="siteKeywords_ar">{{trans('common.siteKeywords_ar')}}</label>
            {{Form::textarea('siteKeywords_ar',getSettingValue('siteKeywords_ar'),['rows'=>'3','id'=>'siteKeywords_ar','class'=>'form-control'])}}
        </div>
        
        <div class="col-12 col-md-12">
            <label class="form-label" for="siteKeywords_en">{{trans('common.siteKeywords_en')}}</label>
            {{Form::textarea('siteKeywords_en',getSettingValue('siteKeywords_en'),['rows'=>'3','id'=>'siteKeywords_en','class'=>'form-control'])}}
        </div>
</div>

