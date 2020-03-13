<nav class="mx-auto site-navigation">
    <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
        <li><a href="{{ url('/seeker') }}" class="nav-link">Dashboard</a></li>
        <li class="has-children">
            <a href="#">Find Jobs</a>
            <ul class="dropdown">
                <li><a href="{{ url('/seeker/part-time') }}">Part Time</a></li>
                <li><a href="{{ url('/seeker/full-time') }}">Full Time</a></li>
            </ul>
        </li>
        <li class="has-children">
            <a href="#">My Application</a>
            <ul class="dropdown">
                <li><a href="{{ url('/seeker/ongoing-applications') }}">OnGoing Applications</a></li>
            </ul>
        </li>
        <li class="has-children">
            <a href="#">Utilities</a>
            <ul class="dropdown">
                <li><a href="{{ url('/seeker/my-profile') }}">My Profile</a></li>
                <li><a href="{{ url('/seeker/my-calendar') }}">My Calendar</a></li>
            </ul>
        </li>
        <li class="d-lg-none"><a href="{{ url('/seeker') }}">Log Out</a></li>
    </ul>
</nav>