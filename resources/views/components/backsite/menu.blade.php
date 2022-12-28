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
            <div class="menu">
                <a href="{{ route('dashboard.index') }}" class="item-menu active">Dashboard</a>
            </div>
            <div class="menu p-0">
                <p>Master Data</p>
                <a href="#" class="item-menu">
                    <i class="icon ic-stats"></i>
                    Consultation
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-msg"></i>
                    Specialist
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-trans"></i>
                    Config Payment
                </a>
            </div>
            <div class="menu p-0">
                <p>Operational</p>
                <a href="#" class="item-menu">
                    <i class="icon ic-account"></i>
                    Doctor
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-stats"></i>
                    Appointment
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-trans"></i>
                    Transaction
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-help"></i>
                    Report
                </a>
            </div>
            <div class="menu p-0">
                <p>Management Access</p>
                <a href="#" class="item-menu">
                    <i class="icon ic-account"></i>
                    Permission
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-stats"></i>
                    Role
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-trans"></i>
                    User
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-settings"></i>
                    User-type
                </a>
            </div>
            <div class="menu">
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