<nav class="mx-auto site-navigation">
    <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
        <li class="d-lg-none"><a href="{{ url('/provider') }}">{{ $profile->name }}</a></li>
        <li class="d-lg-none"><a style="color: blue;" href="{{ url('/provider') }}"><img src="{{ $profile->image }}" style="width: 50px; height:50px;" class="img-circle elevation-2" alt="User Image"></a></li>
        <li><a href="{{ url('/provider') }}" class="nav-link">Timeline</a></li>
        <li class="has-children">
            <a href="#">Jobs</a>
            <ul class="dropdown">
                <li><a href="{{ url('/provider/job-listing') }}">Job List</a></li>
                <li><a href="{{ url('/provider/quick-job-list') }}">Quick Job Request List</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ url('/provider/view-applications') }}" class="nav-link">View Applications</a>
        </li>
        <li>
            <a href="{{ url('/provider/my-schedule') }}" class="nav-link">My Schedule</a>
        </li>
        <li class="has-children">
            <a href="#">Utilities 
                @if ($chat_counts > 0)
                    <span class="badge badge-danger navbar-badge">{{ $chat_counts }}</span>
                @endif
            </a>
            <ul class="dropdown">
                <li><a href="{{ url('/provider/my-profile') }}">My Profile</a></li>
                <li><a href="{{ url('/provider/change-password') }}">Change Password</a></li>
                <li><a href="{{ url('/provider/my-messages') }}">Messages 
                @if ($chat_counts > 0)
                    <span class="badge badge-danger navbar-badge">{{ $chat_counts }}</span>
                @endif
                </a></li>
            </ul>
        </li>

        <li class="d-lg-none"><a href="{{ url('/provider/post-job') }}"><span class="mr-2">+</span> Post a Job</a></li>
        <li class="d-lg-none"><a onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" href="{{ route('logout') }}">Log Out</a></li>
    </ul>

    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>