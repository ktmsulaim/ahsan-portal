<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left sidebar-p-t" data-perfect-scrollbar>
            <div class="sidebar-heading">Main menu</div>
            <div class="sidebar-block p-0 mb-0">
                <ul class="sidebar-menu" id="components_menu">
                    <li class="sidebar-menu-item {{ Request::url() == route('admin.index') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.index') }}">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">home</i>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item {{ Request::is('admin/members*') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.users.index') }}">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
                            <span class="sidebar-menu-text">Members</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item {{ Request::is('admin/campaigns*') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.campaigns.index') }}">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dashboard</i>
                            <span class="sidebar-menu-text">Campaigns</span>
                        </a>
                    </li>
                   
                    <li class="sidebar-menu-item {{ Request::is('admin/reports*') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.reports.index') }}">
                            <i
                                class="sidebar-menu-icon sidebar-menu-icon--left material-icons">insert_drive_file</i>
                            <span class="sidebar-menu-text">Reports</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>