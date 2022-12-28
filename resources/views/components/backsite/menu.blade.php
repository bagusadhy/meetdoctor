<!-- Nav Sidebar -->
    <nav
        class="sidebar offcanvas-md offcanvas-start"
        data-bs-scroll="true"
        data-bs-backdrop="false">
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
        <div class="pt-2 d-flex flex-column gap-5">
            <div class="menu p-0">
                <p>Daily Use</p>
                <a href="#" class="item-menu active">
                    <i class="icon ic-stats"></i>
                    Overview
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-trans"></i>
                    Transactions
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-msg"></i>
                    Messages
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-stats"></i>
                    Stats
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-account"></i>
                    Account
                </a>
            </div>
            <div class="menu">
                <p>Others</p>
                <a href="#" class="item-menu">
                    <i class="icon ic-settings"></i>
                    Edit Profile
                </a>
                <a href="#" class="item-menu">
                    <i class="icon ic-help"></i>
                    Help
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