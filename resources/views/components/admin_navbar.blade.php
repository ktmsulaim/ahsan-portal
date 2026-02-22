<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left sidebar-p-t" data-perfect-scrollbar>
            <div class="sidebar-heading">Main menu</div>
            <div class="sidebar-block p-0 mb-0">
                <ul class="sidebar-menu" id="components_menu">
                    <li class="sidebar-menu-item {{ Request::url() == route('admin.index') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">home</i>
                            <span class="sidebar-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item {{ Request::is('admin/members*') ? 'active open' : '' }}">
                        <a class="sidebar-menu-button collapsed" data-toggle="collapse" href="#members_menu"
                            aria-expanded="false">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
                            <span class="sidebar-menu-text">Members</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="members_menu" style="">
                            <li
                                class="sidebar-menu-item {{ Request::is('admin/members*') && !Request::is('admin/members/applications*') ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('admin.users.index') }}">
                                    <span class="sidebar-menu-text">All Members</span>
                                </a>
                            </li>
                            <li
                                class="sidebar-menu-item {{ Request::is('admin/members/applications*') ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('admin.users.applications.index') }}">
                                    <span class="sidebar-menu-text">Applications</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu-item {{ Request::is('admin/campaigns*') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.campaigns.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dashboard</i>
                            <span class="sidebar-menu-text">Campaigns</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item {{ Request::is('admin/reports*') ? 'active open' : '' }}">
                        <a class="sidebar-menu-button collapsed" data-toggle="collapse" href="#reports_menu" aria-expanded="false">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">insert_drive_file</i>
                            <span class="sidebar-menu-text">Reports</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse {{ Request::is('admin/reports*') ? 'show' : '' }}" id="reports_menu">
                            <li class="sidebar-menu-item {{ (Request::is('admin/reports') || Request::is('admin/reports/show')) ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('admin.reports.index') }}">
                                    <span class="sidebar-menu-text">All reports</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ Request::is('admin/reports/whatsapp*') ? 'active' : '' }}">
                                <a class="sidebar-menu-button" href="{{ route('admin.reports.whatsapp') }}">
                                    <span class="sidebar-menu-text">WhatsApp reports</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="{{ route('admin.settings.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">settings</i>
                            <span class="sidebar-menu-text">Settings</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item d-md-none border-top mt-2 pt-2">
                        <a class="sidebar-menu-button" href="{{ route('admin.logout') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">exit_to_app</i>
                            <span class="sidebar-menu-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
