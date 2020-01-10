{{-- <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
    <div class="container mx-auto">
        <a class="inline-block pt-1 pb-1 mr-4 text-lg whitespace-no-wrap" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="py-1 px-2 text-md leading-normal bg-transparent border border-transparent rounded" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse flex-grow items-center" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="flex flex-wrap list-reset pl-0 mb-0 mr-auto">
                <li class=" relative">
                    <a class="inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="relative" aria-haspopup="true" aria-expanded="false">
                        Browse
                    </a>
                    <div class=" absolute pin-l z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-grey-light rounded" aria-labelledby="navbarDropdownMenuLink">
                        <a class="inline-block py-2 px-4 no-underline" href="{{ route('threads.index', '') }}">All Threads</a>
                        <a class="inline-block py-2 px-4 no-underline" href="{{ url('threads?popular=1') }}">Popular Threads</a>
                        @if (auth()->check())
                            <a class="inline-block py-2 px-4 no-underline" href="{{ url('threads?by=' . auth()->user()->name) }}">My Threads</a>
                        @endif
                    </div>
                </li>
                <li class="">
                    <a class="inline-block py-2 px-4 no-underline" href="{{ route('threads.create') }}">Create Thread</a>
                </li>
                <li class=" relative">
                    <a class="inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="relative" aria-haspopup="true" aria-expanded="false">
                        Channels
                    </a>
                    <div class=" absolute pin-l z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-grey-light rounded" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($channels as $channel)
                            <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="{{ route('threads.index', $channel->slug) }}">{{ $channel->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="flex flex-wrap list-reset pl-0 mb-0 ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="">
                        <a class="inline-block py-2 px-4 no-underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="">
                            <a class="inline-block py-2 px-4 no-underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class=" relative">
                        <a id="navbarDropdown" class="inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" href="#" role="button" data-toggle="relative" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class=" absolute pin-l z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-grey-light rounded dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="{{ route('profile', auth()->user()) }}">My Profile</a>
                            <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
 --}}

<nav class="flex items-center justify-between flex-wrap bg-green-800 p-4">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <a class="font-semibold text-xl tracking-tight">Forum</a>
    </div>
    <div class="block lg:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
      </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="text-sm lg:flex-grow">
        <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
          Docs
        </a>
        <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
          Examples
        </a>
        <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
          Blog
        </a>
      </div>
      <div>
        <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Download</a>
      </div>
    </div>
  </nav>