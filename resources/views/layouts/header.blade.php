<div class="header">
    <div class="header-left">
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    @php
                        $user = Auth::user();
                        $imagePath = '';
                        $gender = strtolower($user->jenis_kelamin);
                        if ($user->role === 'Admin') {
                            $gender = strtolower($user->jenis_kelamin);
                            $imagePath =
                                $gender === 'laki-laki'
                                    ? asset('dashboard/asset/profile-pria.png')
                                    : asset('dashboard/asset/profile-wanita.png');
                        } elseif ($user->role === 'Customer') {
                            $imagePath =
                                $gender === 'laki-laki'
                                    ? asset('website/asset/profile-pria.png')
                                    : asset('website/asset/profile-wanita.png');
                        }
                    @endphp
                    <span class="user-icon">
                        <img src="{{ $imagePath }}" alt="User Avatar">
                    </span>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    @if (Auth::user()->role === 'Admin')
                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="dw dw-user1"></i>
                            Profile</a>
                    @elseif(Auth::user()->role === 'Customer')
                        <a class="dropdown-item" href="{{ route('customer.profile.index') }}"><i
                                class="dw dw-user1"></i> Profile</a>
                    @endif
                    <a class="dropdown-item" href="{{ url('/') }}"><i class="dw dw-home"></i> Home</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="dw dw-logout"></i> Log Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
