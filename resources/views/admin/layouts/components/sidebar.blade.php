<aside>
    <ul class="nav flex-column py-4">
        <li class="nav-item">
            <a class="nav-link {{ (Request::route()->getName() == 'dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::route()->getName() == 'admin.department' || Request::route()->getName() == 'admin.department.add') ? 'active' : '' }}" href="{{ route('admin.department') }}">Departments</a>
            <i class="fas fa-angle-down"></i>
            <ul class="children">
                <li class="nav-item">
                    <a href="{{ route('admin.department.add') }}" class="nav-link">Add new</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.department') }}" class="nav-link">All departments</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::route()->getName() == 'admin.admin' || Request::route()->getName() == 'admin.admin.add') ? 'active' : '' }}" href="{{ route('admin.admin') }}">Admins</a>
            <i class="fas fa-angle-down"></i>
            <ul class="children">
                <li class="nav-item">
                    <a href="{{ route('admin.admin.add') }}" class="nav-link">Add new</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.admin') }}" class="nav-link">All admins</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::route()->getName() == 'admin.user' || Request::route()->getName() == 'admin.user.add') ? 'active' : '' }}" href="{{ route('admin.user') }}">Users</a>
            <i class="fas fa-angle-down"></i>
            <ul class="children">
                <li class="nav-item">
                    <a href="{{ route('admin.user.add') }}" class="nav-link">Add new</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user') }}" class="nav-link">All users</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::route()->getName() == 'admin.report.type' || Request::route()->getName() == 'admin.report.type.add') ? 'active' : '' }}" href="{{ route('admin.report.type') }}">Report Types</a>
            <i class="fas fa-angle-down"></i>
            <ul class="children">
                <li class="nav-item">
                    <a href="{{ route('admin.report.type.add') }}" class="nav-link">Add new</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.report.type') }}" class="nav-link">All report types</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>