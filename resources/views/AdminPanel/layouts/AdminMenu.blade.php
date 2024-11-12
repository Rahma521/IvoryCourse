<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <img src="{{asset('/AdminAssets/app-assets/images/logo/logo.png')}}" height="55" />
             {{-- <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li> --}}
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if(isset($active) && $active == 'panelHome') active @endif nav-item">
                <a class="d-flex align-items-center" href="{{route('admin.index')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.PanelHome')}}">
                        {{trans('common.PanelHome')}}
                    </span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.staticPages')}}">
                        {{trans('common.courses')}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li @if(isset($active) && $active=='chapters' ) class="active" @endif>
                        <a class="d-flex align-items-center" href="">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="chapters">
                               chapters
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
{{--            <li class="nav-item @if(isset($active) && $active == 'ourServices') active @endif">--}}
{{--                <a class="d-flex align-items-center" href="{{ route('admin.services') }}">--}}
{{--                    <i data-feather='layers'></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="{{trans('common.ourServices')}}">--}}
{{--                        {{trans('common.ourServices')}}--}}
{{--                    </span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
