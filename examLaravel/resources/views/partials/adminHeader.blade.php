<header>

<nav class="navbar navbar-expand-md green shadow-sm">
    <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 30px; width: auto; margin-right: 10px;"> <!-- Adjust the src as needed -->
                {{ config('app.name', 'Malawian Tour') }}
            </a>
        <button class="navbar-toggler white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
         
               <ul class="navbar-nav ms-auto">
                <!-- No authenticaion links because only displayed for authenticated admins -->
               
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="nav-link text-black" href="{{ route('profile.edit') }}">Settings</a>
                        <a class="nav-link text-black" href="{{ route('profile.show', ['user' => auth()->user()->id]) }}">Profile</a>
                        <a class="dropdown-item text-black fw-bold" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        
                        <form id="logout-form text-white" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('user.index') }}">{{ __('Other travelers') }}</a>
                </li>
                                                  
            
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">{{ __('Admin Panel') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</header>