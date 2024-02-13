<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li>
                <a class="" href="{{ route('admin') }}" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('admin.banner') }}" aria-expanded="false">
                    <i class="la la-image"></i>
                    <span class="nav-text">Banners</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('admin.classes') }}" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Classes</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('admin.subject') }}" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Subjects</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('admin.teacher') }}" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Teachers</span>
                </a>
            </li>
            <li>
                <a class="" href="{{ route('admin.student') }}" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Students</span>
                </a>
            </li>
            {{-- <li>
                <a class="has-arrow" href="/logout" aria-expanded="false">
                    <i class="la la-gift"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li> --}}

        </ul>
    </div>
</div>
