<style>
    .aside-menu .menu-nav {
        margin: 0;
        list-style: none;
        padding: 15px 0;
        margin-right: 40px
    ;
    }
</style>

<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="{{route('admin.dashboard')}}" class="brand-logo">
            <h2 style="font-family: Impact">URL SHORTNER</h2>
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
             data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item {{ Request::is('admin/dashboard') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{route('admin.dashboard')}}" class="menu-link">
                        <i class="menu-icon flaticon-dashboard"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>


{{--                <li class="menu-item {{(\Illuminate\Support\Facades\Request::is('admin/contacts') or \Illuminate\Support\Facades\Request::is('admin/contacts/*')) ? 'menu-item-active' : '' }}" aria-haspopup="true">--}}
{{--                    <a href="{{route('admin.contacts.index')}}" class="menu-link">--}}
{{--                        <i class="menu-icon flaticon2-user"></i>--}}
{{--                        <span class="menu-text">Contacts</span>--}}
{{--                    </a>--}}
{{--                </li>--}}


                <li class="menu-item" aria-haspopup="true">
                    <a href="{{ route('logout') }}" class="menu-link"
                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        <i class="menu-icon flaticon2-arrow-down"></i>
                        <span class="menu-text">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>


            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
