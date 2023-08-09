<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item @if(isset($activeHome)) active @endif">
            <a class="nav-link" href="{!! url('/home') !!}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">@lang('user.Dashboard')</span>
            </a>
        </li>

        <li class="nav-item @if(isset($activeSettings)) active @endif">
            <a class="nav-link" href="{!! route('User::settings.index') !!}">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">@lang('user.Settings')</span>
            </a>
        </li>

        <li class="nav-item @if(isset($activeSubscriptions)) active @endif">
            <a class="nav-link" href="{!! route('User::subscriptions.index') !!}">
                <i class="ti-agenda menu-icon"></i>
                <span class="menu-title">@lang('user.Subscriptions')</span>
            </a>
        </li>

        <li class="nav-item @if(isset($activeOrderHistory)) active @endif">
            <a class="nav-link" href="{!! route('User::orderHistory.index') !!}">
                <i class="ti-archive menu-icon"></i>
                <span class="menu-title">@lang('user.Order_History')</span>
            </a>
        </li>


        <li class="nav-item @if(isset($activePaymentMethods)) active @endif">
            <a class="nav-link" href="{!! route('User::payment-methods.index') !!}">
                <i class="ti-wallet menu-icon"></i>
                <span class="menu-title">@lang('user.Payment')</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti-power-off text-primary menu-icon"></i>
                <span class="menu-title">@lang('user.Logout')</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- partial -->
