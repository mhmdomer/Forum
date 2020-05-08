<section class="navigation">
    <div class="nav-container">
        <div class="brand">
            <a href="{{ url('/') }}">{{ config('app.name') }}</a>
        </div>
        <div id="navbar">
            <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
            <ul class="nav-list">
                @guest
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">Sign Up</a>
                </li>
                @else
                <li>
                    <a href="#!">Browse ▾</a>
                    <ul class="nav-dropdown">
                        <li>
                            <a href="{{ route('threads.index') }}">All Threads</a>
                        </li>
                        <li>
                            <a href="{{ url('/threads?popular=1') }}">Popular Threads</a>
                        </li>
                        <li>
                            <a href="{{ url('/threads?unanswered=1') }}">Unanswered Threads</a>
                        </li>
                        <li>
                            <a href="{{ url('/threads?' . 'by=' . auth()->user()->name) }}">My Threads</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#!">Channels ▾</a>
                    <ul class="nav-dropdown">
                        @foreach ($channels as $channel)
                        <li>
                            <a href="{{ route('threads.channel', $channel->slug) }}">{{ $channel->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <user-notifications></user-notifications>
                <li>
                    <a href="#!">{{ auth()->user()->name }} ▾</a>
                    <ul class="nav-dropdown">
                        <li>
                            <a href="{{ route('profile', auth()->user()->name) }}">Profile kdsfjldfjkldsfjlsdkfjd</a>
                        </li>
                        <li>
                            <a href="#" onclick="logout.submit()">Logout</a>
                        </li>
                        <form action="{{ route('logout') }}" class="hidden" id="logout" method="POST">
                        @csrf
                        </form>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('threads.create') }}">New Thread</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</section>
