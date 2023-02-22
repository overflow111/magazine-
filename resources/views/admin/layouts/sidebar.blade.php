<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('img/syyahat-light.svg') }}" alt="@lang('transFront.app-name')"
                 class="img-fluid" style="max-height: 48px;">
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item" id="navItem0">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse0" aria-expanded="true"
           aria-controls="collapse0">
            <i class="fas fa-fw fa-tachometer-alt"></i> <span>@lang('transAdmin.panels')</span>
        </a>
        <div id="collapse0" class="collapse" aria-labelledby="heading0" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item ci-sidebar" href="{{ route('admin.sale-panel') }}">@lang('transAdmin.sale-panel')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.post-panel') }}">@lang('transAdmin.post-panel')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.visitor-panel') }}">@lang('transAdmin.visitor-panel')</a>
            </div>
        </div>
    </li>
    <li class="nav-item" id="navItem1">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
           aria-controls="collapse1">
            <i class="fas fa-fw fa-file-invoice"></i> <span>@lang('transAdmin.sales')</span>
        </a>
        <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item ci-sidebar" href="{{ route('admin.sales.index') }}">@lang('transAdmin.sales')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.customers.index') }}">@lang('transAdmin.customers')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.contacts.index') }}">@lang('transAdmin.contacts')</a>
            </div>
        </div>
    </li>
    <li class="nav-item" id="navItem2">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
           aria-controls="collapse2">
            <i class="fas fa-fw fa-file-word"></i> <span>@lang('transAdmin.posts')</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item ci-sidebar" href="{{ route('admin.posts.index') }}">@lang('transAdmin.posts')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.magazines.index') }}">@lang('transAdmin.magazines')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.authors.index') }}">@lang('transAdmin.authors')</a>
            </div>
        </div>
    </li>
    <li class="nav-item" id="navItem4">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true"
           aria-controls="collapse4">
            <i class="fas fa-fw fa-cogs"></i> <span>@lang('transAdmin.settings')</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item ci-sidebar" href="{{ route('admin.categories.index') }}">@lang('transAdmin.categories')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.plans.index') }}">@lang('transAdmin.plans')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.pages.index') }}">@lang('transAdmin.pages')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.settings.index') }}">@lang('transAdmin.settings')</a>
            </div>
        </div>
    </li>
    <li class="nav-item" id="navItem5">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true"
           aria-controls="collapse5">
            <i class="fas fa-fw fa-user-shield"></i> <span>@lang('transAdmin.visitors')</span>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item ci-sidebar" href="{{ route('admin.ip-addresses.index') }}">@lang('transAdmin.ip-addresses')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.user-agents.index') }}">@lang('transAdmin.user-agents')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.visitors.index') }}">@lang('transAdmin.visitors')</a>
                <a class="collapse-item ci-sidebar" href="{{ route('admin.attempts.index') }}">@lang('transAdmin.attempts')</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<script>
    $(document).ready(function () {
        function ciSidebar() {
            var url = window.location.pathname;
            var activePage = url.substring(url.indexOf('/') + 1);
            $('.ci-sidebar').each(function () {
                var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1);
                if (activePage.indexOf(linkPage) !== -1) {
                    $(this).addClass('active');
                    if (Boolean(sessionStorage.getItem("sidebar-toggled"))) {
                        $(this).parent().parent().addClass('show');
                    }
                    $(this).parent().parent().parent().addClass('active');
                }
            });
        }
        ciSidebar();
        $(window).on('hashchange', function () {
            ciSidebar();
        });
    });
    if (Boolean(sessionStorage.getItem("sidebar-toggled"))) {
        $("#accordionSidebar").removeClass('toggled');
        sessionStorage.setItem("sidebar-toggled", "1");
    } else {
        $("#accordionSidebar").addClass('toggled');
        sessionStorage.setItem("sidebar-toggled", "");
    }
    $('#sidebarToggle').click(function () {
        event.preventDefault();
        if (Boolean(sessionStorage.getItem("sidebar-toggled"))) {
            sessionStorage.setItem("sidebar-toggled", "");
        } else {
            sessionStorage.setItem("sidebar-toggled", "1");
        }
    });
</script>