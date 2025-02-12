<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

            @can('user_management_access')
                <!-- User Management -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon"></i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon"></i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon"></i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('service_access')
            <li class="nav-item">
                <a href="{{ route("admin.services.index") }}" class="nav-link {{ request()->is('admin/services') || request()->is('admin/services/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-cogs nav-icon"></i>
                    {{ trans('cruds.service.title') }}
                </a>
            </li>
        @endcan
        @can('employee_access')
            <li class="nav-item">
                <a href="{{ route("admin.employees.index") }}" class="nav-link {{ request()->is('admin/employees') || request()->is('admin/employees/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-cogs nav-icon"></i>
                    {{ trans('cruds.employee.title') }}
                </a>
            </li>
        @endcan

            @can('lead_access')
                <!-- Leads -->
                <li class="nav-item">
                    <a href="{{ route('admin.leads.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.leads.*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user-tag nav-icon"></i>
                        {{ trans('cruds.lead.title') }}
                    </a>
                </li>
            @endcan

            @can('client_access')
                <!-- Clients -->
                <li class="nav-item">
                    <a href="{{ route('admin.clients.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon"></i>
                        {{ trans('cruds.client.title') }}
                    </a>
                </li>
            @endcan

            @can('appointment_access')
                <!-- Appointments -->
                <li class="nav-item">
                    <a href="{{ route('admin.appointments.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-calendar-check nav-icon"></i>
                        {{ trans('cruds.appointment.title') }}
                    </a>
                </li>
            @endcan

            @can('report_management')
                <!-- Reports -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-chart-line nav-icon"></i>
                        {{ trans('cruds.report_management.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('report_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.reports.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-chart-bar nav-icon"></i>
                                    {{ trans('cruds.report.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('setting_management')
                <!-- Settings -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-cog nav-icon"></i>
                        {{ trans('cruds.setting_management.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('setting_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.payment_schedule.show') }}" 
                                   class="nav-link {{ request()->routeIs('admin.settings.payments') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-sliders-h nav-icon"></i>
                                    {{ trans('cruds.payments.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('setting_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.settings.invoice') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-file-invoice-dollar nav-icon"></i>
                                    {{ trans('cruds.invoice.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            <!-- Calendar -->
            <li class="nav-item">
                <a href="{{ route('admin.systemCalendar') }}" 
                   class="nav-link {{ request()->routeIs('admin.systemCalendar') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar"></i>
                    {{ trans('global.systemCalendar') }}
                </a>
            </li>

            <!-- Logout -->
            {{-- <li class="nav-item">
                <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    {{ trans('global.logout') }}
                </a>
            </li> --}}
        </ul>
    </nav>

    <!-- Sidebar Minimizer Button -->
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
