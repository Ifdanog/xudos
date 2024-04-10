<header class="header">
    <a href="/" class="logo">Dazpay</a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
    <div class="move-toggle">
        <input type="checkbox" id="check-two" class="toggle-two" />
        <label for="check-two"></label>
    </div>
    <ul class="menu">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Create Stores / Cashiers</a></li>
        <li><a href="#">Management</a></li>
        <li><a href="#">Transaction</a></li>
    </ul>
</header>
<header class="container-1" style="position: relative;right: 96px;padding-right: 36px;">
    <nav>
        <div class="nav-left">
            <div class="logo-text">Dazpay</div>

        </div>
        <div class="nav-right">
            <div class="toggle-switch">
                <input type="checkbox" id="check" class="toggle" />
                <label for="check"></label>
            </div>

            @php($user = App\Models\User::find(Auth::id()))
            <div class="menu-left-img">
                <img src="{{ $url }}" alt="" onclick="toggleDropdownMenu()">
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="#" class="dropdown-item"><img src="{{ asset('assets') }}/images/profile-route-icon.svg"
                            class="profile-route-img"> Profile</a>
                            <form action="{{ route('cashier.logout') }}" method="POST">
                                @csrf
                                <button type="submit" style="background:#13171C;border:none " class="dropdown-item"><img
                                        src="{{ asset('assets') }}/images/log-out-icon.svg" class="log-out-icon"> Log
                                    Out</button>
                            </form>
                </div>
            </div>

            <div class="menu-left-name">
                <p>{{ $user->name }}</p>
                <p style="font-size: 9px; color: #fff">{{ $user->role}}</p>
            </div>
        </div>
    </nav>
</header>
