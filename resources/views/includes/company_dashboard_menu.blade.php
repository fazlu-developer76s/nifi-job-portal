<div class="col-lg-3">
	<div class="usernavwrap">
    <ul class="usernavdash">
        @if(check_permission('dashboard_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('company.home') ? 'active' : '' }}"><a href="{{route('company.home')}}"><i class="fas fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a></li>
        @endif

        @if(check_permission('edit_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('company.profile') ? 'active' : '' }}"><a href="{{ route('company.profile') }}"><i class="fas fa-pencil" aria-hidden="true"></i> {{__('Edit Profile')}}</a></li>
        @endif

        @if(check_permission('public_profile_per') == 1 || empty(session('emp_user')))
        <li><a href="{{ route('company.detail', Auth::guard('company')->user()->slug) }}" target="_blank"><i class="fas fa-user-alt" aria-hidden="true" ></i> {{__('Company Public Profile')}}</a></li>
        @endif 
        
        @if(check_permission('post_job_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('post.job') ? 'active' : '' }}"><a href="{{ route('post.job') }}"><i class="fas fa-desktop" aria-hidden="true"></i> {{__('Post Job')}}</a></li>
        @endif 

        @if(check_permission('company_job_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('posted.jobs') ? 'active' : '' }}"><a href="{{ route('posted.jobs') }}"><i class="fab fa-black-tie"></i> {{__('Company Jobs')}}</a></li>
        @endif

        @if(check_permission('cv_search_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('company.packages') ? 'active' : '' }}"><a href="{{ route('company.packages') }}"><i class="fas fa-search" aria-hidden="true"></i> {{__('CV Search Packages')}}</a></li>
        @endif

        @if(check_permission('unlocked_user_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('company.unloced-users') ? 'active' : '' }}"><a href="{{ route('company.unloced-users') }}"><i class="fas fa-user" aria-hidden="true"></i> {{__('Unlocked Users')}}</a></li>
        @endif 

        @if(check_permission('company_message_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('company.messages') ? 'active' : '' }}"><a href="{{route('company.messages')}}"><i class="fas fa-envelope" aria-hidden="true"></i> {{__('Company Messages')}}</a></li>
        @endif
        
        @if(check_permission('recommended_seeker_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('recommended.seekers') ? 'active' : '' }}"><a href="{{route('recommended.seekers')}}"><i class="fas fa-briefcase" aria-hidden="true"></i> {{__('Recommended Seekers')}}</a></li>
        @endif

        @if(check_permission('company_follower_per') == 1 || empty(session('emp_user')))
        <li class="{{ Request::url() == route('company.followers') ? 'active' : '' }}"><a href="{{route('company.followers')}}"><i class="fas fa-users" aria-hidden="true"></i> {{__('Company Followers')}}</a></li>
        @endif 

        @if(empty(session('emp_user')))
        <li class="{{ Request::url() == route('user.list.user') ? 'active' : '' }}"><a href="{{route('user.list.user')}}"><i class="fas fa-user" aria-hidden="true"></i> {{__('User Management')}}</a></li>
        @endif  
        
        <li><a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a>
            <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        </li>
    </ul>
	</div>
    <div class="row">
        <div class="col-md-12">{!! $siteSetting->dashboard_page_ad !!}</div>
    </div>
</div>