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
            <li
                class="{{ in_array($elementActive, ['user', 'therapyvideos', 'studentlist', 'studentregister', 'archivedstudents', 'leavelist', 'progressreport', 'academicreport']) ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#studentmodules">
                    <i class="nc-icon"><img src="{{ asset('paper/img/student_icon.png') }}"></i>
                    <p>
                        {{ __('Member Module') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="membermodule">
                    <ul class="nav">
                        @if ($user->role === 'admin' || $user->role === 'member')
                            <li class="{{ $elementActive == 'studentlist' ? 'active' : '' }}">
                                <a href="{{ route('studentlist') }}">
                                    <span class="sidebar-mini-icon">{{ __('SA') }}</span>
                                    <span class="sidebar-normal">{{ __(' Student Admission ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'studentregister' ? 'active' : '' }}">
                                <a href="{{ route('studentregister') }}">
                                    <span class="sidebar-mini-icon">{{ __('SR') }}</span>
                                    <span class="sidebar-normal">{{ __(' Student Register ') }}</span>
                                </a>
                            </li>

                            <li class="{{ $elementActive == 'archivedstudents' ? 'active' : '' }}">
                                <a href="{{ route('archivedstudents') }}">
                                    <span class="sidebar-mini-icon">{{ __('AS') }}</span>
                                    <span class="sidebar-normal">{{ __(' Archived Students ') }}</span>
                                </a>
                            </li>

                            <li class="{{ $elementActive == 'leavelist' ? 'active' : '' }}">
                                <a href="{{ route('leavelist') }}">
                                    <span class="sidebar-mini-icon">{{ __('SA') }}</span>
                                    <span class="sidebar-normal">{{ __(' Student Leave ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'progressreport' ? 'active' : '' }}">
                                <a href="{{ route('progressreport_list') }}">
                                    <span class="sidebar-mini-icon">{{ __('SR') }}</span>
                                    <span class="sidebar-normal">{{ __(' Student Reports ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'therapyvideos' ? 'active' : '' }}">
                                <a href="{{ route('therapyvideo.list') }}">
                                    <span class="sidebar-mini-icon">{{ __('TV') }}</span>
                                    <span class="sidebar-normal">{{ __(' Therapy Videos ') }}</span>
                                </a>
                            </li>
                            {{-- <li class="{{ $elementActive == 'academicreport' ? 'active' : '' }}">
                                <a href="{{ route('academicreport_list') }}">
                                    <span class="sidebar-mini-icon">{{ __('AR') }}</span>
                                    <span class="sidebar-normal">{{ __(' Academic Report ') }}</span>
                                </a>
                            </li> --}}
                        @endif
                        @if ($user->role === 'parent')
                            <li class="{{ $elementActive == 'studentlist' ? 'active' : '' }}">
                                <a href="{{ route('studentlist') }}">
                                    <span class="sidebar-mini-icon">{{ __('CL') }}</span>
                                    <span class="sidebar-normal">{{ __(' Child List ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'leavelist' ? 'active' : '' }}">
                                <a href="{{ route('leavelist') }}">
                                    <span class="sidebar-mini-icon">{{ __('SA') }}</span>
                                    <span class="sidebar-normal">{{ __(' Child Leave ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'therapyvideos' ? 'active' : '' }}">
                                <a href="{{ route('childvideo.gallary') }}">
                                    <span class="sidebar-mini-icon">{{ __('SV') }}</span>
                                    <span class="sidebar-normal">{{ __(' Child Videos ') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>

            {{-- Start Fee module --}}
            @if ($user->role === 'admin' || $user->role === 'teacher' || $user->role === 'parent')
                <li class="{{ in_array($elementActive, ['user', 'pendingfee']) ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#feemodules">
                        <i class="nc-icon nc-money-coins">
                            {{-- <img src="{{ asset('paper/img/student_icon.png') }}"> --}}
                        </i>
                        <p>
                            {{ __('Fee Module') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="feemodules">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'pendingfee' ? 'active' : '' }}">
                                <a href="{{ route('pendingfeelist') }}">
                                    <span class="sidebar-mini-icon">{{ __('PF') }}</span>
                                    <span class="sidebar-normal">{{ __(' Student Fee Details') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            {{-- End Fee module --}}


            @if ($user->role === 'admin' || $user->role === 'teacher')
                <li
                    class="{{ in_array($elementActive, ['userlist', 'notifications', 'timetablelist', 'login_activity', 'classlist', 'teacherlist', 'disabilitylist', 'citylist', 'statelist', 'therapistlist', 'equipmentlist', 'studentFLY', 'occupationlist']) ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#adminmodules">
                        <i class="nc-icon nc-circle-10"></i>
                        <p>
                            @if ($user->role === 'admin')
                                {{ __('Admin Module') }}
                            @elseif($user->role === 'teacher')
                                {{ __('Teacher Module') }}
                            @endif
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="adminmodules">
                        <ul class="nav">
                            @if ($user->role === 'admin')
                                <li class="{{ $elementActive == 'classlist' ? 'active' : '' }}">
                                    <a href="{{ route('classlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('CM') }}</span>
                                        <span class="sidebar-normal">{{ __(' Class Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'disabilitylist' ? 'active' : '' }}">
                                    <a href="{{ route('disabilitylist') }}">
                                        <span class="sidebar-mini-icon">{{ __('DM') }}</span>
                                        <span class="sidebar-normal">{{ __(' Disability Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'teacherlist' ? 'active' : '' }}">
                                    <a href="{{ route('teacherlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('TM') }}</span>
                                        <span class="sidebar-normal">{{ __(' Teacher Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'therapistlist' ? 'active' : '' }}">
                                    <a href="{{ route('therapistlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('TM') }}</span>
                                        <span class="sidebar-normal">{{ __(' Therapist Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'occupationlist' ? 'active' : '' }}">
                                    <a href="{{ route('occupationlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('OM') }}</span>
                                        <span class="sidebar-normal">{{ __(' Occupation Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'equipmentlist' ? 'active' : '' }}">
                                    <a href="{{ route('equipmentlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('TM') }}</span>
                                        <span class="sidebar-normal">{{ __(' Equipment Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'citylist' ? 'active' : '' }}">
                                    <a href="{{ route('citylist') }}">
                                        <span class="sidebar-mini-icon">{{ __('CM') }}</span>
                                        <span class="sidebar-normal">{{ __(' City Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'statelist' ? 'active' : '' }}">
                                    <a href="{{ route('statelist') }}">
                                        <span class="sidebar-mini-icon">{{ __('CM') }}</span>
                                        <span class="sidebar-normal">{{ __(' State Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'studentFLY' ? 'active' : '' }}">
                                    <a href="{{ route('studentFLY') }}">
                                        <span class="sidebar-mini-icon">{{ __('US') }}</span>
                                        <span class="sidebar-normal">{{ __(' Student Promotion') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'userlist' ? 'active' : '' }}">
                                    <a href="{{ route('userlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('PA') }}</span>
                                        <span class="sidebar-normal">{{ __(' Parent Accounts') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'login_activity' ? 'active' : '' }}">
                                    <a href="{{ route('login.activities') }}">
                                        <span class="sidebar-mini-icon">{{ __('LA') }}</span>
                                        <span class="sidebar-normal">{{ __(' Login Activity') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'timetablelist' ? 'active' : '' }}">
                                    <a href="{{ route('timetablelist') }}">
                                        <span class="sidebar-mini-icon">{{ __('TL') }}</span>
                                        <span class="sidebar-normal">{{ __(' Time Table Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                                    <a href="{{ route('notificationlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('CN') }}</span>
                                        <span class="sidebar-normal">{{ __(' Custom Notification ') }}</span>
                                    </a>
                                </li>
                            @elseif ($user->role === 'teacher')
                                <li class="{{ $elementActive == 'equipmentlist' ? 'active' : '' }}">
                                    <a href="{{ route('equipmentlist') }}">
                                        <span class="sidebar-mini-icon">{{ __('TM') }}</span>
                                        <span class="sidebar-normal">{{ __(' Equipment Master ') }}</span>
                                    </a>
                                </li>
                                <li class="{{ $elementActive == 'timetablelist' ? 'active' : '' }}">
                                    <a href="{{ route('timetablelist') }}">
                                        <span class="sidebar-mini-icon">{{ __('TL') }}</span>
                                        <span class="sidebar-normal">{{ __(' Time Table Master ') }}</span>
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
