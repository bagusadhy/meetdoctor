<!-- Nav Sidebar -->
    <nav
        class="sidebar offcanvas-md offcanvas-start"
        >
        <div class="d-flex justify-content-end m-3 d-block d-md-none">
                <button
                aria-label="Close"
                data-bs-dismiss="offcanvas"
                data-bs-target=".sidebar"
                class="btn p-0 border-0 fs-4">
                <i class="fas fa-close"></i>
                </button>
        </div>
        <div class="d-flex justify-content-center mt-md-5 mb-5">
            <a href="{{ route('index') }}" class="">
                <img
                    src="{{ asset('assets/frontsite/images/logo.png') }}"
                    alt="Logo"
                    width="126px"
                    height="48px"
                />
            </a>
        </div>
        <div class="pt-2 d-flex flex-column gap-4">
            <div class="menu p-0">
                <a href="{{ route('dashboard.index') }}" class="item-menu {{ request()->is('backsite/dashboard') ? "active" : "" }}">Dashboard</a>
            </div>

            @can('master_data_access')
                <div class="menu p-0">
                    <p>Master Data</p>

                    @can('consultation_access')
                        <a href="{{ route('consultation.index') }}" class="item-menu {{ request()->is('backsite/consultation') || request()->is('backsite/consultation/*') ? "active" : "" }}">
                            <i class="icon ic-stats"></i>
                            Consultation
                        </a>
                    @endcan

                    @can('specialist_access')
                        <a href="{{ route('specialist.index') }}" class="item-menu {{ request()->is('backsite/specialist') || request()->is('backsite/specialist/*') ? "active" : "" }}">
                            <i class="icon ic-msg"></i>
                            Specialist
                        </a>
                    @endcan

                    @can('config_payment_access')
                        <a href="{{ route('config-payment.index') }}" class="item-menu {{ request()->is('backsite/config-payment') || request()->is('backsite/config-payment/*') ? "active" : "" }}">
                            <i class="icon ic-trans"></i>
                            Config Payment
                        </a>
                    @endcan
                </div>
            @endcan

            @can('operational_access')
                <div class="menu p-0">
                    <p>Operational</p>

                    @can('doctor_access')
                    <a href="{{ route('doctor.index') }}" class="item-menu {{ request()->is('backsite/doctor') || request()->is('backsite/doctor/*') ? "active" : "" }}">
                        <i class="icon ic-account"></i>
                        Doctor
                    </a>
                    @endcan

                    @can('appointment_access')
                        <a href="{{ route('appointment.index') }}" class="item-menu {{ request()->is('backsite/appointment') || request()->is('backsite/appointment/*') ? "active" : "" }}">
                            <i class="icon ic-stats"></i>
                            Appointment
                        </a>
                    @endcan

                    @can('transaction_access')
                        <a href="{{ route('transaction.index') }}" class="item-menu {{ request()->is('backsite/transaction') || request()->is('backsite/transaction/*') ? "active" : "" }}">
                            <i class="icon ic-trans"></i>
                            Transaction
                        </a>
                    @endcan

                    @can('report_access')
                        <a href="{{ route('report.index') }}" class="item-menu {{ request()->is('backsite/report') || request()->is('backsite/report/*') ? "active" : "" }}">
                            <i class="icon ic-help"></i>
                            Report
                        </a>
                    @endcan
                </div>
            @endcan

            @can('management_access')
                <div class="menu p-0">
                    <p>Management Access</p>

                    @can('permission_access')
                        <a href="{{ route('permission.index') }}" class="item-menu {{ request()->is('backsite/permission') || request()->is('backsite/permission/*') ? "active" : "" }}">
                            <i class="icon ic-account"></i>
                            Permission
                        </a>
                    @endcan

                    @can('role_access')
                        <a href="{{ route('role.index') }}" class="item-menu {{ request()->is('backsite/role') || request()->is('backsite/role/*') ? "active" : "" }}">
                            <i class="icon ic-stats"></i>
                            Role
                        </a>
                    @endcan

                    @can('user_access')
                        <a href="{{ route('user.index') }}" class="item-menu {{ request()->is('backsite/user') || request()->is('backsite/user/*') ? "active" : "" }}">
                            <i class="icon ic-trans"></i>
                            User
                        </a>
                    @endcan

                    @can('type_user_access')
                    <a href="{{ route('user_type.index') }}" class="item-menu {{ request()->is('backsite/user_type') || request()->is('backsite/user_type/*') ? "active" : "" }}">
                        <i class="icon ic-settings"></i>
                        User-type
                    </a>
                    @endcan
                </div>
            @endcan
            
            <div class="menu p-0">
                <p>Others</p>
                <a href="#" class="item-menu">
                    <i class="icon ic-settings"></i>
                    Edit Profile
                </a>
                <a href="{{ route('logout') }}" class="item-menu"  onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                    <i class="icon ic-logout"></i>
                    Logout

                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </div>
    </nav>