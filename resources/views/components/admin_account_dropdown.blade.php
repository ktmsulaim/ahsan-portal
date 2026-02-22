@auth('admin')
<div class="dropdown-menu dropdown-menu-right {{ $menuClass ?? '' }}" id="{{ $menuId ?? 'account_menu' }}">
    <div class="dropdown-item-text dropdown-item-text--lh">
        <div><strong>{{ auth('admin')->user()->name }}</strong></div>
        <div class="text-muted">{{ auth('admin')->user()->email }}</div>
    </div>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('admin.index') }}"><i class="material-icons">dvr</i> Dashboard</a>
    <a class="dropdown-item" href="{{ route('admin.changePassword') }}"><i class="material-icons">edit</i> Change password</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="material-icons">exit_to_app</i> Logout</a>
</div>
@endauth
