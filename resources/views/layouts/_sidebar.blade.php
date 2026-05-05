<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <div class="logo">
                <a href="{{ route('public') }}">
                    <span>Academic Creativity Week</span>
                </a>
            </div>
            <ul>
                <!-- Main Menu Section -->
                <li class="label">Main Menu</li>
                
                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <i class="ti-home"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                
                
                <li>
                    <a href="#" class="sidebar-sub-toggle">
                        <i class="ti-calendar"></i> 
                        <span>Activities</span>
                        <i class="sidebar-collapse-icon ti-angle-down"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('activity.index') }}"><i class="ti-list"></i> Activities List</a></li>
                        <li><a href="{{ route('activity.prepare') }}"><i class="ti-pencil-alt"></i> Create Activity</a></li>
                        <li><a href="{{ route('activity.public') }}"><i class="ti-world"></i>Activities QRCodes</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('exhibition.admin.index') }}">
                        <i class="ti-agenda"></i>
                        <span>Exhibition Registrations</span>
                    </a>
                </li>
                
                <!-- System Section -->
                <li class="label">System</li>
                
                <li>
                    <a href="#" class="sidebar-sub-toggle">
                        <i class="ti-settings"></i> 
                        <span>Settings</span>
                        <i class="sidebar-collapse-icon ti-angle-down"></i>
                    </a>
                    <ul>
                        @if ($user_role)
                        @if ($user_role->role_id == 1)
                        <li><a href="{{ route('userrole.index') }}"><i class="ti-id-badge"></i> Assign Roles</a></li>
                        @endif
                        @if (($user_role->role_id == 1) || ($user_role->role_id == 3))
                        <li><a href="{{ route('academicyear.index') }}"><i class="ti-bookmark-alt"></i> Academic Year</a></li>
                        @endif
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>