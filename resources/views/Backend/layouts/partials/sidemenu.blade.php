<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20 col-12">
                        <div class="user-pic col-3">
                            <img src="{{ asset(Auth::user()->GetProfilePic()) }}" alt="users" class="rounded-circle"
                                width="40" />

                        </div>
                        <div class="user-content hide-menu m-l-10 col-9">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="m-b-0 user-name font-medium">{{ auth()->user()->name }}
                                    <br>
                                    <strong>
                                        {{-- ({{ Auth::user()->getRoleNames()[0] ?? '' }}) --}}
                                        ({{ Auth::user()->UserType->user_type_name }})
                                    </strong>
                                </h5>
                                {{-- <span class="op-5 user-email">Role:
                                    {{ Auth::user()->getRoleNames()[0] ?? '' }}</span><br> --}}
                                {{-- @if (Auth::user()->isUserLoggedIn())
                                    <span class="op-5 user-email">Profile:
                                        {{ Auth::user()->UserDetail->viewAsAnonymous == 1 ? 'Private' : 'Public' }}</span>
                                @endif --}}
                            </a>
                            {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{route('logout')}}" class="dropdown-item" method="POST">
                                    @csrf
                                    <i
                                        class="fa fa-power-off m-r-5 m-l-5"></i>

                                            <button type="submit" class="btn red">
                                                <i class="icon-logout"></i>
                                                Logout
                                             </button>
                                        </form>
                            </div> --}}
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->

                @can('role-list')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('role.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Roles</span></a>
                    </li>
                @endcan
                @can('permission-list')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('create-permission.index') }}" aria-expanded="false"><i
                                class="mdi mdi-lock"></i><span class="hide-menu">Permissions</span></a></li>
                @endcan
                @can('user-list')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-multiple"></i><span class="hide-menu">Users</span></a></li>
                @endcan
                @can('company-list')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('company.index') }}" aria-expanded="false"><i
                                class="mdi  mdi-home-modern"></i><span class="hide-menu">Organizations</span></a></li>
                @endcan
                {{-- @can('UsertypeRoleMapping') --}}
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('mapping.index') }}" aria-expanded="false"><i
                                class="mdi  mdi-home-modern"></i><span class="hide-menu">User Type Mapping</span></a></li>
                {{-- @endcan --}}
                {{-- @can('employee-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('employee.index') }}" aria-expanded="false"><i
                        class="mdi  mdi-account-box-outline"></i><span class="hide-menu">Employees/Interns</span></a></li>
                @endcan
                @can('industry-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('industry.index') }}" aria-expanded="false"><i
                        class="mdi mdi-home"></i><span class="hide-menu">Organizations</span></a></li>
                @endcan
                @can('internship-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('internships.index') }}" aria-expanded="false"><i class="fas fa-user-md"></i>
                    <span class="hide-menu">Internships</span></a></li>
                @endcan
                @can('application-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('applications.index') }}" aria-expanded="false"><i class="fas fa-users"></i>
                    <span class="hide-menu">Applications</span></a></li>
                @endcan
                @can('payment-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('payments.index') }}" aria-expanded="false"><i class="fas fa-dollar-sign"></i>
                    <span class="hide-menu">Payments</span></a></li>
                @endcan
                @can('widthdraw-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('widthdraw.index') }}" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i>
                    <span class="hide-menu">Widthdraw Requests</span></a></li>
                @endcan
                @can('reviews-list')
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('reviews.index') }}" aria-expanded="false"><i class="fas fa-star"></i>
                    <span class="hide-menu">Reviews and Ratings</span></a></li>
                @endcan --}}

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
