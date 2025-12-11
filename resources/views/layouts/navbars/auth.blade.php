<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('dashboard') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo_gate.png">
            </div>
        </a>
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
            {{ __('Gate Management System ') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        @php
            $user = auth()->user();
        @endphp
        <ul class="nav">
            {{-- @if ($user->role === 'admin' || $user->role === 'teacher') --}}
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            {{-- @endif --}}
            <li class="{{ in_array($elementActive, ['user', 'visitorlist']) ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#membermodules">
                    <i class="nc-icon"><img src="{{ asset('paper/img/student_icon.png') }}"></i>
                    <p>
                        {{ __('Member Module') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="membermodules">
                    <ul class="nav">

                        @if ($user->role === 'admin' || $user->role === 'member')
                            <li class="{{ $elementActive == 'visitorlist' ? 'active' : '' }}">
                                <a href="{{ route('visitorlist') }}">
                                    <span class="sidebar-mini-icon">{{ __('VD') }}</span>
                                    <span class="sidebar-normal">{{ __(' Visitor Details ') }}</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </li>

            {{-- Start Gate Admin module --}}
            @if ($user->role === 'admin' || $user->role === 'gateadmin')
                <li class="{{ in_array($elementActive, ['user']) ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#gateadminmodule">
                        <i class="nc-icon nc-money-coins">
                            {{-- <img src="{{ asset('paper/img/student_icon.png') }}"> --}}
                        </i>
                        <p>
                            {{ __('Gate Admin Module') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="gateadminmodule">
                        <ul class="nav">
                            {{-- <li class="{{ $elementActive == 'pendingfee' ? 'active' : '' }}">
                                <a href="{{ route('pendingfeelist') }}">
                                    <span class="sidebar-mini-icon">{{ __('PF') }}</span>
                                    <span class="sidebar-normal">{{ __(' Student Fee Details') }}</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
            @endif
            {{-- End Gate Admin module --}}


            @if ($user->role === 'admin' || $user->role === 'teacher')
                <li
                    class="{{ in_array($elementActive, ['userlist', 'memberlist', 'timetablelist', 'login_activity', 'classlist', 'teacherlist', 'disabilitylist', 'citylist', 'statelist', 'therapistlist', 'equipmentlist', 'studentFLY', 'occupationlist']) ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#adminmodules">
                        <i class="nc-icon nc-circle-10"></i>
                        <p>
                            {{ __('Admin Module') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="adminmodules">
                        <ul class="nav">
                            @if ($user->role === 'admin')
                                <li class="{{ $elementActive == 'memberlist' ? 'active' : '' }}">
                                    <a href="{{ route('memberlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('MD') }}</span>
                                        <span class="sidebar-normal">{{ __(' Member Details ') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                <a href="{{ route('profile.edit') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                </a>
            </li>
            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}, d-md-none">
                <form class="dropdown-item" action="{{ route('logout') }}" id="LogOut" method="POST"
                    style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('LogOut').submit();">
                    <i class="nc-icon nc-single-02"></i>
                    <span class="sidebar-normal">{{ __(' Logout ') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
