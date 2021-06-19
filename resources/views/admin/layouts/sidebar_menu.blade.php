<div class="left_col scroll-view">
    <div class="navbar nav_title border-0">
        <a href="{{route('admin_dashboard')}}" class="site_title"><i class="admin_logo"></i><span>ADMIN</span></a>
    </div>
    <div class="clearfix"></div>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                <li><a href="{{route('admin_dashboard')}}"><i class="fa fa-home"></i> Subscriptions </a></li>


                <li>
                    <a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('admin_settings')}}"><i class="fa fa-cogs"></i> General Settings</a></li>
                        <li><a href="{{route('admin_settings_language')}}"><i class="fa fa-language"></i> Languages</a></li>
                        <li><a href="{{url('admincp/translations/view/_json')}}"><i class="fa fa-file-text-o"></i> Translations</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
    <!-- /sidebar menu -->

</div>