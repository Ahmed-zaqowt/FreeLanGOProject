<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('admin_assets_rtl/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">منصة العمل الحر</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="menu-label">@lang('المستخدمين')</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">@lang('أدارة مستخدمين المنصة')</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.user.index') }}">
                        <i class="bi bi-circle"></i>
                        @lang('العملاء')
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        @lang('المستقلون')
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-label">@lang('المسؤولون')</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">@lang('أدارة مسؤولين المنصة')</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.admin.index') }}">
                        <i class="bi bi-circle"></i>
                        @lang('المسؤولون')
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        @lang('المستقلون')
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-label">@lang('المستخدمين')</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">@lang('إدارة  التسجيل ')</div>
            </a>
            <ul>
                <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                        class="btn btn-danger btn-block">تسجيل الخروج</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        {{-- <button class="btn btn-danger btn-block">Logout</button> --}}
                    </form>
                </li>

            </ul>
        </li>













    </ul>
</aside>
