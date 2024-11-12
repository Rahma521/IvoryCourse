<div class="row mt-1">
    <div class="row ">
        <div class="divider">
            <div class="divider-text">
                <h4>{{trans('common.FAQs')}}</h4>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="header_faqs_title_ar">{{trans('common.title_ar')}}</label>
            {{Form::text('header_faqs_title_ar',getSettingValue('header_faqs_title_ar'),['id'=>'header_faqs_title_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="header_faqs_title_en">{{trans('common.title_en')}}</label>
            {{Form::text('header_faqs_title_en',getSettingValue('header_faqs_title_en'),['id'=>'header_faqs_title_en','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_faqs_des_ar">{{trans('common.des_ar')}}</label>
            {{Form::textarea('header_faqs_des_ar',getSettingValue('header_faqs_des_ar'),['rows'=>'3','id'=>'header_faqs_des_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_faqs_des_en">{{trans('common.des_en')}}</label>
            {{Form::textarea('header_faqs_des_en',getSettingValue('header_faqs_des_en'),['rows'=>'3','id'=>'header_faqs_des_en','class'=>'form-control'])}}
        </div>

    </div>

    <div class="row">
        <div class="divider">
            <div class="divider-text">
                <h4>{{trans('common.aboutUs')}}</h4>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="header_aboutUs_title_ar">{{trans('common.title_ar')}}</label>
            {{Form::text('header_aboutUs_title_ar',getSettingValue('header_aboutUs_title_ar'),['id'=>'header_aboutUs_title_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="header_aboutUs_title_en">{{trans('common.title_en')}}</label>
            {{Form::text('header_aboutUs_title_en',getSettingValue('header_aboutUs_title_en'),['id'=>'header_aboutUs_title_en','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_aboutUs_des_ar">{{trans('common.des_ar')}}</label>
            {{Form::textarea('header_aboutUs_des_ar',getSettingValue('header_aboutUs_des_ar'),['rows'=>'3','id'=>'header_aboutUs_des_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_aboutUs_des_en">{{trans('common.des_en')}}</label>
            {{Form::textarea('header_aboutUs_des_en',getSettingValue('header_aboutUs_des_en'),['rows'=>'3','id'=>'header_aboutUs_des_en','class'=>'form-control'])}}
        </div>

    </div>


    <div class="row">
        <div class="divider">
            <div class="divider-text">
                <h4>{{trans('common.contactUs')}}</h4>
            </div>
        </div>


        <div class="col-12 col-md-6">
            <label class="form-label" for="header_contactUs_title_ar">{{trans('common.title_ar')}}</label>
            {{Form::text('header_contactUs_title_ar',getSettingValue('header_contactUs_title_ar'),['id'=>'header_contactUs_title_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="header_contactUs_title_en">{{trans('common.title_en')}}</label>
            {{Form::text('header_contactUs_title_en',getSettingValue('header_contactUs_title_en'),['id'=>'header_faqs_title_en','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_contactUs_des_ar">{{trans('common.des_ar')}}</label>
            {{Form::textarea('header_contactUs_des_ar',getSettingValue('header_contactUs_des_ar'),['rows'=>'3','id'=>'header_contactUs_des_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_contactUs_des_en">{{trans('common.des_en')}}</label>
            {{Form::textarea('header_contactUs_des_en',getSettingValue('header_contactUs_des_en'),['rows'=>'3','id'=>'header_contactUs_des_en','class'=>'form-control'])}}
        </div>
    </div>


    <div class="row">
        <div class="divider">
            <div class="divider-text">
                <h4>{{trans('common.services')}}</h4>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="header_services_title_ar">{{trans('common.title_ar')}}</label>
            {{Form::text('header_services_title_ar',getSettingValue('header_services_title_ar'),['id'=>'header_services_title_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label" for="header_services_title_en">{{trans('common.title_en')}}</label>
            {{Form::text('header_services_title_en',getSettingValue('header_services_title_en'),['id'=>'header_faqs_title_en','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_services_des_ar">{{trans('common.des_ar')}}</label>
            {{Form::textarea('header_services_des_ar',getSettingValue('header_services_des_ar'),['rows'=>'3','id'=>'header_services_des_ar','class'=>'form-control'])}}
        </div>

        <div class="col-12 col-md-12">
            <label class="form-label" for="header_services_des_en">{{trans('common.des_en')}}</label>
            {{Form::textarea('header_services_des_en',getSettingValue('header_services_des_en'),['rows'=>'3','id'=>'header_services_des_en','class'=>'form-control'])}}
        </div>
    </div>

</div>
