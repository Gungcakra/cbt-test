<div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
    <div class="w-full flex flex-col gap-[30px]">
        <a href="index.html" class="flex items-center justify-center">
            <img src="{{ asset('images/logo/logo.svg')}}" alt="logo">
        </a>
        <ul class="flex flex-col gap-3">
            <li>
                <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 {{ request()->is('dashboard') ? 'bg-[#2B82FE]' : '' }} hover:bg-[#2B82FE]">
                    <div>
                        <img src="{{ asset('images/icons/home-hashtag.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 {{ request()->is('dashboard') ? 'text-white' : '' }} hover:text-white">Overview</p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.learning.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE] {{ request()->routeIs('dashboard.learning.index') ? 'bg-[#2B82FE]' : '' }}">
                    <div>
                        <img src="{{ asset('images/icons/note-favorite.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 {{ request()->routeIs('dashboard.learning.index') ? 'text-white' : '' }} hover:text-white">My Courses</p>
                </a>
            </li>

        </ul>
        <ul class="flex flex-col gap-3">
            <li>
                <h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="w-full p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                        <div>
                            <img src="{{  asset('images/icons/security-safe.svg')}}" alt="icon">
                        </div>
                        <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
                    </button>
                </form>
            </li>
        </ul>
    </div>

</div>
