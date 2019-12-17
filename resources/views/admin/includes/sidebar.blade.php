<!-- Main Sidebar start-->
<aside data-mcs-theme="minimal-dark" style="background-image: url({{ asset('build/images/backgrounds/11.jpg') }})" class="main-sidebar mCustomScrollbar">
    <div class="user">
        <div id="esp-user-profile" data-percent="65" style="height: 130px; width: 130px; line-height: 100px; padding: 15px;" class="easy-pie-chart"><img src="{{ asset('build/images/users/04.jpg') }}" alt="" class="avatar img-circle"><span class="status bg-success"></span></div>
        <h4 class="fs-16 text-muted mt-15 mb-5 fw-300">{{ Auth::user()->name }}</h4>
        {{-- <p class="mb-0 text-muted">Designer</p> --}}
    </div>
    <ul class="list-unstyled navigation mb-0">
        <li class="sidebar-category">Main</li>
        <li class="panel">
            <a href="{{ route('dashboard') }}" class="{{ Request::segment(1) === 'dashboard' ? 'active' : '' }}">
                <i class="fa fa-home"></i><span class="sidebar-title">Dashboard</span>
            </a>
        </li>
        <li class="panel">
            <a role="button" data-toggle="collapse" data-parent=".navigation" href="#collapse1" aria-expanded="false" aria-controls="collapse1"
            class="bubble collapsed {{ Request::segment(1) === 'divisions' || Request::segment(1) === 'skills' || 
            Request::segment(1) === 'criterias' || Request::segment(1) === 'criteria-details' ? 'active' : '' }}">
                <i class="fa fa-archive"></i><span class="sidebar-title">Master Data</span>
            </a>
            <ul id="collapse1" class="list-unstyled collapse {{ Request::segment(1) === 'divisions' || Request::segment(1) === 'skills' || 
            Request::segment(1) === 'criterias' || Request::segment(1) === 'criteria-details' ? 'in' : '' }}">
                <li>
                    <a href="{{ route('divisions.index') }}" class="{{ Request::segment(1) === 'divisions' ? 'active' : '' }}">Division</a>
                </li>
                <li>
                    <a href="{{ route('criterias.index') }}" class="{{ Request::segment(1) === 'criterias' || Request::segment(1) === 'criteria-details'  ? 'active' : '' }}">Criteria</a>
                </li>
            </ul>
        </li>
        <li class="panel">
            <a href="{{ route('job-vacancies.index') }}" class="{{ Request::segment(1) === 'job-vacancies' ? 'active' : '' }}">
                <i class="fa fa-suitcase"></i><span class="sidebar-title">Job Vacancy</span>
            </a>
        </li>
        <li class="panel">
            <a href="{{ route('candidates.index') }}" class="{{ Request::segment(1) === 'candidates' ? 'active' : '' }}">
                <i class="fa fa-rocket"></i><span class="sidebar-title">Candidate</span>
            </a>
        </li>
        <li class="panel">
            <a role="button" data-toggle="collapse" data-parent=".navigation" href="#requirement" aria-expanded="false" aria-controls="collapse1"
            class="bubble collapsed {{ Request::segment(1) === 'hiring' || Request::segment(1) === 'onboarding' ? 'active' : '' }}">
                <i class="fa fa-sitemap"></i><span class="sidebar-title">Hiring</span>
            </a>
            <ul id="requirement" class="list-unstyled collapse {{ Request::segment(1) === 'hiring' || Request::segment(1) === 'onboarding' ? 'in' : '' }}">
                <li>
                    <a href="{{ route('hiring.index') }}" class="{{ Request::segment(1) === 'hiring' ? 'active' : '' }}">Interview & Test</a>
                </li>
                <li>
                    <a href="{{ route('onboarding.index') }}" class="{{ Request::segment(1) === 'onboarding' ? 'active' : '' }}">Onboarding</a>
                </li>
            </ul>
        </li>
        
        <li class="sidebar-category">Configuration</li>
        <li class="panel">
            <a href="{{ route('users.index') }}" class="{{ Request::segment(1) === 'users' ? 'active' : '' }}">
                <i class="fa fa-users"></i><span class="sidebar-title">User</span>
            </a>
        </li>
        <li class="panel">
            <a href="#" data-toggle="modal" data-target="#user_logout_form">
                <i class="fas fa-sign-out-alt"></i><span class="sidebar-title">Log Out</span>
            </a>
        </li>
    </ul>
</aside>