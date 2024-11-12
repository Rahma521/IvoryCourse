<!-- form -->
<div class="row">
    <div class="col-12 col-md-6">
        <label class="form-label" for="email">{{trans('common.email')}}</label>
        {{Form::text('email',getSettingValue('email'),['id'=>'email','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="facebook">facebook</label>
        {{Form::text('facebook',getSettingValue('facebook'),['id'=>'facebook','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="twitter">twitter</label>
        {{Form::text('twitter',getSettingValue('twitter'),['id'=>'twitter','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="instagram">instagram</label>
        {{Form::text('instagram',getSettingValue('instagram'),['id'=>'instagram','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="tiktok">tiktok</label>
        {{Form::text('tiktok',getSettingValue('tiktok'),['id'=>'tiktok','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="youtube">youtube</label>
        {{Form::text('youtube',getSettingValue('youtube'),['id'=>'youtube','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="snapChat">snapChat</label>
        {{Form::text('snapChat',getSettingValue('snapChat'),['id'=>'snapChat','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="Pinterest">Pinterest</label>
        {{Form::text('Pinterest',getSettingValue('Pinterest'),['id'=>'Pinterest','class'=>'form-control'])}}
    </div>
</div>

<div class="row mt-3">
    <div class="divider">
        <div class="divider-text">
            <h4>{{trans('common.JoinOurCommunity')}}</h4>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="JoinOurCommunity_ar">{{trans('common.title_ar')}}</label>
        {{Form::text('JoinOurCommunity_ar',getSettingValue('JoinOurCommunity_ar'),['id'=>'JoinOurCommunity_ar','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="JoinOurCommunity_en">{{trans('common.title_en')}}</label>
        {{Form::text('JoinOurCommunity_en',getSettingValue('JoinOurCommunity_en'),['id'=>'JoinOurCommunity_en','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="JoinCommunityDes_en">{{trans('common.JoinCommunityDes_en')}}</label>
        {{Form::textarea('JoinCommunityDes_en',getSettingValue('JoinCommunityDes_en'),['rows'=>'3','id'=>'JoinCommunityDes_en','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="JoinCommunityDes_ar">{{trans('common.JoinCommunityDes_ar')}}</label>
        {{Form::textarea('JoinCommunityDes_ar',getSettingValue('JoinCommunityDes_ar'),['rows'=>'3','id'=>'JoinCommunityDes_ar','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-6 text-center mb-3">
        <label class="form-label" for="JoinCommunityImg">
            {{trans('common.JoinCommunityImg')}}
        </label>
        {!! getSettingImageValue('JoinCommunityImg') !!}
        <div class="file-loading ">
            <input class="files" name="JoinCommunityImg" type="file">
        </div>
    </div>

    <div class="col-12 col-md-6 text-center mb-3">
        <label class="form-label" for="contactUsImg">
            {{trans('common.contactUsImg')}}
        </label>
        {!! getSettingImageValue('contactUsImg') !!}
        <div class="file-loading ">
            <input class="files" name="contactUsImg" type="file">
        </div>
    </div>

</div>

<div class="row mt-3">

    <div class="divider">
        <div class="divider-text">
            <h4>{{trans('common.installLinks')}}</h4>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="playStore">playStore</label>
        {{Form::text('playStore',getSettingValue('playStore'),['id'=>'playStore','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label" for="appleStore">appleStore</label>
        {{Form::text('appleStore',getSettingValue('appleStore'),['id'=>'appleStore','class'=>'form-control'])}}
    </div>

</div>

